<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if ($USER->isAdmin()) {
	CModule::IncludeModule("iblock");
	$books = array(
'«Сноб»: Беспрецедентные письма',



	);
	/*foreach ($books as $singlebook) {
		$obEl = new CIBlockElement();
		//$boolResult = $obEl->Update($singlebook,array('ACTIVE' => 'Y'));
		CIBlockElement::SetPropertyValuesEx($singlebook, 4, array('STATE' => ''));
		echo $singlebook.' - activated <br />';
	}*/
	foreach ($books as $singlebook) {
		$arFilter = Array("IBLOCK_ID"=>4, "NAME"=>$singlebook);
		$res = CIBlockElement::GetList(Array(), $arFilter);
		echo $singlebook;
		echo '*';		
		if ($ob = $res->GetNextElement()){
			$arProps = $ob->GetProperties();
			$arFields = $ob->GetFields();
			$res = CIBlockElement::GetByID($arProps[AUTHORS][VALUE][0]);
			if($ar_res = $res->GetNext())
			echo $ar_res['NAME'];
			echo '*';
			echo $arFields['NAME'];
		}
		echo "<br />";
	}
	
	$list = \Bitrix\Sale\Internals\OrderTable::getList(array(
		"select" => array(
			"TRACKING_NUM" => "\Bitrix\Sale\Internals\ShipmentTable:ORDER.DELIVERY_DOC_NUM"
		),
		"filter" => array(
			"!=\Bitrix\Sale\Internals\ShipmentTable:ORDER.DELIVERY_DOC_NUM" => "",
			"=ID" => 63373
		),
		'limit'=> 1 
	))->fetchAll();
	if (!empty($list[0]['TRACKING_NUM'])) {
		$trackingNumber = $list[0]['TRACKING_NUM'];
	} else {
		$order = CSaleOrder::GetByID(63373);
		$trackingNumber = $order["DELIVERY_DOC_NUM"];
	}
	
	$trackingNumber = "RA372259186RU";
	$trackingNumber = "11172598063968";
	$trackingNumber = "RA372259535RU";

	if (!empty($trackingNumber) && preg_match('/([a-z0-9]){13,20}/i', $trackingNumber)) {
		$wsdlurl = 'https://tracking.russianpost.ru/rtm34?wsdl';
		$client2 = '';

		$client2 = new SoapClient($wsdlurl, array('trace' => 1, 'soap_version' => SOAP_1_2));

		$allUsers = array(
			array('login'=>'reCbiSaKylFiDh','password'=>'VdbVsIc7dtuf'), //Марченков
			array('login'=>'cruZXgcQzVDFRc','password'=>'s98awuYAXRrG'), //Петухова
			array('login'=>'dxviIPkwrlaEHS','password'=>'8dZACYAfBEqj'), //Данилова
			array('login'=>'AGSEccWQxDUTVY','password'=>'RbOU2Eh3cJqH') //Разумовская
		);
		
		$countUsers = count($allUsers);
		
		$params3 = array ('OperationHistoryRequest' => array ('Barcode' => $trackingNumber, 'MessageType' => '0','Language' => 'RUS'),
						  'AuthorizationHeader' => $allUsers[0]);
		

		for ($i = 1; $i <= $countUsers; $i++) {
			try {
				echo $params3['AuthorizationHeader']['login']."<br />";
				$result = $client2->getOperationHistory(new SoapParam($params3,'OperationHistoryRequest'));
				$i = $countUsers;
			} catch (SoapFault $e) {
				//var_dump($e); 
				$params3['AuthorizationHeader'] = $allUsers[$i];
				if ($i == $countUsers) 
					echo 'Ошибка авторизации<br />';
			}
		}
foreach ($result->OperationHistoryData->historyRecord as $record) {
	printf("<p>Дата: %s</br>ID операции: %s</br>Название операции: %s</br>Место проведения операции:%s<br />ID атрибута: %s<br />Название атрибута: %s</p>",
	$record->OperationParameters->OperDate,
	$record->OperationParameters->OperType->Id,
	$record->OperationParameters->OperType->Name,
	$record->AddressParameters->OperationAddress->Description,
	$record->OperationParameters->OperAttr->Id,
	$record->OperationParameters->OperAttr->Name);
};		
		
		$count = count($result->OperationHistoryData->historyRecord);
		echo $count;
		$record = $result->OperationHistoryData[0];
		print_r($record);
		
		
		echo $result->OperationHistoryData->historyRecord[count($result->OperationHistoryData->historyRecord)-1]->OperationParameters->OperAttr->Id;
		echo $result->OperationHistoryData->historyRecord[count($result->OperationHistoryData->historyRecord)-1]->OperationParameters->OperAttr->Name;

		echo "<br /><br />";

		$parcelReturn = false;
		foreach ($result->OperationHistoryData->historyRecord as $record) {
			if ($record->OperationParameters->OperAttr->Name == "Истек срок хранения") {
				$parcelReturn = true;
			}
		}

		if ($result->OperationHistoryData->historyRecord[count($result->OperationHistoryData->historyRecord)-1]->OperationParameters->OperAttr->Id == 1 &&
			(strpos($result->OperationHistoryData->historyRecord[count($result->OperationHistoryData->historyRecord)-1]->OperationParameters->OperAttr->Name, 'Получено') !== false ||
			strpos($result->OperationHistoryData->historyRecord[count($result->OperationHistoryData->historyRecord)-1]->OperationParameters->OperAttr->Name, 'Вручение') !== false)) {

			echo "*Заказ почтой выполнен*<br />";
		} elseif ($parcelReturn) {
			echo "return<br />";
		} else {
			echo 2;
		}
		echo 1;
		$record = $result->OperationHistoryData->historyRecord[count($result->OperationHistoryData->historyRecord)-1]; 
			printf("<p>Дата: %s</br>ID операции: %s</br>Название операции: %s</br>Место проведения операции:%s<br />ID атрибута: %s<br />Название атрибута: %s</p>",
			$record->OperationParameters->OperDate,
			$record->OperationParameters->OperType->Id,
			$record->OperationParameters->OperType->Name,
			$record->AddressParameters->OperationAddress->Description,
			$record->OperationParameters->OperAttr->Id,
			$record->OperationParameters->OperAttr->Name);
			
	} else {
		echo 'sdlkfjsdlfk';
	}
	
} else {
	echo "ошибка";
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>