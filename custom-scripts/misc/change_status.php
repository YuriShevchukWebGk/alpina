<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$userGroup = CUser::GetUserGroup($USER->GetID());
if ($USER->isAdmin() || in_array(6,$userGroup)) {
CModule::IncludeModule("iblock");
if ($_GET['orders'] && $_GET['status']) {

	$array3 = explode("\n",$_GET['orders']);

	foreach ($array3 as $id) {
		if (CSaleOrder::StatusOrder($id, "D")) {
			echo $id.'*ok<br />';
		} else {
			echo $id."*status error<br />";
		}
	}
} else {?>
	<style>
		*{font-family:Courier New, monospace!important;font-size:16px;}
	</style>
	
	<div style="margin: 50px auto 0;width:300px">
		<form action="/custom-scripts/misc/change_status.php">
			<textarea type="text" name="orders" value="" rows="20" cols="6" placeholder="Каждый заказ на новой строке"></textarea><br /><br />
			
			<select name="status" size="6">
				<option value="F">F - Выполнен</option>
				<option value="D">D - Оплачен</option>
				<option value="A">A - Аннулирован</option>
				<option value="C">C - Собран</option>
				<option value="I">I - В пути</option>
				<option value="N">N - Новый</option>
			</select>
			
			<br /><br />
			
			<input type="submit" value="Поменять статус">
		</form>	
	</div>
<?}
} else {
	echo "ошибка";
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>