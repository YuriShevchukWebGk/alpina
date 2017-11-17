<?
//Синхронизация остатков при выгрузке в инфоблок 1С
AddEventHandler("catalog", "OnProductUpdate", Array("Exchange1C", "SyncProductQuantity"));
AddEventHandler("catalog", "OnProductAdd", Array("Exchange1C", "SyncProductQuantity"));  
 
//Уведомление и смена статуса с 0 остатках на сайте
AddEventHandler("catalog", "OnBeforeProductUpdate", Array("QuantityChanges", "QuantityOnZero"));  
              
//Логирование изменений элементов
AddEventHandler("iblock", "OnAfterIBlockElementAdd", Array("Exchange1C", "SyncProductQuantityIblock"));
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", Array("Exchange1C", "SyncProductQuantityIblock"));   

class QuantityChanges {                                                 
    function QuantityOnZero($ID, $arFields) {                      
        if($arFields['QUANTITY'] <= 0 && CModule::IncludeModule('iblock')) {     
            $arSelect = Array("CATALOG_QUANTITY", "PROPERTY_STATE", "NAME");
            $arFilter = Array("ID" => $ID, "IBLOCK_ID" => CATALOG_IBLOCK_ID, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
            if ($ob = $res->GetNextElement()) {          
                $ar_product = $ob->GetFields();                       
                //Проверим не является ли предзаказом и не был ли ранее отстаток меньше 0, после чего отправим сообщение и поменяем статус
                if(($ar_product['PROPERTY_STATE_ENUM_ID'] != getXMLIDByCode(CATALOG_IBLOCK_ID, "STATE", "soon")) && ($ar_product['CATALOG_QUANTITY'] <= 0)) {  
                    //Установим новое значение для данного свойства данного элемента          
                    CIBlockElement::SetPropertyValuesEx($ID, false, array('STATE' => getXMLIDByCode(CATALOG_IBLOCK_ID, "STATE", "net_v_nal")));  
                    $view_link = sprintf("https://www.alpinabook.ru/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=%d&type=catalog&ID=%d", CATALOG_IBLOCK_ID, $ID);
                    $ar_template = array(                    
                        "NAME" => $ar_product['NAME'],
                        "URL"  => $view_link
                    );                         
                    CEvent::Send("CATALOG_PRODUCT_NOT_AVAILABLE", array("ru"), $ar_template);                                                                
                }                                                                                                                                
            }                                         
        }             
    }
    
    function QuantityOnMoreThanZero($ID, $arFields) {                      
        if($arFields['QUANTITY'] > 0 && CModule::IncludeModule('iblock')) {     
            $arSelect = Array("CATALOG_QUANTITY", "PROPERTY_STATE", "NAME");
            $arFilter = Array("ID" => $ID, "IBLOCK_ID" => CATALOG_IBLOCK_ID, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
            if ($ob = $res->GetNextElement()) {          
                $ar_product = $ob->GetFields();                       
                //Проверим не является ли предзаказом и не был ли ранее отстаток меньше 0, после чего отправим сообщение и поменяем статус
                if(($ar_product['PROPERTY_STATE_ENUM_ID'] == getXMLIDByCode(CATALOG_IBLOCK_ID, "STATE", "net_v_nal"))) {  
                    //Установим новое значение для данного свойства данного элемента          
                    CIBlockElement::SetPropertyValuesEx($ID, false, array('STATE' => getXMLIDByCode(CATALOG_IBLOCK_ID, "STATE", "")));
                    $view_link = sprintf("https://www.alpinabook.ru/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=%d&type=catalog&ID=%d", CATALOG_IBLOCK_ID, $ID);
                    $ar_template = array(                    
                        "NAME" => $ar_product['NAME'],
                        "URL"  => $view_link
                    );                         
                    CEvent::Send("CATALOG_PRODUCT_AVAILABLE", array("ru"), $ar_template);                                                                  
                }                                                                                                                                
            }                                         
        }             
    }
}

class Exchange1C {                                               
    function SyncProductQuantity($ID, $arFields) {                                                                                 
        logger('Catalog:', $_SERVER["DOCUMENT_ROOT"].'/logs/log_1c.log');         
        logger($ID, $_SERVER["DOCUMENT_ROOT"].'/logs/log_1c.log');       
        logger($arFields, $_SERVER["DOCUMENT_ROOT"].'/logs/log_1c.log');
        
        //Первый запрос для получения значения Bitrix ID
        $arSelect = Array("PROPERTY_ID_BITRIKS");
        $arFilter = Array("ID"=>$ID, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");   
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
        while($arResult = $res->Fetch()) {
            $bitrix_id = $arResult['PROPERTY_ID_BITRIKS_VALUE'];
        }                    
                           
        logger('$bitrix_id:', $_SERVER["DOCUMENT_ROOT"].'/logs/log_1c.log');         
        logger($bitrix_id, $_SERVER["DOCUMENT_ROOT"].'/logs/log_1c.log');    
                
        if(!empty($bitrix_id)) {     
            
            logger('$bitrix_id:', $_SERVER["DOCUMENT_ROOT"].'/logs/log_1c.log');         
            logger($bitrix_id, $_SERVER["DOCUMENT_ROOT"].'/logs/log_1c.log');    
        
            //Запрос для получения остатков у элементов, которые привязаны к тому же товару в каталоге
            $arSelect = Array("CATALOG_QUANTITY");
            $arFilter = Array("IBLOCK_ID"=>IBLOCK_1C_EXCHANGE, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_ID_BITRIKS_VALUE" => $bitrix_id);   
            $cat = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
            while($arCatalog = $cat->Fetch()) {                          
                $total_quantity = $total_quantity + $arCatalog['CATALOG_QUANTITY'];
            }      
            
            logger('$total_quantity:', $_SERVER["DOCUMENT_ROOT"].'/logs/log_1c.log');         
            logger($total_quantity, $_SERVER["DOCUMENT_ROOT"].'/logs/log_1c.log');    
            
            //Запросе на обновление остатков у товара        
            $arFields = array('QUANTITY' => $total_quantity);// зарезервированное количество
            $bitrix_id_elem_info = CIBlockElement::GetList (array(), array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "ID" => $bitrix_id), false, false, array("IBLOCK_ID", "ID", "PROPERTY_STATE"));
            while ($bitrix_id_elem = $bitrix_id_elem_info -> Fetch()) {
                $state_prop_enum_id = $bitrix_id_elem["PROPERTY_STATE_ENUM_ID"];
            }
            if ($state_prop_enum_id != getXMLIDByCode (CATALOG_IBLOCK_ID, "STATE", "soon")) {
                CCatalogProduct::Update($bitrix_id, $arFields);    
            }      
        }                  
    }   
    
    function SyncProductQuantityIblock($arFields) {   
                      
        logger('Iblock:', $_SERVER["DOCUMENT_ROOT"].'/logs/log_1c.log');
        logger($arFields, $_SERVER["DOCUMENT_ROOT"].'/logs/log_1c.log');
                
    }
}
        