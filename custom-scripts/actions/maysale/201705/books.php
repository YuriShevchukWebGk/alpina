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
	
	$filter = array(
		'BASKET_PRODUCT_ID' => $sale_books,
		">=DATE_INSERT" => "02.05.2017 12:30:00",
		"<DATE_INSERT" => "09.05.2017 23:59:59",
	);
	
	$rsOrder = CSaleOrder::GetList(array('ID' => 'DESC'), $filter);
	
	$orders = array();
	while ($arOrder = $rsOrder->Fetch())
	{
		$orders[] = $arOrder[ID];
	}
	$orders = array_unique($orders);
	
	echo '<b>'.count($orders).'</b><br />';
	
	foreach($orders as $id) {
		echo $id.',<br />';
	}
	
	
} 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>