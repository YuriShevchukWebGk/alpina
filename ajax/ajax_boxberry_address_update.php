<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
$order_id = $_REQUEST['ORDER_ID'];  
?>                     
<?
$db_props = CSaleOrderPropsValue::GetList(
        array(), //массив параметров для сортировки
        array(    //фильтр для выборки
                "ORDER_ID" => $order_id, //ID заказа
                "CODE" => array("LOCATION", "ADDRESS") //символьный код свойства для выборки    
            )
);
while ($arProps = $db_props->Fetch())
{
    arshow($arProps);
}
?>          
<a href="#" class="message-map-link" onclick="boxberry.open('boxberry_callback', '<?= BOXBERRY_TOKEN_API?>', 'Москва', '68', <?= 1000?>, <?= 500?>, 0, 50, 50, 50); return false">Выбрать другой ПВЗ</a>