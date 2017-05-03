<?
@set_time_limit(0);
ignore_user_abort(true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");
global $USER;
if ($USER->IsAdmin()){
	$filter = array(
		"<=ID" => 75528,
		">=DATE_INSERT" => "04.10.2016",
		"PAYED" => "Y"
	);
	$rsOrder = CSaleOrder::GetList(array('ID' => 'DESC'), $filter);

	while ($arOrder = $rsOrder->Fetch())
	{
		echo $arOrder[ID].'<br />';
	}
} 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>