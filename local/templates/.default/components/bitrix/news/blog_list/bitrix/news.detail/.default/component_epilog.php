<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
use Bitrix\Main\Loader;
global $APPLICATION;

$title = $arResult["NAME"];
$title .= ' — блог издательства «Альпина Паблишер»'; 
$description = substr(strip_tags($arResult["DETAIL_TEXT"]),0,160);
$APPLICATION -> SetPageProperty("title", $title);
$APPLICATION -> SetPageProperty("description", $description); 
//$APPLICATION->ShowMeta("description");

?>