
<?// --- if user came from readright,then redirect him to readright
$string = '<script type="text/javascript">';
$string .= 'window.location = "http://readright.ru/private_office/?billnumber='.$_GET['order_id'].'"';
$string .= '</script>';

if(preg_match('/GR_/',$_GET['order_id'])){
    require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");
    echo $string;
} else {?>
    <?
	require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Платеж");
    ?> Спасибо за оплату заказа <?=$_GET['comment']?>!
    <br />
    
    <?unset($_SESSION['rfi_bank_tab']);?>
    <?echo '<script>localStorage.removeItem("active_rfi_button");</script>'?>
    <?//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
<?}?>