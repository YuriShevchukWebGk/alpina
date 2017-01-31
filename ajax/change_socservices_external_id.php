<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
if ($_SERVER['HTTP_X_REAL_IP'] == '91.201.253.5') {
    global $USER;
    $user_new = new CUser;       
    $rsUser = CUser::GetByID($USER->GetID());
    $arUser = $user_new->Fetch();
    if($arUser["EXTERNAL_AUTH_ID"] != '') {
        $fields = Array("EXTERNAL_AUTH_ID" => "");              
        $user_new->Update($USER->GetID(), $fields);        
    }                                                
}   
?>