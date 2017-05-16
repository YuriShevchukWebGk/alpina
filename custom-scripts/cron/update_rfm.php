#!/usr/bin/php
<?php
set_time_limit(0);
ini_set('max_execution_time', 0);
$_SERVER["DOCUMENT_ROOT"] = '/home/bitrix/www';
define('LOG_FILENAME', $_SERVER["DOCUMENT_ROOT"]."/custom-scripts/log.txt");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER;
include($_SERVER["DOCUMENT_ROOT"]."/custom-scripts/rfm/functions.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("sale");
	
function makePackage($page, $perStep) {
	$filter = [
		
		//">=DATE_UPDATE" => date('d.m.Y h:m:i', strtotime('-2 hours')),
		">=DATE_INSERT" => "01.01.2014",
		//"ID" => 89368,
		"PROPERTY_VAL_BY_CODE_EMAIL" => "a-marchenkov@yandex.ru"
	];

	$nav = [
		"nPageSize" => $perStep,
		"iNumPage" => $page,
		"bShowAll" => false
	];

	// Необходимо выбрать количество записей по фильтру
	$count = $page * $perStep;
	$countMax = CSaleOrder::GetList(['ID' => 'ASC'], $filter, [],    false, ['ID']);
	echo $countMax.'-'.$count.'\n';

	$db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $filter, false, $nav);
	while ($ar_sales = $db_sales->Fetch()) {
		$orderEmail = strtolower(getClientEmail($ar_sales["ID"]));
		
		if (filter_var($orderEmail, FILTER_VALIDATE_EMAIL)) {
			$arSelect = Array("ID", "TIMESTAMP_X");
			$arFilter = Array(
				"IBLOCK_ID" => 67,
				"ACTIVE" => "Y",
				"NAME" => $orderEmail
			);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 9999), $arSelect);
			
			if($ob = $res -> GetNextElement()) {
				echo "Sub exist<br />";
				$ob = $ob->GetFields();
				
				//if (strtotime($ob["TIMESTAMP_X"]) < 1492792120) {
					$filter = Array
					(
						"PROPERTY_VAL_BY_CODE_EMAIL"	=> $orderEmail,
					);
					
					echo $orderEmail.'\n';
					$orderList = CSaleOrder::GetList(array("ID" => "ASC"), $filter); // выбираем пользователей
					$is_filtered = $orderList->is_filtered; // отфильтрована ли выборка

					
					$payedorders = 0;
					$allorders = 0; 
					$orderssum = 0;
					$books = array();
					$ordersnums = '';

					while ($result = $orderList->Fetch()) {
						$allorders++;
					
						if ($result["PAYED"] == "Y") {
							$payedorders++;
							$orderssum += $result["SUM_PAID"];
						}
						
						$dbItemsInOrder = CSaleBasket::GetList(array("ID" => "ASC"), array("ORDER_ID" => $result[ID]));
						while ($book = $dbItemsInOrder->GetNext()) {
							$books[] = $book[PRODUCT_ID];
						}				
						
						$ordersnums .= $result[ID].',';
						$lastorderinfo = $result;
					}
					
					$books = array_unique($books);
					$phone = getPhone($lastorderinfo["ID"]);
					$fname = getClientName($lastorderinfo["ID"]);
					$orderdate = $lastorderinfo["DATE_INSERT"];
					$paysystem = $lastorderinfo["PAY_SYSTEM_ID"];
					$deliverytype = $lastorderinfo["DELIVERY_ID"];
					if (getClientCity($lastorderinfo["ID"]) == "Москва и МО")
						$msk = 909;
					else
						$msk = "";
										
					$date1 = strtotime($orderdate);
					$date2 = strtotime('now');
					$datediff = abs($date1 - $date2)/86400;
				
					//Recency
					if ($datediff >= 501 )
						$recency = 5;
					elseif ($datediff >= 251)
						$recency = 4;
					elseif ($datediff >= 91)
						$recency = 3;
					elseif ($datediff >= 31)
						$recency = 2;
					elseif ($datediff < 31)
						$recency = 1;	
					else {
						$recency = 0;	
						echo "Проблема<br />";
					}
					
					//Frequency
					if ($allorders <= 1)
						$frequency = 5;
					elseif ($allorders == 2)
						$frequency = 4;
					elseif ($allorders == 3)
						$frequency = 3;
					elseif ($allorders < 6)
						$frequency = 2;
					elseif ($allorders >= 6)
						$frequency = 1;	
					else {
						$frequency = 0;	
						echo "Проблема<br />";
					}
						
					//Monetary
					if ($orderssum < 1001)
						$monetary = 5;
					elseif ($orderssum < 2501)
						$monetary = 4;
					elseif ($orderssum < 5001)
						$monetary = 3;
					elseif ($orderssum < 10001)
						$monetary = 2;
					elseif ($orderssum >= 10001)
						$monetary = 1;	
					else {
						$monetary = 0;	
						echo "Проблема<br />";
					}
					
					

					CIBlockElement::SetPropertyValuesEx($ob[ID], 67, array(
						'RECENCY' => $recency,					//Recency
						'FREQUENCY' => $frequency,				//Frequency
						'MONETARY' => $monetary,				//Monetary
						'PHONE' => $phone, 						//Телефон
						'FNAME' => $fname,						//Имя
						'DELIVERY' => $deliverytype,			//Последний способ доставки
						'PAYSYSTEM' => $paysystem,				//Последний способ оплаты
						'MSK' => $msk,							//Из Москвы
						'ALLORDERS' => $allorders,				//Всего заказов
						'PAYEDORDERS' => $payedorders,			//Оплаченных заказов
						'LASTORDER' => $orderdate,				//Дата последнего заказа
						'PAYEDSUM' => $orderssum,				//Сумма оплаченных заказов
						
						'CATEGORIESBOUGHT' => '',				//Из каких категорий книги
						'PRODUCTSBOUGHT' => '',					//Обнуляем старое свойство
						
						'SOURCE' => 913,						//Источник order
						'BOOKSBOUGHT' => $books,				//Оплаченные товары
						'ORDERS' => $ordersnums,				//Номера заказов
						
					));
					$el = new CIBlockElement;
					$el->Update($ob[ID], Array('TIMESTAMP_X' => true));  
				//}
			} else {
				$books = array();
				$allorders = 1;
				$payedorders = 0;
				if ($ar_sales["PAYED"] == "Y") {
					$payedorders = 1;
					$orderssum = $ar_sales["SUM_PAID"];
				}
				
				$dbItemsInOrder = CSaleBasket::GetList(array("ID" => "ASC"), array("ORDER_ID" => $ar_sales[ID]));				
				while ($book = $dbItemsInOrder->GetNext()) {
					$books[] = $book[PRODUCT_ID];
				}
				$books = array_unique($books);
				
				$email = $orderEmail;
				$phone = getPhone($ar_sales["ID"]);
				$fname = getClientName($ar_sales["ID"]);
				$orderdate = $ar_sales["DATE_INSERT"];
				$paysystem = $ar_sales["PAY_SYSTEM_ID"];
				$deliverytype = $ar_sales["DELIVERY_ID"];
				if (getClientCity($ar_sales["ID"]) == "Москва и МО")
					$msk = 909;
				else
					$msk = "";
				
				$el = new CIBlockElement;
				$PROP = array();
				$PROP[768] = $phone; 	//Телефон
				$PROP[769] = $fname;	//Имя
				
				$PROP[770] = $deliverytype;	//Последний способ доставки
				$PROP[771] = $paysystem;	//Последний способ оплаты
				$PROP[772] = $msk;	//Из Москвы
				$PROP[773] = $allorders;	//Всего заказов
				$PROP[774] = $payedorders;	//Оплаченных заказов
				$PROP[775] = $orderdate;	//Дата последнего заказа
				$PROP[776] = $orderssum;	//Сумма оплаченных заказов
				$PROP[800] = 913;	//Источник order
				$PROP[803] = $books;	//Оплаченные товары
				$PROP[803] = $ar_sales["ID"];	//Номера заказов
				
				$date1 = strtotime($orderdate);
				$date2 = strtotime('now');
				$datediff = abs($date1 - $date2)/86400;
			
				//Recency
				if ($datediff >= 501 )
					$PROP[765] = 5;
				elseif ($datediff >= 251)
					$PROP[765] = 4;
				elseif ($datediff >= 91)
					$PROP[765] = 3;
				elseif ($datediff >= 31)
					$PROP[765] = 2;
				elseif ($datediff < 31)
					$PROP[765] = 1;	
				else {
					$PROP[765] = 0;	
					echo "Проблема<br />";
				}
				
				//Frequency
				if ($allorders <= 1)
					$PROP[766] = 5;
				elseif ($allorders == 2)
					$PROP[766] = 4;
				elseif ($allorders == 3)
					$PROP[766] = 3;
				elseif ($allorders < 6)
					$PROP[766] = 2;
				elseif ($allorders >= 6)
					$PROP[766] = 1;	
				else {
					$PROP[766] = 0;	
					echo "Проблема<br />";
				}
					
				//Monetary
				if ($orderssum < 1001)
					$PROP[767] = 5;
				elseif ($orderssum < 2501)
					$PROP[767] = 4;
				elseif ($orderssum < 5001)
					$PROP[767] = 3;
				elseif ($orderssum < 10001)
					$PROP[767] = 2;
				elseif ($orderssum >= 10001)
					$PROP[767] = 1;	
				else {
					$PROP[767] = 0;	
					echo "Проблема<br />";
				}
				
				$arLoadProductArray = Array(
					"MODIFIED_BY"    => 15,
					"IBLOCK_SECTION" => false,
					"IBLOCK_ID"      => 67,
					"PROPERTY_VALUES"=> $PROP,
					"NAME"           => $email,
					"ACTIVE"         => "Y"
				);
				
				if ($el->Add($arLoadProductArray))
					echo 'added';
			}
		}
	}

	// Количество записей, которое мы восстановили из номера страницы и размера страницы
	// Больше общего количества данных
	if ($count >= $countMax) {
		return true; // Полный конец синхронизации
	}
	return false; // Пробовать еще одну партию
}

