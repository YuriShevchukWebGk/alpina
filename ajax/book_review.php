<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale"); CModule::IncludeModule("catalog"); CModule::IncludeModule("iblock");
?>
<?
if ($_REQUEST["id"])
{
	$arSelect = Array(
		"NAME",
		"DETAIL_PAGE_URL",
		"DETAIL_PICTURE",
		"PREVIEW_TEXT",
		"DETAIL_TEXT"
		);
	$arFilter = Array("IBLOCK_ID"=>24,"ID"=>$_REQUEST["id"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
 

	while($ob = $res->GetNextElement()){
		$arFields = $ob->GetFields();
		print_r($arFields);
	}
}
?>