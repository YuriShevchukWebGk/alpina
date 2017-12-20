<?
//$title = "Обзор на книгу " . $arResult['TITLE'];
$title = "Обзор на книгу «" . $arResult['TITLE'] . '»' . ': ' . $arResult['NAME'];

//$description = "📕 Читать обзор на книгу " . $arResult['TITLE'] . "; ".$arResult['COVER_TYPE']."; дата издания: ".$arResult['YEAR'].". Подробности заказа и доставки по 📲 +7 (495) 120 07 04.";

$description = "Прочитайте обзор на книгу «" . $arResult['TITLE'] . "». " . $arResult['NAME'] . " – позволит вам сформировать представление о книге. Купить понравившуюся книгу с доставкой, сможете по ссылке на нашем сайте.";

$APPLICATION->SetPageProperty("title", $title);
$APPLICATION->SetPageProperty("description", $description);

?>