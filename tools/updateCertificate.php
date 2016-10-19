<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Инструменты");
?>
<br>
Обновление подарочных сертификатов.<br>
<br>
<form action="">    
    ID от <input type='number' name='id_from' value='<?=$_GET['id_from']?>'>
    ID до <input type='number' name='id_to' value='<?=$_GET['id_to']?>'><br>   
    Обновить с даты по дату, поля можно оставлять пустыми. <br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
          <?$APPLICATION->IncludeComponent(
            "bitrix:main.calendar",
            "",
            Array(
                "COMPONENT_TEMPLATE" => ".default",                                                  
                "FORM_NAME" => "",
                "HIDE_TIMEBAR" => "N",
                "INPUT_NAME" => "date_from",
                "INPUT_NAME_FINISH" => "date_to",
                "INPUT_VALUE" => $_GET["date_from"],
                "INPUT_VALUE_FINISH" => $_GET["date_to"],
                "SHOW_INPUT" => "Y",
                "SHOW_TIME" => "N"
            )
        );?>
    <input type='submit' value='Обновить сертификаты'>
    <input type="hidden" name='send' value='yes'>
</form>
<?
    if ($_GET['send'] == 'yes') {
        if ((!empty($_GET['id_from']) && !empty($_GET['id_to']) && !empty($_GET["date_to"])) && ($_GET['id_from'] < $_GET['id_to'])) {
            for ($CouponID = $_GET['id_from']; $CouponID <= $_GET['id_to']; $CouponID++) {
                $arCouponID[] = $CouponID;
            }
            $date_to = ConvertDateTime($_GET['date_to'], "d.m.Y H:i:s");
            $date_to = new \Bitrix\Main\Type\DateTime($date_to);
            $date_from = ConvertDateTime($_GET['date_from'], "d.m.Y H:i:s");
            $date_from = new \Bitrix\Main\Type\DateTime($date_from);
            $fields = array(
                'ACTIVE_FROM' => $date_from,
                'ACTIVE_TO' => $date_to
            );
            foreach ($arCouponID as $couponID) {
                \Bitrix\Sale\Internals\DiscountCouponTable::update($couponID, $fields);
            }     
        } else {
            echo "Не удалось обновить сертификаты";    
        }
    }
?>
<br>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>