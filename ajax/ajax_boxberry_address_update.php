<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?        
if (!empty($_REQUEST['ORDER_ID'])) {
    $order_id = $_REQUEST['ORDER_ID'];  
    if ($arOrder = CSaleOrder::GetByID($order_id)) {                            
        if($arOrder['DELIVERY_ID'] == BOXBERRY_PICKUP_DELIVERY_ID) {
            if (!empty($_REQUEST['PVZ_ID']) && !empty($_REQUEST['ADDRESS']) && !empty($_REQUEST['PRICE'])) {  
                $pvz_id = $_REQUEST['PVZ_ID'];
                $address = $_REQUEST['ADDRESS'];                                                                 
                //Обновляем стоимость заказа, не работает обновление если потребуется, нужно разобратсья почему
                /*$delivery_price = $_REQUEST['PRICE'];     
                $order_new_price = $arOrder['PRICE'] - $arOrder['PRICE_DELIVERY'] + $delivery_price;  
                $arFields = array (
                    "PRICE" => $order_new_price,
                    "PRICE_DELIVERY" => $delivery_price
                );
                CSaleOrder::Update($ID, $arFields); */ 
                                                      
                //Обновляем адресс и id пункта самовывоза
                $db_props = CSaleOrderPropsValue::GetList(array(), array("ORDER_ID" => 92721, "CODE" => array("ADDRESS", "PVZ_ADDRESS")));
                while ($arProps = $db_props->Fetch()) {
                    $arProperties[$arProps['CODE']]['ORDER_PROPS_ID'] = $arProps['ORDER_PROPS_ID'];
                    $arProperties[$arProps['CODE']]['ID'] = $arProps['ID'];        
                }           
                //ID
                $prop_data_adress = array(
                   "ORDER_ID" => $order_id,
                   "ORDER_PROPS_ID" => $arProperties['ADDRESS']['ORDER_PROPS_ID'], 
                   "CODE" => "ADDRESS",                              
                   "VALUE" => $pvz_id
                );         
                CSaleOrderPropsValue::Update($arProperties['ADDRESS']['ID'], $prop_data_adress);
                //Адрес            
                $prop_data_pvz_adress = array(
                   "ORDER_ID" => $order_id,
                   "ORDER_PROPS_ID" => $arProperties['PVZ_ADDRESS']['ORDER_PROPS_ID'], 
                   "CODE" => "PVZ_ADDRESS",                              
                   "VALUE" => $address
                );      
                CSaleOrderPropsValue::Update($arProperties['PVZ_ADDRESS']['ID'], $prop_data_pvz_adress);
                echo 'Успешно обновлено';
            } else { 
                if ($arBasket = CSaleBasket::GetList(array(), array("ORDER_ID" => $order_id), false, false, array("PRICE", "WEIGHT"))) {                 
                    while ($arItems = $arBasket->Fetch()) {             
                        $order_price = $arItems['PRICE'];
                        $order_weight = $arItems['WEIGHT'];
                    }
                } 
                echo '<a href="#" class="message-map-link" onclick="boxberry.open(\'boxberry_callback\', \''.BOXBERRY_TOKEN_API.'\', \'Москва\', \'68\', '.$order_price.', '.$order_weight.', 0, 50, 50, 50); return false">Изменить пункт выдачи заказов</a>'; 
            }      
        }     
    }                              
}                                                    
?>