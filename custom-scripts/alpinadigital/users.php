<?
@set_time_limit(0);
ignore_user_abort(true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
global $USER;
if ($USER->IsAdmin()){

$filter = Array
(
	"DATE_REGISTER_1" => "04.07.2013 00:00:00",
	"DATE_REGISTER_2" => "04.07.2013 23:59:59",
	"ACTIVE"		  => 'Y',
    "LOGIN"             	=> "mail",
	//"EMAIL"					=> "a-marchenkov@yandex.ru"
);
$userList = CUser::GetList(($by="LOGIN"), ($order="desc"), $filter); // выбираем пользователей
$is_filtered = $userList->is_filtered; // отфильтрована ли выборка ?

$today = strtotime(date('d.m.Y'));	

while($userParams = $userList->Fetch()) {
	echo $userParams[EMAIL].'<br />';
}

}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>