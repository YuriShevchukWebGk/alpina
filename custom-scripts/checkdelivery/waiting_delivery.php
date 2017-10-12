<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$userGroup = CUser::GetUserGroup($USER->GetID());
if ($USER->isAdmin() || in_array(6,$userGroup)) {
CModule::IncludeModule("iblock");
CModule::IncludeModule("sale");
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
if ($_GET['orders']) {
	$id = $_GET['orders'];
	$date = FormatDate("X", MakeTimeStamp($_GET['deliverydate'],"YYYY-MM-DD"));
	
	$arOrder = CSaleOrder::GetByID($id);
	
	if (CSaleOrder::StatusOrder($id, "OD")) {
		$arEventFields = array(
			"EMAIL" => getClientEmail($id),
			"DELIVERY_DATE" => $date,
			"ORDER_ID" => $id,
			"ORDER_USER" => getClientName($id)
			
		);				
		CEvent::Send("SALE_STATUS_CHANGED_OD", "s1", $arEventFields,"N");

		$arFields = array(
		  "COMMENTS" => "Доставка на ".$date
		);
		CSaleOrder::Update($id, $arFields);

		$rsVals = CSaleOrderPropsValue::GetList(array("SORT" => "ASC"), array("ORDER_ID" => $id, "ORDER_PROPS_ID" => 44));
		if ($arVals = $rsVals->Fetch()) {
		   CSaleOrderPropsValue::Update($arVals['ID'], array("VALUE"=>$date));
		}
		?>
		<div style="width:400px;margin:10% auto 0 auto;">
		Статус заказа <?=$id?> изменен. Дата доставки <?=$date?>
		</div>
	<?} else {
		echo $id."*status error<br />";
	}
} else {?>
	<div style="width:400px;margin:10% auto 0 auto;">
	<form action="/custom-scripts/checkdelivery/waiting_delivery.php">
	<input type="text" name="orders" value="" placeholder="Номер заказа"><br /><br />
	<input type="date" name="deliverydate" value="" />
	<br /><br />
	<input type="submit" value="Отложить">
	</form>	
	</div>
	<?$arOrder = CSaleOrder::GetByID(93293);
	echo '<pre>';
	print_r($arOrder);
	echo '</pre>';?>
<?}
} else {
	echo "ошибка";
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>