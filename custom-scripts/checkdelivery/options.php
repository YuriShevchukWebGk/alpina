<?
######
######
## Устанавливаем ограничение, после которого день доставки автоматически переключается
######
######


$limit = 50; //Максимальное количество заказов
$weekend = false; //Если вдруг доставляем в выходные, то поменять на true

$holidaysArray = array( //Указываем даты праздничных дней
'check',
'23.02.2018',
'08.03.2018',
'09.03.2018',
'29.04.2018',
'01.05.2018',
'02.05.2018',
'09.05.2018',
'11.06.2018',
'12.06.2018',
'05.11.2018',
'31.12.2018',
);

$holidaysString = array( //Указываем даты праздничных дней
'23.2.2018',
'8.3.2018',
'9.3.2018',
'29.4.2018',
'1.5.2018',
'2.5.2018',
'9.5.2018',
'11.6.2018',
'12.6.2018',
'5.11.2018',
'31.12.2018',
);

$setProps = array();
$setProps['nextDay'] = 1;

$days = array();

for ($g = 1; $g < 15; $g++) {
    $days[] = date("d.m.Y", mktime(0, 0, 0, date("m")  , date("d")+$g, date("Y")));
}

foreach ($days as $no => $day) {
    $i = 0;
    $arFilter = Array(
        ">=DATE_INSERT" => date("d.m.Y", mktime(0, 0, 0, date("m")  , date("d")-60, date("Y"))),
        "PROPERTY_VAL_BY_CODE_DELIVERY_DATE" => $day,
        "!STATUS_ID" => array("PR","F","A","I")
    );
    $rsSales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
    while ($arSales = $rsSales->Fetch()) {
        $i++;
    }
	
    if ($i >= $limit && $no > 0) {
        $setProps['nextDay']++;
    } else {
		break;
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

    if (array_search($setProps['deliveryDate'], $holidaysArray)) {
        $setProps['nextDay']++;
        $dateIsSet = false;
    }


    $setProps['deliveryDate'] = date("d.m.Y", mktime(0, 0, 0, date("m")  , date("d") + $setProps['nextDay'], date("Y")));

    $o = 0;

    $arFilter = Array(
        ">=DATE_INSERT" => date("d.m.Y", mktime(0, 0, 0, date("m")  , date("d")-60, date("Y"))),
        "PROPERTY_VAL_BY_CODE_DELIVERY_DATE" => $setProps['deliveryDate'],
        "!STATUS_ID" => array("PR","F","A","I")
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

$holidays = implode(',',$holidaysString);

if ($setProps['nextDay'] == 1)
    $setProps['deliveryDayName'] = "завтра";
?>