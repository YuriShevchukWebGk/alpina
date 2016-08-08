<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if ($USER->isAdmin()) {
	CModule::IncludeModule("iblock");
	
	$ids = array(
array('id'=>'67798', 'track' => '11172502013775'),
array('id'=>'69420', 'track' => '11172502013782'),
array('id'=>'71129', 'track' => '11172502013799'),
array('id'=>'71334', 'track' => '11172502013805'),
array('id'=>'71359', 'track' => '11172502013928'),
array('id'=>'71328', 'track' => '11172502013812'),
array('id'=>'71365', 'track' => '11172502013829'),
array('id'=>'71335', 'track' => '11172502013935'),
array('id'=>'71329', 'track' => '11172502013836'),
array('id'=>'71208', 'track' => '11172502013843'),
array('id'=>'71166', 'track' => '11172502013850'),
array('id'=>'71367', 'track' => '11172502013942'),
array('id'=>'71358', 'track' => '11172502013867'),
array('id'=>'71378', 'track' => '11172502013874'),
array('id'=>'71395', 'track' => '11172502013881'),
array('id'=>'71387', 'track' => '11172502013898'),
array('id'=>'71388', 'track' => '11172502013959'),
array('id'=>'71320', 'track' => '11172502013904'),
array('id'=>'71321', 'track' => '11172502013911'),
array('id'=>'71333', 'track' => 'RA305113722RU'),
array('id'=>'71325', 'track' => 'RA305113736RU'),

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