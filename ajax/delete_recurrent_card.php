<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
global $USER;
$user_new = new CUser;
$fields = Array("UF_RECURRENT_ID" => "", "UF_RECURRENT_CARD_ID" => ""); 
$user_new->Update($USER->GetID(), $fields);
?>