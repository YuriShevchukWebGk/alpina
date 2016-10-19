<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Инструменты");
?>
<br>
<form action="">    
    ID от <input type='number' name='id_from' value='<?=$_GET['id_from']?>'>
    до ID <input type='number' name='id_to' value='<?=$_GET['id_to']?>'>
    <input type='submit' value='Сгенерировать .csv'>
    <input type="hidden" name='send' value='yes'>
</form>
<?if ($_GET['send'] == 'yes') {
        if ((!empty($_GET['id_from']) && !empty($_GET['id_to'])) && ($_GET['id_from'] < $_GET['id_to'])) {
            for ($CouponID = $_GET['id_from']; $CouponID <= $_GET['id_to']; $CouponID++) {
                $arCouponID[] = $CouponID;
            }
            $arFilter = array('ID' => $arCouponID); 
            $dbCoupon = \Bitrix\Sale\Internals\DiscountCouponTable::getList(array(
                'select' => array('COUPON'),
                'filter' => $arFilter
            ));    
            while ($arCoupon = $dbCoupon->Fetch()) {
                $arCouponCODE[] = $arCoupon["COUPON"];
            }

            $fp = fopen($_SERVER["DOCUMENT_ROOT"].'/tools/csv/sert_list_'.date('Y-m-d').'.csv', 'w');
            foreach ($arCouponCODE as $line) {
                fputcsv($fp, explode(';', $line),";");
            }
            fclose($fp);

            echo '<br><a download href="/tools/csv/sert_list_'.date('Y-m-d').'.csv">Скачать .csv</a><br>';        
        } else {
            echo "Не удалось сгенерировать .csv";    
        }
    }
?>
<br>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>