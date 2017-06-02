<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

@set_time_limit(0);
ignore_user_abort(true);

CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");
global $USER;
if ($USER->IsAdmin()){
$print_table = "<table width='100%'><tbody><tr>";
$print_table .= "
<td>Номер заказа</td>
<td>Цена без скидки</td>
<td>Цена со скидкой</td>
<td>Цена с доставкой</td>
<td>Стоимость доставки</td>
<td>Количество книг</td>
<td>Размер скидки (%)</td>
<td>Размер скидки (руб)</td>
</tr>
";

$books_table = "<table width='100%'><tbody><tr>";
$books_table .= "
<td>Заказ</td>
<td>Названия</td>
</tr>
";
$sale_books = array(
	8165,
	8454,
	8446,
	8712,
	8254,
	8246,
	66427,
	8698,
	8434,
	8242,
	8175,
	8314,
	8194,
	8460,
	66487,
	8402,
	8584,
	7819,
	8756,
	8714,
	8382,
	8594,
	8278,
	8101,
	65392,
	8650,
	8085,
	8464,
	8177,
	8784,
	8752,
	8410,
	8598,
	8093,
	5609,
	8516,
	8760,
	8624,
	66435,
	7718,
	8696,
	7893,
	8856,
	60907,
	66516,
	7833,
	6908,
	8654,
	8700,
	8228,
	7887,
	8149,
	8470
);
	
$orders = array(
68274,
68267,
68262,
68259,
68257,
68256,
68255,
68249,
68245,
68236,
68230,
68225,
68223,
68221,
68219,
68218,
68211,
68206,
68204,
68202,
68201,
68200,
68199,
68197,
68194,
68193,
68192,
68191,
68190,
68188,
68185,
68183,
68182,
68181,
68180,
68178,
68177,
68175,
68168,
68167,
68165,
68164,
68160,
68159,
68158,
68157,
68156,
68155,
68151,
68150,
68148,
68147,
68144,
68142,
68140,
68139,
68138,
68137,
68136,
68135,
68131,
68130,
68129,
68127,
68125,
68124,
68121,
68118,
68111,
68106,
68105,
68104,
68099,
68094,
68089,
68085,
68080,
68073,
68072,
68071,
68070,
68069,
68068,
68067,
68066,
68065,
68064,
68063,
68062,
68061,
68060,
68059,
68056,
68055,
68054,
68053,
68050,
68049,
68048,
68045,
68044,
68039,
68037
);

$final_old_price = 0;
$final_new_price = 0;
$final_wdelivery_price = 0;
$final_delivery_price = 0;
$final_quantity = 0;
$final_dicount_sum = 0;

foreach ($orders as $orderno) {
	$order = CSaleOrder::GetByID($orderno);

	if ($order[STATUS_ID] != 'D' && $order[STATUS_ID] != 'F' && $order[STATUS_ID] != 'I' && $order[STATUS_ID] != 'K')
		continue;
	print_r($order[STATUS_ID]);
		
	$db_basket = CSaleBasket::GetList(($b="NAME"), ($o="ASC"), array("ORDER_ID"=>$orderno));


	$old_price = 0;
	$new_price = 0;
	$wdelivery_price = 0;
	$delivery_price = 0;
	$quantity = 0;
	
	
	$books_table .= "<tr><td>".$orderno."</td><td>";
	
	while ($ar_basket = $db_basket->Fetch())
	{

		$book_price = CCatalogProduct::GetByIDEx($ar_basket[PRODUCT_ID]);
		$book_price = $book_price["PRICES"][11]['PRICE'];

		
		$quantity += $ar_basket["QUANTITY"];
		$new_price += DoubleVal($ar_basket["PRICE"])*IntVal($ar_basket["QUANTITY"]);
		
		$old_price += $book_price*IntVal($ar_basket["QUANTITY"]);
		if (array_search($ar_basket[PRODUCT_ID], $sale_books)) { //Выбираем только акционные книги
			$books_table .= $orderno."*".$ar_basket[NAME]."*".$ar_basket[QUANTITY]."*".$ar_basket[PRICE]."*".$ar_basket[PRODUCT_ID]."*".$ar_basket[DISCOUNT_VALUE]."*".$book_price."<br />";
		}
	}

	$delivery_price = $order[PRICE] - $new_price;
	if ($delivery_price < 1) {
		$delivery_price = 0;
	}

	$print_table .= "<tr>";
	$print_table .= "<td>".$orderno."</td>"; //Номер заказа
	$print_table .= "<td>".$old_price."</td>"; //Цена без скидки
	$print_table .= "<td>".$new_price."</td>"; //Цена со скидкой
	$print_table .= "<td>".$order[PRICE]."</td>"; //Цена с доставкой
	$print_table .= "<td>".$delivery_price."</td>"; //Стоимость доставки
	$print_table .= "<td>".($quantity)."</td>"; //Количество книг
	$print_table .= "<td>".substr(((-$new_price/$old_price + 1)*100),0,2)."%</td>"; //Размер скидки %
	$print_table .= "<td>".($old_price - $new_price)."</td>"; //Размер скидки руб.
	
	$books_table .= "</td></tr>";
	
	$final_old_price += $old_price;
	$final_new_price += $new_price;
	$final_wdelivery_price += $order[PRICE];
	$final_delivery_price += $delivery_price;
	$final_quantity += $quantity;
	$final_dicount_sum += ($old_price - $new_price);

	$print_table .= "</tr>";
}

$print_table .= "<tr>
<td>ИТОГО</td>
<td>".$final_old_price."</td>
<td>".$final_new_price."</td>
<td>".$final_wdelivery_price."</td>
<td>".$final_delivery_price."</td>
<td>".$final_quantity."</td>
<td>".substr((-$final_new_price/$final_old_price + 1),2,2)."%</td>
<td>".$final_dicount_sum."</td>
</tr>
";
$print_table .= "</tbody></table>";
$books_table .= "</tbody></table>";
echo $print_table;
echo $books_table;
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>