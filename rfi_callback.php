<?
require_once ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
?>
<?
$currentOrderID = trim(ltrim($_POST['order_id'], '0'));
$recurrentOrderID = trim(ltrim($_POST['recurrent_order_id'], '0'));

if ($currentOrderID == $recurrentOrderID && strpos(trim($_POST['type']), 'spg') !== false) {
    $orderArr = CSaleOrder::GetByID($currentOrderID);
    $user_new = new CUser;
    $fields = Array("UF_RECURRENT_ID" => $currentOrderID, "UF_RECURRENT_CARD_ID" => $_POST['card']); 
    $user_new->Update($orderArr['USER_ID'], $fields);
}
?> 