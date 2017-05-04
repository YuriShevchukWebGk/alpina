<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

@set_time_limit(0);
ignore_user_abort(true);

CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");

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
8190,
6627,
7475,
7365,
6355,
7988,
7659,
7018,
6037,
8214,
8624,
8434,
65392,
7851,
7928,
6551,
7587,
8638,
8204,
6994,
7679,
8636,
8582,
6219,
8550,
8722,
68998,
80512,
7932,
5769,
66427,
8032,
6737,
7944,
7837,
7954,
8342,
5893,
6485,
7720,
60927,
6405,
6625,
8602,
66444,
7849,
8079,
8430,
6829,
8640,
8556,
7657,
5891,
7767,
6605,
7525,
8382,
8013,
66452,
6273,
5841,
7946,
8292,
5669,
6747,
8314,
7032,
7006,
6537,
7726,
7819,
6541,
7750,
6269,
6743,
7694,
6849,
7970,
7877,
8826,
7373,
6777,
7286,
7491,
8598,
5787,
7821,
5587,
7190,
8572,
6385,
7942,
8103,
8008,
8530,
7432,
7030,
7575,
6745,
7775,
8454,
7487,
75968,
7746,
80687,
8256,
7787,
7968,
7643,
8330,
8506,
6267,
8161,
7343,
7825,
7736,
8224,
7813,
7683,
7783,
8392,
6009,
8163,
7073,
7481,
8642,
7716,
8746,
66489,
7855,
7061,
6159,
6307,
8654,
6793,
8075,
8516,
8133,
8004,
8632,
8456,
8522,
8101,
7889,
7885,
8276,
8212,
8402,
8322,
7909,
8040,
8228,
8702,
8248,
7351,
7495,
62229,
5873,
7827,
6341,
6413,
7799,
6087,
8474,
8312,
7940,
6984,
7143,
7513,
8202,
7962,
6313,
7952,
67411,
8268,
8097,
8165,
7509,
6545,
7771,
7857,
8788,
8218,
75445,
7424,
6966,
8002,
6996,
8386,
8318,
7345,
5833,
7689,
8137,
6671,
8410,
5553,
6147,
6685,
7891
);
	
