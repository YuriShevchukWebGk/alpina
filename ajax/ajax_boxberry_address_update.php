<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
if (!empty($_REQUEST['ORDER_ID'])) {
    $order_id = $_REQUEST['ORDER_ID'];    
    if (!empty($_REQUEST['PVZ_ID']) && !empty($_REQUEST['ADDRESS']) && !empty($_REQUEST['PRICE'])) {
        arshow($_REQUEST);    
    } else { 
        if ($arBasket = CSaleBasket::GetList(array(), array("ORDER_ID" => $order_id), false, false, array("PRICE", "WEIGHT"))) {                 
            while ($arItems = $arBasket->Fetch()) {             
                $order_price = $arItems['PRICE'];
                $order_weight = $arItems['WEIGHT'];
            }
        } 
        echo '<a href="#" class="message-map-link" onclick="boxberry.open(\'boxberry_callback\', \''.BOXBERRY_TOKEN_API.'\', \'Москва\', \'68\', '.$order_price.', '.$order_weight.', 0, 50, 50, 50); return false">Выбрать другой ПВЗ</a>'; 
    }                                   
}                                                    
?>                     
<?

/* 
$db_props = CSaleOrderPropsValue::GetList(
    array(), //массив параметров для сортировки
    array(    //фильтр для выборки
    "ORDER_ID" => $order_id, //ID заказа
    "CODE" => array("LOCATION", "ADDRESS") //символьный код свойства для выборки    
)); 
while ($arProps = $db_props->Fetch())
{
    arshow($arProps);
} */
?>