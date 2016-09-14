<?
require_once ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
?>
<?
$file = $_SERVER['DOCUMENT_ROOT'] . '/rfi_callback.txt';
// Открываем файл для получения существующего содержимого
$current = file_get_contents($file);
// Добавляем нового человека в файл
$current .= json_encode($_POST)."\n";
// Пишем содержимое обратно в файл
file_put_contents($file, $current);

$currentOrderID = trim(ltrim($_POST['order_id'], '0'));
$recurrentOrderID = trim(ltrim($_POST['recurrent_order_id'], '0'));

if ($currentOrderID == $recurrentOrderID && trim($_POST['type']) == "spg") {
    $orderArr = CSaleOrder::GetByID($currentOrderID);
    $user_new = new CUser;
    $fields = Array("UF_RECURRENT_ID" => $currentOrderID, "UF_RECURRENT_CARD_ID" => $_POST['card']); 
    $user_new->Update($orderArr['USER_ID'], $fields);
}
?> 