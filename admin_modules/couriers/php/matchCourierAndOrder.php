<?
require_once ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
?>

<?

/**
 *
 * Couriers CRUD controller
 *
 * */

class OrderToCourier {

    // -- iblock id with order to courier relations
    public $iblockID = 52;

    /**
     *
     * @var int $orderId
     * @var int $courierId
     * @return json
     *
     * */

    public function create($orderId, $courierId) {

        global $USER;

        $el = new CIBlockElement;
		
		$orders_exploded = explode("|", $orderId);
		$orders_exploded = array_filter($orders_exploded);
		$relations_result = array();
		
		foreach ($orders_exploded as $orderId) {
			$PROP = array();
	        $PROP["ORDER"] = $orderId;
	        $PROP["COURIRER"] = $courierId;
	
	        $arLoadProductArray = Array("MODIFIED_BY" => $USER -> GetID(), "IBLOCK_SECTION_ID" => false, "IBLOCK_ID" => $this -> iblockID, "PROPERTY_VALUES" => $PROP, "NAME" => $orderId);
	
	        if ($relationId = $el -> Add($arLoadProductArray)) {
	            $curInfo = getCourierByID($courierId);
	            $message = new Message();
	            $result = $message->sendMessage($orderId,"CA",$curInfo);
	            $relations_result[$orderId] = $relationId;
	        }
		}
		
		if (is_array($relations_result) && !empty($relations_result)) {
			echo json_encode(array("status"=>"success","msg" => "Курьеры успешно прикреплены к заказу.", "relations" => $relations_result));
		} else {
			echo json_encode(array("status"=>"error","msg" => "Не удалось прикрепить курьера к заказу."));
		}
    }

    /**
     *
     * Read 
     *
     * */

    public function read($idArr) {
        $returnArray = array();
        $arSelect = Array("ID", "IBLOCK_ID", "NAME","PROPERTY_COURIRER");
        $arFilter = Array("IBLOCK_ID"=>$this -> iblockID,"ACTIVE"=>"Y","PROPERTY_ORDER"=>json_decode($idArr,true));
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>100), $arSelect);
        while($ob = $res->GetNextElement()) {
			$arFields = $ob->GetFields();
			$rsUsers = CUser::GetList(($by=""), ($order=""), $filter = Array("ID" => $arFields['PROPERTY_COURIRER_VALUE']),array("FIELDS"=>array("ID","NAME","LAST_NAME","PERSONAL_MOBILE")));
			if($next_cur = $rsUsers->NavNext(true, "f_")) {
				if(!preg_match('/[0-9]/',$next_cur['LAST_NAME'])) {
					$curInfo = $next_cur['NAME']." ".$next_cur['LAST_NAME']." ".$next_cur['PERSONAL_MOBILE'];
				} else {
					$curInfo = $next_cur['NAME']." ".$next_cur['LAST_NAME'];
				}
			}
			array_push($returnArray,array("relationID"=>$arFields['ID'],"orderID"=>$arFields['NAME'],"courierID"=>$arFields['PROPERTY_COURIRER_VALUE'],"courierInfo"=>$curInfo));
        }
        if($returnArray) {
            echo json_encode(array("status"=>"success","msg" => "Список прикрепленных курьеров получен.", "existingCouriers" => $returnArray));
        } else {
            echo json_encode(array("status"=>"error","msg" => "Не удалось получить список прикрепленных курьеров,либо ни к одному курьеру не прикреплено ни одного заказа."));
        }
    }

    /**
     *
     * One moment,bitrix method CIBlockElement::SetPropertyValuesEx returns Null in any case,so there is no reliable way to detect is update success or not 
     * 
     * @var int $relationId
     * @var int $courierId
     * @return json
     *
     * */

    public function update($relationId, $courierId) {
        CIBlockElement::SetPropertyValuesEx($relationId, false, array("COURIRER" => $courierId));
        echo json_encode(array("status"=>"success","msg" => "Relation updated."));
    }

    /**
     *
     * @var int $relationId
     * @return json
     *
     * */

    public function delete($relationId) {
        if (!CIBlockElement::Delete($relationId)) {
            echo json_encode(array("status"=>"error","msg" => "Ошибка при удалении."));
        } else {
            echo json_encode(array("status"=>"success","msg" => "Курьер успешно удален."));
        }
    }

}

$orderToCourierRelation = new OrderToCourier();
$orderToCourierRelation -> $_POST['action']($_POST['first_param'], $_POST['second_param']);
?>