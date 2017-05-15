<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
//Данные для генерации этикетки      
$order_id = $_REQUEST['ACCORD_POST_ID'];

$partner_code = str_pad(ACCORDPOST_PARTNER_ID, 4, "0", STR_PAD_LEFT);
$order_code = str_pad($order_id, 14, "0", STR_PAD_LEFT);
$unic_code = $partner_code.$order_code;

$visual_code = substr($unic_code, -3);

$rs_order_props = CSaleOrderPropsValue::GetList(array(), array("ORDER_ID" => $order_id), false, false, array());
while($ar_order_prop = $rs_order_props->Fetch()) {      
    $order_properties[$ar_order_prop['CODE']] = $ar_order_prop['VALUE'];  
}                                                               

//Собираем поля в зависимости от типа лица                 
if($order_properties['PERSON_TYPE_ID'] == LEGAL_ENTITY_PERSON_TYPE_ID) {
    //имя получателя    
    $cont_name = '';    
    $cont_name = (!empty($order_properties["F_CONTACT_PERSON"]) ? $order_properties["F_CONTACT_PERSON"] : $order_properties["F_NAME"]);
    $user_name = preg_replace("/[^\w\s]+/u", "", $cont_name);                                                                                                             
} else {
    //имя получателя    
    $cont_name = '';            
    $cont_name = (!empty($order_properties["F_CONTACT_PERSON"]) ? $order_properties["F_CONTACT_PERSON"] : $order_properties["F_NAME"]);
    $user_name = preg_replace("/[^\w\s]+/u", "", $cont_name);                                                                                                   
}   
                            
$shipping_date = $_REQUEST['SHIPPING_DATE'];
$partner_name = ACCORDPOST_PARTNER_TITLE;

//Если нужно будет расширить для других доставок доработать
$deliver_code = '01';
$deliver_type = '23';
?>
<table style="width: 250px;border: 2px solid black;">
    <tbody>
        <tr>
            <th rowspan="2"><div style="font-size: 15px; font-family: arial; margin: 10px 0; width: 42px;"><?=$deliver_code.'-'.$deliver_type?></div></th>
            <th colspan="2"><div style="font-size: 9px; font-family: arial; font-weight: normal; text-transform: uppercase; font-weight: bold; margin: 5px 0;"><?=$user_name?></div></th>
            <th rowspan="4" style="width: 40px;"><div style="transform: rotate(-90deg); font-size: 25px; font-family: arial;"><?=$visual_code?></div></th>
        </tr>
        <tr>
            <td><div style="font-size: 9px; font-family: arial;"><?=$shipping_date?></div></td>
            <td><div style="font-size: 9px; font-family: arial;"><?=$partner_name?></div></td>
        </tr>
        <tr>
            <td colspan="3">
                <div style="overflow: hidden;text-align: center;height: 77px;margin: 4px 0 6px 0;"><img src='http://barcode.tec-it.com/barcode.ashx?translate-esc=off&data="<?=$unic_code;?>"&code=DataMatrix&unit=Px&dpi=80&imagetype=Png&rotation=0&color=000000&bgcolor=FFFFFF&qunit=Mm&quiet=0&modulewidth=4' alt="Barcode Generator TEC-IT"></div>
            </td>
        </tr>
        <tr>
            <td colspan="3"><div style="text-align: center; margin: -1px 0 6px 0; font-size: 10px; font-family: arial;"><?=$unic_code;?></div></td>
        </tr>
    </tbody>
</table>