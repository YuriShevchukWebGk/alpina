<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>

<?
    $data = Array();
    $arOrder = CSaleOrder::GetByID($_POST['id']);
    $data['deliveryID'] = $arOrder['DELIVERY_ID'];
    $data['statusID'] = $arOrder['STATUS_ID'];
    echo json_encode($data);
?> 