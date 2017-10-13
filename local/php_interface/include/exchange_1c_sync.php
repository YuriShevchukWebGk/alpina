<?
AddEventHandler("catalog", "OnProductUpdate", Array("Exchange1C", "SyncProductQuantity"));
AddEventHandler("catalog", "OnProductAdd", Array("Exchange1C", "SyncProductQuantity"));   
AddEventHandler("iblock", "OnAfterIBlockElementAdd", Array("Exchange1C", "SyncProductQuantityIblock"));
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", Array("Exchange1C", "SyncProductQuantityIblock"));   

class Exchange1C {
    // создаем обработчик события "OnBeforeIBlockElementUpdate"
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
            CCatalogProduct::Update($bitrix_id, $arFields);      
        }                    
    }
    
    function SyncProductQuantityIblock($arFields) {   
        
        logger('Iblock:', $_SERVER["DOCUMENT_ROOT"].'/logs/log_1c.log');
        logger($arFields, $_SERVER["DOCUMENT_ROOT"].'/logs/log_1c.log');
                
    }
}