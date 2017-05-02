<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

global $APPLICATION; 
$APPLICATION->IncludeComponent(
    "webgk:rfi.widget",
    "",
    Array(
        "ORDER_ID"      => "CERT_",
        "OTHER_PAYMENT" => "Y",
        "OTHER_PARAMS"  => array(
            "PAYSUM"   => $_REQUEST['quantity'] * $_REQUEST['price'],
            "EMAIL"    => "",
            "PHONE"    => "",
            "COMMENT"  => str_replace("#SUM#", $_REQUEST['quantity'] * $_REQUEST['price'], "Покупка сертификата на сайте alpinabook.ru на сумму #SUM# рублей")
        )
    ),
    false
); 
?>