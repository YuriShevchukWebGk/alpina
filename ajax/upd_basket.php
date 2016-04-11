<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>

<?
/*CModule::IncludeModule("sale");
CModule::IncludeModule("catalog"); 
$arFields = array(
"QUANTITY"=>$_POST["quantity"]
);
CSaleBasket::Update($_POST["id"], $arFields); 
$basket_list = CSaleBasket::GetList(array(), array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "ORDER_ID"=>"NULL", "PRODUCT_ID"=>$_POST["product"]), false, false, array());
while ($basket = $basket_list -> Fetch())
{
echo $basket["QUANTITY"];
}*/
?>
