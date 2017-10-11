<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?><?

include(GetLangFileName(dirname(__FILE__)."/", "/payment.php"));

$psTitle = GetMessage("SPCP_DTITLE");
$psDescription = GetMessage("SPCP_DDESCR");

$arPSCorrespondence = array(
    "MERCHANT_ID" => array(
        "NAME" => GetMessage("SALE_MERCHANT_ID"),
        "DESCR" => GetMessage("SALE_MERCHANT_ID_DESC"),
        "VALUE" => "",
        "TYPE" => ""
    ),
    "SKEY" => array(
        "NAME" => GetMessage("SALE_SKEY"),
        "DESCR" => "",
        "VALUE" => "",
        "TYPE" => ""
    ),
    "URL" => array(
        "NAME" => GetMessage("SALE_URL"),
        "DESCR" => "",
        "VALUE" => "",
        "TYPE" => ""
    ),
    "PATH_TO_RESULT_URL" => array(
        "NAME" => GetMessage("SALE_PATH_TO_RESULT_URL"),
        "DESCR" => GetMessage("SALE_PATH_TO_RESULT_URL_DESC"),
        "VALUE" => "http://" . $_SERVER["HTTP_HOST"] . "/personal/order/",
        "TYPE" => ""
    ),
    "PAYMENT_ID" => array(
        "NAME" => GetMessage("SALE_ORDER_ID"),
        "DESCR" => "",
        "VALUE" => "ID",
        "TYPE" => "PAYMENT"
    ),
    "CURRENCY" => array(
        "NAME" => GetMessage("SALE_CURRENCY"),
        "DESCR" => "",
        "VALUE" => "CURRENCY",
        "TYPE" => "PAYMENT"
    ),
    "PAYMENT_SUM" => array(
        "NAME" => GetMessage("SALE_PAYMENT_SUM"),
        "DESCR" => "",
        "VALUE" => "SUM",
        "TYPE" => "PAYMENT"
    ),
    "PHONE" => array(
        "NAME" => GetMessage("SALE_PHONE"),
        "DESCR" => "",
        "VALUE" => "PHONE",
        "TYPE" => "PROPERTY"
    ),
    "EMAIL" => array(
        "NAME" => GetMessage("SALE_EMAIL"),
        "DESCR" => "",
        "VALUE" => "EMAIL",
        "TYPE" => "PROPERTY"
    ),
    "PROJECT" => array(
        "NAME" => GetMessage("SALE_PROJECT"),
        "DESCR" => "",
        "VALUE" => "",
        "TYPE" => ""
    ),
);
?>
