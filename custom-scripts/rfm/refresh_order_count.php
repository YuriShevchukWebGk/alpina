<?
@set_time_limit(0);
ignore_user_abort(true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");
global $USER;
if ($USER->IsAdmin()){
$users = 0;
$filter = Array
(
    //"TIMESTAMP_1"         => "03.12.2013",
    //"TIMESTAMP_2"         => "09.12.2013",
	//">UF_ORDERS_COUNT"		=>	0,
    "LOGIN"             	=> "~newuser",
	//"ID"					=> 15
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
	$orderList = CSaleOrder::GetList(array("ID" => "ASC"), $filter); // выбираем пользователей
	$is_filtered = $orderList->is_filtered; // отфильтрована ли выборка
	$order_count 	= 0;
	
	while ($orderParams = $orderList->Fetch()) {		
		$order_count++;
	}

	$user = new CUser;
	$fields = Array(
		"UF_ORDERS_COUNT"				=> $order_count
	);
	$user->Update($filter['USER_ID'], $fields);
	$users++;
}
echo 'done!';
echo $users;
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>