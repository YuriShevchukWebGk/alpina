<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale"); 
CModule::IncludeModule("catalog"); 
CModule::IncludeModule("iblock");
CModule::IncludeModule('highloadblock');

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

$hl_block = HL\HighloadBlockTable::getById(PREORDER_BASKET_HL_ID)->fetch();
$entity = HL\HighloadBlockTable::compileEntity($hl_block);
$entity_data_class = $entity->getDataClass();     

$preorderID = $_REQUEST['preorderID'];  
$arBasketItems = array();

$dbBasketItems = CSaleBasket::GetList( array("NAME" => "ASC", "ID" => "ASC"), array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL"), false, false, array("ID", "QUANTITY", "DELAY"));
while ($arItems = $dbBasketItems->Fetch()) { 
    $arBasketItems[] = array("UF_BASKET_ID" => $arItems['ID'], "UF_DELAY_BEFORE" => $arItems['DELAY'], "UF_ACTIVE" => "Y");
}
           
foreach ($arBasketItems as $data) {                   
    $result = $entity_data_class::add($data);
    $ID = $result->getId();
    if($result->isSuccess()){       
        echo 'В справочник добавлена запись '.$ID.'<br />';
    } else {
        echo 'Ошибка добавления записи';
    }    
    if($data['UF_BASKET_ID'] == $preorderID) {
        $arTestData = $data['UF_BASKET_ID'];                      
        $arFields = array(  
           "DELAY" => "N"
        ); 
    } else {      
        $arFields = array(  
           "DELAY" => "Y"
        ); 
    }    
    CSaleBasket::Update($data['UF_BASKET_ID'], $arFields);   
}                                                       
?>                                  