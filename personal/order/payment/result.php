<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$postData = file_get_contents('php://input');
$data = json_decode($postData, true);
  //logger($data, $_SERVER["DOCUMENT_ROOT"].'/logs/log.txt');

if(!empty($data)){
    $secretkey = "secret";

        $x = [
            "status" => "ok",
            "merchant_tx_id" => $data["order"]["order_id"],
        ];

        ksort($x);
        $str = json_encode($x);

        $sign = hash_hmac("SHA256", $str, $secretkey);
        
    $json = '{ "status": "ok", "merchant_tx_id": '.$data["order"]["order_id"].' }';
    
    header('Content-Type: application/json');
    header('X-Signature: '. $sign);
    echo $json;
    
  /*  $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, "https://playground.platbox.com/paybox");
//    curl_setopt($ch, CURLOPT_URL, "http://dev-alpinabook.webgk.ru/test.php");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
     'Content-Type: application/json',
     'X-Signature:'.$sign,
     'Content-Length: ' . strlen($json))
    );
    
    $result_terminal = object_to_array(json_decode(curl_exec($ch)));
    logger($result_terminal, $_SERVER["DOCUMENT_ROOT"].'/logs/log_platbox.txt');
  //  
    
    $headerSent = curl_getinfo($ch, CURLINFO_HEADER_OUT );
    logger($headerSent, $_SERVER["DOCUMENT_ROOT"].'/logs/log_platbox.txt');
   */
}
/*  if($data["payer"] != 'NULL'){
        $json = '{ "status": "ok", "merchant_tx_id": "1001" }';
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
         'Content-Type: application/json X-Signature:'.$sign,
         'Content-Length: ' . strlen($json))
        );
        curl_exec($ch);
  } else {
        $json = '{ "status": "error", "code": "1001" }';
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
         'Content-Type: application/json X-Signature:'.$sign,
         'Content-Length: ' . strlen($json))
        );
        curl_exec($ch);
  }
       */
?>
<?/*$APPLICATION->IncludeComponent(
    "bitrix:sale.order.payment.receive",
    "",
    array(
        "PERSON_TYPE_ID" => "1",
        "COMPOSITE_FRAME_MODE" => "A",
        "COMPOSITE_FRAME_TYPE" => "AUTO"
    ),
    false
);*/?>