$page = 1;

while (makePackage($page, 50) == false) {
	$page++;
	echo $page.'\n';
}

echo '<br />done!';
AddMessage2Log('Скрипт выполнен cron RFM', 'update_rfm_new.php');

#####
#####
##### ЧАСТЬ ДВА
#####
#####
#####

$arSelect = array(
	"ID",
	"NAME",
	"PROPERTY_BOOK_ID",
	"PROPERTY_SUB_EMAIL"
);

$filter = array(
	"IBLOCK_ID" => 41,
	"ACTIVE" => "Y",
	">=TIMESTAMP_X" => date('d.m.Y h:m:i', strtotime('-2 hours')),
	">PROPERTY_BOOK_ID" => 1
	
);

$final = array();

$res = CIBlockElement::GetList(Array("PROPERTY_LASTORDER" => "DESC"), $filter, false, array(), $arSelect);

while ($ob = $res -> GetNextElement()) {
	$ob = $ob->GetFields();
	$final[$ob["PROPERTY_SUB_EMAIL_VALUE"]]['mail'] = strtolower($ob["PROPERTY_SUB_EMAIL_VALUE"]);
	if (empty($final[$ob["PROPERTY_SUB_EMAIL_VALUE"]]['ids']))
		$final[$ob["PROPERTY_SUB_EMAIL_VALUE"]]['ids'] = array();
	array_push($final[$ob["PROPERTY_SUB_EMAIL_VALUE"]]['ids'],$ob["PROPERTY_BOOK_ID_VALUE"]);
}
	
