<?
@set_time_limit(0);
ignore_user_abort(true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");
global $USER;
if ($USER->IsAdmin()){

$filter = Array
(
    //"TIMESTAMP_1"         => "03.12.2013",
    //"TIMESTAMP_2"         => "09.12.2013",
	//">UF_ORDERS_COUNT"		=>	0,
    //"LOGIN"             	=> "~newuser",
	"ID"					=> 15
);
$userList = CUser::GetList(($by="LOGIN"), ($order="desc"), $filter); // выбираем пользователей
$is_filtered = $userList->is_filtered; // отфильтрована ли выборка ?

$today = strtotime(date('d.m.Y'));

while($userParams = $userList->Fetch()) {
	$filter = Array
	(
		"USER_ID"               => $userParams['ID'],
		"PAYED" 				=> "Y"

	);
	print_r ($filter);
	$orderList = CSaleOrder::GetList(array("ID" => "ASC"), $filter); // выбираем пользователей
	$is_filtered = $orderList->is_filtered; // отфильтрована ли выборка
	
	$one_two 		= 0;
	$two_three 		= 0;
	$three_four 	= 0;
	$four_five 		= 0;
	$five_six 		= 0;
	$last_now 		= 0;
	
	$order_count 	= 0;
	$order_sum 		= 0;
	
	$allOrders = array();
	
	while ($orderParams = $orderList->Fetch()) {
		if ($order_count == 0) {
			$first_order = substr($orderParams['DATE_INSERT'],0,10);
		} elseif ($order_count == 1) {
			$second_order = substr($orderParams['DATE_INSERT'],0,10);
			$one_two = ((strtotime($second_order) - strtotime($first_order))/86400);
		} elseif ($order_count == 2) {
			$third_order = substr($orderParams['DATE_INSERT'],0,10);
			$two_three = ((strtotime($third_order) - strtotime($second_order))/86400);
		} elseif ($order_count == 3) {
			$fourth_order = substr($orderParams['DATE_INSERT'],0,10);
			$three_four = ((strtotime($fourth_order) - strtotime($third_order))/86400);
		} elseif ($order_count == 4) {
			$fifth_order = substr($orderParams['DATE_INSERT'],0,10);
			$four_five = ((strtotime($fifth_order) - strtotime($fourth_order))/86400);
		} elseif ($order_count == 5) {
			$sixth_order = substr($orderParams['DATE_INSERT'],0,10);
			$five_six = ((strtotime($sixth_order) - strtotime($fifth_order))/86400);
		}
		
		$person_type_id = $orderParams["PERSON_TYPE_ID"];
		$last_order = substr($orderParams['DATE_INSERT'],0,10);
		$last_now = (($today - strtotime($last_order))/86400);
		
		$order_count++;
		$order_sum+=$orderParams['PRICE'];
		
		
		/* new logic*/
		$thisOrderDate = substr($orderParams['DATE_INSERT'],0,10);
		if (!empty($lastOrderDate)) {
			$betweenTwoOrders = intval((strtotime($thisOrderDate) - strtotime($lastOrderDate))/86400);
		} else {
			$betweenTwoOrders = 'first';
		}
		
		$allOrders[] = array('orderID' => $orderParams['ID'], 'thisOrderTime' => $thisOrderDate, 'betweenTwoOrders' => $betweenTwoOrders, 'orderSum' => intval($orderParams['PRICE']));
		
		$lastOrderDate = substr($orderParams['DATE_INSERT'],0,10);
		/* //new logic */
	}

	echo '<pre>';
	print_r ($allOrders);
	echo '</pre>';
	$allOrders = serialize($allOrders);
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
		"UF_URADRESS"					=> $allOrders,
		"UF_PERSON_TYPE_ID" 			=> $person_type_id,
	);
	$user->Update($filter['USER_ID'], $fields);		
}
echo 'done!<br /><br />';

$allOrders = unserialize($allOrders);
$printSummary = '';
$mediumDelay = 0;
$ordersSum = 0;
$ordersQuantity = count($allOrders);

foreach ($allOrders as $singleOrder) {
	$mediumDelay += $singleOrder["betweenTwoOrders"];
	$ordersSum += $singleOrder["orderSum"];
}

$mediumDelay = intval($mediumDelay/($ordersQuantity-1));
$mediumSum = intval($ordersSum/$ordersQuantity);


$printSummary .= $mediumDelay."<br />";
$printSummary .= $mediumSum."<br />";
$printSummary .= $ordersSum."<br />";
$printSummary .= $ordersQuantity."<br />";

print $printSummary;






}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>