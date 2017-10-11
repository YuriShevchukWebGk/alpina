<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

require_once dirname(__FILE__)."/functions.php";
//@codingStandardsIgnoreLine
include GetLangFileName(dirname(__FILE__)."/", "/payment.php");

$merchantId = CSalePaySystemAction::GetParamValue("MERCHANT_ID");
$skey       = CSalePaySystemAction::GetParamValue("SKEY");
$url        = CSalePaySystemAction::GetParamValue("URL");

$resultUrl = CSalePaySystemAction::GetParamValue("PATH_TO_RESULT_URL");

$orderID  = (strlen(CSalePaySystemAction::GetParamValue("PAYMENT_ID")) > 0) ? CSalePaySystemAction::GetParamValue(
    "PAYMENT_ID"
) : $GLOBALS["SALE_INPUT_PARAMS"]["PAYMENT"]["ID"];
$currency = (strlen(CSalePaySystemAction::GetParamValue("CURRENCY")) > 0) ? CSalePaySystemAction::GetParamValue(
    "CURRENCY"
) : $GLOBALS["SALE_INPUT_PARAMS"]["ORDER"]["CURRENCY"];
$phone    = CSalePaySystemAction::GetParamValue("PHONE");
$email    = CSalePaySystemAction::GetParamValue("EMAIL");
$project  = CSalePaySystemAction::GetParamValue("PROJECT");

?>
<?= GetMessage("PAYMENT_DESCRIPTION_PS") ?><br/><br/>
<?= GetMessage("PAYMENT_DESCRIPTION_SUM") ?>: <b>
    <?php
    echo CurrencyFormat(
        CSalePaySystemAction::GetParamValue("PAYMENT_SUM"),
        $currency
    )
    ?>
</b><br/><br/>
<?php
$currency = getCorrectCurrency($currency);

$tx = [
    "project"      => $project,
    "merchant_id"  => $merchantId,
    "redirect_url" => $resultUrl,
    "amount"       => (string) round(CSalePaySystemAction::GetParamValue("PAYMENT_SUM") * 100.0),
    "account"      => json_encode(["id" => $email]),
    "currency"     => $currency,
    "order"        => json_encode(["type" => "order_id", "order_id" => (string) $orderID]),
];
ksort($tx);
$tx['sign'] = getSignature(json_encode($tx));

?>
<form action="<?php echo $url ?>" method="get" enctype="application/json">
    <?php
    foreach ($tx as $key => $value) {
        echo '<input type="hidden" name=\''.$key.'\' value=\''.$value.'\'/>';
    }
    ?>
    <input type="submit" value="<?= GetMessage("PAYMENT_PAY") ?>"/>
</form>
