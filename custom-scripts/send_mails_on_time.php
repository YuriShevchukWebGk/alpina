<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if ($USER->isAdmin()) {

    CModule::IncludeModule("blog");
    CModule::IncludeModule("iblock");
    CModule::IncludeModule("sale");
    CModule::IncludeModule("catalog");
    CModule::IncludeModule("main");
	
	/* I Проверяем даты собранных самовывозов */
	$arFilter = Array(
		"DELIVERY_ID" => "2",
		"@STATUS_ID" => array("C")
	);
	$rsSales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
	while ($arSales = $rsSales->Fetch())
	{
		echo "<pre>";
		if ((time() - strtotime($arSales[DATE_STATUS]))/86400 > 7 && (time() - strtotime($arSales[DATE_STATUS]))/86400 < 12)
			echo "Прошла неделя!";
		elseif ((time() - strtotime($arSales[DATE_STATUS]))/86400 >= 12)
			echo "Осталось два дня!";
		echo "</pre>";
	}
	
	/* II Проверяем даты отправленных пикпоинтов */
	$arFilter = Array(
		"DELIVERY_ID" => "17",
		"@STATUS_ID" => array("I")
	);
	$rsSales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
	while ($arSales = $rsSales->Fetch())
	{
	  echo "<pre>";
	  if ((time() - strtotime($arSales[DATE_STATUS]))/86400 > 7)
		  echo "Заказ выполнен! Спасибо!";
	  echo "</pre>";
	}
	
	/* III Проверяем даты отправленной почты по миру */
	$arFilter = Array(
		"DELIVERY_ID" => array(16,24,25,26,28),
		"@STATUS_ID" => array("I")
	);
	$rsSales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
	while ($arSales = $rsSales->Fetch())
	{
	  echo "<pre>";
	  if ((time() - strtotime($arSales[DATE_STATUS]))/86400 > 35)
		  echo "Заказ почтой по миру выполнен! Спасибо!";
	  echo "</pre>";
	}

	/* IV Проверяем даты отправленной Flippost */
	$arFilter = Array(
		"DELIVERY_ID" => "23",
		"@STATUS_ID" => array("I")
	);
	$rsSales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
	while ($arSales = $rsSales->Fetch())
	{
	  echo "<pre>";
	  if ((time() - strtotime($arSales[DATE_STATUS]))/86400 > 14)
		  echo "Заказ ФЛИПОМ выполнен! Спасибо!";
	  echo "</pre>";
	}
	
	/* V Заказ еще не оплачен, ждем */
	$arFilter = Array(
		"DELIVERY_ID" => array(10,11,16, 17, 23,24,25,26,28),
		"@STATUS_ID" => array("N", "O")
	);
	$rsSales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
	while ($arSales = $rsSales->Fetch())
	{
		echo "<pre>";
		if ((time() - strtotime($arSales[DATE_STATUS]))/86400 > 5 && (time() - strtotime($arSales[DATE_STATUS]))/86400 < 10)
			echo "Ждем оплату уже пять дней!";
		elseif ((time() - strtotime($arSales[DATE_STATUS]))/86400 >= 10)
			echo "Уже десять дней оплату ждем";
		echo "</pre>";
	}
	
	/* VI Спасибо за заказ почта по России */
	$arFilter = Array(
		"DELIVERY_ID" => array(10,11),
		"@STATUS_ID" => array("I")
	);
	$rsSales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
	while ($arSales = $rsSales->Fetch())
	{
		echo "<pre>";
		if ((time() - strtotime($arSales[DATE_STATUS]))/86400 > 20)
			echo "Спасибо за заказ Почтовый по России!";
		echo "</pre>";
	}
	$db_props = CSaleOrderProps::GetList(
        array("SORT" => "ASC"),
        array(
                "PERSON_TYPE_ID" => 2
            ),
        false,
        false,
        array("TRACKING_NUMBER")
    );
	
	$wsdlurl = 'https://tracking.russianpost.ru/rtm34?wsdl';
	$client2 = '';
	echo "123";
	$client2 = new SoapClient($wsdlurl, array('trace' => 1, 'soap_version' => "SOAP_1_2"));

	$params3 = array ('OperationHistoryRequest' => array ('Barcode' => '11172599146929', 'MessageType' => '0','Language' => 'RUS'),
					  'AuthorizationHeader' => array ('login'=>'reCbiSaKylFiDh','password'=>'VdbVsIc7dtuf'));
	echo "123";
	$result = $client2->getOperationHistory(new SoapParam($params3,'OperationHistoryRequest'));
	echo "123";
	foreach ($result->OperationHistoryData->historyRecord as $record) {
		printf("<p>%s </br>  %s, %s</p>",
		$record->OperationParameters->OperDate,
		$record->AddressParameters->OperationAddress->Description,
		$record->OperationParameters->OperAttr->Name);
	}

	
} else {
	echo "Not authorized";
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>