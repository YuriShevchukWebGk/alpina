<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if ($USER->isAdmin()) {
	CModule::IncludeModule("iblock");
	
	$ids = array(
/*array('id'=>'71472','track'=>'11172502027321'),
array('id'=>'71373','track'=>'11172502027338'),
array('id'=>'71439','track'=>'11172502027154'),
array('id'=>'71442','track'=>'11172502027161'),
array('id'=>'71445','track'=>'11172502027178'),
array('id'=>'71451','track'=>'11172502027185'),
array('id'=>'71399','track'=>'11172502027192'),
array('id'=>'71410','track'=>'11172502027345'),
array('id'=>'71404','track'=>'11172502027208'),
array('id'=>'71368','track'=>'11172502027215'),
array('id'=>'71477','track'=>'11172502027222'),
array('id'=>'71468','track'=>'11172502027239'),
array('id'=>'71496','track'=>'11172502027246'),
array('id'=>'71501','track'=>'11172502027253'),
array('id'=>'71511','track'=>'11172502027352'),
array('id'=>'71538','track'=>'11172502027369'),
array('id'=>'71353','track'=>'11172502027260'),
array('id'=>'71536','track'=>'11172502027277'),
array('id'=>'71542','track'=>'11172502027284'),
array('id'=>'71552','track'=>'11172502027291'),
array('id'=>'71564','track'=>'11172502027307'),
array('id'=>'71450','track'=>'RA305102795RU'),

*/
	);
	
$array1 = explode("\n","
71513,11172502028236
71570,11172502028083
71573,11172502028090
71362,11172502028106
71584,11172502028243
71585,11172502028113
71602,11172502028120
71381,11172502028250
71657,11172502028137
71638,11172502028144
71633,11172502028151
71631,11172502028168
71617,11172502028175
");

$array2 = array();
foreach ($array1 as $for2) {
	$array2[] = explode(",", $for2);
}
	
	
	
	foreach ($array2 as $id) {
		$trackingNumber = '';
		$list = \Bitrix\Sale\Internals\OrderTable::getList(array(
			"select" => array(
				"TRACKING_NUM" => "\Bitrix\Sale\Internals\ShipmentTable:ORDER.TRACKING_NUMBER"
			),
			"filter" => array(
				"!=\Bitrix\Sale\Internals\ShipmentTable:ORDER.TRACKING_NUMBER" => "",
				"=ID" => $id[0]
			),
			'limit'=> 1 
		))->fetchAll();
		
		if (!empty($list[0]['TRACKING_NUM'])) {
			$trackingNumber = $list[0]['TRACKING_NUM'];
		}	
		
		if (empty($trackingNumber)) {
			
			$arFields = array(
				"TRACKING_NUMBER" => $id[1]
			);		
			if ($update = CSaleOrder::Update($id[0], $arFields)) {
				if (CSaleOrder::StatusOrder($id[0], "I")) {
					echo $id[0]."*ok*".$id[1]."<br />";
				} else {
					echo $id[0]."*status error*".$id[1]."<br />";
				}
			} else {
				echo $id[0]."*false*".$id[1]."<br />";
			}
		} else {
			if (CSaleOrder::StatusOrder($id[0], "I")) {
				echo $id[0].'*already*'.$trackingNumber.'<br />';
			} else {
				echo $id[0]."*status error*".$id[1]."<br />";
			}
		}
	}
	
} else {
	echo "ошибка";
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>