<?      
    /** @global CMain $APPLICATION */
    /** @global CUser $USER */
    /** @global string $DBType */
    /** @global CDatabase $DB */
    use Bitrix\Main\Loader;
    use Bitrix\Main\Localization\Loc;
    use Bitrix\Main\Config\Option;
    use Bitrix\Sale\Internals\StatusTable;
    use Bitrix\Sale;
    
    require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_before.php');       
    require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/sale/prolog.php");                          
    require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/sale/general/admin_tool.php");
                                                                                                     
    Loader::includeModule('sale');

    IncludeModuleLangFile(__FILE__);          

    global $USER;
    global $APPLICATION;       

    if (!$USER->IsAdmin()) {
        $APPLICATION-> Form("");
    }
              
    IncludeModuleLangFile(__FILE__);
                                                                                            
    $APPLICATION->AddHeadScript("//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js");  
                                              
    //Константы для curl запроса 
    define('CFG_NL', "\n");
    define('CFG_REQUEST_POST', 1);               
    define('CFG_REQUEST_FULLURL', 'https://api.accordpost.ru/ff/v1/test.html');
    define('CFG_REQUEST_TIMEOUT', 1);
    define('CFG_CONTENT_TYPE', 'text/xml; charset=utf-8');
    
    //ajax-экспорт заказов. Запрос отправляется из скрипта, который описан ниже 
    if (!empty($_REQUEST["ID"]) && $_REQUEST["export_order"] == "yes") {                                  
        //убираем хедер, чтобы в ответе не было лишнего кода
        $APPLICATION->RestartBuffer();  
                                                     
        $arIDs = $_REQUEST["ID"];
         
        //Создадим новую запись в ИБ, для идентификации отгрузок       
        $el = new CIBlockElement;     
        $arProperty = array();         
        $arLoadProductArray = Array(
            "MODIFIED_BY"     => $USER->GetID(), // элемент изменен текущим пользователем          
            "IBLOCK_ID"       => ACCORDPOST_IBLOCK_ID,         
            "NAME"            => "Отгрузка ".date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()),
            "ACTIVE"          => "Y",            // активен     
        );
        
        
        if($shipment_id = $el -> Add($arLoadProductArray)) {
            $zdoc_id = 'ALPINABOOK'.$shipment_id;         
            
            $elUpdate = new CIBlockElement;
                                              
            //Обновим поле с zdoc_id        
            $arPropertyUpdate = array();
            $arPropertyUpdate['SHIPMENT_ZDOC_ID'] = $zdoc_id;
            $arPropertyUpdate['SHIPMENT_ORDER_ROW'] = $arIDs;
            
            $arLoadProductArrayUpdate = Array(                                                 
                "PROPERTY_VALUES"=> $arPropertyUpdate
            );
                                                                     
            $res = $elUpdate->Update($shipment_id, $arLoadProductArrayUpdate); 
        } else {
            //Остановить выполнение
        } 
            
        //Собираем информацию о заказах      
        $order_filter = array("ID" => $arIDs); 
        $rsSales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $order_filter);
        while ($arSales = $rsSales->Fetch()) {                       
            $order_props[$arSales['ID']] = $arSales;  
        }         
                    
        //Соберем все товары в выбранных заказах
        $arFilter = array("ORDER_ID" => $arIDs);
        $arSelect = array("ID", "PRODUCT_ID", "QUANTITY", "ORDER_ID");  
        
        $dbBasketItems = CSaleBasket::GetList(array(), $arFilter, false, false, $arSelect);
        while ($arItems = $dbBasketItems->Fetch()) {                  
            $order_props[$arItems['ORDER_ID']]['PRODUCT_ROWS'][] = $arItems;
        }                                    
            
        //Собираем дополнительные данные о заказе
        $rs_order_props = CSaleOrderPropsValue::GetList(array(), array("ORDER_ID" => $arIDs), false, false, array());
        while($ar_order_prop = $rs_order_props->Fetch()) {      
            $order_props[$ar_order_prop['ORDER_ID']][$ar_order_prop['CODE']] = $ar_order_prop['VALUE'];  
        }                                                               
        
        //Собираем поля в зависимости от типа лица
        foreach($order_props as $order_id => $order_properties) { 
            if($order_properties['PERSON_TYPE_ID'] == LEGAL_ENTITY_PERSON_TYPE_ID) {
                //имя получателя    
                $cont_name = '';    
                $cont_name = (!empty($order_properties["F_CONTACT_PERSON"]) ? $order_properties["F_CONTACT_PERSON"] : $order_properties["F_NAME"]);
                $order_props[$order_id]['FINAL_NAME'] = preg_replace("/[^\w\s]+/u", "", $cont_name);
                //адрес
                $order_props[$order_id]['FINAL_ADRESS_FULL'] = (!empty($order_properties["ADDRESS_FULL"]) ? $order_properties["ADDRESS_FULL"] : $order_properties["F_ADDRESS_FULL"]); 
            } else {
                //имя получателя    
                $cont_name = '';            
                $cont_name = (!empty($order_properties["F_CONTACT_PERSON"]) ? $order_properties["F_CONTACT_PERSON"] : $order_properties["F_NAME"]);
                $order_props[$order_id]['FINAL_NAME'] = preg_replace("/[^\w\s]+/u", "", $cont_name);
                //адрес
                $order_props[$order_id]['FINAL_ADRESS_FULL'] = (!empty($order_properties["ADDRESS"]) ? $order_properties["ADDRESS"] : $order_properties["F_ADDRESS"]);
            }                              
        }      
        
        $partner_code = str_pad(ACCORDPOST_PARTNER_ID, 4, "0", STR_PAD_LEFT);   
        
        //выбираем нужные поля  
              
        /*
        $index = $order_props['INDEX']['VALUE'];
        */
                             
        //Тестовая генерация xml       
        $xmlBody = '';
        //Шапка с доступами и типом запроса
        $xmlBody .= '<request request_type="'.ACCORDPOST_SHIPPING_ORDER_REQUEST_ID.'" partner_id="300" password="300">';
        
            //Создаём документ номер 5, создадим новый элемент в иб и используем его id в качестве номера отгрузки                                  
            $xmlBody .= '<doc doc_type="'.ACCORDPOST_SHIPPING_ORDER_DOCUMENT_ID.'" zdoc_id="'.$zdoc_id.'">';
            
            //Создаём позиции с заказами
            foreach($order_props as $order_id => $order_properties) {
                if(!empty($order_id)){          
                    //Создаём документ номер 5, создадим новый элемент в иб и используем его id в качестве номера отгрузки  
                    $order_code = str_pad($order_id, 14, "0", STR_PAD_LEFT);   
                    $unic_code = $partner_code.$order_code;                                  
                    $xmlBody .= '<order order_id="'.$order_id.'" zbarcode="'.$unic_code.'" parcel_nalog="10.00" parcel_sumvl="10.00" delivery_type="'.ACCORDPOST_DELIVERY_TYPE.'" zip="'.$order_properties['INDEX'].'" clnt_name="'.$order_properties['FINAL_NAME'].'" post_addr="'.$order_properties['FINAL_ADRESS_FULL'].'"/>';                  
                }
            }      
                                                 
            //Закрываем документ
            $xmlBody .= '</doc>';
            
        //Закрываем реквест
        $xmlBody .= '</request>';
                  
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, CFG_REQUEST_FULLURL);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);      
        curl_setopt($curl, CURLOPT_POSTFIELDS, $xmlBody);                          
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        
        //Запрос и обработка ответа
        if($out = curl_exec($curl)){         
            $response = new SimpleXMLElement($out);   
            if($response['state'] == 0) {
                //Успешный результат 
                $export_date = date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time());      
                $update_result = false;          
                foreach($arIDs as $ID) { 
                    if($order_props[$ID]['PERSON_TYPE_ID'] == LEGAL_ENTITY_PERSON_TYPE_ID) {
                        $prop_data = array(
                           "ORDER_ID" => $ID,
                           "ORDER_PROPS_ID" => EXPORTED_TO_ACCORDPOST_PROPERTY_ID_NATURAL, 
                           "CODE" => "EXPORTED_TO_ACCORDPOST",   
                           "NAME" => GetMessage("ACCORDPOST_EXPORT_TITLE"),
                           "VALUE" => $export_date
                        );                              
                        $prop_data_zdoc = array(
                           "ORDER_ID" => $ID,
                           "ORDER_PROPS_ID" => ZDOC_ID_ACCORDPOST_PROPERTY_ID_NATURAL, 
                           "CODE" => "ZDOC_ID",                              
                           "VALUE" => $zdoc_id
                        );                                                   
                    } else { 
                        $prop_data = array(
                           "ORDER_ID" => $ID,
                           "ORDER_PROPS_ID" => EXPORTED_TO_ACCORDPOST_PROPERTY_ID_LEGAL, 
                           "CODE" => "EXPORTED_TO_ACCORDPOST",   
                           "NAME" => GetMessage("ACCORDPOST_EXPORT_TITLE"),
                           "VALUE" => $export_date
                        );                     
                        $prop_data_zdoc = array(
                           "ORDER_ID" => $ID,
                           "ORDER_PROPS_ID" => ZDOC_ID_ACCORDPOST_PROPERTY_ID_LEGAL, 
                           "CODE" => "ZDOC_ID",                              
                           "VALUE" => $zdoc_id
                        );               
                    }   
                    if(CSaleOrderPropsValue::Add($prop_data) && CSaleOrderPropsValue::Add($prop_data_zdoc)){
                        echo GetMessage("ACCORDPOST_EXPORT_SUCCES").$zdoc_id.'<br>';     
                    } else {
                        echo GetMessage("ACCORDPOST_EXPORT_BITRIX_FAIL");      
                    }
                }     
            } else {
                foreach($response->error as $error){  
                    echo $error['msg'].'<br>';       
                    CIBlockElement::Delete($shipment_id);   
                }                  
            }  
        } else {
            echo GetMessage("ACCORDPOST_EXPORT_CONNECTION_FAIL");
            CIBlockElement::Delete($shipment_id);    
        }
                  
        curl_close($curl);          
            
        die(); //прерываем дальнейшее выполнение страницы при аякс-запросе   
    }                                                                                                                                 
    
    $sTableID = "tbl_accordpost_export_orders"; // table ID         
    //Не работает соритровка             
    //$oSort = new CAdminSorting($sTableID, "ID", "DESC"); // sort object
    $lAdmin = new CAdminList($sTableID, $oSort); // list object    
    $lAdmin->bMultipart = true;


    // filter fields
    $FilterArr = Array(
        "find_id",        
        "find_user_id",
        "find_id_from",
        "find_id_to", 
        "find_date_from",
        "find_date_to",   
        "find_exported"     
    );
                    
    // init filter
    $lAdmin->InitFilter($FilterArr);    
                         
    $arFilter = Array(       
        "DELIVERY_ID" => array(DELIVERY_MAIL, DELIVERY_MAIL_2), 
        "PAYED" => "Y"                                                            
    );  

    if(!empty($find_id)){                                         
        $arFilter["ID"] = explode(",", $find_id);;  
    }                  
    if(!empty($find_id_from)){                                                                                                         
        $arFilter[">=ID"] = $find_id_from;  
    }
    if(!empty($find_id_to)) {                                                                                                         
        $arFilter["<=ID"] = $find_id_to;  
    }                
    if(!empty($find_user_id)) {                                                                                                         
        $arFilter["USER_ID"] = $find_user_id;  
    }                                         
    if(!empty($find_date_from)) {
        $arFilter[">=DATE_INSERT"] = new \Bitrix\Main\Type\DateTime($find_date_from); 
    }                                                                                 
    if(!empty($find_date_to)) {
        $arFilter["<=DATE_INSERT"] = new \Bitrix\Main\Type\DateTime($find_date_to);         
    }        
    
    //set sorting field and direction
    $by = "ID";
    $order = "DESC";

    if ($_REQUEST["by"]) {
        $by = $_REQUEST["by"];  
    }
    if ($_REQUEST["order"]) {
        $order = $_REQUEST["order"]; 
    }       
                                                   
    //собираем статусы заказа
    $status_list = array();
    $status = CSaleStatus::GetList(array(), array("LID" => "ru"), false, false, array());
    while ($ar_status = $status->Fetch()) {
        $status_list[$ar_status["ID"]] = $ar_status["NAME"];
    }
              
    //Собираем свойства заказов связанные с экспортом
    //Желательно учитывать постраничную навгицаию, а не собирать все
    $arFilter["SALE_INTERNALS_ORDER_ACCORDPOST_CODE"] = "EXPORTED_TO_ACCORDPOST";
                       
    $getListParams = array(
        'order' => array($by => $order),
        'filter' => $arFilter,
        'select' => array("*", 'ACCORDPOST'),       
        'runtime' => array(
            new \Bitrix\Main\Entity\ReferenceField(
                'ACCORDPOST',
                '\Bitrix\Sale\Internals\OrderPropsValueTable',
                array('ref.ORDER_ID' => 'this.ID')
            )
        )
    );    
    
    $rsDataProps = new CAdminResult(\Bitrix\Sale\Internals\OrderTable::getList($getListParams), $sTableID); 
    while($arDataProps = $rsDataProps->fetch()){   
        if(!empty($arDataProps['SALE_INTERNALS_ORDER_ACCORDPOST_VALUE'])){              
            $arExportedToAccordpost[$arDataProps['ID']] = $arDataProps['SALE_INTERNALS_ORDER_ACCORDPOST_VALUE']; 
        }                                                 
    }                                       
    
    if(!empty($find_exported)) {   
        if($find_exported == 'Y') {              
            $arFilter["!PROPERTY_VAL_BY_CODE_EXPORTED_TO_ACCORDPOST"] = false;  
        } elseif ($find_exported == 'N') {                          
            $arFilterExported = $arFilter;                            
            $arFilterExported["!PROPERTY_VAL_BY_CODE_EXPORTED_TO_ACCORDPOST"] = false;                       
            $cExportedOrder = CSaleOrder::GetList(array(), $arFilterExported, false, false, array('ID'));                                         
            while($arExportedOrder = $cExportedOrder->Fetch()) {          
                $arFilter['!ID'][] = $arExportedOrder['ID'];          
            };                                     
        }                                                    
    }   
    
    //Собираем список заказов                  
    $cData = new CSaleOrder;                      
    $rsData = $cData->GetList($order, $arFilter);
    $rsData = new CAdminResult($rsData, $sTableID);                                        
                    
    //set pagenavigation   
    $rsData->NavStart();

    $lAdmin->NavText($rsData->GetNavPrint());    


    $arHeaders = array(  
        array(  
            "id"       => "ID",
            "content"  => "ID",
            "sort"     => "ID",
            "default"  => true,
        ),               
        array(  
            "id"       => "STATUS",
            "content"  => GetMessage("ORDER_STATUS"),
            "sort"     => "STATUS",
            "default"  => true,
        ),      
        array(  
            "id"       => "DATE_INSERT",
            "content"  => GetMessage("ORDER_DATE_CREATE"),
            "sort"     => "DATE_INSERT",
            "default"  => true,
        ),             
        array(  
            "id"       => "USER_ID",
            "content"  => GetMessage("ORDER_USER"),
            "sort"     => "USER_ID",
            "default"  => true,
        ),                      
        array(  
            "id"       => "USER_EMAIL",
            "content"  => GetMessage("EMAIL"),
            "sort"     => "USER_EMAIL",
            "default"  => true,
        ),                  
        array(  
            "id"       => "PRICE",
            "content"  => GetMessage("ORDER_SUMM"),
            "sort"     => "PRICE",
            "default"  => true,
        ),         
        array(  
            "id"       => "EXPORTED_TO_ACCORDPOST",
            "content"  => GetMessage("EXPORTED_TO_ACCORDPOST"),
            "sort"     => "EXPORTED_TO_ACCORDPOST",
            "default"  => true,
        ),              
        array(  
            "id"       => "LABEL",
            "content"  => GetMessage("LABEL"),
            "sort"     => "LABEL",
            "default"  => true,
        ),                          
    );
                                       
    //init headers
    $lAdmin->AddHeaders($arHeaders);                 

    while($arRes = $rsData->NavNext(true, "f_")) {  
        //Проверяем, экспортирован ли элемент
        if(!empty($arExportedToAccordpost[$f_ID])){
            $exportedToAccordpost = $arExportedToAccordpost[$f_ID];  
            $label = '<a href="/local/admin/accordpost_print.php?ACCORD_POST_ID='.$f_ID.'&SHIPPING_DATE='.$exportedToAccordpost.'" target="_blank">[Этикетка]</a>';  
        } else {
            $exportedToAccordpost = 'X';    
            $label = '-';  
        }                 
        // add row to result           
        $row = & $lAdmin->AddRow($f_ID, $arRes);            
        $row->AddViewField("ID", '<a href="sale_order_view.php?ID='.$f_ID.'&lang='.LANG.'">'.$f_ID.'</a>');
        $row->AddViewField("DATE_INSERT", $f_DATE_INSERT->format("Y-m-d H:i:s"));
        $row->AddViewField("USER_ID", '<a href="user_edit.php?ID='.$f_USER_ID.'&lang='.LANG.'" target="_blank">['.$f_USER_ID.']</a>');
        $row->AddViewField("USER_EMAIL", $f_USER_EMAIL);
        $row->AddViewField("PRICE", $f_SUM_PAID);
        $row->AddViewField("STATUS", $status_list[$f_STATUS_ID]);                                                   
        $row->AddViewField("EXPORTED_TO_ACCORDPOST", $exportedToAccordpost);                                  
        $row->AddViewField("LABEL", $label);
    }   

    $lAdmin->AddFooter(
        array(
            array("title"=>GetMessage("MAIN_ADMIN_LIST_SELECTED"), "value"=>$rsData->SelectedRowsCount()), // element quantity
            array("counter"=>true, "title"=>GetMessage("MAIN_ADMIN_LIST_CHECKED"), "value"=>"0"), // selected elements counter
        )
    );

    // group actions
    $lAdmin->AddGroupActionTable(Array(
        "activate"=>GetMessage("MAIN_ADMIN_LIST_ACTIVATE"), // activate selected elements
        "deactivate"=>GetMessage("MAIN_ADMIN_LIST_DEACTIVATE"), // deactivate selected elements
    )); 


    //context menu
    $aContext = array(
        array(
            "TEXT"  => GetMessage("ACCORDPOST_EXPORT"),
            "LINK"  => 'javascript:void(0)',
            "LINK_PARAM"  => 'onclick = "export_orders_data()"',
            "TITLE" => GetMessage("ACCORDPOST_EXPORT"),
            "ICON"  => "btn_new",
        ),
    );                                         
    // create context menu
    $lAdmin->AddAdminContextMenu($aContext);

    $lAdmin->CheckListMode();
                                               

