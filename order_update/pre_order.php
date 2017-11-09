<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>
<?
global $USER;
if($USER->IsAdmin()){
CModule::IncludeModule("basket");
CModule::IncludeModule("sale");
// Выведем даты всех заказов текущего пользователя за текущий месяц, отсортированные по дате заказа
$arFilter = Array("STATUS_ID" => array("PR"), "PAYED" => "N");
$db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
while ($ar_sales = $db_sales->Fetch())
{
   $dbItemsInOrder = CSaleBasket::GetList(array(), array("ORDER_ID" => $ar_sales["ID"], "PRODUCT_ID" => $_REQUEST["product_id"]), false, false, array("PRODUCT_ID", "PRICE", "ID"));
   if($item_order = $dbItemsInOrder->Fetch()){
        $Fields_item = array(
           "PRICE" => $_REQUEST["price"],
        );
       if($item_order["PRICE"] > $_REQUEST["price"]) {
            $new_price = $ar_sales["PRICE"] - str_replace ('-','', round($item_order["PRICE"] - $_REQUEST["price"], 1));
       } else {
            $new_price = $ar_sales["PRICE"] + str_replace ('-','', round($item_order["PRICE"] - $_REQUEST["price"], 1));
       }

       $Fields_order = array(
          "PRICE" => $new_price,
       );

       $id_item = CSaleBasket::Update($item_order["ID"], $Fields_item);
       $id_order = CSaleOrder::Update($ar_sales["ID"], $Fields_order);

   }

}
   if($id_item && $id_order){
       echo 'Заказы успешно обновлены';
   }
?>
<html>
    <body width="100%">
        <form method="post" action="<?=$APPLICATION->GetCurPage()?>">
            <label> Новая цена <input type="text" name="price" value="<?=$_REQUEST["price"]?>"></label>
            <label> ID книги <input type="text" name="product_id" value="<?=$_REQUEST["product_id"]?>"></label>
            <input type="submit" value="Изменить">
        </form>
    </body>
</html>
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>