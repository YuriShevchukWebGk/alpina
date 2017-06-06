<?
//Функция получение списка стран accordpost
function get_country_list() {     
    $xmlCountryListRequest = '<request request_type="58" partner_id="'.ACCORDPOST_PARTNER_ID.'" password="'.ACCORDPOST_PASSWORD.'"/>';     
    $curlCountryList = curl_init();
    
    curl_setopt($curlCountryList, CURLOPT_URL, CFG_REQUEST_FULLURL);
    curl_setopt($curlCountryList, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curlCountryList, CURLOPT_POST, true);      
    curl_setopt($curlCountryList, CURLOPT_POSTFIELDS, $xmlCountryListRequest);                          
    curl_setopt($curlCountryList, CURLOPT_SSL_VERIFYPEER, 0);
    
    //Запрос списка стран и обработка ответа
    if($out = curl_exec($curlCountryList)){         
        $response = new SimpleXMLElement($out);   
        if($response['state'] == 0) {
            //Успешный результат, сохраняем в массив
            foreach($response->country as $country) {
                $arCountry[strval($country['country_id'])]['country_id'] = strval($country['country_id']);
                $arCountry[strval($country['country_id'])]['country_id_name'] = strval($country['country_id_name']); 
                $arCountry[strval($country['country_id'])]['country_id_name_en'] = strval($country['country_id_name_en']); 
                $arCountry[strval($country['country_id'])]['country_id_name_fr'] = strval($country['country_id_name_fr']); 
                $arCountry[strval($country['country_id'])]['country_id_trans_type_id'] = strval($country['country_id_trans_type_id']);       
                $arCountry[strval($country['country_id'])]['country_id_trans_type_name'] = strval($country['country_id_trans_type_name']);       
            }                     
         } else {
            foreach($response->error as $error) {  
                echo $error['msg'].'<br>';             
            }  
            return false;                     
        }  
    } else {
        echo 'Не удалось получить список стран'; 
        return false;      
    }    
    curl_close($curlCountryList);   
    return $arCountry;
};

//Функция преобразования название страны
function transform_country_name($countryName) {
    $countryName = strtoupper(trim(strval($countryName))); 
    //Возможно потребуются дополнительные проверки, дописывать сюда
    if ($countryName == 'ЧЕХИЯ') {
        $countryName = 'ЧЕШСКАЯ РЕСПУБЛИКА';    
    } 
    return $countryName;       
}     
     
//Функция проверки существования страны в списке
function get_country_id($arCountry, $countryName){    
    foreach($arCountry as $countryID => $arCountryItem) {  
        if ((transform_country_name($arCountryItem['country_id_name']) == transform_country_name($countryName)) || 
            (transform_country_name($arCountryItem['country_id_name_en']) == transform_country_name($countryName)) || 
            (transform_country_name($arCountryItem['country_id_name_fr']) == transform_country_name($countryName))) {
            return true;
        }
    }  
    return false;     
}

//Создание нового элемента ИБ с отгрузкой Accord
function create_delivery_element($arIDs) {    
    global $USER;                    
    global $DB;                    
                                                   
    //Создадим новую запись в ИБ, для идентификации отгрузок       
    $el = new CIBlockElement;     
    $arProperty = array();                             
    $arLoadProductArray = Array(
        "MODIFIED_BY"     => $USER->GetID(), // элемент изменен текущим пользователем          
        "IBLOCK_ID"       => ACCORDPOST_IBLOCK_ID,         
        "NAME"            => "Отгрузка ".date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()),
        "ACTIVE"          => "Y",            // активен     
    );                                          
                                               
    if($shipment_id = $el -> Add($arLoadProductArray)) {
        $zdoc_id = 'ALPINABOOK'.$shipment_id;         
        
        $elUpdate = new CIBlockElement;
                                          
        //Обновим поле с zdoc_id        
        $arPropertyUpdate = array();
        $arPropertyUpdate['SHIPMENT_ZDOC_ID'] = $zdoc_id;
        $arPropertyUpdate['SHIPMENT_ORDER_ROW'] = $arIDs;
        
        $arLoadProductArrayUpdate = Array(                                                 
            "PROPERTY_VALUES"=> $arPropertyUpdate
        );
                                                                 
        $res = $elUpdate->Update($shipment_id, $arLoadProductArrayUpdate);
        return $shipment_id; 
    } else {
        echo 'Ошибка создания отгрузки на сайте';
        return false;
    } 
}

