<?
use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;
use Bitrix\Iblock;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$res = CIBlockElement::GetList(Array(), Array("ACTIVE"=>"Y","ID"=>$arResult['ID']), false, false, Array("TAGS"));
if ($el = $res->Fetch()) {
	$arResult['TAGS'] = $el["TAGS"];
}

function typonew($str){
	$pattern[0] = '/\s+(в|без|до|из|к|на|по|о|от|перед|при|через|с|у|и|нет|за|над|для|об|под|про|но|что|не|или|a|же|ну|так|уже|чем|хотя|вот|как|пока)\s+/i';
	$pattern[1] = '/(\s+|\&nbsp\;)(\—|\-)(\s+|\&nbsp\;)/i';
	$pattern[2] = '/(—|\(|\))(в|без|до|из|к|на|по|о|от|перед|при|через|с|у|и|нет|за|над|для|об|под|про|но|что|не|или|a|же|ну|так|уже|чем|хотя|вот|как|пока)\s+/i';
	$pattern[3] = '/(\s+|\&nbsp\;)(в|без|до|из|к|на|по|о|от|перед|при|через|с|у|и|нет|за|над|для|об|под|про|но|что|не|или|a|же|ну|так|уже|чем|хотя|вот|как|пока)(\s+|\&nbsp\;)(в|без|до|из|к|на|по|о|от|перед|при|через|с|у|и|нет|за|над|для|об|под|про|но|что|не|или|a|же|ну|так|уже|чем|хотя|вот|как|пока)(\s+|\&nbsp\;)/i';
	
	$replace[0] = ' \1&nbsp;';
	$replace[1] = '&nbsp;\2&nbsp;';
	$replace[2] = '\1\2&nbsp;';
	$replace[3] = '\1\2&nbsp;\4&nbsp;';

	
	return preg_replace($pattern, $replace, $str);
}
$description = substr(strip_tags($arResult["DETAIL_TEXT"]),0,160);

$APPLICATION->SetPageProperty("description", $description); 
?>