$orders = array(
79892,
79890,
79889,
79888,
79887,
79886,
79884,
79883,
79882,
79881,
79880,
79879,
79878,
79877,
79876,
79873,
79872,
79871,
79870,
79869,
79868,
79867,
79866,
79865,
79863,
79862,
79859,
79858,
79857,
79856,
79855,
79854,
79852,
79848,
79847,
79845,
79843,
79841,
79839,
79838,
79837,
79836,
79835,
79834,
79833,
79832,
79831,
79830,
79829,
79828,
79827,
79824,
79820,
79819,
79818,
79817,
79815,
79814,
79813,
79812,
79811,
79807,
79805,
79804,
79803,
79802,
79800,
79799,
79798,
79797,
79796,
79794,
79793,
79792,
79791,
79790,
79789,
79788,
79787,
79786,
79785,
79784,
79782,
79781,
79780,
79779,
79778,
79776,
79775,
79774,
79772,
79771,
79769,
79768,
79767,
79766,
79764,
79763,
79762,
79761,
79760,
79759,
79757,
79756,
79755,
79754,
79753,
79751,
79747,
79746,
79742,
79741,
79740,
79737,
79734,
79733,
79732,
79730,
79728,
79727,
79726,
79725,
79723,
79722,
79721,
79719,
79718,
79717,
79716,
79715,
79713,
79711,
79710,
79709,
79708,
79707,
79706,
79705,
79704,
79703,
79702,
79701,
79700,
79699,
79698,
79697,
79695,
79692,
79690,
79688,
79687,
79686,
79681,
79680,
79679,
79678,
79677,
79676,
79675,
79674,
79673,
79672,
79671,
79668,
79666,
79665,
79664,
79663,
79662,
79660,
79659,
79658,
79657,
79655,
79654,
79653,
79651,
79650,
79649,
79647,
79646,
79644,
79643,
79642,
79641,
79640,
79639,
79638,
79636,
79634,
79633,
79631,
79630,
79629,
79628,
79627,
79625,
79623,
79622,
79621,
79620,
79618,
79616,
79614,
79613,
79610,
79609,
79608,
79607,
79606,
79604,
79602,
79600,
79598,
79597,
79596,
79594,
79593,
79591,
79590,
79589,
79587,
79584,
79583,
79581,
79580,
79579,
79577,
79576,
79574,
79573,
79571,
79569,
79567,
79566,
79565,
79564,
79563,
79561,
79560,
79556,
79554,
79552,
79551,
79549,
79547,
79544,
79542,
79539,
79538,
79537,
79536,
79535,
79534,
79533,
79532,
79531,
79530,
79529,
79528,
79527,
79526,
79524,
79523,
79522,
79520,
79518,
79517,
79516,
79515,
79514,
79513,
79511,
79507,
79506,
79505,
79504,
79502,
79500,
79497,
79496,
79495,
79494,
79493,
79490,
79489,
79488,
79487,
79486,
79485,
79484,
79483,
79481,
79480,
79479,
79478,
79476,
79475,
79474,
79473,
79472,
79471,
79470,
79468,
79467,
79466,
79465,
79464,
79463,
79461,
79460,
79458,
79457,
79456,
79454,
79453,
79452,
79451,
79450,
79448,
79447,
79446,
79445,
79443,
79441,
79440,
79439,
79438,
79437,
79436,
79432,
79431,
79430,
79429,
79426,
79425,
79424,
79423,
79421,
79419,
79418,
79417,
79416,
79415,
79412,
79411,
79410,
79408,
79406,
79405,
79403,
79402,
79399,
79397,
79395,
79394,
79393,
79391,
79390,
79389,
79388,
79387,
79386,
79384,
79383,
79382,
79381,
79380,
79379,
79378,
79377,
79376,
79375,
79374,
79373,
79370,
79368,
79367,
79366,
79365,
79363,
79362,
79361,
79360,
79358,
79356,
79355,
79353,
79352,
79350,
79349,
79347,
79346,
79343,
79341,
79340,
79339,
79338,
79337,
79336,
79334,
79332,
79330,
79329,
79328,
79327,
79326,
79321,
79320,
79319,
79318,
79316,
79315,
79314,
79313,
79312,
79311,
79310,
79309,
79303,
79302,
79300,
79298,
79296,
79295,
79293,
79292,
79291,
79289,
79286,
79278,
79275,
79273,
79271,
79265,
79264
);

$final_old_price = 0;
$final_new_price = 0;
$final_wdelivery_price = 0;
$final_delivery_price = 0;
$final_quantity = 0;
$final_dicount_sum = 0;

