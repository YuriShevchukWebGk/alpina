<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");

    if (CModule::IncludeModule("sale")){
       global $USER;
       
       $date_day = date('d.m.Y H:i:s',strtotime("now -30 day")); // дата начала поиска
       $arFilter = Array(
          ">=DATE_INSERT" => $date_day,
          "STATUS_ID" => array("N", "D", "AC"),
          "DELIVERY_ID" => array(9, 15),
       );
       $rsSales = CSaleOrder::GetList(array(), $arFilter, false, false, array("ID", "IBLOCK_ID", "*"));
       $db_props = array();
        $filter = Array (
            "!UF_STATION_METRO" => false,
            "GROUPS_ID" => Array(9),
        );
        $params = array(
            "SELECT" => array("UF_STATION_METRO"),
            "FIELDS" => array("ID", "NAME"),
        );
        $rsUsers = CUser::GetList(($by="NAME"), ($order="desc"), $filter, $params); // выбираем пользователей
        while($user = $rsUsers->Fetch()) {
            $ar_user[] = $user;
        };
       while ($arSales = $rsSales->Fetch()) {
            $dbOrderProps = CSaleOrderPropsValue::GetList(
                array("SORT" => "ASC"),
                array("ORDER_ID" => $arSales["ID"], "CODE"=>array("METRO_2"))
            )->Fetch();
            $db_props = CSaleOrderPropsVariant::GetByValue($dbOrderProps["ORDER_PROPS_ID"],$dbOrderProps["VALUE"]);
            foreach($ar_user as $user_group){      
               if($user_group["UF_STATION_METRO"] == $db_props["NAME"]){

                    $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM");
                    $arFilter = Array("IBLOCK_ID"=>IntVal($yvalue), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
                    $ob_courier = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 52, "NAME" => $arSales["ID"]), false, false, $arSelect);
                    if($courier = $ob_courier->Fetch()) {

                    } else {
                        $el = new CIBlockElement;

                        $PROP = array();
                        $PROP["ORDER"] = $arSales["ID"];  // свойству с кодом 12 присваиваем значение "Белый"
                        $PROP["COURIRER"] = $user_group["ID"];        // свойству с кодом 3 присваиваем значение 38

                        $arLoadProductArray = Array(
                          "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
                          "IBLOCK_ID"      => 52,
                          "PROPERTY_VALUES"=> $PROP,
                          "NAME"           => $arSales["ID"],
                          "ACTIVE"         => "Y",            // активен
                          );

                        $PRODUCT_ID = $el->Add($arLoadProductArray);
                    }
               } 
            }
           
       } 
    } 
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>