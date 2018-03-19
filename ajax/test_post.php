<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>

<?
$json = '{"action":"check","platbox_tx_id":"41151","platbox_tx_created_at":"2018-02-02T16:29:52Z","product":"alpinabook \u0418\u042d","payment":{"amount":49900,"currency":"RUB","exponent":2},"account":{"id":"test@test.ru","location":"","additional":null},"order":{"type":"order_id","order_id":"114497"},"merchant_extra":{},"payer":null,"payment_extra":[]}';
$ch = curl_init();    
curl_setopt($ch, CURLOPT_URL, "https://terramic.ru/test.php");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);   

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
 'Content-Type: application/json',
 'Content-Length: ' . strlen($json))
);    
$result = curl_exec($ch);                 
$result_terminal = object_to_array(json_decode(curl_exec($ch)));
logger($result, $_SERVER["DOCUMENT_ROOT"].'/logs/log_platbox.txt');

?>
