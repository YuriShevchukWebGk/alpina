<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if ($USER->isAdmin()) {

    CModule::IncludeModule("blog");
    CModule::IncludeModule("iblock");
    CModule::IncludeModule("sale");
    CModule::IncludeModule("catalog");
    CModule::IncludeModule("main");
	
	
	/***************
	* Новинки в письмо
	*************/
	echo "1<br />
	<style>
	td {border:solid #eee 1px;}
	</style>";
	$newItemsBlock = "";
	$i = 0;
	$NewItems = CIBlockElement::GetList (array("timestamp_x" => "DESC"), array("IBLOCK_ID" => 4, "PROPERTY_STATE" => 21, "ACTIVE" => "Y", ">DETAIL_PICTURE" => 0), false, false, array());
	$newItemsBlock .= '<tr><td style="border-collapse: collapse;padding:10px 40px 20px 40px;">';
	while (($NewItemsList = $NewItems -> Fetch()) && ($i < 3))
	{
		$pict = CFile::ResizeImageGet($NewItemsList["DETAIL_PICTURE"], array("width" => 140, "height" => 200), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		$curr_sect = CIBlockSection::GetByID($NewItemsList["IBLOCK_SECTION_ID"]) -> Fetch();
		
		$newItemsBlock .= '
		<table align="left" border="0" cellpadding="8" cellspacing="0" class="tile" width="32%">
		<tbody>
		<tr>
		<td height="200" style="border-collapse: collapse;text-align:center;" valign="top" width="100%">
		<a href="http://www.alpinabook.ru/catalog/'.$curr_sect["CODE"].'/'.$NewItemsList["ID"].'/?utm_source=autotrigger&amp;utm_medium=email&amp;utm_term=newbooks&amp;utm_campaign=forgottenMails" target="_blank">
		<img alt="'.$NewItemsList["NAME"].'" src="'.$pict["src"].'" style="width: 140px; height: auto;" />
		</a>
		</td>
		</tr>
		<tr>
		<td align="center" height="18" style="color: #336699;font-weight: normal; border-collapse: collapse;font-family: Roboto,Tahoma,sans-serif;font-size: 16px;line-height: 150%;" valign="top" width="126">
		<a href="http://www.alpinabook.ru/catalog/'.$curr_sect["CODE"].'/'.$NewItemsList["ID"].'/?utm_source=autotrigger&amp;utm_medium=email&amp;utm_term=newbooks&amp;utm_campaign=forgottenMails" target="_blank">Подробнее о книге</a>
		</td>
		</tr>
		<tr>
		<td align="center" height="18" style="color: #336699;font-weight: normal; border-collapse: collapse;font-family: Roboto,Tahoma,sans-serif;font-size: 16px;line-height: 150%;padding-top:0;" valign="top" width="126">
		<a href="http://www.alpinabook.ru/catalog/'.$curr_sect["CODE"].'/'.$NewItemsList["ID"].'/?utm_source=autotrigger&amp;utm_medium=email&amp;utm_term=newbooks&amp;utm_campaign=forgottenMails" target="_blank">Купить</a>
		</td>
		</tr>
		</tbody>
		</table>';
		$i++;
	}
	$newItemsBlock .= '</td></tr>';

	
			
	/***************
	* Получаем телефон из заказа
	*************/

	function getPhone($id){
		$db_props = CSaleOrderPropsValue::GetOrderProps($id);
		while ($arProps = $db_props->Fetch()){
			if($arProps['CODE']=='PHONE'){
				$clearedPhone = preg_replace('/[^0-9]/','',$arProps['VALUE']);
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

	function sendNotificationEmail($id,$subject,$notification,$userID, $latestBooks, $email) {
		if (empty($email))
			$email = getClientEmail($id);
			
		$arEventFields = array(
			"EMAIL" => $email,
			"ORDER_USER" => getClientName($id),
			"ORDER_ID" => $id,
			"SUBJECT" => $subject,
			"NOTIFICATION" => $notification,
			"NEW_ITEMS_BLOCK" => $latestBooks
		);				
		CEvent::Send("ON_TIME_NOTIFICATIONS", "s1", $arEventFields,"N");
		
		$arFields = array(
			"EMP_STATUS_ID" => $userID
		);
		CSaleOrder::Update($id, $arFields);
		//echo $id."*".$subject."*".$userID."<br />";
	}
	
	function sendNotificationEmailFromManager($id,$subject,$notification,$userID, $latestBooks, $email) {
		if (empty($email))
			$email = getClientEmail($id);
			
		$arEventFields = array(
			"EMAIL" => $email,
			"ORDER_USER" => getClientName($id),
			"ORDER_ID" => $id,
			"SUBJECT" => $subject,
			"NOTIFICATION" => $notification
		);				
		CEvent::Send("ON_TIME_NOTIFICATIONS_FROM_MANAGER", "s1", $arEventFields,"N");
		
		$arFields = array(
			"EMP_STATUS_ID" => $userID
		);
		CSaleOrder::Update($id, $arFields);
		//echo $id."*".$subject."*".$userID."<br />";
	}	
	
	function addTrek($data){
		$userid = "34";
		$api_key = "2fa4c69a8aba5f8f9a38c35873ca325f";
		
		foreach($data as $arTrek){
			$tracks_id[]=$arTrek["trek"];
			$tracks[]="{
			'trackingUserClientPhone':'".$arTrek["tel"]."',
			'trackingUserClientTrack':'".$arTrek["trek"]."',
			'trackingUserClientEmail':'".$arTrek["email"]."',
			'trackingUserClientName':'".$arTrek["name"]."',
			'trackingUserClientItemCost':".$arTrek["cost"].",
			'trackingUserClientOrderNumber':'".$arTrek["ordernum"]."',
			'trackingUserClientDescription':'".$arTrek["descr"]."',
			'sendToUserEmailFullTracking':false,
			'sendToAdminEmailFullTracking':false
			}";
		}
		//формируем подпись
		$trKey=md5($userid.":".implode("",$tracks_id).":".$api_key);
		echo $arTrek["trek"];
		//формируем строку для отправки JSON
		$arr_json="{
		   'trackingUserId':".$userid.",
		   'trackingRequestKey':'".$trKey."',
		   'testMode':false,
		   'trackingData':[".implode(",",$tracks)."]
		}";


		if( $curl = curl_init() ) {
			// устанавливаем заголовки соединения 
			$url='http://apilr2.r-lab.biz/addtrack.ashx';
			$header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
			$header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
			$header[] = "Accept-Charset: utf-8;q=0.7,*;q=0.7";
			$header[] = "Content-Type: text/plain; charset=utf-8";
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $arr_json);
			$out = curl_exec($curl);
			curl_close($curl);
		// разбираем полученый ответ от сервера, более детальное описание параметров в документации 
			$response=json_decode($out);
			echo "Ответ от сервера ".$response->resultState.":".$response->resultInfo." #".$arTrek["ordernum"]." tel:".$arTrek["tel"]."<br />";
		}
	}

	
	$userID1 = 175985; 			//triggerMailUser_1
	$userID2 = 175986; 			//triggerMailUser_2
	$userIDabroad = 176080; 	//triggerMailUser_abroad
	$userIDontheway = 176775; 	//triggerMailUser_ontheway
	$userIDreturn = 176835; 	//triggerMailUser_return
	$userIDarrived = 176979; 	//triggerMailUser_arrived

	/***************
	* Пользователи API Почты России
	*************/
	$allUsers = array(
		array('login'=>'reCbiSaKylFiDh','password'=>'VdbVsIc7dtuf'), //Марченков
		array('login'=>'cruZXgcQzVDFRc','password'=>'s98awuYAXRrG'), //Петухова
		array('login'=>'dxviIPkwrlaEHS','password'=>'8dZACYAfBEqj'), //Данилова
		array('login'=>'AGSEccWQxDUTVY','password'=>'RbOU2Eh3cJqH') //Разумовская
	);
	
	$countUsers = count($allUsers);	
	
	
	/***************
	* Итоговое отчетное письмо
	*************/
	$finalReport = "triggerMailUser_1 - ".$userID1."<br />";
	$finalReport .= "triggerMailUser_2 - ".$userID2."<br />";
	$finalReport .= "triggerMailUser_abroad - ".$userIDabroad."<br /><br />";
	$finalReport .= "<table width='100%'><tbody><tr>
					<td><b>ID заказа</b></td>
					<td><b>Доставка</b></td>
					<td><b>Текущий статус</b></td>
					<td><b>ID пользователя</b></td>
					<td><b>Будущий статус</b></td>
					<td><b>Идентификатор</b></td>
					<td><b>Состояние</b></td>
					<td><b>Комментарий</b></td>
					</tr>					
	";

	
	echo "2<br />";
	/* I Проверяем даты собранных самовывозов */
	$arFilter = Array(
		"DELIVERY_ID" => "2",
		"@STATUS_ID" => array("C")
	);
	$rsSales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
	while ($arSales = $rsSales->Fetch())
	{
		$id = $arSales["ID"];
		if (
			(time() - strtotime($arSales[DATE_STATUS]))/86400 > 7 && 	// Если прошло больше 7 дней
			(time() - strtotime($arSales[DATE_STATUS]))/86400 < 12 && 	// и меньше 12 дней
			$arSales["EMP_STATUS_ID"] != $userID1) 						// еще не отправляли первое уведомление о собранном заказе
		{
			
			$subject = 'Истекает срок хранения заказа №'.$id.'. Альпина Паблишер';
			$notification = "Ваши книги скучают и ждут Вас. Скорее приезжайте за ними, срок хранения вашего заказа истекает уже через неделю.<br />
			Вы можете забрать заказ ".$id." по адресу: метро «Полежаевская», 4-я Магистральная улица, дом 5, подъезд 2, второй этаж.<br /><br />
			Да, кстати, у нас есть несколько хороших новинок, которые должны вам понравиться.";
			$result = sendNotificationEmail($id, $subject, $notification, $userID1, $newItemsBlock, '');
			$finalReport .= "<tr>
				<td>".$id."</td>
				<td>Самовывоз</td>
				<td>Собран</td>
				<td>".$userID1."</td>
				<td>Собран</td>
				<td></td>
				<td></td>
				<td>Прошла неделя</td>
				</tr>";
		} elseif (
			(time() - strtotime($arSales[DATE_STATUS]))/86400 >= 12 && 	// Если прошло больше 11 дней
			$arSales["EMP_STATUS_ID"] != $userID2)						// и еще не отправляли второе уведомление
		{
			$subject = 'Истекает срок хранения заказа №'.$id.'. Альпина Паблишер';
			$notification = "Ваши книги скучают и ждут вас. Скорее приезжайте за ними, срок хранения вашего заказа истекает уже через 2 дня.<br />
			Вы можете забрать заказ ".$id." по адресу: метро «Полежаевская», 4-я Магистральная улица, дом 5, подъезд 2, второй этаж.<br /><br />
			Да, кстати, у нас есть несколько хороших новинок, которые должны вам понравиться.";
			$result = sendNotificationEmail($id, $subject, $notification, $userID2, $newItemsBlock, '');
			$finalReport .= "<tr>
				<td>".$id."</td>
				<td>Самовывоз</td>
				<td>Собран</td>
				<td>".$userID2."</td>
				<td>Собран</td>
				<td></td>
				<td></td>
				<td>Осталось два дня</td>
				</tr>";			
		}
	}
	echo "3<br />";
	/* II Проверяем даты отправленных пикпоинтов */
	/*$arFilter = Array(
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
	}*/
	
	echo "4<br />";
	/* III Проверяем доставку почтой */
	$arFilter = Array(
		"DELIVERY_ID" => array(10,11,16,24,25,26,28),
		"!EMP_STATUS_ID" => array($userIDreturn,$userIDarrived),
		"@STATUS_ID" => array("I","K"),
		">=DATE_INSERT" => "07.04.2016",
		//"ID" => 69615
	);

	//echo "4a<br />";
	$rsSales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
	//echo "4b<br />";
	while ($arSales = $rsSales->Fetch())
	{

		$id = $arSales["ID"];
		$list = \Bitrix\Sale\Internals\OrderTable::getList(array(
			"select" => array(
				"TRACKING_NUM" => "\Bitrix\Sale\Internals\ShipmentTable:ORDER.TRACKING_NUMBER"
			),
			"filter" => array(
				"!=\Bitrix\Sale\Internals\ShipmentTable:ORDER.TRACKING_NUMBER" => "",
				"=ID" => $id
			),
			'limit'=> 1 
		))->fetchAll();
		
		//echo "4c<br />";
		
		if (!empty($list[0]['TRACKING_NUM'])) {
			$trackingNumber = $list[0]['TRACKING_NUM'];
		} else {
			$order = CSaleOrder::GetByID($id);
			$trackingNumber = $order["DELIVERY_DOC_NUM"];
		}
		
		if (!empty($trackingNumber) && (preg_match('/([0-9]){13,20}/', $trackingNumber) || preg_match('/([a-z0-9]){13,20}/i', $trackingNumber)) && !empty(getPhone($id))) {
			// составляем массив треков под отправку 
			$allTreks[]= array(
				"trek" => $trackingNumber,
				"name" => getClientName($id),
				"tel" => getPhone($id),
				"email" => "shop@alpinabook.ru",
				"cost" => $arSales[PRICE],
				"ordernum" => $id,
				"descr" => ""
			);
			addTrek($allTreks);
		}
		
		//echo "4d<br />";
		
		//$trackingNumber = $list[0]['TRACKING_NUM'];
		if ((time() - strtotime($arSales[DATE_STATUS]))/86400 < 2.5 && $arSales["EMP_STATUS_ID"] == $userIDontheway) {
			$finalReport .= "<tr>
				<td>".$id."</td>
				<td>Почта</td>
				<td>В пути, отправлен на почту</td>
				<td>---</td>
				<td>В пути, отправлен на почту</td>
				<td>".$trackingNumber."</td>
				<td>Ждем поступлени в отделение</td>
				<td>Уже проверяли</td>
				</tr>";			
			continue;
		}
		
		//echo "4e<br />";
		
		if ($stopAuth) {
			$finalReport .= "<tr>
				<td>".$id."</td>
				<td>Почта</td>
				<td>В пути, отправлен на почту</td>
				<td>---</td>
				<td>В пути, отправлен на почту</td>
				<td>".$trackingNumber."</td>
				<td>Ошибка авторизации</td>
				<td></td>
				</tr>";
				continue;
		}
		
		//echo "4f<br />";
		
		if (!empty($trackingNumber) &&								// Трекер проставлен
			preg_match('/([0-9]){13,20}/', $trackingNumber)) {
				
			//echo "4.1a<br />";
			
			$wsdlurl = 'https://tracking.russianpost.ru/rtm34?wsdl';
			$client2 = '';

			$client2 = new SoapClient($wsdlurl, array('trace' => 1, 'soap_version' => SOAP_1_2));

			$params3 = array ('OperationHistoryRequest' => array ('Barcode' => $trackingNumber, 'MessageType' => '0','Language' => 'RUS'),
							  'AuthorizationHeader' => $allUsers[0]);

			for ($i = 1; $i <= $countUsers; $i++) {
				try {
					$result = $client2->getOperationHistory(new SoapParam($params3,'OperationHistoryRequest'));
					
					$i = $countUsers;
					$count = count($result->OperationHistoryData->historyRecord);
					if ($count != 1) {
						$record = $result->OperationHistoryData->historyRecord[$count-1];
					} else {
						$record = $result->OperationHistoryData->historyRecord;
					}
					
					$parcelReturn = false;
					foreach ($result->OperationHistoryData->historyRecord as $record) {
						if ($record->OperationParameters->OperType->Id == 3) {
							$parcelReturn = true;
						}
					}

					if ($record->OperationParameters->OperType->Id == 2) {
							
						if (CSaleOrder::StatusOrder($id, "F")) {
							$arFields = array(
								"EMP_STATUS_ID" => $userID1
							);
							CSaleOrder::Update($id, $arFields);
						//echo $id."*Заказ почтой выполнен*".$userID1."<br />";
						$finalReport .= "<tr style='color:green;font-weight:700;'>
							<td>".$id."</td>
							<td>Почта</td>
							<td>В пути, отправлен на почту</td>
							<td>".$userID1."</td>
							<td>Выполнен</td>
							<td>".$trackingNumber."</td>
							<td>Россия выполнен</td>
							<td></td>
							</tr>";	
						}
					} elseif ($parcelReturn) {
						//echo "return ".$id."<br />";
						$finalReport .= "<tr style='color:red;font-weight:700;'>
							<td>".$id."</td>
							<td>Почта</td>
							<td>В пути, отправлен на почту</td>
							<td>".$userIDreturn."</td>
							<td>В пути, отправлен на почту</td>
							<td>".$trackingNumber."</td>
							<td>Возврат</td>
							<td>Уведомить доставку</td>
							</tr>";
						
						$subject = 'Заказ №'.$id.' истек срок хранения';
						$notification = 'Истек срок хранения заказа №'.$id.'. Необходимо отправить заказ повторно.';
						$result = sendNotificationEmail($id, $subject, $notification, $userIDreturn, '', 'm.danilova@alpinabook.ru');
						
					} elseif ($record->OperationParameters->OperType->Id == 8 &&
							  $record->OperationParameters->OperAttr->Id == 2) {
						//echo "поступил в отделение ".$id."<br />";
						$finalReport .= "<tr style='color:red;font-weight:700;'>
							<td>".$id."</td>
							<td>Почта</td>
							<td>В пути, отправлен на почту</td>
							<td>".$userIDarrived."</td>
							<td>В пути, отправлен на почту</td>
							<td>".$trackingNumber."</td>
							<td>Прибыло в место вручения</td>
							<td>Уведомить клиента</td>
							</tr>";

						$subject = 'Заказ №'.$id.' поступил в почтовое отделение';
						$notification = 'Ваш заказ №'.$id.' прибыл в почтовое отделение. Заполнить извещение можно <a href="https://www.pochta.ru/form?type=F22&withBarcode=true&Banderol=true&Insured=true&PostId='.$trackingNumber.'">по данной ссылке</a>.';
						$result = sendNotificationEmail($id, $subject, $notification, $userIDarrived, $newItemsBlock, '');

					} else {
						//echo 'Заказ в пути'.$id.'<br />';
						$arFields = array(
							"EMP_STATUS_ID" => $userIDontheway
						);
						CSaleOrder::Update($id, $arFields);
						
						$finalReport .= "<tr style='color:#6a9868'>
							<td>".$id."</td>
							<td>Почта</td>
							<td>В пути, отправлен на почту</td>
							<td>".$userIDontheway."</td>
							<td>В пути, отправлен на почту</td>
							<td>".$trackingNumber."</td>
							<td>Заказ в пути</td>
							<td></td>
							</tr>";	
					}
				} catch (SoapFault $e) {
					//var_dump($e); 
					//echo 'Ошибка авторизации<br />';
					$params3['AuthorizationHeader'] = $allUsers[$i];
					if ($i == $countUsers) {
						$finalReport .= "<tr>
							<td>".$id."</td>
							<td>Почта</td>
							<td>В пути, отправлен на почту</td>
							<td>---</td>
							<td>В пути, отправлен на почту</td>
							<td>".$trackingNumber."</td>
							<td>Ошибка авторизации".$i."</td>
							<td></td>
							</tr>";
						$stopAuth = true;
					}
				}
			}
		} elseif (
			!empty($trackingNumber) &&								// Трекер проставлен
			preg_match('/([a-z0-9]){13,20}/i', $trackingNumber)) {			// еще не простален флаг, что доставка по миру
			
			//echo "4.2a<br />";
				
			$wsdlurl = 'https://tracking.russianpost.ru/rtm34?wsdl';
			$client2 = '';

			$client2 = new SoapClient($wsdlurl, array('trace' => 1, 'soap_version' => SOAP_1_2));
			
			$params3 = array ('OperationHistoryRequest' => array ('Barcode' => $trackingNumber, 'MessageType' => '0','Language' => 'RUS'),
							  'AuthorizationHeader' => $allUsers[0]);

			
			/*if ($arSales["EMP_STATUS_ID"] != $userIDabroad) {
				$arFields = array(
					"EMP_STATUS_ID" => $userIDabroad
				);
				CSaleOrder::Update($id, $arFields);
				//echo "abroad ".$id."<br />";
				$finalReport .= "<tr>
					<td>".$id."</td>
					<td>Почта</td>
					<td>В пути, отправлен на почту</td>
					<td>".$userIDabroad."</td>
					<td>В пути, отправлен на почту</td>
					<td>".$trackingNumber."</td>
					<td>Заграницу</td>
					<td></td>
					</tr>";
			}*/
			for ($i = 1; $i <= $countUsers; $i++) {
				//echo "4.2b<br />";
				try {
					$result = $client2->getOperationHistory(new SoapParam($params3,'OperationHistoryRequest'));
					$i = $countUsers;
					
					$count = count($result->OperationHistoryData->historyRecord);
					if ($count != 1) {
						$record = $result->OperationHistoryData->historyRecord[$count-1];
					} else {
						$record = $result->OperationHistoryData->historyRecord;
					}
					
					//echo "4.2c<br />";
					
					$parcelReturn = false;
					foreach ($result->OperationHistoryData->historyRecord as $record) {
						if ($record->OperationParameters->OperType->Id == 3) {
							$parcelReturn = true;
						}
					}
					
					//echo "4.2d<br />";

					if ($record->OperationParameters->OperType->Id == 2) {
						//echo "4.2.1a<br />";
						if (CSaleOrder::StatusOrder($id, "F")) {
							$arFields = array(
								"EMP_STATUS_ID" => $userID1
							);
							CSaleOrder::Update($id, $arFields);
						}
						//echo $id."*Заказ почтой заграницу выполнен*".$userID1."<br />";
						$finalReport .= "<tr style='color:green;font-weight:700;'>
							<td>".$id."</td>
							<td>Почта</td>
							<td>В пути, отправлен на почту</td>
							<td>".$userID1."</td>
							<td>Выполнен</td>
							<td>".$trackingNumber."</td>
							<td>Заграницу выполнен</td>
							<td></td>
							</tr>";
					} elseif ($parcelReturn) {
						//echo "4.2.2a<br />";
						//echo "return ".$id."<br />";
						$finalReport .= "<tr style='color:red;font-weight:700;'>
							<td>".$id."</td>
							<td>Почта</td>
							<td>В пути, отправлен на почту</td>
							<td>".$userIDreturn."</td>
							<td>В пути, отправлен на почту</td>
							<td>".$trackingNumber."</td>
							<td>Возврат</td>
							<td>Уведомить доставку</td>
							</tr>";	
							
						$subject = 'Заказ №'.$id.' истек срок хранения';
						$notification = 'Истек срок хранения заказа №'.$id.'. Необходимо отправить заказ повторно.';
						$result = sendNotificationEmail($id, $subject, $notification, $userIDreturn, '', 'm.danilova@alpinabook.ru');
					} else {
						$arFields = array(
							"EMP_STATUS_ID" => $userIDabroad
						);
						
						//echo "4.2.3a<br />";
						
						CSaleOrder::Update($id, $arFields);
						//echo "abroad ".$id."<br />";
						$finalReport .= "<tr style='color:#6a9868'>
							<td>".$id."</td>
							<td>Почта</td>
							<td>В пути, отправлен на почту</td>
							<td>".$userIDabroad."</td>
							<td>В пути, отправлен на почту</td>
							<td>".$trackingNumber."</td>
							<td>Заграницу в пути</td>
							<td>В пути</td>
							</tr>";
					}
				} catch (SoapFault $e) {
					//var_dump($e); 
					//echo 'Ошибка авторизации<br />';
					$params3['AuthorizationHeader'] = $allUsers[$i];
					if ($i == $countUsers) {
						$finalReport .= "<tr>
							<td>".$id."</td>
							<td>Почта</td>
							<td>В пути, отправлен на почту</td>
							<td>---</td>
							<td>В пути, отправлен на почту</td>
							<td>".$trackingNumber."</td>
							<td>Ошибка авторизации".$i."</td>
							<td></td>
							</tr>";
						$stopAuth = true;
					}
				}
			}
		} elseif (empty($trackingNumber)) {
			$arFields = array(
				"EMP_STATUS_ID" => $userID2
			);
			CSaleOrder::Update($id, $arFields);
			//echo "noid ".$id."<br />";
			$finalReport .= "<tr style='color:#ff7676'>
					<td>".$id."</td>
					<td>Почта</td>
					<td>В пути, отправлен на почту</td>
					<td>".$userID2."</td>
					<td>В пути, отправлен на почту</td>
					<td>noid</td>
					<td>Нет идентификатора</td>
					<td>noid</td>
					</tr>";
		} elseif (!empty($trackingNumber) &&								// Трекер проставлен
				  preg_match('/([0-9]){4}\-([0-9]){4}/i', $trackingNumber)) {
			$arFields = array(
				"EMP_STATUS_ID" => $userID2,
				"DELIVERY_ID" => 30
			);
			CSaleOrder::Update($id, $arFields);
			//echo "noid ".$id."<br />";
			$finalReport .= "<tr style='color:#6a9868'>
					<td>".$id."</td>
					<td>Flippost</td>
					<td>В пути, отправлен на почту</td>
					<td>".$userID2."</td>
					<td>В пути, отправлен на почту</td>
					<td>".$trackingNumber."</td>
					<td>В пути</td>
					<td>Изменили на Flippost</td>
					</tr>";
		} else {
			$arFields = array(
				"EMP_STATUS_ID" => $userID2
			);
			CSaleOrder::Update($id, $arFields);
			//echo "noid ".$id."<br />";
			$finalReport .= "<tr>
					<td>".$id."</td>
					<td>Почта</td>
					<td>В пути, отправлен на почту</td>
					<td>".$userID2."</td>
					<td>В пути, отправлен на почту</td>
					<td>".$trackingNumber."</td>
					<td>Проверить</td>
					<td>error</td>
					</tr>";
		}
	}
	
	echo "5<br />";
	/* IV Проверяем даты отправленной Flippost */
	$arFilter = Array(
		"DELIVERY_ID" => "23",
		"@STATUS_ID" => array("I")
	);
	$rsSales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
	while ($arSales = $rsSales->Fetch())
	{
		if ((time() - strtotime($arSales[DATE_STATUS]))/86400 > 14) {
			$id = $arSales["ID"];
			if (CSaleOrder::StatusOrder($id, "F")) {
				$arFields = array(
					"EMP_STATUS_ID" => $userID1
				);
				CSaleOrder::Update($id, $arFields);
			}
			$finalReport .= "<tr>
				<td>".$id."</td>
				<td>Flippost</td>
				<td>В пути</td>
				<td>".$userID1."</td>
				<td>Выполнен</td>
				<td></td>
				<td></td>
				<td></td>
				</tr>";	
		}
	}
	
	echo "6<br />";
	/* V Заказ еще не оплачен, ждем */
	$arFilter = Array(
		"DELIVERY_ID" => array(10,11,16,17,23,24,25,26,28),
		"@STATUS_ID" => array("N", "O")
	);
	$rsSales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
	while ($arSales = $rsSales->Fetch())
	{
		$id = $arSales["ID"];
		if ((time() - strtotime($arSales[DATE_STATUS]))/86400 > 5 &&	// Если прошло больше пяти дней
			(time() - strtotime($arSales[DATE_STATUS]))/86400 < 10 &&	// и меньше 10 дней
			$arSales["EMP_STATUS_ID"] != $userID1) { 					// и еще не отправляли первое уведомление
			$subject = 'Заказ №'.$id.' собран и ожидает оплаты. Альпина Паблишер.';
			$notification = 'Ваш заказ №'.$id.' уже готов. Как только вы оплатите его, мы передадим его вам тем способом доставки, который вы выбрали.<br />
			Спасибо, что читаете наши книги! <br /><br />
			Вот, кстати, несколько новинок, которые тоже должны вам понравиться:';
			$result = sendNotificationEmail($id, $subject, $notification, $userID1, $newItemsBlock, '');
			$finalReport .= "<tr>
				<td>".$id."</td>
				<td>Неоплаченные заказа</td>
				<td>Новый, обработан</td>
				<td>".$userID1."</td>
				<td>Новый, обработан</td>
				<td></td>
				<td></td>
				<td>Прошло пять дней</td>
				</tr>";	
		} elseif ((time() - strtotime($arSales[DATE_STATUS]))/86400 >= 10 &&	// Если прошло больше 10 дней
			$arSales["EMP_STATUS_ID"] != $userID2) {							// и еще не отправляли второе уведомление
			$subject = 'Заказ '.$id.' собран и ожидает оплаты. Альпина Паблишер.';
			$notification = 'Ваш заказ №'.$id.' уже готов. Как только вы оплатите его, мы передадим его вам тем способом доставки, который вы выбрали.<br />
			Спасибо, что читаете наши книги! <br /><br />
			Вот, кстати, несколько новинок, которые тоже должны вам понравиться:';
			$result = sendNotificationEmail($id, $subject, $notification, $userID1, $newItemsBlock, '');
			$finalReport .= "<tr>
				<td>".$id."</td>
				<td>Неоплаченные заказа</td>
				<td>Новый, обработан</td>
				<td>".$userID1."</td>
				<td>Новый, обработан</td>
				<td></td>
				<td></td>
				<td>Прошло десять дней</td>
				</tr>";	
		}
	}

    //Data access for PickPoint API
    $dataLogin = $arParams["PICKPOINT"]["DATA_ACCESS"]; 
    $ikn = $arParams["PICKPOINT"]["IKN"]; 
    $urlLogin = "http://e-solution.pickpoint.ru/api/login";
    
    //Request for authorization on PickPoint server
    $content = json_encode($dataLogin);
    $curl = curl_init($urlLogin);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER,
        array("Content-type: application/json"));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
    $json_response = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    $response = json_decode($json_response, true);  
    
    //Request for received orders
    $lastDayMonth = mktime(0, 0, 0, date('m')+1, 0, date('Y'));
    $dataSend = array('SessionId' => $response["SessionId"], 'DateFrom' => '1.'.date('m').'.'.date('Y'), 'DateTo' => strftime("%d", $lastDayMonth).'.'.date('m').'.'.date('Y'), 'State' => 111);
    $urlLabel = "http://e-solution.pickpoint.ru/api/getInvoicesChangeState";
    $content = json_encode($dataSend);
    $curl = curl_init($urlLabel);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER,
        array("Content-type: application/json"));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
    $json_response = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    $response = json_decode($json_response, true);
    
    //Change orders status on site
    foreach ($response as $arOrderPickPoint) {
        $arOrder = CSaleOrder::GetByID($arOrderPickPoint["SenderInvoiceNumber"]);
        if ($arOrder && $arOrder["STATUS_ID"] != "F") {
			if (CSaleOrder::StatusOrder($arOrderPickPoint["SenderInvoiceNumber"], "F")) {
				$finalReport .= "<tr style='color:green;font-weight:700;'>
					<td>".$arOrderPickPoint["SenderInvoiceNumber"]."</td>
					<td>Pickpoint</td>
					<td>В пути, отправлен в постомат</td>
					<td>---</td>
					<td>Выполнен</td>
					<td>Pickpoint</td>
					<td>Pickpoint выполнен</td>
					<td></td>
					</tr>";					
			}
        }
    }
	
	echo "7<br />";
	$finalReport .= "</tbody></table>";
	print $finalReport;
	
	$arEventFields = array(
		"ORDER_USER" => "Александр",
		"REPORT" => $finalReport
	);				
	CEvent::Send("SEND_TRIGGER_REPORT", "s1", $arEventFields,"N");
	
} else {
	echo "Not authorized";
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>