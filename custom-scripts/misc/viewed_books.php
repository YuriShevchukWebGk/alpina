<?
@set_time_limit(0);
ignore_user_abort(true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");
global $USER;
	
$db_res = CSaleViewedProduct::GetList(
array("DATE_VISIT" => "DESC"),
array("FUSER_ID" => CSaleBasket::GetBasketUserID()),
false,
array("nTopCount" => 20)
);

while ($test = $db_res->GetNext()) {
	echo '<pre>';
	print_r($test);
	echo '</pre>';
}

echo 'done!';
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>