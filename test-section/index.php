<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Тестовый раздел");

CSaleOrder::Update("65295", array("USER_DESCRIPTION" => "test"));

?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>