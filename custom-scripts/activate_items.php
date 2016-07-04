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
			"TRACKING_NUM" => "\Bitrix\Sale\Internals\ShipmentTable:ORDER.TRACKING_NUMBER"
		),
		"filter" => array(
			"!=\Bitrix\Sale\Internals\ShipmentTable:ORDER.TRACKING_NUMBER" => "",
			"=ID" => 70018
		),
		'limit'=> 1 
	))->fetchAll();
			 
	$trackingNumber = $list[0]['TRACKING_NUM'];
	//print_r($trackingNumber);

	if (!empty($trackingNumber)) {
		$wsdlurl = 'https://tracking.russianpost.ru/rtm34?wsdl';
		$client2 = '';

		$client2 = new SoapClient($wsdlurl, array('trace' => 1, 'soap_version' => SOAP_1_2));

		$params3 = array ('OperationHistoryRequest' => array ('Barcode' => $trackingNumber, 'MessageType' => '0','Language' => 'RUS'),
						  'AuthorizationHeader' => array ('login'=>'reCbiSaKylFiDh','password'=>'VdbVsIc7dtuf'));

		$result = $client2->getOperationHistory(new SoapParam($params3,'OperationHistoryRequest'));

		echo $result->OperationHistoryData->historyRecord[count($result->OperationHistoryData->historyRecord)-1]->OperationParameters->OperAttr->Id;
		echo $result->OperationHistoryData->historyRecord[count($result->OperationHistoryData->historyRecord)-1]->OperationParameters->OperAttr->Name;

		echo "<br /><br />";
		if (
			1 == 1 && //asldfjasd
			2 == 2 && //asdfjasdklf
			3 < 5)
			echo 'dlskfj';
	} else {
		echo 'sdlkfjsdlfk';
	}
	
} else {
	echo "ошибка";
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>