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
            <p class="numbTitle"><?= GetMessage("NUMBER"); ?></p>
            <p class="dateTitle"><?= GetMessage("DATE"); ?></p>
            <p class="quantTitle"><?= GetMessage("QUANTITY"); ?></p>
            <p class="statTitle"><?= GetMessage("STATUS"); ?></p>
            <p class="sumTitle"><?= GetMessage("SUMM"); ?></p>
        </div>
        <?

        $key = 0;
        if (!empty($arResult["ORDERS"])) {
            foreach ($arResult["ORDER_BY_STATUS"] as $order_key => $group) {
                foreach ($group as $k => $order) {

                    $quantity = 0;
                    foreach ($order["BASKET_ITEMS"] as $arBaskItem) {
                        $quantity += round($arBaskItem["QUANTITY"]);
                    }

                    $key++;
                    ?>
                    <div class="orderNumbLine">
                        <p class="ordTitle" data-id="<?= $key ?>"><span><?= GetMessage("SPOL_ORDER") . " " . GetMessage("SPOL_NUM_SIGN") . $order["ORDER"]["ID"] ?></span></p>
                        <p class="ordDate"><?= $order["ORDER"]["DATE_INSERT_FORMATED"] ?></p>
                        <p class="ordQuant"><?= $quantity ?></p>
                        <p class="ordStatus"><?= $arResult["INFO"]["STATUS"][$order_key]["NAME"] ?></p>
                        <p class="ordSum"><span><?= ceil($order["ORDER"]["PRICE"]) ?> </span><?= GetMessage("ROUBLES") ?></p>
                    </div>

                    <div class="hiddenOrderInf hidOrdInfo<?= $key ?>">
                        <div class="infoAddrWrap">
                            <div>
                                <p class="dopInfoTitle firstCol"><?= GetMessage("CUSTOMER_INFO") ?></p>
                                <p class="dopInfoText"><?= $arResult["USER_INFO"][$order["ORDER"]["USER_ID"]]["LAST_NAME"] . " " . $arResult["USER_INFO"][$order["ORDER"]["USER_ID"]]["NAME"] . " " . $arResult["USER_INFO"][$order["ORDER"]["USER_ID"]]["SECOND_NAME"] ?></p>
                                <p class="dopInfoText"><?= $arResult["USER_INFO"][$order["ORDER"]["USER_ID"]]["PERSONAL_PHONE"] ?></p>
                                <p class="dopInfoText"><?= $arResult["USER_INFO"][$order["ORDER"]["USER_ID"]]["EMAIL"] ?></p>
                                <p class="dopInfoTitle thiCol"><?= GetMessage("DELIVERY_ADDR") ?></p>
                                <p class="dopInfoText"><?= GetMessage("CITY") ?><?= $arResult["ORDER_INFO"][$order["ORDER"]["ID"]]["DELIVERY_CITY"]["CITY_NAME"] ?></p>
                                <p class="dopInfoText"><?= $arResult["ORDER_INFO"][$order["ORDER"]["ID"]]["DELIVERY_ADDR"] ?></p>
                                <p class="dopInfoTitle thiCol"><?= GetMessage("PHONE") ?></p>
                                <p class="dopInfoText"><?= $arResult["ORDER_INFO"][$order["ORDER"]["ID"]]["ORDER_PHONE"] ?></p>
                            </div>
                            <div>
                                <p class="dopInfoTitle"><?= GetMessage("DELIVERY_TYPE") ?></p>
                                <p class="dopInfoText"><?= $arResult["INFO"]["DELIVERY"][$order["ORDER"]["DELIVERY_ID"]]["NAME"] ?></p>
                                <p class="dopInfoTitle thiCol"><?= GetMessage("SPOL_PAYSYSTEM") ?></p> <!--класс отступа сверху -->
                                <p class="dopInfoText"><?= $arResult["INFO"]["PAY_SYSTEM"][$order["ORDER"]["PAY_SYSTEM_ID"]]["NAME"] ?></p>
                                <?if ($order["ORDER"]["DELIVERY_ID"] == PICKPOINT_DELIVERY_ID) {?>
                                    <p class="dopInfoTitle thiCol"><?= GetMessage("DELIVERY_DATE") ?></p> <!--класс отступа сверху -->
                                    <p class="dopInfoText"><?= CustomPickPoint::getDeliveryDate($order["ORDER"]["ID"]) ?></p>
                                    <?}?>
                                <?if (in_array($order["ORDER"]["PAY_SYSTEM_ID"], array(RFI_PAYSYSTEM_ID, SBERBANK_PAYSYSTEM_ID))
                                    && ($order["ORDER"]["PAYED"] != "Y")) {
                                    ?>
                                        <p class="dopInfoTitle thiCol to_pay">
                                            <a href="/personal/order/payment/?ORDER_ID=<?= $order["ORDER"]["ID"] ?>"><?= GetMessage("TO_PAY") ?></a>
                                        </p>
                                    <?
                                }
                                ?>
                                <p class="dopInfoTitle thiCol"><?= GetMessage("TRACK_NUMBER") ?></p>
                               <?
                                $origin_identifier = \Bitrix\Sale\Order::load($order["ORDER"]["ID"]);

                                /** @var \Bitrix\Sale\ShipmentCollection $shipmentCollection */
                                $shipmentCollection = $origin_identifier->getShipmentCollection();
                                foreach ($shipmentCollection as $shipment) {
                                if($shipment->isSystem())
                                    continue;
                                    $track = $shipment->getField('TRACKING_NUMBER');
                                }?>
                                <p class="dopInfoText"><?if(empty($track)){
                                    echo GetMessage("TRACK_NUMBER_NULL");
                                }elseif($order["ORDER"]["DELIVERY_ID"] == DELIVERY_MAIL || $order["ORDER"]["DELIVERY_ID"] == DELIVERY_MAIL_2) {?>
                                    <?=GetMessage("TRACK_NUMBER_MAIL", Array ("#TRACK#" => $track)); ?>
                                <?}elseif($order["ORDER"]["DELIVERY_ID"] == DELIVERY_PICK_POINT){?>
                                    <?=GetMessage("TRACK_NUMBER_PICK_POINT") ?>
                                <?}elseif($order["ORDER"]["DELIVERY_ID"] == DELIVERY_FLIPOST){?>
                                    <?=GetMessage("TRACK_NUMBER_FLIPOST") ?>
                                <?}?>
                                </p>
                            </div>
                            <? if ($order["ORDER"]["DELIVERY_ID"] == PICKPOINT_DELIVERY_ID) {?>
                                <div class="issuing_ordering_items">
                                    <p class="dopInfoTitle"><?= GetMessage("PVZ") ?></p>
                                    <p class="dopInfoText"><?= $order["ORDER"]["USER_DESCRIPTION"] ?></p>
                                </div>
                            <?}?>
                        </div>
                        <div>
                            <p class="ordBooksTitle"><?= GetMessage("SPOL_ORDER_DETAIL") ?></p>
                            <table class="orderBooks">
                                <?foreach ($order["BASKET_ITEMS"] as $arBaskItem) {
                                    ?>
                                    <tr>
                                        <td class="infoTextTab infBookName"><?= $arBaskItem["NAME"] ?></td>
                                        <td class="infoQuant"><?= $arBaskItem["QUANTITY"] ?></td>
                                        <td class="infoPriceTd"><?= ceil($arBaskItem["PRICE"]) * $arBaskItem["QUANTITY"] ?> <?= GetMessage("ROUBLES") ?></td>
                                    </tr>
                                <?}?>
                                <?if (intval($order["ORDER"]["PRICE_DELIVERY"]) > 0) {?>
                                    <tr>
                                        <td class="infoTextTab infBookName"><?= GetMessage("SPOL_DELIVERY") ?></td>
                                        <td class="infoQuant"></td>
                                        <td class="infoPriceTd"><?= ceil($order["ORDER"]["PRICE_DELIVERY"]) ?> <?= GetMessage("ROUBLES") ?></td>
                                    </tr>
                                <?}?>
                                <tr>
                                    <td class="infoTextTab"><?= GetMessage("FINAL_SUMM") ?></td>
                                    <td class="infoQuant"></td>
                                    <td class="infoPriceTd"><?= ceil($order["ORDER"]["PRICE"]) ?> <?= GetMessage("ROUBLES") ?></td>
                                </tr>
                            </table>
                        </div>
                        <div>
                            <p class="orderCancel"><a href="<?= $order["ORDER"]["URL_TO_CANCEL"] ?>"><?= GetMessage("SPOL_CANCEL_ORDER") ?></a></p>
                        </div>
                    </div>
                <?}
            }
        }?>

    </div>
<?endif?>

<script>
$(document).ready(function() {
    $(".tableTitle").next(".orderNumbLine").addClass("active");
    $(".tableTitle").next(".orderNumbLine").next(".hiddenOrderInf").css("display", "block");

    if ($(".issuing_ordering_items").size() > 0) {
        $(".infoAddrWrap").css("height", "300px");
    }
});
</script>