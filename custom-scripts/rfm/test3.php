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

$page = 1;

for ($segment = 1; $segment < 5; $segment++) {
	echo '<br /><b>';
	echo $page;
	echo '</b><br />';

	$dateArray = array(
		1 => array(
			date('Y-m-d', strtotime('-30 days')),
			date('Y-m-d', strtotime('-1000 days')),
		),
		2 => array(
			date('Y-m-d', strtotime('-90 days')),
			date('Y-m-d', strtotime('-1000 days')),
		),
		3 => array(
			date('Y-m-d', strtotime('-250 days')),
			date('Y-m-d', strtotime('-1000 days')),
		),
		4 => array(
			date('Y-m-d', strtotime('-500 days')),
			date('Y-m-d', strtotime('-1000 days')),
		)
	);
	
	$arSelect = array(
		"ID",
		"NAME",
		"TIMESTAMP_X",
		"PROPERTY_RECENCY",
		"PROPERTY_LASTORDER"
	);
	
	$filter = array(
		"IBLOCK_ID" => 67,
		"ACTIVE" => "Y",
		"PROPERTY_RECENCY" => $segment,
		"<PROPERTY_LASTORDER" => $dateArray[$segment][0],
		">PROPERTY_LASTORDER" => $dateArray[$segment][1]
	);

	$countMax = CIBlockElement::GetList(['PROPERTY_LASTORDER' => 'DESC'], $filter, [],    false, ['ID']);
	
	echo $countMax.'<br />';
	
	echo '<pre>';
	print_r($dateArray[$segment]);
	echo '</pre>';

	$res = CIBlockElement::GetList(Array("PROPERTY_LASTORDER" => "DESC"), $filter, false, array(), $arSelect);

	while ($ob = $res -> GetNextElement()) {
		$ob = $ob->GetFields();
		
		$date1 = strtotime($ob[PROPERTY_LASTORDER_VALUE]);
		$date2 = strtotime('today');
		$datediff = round(abs($date1 - $date2)/86400);
	
		//Recency
		if ($datediff >= 501)
			$recency = 5;
		elseif ($datediff >= 251)
			$recency = 4;
		elseif ($datediff >= 91)
			$recency = 3;
		elseif ($datediff >= 31)
			$recency = 2;
		elseif ($datediff < 31)
			$recency = 1;	
		else {
			$recency = 0;	
			echo "Проблема<br />";
		}

		CIBlockElement::SetPropertyValuesEx($ob[ID], 67, array('RECENCY' => $recency));
		echo $ob['PROPERTY_RECENCY_VALUE'].' - '.$datediff.' - '.$recency.' - '.$ob['NAME'].'<br />';
	}
	
	$page++;
}

echo '<br />done!';
echo date('d.m.Y H:i:s', strtotime('-6 hours'));
//AddMessage2Log('Скрипт выполнен cron', 'update_rfm_new.php');

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>