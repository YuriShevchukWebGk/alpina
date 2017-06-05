<?                                                                                                    
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Config\Option;
use Bitrix\Sale\Internals\StatusTable;
use Bitrix\Sale;

require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin_before.php');       
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/sale/prolog.php");                          
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/sale/general/admin_tool.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/local/admin/accordpost_function.php");

$arCountry = get_country_list();

echo '<table style="border-collapse: collapse;">';  
echo '<tr>'; 
    echo '<th style="padding:5px; border: 1px solid black;">ID</th>'; 
    echo '<th style="padding:5px; border: 1px solid black;">RUS</th>'; 
    echo '<th style="padding:5px; border: 1px solid black;">EN</th>';
    echo '<th style="padding:5px; border: 1px solid black;">FR</th>';
echo '</tr>';     
foreach($arCountry as $countryID => $arCountryItem) { 
    echo '<tr>'; 
        echo '<td style="padding:5px; border: 1px solid black;">'.$countryID.'</td>'; 
        echo '<td style="padding:5px; border: 1px solid black;">'.$arCountryItem['country_id_name'].'</td>'; 
        echo '<td style="padding:5px; border: 1px solid black;">'.$arCountryItem['country_id_name_en'].'</td>';
        echo '<td style="padding:5px; border: 1px solid black;">'.$arCountryItem['country_id_name_fr'].'</td>';
    echo '</tr>'; 
} 
echo '</table>'; 
?>               