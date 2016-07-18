<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if ($USER->isAdmin()) {
	global $USER;
    CModule::IncludeModule("blog");
    CModule::IncludeModule("iblock");
    CModule::IncludeModule("sale");
    CModule::IncludeModule("catalog");
    CModule::IncludeModule("main");

$ids = array(
66873,
68049,
68204,
68654,
68772,
68934,
69159,
69277,
69278,
69391,
69420,
69488,
69512,
69627,
69645,
69769,
69778,
69817,
69824,
69839,
69949,
69951,
69957
);
	foreach ($ids as $id) {
		$arFields = array(
			"EMP_STATUS_ID" => 176979
		);
		if ($update = CSaleOrder::Update($id, $arFields)) {
			echo $id."*ok<br />";
		} else {
			echo $id."*false<br />";
		}
	}
} else {
	echo "ошибка";
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>