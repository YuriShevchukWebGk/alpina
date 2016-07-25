<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if ($USER->isAdmin()) {
	global $USER;
    CModule::IncludeModule("blog");
    CModule::IncludeModule("iblock");
    CModule::IncludeModule("sale");
    CModule::IncludeModule("catalog");
    CModule::IncludeModule("main");
	$rsCurUser = CUser::GetByID($USER->GetID());
	
	$la = unserialize($rsCurUser->Fetch()["UF_TEST"]);
	
	$arFilter = Array("IBLOCK_ID"=>4, "ID"=>70007);
	$res = CIBlockElement::GetList(Array(), $arFilter);
	if ($ob = $res->GetNextElement()){
		$arProps = $ob->GetProperties();
		$arFields = $ob->GetFields();
		echo "<pre>";
		//print_r($arProps);
		echo "</pre>";
		$isSecure = false;
		if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
			$isSecure = true;
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
			$isSecure = true;
		}
		$REQUEST_PROTOCOL = $isSecure ? 'https' : 'http';
		echo $REQUEST_PROTOCOL;
		//CIBlockElement::SetPropertyValuesEx(60905, 4, array('appstore' => '231', 'android' => '232'));	
	}
	echo "<br />";	
	
	$filterGend = Array
	(
		"USER_ID"	=>	$USER->GetID()

	);
	//print_r($la);
	$userGend = new CUser;
	$links = '';

	$fieldsGend = Array(
		"UF_TEST"						=> $links
	);
	//if ($userGend->Update(15, $fieldsGend)) echo 1;
	
} else {
	echo "ошибка";
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>