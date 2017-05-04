#!/usr/bin/php
<?php
$_SERVER["DOCUMENT_ROOT"] = '/home/bitrix/www';
define('LOG_FILENAME', $_SERVER["DOCUMENT_ROOT"]."/custom-scripts/log.txt");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
AddMessage2Log('Скрипт выполнен cron', 'checkbooks.php');?>

<html>
<body width="100%">
<?
CModule::IncludeModule("blog");
CModule::IncludeModule("iblock");
CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");
CModule::IncludeModule("main");

$days = array();

for ($g = 0; $g < 7; $g++) {
	$days[] = date("d.m.Y", mktime(0, 0, 0, date("m")  , date("d")+$g, date("Y")));
}
$print = '';
$count = '';


foreach ($days as $day) {
	$i = 0;
	$arFilter = Array(
		/*"DELIVERY_ID" => "2",
		"@STATUS_ID" => array("N", "O", "D"),
		"PERSON_TYPE_ID" => 1*/
		">=DATE_INSERT" => date("d.m.Y", mktime(0, 0, 0, date("m")  , date("d")-60, date("Y"))),
		"PROPERTY_VAL_BY_CODE_DELIVERY_DATE" => $day
	);
	$rsSales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
	$print .= '<b>'.$day.'</b><br />';
	while ($arSales = $rsSales->Fetch())
	{
		$i++;
		$print .= $arSales[ID].'<br />';
	}
	$count .= $day.' - '.$i.'<br />';
}
echo $count.'<br />'.$print;
?>
</body>
</html>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>