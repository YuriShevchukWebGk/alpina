<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?require($_SERVER["DOCUMENT_ROOT"]."/tools/grotem_test/function.php");?>  
<?                   

//Генерация Timestamp (тики из си), необходим для дальнейшей работы
$ticks = tick_time();                            
                       
//Начало генерации тела запроса
$arSelect = Array("ID", "NAME", "PROPERTY_GUID");

$old_i = 5479;
$requestCount = 0;
for ($i = 5479; $i <= 5485; $i = $i + 1) {      
    $requestCount++;   
    $arFilter = Array("<ID" => $i, ">=ID" => $old_i, "IBLOCK_ID"=> CATALOG_IBLOCK_ID, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");                          
    $old_i = $i; 
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
    $ChangedEntities = array();
    while($arFields = $res->fetch()) {   
        $db_res = CPrice::GetList(array(), array("PRODUCT_ID" => $arFields['ID'], "CATALOG_GROUP_ID" => PRICE_TYPE_ID));
        if ($ar_res = $db_res->Fetch()) {
            //Уникальный идентификатор товара, описано выше
            $GUID = $arFields['PROPERTY_GUID_VALUE'];        
              
            //Цена
            $price = $ar_res['PRICE']; 
             
            //Убираем кавычки от греха подальше, так как эти поля потом пойдут в запрос
            $arFields['NAME'] = str_replace("’",' ', $arFields['NAME']); 
            $arFields['NAME'] = str_replace('"','', $arFields['NAME']); 
            $arFields['NAME'] = str_replace("'",'', $arFields['NAME']);
            $name = $arFields['NAME']; 
            
            //Валюта почему то в гротем называется еденица измерения
            $unit = 'руб.';      
            
            //Код будет выглядеть как 000012345, идентификатор в системе Альпины и нули, всего 9 символов 
            $code = str_pad($arFields['ID'], 9, "0", STR_PAD_LEFT);     
            
            //Собираем массив с изменениями, потом пойдут в тело запроса
            $ChangedEntities[] = array(
                "Id"         => $GUID,
                "IsDeleted"  => false,    
                "Tablename"  => "Catalog.RIM", //Название таблицы с товаром или услугой
                "SyncFilter" => null,
                "Fields"     => array(
                    "Id"           => $GUID,    //Уникальный идентификатор в системе Гротем
                    "Predefined"   => false,    //Признак предопределенного элемента, хз че это
                    "DeletionMark" => false,    //Признак пометки на удаление, вроде пометку ставит в бд, но не удаляет, может просто не сразу, хз
                    "Description"  => $name,    //Наименование                       
                    "Price"        => $price,    //Цена
                    "Service"      => false,    //Услуга или товар, если false то товар         
                    "IsFolder"     => false,   
                    "Code"         => $code, //Код товара в Гротеме         
                    "Unit"         => $unit, //Размерность                                           
                    "VAT"          => ALPINA_VAT10_GUID   //Идентификатор перечисления “Ставки НДС” (Enum.VATS)
                )
            );                            
        }             
    }         
            
    //Тело запроса
    $requestID = generateGUID();  
    $arBody = array (
        "Id" => $requestID, //Идентификатор запроса 
        "TimestampFrom" => 0, //Последнее успешное выполнение запроса                                         
        "TimestampTo" => $ticks, //Время выполнения запроса                         
        "DeletedEntities" => array(), //Поля на удаление, у меня не получилось через него ничего удалить                                    
        "ChangedEntities" => $ChangedEntities //Поля на изменения
    );                        
    //arshow($arBody['ChangedEntities']);                  
    //Выгрузка     
    $http_header = array(             
        'POST /bitmobile3/alpina/admin/SyncSolutionDatabase HTTP/1.1', 
        'Host: express.grotem.com', 
        'content-type: application/json',       
        'configname: GrotemExpress',           
        'configversion: 1.1.0.0',                      
        'deviceId: '.GROTEM_DEVICE_ID_GUID.'',  
        'Authorization: '.GROTEM_AUTHORIZATION_NEW.'',
        'Cache-Control: no-cache'
    );         
    $curlBody = json_encode($arBody);   
                         
    $curl = curl_init(); 
    curl_setopt($curl, CURLOPT_URL, GROTEM_REQUEST_FULLURL);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $http_header);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                                    
    curl_setopt($curl, CURLOPT_POST, true);      
    curl_setopt($curl, CURLOPT_POSTFIELDS, $curlBody);                          
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);  
                                 
    echo "Итерация:".$i."<br>";                             
    $iteracia = json_decode(gzdecode($out));                                   
    //Запрос и обработка ответа
    if($out = curl_exec($curl)){          
        echo 'ВСЕ ХОРОШО'."<br>";                    
        //arshow($iteracia[0]);               
    } else {
        echo 'Ошибка подключения';            
    }                    
    curl_close($curl); 
    sleep(1); 
} 

//Сохраним данные о выгрузке в ИБ
$el = new CIBlockElement;

$PROP = array();
$PROP[REQUEST_GUID_PROPERTY_ID] = $requestID;  // Идентификатор выгрузки
$PROP[TICKS_PROPERTY_ID] = $ticks;        // Дата выгрузки в тиках

$arLoadProductArray = Array(                                                      
  "IBLOCK_ID"        => REQUEST_IBLOCK_ID,                                                   
  "DATE_ACTIVE_FROM" => new \Bitrix\Main\Type\DateTime(),
  "PROPERTY_VALUES"  => $PROP,
  "NAME"             => "Выгрузка ".date('Y-m-d H:i:s'),                            
);          

if($PRODUCT_ID = $el->Add($arLoadProductArray))
  echo "New ID: ".$PRODUCT_ID;
else
  echo "Error: ".$el->LAST_ERROR;
?>                               
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>