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
75273,
8380,
7704,
60925,
6649,
8696,
8476,
8522,
7815,
8430,
8159,
8155,
8666,
7399,
8398,
7724,
78102,
8320,
75968,
8660,
75436,
8528,
68989,
67827,
8298,
80484,
66460,
79730,
8438,
8570,
8684,
7785,
69020,
7481,
7897,
6998,
8454,
8446,
7918,
6837,
76690,
80473,
70007,
75330,
8480,
8562,
83139,
8402,
8292,
75264,
8290,
8852,
7071,
7990,
8026,
8790,
8738,
6305,
7752,
8466,
8085,
6910,
7467,
7641,
8186,
8246
);
	
$orders = array(
73509,
73508,
73507,
73506,
73504,
73503,
73502,
73500,
73499,
73498,
73497,
73496,
73494,
73493,
73489,
73488,
73487,
73486,
73485,
73484,
73483,
73478,
73476,
73475,
73474,
73471,
73470,
73469,
73468,
73467,
73465,
73464,
73462,
73459,
73458,
73456,
73454,
73453,
73452,
73449,
73448,
73444,
73443,
73442,
73438,
73437,
73436,
73435,
73434,
73433,
73432,
73430,
73426,
73425,
73424,
73423,
73422,
73421,
73420,
73419,
73418,
73416,
73415,
73412,
73408,
73406,
73405,
73404,
73403,
73400,
73399,
73398,
73397,
73396,
73395,
73393,
73392,
73389,
73388,
73386,
73384,
73379,
73378,
73377,
73373,
73372,
73371,
73370,
73369,
73367,
73365,
73364,
73355,
73352,
73349,
73348,
73347,
73346,
73343,
73340,
73339,
73338,
73337,
73336,
73335,
73327,
73325,
73323,
73321,
73320,
73318,
73317,
73316,
73315,
73313,
73310,
73309,
73306,
73304,
73302,
73301,
73299,
73298,
73296,
73292,
73291,
73290,
73288,
73287,
73286,
73284,
73283,
73282,
73281,
73278,
73277,
73276,
73275,
73274,
73272,
73269,
73267,
73266,
73264,
73263,
73260,
73259,
73257,
73256,
73255,
73254,
73253,
73252,
73251,
73250,
73249,
73247,
73246,
73245,
73244,
73242,
73241,
73240,
73239,
73238,
73237,
73235,
73231,
73230,
73229,
73227,
73226,
73225,
73224,
73223,
73220,
73218,
73217,
73213,
73212,
73210,
73207,
73205,
73204,
73203,
73196,
73191,
73187,
73179,
73174,
73173,
73172,
73168,
73167,
73166,
73164,
73163,
73162,
73161,
73160,
73158,
73156,
73155,
73153,
73152,
73151,
73148,
73146,
73145,
73144,
73142,
73141,
73140,
73139,
73137,
73135,
73133,
73132,
73131,
73130,
73129,
73128,
73127,
73126,
73121,
73120,
73119,
73118,
73117,
73115,
73114,
73113,
73112,
73111,
73109,
73108,
73107,
73105,
73104,
73101,
73100,
73099,
73097,
73095,
73092,
73091,
73090,
73089,
73084,
73083,
73082,
73080,
73076,
73075,
73073,
73070,
73069,
73068,
73067,
73066,
73064,
73062,
73061,
73060,
73059,
73058,
73056,
73055,
73053,
73051,
73049,
73048,
73047,
73046,
73045,
73043,
73041,
73037,
73032,
73030,
73024,
73015,
73014,
73013,
73010,
73007,
73004,
73003,
72995,
72992,
72990,
72989,
72988,
72987,
72983,
72981,
72979,
72978
);

$final_old_price = 0;
$final_new_price = 0;
$final_wdelivery_price = 0;
$final_delivery_price = 0;
$final_quantity = 0;
$final_dicount_sum = 0;

foreach ($orders as $orderno) {
	$order = CSaleOrder::GetByID($orderno);

	/*if ($order[STATUS_ID] != 'D' && $order[STATUS_ID] != 'F' && $order[STATUS_ID] != 'I' && $order[STATUS_ID] != 'K')
		continue;*/
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
		if (array_search($ar_basket[PRODUCT_ID], $sale_books) || $ar_basket[PRODUCT_ID] == 75273) { //Выбираем только акционные книги
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