<?
$_SERVER["DOCUMENT_ROOT"] = '/home/bitrix/www';
//define("NO_KEEP_STATISTIC", true);
//define("NOT_CHECK_PERMISSIONS", true);
//define('SITE_ID', 's1');
//$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
//set_time_limit(0);
//define("LANG", "ru"); 
define('LOG_FILENAME', $_SERVER["DOCUMENT_ROOT"]."/custom-scripts/log.txt");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if (AddMessage2Log('Скрипт выполнен', 'pickups.php'))?>
<html>
<body width="100%">
<?
$userGroup = CUser::GetUserGroup($USER->GetID());
if ($USER->isAdmin() || in_array(6,$userGroup)) {
	CModule::IncludeModule("blog");
    CModule::IncludeModule("iblock");
    CModule::IncludeModule("sale");
    CModule::IncludeModule("catalog");
    CModule::IncludeModule("main");
	
if ($_GET['ids']) {
	$array2 = explode(",", $_GET['ids']);

	foreach ($_GET['ids'] as $id) {
		$arOrder = CSaleOrder::GetByID($id);
		if ($arOrder["STATUS_ID"] == "F") {
			echo $id.'* заказ уже выполнен *<br />';
			continue;
		}
		if (CSaleOrder::StatusOrder($id, "C")) {
			echo $id.'* заказ собран *<br />';
		} else {
			echo $id.'* ошибка. Сообщить в имаг *<br />';
		}		
	}
} else {
    CModule::IncludeModule("blog");
    CModule::IncludeModule("iblock");
    CModule::IncludeModule("sale");
    CModule::IncludeModule("catalog");
    CModule::IncludeModule("main");
	
	$allIds = array();
	$allIdsU = array();
	$finalBooks = array();
	$orders = array();
	$ordersString = '';
	
	$arFilter = Array(
		"DELIVERY_ID" => "2",
		"@STATUS_ID" => array("N", "O", "D", "AC"),
		"PERSON_TYPE_ID" => 1
	);
	$rsSales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
	while ($arSales = $rsSales->Fetch())
	{
		$dbBasketItems = CSaleBasket::GetList(
			array(
					"NAME" => "ASC",
					"ID" => "ASC"
				),
			array(
					"ORDER_ID" => $arSales["ID"]
				),
			false,
			false,
			array("ID","PRODUCT_ID","NAME","QUANTITY")
		);
		while ($arItems = $dbBasketItems->Fetch())
		{
			$res = CIBlockElement::GetProperty(4, $arItems["PRODUCT_ID"], "sort", "asc", Array("CODE"=>"COVER_TYPE"))->Fetch();
			$allIds[] = array('n' => $arItems['NAME'], 'q' => $arItems['QUANTITY'], 'o' => $arSales["ID"].'('.substr($arItems['QUANTITY'],0,-3).')', 'c' => $res[VALUE_ENUM]);
			$allIdsU[] = $arItems['NAME'];
		}
		$orders[] = $arSales["ID"];
	}
	
	$arFilter = Array(
		"DELIVERY_ID" => "2",
		"@STATUS_ID" => array("D", "AC"),
		"PERSON_TYPE_ID" => 2
	);
	$rsSales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
	while ($arSales = $rsSales->Fetch())
	{
		$dbBasketItems = CSaleBasket::GetList(
			array(
					"NAME" => "ASC",
					"ID" => "ASC"
				),
			array(
					"ORDER_ID" => $arSales["ID"]
				),
			false,
			false,
			array("ID","PRODUCT_ID","NAME","QUANTITY")
		);
		while ($arItems = $dbBasketItems->Fetch())
		{
			$res = CIBlockElement::GetProperty(4, $arItems["PRODUCT_ID"], "sort", "asc", Array("CODE"=>"COVER_TYPE"))->Fetch();
			$allIds[] = array('n' => $arItems['NAME'], 'q' => $arItems['QUANTITY'], 'o' => $arSales["ID"].'('.substr($arItems['QUANTITY'],0,-3).')', 'c' => $res[VALUE_ENUM]);
			$allIdsU[] = $arItems['NAME'];
		}
		$orders[] = $arSales["ID"];
	}
	
	$unique = array_unique($allIdsU);
	sort($unique);
	$q = 0;
	
	/*echo '<pre>';
	print_r($allIds);
	print_r($unique);
	echo '</pre>';*/
	
	foreach ($unique as $book) {
		$q = 0;
		$ordery = '';
		foreach ($allIds as $single) {
			if ($book == $single['n']) {
				$q += $single['q'];
				$cover = $single['c'];
				$ordery .= $single['o'].', ';
			}
		}
		$finalBooks[] = array('name' => $book, 'quantity' => $q, 'orders' => substr($ordery,0,-2), 'cover' => $cover);
	}
	
	
	/*echo '<pre>';
	print_r($finalBooks);
	echo '</pre>';*/
	
	
	$table = '<table border=1 cellpadding=10><tbody>';
	$table .= '<tr><td><b>Название</b></td><td><b>Количество</b></td><td><b>Заказы</b></td></tr>';
	foreach ($finalBooks as $books) {
		if ($books['quantity'] > 1)
			$table .= '<tr style="font-weight:bold;">';
		else
			$table .= '<tr>';
		$table .= '<td width=500>'.$books['name'].'<br />'.$books['cover'].'</td>';
		$table .= '<td>'.$books['quantity'].'</td>';
		$table .= '<td>'.$books['orders'].'</td>';
		$table .= '</tr>';
	}
	foreach ($orders as $order) {
		//$table .= $order.'<br />';
		$ordersString .= $order.',';
		$ordersStringPrint .= $order.', ';
	}
	$table .= '</tbody></table>';
	echo $table;
	
	$table .= $USER->GetID();
	
	$arEventFields = array(
		"ORDER_USER" => "Александр",
		"REPORT" => $table
	);				
	CEvent::Send("SEND_TRIGGER_REPORT", "s1", $arEventFields,"N");?>
	
	<form action="/custom-scripts/misc/pickups.php" style="width:600px;">
	<br />
	Поставить заказы на "Собран"<br /><br />
	<?foreach ($orders as $order) {?>
		<label><input type="checkbox" name="ids[]" value="<?=$order?>" checked><?=$order?></label><br/>
	<?}?>
	<br />
	
	<input type="submit" value="Книги собраны">
	</form>
<?}
} else {
	echo "Not authorized";
}

?>
</body>
</html>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>