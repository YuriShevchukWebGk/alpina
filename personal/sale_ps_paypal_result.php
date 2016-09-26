<?  
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("PayPal");  
?><?if (!$USER->IsAuthorized()) {
    header("location: profile/"); 
} else {?><?$APPLICATION->IncludeComponent(
	"bitrix:sale.order.payment.receive", 
	"", 
	array(
		"PAY_SYSTEM_ID_NEW" => "16"
	),
	false
);?> <?}?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>