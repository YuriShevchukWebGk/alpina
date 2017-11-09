<?
$title = "Обзор на книгу " . $arResult['TITLE'];

$description = "📕 Читать обзор на книгу " . $arResult['TITLE'] . "; ".$arResult['COVER_TYPE']."; дата издания: ".$arResult['YEAR'].". Подробности заказа и доставки по 📲 +7 (495) 120 07 04.";

$APPLICATION->SetPageProperty("title", $title);
$APPLICATION->SetPageProperty("description", $description);
?>