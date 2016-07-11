<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if ($USER->isAdmin()) {
	global $USER;
    CModule::IncludeModule("blog");
    CModule::IncludeModule("iblock");
    CModule::IncludeModule("sale");
    CModule::IncludeModule("catalog");
    CModule::IncludeModule("main");
	$rsCurUser = CUser::GetByID($USER->GetID());
	
	$la = unserialize($rsCurUser->Fetch()[UF_TEST]);
	
	$arFilter = Array("IBLOCK_ID"=>4, "ID"=>60905);
	$res = CIBlockElement::GetList(Array(), $arFilter);
	if ($ob = $res->GetNextElement()){
		$arProps = $ob->GetProperties();
		$arFields = $ob->GetFields();
		echo "<pre>";
		print_r($arProps);
		echo "</pre>";
	}
	echo "<br />";	
	
	$filterGend = Array
	(
		"USER_ID"	=>	$USER->GetID()

	);
	print_r($la);
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