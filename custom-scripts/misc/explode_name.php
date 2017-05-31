<?
@set_time_limit(0);
ignore_user_abort(true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
global $USER;
if ($USER->IsAdmin()){

$arSelect = Array("ID", "NAME");
$arFilter = Array("IBLOCK_ID"=>4);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>9999), $arSelect);

while($ob = $res->GetNext()) {
	$twoparts = explode(':',$ob["NAME"]);
	
	if (count($twoparts) == 2) {
		CIBlockElement::SetPropertyValuesEx($ob['ID'], 4, array('SHORT_NAME' => $twoparts[0], 'SECOND_NAME' => ltrim($twoparts[1])));
	} elseif (count($twoparts) > 2) {
		echo count($twoparts).'*'.$ob["ID"].'*'.$ob["NAME"].'<br />';
		CIBlockElement::SetPropertyValuesEx($ob['ID'], 4, array('SHORT_NAME' => $twoparts[0], 'SECOND_NAME' => ltrim($twoparts[1].': '.$twoparts[2])));
	}
}

}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>