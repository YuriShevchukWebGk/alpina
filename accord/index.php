<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
 
//Константы для curl запроса 
define('CFG_NL', "\n");
define('CFG_REQUEST_POST', 1);               
define('CFG_REQUEST_FULLURL', 'https://api.accordpost.ru/ff/v1/wsrv/');
define('CFG_REQUEST_TIMEOUT', 1);
define('CFG_CONTENT_TYPE', 'text/xml; charset=utf-8');

//Шапка с доступами и типом запроса
$xmlBody = '<request request_type="104" partner_id="'.ACCORDPOST_PARTNER_ID.'" password="'.ACCORDPOST_PASSWORD.'" doc_type = "6"/>';      

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, CFG_REQUEST_FULLURL);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);      
curl_setopt($curl, CURLOPT_POSTFIELDS, $xmlBody);                          
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
if($out = curl_exec($curl)){ 
    arshow($out);
    $ar_idoc_id = array();
    $xmlBody = '';        
    $ar_barcode_list = array();
    $response = new SimpleXMLElement($out); 
    foreach ($response->doc as $doc) {    
        $ar_idoc_id[] = $doc['idoc_id'];
        $xmlBody_second_request = '<request request_type="105" partner_id="'.ACCORDPOST_PARTNER_ID.'" password="'.ACCORDPOST_PASSWORD.'" idoc_id="'.$doc['idoc_id'].'"/>';  
        $curl_second_request = curl_init();
        curl_setopt($curl_second_request, CURLOPT_URL, CFG_REQUEST_FULLURL);
        curl_setopt($curl_second_request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_second_request, CURLOPT_POST, true);      
        curl_setopt($curl_second_request, CURLOPT_POSTFIELDS, $xmlBody_second_request);                          
        curl_setopt($curl_second_request, CURLOPT_SSL_VERIFYPEER, 0);    
        if($out_second_request = curl_exec($curl_second_request)){        
            $response_second_request = new SimpleXMLElement($out_second_request);       
            foreach ($response_second_request->doc->parcel as $parcel) { 
                //поменять на barcode                      
                $ar_barcode_list[strval($parcel['order_id'])] = strval($parcel['parcel_id']);
            }
        } ;                                                              
        curl_close($curl_second_request);         
    }                        
}
arshow($ar_barcode_list);                                          
          
curl_close($curl);                                                                 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>