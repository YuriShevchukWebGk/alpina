<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
global $APPLICATION;
// парсим данные формы
parse_str($_POST['data'], $certificate_data);


if ($certificate_data['certificate_quantity'] > 0) {
	$element_object = new CIBlockElement();
	
	$properties = array(
		"BUYER_TYPE"    => $_POST['person_type'] == "natural_person" ? CERTIFICATE_NATURAL_PERSON_PROPERTY_ID : CERTIFICATE_LEGAL_PERSON_PROPERTY_ID,
		"CERT_QUANTITY" => $certificate_data['certificate_quantity']
	);

	switch ($_POST['person_type']) {
		case "natural_person":
			$properties["NATURAL_NAME"] = $certificate_data['natural_name'];
			$properties["NATURAL_EMAIL"] = $certificate_data['natural_email'];
			break;
			
		case "legal_person":
			$properties["LEGAL_NAME"] = $certificate_data['legal_name'];
			$properties["LEGAL_EMAIL"] = $certificate_data['legal_email'];
			$properties["BIK"] = $certificate_data['bik'];
			$properties["INN"] = $certificate_data['inn'];
			$properties["CORRESPONDED_ACCOUNT"] = $certificate_data['corresponded_account'];
			$properties["KPP"] = $certificate_data['kpp'];
			$properties["BANK_TITLE"] = $certificate_data['bank_title'];
			$properties["SETTLEMENT_ACCOUNT"] = $certificate_data['settlement_account'];
			$properties["LEGAL_ADDRESS"] = $certificate_data['legal_address'];
			break;
	}
	
	// общие поля
	$fields = array(
        "ACTIVE"          => "N",
        "NAME"            => $certificate_data['certificate_name'],
        "IBLOCK_ID"       => CERTIFICATE_IBLOCK_ID,
        "XML_ID"          => $certificate_data['basket_rule'],
		"PROPERTY_VALUES" => $properties
    );
	
	if ($product_id = $element_object->Add($fields)) {
	  echo $product_id;
	} else {
	  echo $element_object->LAST_ERROR;
	}
	
	if ($product_id && $_POST['person_type'] == "legal_person") {
		CertificateMail::newLegalPersonOrder($product_id);
	}
}

///////////////////////// ******************************** /////////////////////////////////////////
//Генерируем купоны и пишем информацию в инфоблок с заказами сертификатов, по номеру правила корзины и количеству из реквеста
/*if ($_REQUEST['quantity'] > 0) {
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
}*/
                            
?>                     