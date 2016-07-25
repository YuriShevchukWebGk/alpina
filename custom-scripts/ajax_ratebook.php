<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if ($USER->isAdmin()) {
	CModule::IncludeModule("iblock");
	$books = array(
	0 => 6349,
	1 => 7915,
	2 => 8570
	);
	foreach ($books as $singlebook) {
		CIBlockElement::SetPropertyValuesEx($singlebook, 4, array('TITLE' => ''));	
	}
} else {
	echo "Ошибка";
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>