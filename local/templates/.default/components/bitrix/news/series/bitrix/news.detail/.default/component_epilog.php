<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
use Bitrix\Main\Loader;
global $APPLICATION;

$title = 'Серия книг «'.$arResult["NAME"].'» в интернет-магазине Альпина Паблишер';
   
if (!empty ($title) )  {
    $APPLICATION -> SetPageProperty("title", $title);
}
?>