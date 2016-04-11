<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    $APPLICATION->SetTitle("Оплата заказа");
?>
<style type="text/css">
    *{
        font-family: Tahoma;
    }

    .rfi_result_table{
        font-size: 14px;
        border:1px solid #f57720;
        margin:0 auto;
    }

    .rfi_result_table td{
        vertical-align: top;
        padding:10px 0px;
        text-align:center;
    }
</style>
<?$arOrder = CSaleOrder::GetByID($_GET['ORDER_ID']);?>
<?if($arOrder['PAY_SYSTEM_ID']==13){?>
    <br>
    <br>
    <div style="width:100%;text-align: center">
        Заказ №<?=$arOrder['ID']?>
        от <?=$arOrder['DATE_STATUS']?><br>
        Сумма к оплате по счету: <?=$arOrder['PRICE']?>
        руб.
    </div>
    <br>
    <?}?>
<div style="text-align: center">
    <?$APPLICATION->IncludeComponent(
            "user:sale.order.payment",
            "",
            Array(
            )
        );?>
</div>
<?if($arOrder['PAY_SYSTEM_ID']==13){?>
    <div style="text-align: center">
        <table class="rfi_result_table">
            <colspan>
                <col width="40">
                <col width="420">
                <col width="70">
            </colspan>
            <tr>
                <td><img src="/images/green_lock.png"></td>
                <td> Данные вашей банковской карты используются только в момент
                    <br>
                    совершения операции и передаются по защищенному
                    <br>
                    протоколу в банк-эквайер в зашифрованном виде. Реквизиты
                    <br>
                    вашей карты не сохраняются в системе и,соответсвенно,не
                    <br>
                    могут быть переданы третьим лицам. </td>
                <td><img src="/images/rfi_logo.png"></td>
            </tr>
        </table>
    </div>
    <?}?> 
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>