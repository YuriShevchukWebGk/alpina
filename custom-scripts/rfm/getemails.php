<?
@set_time_limit(0);
ignore_user_abort(true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");
global $USER;

function getClientEmail($id){
	$db_props = CSaleOrderPropsValue::GetOrderProps($id);
	while ($arProps = $db_props->Fetch()){
		if($arProps['CODE']=='EMAIL'){
			return $arProps["VALUE"];
		}
	}
}

if ($USER->IsAdmin()){

	$filter = Array
	(
		">=DATE_INSERT" => "01.01.2009",
		"<DATE_INSERT" => "01.01.2011"
	);
	
	$orderList = CSaleOrder::GetList(array("ID" => "ASC"), $filter);
	$is_filtered = $orderList->is_filtered; // отфильтрована ли выборка

	while ($result = $orderList->Fetch()) {
		echo getClientEmail($result["ID"]).'<br />';
	}

	echo 'done!<br /><br />';

}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>