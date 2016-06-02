<?
require("/home/bitrix/data/www/www.alpinabook.ru/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");
global $USER;
if ($USER->IsAdmin()){

$filter = Array
(
    //"TIMESTAMP_1"         => "02.12.2013",
    //"TIMESTAMP_2"         => "03.12.2013",
	">UF_ORDERS_COUNT"		=>	1,
    //"LOGIN"             	=> "newuser"
);
$rsUsers = CUser::GetList(($by="ID"), ($order="desc"), $filter); // выбираем пользователей
$is_filtered = $rsUsers->is_filtered; // отфильтрована ли выборка ?

$today = strtotime(date('d.m.Y'));
?>

<table style="width:1000px;"><tbody>
<tr>
	<td>1 ► 2</td><td>2 ► 3</td><td>3 ► 4</td><td>4 ► 5</td><td>5 ► 6</td><td>Последний</td><td>Всего заказов</td><td>Всего денег</td><td>ID клиента</td><td>Телефон</td><td>Средний чек</td><td>Recency</td><td>Frequency</td><td>Monetary</td>
</tr>
<?while($ar_sales = $rsUsers->Fetch()) {
	$rsUser = CUser::GetByID($ar_sales['ID']);
	$ar_sales = $rsUser->Fetch();?>
	<tr>
		<td>
			<?=$ar_sales['UF_ONE_TWO']?>
		</td>
		<td>
			<?=$ar_sales['UF_TWO_THREE']?>
		</td>
		<td>
			<?=$ar_sales['UF_THREE_FOUR']?>
		</td>
		<td>
			<?=$ar_sales['UF_FOUR_FIVE']?>
		</td>
		<td>
			<?=$ar_sales['UF_FIVE_SIX']?>
		</td>
		<td>
			<?=$ar_sales['UF_LAST_NOW']?>
		</td>
		<td>
			<?=$ar_sales['UF_ORDERS_COUNT']?>
		</td>
		<td>
			<?=$ar_sales['UF_ORDERS_SUM']?>
		</td>		
		<td>
			<?=$ar_sales['ID']?>
		</td>
		<td>
			<?echo (substr($ar_sales['UF_RFM_PHONE'],0,9));?>
		</td>
		<td>
			<?echo ($ar_sales['UF_ORDERS_SUM']/$ar_sales['UF_ORDERS_COUNT']);?>
		</td>		
		<td>
			<?
			if ($ar_sales['UF_LAST_NOW'] < 10) echo '1';
			if ($ar_sales['UF_LAST_NOW'] > 9 && $ar_sales['UF_LAST_NOW'] < 32) echo '2';
			if ($ar_sales['UF_LAST_NOW'] > 31 && $ar_sales['UF_LAST_NOW'] < 76) echo '3';
			if ($ar_sales['UF_LAST_NOW'] > 75 && $ar_sales['UF_LAST_NOW'] < 191) echo '4';
			if ($ar_sales['UF_LAST_NOW'] > 190) echo '5';
			?>
		</td>
		<td>
			<?
			if ($ar_sales['UF_ORDERS_COUNT'] == 1) echo '6';
			if ($ar_sales['UF_ORDERS_COUNT'] == 2) echo '5';
			if ($ar_sales['UF_ORDERS_COUNT'] > 2 && $ar_sales['UF_ORDERS_COUNT'] < 5) echo '4';
			if ($ar_sales['UF_ORDERS_COUNT'] > 4 && $ar_sales['UF_ORDERS_COUNT'] < 7) echo '3';
			if ($ar_sales['UF_ORDERS_COUNT'] > 6 && $ar_sales['UF_ORDERS_COUNT'] < 9) echo '2';
			if ($ar_sales['UF_ORDERS_COUNT'] > 8) echo '1';
			?>
		</td>
		<td>
			<?
			if ($ar_sales['UF_ORDERS_SUM'] <= 2800) echo '5';
			if ($ar_sales['UF_ORDERS_SUM'] > 2800 && $ar_sales['UF_ORDERS_SUM'] <= 5400) echo '4';
			if ($ar_sales['UF_ORDERS_SUM'] > 5400 && $ar_sales['UF_ORDERS_SUM'] <= 10000) echo '3';
			if ($ar_sales['UF_ORDERS_SUM'] > 10000 && $ar_sales['UF_ORDERS_SUM'] <= 25000) echo '2';
			if ($ar_sales['UF_ORDERS_SUM'] > 25000) echo '1';
			?>
		</td>
	</tr>
	
	
	<?/*$filter = Array
	(
		"USER_ID"               => $ar_sales['ID']

	);
	
	$asUsers = CSaleOrder::GetList(array("ID" => "ASC"), $filter); // выбираем заказы пользователя
	$is_filtered = $asUsers->is_filtered; // отфильтрована ли выборка
	
	$one_two 		= 0;
	$two_three 		= 0;
	$three_four 	= 0;
	$four_five 		= 0;
	$five_six 		= 0;
	$last_now 		= 0;
	
	$order_count 	= 0;
	$order_sum 		= 0;
	
	
	while ($ar_sales = $asUsers->Fetch()) {
		if ($order_count == 0) {
			$first_order = substr($ar_sales['DATE_INSERT'],0,10);
		} elseif ($order_count == 1) {
			$second_order = substr($ar_sales['DATE_INSERT'],0,10);
			$one_two = ((strtotime($second_order) - strtotime($first_order))/86400);
		} elseif ($order_count == 2) {
			$third_order = substr($ar_sales['DATE_INSERT'],0,10);
			$two_three = ((strtotime($third_order) - strtotime($second_order))/86400);
		} elseif ($order_count == 3) {
			$fourth_order = substr($ar_sales['DATE_INSERT'],0,10);
			$three_four = ((strtotime($fourth_order) - strtotime($third_order))/86400);
		} elseif ($order_count == 4) {
			$fifth_order = substr($ar_sales['DATE_INSERT'],0,10);
			$four_five = ((strtotime($fifth_order) - strtotime($fourth_order))/86400);
		} elseif ($order_count == 5) {
			$sixth_order = substr($ar_sales['DATE_INSERT'],0,10);
			$five_six = ((strtotime($sixth_order) - strtotime($fifth_order))/86400);
		}
		
		$last_order = substr($ar_sales['DATE_INSERT'],0,10);
		$last_now = (($today - strtotime($last_order))/86400);
		
		$order_count++;
		$order_sum+=$ar_sales['PRICE'];
	}

	$user = new CUser;
	$fields = Array(
		"UF_ORDERS_COUNT"				=> $order_count,
		"UF_ORDERS_SUM"					=> $order_sum,
		"UF_ONE_TWO"					=> $one_two,
		"UF_TWO_THREE"					=> $two_three,
		"UF_THREE_FOUR"					=> $three_four,
		"UF_FOUR_FIVE"					=> $four_five,
		"UF_FIVE_SIX"					=> $five_six,
		"UF_LAST_NOW"					=> $last_now,
	);
	$user->Update($ar_sales['ID'], $fields);
	*/
}?>
</tbody></table>
<?}
require("/home/bitrix/data/www/www.alpinabook.ru/bitrix/modules/main/include/epilog_after.php");?>