<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?global $USER;?>
<?if(CModule::IncludeModule("iblock"))
    {
        $arFilter = Array("IBLOCK_ID"=>48, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_RUBRIC" => $arSection["ID"]);
        $res = CIBlockElement::GetList(Array(), $arFilter, Array());  

        $num = 'GR_' . (intval($res) + 500);
        $name_zak = 'Заказ #'. $num;

        $el = new CIBlockElement;
        $PROP = array();
        $PROP["phone"] = $_POST["telephone"];        // свойству с кодом 3 присваиваем значение 38
        $PROP["email"] = $_POST["email"];
        $PROP["tren"] = 'СУПЕР ШКОЛА';
        $arLoadProductArray = Array(
            'MODIFIED_BY' => $USER->GetID(), // элемент изменен текущим пользователем  
            'IBLOCK_SECTION_ID' => false, // элемент лежит в корне раздела  
            'IBLOCK_ID' => 48,
            'PROPERTY_VALUES' => $PROP,  
            'NAME' => $name_zak,  
            'ACTIVE' => 'Y');
        if($PRODUCT_ID = $el->Add($arLoadProductArray)) { 
            echo $num;                                             
        } else {   
            echo 'Error';                                                                               
        }
}?>