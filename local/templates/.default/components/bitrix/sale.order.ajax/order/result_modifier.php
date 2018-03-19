<?
/*
//Отсеем подарки из корзины, нужно для проверки ниже
$basket_without_present = array();
$basket_without_present_ids = array();

foreach($arResult["BASKET_ITEMS"] as $basket_item) {
    if ($basket_item['PRICE'] != 0) {
        $basket_without_present[] = $basket_item;
        $basket_without_present_ids[] = $basket_item["PRODUCT_ID"];
    }
}


//Проверим является ли корзина предзаказом
if(count($basket_without_present) == 1) {
    $basketItem = array_pop($basket_without_present);
    $itemID = $basketItem["PRODUCT_ID"];



    $preOrder = '';
    $res = CIBlockElement::GetList(Array(), Array("ID" => IntVal($itemID)), false, Array(), Array("ID", "PROPERTY_SOON_DATE_TIME", "PROPERTY_STATE"));
    if($arFields = $res->Fetch()) {
        if(intval($arFields["PROPERTY_STATE_ENUM_ID"]) == getXMLIDByCode(CATALOG_IBLOCK_ID, "STATE", "soon")){
            $arResult['PREORDER'] = 'Y';
        }
    }
};*/

//Отсеем подарки из корзины, нужно для проверки ниже
$basket_without_present_ids = array();

foreach($arResult["BASKET_ITEMS"] as $basket_item) {
    if ($basket_item['PRICE'] != 0) {
        $basket_without_present_ids[] = $basket_item["PRODUCT_ID"];
    }
}

$res = CIBlockElement::GetList(Array(), Array("PROPERTY_STATE" => STATE_SOON, "ID" => $basket_without_present_ids), false, Array(), Array("ID"));
if($arFields = $res->Fetch()) {
    $arResult['PREORDER'] = 'Y';
}

foreach($arResult["DELIVERY"] as $DeliveryID => $DeliveryResult) {
    $arDeliv = CSaleDelivery::GetByID($DeliveryResult['ID']);
    if(empty($arResult["DELIVERY"][$DeliveryID]['PRICE'])){
        $arResult["DELIVERY"][$DeliveryID]['PRICE'] = $arDeliv['PRICE'];
        $arResult["DELIVERY"][$DeliveryID]['PRICE_FORMATED'] = $arDeliv['PRICE'].' руб.';
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