?>
<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php"); // 
    $APPLICATION->SetTitle(GetMessage("ACCORDPOST_EXPORT_TITLE"));  
?>
<?


    // create filter
    $oFilter = new CAdminFilter(
        $sTableID."_filter",
        array(
            "ID",                                                      
            GetMessage("FILTER_BUYER_ID"),            
            GetMessage("FILTER_DATE"),
            GetMessage("FILTER_ID_INTERVAL"),  
            "test",     
        )
    );
?>
<form name="find_form" method="get" action="<?echo $APPLICATION->GetCurPage();?>">
    <?$oFilter->Begin();?>
    <tr>
        <td>ID:</td>
        <td>
            <input type="text" name="find_id" size="5" value="<?echo htmlspecialchars($find_id)?>">
        </td>
    </tr>  
    <tr>
        <td><?=GetMessage("FILTER_BUYER_ID")?>:</td>
        <td>
            <input type="text" name="find_user_id" value="<?=$find_user_id?>" size="5"/>     
            <input type="button" value="..." onClick="jsUtils.OpenWindow('/bitrix/admin/user_search.php?lang=<?echo LANGUAGE_ID?>&FN=find_form&FC=find_user_id', 600, 500);">
        </td>
    </tr> 
    <tr>
        <td><?=GetMessage("FILTER_DATE")?>:</td>
        <td><?echo CalendarPeriod("find_date_from", htmlspecialcharsex($find_date_from), "find_date_to", htmlspecialcharsex($find_date_to), "find_form", "Y")?></td>
    </tr>

    <tr>  
        <td><?=GetMessage("FILTER_ID_INTERVAL")?>:</td>
        <td>
            <input type="text" name="find_id_from" size="10" value="<?echo htmlspecialcharsex($find_id_from)?>">
            ...
            <input type="text" name="find_id_to" size="10" value="<?echo htmlspecialcharsex($find_id_to)?>">
        </td>
    </tr>   
    <tr>  
        <td><?=GetMessage("EXPORTED_TO_ACCORDPOST")?>:</td>
        <td>
            <?
                $arr = array(
                    "reference" => array(
                        GetMessage("POST_YES"),
                        GetMessage("POST_NO"),
                    ),
                    "reference_id" => array(
                        "Y",
                        "N",
                    )
                );
                echo SelectBoxFromArray("find_exported", $arr, $find_active, GetMessage("POST_ALL"), ""); 
            ?>
        </td>
    </tr>               
    <?    
        $oFilter->Buttons(array("table_id"=>$sTableID,"url"=>$APPLICATION->GetCurPage(),"form"=>"find_form"));
        $oFilter->End();
    ?>
