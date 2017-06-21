<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
/*if(CModule::IncludeModule('iblock'))
{
$arFilter = Array("IBLOCK_ID"=>4, "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, Array("ID","NAME", "SHOW_COUNTER", "SHOW_COUNTER_START"));
while($ar_fields = $res->GetNext())
{
echo "У элемента ".$ar_fields[NAME]." ".round(($ar_fields[SHOW_COUNTER]/(((time() - strtotime($ar_fields[SHOW_COUNTER_START]))/3600/24)))*2)." показов<br>";}
}*/
$orderItems = CSaleBasket::GetList(array("ID" => "ASC"), array("ORDER_ID" => 94101));
$orderItemsResult = '<br /><center><h3 style="color:#393939;font-family: Segoe UI,Roboto,Tahoma,sans-serif;font-size: 20px;font-weight: 400;">Заказанные книги</h3></center><br />';
while($orderItem = $orderItems->GetNext()) {
	$orderItemsResult .= '<a href="'.$orderItem['DETAIL_PAGE_URL'].'" target="_blank" style="color:#393939;font-family: Segoe UI,Roboto,Tahoma,sans-serif;font-size: 16px;line-height:150%;font-weight: 400;">'.$orderItem['NAME'].'</a><br />';
}
echo $orderItemsResult;
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>