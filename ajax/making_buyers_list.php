<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    CModule::IncludeModule("sale"); CModule::IncludeModule("catalog"); CModule::IncludeModule("iblock");
?>
<?  
    $buyers_list = "";

    if(intval($_REQUEST["item_id"]) > 0){

        $buyers_list .= " <table>
            <tr>
                <td>Инициалы</td>
                <td>Кол-во, шт.</td>
            </tr>";
        $gift_book_buyers = CIBlockElement::GetList (
            array(), 
            array(
                "IBLOCK_ID" => SUSPENDED_BOOKS_BUYERS_IBLOCK, "PROPERTY_GIFT_BOOK" => $_REQUEST["item_id"]
            ), 
            false, 
            false, 
            array("NAME", "ID", "PROPERTY_GIFT_BOOK", "PROPERTY_GIFT_QUANTITY")
        );
        while ($buyers = $gift_book_buyers -> Fetch()) {
            $buyers_list .=  "<tr><td>" . $buyers["NAME"] . "</td><td><div class='rounded_number'>" . intval($buyers["PROPERTY_GIFT_QUANTITY_VALUE"]) . "</div></td></tr>";  
        }
        $buyers_list .= "</table>";

    };
    
    echo $buyers_list;
            

    
   
?>