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
    //"TIMESTAMP_2"         	=> "11.12.2013",
	//">UF_ORDERS_COUNT"		=>	0,
    //"LOGIN"             	=> "a.marchenkov@alpinabook.ru",
	"ID" 					=> 15
);

$patterns = array("/[\:\;\-\,\.\(\)\"\ \+]*/");
$replace = array("");

$rsUsers = CUser::GetList(($by="LOGIN"), ($order="desc"), $filter); // выбираем пользователей
$is_filtered = $rsUsers->is_filtered; // отфильтрована ли выборка ?

$today = strtotime(date('d.m.Y'));
while($ar_sales = $rsUsers->Fetch()) {

	$filter = Array
	(
		"USER_ID"               => $ar_sales['ID'],
		"PAYED" 				=> "Y"

	);
	$asUsers = CSaleOrder::GetList(array("ID" => "ASC"), $filter); // выбираем пользователей
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
		$last_id = $ar_sales['ID'];
	}
	$orders = CSaleOrderPropsValue::GetOrderProps($last_id);
	while($order = $orders->Fetch()) {
		switch($order['CODE']) {
			case 'PHONE':
				$phone = $order["VALUE"];
				break;
			case 'EMAIL':
				$email = $order["VALUE"];
				break;
			case 'F_CONTACT_PERSON':
				$name = $order["VALUE"];
				break;
		}
	}	

	$phone = preg_replace($patterns, $replace,$phone);
	$phone = substr($phone,1);
	$arFilterDel = Array(
		"IBLOCK_ID"=>47,
		"PROPERTY_PHONE"=>$phone,
		">PROPERTY_ORDERS_COUNT"=>1
	);
	$resDel = CIBlockElement::GetList(
    array(
		"SORT"=>"ASC"
        ),$arFilterDel,
    false,
    false,
    array("PROPERTY_ORDERS_COUNT",
          "PROPERTY_ORDERS_SUM", 
          "PROPERTY_LAST_NOW", 
          "PROPERTY_PHONE", 
          "EMAIL", 
          "NAME",
		  "ID"));//проверим есть ли уже телефон в базе
	$is_filtered = $resDel->is_filtered; // отфильтрована ли выборка
	//print_r ($resDel);
	$el = new CIBlockElement;
	while ($Del = $resDel->Fetch()) {
		//$order_count = $Del["PROPERTY_ORDERS_COUNT_VALUE"] + 1;
		$PROP = array(
			"ORDERS_COUNT"				=> $Del["PROPERTY_ORDERS_COUNT_VALUE"] + 1,
			"ORDERS_SUM"				=> $Del["PROPERTY_ORDERS_SUM_VALUE"] + $order_sum,
			"ONE_TWO"					=> $one_two,
			"TWO_THREE"					=> $two_three,
			"THREE_FOUR"				=> $three_four,
			"FOUR_FIVE"					=> $four_five,
			"FIVE_SIX"					=> $five_six,
			"LAST_NOW"					=> $last_now,
			"NAME"						=> $name,
		);
		if (isset($email)) {
			$PROP["EMAIL"] = $email;
		}
		$arLoadProductArray = Array(
		  "MODIFIED_BY"    => 15, 
		  "IBLOCK_SECTION_ID" => false,         
		  "IBLOCK_ID"      => 47,
		  "PROPERTY_VALUES"=> $PROP,
		  "NAME"           => $phone,
		  "ACTIVE"         => "Y",           
		  );
		//echo '<pre>1';print_r ($Del);echo '</pre>';
		$DelUp = $el->Update($Del['ID'], $arLoadProductArray);
	} 
	print_r($PROP);/*else {	
		$PROP = array(
			"ORDERS_COUNT"				=> $order_count,
			"ORDERS_SUM"				=> $order_sum,
			"ONE_TWO"					=> $one_two,
			"TWO_THREE"					=> $two_three,
			"THREE_FOUR"				=> $three_four,
			"FOUR_FIVE"					=> $four_five,
			"FIVE_SIX"					=> $five_six,
			"LAST_NOW"					=> $last_now,
			"PHONE"						=> $phone,
			"EMAIL"						=> $email,
			"NAME"						=> $name,
		);	
		//echo '<pre>2';print_r ($PROP);echo '</pre>';
		$arLoadProductArray = Array(
		  "MODIFIED_BY"    => 15, 
		  "IBLOCK_SECTION_ID" => false,         
		  "IBLOCK_ID"      => 47,
		  "PROPERTY_VALUES"=> $PROP,
		  "NAME"           => $phone,
		  "ACTIVE"         => "Y",           
		  );			
		$PRODUCT_ID = $el->Add($arLoadProductArray);
		print_r($PROP);
	}*/
}
echo 'done!';
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>