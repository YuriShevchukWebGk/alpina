<?
function BXIBlockAfterSave($arFields) {
   updatingQuantityforPreorderItems($arFields);
   $updated_item_info = CIBlockElement::GetList (array(), array("ID" => $arFields["ID"]), false, false, array("IBLOCK_ID", "ID", "PROPERTY_STATE"));
            while ($updated_item = $updated_item_info -> Fetch()) {
                if ($updated_item["IBLOCK_ID"] == 4 && $updated_item["PROPERTY_STATE_ENUM_ID"] == getXMLIDByCode (CATALOG_IBLOCK_ID, "STATE", "soon") && $arFields["QUANTITY"] != 0) {
                    $upd_product = new CCatalogProduct();
                    $prodFields = array("QUANTITY" => 99999);      
                    $upd_product -> Update($arFields["ID"], $prodFields);
                    $arFields["QUANTITY"] = 99999;
                }
            }
}
?>