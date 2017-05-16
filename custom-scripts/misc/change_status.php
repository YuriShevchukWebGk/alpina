<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if ($USER->isAdmin()) {
CModule::IncludeModule("iblock");
if ($_GET['orders']) {

	$array3 = explode("\n",$_GET['orders']);

	foreach ($array3 as $id) {
		if (CSaleOrder::StatusOrder($id, "K")) {
			echo $id.'*ok<br />';
		} else {
			echo $id."*status error<br />";
		}
	}
} else {?>
	<form action="/custom-scripts/misc/change_status.php">
	<textarea type="text" name="orders" value="" rows="20" cols="45"></textarea><br /><br />
	<input type="submit" value="Поменять статус на Отправлен на почту РФ">
	</form>	
<?}
} else {
	echo "ошибка";
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>