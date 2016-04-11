<?php 
        require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
        CModule::IncludeModule("sale");
        CModule::IncludeModule("catalog"); 
        $arFields = array(
            "QUANTITY"=>$_POST["quantity"]
        );
        CSaleBasket::Update($_POST["id"], $arFields); 
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