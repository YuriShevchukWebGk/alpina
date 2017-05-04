<?
$_SERVER["DOCUMENT_ROOT"] = '/home/bitrix/www';
define('LOG_FILENAME', $_SERVER["DOCUMENT_ROOT"]."/custom-scripts/log.txt");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER;
CModule::IncludeModule("iblock");
CModule::IncludeModule("sale");
use Bitrix\Main;

$userID = 15;
$groups = Main\UserTable::getUserGroupIds($userID);
$admin = false;

foreach ($groups as $groupId) {
	if ($groupId == 1) {
		$admin = true;
	}
}

if (!$admin)
	echo $USER->AddHitAuthHash('/', $userID);
else
	echo 'admin';

$USER->CleanUpHitAuthAgent();
echo $USER->GetHitAuthHash('/', $userID);

echo '<br />';

echo 1;
echo '<br />';

$clear = array_keys($_GET);
print_r($clear);
//$USER->LoginByHash($cookie_login, '50bc1c97b0d5dd219a6f26594296e07c');
print_r($APPLICATION->GetCurPageParam("", $clear, true));

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>