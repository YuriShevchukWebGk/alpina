<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if ($USER->isAdmin()) {
	global $USER;
    CModule::IncludeModule("blog");
    CModule::IncludeModule("iblock");
    CModule::IncludeModule("sale");
    CModule::IncludeModule("catalog");
    CModule::IncludeModule("main");
	
	$filterGend = Array
	(
		"USER_ID"	=>	$USER->GetID()

	);
	
	$userGend = new CUser;
	$links = serialize(1);

	$fieldsGend = Array(
		"UF_TEST"						=> $links
	);
	if ($userGend->Update(15, $fieldsGend)) echo 1;
	
} else {
	echo "ошибка";
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>