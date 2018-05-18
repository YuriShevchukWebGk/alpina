<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("subscribe");
global $APPLICATION;

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

        if ($subscr->Add($subFields)) {
            $str = "Спасибо, что решили читать нас! Мы уже отправили вам письмо с подарком";
        }
    } else {
        $str = "Похоже, вы уже подписаны на нашу рассылку. Спасибо, что читаете нас!";
    }
    setcookie("subscribePopup","ok",time()+31536000,'/');
    $APPLICATION->set_cookie("subscribePopup","ok",time()+31536000,"/");
    echo $str;
} elseif ($_REQUEST["close"]) {
    setcookie("subscribePopup", "close",time()+7776000,'/');
    $APPLICATION->set_cookie("subscribePopup","close",time()+7776000,"/");
    echo 'close';
}
?>