<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale"); CModule::IncludeModule("catalog"); CModule::IncludeModule("iblock");
?>
<?
if ($_REQUEST["id"])
{
    $curr_user = CUser::GetByID($USER -> GetID()) -> Fetch();
    $user = $curr_user["NAME"]." ".$curr_user["LAST_NAME"];
    $wish_item_list = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 17, "NAME" => $user), false, false, array("NAME", "ID", "PROPERTY_PRODUCTS"));
    while ($wish_item_fetch = $wish_item_list -> Fetch())
    {
        $prod_values[] = $wish_item_fetch["PROPERTY_PRODUCTS_VALUE"];
    }
        if (in_array($_REQUEST["id"], $prod_values))
        {
            echo "Данный товар уже находится в вашем списке желаний.";    
        }
        else
        {
        $el = new CIBlockElement;
        $PROP = array(
            "PRODUCTS" => $_REQUEST["id"]
        );
            $ElemFields = array(
                "IBLOCK_ID" => 17,
                "NAME" => $user,
                "ACTIVE" => "Y",
                "PROPERTY_VALUES" => $PROP
            );
            $el->Add($ElemFields);
            $new_wish_item = CIBlockElement::GetList (array(), array("IBLOCK_ID" => 4, "ID" => $_REQUEST["id"]), false, false, array("ID", "NAME")) -> Fetch();
            echo "Товар '".$new_wish_item["NAME"]."' успешно добавлен в список желаний.";
        }
    
}
?>