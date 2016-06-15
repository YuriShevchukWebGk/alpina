<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    CModule::IncludeModule("sale"); CModule::IncludeModule("catalog"); CModule::IncludeModule("iblock");
?>
<?  
    switch ($_REQUEST["action"])
    {
        case "add":

            if(intval($_REQUEST["productid"]) > 0){//добавление товара в корзину

                 $quantity = $_REQUEST["quantity"];
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
                            "PRODUCT_PROVIDER_CLASS" => "CCatalogProductProvider",
                            "MODULE" => "catalog"
                        );
                        $basket_id = CSaleBasket::Add($arFields);
                        $arItem = CSaleBasket::GetByID($basket_id );
                        if($arItem["QUANTITY"]!= $quantity) 
                        {
                            $arFields = array("QUANTITY" => $arItem["QUANTITY"]+$quantity);
                            CSaleBasket::Update($basket_id, $arFields);
                        }

                    }else
                        $basket_id = Add2BasketByProductID($product,$quantity);

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
    $curr_user = CUser::GetByID($USER -> GetID()) -> Fetch();
    $user = $curr_user["NAME"]." ".$curr_user["LAST_NAME"];
    $wish_item_list = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 17, "NAME" => $user), false, false, array("NAME", "ID", "PROPERTY_PRODUCTS"));
    while ($wish_item_fetch = $wish_item_list -> Fetch())
    {
        $prod_values[$wish_item_fetch["ID"]] = $wish_item_fetch["PROPERTY_PRODUCTS_VALUE"];
    }
        while ($prod_val = current($prod_values))
        {
            if ($prod_val == $_REQUEST["productid"])
            {
                CIBlockElement::Delete(key($prod_values));
                
            }
            next($prod_values);
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