<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    CModule::IncludeModule("sale"); CModule::IncludeModule("catalog"); CModule::IncludeModule("iblock"); CModule::IncludeModule('highloadblock');
?>
<?      
    use Bitrix\Highloadblock as HL;
    use Bitrix\Main\Entity;
    
    $arBasketItems = array();
                                  
    //Если в корзине есть отложенные/предзаказанные товары, соберем всю информацию из HL блока, и вернем корзину в то состояние, которое было до оформления заказа
    $hasDelayedItems = '';
    $dbBasketItems = CSaleBasket::GetList( array("NAME" => "ASC", "ID" => "ASC"), array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL"), false, false, array("ID", "QUANTITY", "DELAY"));
    while ($arItems = $dbBasketItems->Fetch()) { 
        $arBasketItems[] = array("UF_BASKET_ID" => $arItems['ID'], "UF_DELAY_BEFORE" => $arItems['DELAY'], "UF_ACTIVE" => "Y");
        $arBasketID[] = $arItems['ID'];    
    } 
    
    //Проверяем на каждом хите
    if (true) {  
        $hl_block = HL\HighloadBlockTable::getById(PREORDER_BASKET_HL_ID)->fetch();
        $entity = HL\HighloadBlockTable::compileEntity($hl_block);
        $entity_data_class = $entity->getDataClass();   
                       
        $table_id = 'tbl_' . $entity_table_name;
         
        $basket_item_filter = array(                                                                       
            'UF_BASKET_ID' => $arBasketID
        );
                                                    
        $result = $entity_data_class::getList(array(
            "select" => array('*'),
            "filter" => $basket_item_filter, 
            "order"  => array("ID" => "ASC")
        )); 

        $result = new CDBResult($result, $table_id);  
        while ($basket_item = $result->Fetch()) {         
            $ar_basket_items[] = $basket_item;    
            $entity_data_class::Delete($basket_item['ID']); 
        }                        

        foreach($ar_basket_items as $hl_basket_item) {
            $arFields = array(  
               "DELAY" => $hl_basket_item['UF_DELAY_BEFORE']
            );    
            CSaleBasket::Update($hl_basket_item['UF_BASKET_ID'], $arFields);        
        }          
    }
    
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
                    if(intval($price) == 0){ 
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
                        $arItem = CSaleBasket::GetByID($basket_id); 
                        if($arItem["QUANTITY"]!= $quantity) 
                        {
                            $arFields = array("QUANTITY" => $arItem["QUANTITY"]+$quantity);
                            CSaleBasket::Update($basket_id, $arFields);
                        }            
                    } else {                        
                        $basket_id = Add2BasketByProductID($product,$quantity); 
                        if($_REQUEST['product_status'] == '22') {
                            $arFields = array(    
                               "DELAY" => "Y"
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
    //Нужно чтобы корзина не выводилась на странице оформления заказа
        global $APPLICATION;
        $url = $APPLICATION->GetCurPage();                                      
        if (!preg_match("/personal\/cart/i", $url)) {  
        $APPLICATION->IncludeComponent("bitrix:sale.basket.basket", "hiding_basket", Array(
            "ACTION_VARIABLE" => "basketAction",    // Название переменной действия
                "AUTO_CALCULATION" => "Y",    // Автопересчет корзины
                "COLUMNS_LIST" => array(    // Выводимые колонки
                    0 => "NAME",
                    1 => "DISCOUNT",
                    2 => "DELETE",
                    3 => "DELAY",
                    4 => "TYPE",
                    5 => "PRICE",
                    6 => "QUANTITY",
                ),
                "CORRECT_RATIO" => "N",    // Автоматически рассчитывать количество товара кратное коэффициенту
                "GIFTS_BLOCK_TITLE" => "Выберите один из подарков",    // Текст заголовка "Подарки"
                "GIFTS_CONVERT_CURRENCY" => "N",    // Показывать цены в одной валюте
                "GIFTS_HIDE_BLOCK_TITLE" => "N",    // Скрыть заголовок "Подарки"
                "GIFTS_HIDE_NOT_AVAILABLE" => "N",    // Не отображать товары, которых нет на складах
                "GIFTS_MESS_BTN_BUY" => "Выбрать",    // Текст кнопки "Выбрать"
                "GIFTS_MESS_BTN_DETAIL" => "Подробнее",    // Текст кнопки "Подробнее"
                "GIFTS_PAGE_ELEMENT_COUNT" => "4",    // Количество элементов в строке
                "GIFTS_PLACE" => "BOTTOM",    // Вывод блока "Подарки"
                "GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",    // Название переменной, в которой передаются характеристики товара
                "GIFTS_PRODUCT_QUANTITY_VARIABLE" => "quantity",    // Название переменной, в которой передается количество товара
                "GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",    // Показывать процент скидки
                "GIFTS_SHOW_IMAGE" => "Y",    // Показывать изображение
                "GIFTS_SHOW_NAME" => "Y",    // Показывать название
                "GIFTS_SHOW_OLD_PRICE" => "N",    // Показывать старую цену
                "GIFTS_TEXT_LABEL_GIFT" => "Подарок",    // Текст метки "Подарка"
                "HIDE_COUPON" => "N",    // Спрятать поле ввода купона
                "PATH_TO_ORDER" => "/personal/cart/",    // Страница оформления заказа
                "PRICE_VAT_SHOW_VALUE" => "N",    // Отображать значение НДС
                "QUANTITY_FLOAT" => "N",    // Использовать дробное значение количества
                "SET_TITLE" => "Y",    // Устанавливать заголовок страницы
                "TEMPLATE_THEME" => "blue",    // Цветовая тема
                "USE_ENHANCED_ECOMMERCE" => "N",    // Отправлять данные электронной торговли в Google и Яндекс
                "USE_GIFTS" => "Y",    // Показывать блок "Подарки"
                "USE_PREPAYMENT" => "N",    // Использовать предавторизацию для оформления заказа (PayPal Express Checkout)
                "COMPONENT_TEMPLATE" => ".default",
                "DELAY" => $_REQUEST["delay"] //Не менять вкладку, для изменения предзаказа
            ),
            false
        );
    }
?>