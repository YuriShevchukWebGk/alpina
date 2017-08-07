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
//echo $orderItemsResult;
?>
<style>
img {padding:0 20px;}
</style>
<div style="margin:0 auto; text-align:center; width:700px;padding-top:200px;">
	<img src="/img/icons/1b.png" align="left"/>
	<img src="/img/icons/2b.png" align="left"/>
	<img src="/img/icons/3b.png" align="left"/>
	<img src="/img/icons/4b.png" align="left"/>
	<img src="/img/icons/5b.png" align="left"/>
	<br /><br />
	<div style="clear:both;text-align:left;font-size:20px;padding-top:100px;">
	5 причин покупать книги на alpina.ru:<br />
1. Мы даем бесплатные электронные книги к бумажным<br />
2. Издательские цены и бесплатная доставка заказов от 2000 рублей по всей России<br />
3. Самая щедрая накопительная скидка: 10% при сумме заказов 3000 рублей и 20% при сумме заказов 10 000 рублей. Однажды накопив, получаешь скидку навсегда<br />
4. Бонусы! С каждой покупки вы получаете баллы, которые тоже можно обменять на книги<br />
5. Мы любим свои книги и своих клиентов, и это очень заметно<br />
</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>