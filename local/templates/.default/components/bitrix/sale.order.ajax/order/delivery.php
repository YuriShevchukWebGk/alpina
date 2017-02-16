<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<script type="text/javascript">
    function fShowStore(id, showImages, formWidth, siteId)
    {
        var strUrl = '<?=$templateFolder?>' + '/map.php';
        var strUrlPost = 'delivery=' + id + '&showImages=' + showImages + '&siteId=' + siteId;

        var storeForm = new BX.CDialog({
            'title': '<?=GetMessage('SOA_ORDER_GIVE')?>',
            head: '',
            'content_url': strUrl,
            'content_post': strUrlPost,
            'width': formWidth,
            'height':450,
            'resizable':false,
            'draggable':false
        });

        var button = [
            {
                title: '<?=GetMessage('SOA_POPUP_SAVE')?>',
                id: 'crmOk',
                'action': function ()
                {
                    GetBuyerStore();
                    BX.WindowManager.Get().Close();
                }
            },
            BX.CDialog.btnCancel
        ];
        storeForm.ClearButtons();
        storeForm.SetButtons(button);
        storeForm.Show();
    }

    function GetBuyerStore()
    {
        BX('BUYER_STORE').value = BX('POPUP_STORE_ID').value;
        BX('store_desc').innerHTML = BX('POPUP_STORE_NAME').value;
        BX.show(BX('select_store'));

    }

    function showExtraParamsDialog(deliveryId)
    {
        var strUrl = '<?=$templateFolder?>' + '/delivery_extra_params.php';
        var formName = 'extra_params_form';
        var strUrlPost = 'deliveryId=' + deliveryId + '&formName=' + formName;

        if(window.BX.SaleDeliveryExtraParams)
        {
            for(var i in window.BX.SaleDeliveryExtraParams)
            {
                strUrlPost += '&'+encodeURI(i)+'='+encodeURI(window.BX.SaleDeliveryExtraParams[i]);
            }
        }

        var paramsDialog = new BX.CDialog({
            'title': '<?=GetMessage('SOA_ORDER_DELIVERY_EXTRA_PARAMS')?>',
            head: '',
            'content_url': strUrl,
            'content_post': strUrlPost,
            'width': 500,
            'height':200,
            'resizable':true,
            'draggable':false
        });

        var button = [
            {
                title: '<?=GetMessage('SOA_POPUP_SAVE')?>',
                id: 'saleDeliveryExtraParamsOk',
                'action': function ()
                {
                    insertParamsToForm(deliveryId, formName);
                    BX.WindowManager.Get().Close();
                }
            },
            BX.CDialog.btnCancel
        ];

        paramsDialog.ClearButtons();
        paramsDialog.SetButtons(button);
        paramsDialog.Show();
    }

    function insertParamsToForm(deliveryId, paramsFormName)
    {
        var orderForm = BX("ORDER_FORM"),
        paramsForm = BX(paramsFormName);
        wrapDivId = deliveryId + "_extra_params";

        var wrapDiv = BX(wrapDivId);
        window.BX.SaleDeliveryExtraParams = {};

        if(wrapDiv)
            wrapDiv.parentNode.removeChild(wrapDiv);

        wrapDiv = BX.create('div', {props: { id: wrapDivId}});

        for(var i = paramsForm.elements.length-1; i >= 0; i--)
        {
            var input = BX.create('input', {
                props: {
                    type: 'hidden',
                    name: 'DELIVERY_EXTRA['+deliveryId+']['+paramsForm.elements[i].name+']',
                    value: paramsForm.elements[i].value
                }
                }
            );

            window.BX.SaleDeliveryExtraParams[paramsForm.elements[i].name] = paramsForm.elements[i].value;

            wrapDiv.appendChild(input);
        }

        orderForm.appendChild(wrapDiv);

        BX.onCustomEvent('onSaleDeliveryGetExtraParams',[window.BX.SaleDeliveryExtraParams]);
    }

    BX.addCustomEvent('onDeliveryExtraServiceValueChange', function(){ submitForm(); });

</script>
<?
    //Check if order have certificate
    $isOnlyCertificate = true;
    foreach ($arResult["BASKET_ITEMS"] as $prodId => $arProd) {
        $arElement = CIBlockElement::GetByID($arProd["PRODUCT_ID"])->Fetch();
        if ($arElement["IBLOCK_SECTION_ID"] != 143){
            $isOnlyCertificate = false;  
        }
    }
?>

<div <?if($isOnlyCertificate == true) { echo 'style="display:none;"';}?> class="grayLine"></div>

