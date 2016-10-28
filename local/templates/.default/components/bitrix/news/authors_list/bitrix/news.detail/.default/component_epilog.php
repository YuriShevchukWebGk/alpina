<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
use Bitrix\Main\Loader;
global $APPLICATION;

$title = $arResult["NAME"]. ' — все книги '.$arResult["PROPERTIES"]["ALT_NAME"]["VALUE"];
$title .= !empty($arResult["PROPERTIES"]["ORIG_NAME"]["VALUE"]) ? " (".$arResult["PROPERTIES"]["ORIG_NAME"]["VALUE"].")" : "";
$title .= ' и биография автора в интернет-магазине Альпина Паблишер'; 
$description = htmlspecialchars(substr($arResult["PROPERTIES"]["AUTHOR_DESCRIPTION"]["VALUE"]["TEXT"],0,160));
   
if (!empty ($title) )  {
    $APPLICATION -> SetPageProperty("title", $title);
	$APPLICATION -> SetPageProperty("description", $description); 
}
?>