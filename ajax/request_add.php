<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("subscribe");
if ($_REQUEST["email"])
{
    $elem_list = CIBlockElement::GetList(array(), array("IBLOCK_ID"=>15, "NAME"=>$_REQUEST["email"]), false, false, array("ID", "NAME"))->Fetch();
        if (!empty($elem_list))
        {
           $str = "Похоже, вы уже подписаны на нашу рассылку. Спасибо, что читаете нас!";
        }
        else
        {
             $subs_list = CSubscription::GetList(array(), array("EMAIL"=>$_REQUEST["email"]), false)->Fetch();
             if (!$subs_list)
             {
                 $subscr = new CSubscription;
                 $subFields = array(
                     "EMAIL" => $_REQUEST["email"],
                     "USER_ID" => ($USER->IsAuthorized()? $USER->GetID():false),
                     "ACTIVE" => "Y",
                     "RUB_ID" => array("1"),
                     "CONFIRMED" => "Y"
                 );
                 $subscr->Add($subFields);

                 $el = new CIBlockElement;
                 $arFields = array(
                     "IBLOCK_ID" => 15,
                     "NAME" => $_REQUEST["email"],
                     "ACTIVE" => "Y"
                 );
                 $el->Add($arFields);
                 $str = "Спасибо, что решили читать нас! Мы уже отправили вам письмо с подарком";
             }
             else
             {
                $str = "Похоже, вы уже подписаны на нашу рассылку. Спасибо, что читаете нас!";    
             }
        }
        
        
    echo $str;     
}?>