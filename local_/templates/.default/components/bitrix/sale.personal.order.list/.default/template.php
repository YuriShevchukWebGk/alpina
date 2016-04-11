<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if(!empty($arResult['ERRORS']['FATAL'])):?>

	<?foreach($arResult['ERRORS']['FATAL'] as $error):?>
		<?//=ShowError($error)?>
	<?endforeach?>

	<?$component = $this->__component;?>
	<?if($arParams['AUTH_FORM_IN_TEMPLATE'] && isset($arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED])):?>
		<?$APPLICATION->AuthForm('', false, false, 'N', false);?>
	<?endif?>

<?else:?>

	<?if(!empty($arResult['ERRORS']['NONFATAL'])):?>

		<?foreach($arResult['ERRORS']['NONFATAL'] as $error):?>
			<?=ShowError($error)?>
		<?endforeach?>

	<?endif?>

	
                <p class="personal_title"><?$APPLICATION->ShowTitle();?></p>

                <div class="historyWrap">
                    <div class="tableTitle">
                        <p class="numbTitle">Номер</p>
                        <p class="dateTitle">Дата</p>
                        <p class="quantTitle">Количество</p>
                        <p class="statTitle">Статус</p>
                        <p class="sumTitle">Сумма</p>
                    </div>
                    <?
                    
                    $key = 0;
                        foreach ($arResult["ORDER_BY_STATUS"] as $order_key => $group)
                        {
                            foreach ($group as $k => $order)
                            {
                                
                                $quantity = 0;
                                foreach ($order["BASKET_ITEMS"] as $arBaskItem)
                                {
                                    $quantity += round($arBaskItem["QUANTITY"]);    
                                }
                                $user = CUser::GetByID($order["ORDER"]["USER_ID"])->Fetch();
                                
                                $order_info = CSaleOrderPropsValue::GetList(array(), array("ORDER_ID" => intval($order["ORDER"]["ID"])), false, false, array());
                                while ($info_fetch = $order_info->Fetch())
                                {   
                                    if ($info_fetch["ORDER_PROPS_ID"] == 2)
                                    {
                                        $delivery_city = CSaleLocation::GetByID($info_fetch["VALUE"]);
                                    }
                                    if ($info_fetch["ORDER_PROPS_ID"] == 5)
                                    {
                                        $delivery_addr = $info_fetch["VALUE"];
                                    }
                                    if ($info_fetch["CODE"] == "PHONE")
                                    {
                                        $phone_order = $info_fetch["VALUE"];
                                    } 
                                }
                                $key++;
                   ?>
                    <div class="orderNumbLine">
                        <p class="ordTitle" data-id="<?=$key?>"><span>Заказ №<?=$order["ORDER"]["ID"]?></span></p>    
                        <p class="ordDate"><?=$order["ORDER"]["DATE_INSERT_FORMATED"]?></p>    
                        <p class="ordQuant"><?=$quantity?></p>    
                        <p class="ordStatus"><?=$arResult["INFO"]["STATUS"][$order_key]["NAME"]?></p>    
                        <p class="ordSum"><span><?=ceil($order["ORDER"]["PRICE"])?> </span>руб.</p>    
                    </div>

                    <div class="hiddenOrderInf hidOrdInfo<?=$key?>">
                        <div class="infoAddrWrap">
                            <div>
                                <p class="dopInfoTitle firstCol">Информация о заказчике</p>
                                <p class="dopInfoText"><?=$user["LAST_NAME"]." ".$user["NAME"]." ".$user["SECOND_NAME"]?></p>
                                <p class="dopInfoText"><?=$user["PERSONAL_PHONE"]?></p>
                                <p class="dopInfoText"><?=$user["EMAIL"]?></p>
                                <p class="dopInfoTitle thiCol">Адрес доставки</p>
                                <p class="dopInfoText">г.<?=$delivery_city["CITY_NAME"]?></p>
                                <p class="dopInfoText"><?=$delivery_addr?></p>
                                <p class="dopInfoTitle thiCol">Телефон</p>
                                <p class="dopInfoText"><?=$phone_order?></p>
                            </div>
                            <div>
                                <p class="dopInfoTitle">Способ доставки</p>
                                <p class="dopInfoText"><?=$arResult["INFO"]["DELIVERY"][$order["ORDER"]["DELIVERY_ID"]]["NAME"]?></p>
                                <p class="dopInfoTitle thiCol">Способ оплаты</p> <!--класс отступа сверху -->
                                <p class="dopInfoText"><?=$arResult["INFO"]["PAY_SYSTEM"][$order["ORDER"]["PAY_SYSTEM_ID"]]["NAME"]?></p>
                                <?if (in_array($order["ORDER"]["PAY_SYSTEM_ID"], array(13, 14)) && ($order["ORDER"]["PAYED"] != "Y"))
                                {
                                ?>
                                <p class="dopInfoTitle thiCol to_pay"><a href="/personal/order/payment/?ORDER_ID=<?=$order["ORDER"]["ID"]?>">Оплатить</a></p>
                                <?
                                }
                                ?>
                            </div>
                            <? if ($order["ORDER"]["DELIVERY_ID"] == 18)
                            {?>
                                <div class="issuing_ordering_items">
                                    <p class="dopInfoTitle">Пункт выдачи заказа</p>
                                    <p class="dopInfoText"><?=$order["ORDER"]["USER_DESCRIPTION"]?></p>       
                                </div>    
                            <?}?>
                        </div>
                        <div>
                            <p class="ordBooksTitle">Информация о заказе</p>
                            <table class="orderBooks">
                                <?foreach ($order["BASKET_ITEMS"] as $arBaskItem)
                                {
                                    ?>
                                <tr>
                                    <td class="infoTextTab infBookName"><?=$arBaskItem["NAME"]?></td>
                                    <td class="infoQuant"><?=$arBaskItem["QUANTITY"]?></td>
                                    <td class="infoPriceTd"><?=ceil($arBaskItem["PRICE"])*$arBaskItem["QUANTITY"]?> руб.</td>
                                </tr>
                                <?}?>
                                <?if (intval($order["ORDER"]["PRICE_DELIVERY"]) > 0)
                                {?>
                                <tr>
                                    <td class="infoTextTab infBookName">Доставка</td>
                                    <td class="infoQuant"></td>
                                    <td class="infoPriceTd"><?=ceil($order["ORDER"]["PRICE_DELIVERY"])?> руб.</td>
                                </tr>
                                <?}?>
                                <tr>
                                    <td class="infoTextTab">Итого</td>
                                    <td class="infoQuant"></td>
                                    <td class="infoPriceTd"><?=ceil($order["ORDER"]["PRICE"])?> руб.</td>
                                </tr>
                            </table>
                        </div>
                        <div>
                            <p class="orderCancel"><a href="<?=$order["ORDER"]["URL_TO_CANCEL"]?>">Отменить заказ</a></p>    
                        </div>
                    </div>
                    <?}
                            }?>
                    
                </div>
<?endif?>

<script>
$(document).ready(function()
{
    $(".tableTitle").next(".orderNumbLine").addClass("active");
    $(".tableTitle").next(".orderNumbLine").next(".hiddenOrderInf").css("display", "block");
    
    if ($(".issuing_ordering_items").size() > 0)
    {
        $(".infoAddrWrap").css("height", "300px");
    }
});
</script>