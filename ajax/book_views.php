<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
?>
<?
if ($_REQUEST["id"])
{
	$arSelect = Array(
		"PROPERTY_page_views_ga"
		);
		
	$arFilter = Array("IBLOCK_ID"=>4,"ID"=>$_REQUEST["id"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
	
	$book = array();

	while($ob = $res->GetNextElement()){
		$arFields = $ob->GetFields();
		$book["VIEWS"] 			= $arFields['PROPERTY_PAGE_VIEWS_GA_VALUE'];
	}

	echo $book["VIEWS"];
}
?>