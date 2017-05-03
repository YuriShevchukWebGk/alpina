<?
set_time_limit(0);
ini_set('max_execution_time', 0);
$_SERVER["DOCUMENT_ROOT"] = '/home/bitrix/www';
define('LOG_FILENAME', $_SERVER["DOCUMENT_ROOT"]."/custom-scripts/log.txt");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER;
include($_SERVER["DOCUMENT_ROOT"]."/custom-scripts/rfm/functions.php");
CModule::IncludeModule("iblock");
use Bitrix\Main;

$arSelect = array(
	"ID",
	"NAME"
);

$filter = array(
	"IBLOCK_ID" => 67,
	"ACTIVE" => "Y",
	">PROPERTY_ALLORDERS" => 0
);

$res = CIBlockElement::GetList(Array("PROPERTY_LASTORDER" => "DESC"), $filter, false, array(), $arSelect);

while ($ob = $res -> GetNextElement()) {
	$ob = $ob->GetFields();
	
	$filter = Array
	(
		"ACTIVE"              => "Y",
		"LOGIN"               => $ob["NAME"]
	);
	$rsUsers = CUser::GetList($by = 'ID', $order = 'ASC', $filter);

	if ($user = $rsUsers->Fetch()) {
		$userID = $user[ID];

		$url = '/';
		
		$groups = Main\UserTable::getUserGroupIds($userID);
		$admin = false;
		
		foreach ($groups as $groupId) {
			if ($groupId == 1) {
				$admin = true;
			}
		}

		if (!$admin) {
			//echo $ob["NAME"];
			//echo '<br />';
			//echo $USER->GetHitAuthHash('/', $userID);
			echo 'https://www.alpinabook.ru'.$url.'?bx_hit_hash='.$USER->AddHitAuthHash($url, $userID);
		} else {
			echo 'admin';
		}
		
	} else {
		echo $ob["NAME"].' error<br />';
	}
	
}

	
echo '<br />done!';

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>