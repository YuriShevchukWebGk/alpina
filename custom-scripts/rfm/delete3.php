<?
set_time_limit(0);
ini_set('max_execution_time', 0);
$_SERVER["DOCUMENT_ROOT"] = '/home/bitrix/www';
define('LOG_FILENAME', $_SERVER["DOCUMENT_ROOT"]."/custom-scripts/log.txt");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER;
include($_SERVER["DOCUMENT_ROOT"]."/custom-scripts/rfm/functions.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("sale");

$arSelect = array(
	"ID",
	"NAME"
);

$filter = array(
	"IBLOCK_ID" => 67,
	"!PROPERTY_SOURCE" => 913
);

//$res = CIBlockElement::GetList(Array("PROPERTY_LASTORDER" => "DESC"), $filter, false, array(), $arSelect);
$countMax = CIBlockElement::GetList(['ID' => 'ASC'], $filter, [],    false, ['ID']);

$res = CIBlockElement::GetList(Array(), $filter, false, array(), $arSelect);

echo $countMax;

while ($ob = $res -> GetNextElement()) {
	$ob = $ob->GetFields();
	//CIBlockElement::Delete($ob["ID"]);
}

echo '<br />done!';

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>