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
	"NAME",
	"PROPERTY_BOOK_ID",
	"PROPERTY_SUB_EMAIL",
	"CREATED_DATE"
);

$filter = array(
	"IBLOCK_ID" => 41,
	"ACTIVE" => "Y",
	">DATE_CREATE" => "10.04.2017",
	">PROPERTY_BOOK_ID" => 1
	
);

$final = array();

$res = CIBlockElement::GetList(Array("PROPERTY_LASTORDER" => "DESC"), $filter, false, array(), $arSelect);

while ($ob = $res -> GetNextElement()) {
	$ob = $ob->GetFields();
	$final[$ob["PROPERTY_SUB_EMAIL_VALUE"]]['mail'] = $ob["PROPERTY_SUB_EMAIL_VALUE"];
	if (empty($final[$ob["PROPERTY_SUB_EMAIL_VALUE"]]['ids']))
		$final[$ob["PROPERTY_SUB_EMAIL_VALUE"]]['ids'] = array();
	array_push($final[$ob["PROPERTY_SUB_EMAIL_VALUE"]]['ids'],$ob["PROPERTY_BOOK_ID_VALUE"]);
}
echo '<pre>';
print_r($final);
echo '</pre>';

$mails = array(
	"a.marchenkov@alpinabook.ru",
	"ouliana.essaoulkova@gmail.com",
	"samsonovea@bk.ru"
);
	
foreach ($mails as $mail) {
	$arSelect = array(
		"ID",
		"NAME"
	);
	
	$filter = array(
		"IBLOCK_ID" => 67,
		"ACTIVE" => "Y",
		"NAME" => $mail,
		"PROPERTY_BOOKSCHAPTERS" => false
	);

	$res = CIBlockElement::GetList(Array("PROPERTY_LASTORDER" => "DESC"), $filter, false, array(), $arSelect);

	if ($ob = $res -> GetNextElement()) {
		$ob = $ob->GetFields();
		echo '<pre>';
		print_r($ob);
		echo '</pre>';
	}
}
echo '<br />done!';

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>