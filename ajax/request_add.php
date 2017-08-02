<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("subscribe");
if ($_REQUEST["email"]) {
	$subs_list = CSubscription::GetList(array(), array("EMAIL"=>$_REQUEST["email"]), false)->Fetch();
	if (!$subs_list) {
		
		$subscr = new CSubscription;
		
		$subFields = array(
			"EMAIL" => $_REQUEST["email"],
			"USER_ID" => ($USER->IsAuthorized()? $USER->GetID():false),
			"ACTIVE" => "Y",
			"RUB_ID" => array("1"),
			"CONFIRMED" => "Y"
		);
		$subscr->Add($subFields);

		if ($subscr->Add($subFields)) {
			$str = "Спасибо, что решили читать нас! Мы уже отправили вам письмо с подарком";
		}
	} else {
		$str = "Похоже, вы уже подписаны на нашу рассылку. Спасибо, что читаете нас!";    
	}

	echo $str;     
}?>