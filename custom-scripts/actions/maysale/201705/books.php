<?
@set_time_limit(0);
ignore_user_abort(true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");
global $USER;
if ($USER->IsAdmin()){
	$sale_books = array(
8412,
8143,
7819,
8578,
8206,
7746,
8440,
8752,
60919,
8710,
8448,
8212,
6607,
8352,
8024,
8546,
7032,
7962,
60931,
8858,
8386,
8502,
8426,
7799,
7932,
67413,
7952,
60907,
8356,
75688,
67906,
60925,
8151,
69015,
7893,
67424,
89560,
8848,
7871,
8596,
69970,
7595,
8040,
8165,
8856,
8798,

	);

	$rsOrder = CSaleOrder::GetList(array('ID' => 'DESC'), array('BASKET_PRODUCT_ID' => $sale_books, 'ID' >= 68036));

	while ($arOrder = $rsOrder->Fetch())
	{
		echo $arOrder[ID].'<br />';
	}
} 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>