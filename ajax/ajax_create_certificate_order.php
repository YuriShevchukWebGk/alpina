<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");           
CModule::IncludeModule("iblock"); 
CModule::IncludeModule("sale");      
CModule::IncludeModule("catalog"); 
?><?
global $APPLICATION;
// парсим данные формы
parse_str($_POST['data'], $certificate_data);
//Генерируем купоны и пишем информацию в инфоблок с заказами сертификатов, по номеру правила корзины и количеству из реквеста
if (($_REQUEST['quantity'] > 0) && ($_REQUEST['quantity'] < MAX_CERTIFICATE_QUANTINTY)) {
    for ($i = 1; $i <= $_REQUEST['quantity'] ; $i++) {      
             
        //Битриксовая недокументированная функция, генерирует просто ключ в виде строки
        $arFields['COUPON'] = CatalogGenerateCoupon();        
        $arFields['DISCOUNT_ID'] = $_REQUEST['basket_rule_id'];     
        $arFields['ACTIVE'] = "N";        
        $arFields['TYPE'] = 2;
        $arFields['MAX_USE'] = 1;        
        
        //Фукнкция из ядра, создаем новый купон в правилах корзины        
        $obCoupon = \Bitrix\Sale\Internals\DiscountCouponTable::add($arFields);
        
        //Получаем ID сгенерированного купона                                                   
        $discountIterator = \Bitrix\Sale\Internals\DiscountCouponTable::getList(array(
            'select' => array('ID'),
            'filter' => array('COUPON' => $arFields['COUPON'])
        ));    
        
        //Собираем массив с ID купонов         
        if($arDiscountIterator = $discountIterator -> fetch()) {
            $arCertificateID[] = $arDiscountIterator['ID'];
        } 
        //Собираем массив с кодами купонов 
        $arCouponCode[] = $arFields['COUPON'];                                                  
    }  
                                                                
    //Создаем новый элемент в инфоблоке
    $arFields = array(
        "ACTIVE" => "N",
        "NAME" => $_REQUEST['item_name'],
        "IBLOCK_ID" => 67,
        "NATURAL_NAME" => $_REQUEST['name'],
        "NATURAL_EMAIL" => $_REQUEST['email']
    );
    $obElement = new CIBlockElement();
    $idElement = $obElement -> Add($arFields);      
    $arFilter = array(
        'COUPON_ID'   => $arCertificateID,
        'COUPON_CODE' => $arCouponCode,
    );       
    // Установим новое значение для данного свойства данного элемента
    CIBlockElement::SetPropertyValuesEx($idElement, false, $arFilter);   
}
                            
?>                     