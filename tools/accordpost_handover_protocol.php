<?                                                                                                    
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Config\Option;
use Bitrix\Sale\Internals\StatusTable;
use Bitrix\Sale;

require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin_before.php');       
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/sale/prolog.php");                          
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/sale/general/admin_tool.php");      
                                                               
if($_REQUEST['ZDOC_ID']) {
    $zdoc_id = $_REQUEST['ZDOC_ID'];
        
    $arSelect = Array("PROPERTY_SHIPMENT_ORDER_ROW", "DATE_CREATE");
    $arFilter = Array("IBLOCK_ID" => IntVal(69), "ID" => IntVal($zdoc_id));
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
    while($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $newDate = date("d.m.Y", strtotime($arFields['DATE_CREATE']));       
        $arOrders[$arFields["PROPERTY_SHIPMENT_ORDER_ROW_VALUE"]]['ORDER_ID'] = $arFields["PROPERTY_SHIPMENT_ORDER_ROW_VALUE"];                        
    }
      
    foreach($arOrders as $order) {                                   

        $arOrder = CSaleOrder::GetByID($order['ORDER_ID']);    
        $ar_basket_products[$order['ORDER_ID']]['PRICE'] = $arOrder['PRICE'];
        
        $db_basket = CSaleBasket::GetList(array(), array("ORDER_ID" => $order['ORDER_ID']), false, false, array("ID", "PRODUCT_ID", "QUANTITY", "DELAY", "CAN_BUY", "PRICE", "WEIGHT", "ORDER_ID"));
        while ($ar_basket_item = $db_basket->Fetch()) {                                                                            
            $ar_basket_products[$ar_basket_item['ORDER_ID']]['WEIGHT'] += $ar_basket_item["WEIGHT"] * $ar_basket_item["QUANTITY"];   
        }                                                                 
    };                           

    echo '<div style="width: 21cm; height: 29.7cm; margin: 30px 45px 30px 45px;">';  
        echo '<h1 style="font-size: 18px; font-family: calibri; text-align: center;">АКТ ПРИЕМА-ПЕРЕДАЧИ ОТПРАВЛЕНИЙ</h1>';     
        echo '<p style="margin-bottom: 5px;">№'.$zdoc_id.' ООО "Альпина Паблишер" от '.$newDate.'</p>';                                                                                                                     
        echo '<table style="border-collapse: collapse; width: 100%;">';  
        echo '<tr>'; 
            echo '<th style="padding:5px; border: 1px solid black;">№</th>'; 
            echo '<th style="padding:5px; border: 1px solid black;">Шифр</th>'; 
            echo '<th style="padding:5px; border: 1px solid black;">Дата формирования</th>';
            echo '<th style="padding:5px; border: 1px solid black;">Вес</th>';
            echo '<th style="padding:5px; border: 1px solid black;">Стоимость отправления</th>';
        echo '</tr>'; 
        echo '<tr>'; 
            echo '<td style="padding:5px; border: 1px solid black; text-align: center;">1</td>'; 
            echo '<td style="padding:5px; border: 1px solid black; text-align: center;">2</td>'; 
            echo '<td style="padding:5px; border: 1px solid black; text-align: center;">3</td>';
            echo '<td style="padding:5px; border: 1px solid black; text-align: center;">4</td>';
            echo '<td style="padding:5px; border: 1px solid black; text-align: center;">5</td>';
        echo '</tr>';  
        $i = 0;
        foreach($ar_basket_products as $countryID => $arCountryItem) {    
            $i++;
            echo '<tr>'; 
                echo '<td style="padding:5px; border: 1px solid black; text-align: center;">'.$i.'</td>'; 
                echo '<td style="padding:5px; border: 1px solid black; text-align: right;">'.$countryID.'</td>'; 
                echo '<td style="padding:5px; border: 1px solid black; text-align: left;">'.$newDate.'</td>';    
                echo '<td style="padding:5px; border: 1px solid black; text-align: right;">'.number_format($arCountryItem['WEIGHT']/1000, 2).' кг.</td>';
                echo '<td style="padding:5px; border: 1px solid black; text-align: center;">'.number_format($arCountryItem['PRICE'], 2).' руб.</td>';
            echo '</tr>'; 
        } 
        echo '</table>'; 
        echo '<p style="margin-top: 5px; text-align: center;">Общее кол-во отправлений: '.$i.'</p>'; 
        echo '<div style="float:left; width: 300px">';  
        echo '<div>Сдал:</div>';                
        echo '<div style="width:100%; border-bottom: 1px solid black; margin-top: 30px;"></div>';   
        echo '<div style="width:100%; border-bottom: 1px solid black; margin-top: 35px;"></div>';              
        echo '<div style="margin-top: 20px;">МП</div>';
        echo '</div>';  
        echo '<div style="float:right; width: 300px">'; 
        echo '<div>Принял:</div>';
        echo '<div style="width:100%; border-bottom: 1px solid black; margin-top: 30px;"></div>';   
        echo '<div style="width:100%; border-bottom: 1px solid black; margin-top: 35px;"></div>';              
        echo '<div style="margin-top: 20px;">МП</div>';
        echo '</div>';                                     
    echo '</div>';   
} else {
    echo 'Доступно только по ссылке';
}          
?>               