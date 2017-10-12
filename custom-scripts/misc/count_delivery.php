<?
setlocale(LC_ALL, 'ru_RU');
$_SERVER["DOCUMENT_ROOT"] = '/home/bitrix/www';
define('LOG_FILENAME', $_SERVER["DOCUMENT_ROOT"]."/custom-scripts/log.txt");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>
<html>
<body width="100%">
<?
$userGroup = CUser::GetUserGroup($USER->GetID());
if ($USER->isAdmin() || in_array(6,$userGroup)) {
	$holidays = array( //Указываем даты праздничных дней
	'check',
	'01.05.2017',
	'08.05.2017',
	'09.05.2017',
	'06.11.2017',
	);
	$days = array();
	
	for ($g = 0; $g < 15; $g++) {
		$days[$g]['n'] = date("d.m.Y", mktime(0, 0, 0, date("m")  , date("d")+$g, date("Y")));
		$days[$g]['w'] = date("w", mktime(0, 0, 0, date("m")  , date("d")+$g, date("Y")));
	}
	$print = '';
	$count = '';


	foreach ($days as $no => $day) {
		$i = 0;
		$arFilter = Array(
			">=DATE_INSERT" => date("d.m.Y", mktime(0, 0, 0, date("m")  , date("d")-60, date("Y"))),
			"PROPERTY_VAL_BY_CODE_DELIVERY_DATE" => $day['n'],
			"!STATUS_ID" => array("F","PR")
		);
		$rsSales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);

		$print .= '<b>'.$day['n'].'</b><br />';
		while ($arSales = $rsSales->Fetch())
		{
			$i++;
			$print .= $arSales[ID].'<br />';
		}
		
		if ($day['w'] == 6 || $day['w'] == 0 || array_search($day['n'], $holidays))
			$count .= '<span style="color:red;font-weight:700">'.$day['n'].' - '.$i.'</span><br />';
		else
			$count .= $day['n'].' - '.$i.'<br />';

	}
	
	echo $count.'<br />'.$print;
	
} else {
	echo "Not authorized";
}

?>
</body>
</html>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>