<input type="hidden" name="BUYER_STORE" id="BUYER_STORE" value="<?=$arResult["BUYER_STORE"]?>" />
<div <?if($isOnlyCertificate == true) { echo 'style="display:none;"';}?> class="bx_section js_delivery_block">
    <?
        if(!empty($arResult["DELIVERY"]))
        {
            $width = ($arParams["SHOW_STORES_IMAGES"] == "Y") ? 850 : 700;
        ?>
        <p class="blockTitle">Способ доставки<span class="deliveriWarming">Укажите спопсоб доставки</span></p>
        <?
            foreach ($arResult["DELIVERY"] as $delivery_id => $arDelivery) {
                if($arDelivery["ID"]!=22 && $isOnlyCertificate==true) {
                    continue;
                } 
                if($arDelivery["ID"]==22 && $isOnlyCertificate!=true) {
                    continue;
                }
                if($arDelivery["ID"]==22 && $isOnlyCertificate==true) {  
                    $arDelivery["CHECKED"]='Y';
                }
                // если это юр лицо и вес больше 10кг, то мимо
                if (($arDelivery["ID"] == GURU_DELIVERY_ID && !$USER->IsAdmin()) || ($arDelivery["ID"] == GURU_DELIVERY_ID && $arResult["USER_VALS"]['PERSON_TYPE_ID'] == LEGAL_ENTITY_PERSON_TYPE_ID && $arResult['ORDER_WEIGHT'] > GURU_LEGAL_ENTITY_MAX_WEIGHT)) { continue; }

                if($arDelivery["ISNEEDEXTRAINFO"] == "Y")
                    $extraParams = "showExtraParamsDialog('".$delivery_id."');";
                else
                    $extraParams = "";

                if (count($arDelivery["STORE"]) > 0)
                    $clickHandler = "onClick = \"fShowStore('".$arDelivery["ID"]."','".$arParams["SHOW_STORES_IMAGES"]."','".$width."','".SITE_ID."')\";";
                else
                    $clickHandler = "onClick = \"BX('ID_DELIVERY_ID_".$arDelivery["ID"]."').checked=true;".$extraParams."submitForm();\"";

            ?>  
            <div>
                <input type="radio"
                    class="radioInp"
                    id="ID_DELIVERY_ID_<?= $arDelivery["ID"] ?>"
                    name="<?=htmlspecialcharsbx($arDelivery["FIELD_NAME"])?>"
                    value="<?= $arDelivery["ID"] ?>"
                    <?if ($arDelivery["CHECKED"]=="Y") echo " checked";?>
                    onclick="submitForm();"
                    /> 
                <label for="ID_DELIVERY_ID_<?=$arDelivery["ID"]?>" class="faceText">
                    <?= htmlspecialcharsbx($arDelivery["NAME"])?> -                   
                    <?if(isset($arDelivery["PRICE"])):?>
                        <b class="ID_DELIVERY_ID_<?=$arDelivery["ID"]?>">
                            <? if ($arDelivery["ID"] == FLIPPOST_ID || $arDelivery["ID"] == GURU_DELIVERY_ID ||  $arDelivery["ID"] == BOXBERRY_PICKUP_DELIVERY_ID) {
                                echo "Выберите местоположение";
                            } else { ?>
                                <?=(strlen($arDelivery["PRICE_FORMATED"]) > 0 ? $arDelivery["PRICE_FORMATED"] : number_format($arDelivery["PRICE"], 2, ',', ' '))?>
                            <? } ?>
                        </b>
                        <?   
                            if (strlen($arDelivery["PERIOD_TEXT"])>0)
                            {
                                echo GetMessage('SALE_SADC_TRANSIT').": <b>".$arDelivery["PERIOD_TEXT"]."</b>"; //Временно убираем
                            ?><br /><?
                            }
                            if ($arDelivery["PACKS_COUNT"] > 1)
                            {
                                echo '<br />';
                                echo GetMessage('SALE_SADC_PACKS').': <b>'.$arDelivery["PACKS_COUNT"].'</b>';
                            }  
                        ?>
                        <?endif;?>

                </label>      


                <p class="shipingText" <?=$clickHandler?>>
                    <?
                        if (strlen($arDelivery["DESCRIPTION"])>0)
                            echo $arDelivery["DESCRIPTION"]."<br />";

                        if (count($arDelivery["STORE"]) > 0):
                        ?>
                        <span id="select_store"<?if(strlen($arResult["STORE_LIST"][$arResult["BUYER_STORE"]]["TITLE"]) <= 0) echo " style=\"display:none;\"";?>>
                            <span class="select_store"><?=GetMessage('SOA_ORDER_GIVE_TITLE');?>: </span>
                            <span class="ora-store" id="store_desc"><?=htmlspecialcharsbx($arResult["STORE_LIST"][$arResult["BUYER_STORE"]]["TITLE"])?></span>
                        </span>
                        <?
                            endif;
                    ?>    
                </p>  

                <?if ($arDelivery['CHECKED'] == 'Y'):?>
                    <table class="delivery_extra_services">
                        <?foreach ($arDelivery['EXTRA_SERVICES'] as $extraServiceId => $extraService):?>
                            <?if(!$extraService->canUserEditValue()) continue;?>
                            <tr>
                                <td class="name">
                                    <?=$extraService->getName()?>
                                </td>
                                <td class="control">
                                    <?=$extraService->getEditControl('DELIVERY_EXTRA_SERVICES['.$arDelivery['ID'].']['.$extraServiceId.']')    ?>
                                </td>
                                <td rowspan="2" class="price">
                                    <?

                                        if ($price = $extraService->getPrice())
                                        {
                                            echo GetMessage('SOA_TEMPL_SUM_PRICE').': ';
                                            echo '<strong>'.SaleFormatCurrency($price, $arResult['BASE_LANG_CURRENCY']).'</strong>';
                                        }

                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="description"> 
                                    <?=$extraService->getDescription()?>    
                                </td>
                            </tr>
                            <?endforeach?>
                    </table>
                    <?endif?>

                <?  if ($delivery_id =="21") { ?>
                    <div id="IML_PVZ"></div>
                    <? } ?> 
                    
                <? if ($arDelivery["ID"] == FLIPPOST_ID) { ?>
                    <div class="flippostSelectContainer">
                        
                    </div>
                    <div class="flippost_error"><?= GetMessage('FLIPPOST_SELECT_EMPTY') ?></div>
                    <div id="flippost_delivery_time" class="flippost_delivery_time"><?= GetMessage("FLIPPOST_DELIVERY_TIME")?>: <span></span></div>
                    <input type="hidden" id="flippost_address" name="flippost_address" value="">
                    <input type="hidden" id="flippost_cost" name="flippost_cost" value="">  
                <? } ?>
                
                <? if ($arDelivery["ID"] == GURU_DELIVERY_ID && $USER->IsAdmin()) { ?>
                    <div class="guru_delivery_wrapper">
                        <div class="guru_error"><?= GetMessage('GURU_ERROR') ?></div>
                        <b><?= GetMessage('SEARCH_ON_MAP') ?></b>
                        <br><span id="close_map" style="position:fixed; top:-2000px; cursor:pointer; z-index:999; right:75px; background:#cccccc; display:inline-block; padding:2px 4px; padding-bottom:4px; text-decoration:underline;">закрыть</span>
                        <span style="cursor:pointer; display:block; text-decoration:underline;" class="message-map-link"><?= GetMessage('CHOSE_ON_MAP') ?></span>
                        <div id="YMapsID"></div>
                        <div class="guru_point_addr"></div>
                        <div id="guru_delivery_time" class="guru_delivery_time"><?= GetMessage("GURU_DELIVERY_TIME")?>: <span></span></div>
                        <input type="hidden" id="guru_delivery_data" name="guru_delivery_data" value="">
                        <input type="hidden" id="guru_cost" name="guru_cost" value="">
                        <input type="hidden" id="guru_selected" name="guru_selected" value="">
                    </div>
                <? } ?>                                                
                <? if ($arDelivery["ID"] == BOXBERRY_PICKUP_DELIVERY_ID && $USER->IsAdmin()) { ?>
                    <div class="boxberry_delivery_wrapper">                                                                                                                 
                        <div class="boxberry_error"><?= GetMessage('BOXBERRY_ERROR') ?></div>                                                                                                                                                                            
                        <a href="#" class="message-map-link" style="cursor: pointer; display: block;  text-decoration: underline; color:#000;" onclick="boxberry.open('boxberry_callback', '<?= BOXBERRY_TOKEN_API?>', 'Москва', '68', <?= $arResult['ORDER_DATA']['ORDER_PRICE']?>, <?= $arResult['ORDER_DATA']['ORDER_WEIGHT']?>, 0, 50, 50, 50); return false"><?= GetMessage('CHOSE_ON_MAP') ?></a>   
                        <div id="boxberry_delivery_time" class="boxberry_delivery_time"><?= GetMessage("GURU_DELIVERY_TIME")?>: <span></span></div>
                        <input type="hidden" id="boxberry_delivery_data" name="boxberry_delivery_data" value="">
                        <input type="hidden" id="boxberry_cost" name="boxberry_cost" value="">
                        <input type="hidden" id="boxberry_selected" name="boxberry_selected" value="">
                    </div>
                <? } ?>

                <div class="clear"></div>
            </div>          
            <?
            }
        }
    ?>
    <div class="clear"></div>
</div>