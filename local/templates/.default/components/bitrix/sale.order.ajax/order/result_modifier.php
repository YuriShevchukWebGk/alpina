<?    
//Проверим является ли корзина предзаказом    
if(count($arResult["BASKET_ITEMS"]) == 1) {     
    $basketItem = $arResult["BASKET_ITEMS"];   
    $basketItem = array_pop($basketItem);    
    $itemID = $basketItem["PRODUCT_ID"];                 
    
    $preOrder = '';
    $res = CIBlockElement::GetList(Array(), Array("ID" => IntVal($itemID)), false, Array(), Array("ID", "PROPERTY_SOON_DATE_TIME", "PROPERTY_STATE"));
    if($arFields = $res->Fetch()) { 
        if(intval($arFields["PROPERTY_STATE_ENUM_ID"]) == getXMLIDByCode(CATALOG_IBLOCK_ID, "STATE", "soon")){ 
            $arResult['PREORDER'] = 'Y';        
        }  
    }                                                                                                                      
};                                                                                       
/*global $USER;
if ($USER->GetID() && $USER->IsAuthorized()) {
	$users = CUser::GetList(
		($by=""),
		($order=""),
		Array(
			"ID" => $USER->GetID()
		),
		Array(
			"SELECT" => Array("UF_RECURRENT_ID", "UF_RECURRENT_CARD_ID")
		)
	); 
	if ($user = $users->NavNext(true, "f_")) {
		$arResult["UF_RECURRENT_ID"] = $user["UF_RECURRENT_ID"];
		$arResult["UF_RECURRENT_CARD_ID"] = $user["UF_RECURRENT_CARD_ID"];
	}
}*/
?>