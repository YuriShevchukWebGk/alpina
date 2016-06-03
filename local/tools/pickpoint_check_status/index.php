<?
    require("/home/bitrix/www/bitrix/modules/main/include/prolog_before.php");

    //Data access for PickPoint API
    $dataLogin = $arParams["PICKPOINT"]["DATA_ACCESS"]; 
    $ikn = $arParams["PICKPOINT"]["IKN"]; 
    $urlLogin = "http://e-solution.pickpoint.ru/api/login";
    
    //Request for authorization on PickPoint server
    $content = json_encode($dataLogin);
    $curl = curl_init($urlLogin);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER,
        array("Content-type: application/json"));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
    $json_response = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    $response = json_decode($json_response, true);  
    
    //Request for received orders
    $lastDayMonth = mktime(0, 0, 0, date('m')+1, 0, date('Y'));
    $dataSend = array('SessionId' => $response["SessionId"], 'DateFrom' => '1.'.date('m').'.'.date('Y'), 'DateTo' => strftime("%d", $lastDayMonth).'.'.date('m').'.'.date('Y'), 'State' => 111);
    $urlLabel = "http://e-solution.pickpoint.ru/api/getInvoicesChangeState";
    $content = json_encode($dataSend);
    $curl = curl_init($urlLabel);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER,
        array("Content-type: application/json"));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
    $json_response = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    $response = json_decode($json_response, true);
    
    //Change orders status on site
    foreach ($response as $arOrderPickPoint) {
        $arOrder = CSaleOrder::GetByID($arOrderPickPoint["SenderInvoiceNumber"]);
        if ($arOrder && $arOrder["STATUS_ID"] != "F") {
            $arFields = array("STATUS_ID" => "F");
            CSaleOrder::Update($arOrderPickPoint["SenderInvoiceNumber"], $arFields);
        }
    }
?>