foreach ($final as $mail) {
	$arSelect = array(
		"ID",
		"NAME"
	);
	
	$filter = array(
		"IBLOCK_ID" => 67,
		"ACTIVE" => "Y",
		"NAME" => $mail['mail']
	);

	$res = CIBlockElement::GetList(Array("PROPERTY_LASTORDER" => "DESC"), $filter, false, array(), $arSelect);

	if ($ob = $res -> GetNextElement()) {
		$ob = $ob->GetFields();
		$res1 = CIBlockElement::GetByID($ob[ID]);
		$obRes1 = $res1->GetNextElement();
		$ar_res1 = $obRes1->GetProperties();
		
		if (!empty($ar_res1[BOOKSCHAPTERS][VALUE])) {
			array_push($ar_res1[BOOKSCHAPTERS][VALUE], $mail['ids']);
			CIBlockElement::SetPropertyValuesEx($ob[ID], 67, array('BOOKSCHAPTERS' => $ar_res1[BOOKSCHAPTERS][VALUE]));
		} else {
			CIBlockElement::SetPropertyValuesEx($ob[ID], 67, array('BOOKSCHAPTERS' => $mail['ids']));
		}
	} else {
		$el = new CIBlockElement;
		$PROP = array();
		$PROP[800] = 'booksubscribe';
		$PROP[802] = $mail['ids'];
		
		$arLoadProductArray = Array(
			"MODIFIED_BY"    => 15,
			"IBLOCK_SECTION" => false,
			"IBLOCK_ID"      => 67,
			"PROPERTY_VALUES"=> $PROP,
			"NAME"           => $mail['mail'],
			"ACTIVE"         => "Y"
		);
		
		if ($el->Add($arLoadProductArray))
			echo 1;
		else
			echo 2;
	}
}

AddMessage2Log('Скрипт выполнен cron BOOKSUBSCRIBE', 'update_rfm_new.php');

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>