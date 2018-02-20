<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if ($USER->isAdmin()) {
    CModule::IncludeModule("iblock");
if ($_GET['tracks']) {

$array3 = explode("\n",$_GET['tracks']);

$array2 = array();
foreach ($array3 as $for2) {
    $array2[] = explode(",", $for2);
}

    foreach ($array2 as $id) {

		$arOrder = CSaleOrder::GetByID($id[0]);

		if ($arOrder['STATUS_ID'] == "F") {
			echo $id[0].' - skip<br />';
			continue;
		}

		if ($id[0] == '' || $id[1] == '') {
			echo $id[0].$id[1].' - empty<br />';
			continue;
		}


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
                    $message = new Message();
                    if($_SESSION["MESSAGE_STATE"] != "I" || $_SESSION["MESSAGE_ORDER"] != $id[0] || $_SESSION["MESSAGE_TRACING"] != $trackingNumber){
                        $result = $message->sendMessage($id[0],'PS');
                    }
                    $_SESSION["MESSAGE_STATE"] = "I";
                    $_SESSION["MESSAGE_TRACING"] = $trackingNumber;
                    $_SESSION["MESSAGE_ORDER"] = $id[0];
                } else {
                    echo $id[0]."*status error*".$id[1]."<br />";
                }
            } else {
                echo $id[0]."*false*".$id[1]."<br />";
            }
        } else {
            $arFields = array(
                "TRACKING_NUMBER" => $id[1]
            );
            if ($update = CSaleOrder::Update($id[0], $arFields)) {
                echo $id[0]."*ok arleady*".$id[1]."<br />";
                if (CSaleOrder::StatusOrder($id[0], "I")) {
                    //echo $id[0]."*ok arleady*".$id[1]."<br />";
                    //$message = new Message();
                    //$result = $message->sendMessage($id[0],'PS');
                } else {
                    //echo $id[0]."*status error*".$id[1]."<br />";
                }
            } else {
                echo $id[0]."*false*".$id[1]."<br />";
            }
        }
    }
} else {?>
    <form action="/custom-scripts/test2.php">
    <textarea type="text" name="tracks" value="" rows="20" cols="45"></textarea><br /><br />
    <input type="submit" value="Загрузить трэки">
    </form>
<?}
} else {
    echo "ошибка";
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>