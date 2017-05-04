<?
@set_time_limit(0);
ignore_user_abort(true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");
global $USER;
if ($USER->IsAdmin()){
	$sale_books = array(
		8165,
		8454,
		8446,
		8712,
		8254,
		8246,
		66427,
		8698,
		8434,
		8242,
		8175,
		8314,
		8194,
		8460,
		66487,
		8402,
		8584,
		7819,
		8756,
		8714,
		8382,
		8594,
		8278,
		8101,
		65392,
		8650,
		8085,
		8464,
		8177,
		8784,
		8752,
		8410,
		8598,
		8093,
		5609,
		8516,
		8760,
		8624,
		66435,
		7718,
		8696,
		7893,
		8856,
		60907,
		66516,
		7833,
		6908,
		8654,
		8700,
		8228,
		7887,
		8149,
		8470
	);

	$rsOrder = CSaleOrder::GetList(array('ID' => 'DESC'), array('BASKET_PRODUCT_ID' => $sale_books, 'ID' >= 68036));

	while ($arOrder = $rsOrder->Fetch())
	{
		echo $arOrder[ID].'<br />';
	}
} 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>