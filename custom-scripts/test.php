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
	
	$stringRecs = file_get_contents('http://api.retailrocket.ru/api/1.0/Recomendation/ItemsToMain/50b90f71b994b319dc5fd855/');
	$recsArray = json_decode($stringRecs);	
	
	$arFilter = Array("IBLOCK_ID"=>4, "PROPERTY_best_seller"=>285);
	$res = CIBlockElement::GetList(Array(), $arFilter);
	while ($ob = $res->GetNextElement()){
		$arProps = $ob->GetProperties();
		$arFields = $ob->GetFields();
		echo "<pre>";
		echo $arFields[NAME];
		CIBlockElement::SetPropertyValuesEx($arFields[ID], 4, array('best_seller' => ''));
		
		if ((time() - strtotime($arProps['STATEDATE']['VALUE']))/86400 > 60) {
			$obEl = new CIBlockElement();
			//CIBlockElement::SetPropertyValuesEx($arFields[ID], 4, array('STATE' => ''));
			echo 'set as old';
		}
		else
			echo 'new';
		echo "</pre>";
	}
	echo "<br />";	
	
	$arFilter = Array("IBLOCK_ID"=>4, "ID"=>$recsArray);
	$res = CIBlockElement::GetList(Array(), $arFilter);
	while ($ob = $res->GetNextElement()){
		$arProps = $ob->GetProperties();
		$arFields = $ob->GetFields();
		echo "<pre>";
		echo $arFields[NAME];
		CIBlockElement::SetPropertyValuesEx($arFields[ID], 4, array('best_seller' => '285'));
		
		if ((time() - strtotime($arProps['STATEDATE']['VALUE']))/86400 > 60) {
			$obEl = new CIBlockElement();
			//CIBlockElement::SetPropertyValuesEx($arFields[ID], 4, array('STATE' => ''));
			echo 'set as old';
		}
		else
			echo 'new';
		echo "</pre>";
	}
	echo "<br />";	
	
	$isSecure = false;
	if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
		$isSecure = true;
	}
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
		$isSecure = true;
	}
	$REQUEST_PROTOCOL = $isSecure ? 'https' : 'http';
	echo $REQUEST_PROTOCOL;	
	
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