//Обновление элемента после выгрузки
function update_ib_accordpost($zdoc_id, $arIDs, $order_props){
    global $DB;          
    
    $export_date = date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time());      
    $update_result = false;          
    foreach($arIDs as $ID) { 
        if($order_props[$ID]['PERSON_TYPE_ID'] == LEGAL_ENTITY_PERSON_TYPE_ID) {
            $prop_data = array(
               "ORDER_ID" => $ID,
               "ORDER_PROPS_ID" => EXPORTED_TO_ACCORDPOST_PROPERTY_ID_NATURAL, 
               "CODE" => "EXPORTED_TO_ACCORDPOST",             
               "NAME" => EXPORTED_TO_ACCORDPOST_PROPERTY_NAME_NATURAL,               
               "VALUE" => $export_date
            );                              
            $prop_data_zdoc = array(
               "ORDER_ID" => $ID,
               "ORDER_PROPS_ID" => ZDOC_ID_ACCORDPOST_PROPERTY_ID_NATURAL, 
               "CODE" => "ZDOC_ID",                
               "NAME" => ZDOC_ID_ACCORDPOST_PROPERTY_NAME_NATURAL,                                        
               "VALUE" => $zdoc_id
            );                                                   
        } else { 
            $prop_data = array(
               "ORDER_ID" => $ID,
               "ORDER_PROPS_ID" => EXPORTED_TO_ACCORDPOST_PROPERTY_ID_LEGAL, 
               "CODE" => "EXPORTED_TO_ACCORDPOST",
               "NAME" => EXPORTED_TO_ACCORDPOST_PROPERTY_NAME_LEGAL,                 
               "VALUE" => $export_date
            );                     
            $prop_data_zdoc = array(
               "ORDER_ID" => $ID,
               "ORDER_PROPS_ID" => ZDOC_ID_ACCORDPOST_PROPERTY_ID_LEGAL, 
               "CODE" => "ZDOC_ID",                
               "NAME" => ZDOC_ID_ACCORDPOST_PROPERTY_NAME_LEGAL,                    
               "VALUE" => $zdoc_id
            );               
        }                                                                             
        if(CSaleOrderPropsValue::Add($prop_data) && CSaleOrderPropsValue::Add($prop_data_zdoc)){
            return true;  
        } else {                                                                      
            return false;    
        }
    }   
}

//Функция экспорта в accordpost
function export_to_accordpost($xmlBody, $zdoc_id, $shipment_id, $arIDs, $order_props){     
    //Константы для curl запроса             
    define('CFG_NL', "\n");
    define('CFG_REQUEST_POST', 1);                                                 
    define('CFG_REQUEST_TIMEOUT', 1);
    define('CFG_CONTENT_TYPE', 'text/xml; charset=utf-8');   
    
    //Экспорт заказов        
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, CFG_REQUEST_FULLURL);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);      
    curl_setopt($curl, CURLOPT_POSTFIELDS, $xmlBody);                          
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

    //Запрос и обработка ответа
    if($out = curl_exec($curl)){         
        $response = new SimpleXMLElement($out);   
        if($response['state'] == 0) {
            //Обновим элементы
            if (update_ib_accordpost($zdoc_id, $arIDs, $order_props)) {
                echo 'Выгрузка прошла успешно, номер документа: '.$zdoc_id.'<br>';  
            } else {                                                 
                echo 'Выгрузка прошла успешно, не удалось обновить элемент в системе';    
            }   
        } else {
            foreach($response->error as $error) {  
                echo $error['msg'].'<br>';                     
            }              
            CIBlockElement::Delete($shipment_id); 
            curl_close($curl);    
            die();    
        }  
    } else {
        echo 'Ошибка подключения к серверу Accordpost';  
        CIBlockElement::Delete($shipment_id);   
        curl_close($curl);         
        die();      
    }        
    curl_close($curl);  
}
?>