foreach ($orders as $orderno) {
	$order = CSaleOrder::GetByID($orderno);

	if ($order[PAYED] != 'Y')
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
			
			$books_array[$ar_basket[PRODUCT_ID]][NAME] = $ar_basket[NAME]; //Название книги
			$books_array[$ar_basket[PRODUCT_ID]][QUANTITY] += $ar_basket[QUANTITY]; //Количество
			$books_array[$ar_basket[PRODUCT_ID]][OLD_PRICE] = $book_price; //Обычная цена
			$books_array[$ar_basket[PRODUCT_ID]][DISC_SUMM] += ($ar_basket[PRICE]*$ar_basket[QUANTITY]); //Сумма со скидкой
			$books_array[$ar_basket[PRODUCT_ID]][SUMM] += ($book_price*$ar_basket[QUANTITY]); //Сумма без скидкой
			$books_array[$ar_basket[PRODUCT_ID]][DICS_AM] = ($books_array[$ar_basket[PRODUCT_ID]][SUMM] - $books_array[$ar_basket[PRODUCT_ID]][DISC_SUMM]); //Размер скидки
			$books_array[$ar_basket[PRODUCT_ID]][DICS_PRICE] = round($books_array[$ar_basket[PRODUCT_ID]][DISC_SUMM]/$books_array[$ar_basket[PRODUCT_ID]][QUANTITY],1); //Цена со скидкой
			$books_array[$ar_basket[PRODUCT_ID]][DISC_PERC] = round(1 - ($books_array[$ar_basket[PRODUCT_ID]][DISC_SUMM]/$books_array[$ar_basket[PRODUCT_ID]][SUMM]), 3)*100; //Процент скидки
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

foreach ($orders as $orderno) {
	$order = CSaleOrder::GetByID($orderno);
	print_r($order[STATUS_ID]);
	$db_basket = CSaleBasket::GetList(($b="NAME"), ($o="ASC"), array("ORDER_ID"=>$orderno));
	while ($ar_basket = $db_basket->Fetch())
	{
		$book_price = CCatalogProduct::GetByIDEx($ar_basket[PRODUCT_ID]);
		$book_price = $book_price["PRICES"][11]['PRICE'];
		if (array_search($ar_basket[PRODUCT_ID], $sale_books)) { //Выбираем только акционные книги
			$books_array[$ar_basket[PRODUCT_ID]][NAME] = $ar_basket[NAME]; //Название книги
			$books_array[$ar_basket[PRODUCT_ID]][ALL_QUANTITY] += $ar_basket[QUANTITY]; //Количество
			$books_array[$ar_basket[PRODUCT_ID]][OLD_PRICE] = $book_price; //Обычная цена
			$books_array[$ar_basket[PRODUCT_ID]][ALL_DISC_SUMM] += ($ar_basket[PRICE]*$ar_basket[QUANTITY]); //Сумма со скидкой
			$books_array[$ar_basket[PRODUCT_ID]][ALL_SUMM] += ($book_price*$ar_basket[QUANTITY]); //Сумма без скидкой
			$books_array[$ar_basket[PRODUCT_ID]][ALL_DICS_AM] = ($books_array[$ar_basket[PRODUCT_ID]][ALL_SUMM] - $books_array[$ar_basket[PRODUCT_ID]][ALL_DISC_SUMM]); //Размер скидки
			$books_array[$ar_basket[PRODUCT_ID]][ALL_DICS_PRICE] = round($books_array[$ar_basket[PRODUCT_ID]][ALL_DISC_SUMM]/$books_array[$ar_basket[PRODUCT_ID]][ALL_QUANTITY],1); //Цена со скидкой
			$books_array[$ar_basket[PRODUCT_ID]][ALL_DISC_PERC] = round(1 - ($books_array[$ar_basket[PRODUCT_ID]][ALL_DISC_SUMM]/$books_array[$ar_basket[PRODUCT_ID]][ALL_SUMM]), 3)*100; //Процент скидки
		}
	}
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
//echo $books_table;


$books_table = "<table width='100%'><tbody><tr>";
$books_table .="<td>Название</td>";
$books_table .="<td>Цена норм</td>";
$books_table .="<td>Цена со скидкой</td>";
$books_table .="<td>Количество</td>";
$books_table .="<td>Сумма со скидкой</td>";
$books_table .="<td>Сумма без скидки</td>";
$books_table .="<td>Размер скидки</td>";
$books_table .="<td>Процент скидки</td>";

$books_table .="<td>Цена со скидкой (заказано)</td>";
$books_table .="<td>Количество (заказано)</td>";
$books_table .="<td>Сумма со скидкой (заказано)</td>";
$books_table .="<td>Сумма без скидки (заказано)</td>";
$books_table .="<td>Размер скидки (заказано)</td>";
$books_table .="<td>Процент скидки (заказано)</td>";
$books_table .="</tr>";

foreach($books_array as $final_book) {
	$books_table .= "<tr>";
	$books_table .= "<td>".$final_book[NAME]."</td>";
	$books_table .= "<td>".$final_book[OLD_PRICE]."</td>";
	$books_table .= "<td>".$final_book[DICS_PRICE]."</td>";
	$books_table .= "<td>".$final_book[QUANTITY]."</td>";
	$books_table .= "<td>".$final_book[DISC_SUMM]."</td>";
	$books_table .= "<td>".$final_book[SUMM]."</td>";
	$books_table .= "<td>".$final_book[DICS_AM]."</td>";
	$books_table .= "<td>".$final_book[DISC_PERC]."</td>";
	
	$books_table .= "<td>".$final_book[ALL_DICS_PRICE]."</td>";
	$books_table .= "<td>".$final_book[ALL_QUANTITY]."</td>";
	$books_table .= "<td>".$final_book[ALL_DISC_SUMM]."</td>";
	$books_table .= "<td>".$final_book[ALL_SUMM]."</td>";
	$books_table .= "<td>".$final_book[ALL_DICS_AM]."</td>";
	$books_table .= "<td>".$final_book[ALL_DISC_PERC]."</td>";	
	$books_table .= "</tr>";
}

echo $books_table;
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>