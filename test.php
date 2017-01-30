<?
    use Bitrix\Main\Loader;
    use Bitrix\Main\Localization\Loc;
    use Bitrix\Main\Config\Option;
    use Bitrix\Sale\Internals\StatusTable;
    use Bitrix\Sale;



    require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
    Loader::includeModule('sale');
    require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/sale/prolog.php");  
    require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/sale/general/admin_tool.php");
?>
<?

    /*
    $orders = \Bitrix\Sale\Internals\OrderTable::getList(array(
        'order' => array("ID" => "DESC"),
        'filter' => array(
            "LOGIC" => "OR", 
            array("GURU.ORDER_PROPS_ID" => GURU_F_PERSON_ID, "GURU.VALUE" => "Y"), 
            array("GURU.ORDER_PROPS_ID" => GURU_L_PERSON_ID, "GURU.VALUE" => "Y")
        ),
        'select' => array("ID", "GURU"),
        'limit' => 100,
        'runtime' => array(
            new \Bitrix\Main\Entity\ReferenceField(
                'GURU',
                '\Bitrix\Sale\Internals\OrderPropsValueTable',
                array('ref.ORDER_ID' => 'this.ID')
            )
        )
    ));   

    while ( $arOrder = $orders->NavNext()) {
        arshow($arOrder);         
    } 
    */

    $orders = \Bitrix\Sale\Internals\OrderTable::getList(array(
        'order' => array("ID" => "DESC"),
        'filter' => array(
            "LOGIC" => "OR",
            array("GURU.ORDER_PROPS_ID" => 90, "GURU.VALUE" => "Y"),
            array("GURU.ORDER_PROPS_ID" => 91, "GURU.VALUE" => "Y")
        ),
        'select' => array("ID", "GURU"),
        'limit' => 20,
        'runtime' => array(
            new \Bitrix\Main\Entity\ReferenceField(
                'GURU',
                '\Bitrix\Sale\Internals\OrderPropsValueTable',
                array('ref.ORDER_ID' => 'this.ID')
            )
        )
    ));

    while ( $arOrder = $orders->NavNext()) {
        arshow($arOrder);         
    } 

