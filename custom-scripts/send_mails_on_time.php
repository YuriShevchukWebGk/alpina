<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if ($USER->isAdmin()) {

    CModule::IncludeModule("blog");
    CModule::IncludeModule("iblock");
    CModule::IncludeModule("sale");
    CModule::IncludeModule("catalog");
    CModule::IncludeModule("main");
	
	/***************
	* Получаем телефон из заказа
	*************/

	function getPhone($id){
		$db_props = CSaleOrderPropsValue::GetOrderProps($id);
		while ($arProps = $db_props->Fetch()){
			if($arProps['CODE']=='PHONE'){
				$clearedPhone = preg_replace('/[^0-9+]/','',$arProps['VALUE']);
				return $clearedPhone;
			}
		}
	}

	/***************
	* Получаем имя клиента из заказа
	*************/

	function getClientName($id){
		$db_props = CSaleOrderPropsValue::GetOrderProps($id);
		while ($arProps = $db_props->Fetch()){
			if($arProps['CODE']=='F_CONTACT_PERSON'){
				return $arProps['VALUE'];
			}
		}
	}

	/***************
	* Получаем email клиента из заказа
	*************/

	function getClientEmail($id){
		$db_props = CSaleOrderPropsValue::GetOrderProps($id);
		while ($arProps = $db_props->Fetch()){
			if($arProps['CODE']=='EMAIL'){
				return $arProps["VALUE"];
			}
		}
	}	
	
	/***************
	* Отправляем большой эмэйл
	*************/

	function sendNotificationEmail($id,$subject,$notification,$userID) {
		$arEventFields = array(
			"EMAIL" => "a-marchenkov@yandex.ru", //getClientEmail($id),
			"ORDER_USER" => getClientName($id),
			"ORDER_ID" => $id,
			"SUBJECT" => $subject,
			"NOTIFICATION" => $notification
		);				
		CEvent::Send("ON_TIME_NOTIFICATIONS", "s1", $arEventFields,"N");
		
		$arFields = array(
			"EMP_STATUS_ID" => $userID
		);
		CSaleOrder::Update($id, $arFields);		
	}
	
	$userID1 = 15;
	$userID2 = 16;
	
	/* I Проверяем даты собранных самовывозов */
	$arFilter = Array(
		"DELIVERY_ID" => "2",
		"@STATUS_ID" => array("C")
	);
	$rsSales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
	while ($arSales = $rsSales->Fetch())
	{
		$id = $arSales["ID"];
		if ((time() - strtotime($arSales[DATE_STATUS]))/86400 > 7 && (time() - strtotime($arSales[DATE_STATUS]))/86400 < 12 && $arSales["EMP_STATUS_ID"] != $userID1) {
			
			$subject = 'Заказ №'.$id.' уже неделю ждет Вас';
			$notification = 'Ваш заказ №'.$id.' собран и находится в офисе интернет-магазина. Ждем вас!';
			$result = sendNotificationEmail($id, $subject, $notification, $userID1);
			
		} elseif ((time() - strtotime($arSales[DATE_STATUS]))/86400 >= 12 && $arSales["EMP_STATUS_ID"] != $userID2) {
			$subject = 'Через два дня заказ будет расформирован';
			$notification = 'Ваш заказ №'.$id.' собран и будет находиться в офисе интернет-магазина еще два дня. Ждем вас!';
			$result = sendNotificationEmail($id, $subject, $notification, $userID2);		
		}
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
		$id = $arSales["ID"];
		if ((time() - strtotime($arSales[DATE_STATUS]))/86400 > 5 && (time() - strtotime($arSales[DATE_STATUS]))/86400 < 10 && $arSales["EMP_STATUS_ID"] != $userID1) {
			$subject = 'Заказ №'.$id.' ожидает оплаты';
			$notification = 'По заказу №'.$id.' пока не поступила оплата.';
			$result = sendNotificationEmail($id, $subject, $notification, $userID1);
		} elseif ((time() - strtotime($arSales[DATE_STATUS]))/86400 >= 10 && $arSales["EMP_STATUS_ID"] != $userID2) {
			$subject = 'Заказ №'.$id.' ожидает оплаты';
			$notification = 'По заказу №'.$id.' пока не поступила оплата.';
			$result = sendNotificationEmail($id, $subject, $notification, $userID2);
		}
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
	


	
} else {
	echo "Not authorized";
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>