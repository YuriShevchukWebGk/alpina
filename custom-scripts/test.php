<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

	CModule::IncludeModule("iblock");
	CModule::IncludeModule("sale");
$arFilter = Array(
	"USER_ID" => $USER->GetID(),
	"PAYED" => "Y"
   );

   $books = array();
   
$db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
$i = 0;
while ($ar_sales = $db_sales->Fetch())
{
	$dbItemsInOrder = CSaleBasket::GetList(array("ID" => "ASC"), array("ORDER_ID" => $ar_sales[ID]));
	while ($book = $dbItemsInOrder->GetNext()) {
		$books[$book[PRODUCT_ID]]['ID'] = $book[PRODUCT_ID];
		$books[$book[PRODUCT_ID]]['DATE'] = substr($ar_sales[DATE_INSERT],0,10);
		$i++;
	}
}
array_unique($books);
echo '<pre>';
print_r($books);
echo '</pre>';

?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>