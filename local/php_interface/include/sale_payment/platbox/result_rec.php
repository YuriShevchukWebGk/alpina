<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
require_once(dirname(__FILE__)."/functions.php");

function getPropertyByCode($propertyCollection, $code)
{
    foreach ($propertyCollection as $property) {
        if ($property->getField('CODE') == $code) {
            return $property->getValue();
        }
    }
}

function checkOrder($request_params, $order_info, $payment_info)
{
    if (!$order_info || !$payment_info) {
        return [
            "status"      => "error",
            "code"        => 1005,
            "description" => "Заказ не найден",
        ];
    }
    $user_email = getPropertyByCode($order_info->getPropertyCollection(), 'EMAIL');
    if ($request_params->account->id != $user_email) {
        return [
            "status"      => "error",
            "code"        => 1001,
            "description" => "Учётная запись пользователя не найдена",
        ];
    }
    $payment_currency = getCorrectCurrency($payment_info->getField('CURRENCY'));
    if ($request_params->payment->currency != $payment_currency) {
        return [
            "status"      => "error",
            "code"        => 1002,
            "description" => "Неверная валюта платежа",
        ];
    }
    if (intval($request_params->payment->amount) != $payment_info->getField('SUM') * 100) {
        return [
            "status"      => "error",
            "code"        => 1003,
            "description" => "Неверная сумма платежа",
        ];
    }
    switch ($request_params->action) {
        case "check":
            if ($payment_info->getField('PS_STATUS_CODE') == "inprogress") {
                return [
                    "status"      => "error",
                    "code"        => 2000,
                    "description" => "Платёж с указанным идентификатором уже зарезервирован",
                ];
            }
            if ($payment_info->getField('PS_STATUS_CODE') == "success") {
                return [
                    "status"      => "error",
                    "code"        => 2001,
                    "description" => "Платёж с указанным идентификатором уже проведен",
                ];
            }
            if ($payment_info->getField('PS_STATUS_CODE') == "canceled") {
                return [
                    "status"      => "error",
                    "code"        => 2002,
                    "description" => "Платёж с указанным идентификатором уже отменён",
                ];
            }
            break;

        case "pay":
            if ($payment_info->getField('PS_STATUS_CODE') == "canceled") {
                return [
                    "status"      => "error",
                    "code"        => 2002,
                    "description" => "Платёж с указанным идентификатором уже отменён",
                ];
            }
            break;

        case "cancel":
            if ($payment_info->getField('PS_STATUS_CODE') == "success") {
                return [
                    "status"      => "error",
                    "code"        => 2001,
                    "description" => "Платёж с указанным идентификатором уже проведен",
                ];
            }
            break;
    }

    return [];
}


$body = json_decode(file_get_contents('php://input'));
ksort($body);
$body      = json_encode($body);
$signature = $_SERVER['HTTP_X_SIGNATURE'];

$request_params = json_decode($body);
$order_info     = null;
$payment_info   = null;

list($orderId, $paymentId) = \Bitrix\Sale\PaySystem\Manager::getIdsByPayment($request_params->order->order_id);
/*$orderId = $request_params->order->order_id;
$paymentId = (strlen(CSalePaySystemAction::GetParamValue("PAYMENT_ID")) > 0) ? CSalePaySystemAction::GetParamValue(
    "PAYMENT_ID"
) : $GLOBALS["SALE_INPUT_PARAMS"]["PAYMENT"]["ID"];*/

/** @var \Bitrix\Sale\Order $order_info */
$order_info = \Bitrix\Sale\Order::load($orderId);
if ($order_info) {
    /** @var \Bitrix\Sale\PaymentCollection $paymentCollection */
    $paymentCollection = $order_info->getPaymentCollection();
    if ($paymentCollection) {
        /** @var \Bitrix\Sale\Payment $payment_info */
        $payment_info = $paymentCollection->getItemById($paymentId);
    }
}

$arOrder = $order_info->getFieldValues();
CSalePaySystemAction::InitParamArrays($arOrder, $arOrder["ID"]);

if (checkSignature($body, $signature)) {
    $response = checkOrder($request_params, $order_info, $payment_info);

    if (!$response) {
        switch ($request_params->action) {
            case "check":
                $arFields = array(
                    "PS_STATUS"             => "N",
                    "PS_STATUS_CODE"        => "inprogress",
                    "PS_STATUS_DESCRIPTION" => "inprogress",
                    "PS_STATUS_MESSAGE"     => "inprogress",
                );
                break;

            case "pay":
                $arFields = array(
                    "PS_STATUS"             => "Y",
                    "PS_STATUS_CODE"        => "success",
                    "PS_STATUS_DESCRIPTION" => "success",
                    "PS_STATUS_MESSAGE"     => "success",
                    "STATUS_ID"             => "PR",
                );
                break;

            case "cancel":
                $arFields = array(
                    "PS_STATUS"             => "N",
                    "PS_STATUS_CODE"        => "canceled",
                    "PS_STATUS_DESCRIPTION" => "canceled",
                    "PS_STATUS_MESSAGE"     => "canceled",
                );
                break;
        }
        if ($arOrder["PAYED"] != "Y" && $arFields["PS_STATUS"] == "Y") {
            CSaleOrder::PayOrder(
                $arOrder["ID"],
                "Y",
                true,
                true,
                0,
                array(
                    "PAY_VOUCHER_NUM"  => $request_params->platbox_tx_id,
                    "PAY_VOUCHER_DATE" => Date(
                        CDatabase::DateFormatToPHP(
                            CLang::GetDateFormat("FULL", LANG),
                            $request_params->platbox_tx_created_at
                        )
                    ),
                )
            );
        }

        $arFields = array_merge(
            $arFields,
            array(
                "PS_SUM"           => number_format($request_params->payment->amount / 100, 0, ".", ""),
                "PS_CURRENCY"      => $request_params->payment->currency,
                "PS_RESPONSE_DATE" => Date(CDatabase::DateFormatToPHP(CLang::GetDateFormat("FULL", LANG))),
            )
        );
        if (!empty($arFields)) {
            CSaleOrder::Update($arOrder["ID"], $arFields);
        }

        $response = [
            "status"         => "ok",
            "merchant_tx_id" => $arOrder['ID'],
        ];
    }
} else {
    $response = [
        "status"      => "error",
        "code"        => 401,
        "description" => "Некорректная подпись запроса",
    ];
}

$signature = getSignature(json_encode($response));
$signature = strtolower($signature);

header('X-Signature: '.$signature);
echo json_encode($response);

?>