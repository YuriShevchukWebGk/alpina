<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if ($USER->isAdmin()) {
	CModule::IncludeModule("iblock");
	
	$ids = array(
		array('id' => '71065', 'track' => '11172502007071'),
		array('id' => '65976', 'track' => '11172502006555'),
		array('id' => '70643', 'track' => '11172502006562'),
		array('id' => '68654', 'track' => '11172502006579'),
		array('id' => '71095', 'track' => '11172502006586'),
		array('id' => '71098', 'track' => '11172502006593'),
		array('id' => '71112', 'track' => '11172502006609'),
		array('id' => '71124', 'track' => '11172502007019'),
		array('id' => '71116', 'track' => '11172502006616'),
		array('id' => '71127', 'track' => '11172502007026'),
		array('id' => '71131', 'track' => '11172502006623'),
		array('id' => '71130', 'track' => '11172502006630'),
		array('id' => '71140', 'track' => '11172502006647'),
		array('id' => '71145', 'track' => '11172502007033'),
		array('id' => '71148', 'track' => '11172502006654'),
		array('id' => '71149', 'track' => '11172502006661'),
		array('id' => '71150', 'track' => '11172502006678'),
		array('id' => '71151', 'track' => '11172502006685'),
		array('id' => '71220', 'track' => '11172502006692'),
		array('id' => '71221', 'track' => '11172502006708'),
		array('id' => '71218', 'track' => '11172502006715'),
		array('id' => '71205', 'track' => '11172502006722'),
		array('id' => '71204', 'track' => '11172502006739'),
		array('id' => '71194', 'track' => '11172502006746'),
		array('id' => '71195', 'track' => '11172502006753'),
		array('id' => '71197', 'track' => '11172502006760'),
		array('id' => '71190', 'track' => '11172502007040'),
		array('id' => '71176', 'track' => '11172502006777'),
		array('id' => '71175', 'track' => '11172502006784'),
		array('id' => '71169', 'track' => '11172502006791'),
		array('id' => '71147', 'track' => '11172502006807'),
		array('id' => '71160', 'track' => '11172502006814'),
		array('id' => '71276', 'track' => '11172502006821'),
		array('id' => '71270', 'track' => '11172502006838'),
		array('id' => '71121', 'track' => '11172502006845'),
		array('id' => '71269', 'track' => '11172502006852'),
		array('id' => '71265', 'track' => '11172502006869'),
		array('id' => '71261', 'track' => '11172502006876'),
		array('id' => '71255', 'track' => '11172502006883'),
		array('id' => '71227', 'track' => '11172502006890'),
		array('id' => '71253', 'track' => '11172502006906'),
		array('id' => '71245', 'track' => '11172502006913'),
		array('id' => '71236', 'track' => '11172502006920'),
		array('id' => '71237', 'track' => '11172502007057'),
		array('id' => '71235', 'track' => '11172502006937'),
		array('id' => '71231', 'track' => '11172502006944'),
		array('id' => '70894', 'track' => '11172502006951'),
		array('id' => '70743', 'track' => '11172502006968'),
		array('id' => '71142', 'track' => '11172502006975'),
		array('id' => '71301', 'track' => '11172502006982'),
		array('id' => '71285', 'track' => '11172502006999'),
		array('id' => '71286', 'track' => '11172502007064'),
		array('id' => '71054', 'track' => '11172502003554'),
		array('id' => '71067', 'track' => '11172502003561'),
		array('id' => '71064', 'track' => '11172502003578'),
		array('id' => '70949', 'track' => '11172502003585'),
		array('id' => '71011', 'track' => '11172502003592'),
		array('id' => '70996', 'track' => '11172502003608'),
		array('id' => '70985', 'track' => '11172502003615'),
		array('id' => '70969', 'track' => '11172502003622'),
		array('id' => '70962', 'track' => '11172502003639'),
		array('id' => '70954', 'track' => '11172502003646'),
		array('id' => '70518', 'track' => '11172502003653'),
		array('id' => '71016', 'track' => '11172502003660'),
		array('id' => '71023', 'track' => '11172502003677'),
		array('id' => '71027', 'track' => '11172502003684'),
		array('id' => '71040', 'track' => '11172502003691')
	);
	
	foreach ($ids as $id) {
		$trackingNumber = '';
		$list = \Bitrix\Sale\Internals\OrderTable::getList(array(
			"select" => array(
				"TRACKING_NUM" => "\Bitrix\Sale\Internals\ShipmentTable:ORDER.TRACKING_NUMBER"
			),
			"filter" => array(
				"!=\Bitrix\Sale\Internals\ShipmentTable:ORDER.TRACKING_NUMBER" => "",
				"=ID" => $id['id']
			),
			'limit'=> 1 
		))->fetchAll();
		
		if (!empty($list[0]['TRACKING_NUM'])) {
			$trackingNumber = $list[0]['TRACKING_NUM'];
		}	
		
		if (empty($trackingNumber)) {
			
			$arFields = array(
				"TRACKING_NUMBER" => $id['track']
			);		
			if ($update = CSaleOrder::Update($id['id'], $arFields)) {
				if (CSaleOrder::StatusOrder($id['id'], "I")) {
					echo $id['id']."*ok*".$id['track']."<br />";
				} else {
					echo $id['id']."*status error*".$id['track']."<br />";
				}
			} else {
				echo $id['id']."*false*".$id['track']."<br />";
			}
		} else {
			if (CSaleOrder::StatusOrder($id['id'], "I")) {
				echo $id['id'].'*already*'.$trackingNumber.'<br />';
			} else {
				echo $id['id']."*status error*".$id['track']."<br />";
			}
		}
	}
	
} else {
	echo "ошибка";
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>