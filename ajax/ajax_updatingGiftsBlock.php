<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale"); CModule::IncludeModule("catalog"); CModule::IncludeModule("iblock");
<<<<<<< HEAD
    $APPLICATION->IncludeComponent(
        "bitrix:sale.gift.basket",
        "basket_gifts",
        array(
            "SHOW_PRICE_COUNT" => 1,
            "PRODUCT_SUBSCRIPTION" => 'N',
            'PRODUCT_ID_VARIABLE' => 'id',
            "PARTIAL_PRODUCT_PROPERTIES" => 'N',
            "USE_PRODUCT_QUANTITY" => 'N',
            "ACTION_VARIABLE" => "actionGift",
            "ADD_PROPERTIES_TO_BASKET" => "Y",

            "BASKET_URL" => "/personal/cart/",
            "APPLIED_DISCOUNT_LIST" => $arResult["APPLIED_DISCOUNT_LIST"],
            "FULL_DISCOUNT_LIST" => $arResult["FULL_DISCOUNT_LIST"],

            "TEMPLATE_THEME" => "blue",
            "PRICE_VAT_INCLUDE" => "Y",
            "CACHE_GROUPS" => "N",

            'BLOCK_TITLE' => "Выберите подарок",
            'HIDE_BLOCK_TITLE' => "N",
            'TEXT_LABEL_GIFT' => "Подарок",
            'PRODUCT_QUANTITY_VARIABLE' => "",
            'PRODUCT_PROPS_VARIABLE' => "prop",
            'SHOW_OLD_PRICE' => "N",
            'SHOW_DISCOUNT_PERCENT' => "Y",
            'SHOW_NAME' => "Y",
            'SHOW_IMAGE' => "Y",
            'MESS_BTN_BUY' => "Выбрать",
            'MESS_BTN_DETAIL' => "Подробнее",
            'PAGE_ELEMENT_COUNT' => 4,
            'CONVERT_CURRENCY' => "Y",
            'HIDE_NOT_AVAILABLE' => "N",
            "LINE_ELEMENT_COUNT" => 4,
        ),
        false
    );
?>
=======

$APPLICATION -> ShowViewContent('gifts_block');?>
>>>>>>> upstream/master
