<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?
    $orderID=intval($_REQUEST['orderID']);
    $arOrder = CSaleOrder::GetByID($orderID);
    if (!($USER -> IsAuthorized())){
        $array = array("error_auth", $orderID);
        
    } else if (!($arOrder) || ($arOrder["USER_ID"] != $USER -> GetID())) {
        $array = array("error", $orderID);
        //echo "Заказ №".$orderID." не найден.";
    } else {
        $arStatus = CSaleStatus::GetByID($arOrder["STATUS_ID"]);
        $array = array($arStatus["NAME"], $arOrder["DATE_STATUS"]);   
    }
    //    else {
    //        echo "<pre>";
    //        print_r($arOrder);
    //        echo "</pre>";
    //    }
     echo json_encode($array);
?>