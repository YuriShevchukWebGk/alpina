<?
@set_time_limit(0);
ignore_user_abort(true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");
global $USER;
if ($USER->IsAdmin()){
	$arFilter = Array(
	   //"ID" => 38365,
	   //"USER_ID" => 15,
	   //"PAYED" => "Y",
		//"LOGIN" => "~newuser",
	   ">=DATE_INSERT" => date('d.m.Y', strtotime('yesterday'))
	);
	
	echo date('d.m.Y', strtotime('yesterday'));
	
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
} else {
	echo 'authorize';
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>

<?/*
@set_time_limit(0);
ignore_user_abort(true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");
global $USER;
if ($USER->IsAdmin()){
	$filter = Array
	(
		"LOGIN"             	=> "~newuser"
	);
	$userList = CUser::GetList(($by="LOGIN"), ($order="desc"), $filter); // выбираем пользователей
	$is_filtered = $userList->is_filtered; // отфильтрована ли выборка ?
	
	while($userParams = $userList->Fetch()) {
		$arFilter = Array(
		   "USER_ID" => $userParams[ID],
		   "PAYED" => "Y",
		   "LOGIN" => "~newuser"
		);

		$books = array();
		   
		$db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);

		while ($ar_sales = $db_sales->Fetch())
		{
			$dbItemsInOrder = CSaleBasket::GetList(array("ID" => "ASC"), array("ORDER_ID" => $ar_sales[ID]));
			while ($book = $dbItemsInOrder->GetNext()) {
				$books[$book[PRODUCT_ID]]['ID'] = $book[PRODUCT_ID];
				$books[$book[PRODUCT_ID]]['DATE'] = substr($ar_sales[DATE_INSERT],0,10);
			}

		}
		
		$books = serialize($books);
		print_r($books);

		$user = new CUser;
		$fields = Array(
			"UF_BOOKSBOUGHT"				=> $books
		);

		$user->Update($arFilter['USER_ID'], $fields);	
	}
	echo 'done!';
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");*/?>