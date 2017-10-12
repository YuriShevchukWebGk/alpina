<?
######
######
## Устанавливаем ограничение, после которого день доставки автоматически переключается
######
######

$limit = 20; //Максимальное количество заказов
$weekend = false; //Если вдруг доставляем в выходные, то поменять на true

$holidays = array( //Указываем даты праздничных дней
'check',
'23.05.2017',
'19.05.2017',
'22.05.2017',
'11.05.2017',
'30.08.2017',
'01.09.2017',
'10.10.2017',
'06.11.2017',
);

$setProps = array();
$setProps['nextDay'] = 1;

$days = array();

for ($g = 0; $g < 15; $g++) {
	$days[] = date("d.m.Y", mktime(0, 0, 0, date("m")  , date("d")+$g, date("Y")));
}

foreach ($days as $no => $day) {
	$i = 0;
	$arFilter = Array(
		">=DATE_INSERT" => date("d.m.Y", mktime(0, 0, 0, date("m")  , date("d")-60, date("Y"))),
		"PROPERTY_VAL_BY_CODE_DELIVERY_DATE" => $day,
		"!STATUS_ID" => "PR"
	);
	$rsSales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
	while ($arSales = $rsSales->Fetch()) {
		$i++;
	}
	
	if ($i >= $limit && $no > 0) {
		$setProps['nextDay']++;
	}
}

$dateIsSet = false;

while (!$dateIsSet) {
	$setProps['deliveryDayNumber'] = date("w", mktime(0, 0, 0, date("m")  , date("d") + $setProps['nextDay'], date("Y")));

	if (!$weekend && ($setProps['deliveryDayNumber'] == 6 || $setProps['deliveryDayNumber'] == 0)) {
		if ($setProps['deliveryDayNumber'] == 6)
			$setProps['nextDay'] = $setProps['nextDay'] + 2;
		else
			$setProps['nextDay']++;
		$setProps['deliveryDayNumber'] = 1;
	}

	$setProps['deliveryDate'] = date("d.m.Y", mktime(0, 0, 0, date("m")  , date("d") + $setProps['nextDay'], date("Y")));
	
	$dateIsSet = true;
	
	if (array_search($setProps['deliveryDate'], $holidays)) {
		$setProps['nextDay']++;
		$dateIsSet = false;
	}
	
	
	$setProps['deliveryDate'] = date("d.m.Y", mktime(0, 0, 0, date("m")  , date("d") + $setProps['nextDay'], date("Y")));
	
	$o = 0;
	
	$arFilter = Array(
		">=DATE_INSERT" => date("d.m.Y", mktime(0, 0, 0, date("m")  , date("d")-60, date("Y"))),
		"PROPERTY_VAL_BY_CODE_DELIVERY_DATE" => $setProps['deliveryDate'],
		"!STATUS_ID" => "PR"
	);
	$rsSales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
	while ($arSales = $rsSales->Fetch()) {
		$o++;
	}
	
	if ($o >= $limit) {
		$setProps['nextDay']++;
		$dateIsSet = false;
	}
}

if ($setProps['nextDay'] > 4) {
	$setProps['deliveryDayName'] = $setProps['deliveryDate'];
} else {
	switch ($setProps['deliveryDayNumber']) {
		case 1:
			$setProps['deliveryDayName'] = "в понедельник";
			break;
		case 2:
			$setProps['deliveryDayName'] = "во вторник";
			break;
		case 3:
			$setProps['deliveryDayName'] = "в среду";
			break;
		case 4:
			$setProps['deliveryDayName'] = "в четверг";
			break;
		case 5:
			$setProps['deliveryDayName'] = "в пятницу";
			break;
		case 6:
			$setProps['deliveryDayName'] = "в субботу";
			break;
		case 0:
			$setProps['deliveryDayName'] = "в воскресенье";
			break;
	}
}

if ($setProps['nextDay'] == 1)
	$setProps['deliveryDayName'] = "завтра";
?>