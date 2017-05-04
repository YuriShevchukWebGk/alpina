#!/usr/bin/php
<?php
set_time_limit(0);
$_SERVER["DOCUMENT_ROOT"] = '/home/bitrix/www';
define('LOG_FILENAME', $_SERVER["DOCUMENT_ROOT"]."/custom-scripts/log.txt");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
AddMessage2Log('Скрипт выполнен cron', 'update_bought.php');

CModule::IncludeModule("iblock");
CModule::IncludeModule("sale");

global $USER;

	$arFilter = Array(
	   //"ID" => 38365,
	   //"USER_ID" => 15,
	   //"PAYED" => "Y",
		//"LOGIN" => "~newuser",
	   ">=DATE_INSERT" => date('d.m.Y', strtotime('yesterday'))
	);

	
	
	$db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
	$i = 0;
	while ($ar_sales = $db_sales->Fetch())
	{
		$books = array();
		$dbItemsInOrder = CSaleBasket::GetList(array("ID" => "ASC"), array("ORDER_ID" => $ar_sales[ID]));
		$arOrder = CSaleOrder::GetByID($ar_sales[ID]);
		$rsUser = CUser::GetByID($arOrder[USER_ID])->Fetch();
		$booksarray = '';
		
		if (!empty($rsUser[UF_BOOKSBOUGHT])) {
			$booksarray = unserialize($rsUser[UF_BOOKSBOUGHT]);
			while ($book = $dbItemsInOrder->GetNext()) {
				$booksarray[$book[PRODUCT_ID]]['ID'] = $book[PRODUCT_ID];
				$booksarray[$book[PRODUCT_ID]]['DATE'] = substr($ar_sales[DATE_INSERT],0,10);
			}			
		} else {
			while ($book = $dbItemsInOrder->GetNext()) {
				$books[$book[PRODUCT_ID]]['ID'] = $book[PRODUCT_ID];
				$books[$book[PRODUCT_ID]]['DATE'] = substr($ar_sales[DATE_INSERT],0,10);
			}
		}
		if (!empty($booksarray)) {
			$books = $booksarray;
		}
		
		echo '<pre>';
		print_r($books);
		echo '</pre>';
		echo $arOrder[USER_ID];
		$books = serialize($books);
		

		$user = new CUser;
		$fields = Array(
			"UF_BOOKSBOUGHT" => $books
		);

		$user->Update($arOrder[USER_ID], $fields);		

		$i++;
	}
	
	

	echo 'done!';

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>