<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    CModule::IncludeModule("sale"); CModule::IncludeModule("catalog"); CModule::IncludeModule("iblock"); CModule::IncludeModule('highloadblock');

    use Bitrix\Highloadblock as HL;
    use Bitrix\Main\Entity;
?>
<?
    switch ($_REQUEST["action"])
    {
        case "add":
            if(intval($_REQUEST["productid"]) > 0){//добавление товара в корзину
                //$allproducts = explode("-", $_REQUEST["productid"]);
                //foreach ($allproducts as $product) {
                $product = intval($_REQUEST["productid"]);
                //$product = intval($_POST["add2basket"]);
                //проверим
                $res = CIBlockElement::GetByID($product);
                if($ar_res = $res->GetNext())
                {
                    $arProps = array();
                    $PRODUCT = $ar_res;

                    $quantity = 1;
                    $ar_res = CPrice::GetBasePrice($PRODUCT["ID"]);
                    $price=$ar_res["PRICE"];
                    if(intval($price)==0){
                        $price = 0;
                        $arFields = array(
                            "PRODUCT_ID" => $PRODUCT["ID"],
                            "QUANTITY" =>  $quantity,
                            "PRODUCT_XML_ID" => $PRODUCT["ID"],
                            "PRICE" => $price,
                            "CURRENCY" => "RUB",
                            "LID" => "s1",
                            "NAME" => $PRODUCT["NAME"],
                            "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                            "PRODUCT_PROVIDER_CLASS" => "CCatalogProductProvider",
                            "MODULE" => "catalog"
                        );
                        $basket_id = CSaleBasket::Add($arFields);
                        $arItem = CSaleBasket::GetByID($basket_id );
                        if($arItem["QUANTITY"]!= $quantity)
                        {
                            $arFields = array("QUANTITY" => $arItem["QUANTITY"]+$quantity, "FUSER_ID" => CSaleBasket::GetBasketUserID());
                            CSaleBasket::Update($basket_id, $arFields);
                        }
                    } else {
                        $basket_id = Add2BasketByProductID($product,$quantity);
                        if($_REQUEST['product_status'] == '22') {
                            $arFields = array(
                               "DELAY" => "Y",
                               "FUSER_ID" => CSaleBasket::GetBasketUserID()
                            );
                            CSaleBasket::Update($basket_id, $arFields);
                        }
                    }

                }

            }
            break;

        case "update":
            $arFields = array(
                "QUANTITY"=>$_REQUEST["quantity"]
            );
            CSaleBasket::Update($_REQUEST["id"], $arFields);
            break;
    }

    $uID = $USER -> GetID();
    $curr_user = CUser::GetByID($uID) -> Fetch();
    $user = $curr_user["NAME"]." ".$curr_user["LAST_NAME"];
    $wish_item_list = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 17, "NAME" => $user, "PROPERTY_PRODUCTS" => $_REQUEST["productid"]), false, false, array("NAME", "ID", "PROPERTY_PRODUCTS")) -> Fetch();
    CIBlockElement::Delete($wish_item_list["ID"]);


    if ($_REQUEST["list"]) {
        $list_user = CUser::GetByID($_REQUEST["list"]) -> Fetch();
        $list_user_name = $list_user["NAME"]." ".$list_user["LAST_NAME"];
    }
    else {
        $list_user = CUser::GetByID($uID) -> Fetch();
        $list_user_name = $list_user["NAME"]." ".$list_user["LAST_NAME"];
    }

    global $WishFilter;
    $WishFilter["NAME"] = $list_user_name;
   $APPLICATION->IncludeComponent(
        "bitrix:sale.basket.basket",
        "basket",
        array(
            "COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
            "COLUMNS_LIST" => array(
                0 => "NAME",
                1 => "DISCOUNT",
                2 => "PROPS",
                3 => "DELETE",
                4 => "DELAY",
                5 => "PRICE",
                6 => "QUANTITY",
                7 => "SUM",
            ),
            "AJAX_MODE" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "PATH_TO_ORDER" => "/personal/order/make/",
            "HIDE_COUPON" => "N",
            "QUANTITY_FLOAT" => "N",
            "PRICE_VAT_SHOW_VALUE" => "Y",
            "SET_TITLE" => "Y",
            "AJAX_OPTION_ADDITIONAL" => "",
            "OFFERS_PROPS" => array(
                0 => "SIZES_SHOES",
                1 => "SIZES_CLOTHES",
                2 => "COLOR_REF",
            ),
            "COMPONENT_TEMPLATE" => "basket",
            "USE_PREPAYMENT" => "N",
            "AUTO_CALCULATION" => "Y",
            "ACTION_VARIABLE" => "basketAction",
            "USE_GIFTS" => "Y",
            "GIFTS_BLOCK_TITLE" => "Выберите один из подарков",
            "GIFTS_HIDE_BLOCK_TITLE" => "N",
            "GIFTS_TEXT_LABEL_GIFT" => "Подарок",
            "GIFTS_PRODUCT_QUANTITY_VARIABLE" => "",
            "GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",
            "GIFTS_SHOW_OLD_PRICE" => "N",
            "GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
            "GIFTS_SHOW_NAME" => "Y",
            "GIFTS_SHOW_IMAGE" => "Y",
            "GIFTS_MESS_BTN_BUY" => "Выбрать",
            "GIFTS_MESS_BTN_DETAIL" => "Подробнее",
            "GIFTS_PAGE_ELEMENT_COUNT" => "4",
            "GIFTS_CONVERT_CURRENCY" => "N",
            "GIFTS_HIDE_NOT_AVAILABLE" => "N",
            "TEMPLATE_THEME" => "blue"
        ),
        false
    );

?>