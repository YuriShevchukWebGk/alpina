<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");

   $arFilter = Array("DELIVERY_ID" => array(DELIVERY_COURIER_1, DELIVERY_COURIER_2, DELIVERY_COURIER_MKAD), "PAY_SYSTEM_ID" => CASH_PAY_SISTEM_ID, "STATUS_ID" => array("N", "D"), "PAYED" => 'Y');
            $rsOrder = CSaleOrder::GetList(Array(), $arFilter, Array("ID", "DATE_INSERT"), false); // Array("PROPERTY_CONSIGNEE")
            while($arOrder = $rsOrder->Fetch()) {
                arshow($arOrder);
                $time = strtotime('-10 minutes');
                $date_today = strtotime(date('d.m.Y H:i:s', $time));
                $date_oldday = strtotime($arOrder["DATE_INSERT"]);  
                if($date_today > $date_oldday){
                    
                    //  CSaleOrder::StatusOrder($arOrder["ID"], "AC");
                }
            }
            ?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>