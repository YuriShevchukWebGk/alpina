<?
@set_time_limit(0);
ignore_user_abort(true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");
global $USER;
if ($USER->IsAdmin()){
	$sale_books = array(
75273,
8380,
7704,
60925,
6649,
8696,
8476,
8522,
7815,
8430,
8159,
8155,
8666,
7399,
8398,
7724,
78102,
8320,
75968,
8660,
75436,
8528,
68989,
67827,
8298,
80484,
66460,
79730,
8438,
8570,
8684,
7785,
69020,
7481,
7897,
6998,
8454,
8446,
7918,
6837,
76690,
80473,
70007,
75330,
8480,
8562,
83139,
8402,
8292,
75264,
8290,
8852,
7071,
7990,
8026,
8790,
8738,
6305,
7752,
8466,
8085,
6910,
7467,
7641,
8186,
8246
	);

	$rsOrder = CSaleOrder::GetList(array('ID' => 'DESC'), array('BASKET_PRODUCT_ID' => $sale_books, 'ID' >= 72978));

	while ($arOrder = $rsOrder->Fetch())
	{
		echo $arOrder[ID].'<br />';
	}
} 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>