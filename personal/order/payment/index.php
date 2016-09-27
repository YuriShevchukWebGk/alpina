<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    $APPLICATION->SetTitle("Оплата заказа");
?>
<?
global $USER;
if (!$USER->GetID()) { ?>
<script>
document.addEventListener('DOMContentLoaded', function(){
	// вырезаем какой-то левый текст из футера
	document.querySelector(".authorisationWrapper").nextSibling.remove();
})
</script>
<style type="text/css">
	.alert-danger {
		color: #7B8C90;
	    font-family: "Walshein_regular";
	    font-size: 24px !important;
	    margin: 15px 0;	
	}
	
	.bx-authform input[type="text"], .bx-authform input[type="password"] {
	    background-color: #fdfdfd !important;
	    border: 1px solid #c1c5c8 !important;
	    box-shadow: none !important;
	    color: #353535 !important;
	    font-family: "Walshein_regular" !important;
	    font-size: 14px !important;
	    height: 34px !important;
	    padding: 0 0 0 14px !important;
	    width: 248px !important;
	    margin-bottom: 15px;
	    display: inline-block;
	    outline: none;
	    vertical-align: middle;
	    background: #fff;
	    border-radius: 2px;
	}
	
	.btn-primary {
		background-color: #00a0af !important;
	    border-radius: 40px;
	    color: white;
	    font-family: "Walshein_regular";
	    font-size: 19px;
	    padding: 13px 48px;
	    text-decoration: none;
	    border-color: transparent !important;
	    margin-top: 15px;
	}
</style>	

<? $APPLICATION->AuthForm('Авторизуйтесь для доступа к странице оплаты', true, true, 'N', false);
 } else { ?>
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
<? } ?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>