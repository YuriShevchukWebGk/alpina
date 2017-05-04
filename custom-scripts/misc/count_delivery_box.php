<?
$_SERVER["DOCUMENT_ROOT"] = '/home/bitrix/www';
//define("NO_KEEP_STATISTIC", true);
//define("NOT_CHECK_PERMISSIONS", true);
//define('SITE_ID', 's1');
//$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
//set_time_limit(0);
//define("LANG", "ru"); 
define('LOG_FILENAME', $_SERVER["DOCUMENT_ROOT"]."/custom-scripts/log.txt");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//if (AddMessage2Log('Скрипт выполнен', 'pickups.php'))?>
<html>
<body width="100%">
<?
if ($USER->isAdmin()) {
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

		$i = 0;
		$arFilter = Array(
			"DELIVERY_ID" => "49",
			"@STATUS_ID" => array("O"),
			/*"PERSON_TYPE_ID" => 1*/
			">=DATE_INSERT" => date("d.m.Y", mktime(0, 0, 0, date("m")  , date("d")-60, date("Y")))
		);
		$rsSales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
		$print .= '<b>'.$day.'</b><br />';
		while ($arSales = $rsSales->Fetch())
		{
			$i++;
			$print .= $arSales[ID].'<br />';
		}
		$count .= $i.'<br />';

	echo $count.'<br />'.$print;
} else {
	echo "Not authorized";
}

?>
</body>
</html>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>