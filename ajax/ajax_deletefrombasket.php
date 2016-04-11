<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale"); CModule::IncludeModule("catalog"); CModule::IncludeModule("iblock");
?>
<?
if(intval($_REQUEST["productid"]) > 0){//добавление товара в корзину

    
    //$allproducts = explode("-", $_REQUEST["productid"]);
    //foreach ($allproducts as $product) {
    $product = intval($_REQUEST["productid"]);
    
    //$product = intval($_POST["add2basket"]);
    //проверим     
    CSaleBasket::Delete($product);

}
$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.small", "hiding_basket", Array(
        "PATH_TO_BASKET" => "/personal/basket.php",    // Страница корзины
        "PATH_TO_ORDER" => "/personal/order.php",    // Страница оформления заказа
        "SHOW_DELAY" => "Y",    // Показывать отложенные товары
        "SHOW_NOTAVAIL" => "Y",    // Показывать товары, недоступные для покупки
        "SHOW_SUBSCRIBE" => "Y",    // Показывать товары, на которые подписан покупатель
    ),
    false
);
?>