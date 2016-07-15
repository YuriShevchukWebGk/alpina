<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if ($USER->isAdmin()) {
	global $USER;
    CModule::IncludeModule("blog");
    CModule::IncludeModule("iblock");
    CModule::IncludeModule("sale");
    CModule::IncludeModule("catalog");
    CModule::IncludeModule("main");

$ids = array(
56089,
56381,
56525,
56548,
56806,
56961,
57009,
57086,
57097,
57131,
57222,
57253,
57376,
57433,
57540,
57545,
57552,
57589,
57729,
57829,
57860,
57944,
57966,
57969,
58036,
58150,
58179,
58181,
58231,
58331,
58347,
58500,
58586,
58899,
59009,
59032,
59086,
59213,
59248,
59255,
59349,
59665,
59700,
59854,
59965,
60146,
60324,
60513,
60517,
60534,
60544,
60547,
60705,
60791,
60827,
60861,
60892,
60917,
61004,
61314,
61327,
61410,
61425,
61496,
61549,
61662,
61708,
61711
);
	foreach ($ids as $id) {
		$arFields = array(
			"PAY_SYSTEM_ID" => 12,
			"PAY_SYSTEM_ID" => 12,
			"EMP_STATUS_ID" => 175985,
			"STATUS_ID" => "F"
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