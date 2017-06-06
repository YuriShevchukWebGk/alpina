<?
@set_time_limit(0);
ignore_user_abort(true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");
global $USER;
if ($USER->IsAdmin()){
	$sale_books = array(
	0 => 8464,
	1 => 7837,
	2 => 7742,
	3 => 6996,
	4 => 8526,
	5 => 8476,
	6 => 8398,
	7 => 8034,
	8 => 8478,
	9 => 8426,
	10 => 8458,
	11 => 8218,
	12 => 8412,
	13 => 8432,
	14 => 8145,
	15 => 8206,
	16 => 7459,
	17 => 7825,
	18 => 6583,
	19 => 8149,
	20 => 7559,
	21 => 8212,
	22 => 8448,
	23 => 7746,
	24 => 8165,
	25 => 7849,
	26 => 7509,
	27 => 7754,
	28 => 8348,
	29 => 7851,
	30 => 8032,
	31 => 6607,
	32 => 6984,
	33 => 7487,
	34 => 7180,
	35 => 8342,
	36 => 8552,
	37 => 8452,
	38 => 8536,
	39 => 8540,
	40 => 66524
	);

	$rsOrder = CSaleOrder::GetList(array('ID' => 'DESC'), array('BASKET_PRODUCT_ID' => $sale_books, 'ID' >= 66031));

	while ($arOrder = $rsOrder->Fetch())
	{
		echo $arOrder[ID].'<br />';
	}
} 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>