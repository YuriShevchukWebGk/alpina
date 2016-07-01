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
	
$list = \Bitrix\Sale\Internals\OrderTable::getList(array(             "select" => array(
                 "TRACKING_NUM" => "\Bitrix\Sale\Internals\ShipmentTable:ORDER.TRACKING_NUMBER"
             ),
             "filter" => array(
                 "!=\Bitrix\Sale\Internals\ShipmentTable:ORDER.TRACKING_NUMBER" => "",
                 "=ID" => 69218
                 ),
             'limit'=> 1 
         ))->fetchAll();
$arFields['ORDER_TRACKING_NUMBER'] = $list[0]['TRACKING_NUM'];
	print_r($arFields['ORDER_TRACKING_NUMBER']);
} else {
	echo "ошибка";
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>