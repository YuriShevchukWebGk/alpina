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
	"ACTIVE" => "Y"
);

$diffs = array();

$res = CIBlockElement::GetList(Array("PROPERTY_LASTORDER" => "DESC"), $filter, false, array(), $arSelect);

while ($ob = $res -> GetNextElement()) {
	$ob = $ob->GetFields();
	
	$filter = Array
	(
		"PROPERTY_VAL_BY_CODE_EMAIL"	=> $ob[NAME],
	);

	$orderList = CSaleOrder::GetList(array("ID" => "ASC"), $filter); // выбираем пользователей
	$is_filtered = $orderList->is_filtered; // отфильтрована ли выборка

	$allorders = 0; 


	while ($result = $orderList->Fetch()) {
		$allorders++;
		if ($allorders > 1) {
			$diffs[$allorders][] = round(abs(strtotime($result["DATE_INSERT"]) - strtotime($dateInsert))/86400);
		}
		$dateInsert = $result["DATE_INSERT"];
	}

}

$output = '<table><tbody><tr>';
$fp = fopen($_SERVER["DOCUMENT_ROOT"].'/custom-scripts/rfm/file_'.time().'.csv', 'w');
foreach ($diffs as $i => $diff) {
	if (count($diff) < 2)
		continue;
	
	fputcsv($fp, $diff, ';', '"');
	
	$output .= '<td><b>'.$i.'</b><br />';
	foreach ($diff as $one) {
		$output .= $one.'<br />';
	}
	$output .= '</td>';
	
}
fclose($fp);
$output .= '</tr></tbody></table>';


//echo $output;

//AddMessage2Log('Скрипт выполнен cron', 'update_rfm_new.php');

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>