<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("sale");

if ($_GET['books']) {

$array3 = explode("\n",$_GET['books']);

$array2 = array();

foreach ($array3 as $for2) {
	$array2[] = explode(",", $for2);
}

foreach ($array2 as $id) {
	if(empty($id[1]))
		$id[1] = 1;
	if (Add2BasketByProductID($id[0], $id[1]))
		echo $id[0].' ok<br />';
}
	
} else {?>
    <form action="/custom-scripts/misc/addtocartmultiple.php">
    <textarea type="text" name="books" value="" rows="20" cols="45" placeholder="id,количество или id на новой строке"></textarea><br /><br />
    <input type="submit" value="Добавить в корзину">
    </form>    
<?}?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>