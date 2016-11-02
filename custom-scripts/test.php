<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

	CModule::IncludeModule("iblock");
	CModule::IncludeModule("sale");
$arFilter = Array(
   "USER_ID" => $USER->GetID()
   );

   $books = array();
   
$db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
while ($ar_sales = $db_sales->Fetch())
{
	$dbItemsInOrder = CSaleBasket::GetList(array("ID" => "ASC"), array("ORDER_ID" => $ar_sales[ID]));
	while ($book = $dbItemsInOrder->GetNext()) {
		$books[] = $book[PRODUCT_ID];
	}
}
$books = array_unique($books);
print_r($books);


?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>