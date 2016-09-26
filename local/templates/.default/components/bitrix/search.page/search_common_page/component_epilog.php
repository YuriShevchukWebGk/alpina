<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
use Bitrix\Main\Loader;
global $APPLICATION;

$title = 'Результаты поиска — Альпина Паблишер';
$description = 'Результаты поиска на сайте Альпина Паблишер';
   
if (!empty ($title) )  {
    $APPLICATION -> SetPageProperty("title", $title);
	$APPLICATION -> SetPageProperty("description", $description); 
}
?>