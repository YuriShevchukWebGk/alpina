<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if ($USER->isAdmin()) {
	CModule::IncludeModule("iblock");
	$books = array(
	12088,
	10914,
	11380,
	10894,
	11356,
	12201,
	11652,
	10836,
	11676,
	10724,
	11120,
	11622,
	11722,
	11374,
	11958,
	6549,
	6531,
	6509,
	6547,
	6511,
	5675,
	6545,
	6519,
	6521,
	5629,
	11844,
	11872,
	11296,
	12092,
	12377,
	10862,
	11620,
	11504,
	11674,
	10768,
	11458,
	10946,
	10882,
	11670,
	12032,
	12393,
	10684,
	11534,
	11640,
	11592,
	11802,
	11230,
	10704,
	12355,
	11672,
	11858,
	11452,
	12028,
	11440,
	12004,
	12617,
	12066,
	12068,
	10932,
	11630,
	11848,
	13529,
	10766,
	11596,
	11680,
	12369,
	11328,
	11626,
	10692,
	11682,
	11678,
	10904,
	11082,
	10834,
	11618,
	12397,
	11580,
	12395,
	12357,
	12359,
	6505,
	11974,
	12231,
	11546,
	11358,
	11688,
	11334,
	11644,
	11450,
	11800,
	11746,
	11820,
	11634,
	11612,
	11956,
	11654,
	11444,
	11702,
	11434,
	12122,
	11628,
	11624,
	11890,
	11718,
	11336,
	11902,
	10988,
	12611,
	11396,
	11362,
	10702,
	11448,
	11686,
	11642,
	11432,
	12203,
	11632,
	11850,
	11852,
	11954,
	11304,
	11866,
	11822,
	12140,
	12613,
	12287,
	12044,
	12114,
	11442,
	10830,
	11330,
	12425,
	11884,
	12615,
	11656,
	12171,
	12219,
	12036,
	11742,
	10842,
	11724,
	11668,
	11818,
	11770,
	11700,
	11372,
	10814,
	11360,
	12207,
	11716,
	12341,
	11704,
	10718,
	11614,
	12179,
	11650,
	12205,
	11540,
	11490,
	10700,
	11814,
	11882,
	12251,
	11720,
	11376,
	11454,
	12301,
	11692,
	10758,
	11428,
	11856,
	12094,
	12086,
	11636,
	12002,
	11616,
	11834,
	12419,
	12078,
	11728,
	12253,
	10774,
	10906
	);
	foreach ($books as $singlebook) {
		$obEl = new CIBlockElement();
		$boolResult = $obEl->Update($singlebook,array('ACTIVE' => 'Y'));
		echo $singlebook.' - activated <br />';
	}
} else {
	echo "������";
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>