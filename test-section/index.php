<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Тестовый раздел");

$authorsList = CIBlockElement::GetList (array(), array("IBLOCK_ID" => 29), false, false, array("ID", "DETAIL_TEXT"));
while ($authors = $authorsList -> Fetch()) {
    CIBlockElement::SetPropertyValuesEx ($authors["ID"], 29, array ("AUTHOR_DETAIL_INFO" => $authors["DETAIL_TEXT"])); 
    
    $currAuthor = new CIBlockElement;
    
    $arLoadProductArray = Array(
        "DETAIL_TEXT" => ""
        );
        
    $res = $currAuthor -> Update ($authors["ID"], $arLoadProductArray);
       
}          

?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>