<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<html>
<body width="100%">
<?$userGroup = CUser::GetUserGroup($USER->GetID());
if ($USER->isAdmin() || in_array(6,$userGroup)) {
	CModule::IncludeModule("blog");
    CModule::IncludeModule("iblock");
    CModule::IncludeModule("sale");
    CModule::IncludeModule("catalog");
    CModule::IncludeModule("main");
	
	function getUniversal($id, $prop){
		$db_props = CSaleOrderPropsValue::GetOrderProps($id);
		while ($arProps = $db_props->Fetch()){
			if($arProps['CODE'] == $prop){
				return $arProps["VALUE"];
			}
		}
	}	
	
	function getClientIndex($id){
		$db_props = CSaleOrderPropsValue::GetOrderProps($id);
		while ($arProps = $db_props->Fetch()){
			if($arProps['CODE']=='INDEX' || $arProps['CODE']=="F_INDEX"){
				return $arProps["VALUE"];
			}
		}
	}
	function getClientAddress($id){
		$db_props = CSaleOrderPropsValue::GetOrderProps($id);
		while ($arProps = $db_props->Fetch()){
			if($arProps['CODE']=='ADDRESS' || $arProps['CODE']=="F_ADDRESS"){
				return $arProps["VALUE"];
			}
		}
	}
	function getClientName($id){
		$db_props = CSaleOrderPropsValue::GetOrderProps($id);
		while ($arProps = $db_props->Fetch()){
			if($arProps['CODE']=='F_CONTACT_PERSON' || $arProps['CODE']=="F_NAME"){
				return $arProps["VALUE"];
			}
		}
	}	
	function getClientRegion($id){
		$db_props = CSaleOrderPropsValue::GetOrderProps($id);
		while ($arProps = $db_props->Fetch()){
			if($arProps['CODE']=='LOCATION' || $arProps['CODE']=='F_LOCATION'){
				$city = CSaleLocation::GetByID($arProps["VALUE"]);
				return $city["REGION_NAME"];
			}
		}
	}		
	function getClientCity($id){
		$db_props = CSaleOrderPropsValue::GetOrderProps($id);
		while ($arProps = $db_props->Fetch()){
			if($arProps['CODE']=='LOCATION' || $arProps['CODE']=='F_LOCATION'){
				$city = CSaleLocation::GetByID($arProps["VALUE"]);
				return $city["CITY_NAME"];
			}
		}
	}
	
if ($_GET['ids']) {
	$array2 = explode("\n", $_GET['ids']);
	
	$allIds = array();
	$allIdsU = array();
	$finalBooks = array();
	$orders = array();
	$ordersString = '';
	$table = '<table border=1 cellspacing=1 cellpadding=10><tbody><tr>
		<td>№п/п, № заказа</td>
		<td>индекс</td>
		<td>обл, край, респ</td>
		<td>район</td>
		<td>нас пункт</td>
		<td>ул., дом, корп., кв.</td>
		<td>фио</td>
		<td>Масса</td>
		<td>Оценка</td>
		</tr>';
	
	$arFilter = Array(
		"ID" => $array2
	);
	$rsSales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
	while ($arSales = $rsSales->Fetch())
	{
		$table .= '<tr>';
		$table .= '<td>'.$arSales['ID'].'</td>'; 					//Номер заказа
		$table .= '<td>'.getClientIndex($arSales['ID']).'</td>';	//индекс
		$table .= '<td>'.getClientRegion($arSales['ID']).'</td>'; 	//регион
		$table .= '<td></td>'; 										//район
		$table .= '<td>'.getClientCity($arSales['ID']).'</td>';		//город
		$table .= '<td>'.getClientAddress($arSales['ID']).'</td>'; 	//адрес
		$table .= '<td>'.getClientName($arSales['ID']).'</td>';		//фио
		$table .= '<td></td>'; 										//масса
		$table .= '<td>'.round($arSales['PRICE']).'</td>'; 			//цена
		$table .= '</tr>';
	}
	$table .= '</tbody></table>';
	
	echo $table;
	
	$table .= $USER->GetID();
	$arEventFields = array(
		"ORDER_USER" => "Александр",
		"REPORT" => $table
	);				
	CEvent::Send("SEND_TRIGGER_REPORT", "s1", $arEventFields,"N");
	
	} else {?>
	Ниже указать номера заказов каждый на новой строке!
	<form action="/custom-scripts/misc/ruspost.php">
	<textarea type="text" name="ids" value="" rows="20" cols="45" placeholder="Номера заказов каждый на новой строке!"></textarea><br /><br />
	<input type="submit" value="Получить таблицу">
	</form>
<?}
} else {
	echo "Not authorized";
}
?>
</body>
</html>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>