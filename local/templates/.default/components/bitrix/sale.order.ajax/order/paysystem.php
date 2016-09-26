<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="section">
    <script type="text/javascript">
        function changePaySystem(param)
        {
            if (BX("account_only") && BX("account_only").value == 'Y') // PAY_CURRENT_ACCOUNT checkbox should act as radio
            {
                if (param == 'account')
                {
                    if (BX("PAY_CURRENT_ACCOUNT"))
                    {
                        BX("PAY_CURRENT_ACCOUNT").checked = true;
                        BX("PAY_CURRENT_ACCOUNT").setAttribute("checked", "checked");
                        BX.addClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');

                        // deselect all other
                        var el = document.getElementsByName("PAY_SYSTEM_ID");
                        for(var i=0; i<el.length; i++)
                            el[i].checked = false;
                    }
                }
                else
                {
                    BX("PAY_CURRENT_ACCOUNT").checked = false;
                    BX("PAY_CURRENT_ACCOUNT").removeAttribute("checked");
                    BX.removeClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');
                }
            }
            else if (BX("account_only") && BX("account_only").value == 'N')
            {
                if (param == 'account')
                {
                    if (BX("PAY_CURRENT_ACCOUNT"))
                    {
                        BX("PAY_CURRENT_ACCOUNT").checked = !BX("PAY_CURRENT_ACCOUNT").checked;

                        if (BX("PAY_CURRENT_ACCOUNT").checked)
                        {
                            BX("PAY_CURRENT_ACCOUNT").setAttribute("checked", "checked");
                            BX.addClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');
                        }
                        else
                        {
                            BX("PAY_CURRENT_ACCOUNT").removeAttribute("checked");
                            BX.removeClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');
                        }
                    }
                }
            }

            submitForm();
        }
    </script>
    <div class="grayLine"></div>

    <div class="bx_section">
        <p class="blockTitle">Способ оплаты</p>
        <?    
            uasort($arResult["PAY_SYSTEM"], "cmpBySort"); // resort arrays according to SORT value
            foreach($arResult["PAY_SYSTEM"] as $arPaySystem)
            {   
                if (strlen(trim(str_replace("<br />", "", $arPaySystem["DESCRIPTION"]))) > 0 || intval($arPaySystem["PRICE"]) > 0)
                {?>
                <?  
                    if ($arPaySystem["ID"] == PAYPAL_PAYSYSTEM_ID) {
                        global $USER;
                        if ($USER->IsAdmin()) {?>
                            <input type="radio"
                                class="radioInp"
                                id="ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>"
                                name="PAY_SYSTEM_ID"
                                value="<?=$arPaySystem["ID"]?>"
                                <?if ($arPaySystem["CHECKED"]=="Y" && !($arParams["ONLY_FULL_PAY_FROM_ACCOUNT"] == "Y" && $arResult["USER_VALS"]["PAY_CURRENT_ACCOUNT"]=="Y")) echo " checked=\"checked\"";?>
                                onclick="changePaySystem();" />
                            <label for="ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>" onclick="BX('ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>').checked=true;changePaySystem();" class="faceText">
                                <?=$arPaySystem["PSA_NAME"];?>
                            </label>

                            <p class="shipingText">
                                <?
                                    if (intval($arPaySystem["PRICE"]) > 0)
                                        echo str_replace("#PAYSYSTEM_PRICE#", SaleFormatCurrency(roundEx($arPaySystem["PRICE"], SALE_VALUE_PRECISION), $arResult["BASE_LANG_CURRENCY"]), GetMessage("SOA_TEMPL_PAYSYSTEM_PRICE"));
                                    else
                                        echo $arPaySystem["DESCRIPTION"];
                                ?>
                            </p>

                            <div class="clear"></div>    
                        <?}    
                    } else {?>
                        <input type="radio"
                            class="radioInp"
                            id="ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>"
                            name="PAY_SYSTEM_ID"
                            value="<?=$arPaySystem["ID"]?>"
                            <?if ($arPaySystem["CHECKED"]=="Y" && !($arParams["ONLY_FULL_PAY_FROM_ACCOUNT"] == "Y" && $arResult["USER_VALS"]["PAY_CURRENT_ACCOUNT"]=="Y")) echo " checked=\"checked\"";?>
                            onclick="changePaySystem();" />
                        <label for="ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>" onclick="BX('ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>').checked=true;changePaySystem();" class="faceText">
                            <?=$arPaySystem["PSA_NAME"];?>
                        </label>

                        <p class="shipingText">
                            <?
                                if (intval($arPaySystem["PRICE"]) > 0)
                                    echo str_replace("#PAYSYSTEM_PRICE#", SaleFormatCurrency(roundEx($arPaySystem["PRICE"], SALE_VALUE_PRECISION), $arResult["BASE_LANG_CURRENCY"]), GetMessage("SOA_TEMPL_PAYSYSTEM_PRICE"));
                                else
                                    echo $arPaySystem["DESCRIPTION"];
                            ?>
                        </p>

                <?
                //варианты оплаты для электронных платежей
                if($arPaySystem['ID'] == RFI_PAYSYSTEM_ID && $arResult["USER_VALS"]['PAY_SYSTEM_ID'] == RFI_PAYSYSTEM_ID){?>
                    <ul class="rfi_bank_vars">
                        <li data-rfi-payment="wm">WebMoney</li>
                        <li data-rfi-payment="ym">Яндекс деньги</li>
                        <li data-rfi-payment="qiwi">QIWI</li>
                        <li data-rfi-payment="spg">Visa/Mastercard</li>
                        <li data-rfi-payment="mc">Мобильный платеж</li>
                    </ul>
                    <? if ($arResult["UF_RECURRENT_ID"]) { ?>
	                    <ul class="recurrent_tabs">
	                    	<li class="active_recurrent_tab" data-rfi-recurrent-type="new"><?= GetMessage("RFI_RECURRENT_NEW_CARD") ?></li>
	                    	<li data-rfi-recurrent-type="next"><?= $arResult["UF_RECURRENT_CARD_ID"] ?></li>
	                    	<li><?= GetMessage("RFI_RECURRENT_DESCRIPTION") ?></li>
	                    </ul>
                    <? } ?>
                    <?}?>          
                <?}

                if (strlen(trim(str_replace("<br />", "", $arPaySystem["DESCRIPTION"]))) == 0 && intval($arPaySystem["PRICE"]) == 0)
                {
                    if (count($arResult["PAY_SYSTEM"]) == 1)
                    {
                    ?>                       
                    <input type="hidden" name="PAY_SYSTEM_ID" value="<?=$arPaySystem["ID"]?>">
                    <input type="radio"
                        class="radioInp"
                        id="ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>"
                        name="PAY_SYSTEM_ID"
                        value="<?=$arPaySystem["ID"]?>"
                        <?if ($arPaySystem["CHECKED"]=="Y" && !($arParams["ONLY_FULL_PAY_FROM_ACCOUNT"] == "Y" && $arResult["USER_VALS"]["PAY_CURRENT_ACCOUNT"]=="Y")) echo " checked=\"checked\"";?>
                        onclick="changePaySystem();"
                        />
                    <label for="ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>" onclick="BX('ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>').checked=true;changePaySystem();" class="faceText">
                        <?=$arPaySystem["PSA_NAME"];?>
                    </label>  
                    <div class="clear"></div>
                    <?
                    }
                    else // more than one
                    {
                    ?>       
                    <input type="radio"
                        class="radioInp"
                        id="ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>"
                        name="PAY_SYSTEM_ID"
                        value="<?=$arPaySystem["ID"]?>"
                        <?if ($arPaySystem["CHECKED"]=="Y" && !($arParams["ONLY_FULL_PAY_FROM_ACCOUNT"] == "Y" && $arResult["USER_VALS"]["PAY_CURRENT_ACCOUNT"]=="Y")) echo " checked=\"checked\"";?>
                        onclick="changePaySystem();" />

                    <label for="ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>" onclick="BX('ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>').checked=true;changePaySystem();" class="faceText">
                        <?=$arPaySystem["PSA_NAME"];?>
                    </label>    
                    <div class="clear"></div>
                    <?
                    }
                }
            }
        ?>
        <div style="clear: both;"></div>
    </div>
</div>