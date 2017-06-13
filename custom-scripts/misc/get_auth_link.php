<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER;
use Bitrix\Main;

if ($USER->isAdmin()) {

if ($_GET['login']) {
	
	$login = $_GET['login'];

	$filter = Array(
		"ACTIVE"              => "Y",
		"LOGIN"               => $login
	);
	
	$rsUsers = CUser::GetList($by = 'ID', $order = 'ASC', $filter);

	if ($user = $rsUsers->Fetch()) {
		$userID = $user[ID];

		if (!empty($_GET['url']))
			$url = $_GET['url'];
		else
			$url = '/';
		
		$groups = Main\UserTable::getUserGroupIds($userID);
		$admin = false;
		
		foreach ($groups as $groupId) {
			if ($groupId == 1) {
				$admin = true;
			}
		}

		if (!$admin)
			echo 'https://www.alpinabook.ru'.$url.'?bx_hit_hash='.$USER->AddHitAuthHash($url, $userID);
		else
			echo 'admin';
	} else {
		echo 'Нет такого юзера';
	}
} else {?>
	<form action="/custom-scripts/misc/get_auth_link.php">
	Логин пользователя <input type="text" value="" name="login" required /><br /><br />
	
	Страница https://www.alpinabook.ru<input type="text" value="" name="url" /><br /><br />
	
	<input type="submit" value="Получить ссылку для авторизации">
	</form>	
<?}
} else {
	echo "ошибка";
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>