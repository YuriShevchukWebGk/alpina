<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
@set_time_limit(0);
ignore_user_abort(true);
if ($USER->isAdmin()) {
    CModule::IncludeModule("sale");
	CModule::IncludeModule("iblock");

	/*$ids = array(
	66873,
	68049,
	68204,
	68654,
	68772,
	68934,
	69159,
	69277,
	69278,
	69391,
	69420,
	69488,
	69512,
	69627,
	69645,
	69769,
	69778,
	69817,
	69824,
	69839,
	69949,
	69951,
	69957
	);
	
	foreach ($ids as $id) {
		$arFields = array(
			"EMP_STATUS_ID" => 176979
		);
		if ($update = CSaleOrder::Update($id, $arFields)) {
			echo $id."*ok<br />";
		} else {
			echo $id."*false<br />";
		}
	}*/
	
	$arFilter = Array(
		"<=ID" => "80000",
		">ID" => "70000",
		//"ID" => 547,
		//"LOGIN" => "~newuser",
		"@STATUS_ID" => array("I", "K", "F", "D")
	);
	
	$delarray = array(2,9,12,13,14,15);
	
	$db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
	while ($ar_sales = $db_sales->Fetch())
	{

		$db_props = CSaleOrderPropsValue::GetOrderProps($ar_sales["ID"]);
		while ($arProps = $db_props->Fetch()){
			if($arProps['CODE']=='LOCATION'){
				if ($arProps['VALUE'] == 88 || in_array($ar_sales['DELIVERY_ID'], $delarray))
					echo $ar_sales["ID"]."*".$ar_sales["USER_EMAIL"]."*Москва<br />";
				elseif ($arProps['VALUE'] == 99)
					echo $ar_sales["ID"]."*".$ar_sales["USER_EMAIL"]."*Питер<br />";
				elseif ($arProps['VALUE'] == 100)
					echo $ar_sales["ID"]."*".$ar_sales["USER_EMAIL"]."*Краснодар<br />";	
				elseif ($arProps['VALUE'] == 128)
					echo $ar_sales["ID"]."*".$ar_sales["USER_EMAIL"]."*Свердл<br />";	
				elseif ($arProps['VALUE'] == 137)
					echo $ar_sales["ID"]."*".$ar_sales["USER_EMAIL"]."*Новосиб<br />";	
				else
					echo $ar_sales["ID"]."*".$ar_sales["USER_EMAIL"]."*другое<br />";	
			}
		}
	
	}
	
} else {
	echo "ошибка";
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>