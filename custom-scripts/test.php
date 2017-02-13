<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if(CModule::IncludeModule('iblock'))
{
$arFilter = Array("IBLOCK_ID"=>4, "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, Array("ID","NAME", "SHOW_COUNTER", "SHOW_COUNTER_START"));
while($ar_fields = $res->GetNext())
{
echo "У элемента ".$ar_fields[NAME]." ".round(($ar_fields[SHOW_COUNTER]/(((time() - strtotime($ar_fields[SHOW_COUNTER_START]))/3600/24)))*2)." показов<br>";}
}

?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>