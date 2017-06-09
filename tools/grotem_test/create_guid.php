<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?require($_SERVER["DOCUMENT_ROOT"]."/tools/grotem_test/function.php");?>  
<?  
//Генерация Timestamp (тики из си), необходим для дальнейшей работы
$ticks = tick_time();                            
                                              
//Начало генерации тела запроса
$arSelect = Array("ID", "NAME", "PROPERTY_GUID");
$arFilter = Array("IBLOCK_ID"=> CATALOG_IBLOCK_ID, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while($arFields = $res->fetch()) {
        //Уникальный идентификатор товара, описано выше
        $GUID = generateGUID();    
        
        //Обновим GUID у всех элементов GUID - уникальный идентификатор в системе Гротем   
        $PROPERTY_CODE = "GUID";  // код свойства
        $PROPERTY_VALUE = $GUID;  // значение свойства

        // Установим новое значение для данного свойства данного элемента
        //CIBlockElement::SetPropertyValuesEx($arFields['ID'], false, array($PROPERTY_CODE => $PROPERTY_VALUE));    
}                                     
?>
<?echo 'end';?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>