</form>
<div id="js-export-status"></div><br>
<?
    $lAdmin->DisplayList();
?>
    <script>
        $(function() {
            //задаем начальные параметры
            order_id_array = [];   
            interval = false;  

            //обработка чекбокса "выбрать все"
            $(".js-order-box-all").on("click", function() { 
                $(".js-order-box").each(function() {
                    var checkBoxes = $(this);
                    if (!checkBoxes.prop("disabled")) {
                        checkBoxes.prop("checked", !checkBoxes.prop("checked"));                
                    }                
                })                                                         
            })
        })

        //функция-обертка для экспорта заказов
        function export_orders_data() { 
            order_id_array = [];
            $("#form_tbl_accordpost_export_orders").find(".adm-list-table .adm-checkbox").each(function(){
                if ($(this).prop("checked")) {
                    order_id_array.push($(this).val());
                }
            })                            
            if (order_id_array.length == 0) {
                alert("<?=GetMessage("NO_ORDERS_SELECT")?>");
                return false;
            }                                   
            $("#js-export-status").show();  
            $("#js-export-status").html("<?=GetMessage("EXPORT_PROGRESS")?>");      
            export_order();
        }     
        //функция экспорта заказов
        function export_order() {          
            //проверяем текущую длину массива с заказами
            var len = order_id_array.length;      
            if (len <= 0) {
                //если массив пуст, то прерываем импорт                                
                $("#js-export-status").hide();  
                return false    
            } else {                                  
                //отправляем аяксом запрос на текущий файл. обработка таких запросов написаны выше
                $obj = $.extend({}, order_id_array);
                $.post("<?=$APPLICATION->GetCurPage()?>", {ID: $obj, export_order: "yes"}, function(data){    
                    $(".adm-list-table").load(window.location.href + " .adm-list-table  > *");   
                    $("#js-export-status").html(data);                                           
                });
            }    
        }
    </script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");?>