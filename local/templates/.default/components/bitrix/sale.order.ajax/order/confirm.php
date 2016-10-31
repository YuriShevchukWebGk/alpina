<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
    if ($_REQUEST["ORDER_ID"])
    {?>
    <style>
        .orderBody {
            background-color: #f4f4f4;
        }
    </style>
    <?}?>

<?
    if (!empty($arResult["ORDER"]))
    {
    ?>
    <?
        //получаем значение свойств из заказа
        $orderProps = CSaleOrderPropsValue::GetList(array(),array("ORDER_ID"=>$arResult["ORDER"]["ID"]), false, false, array());
        while ($arOrderProps = $orderProps->Fetch()) {
            $arResult["ORDER_PROPS"][$arOrderProps["CODE"]] = $arOrderProps;
        }
        if ($arResult["ORDER_PROPS"]["F_CONTACT_PERSON"]["VALUE"]) {
            $userName = $arResult["ORDER_PROPS"]["F_CONTACT_PERSON"]["VALUE"]; //для физлица
        }
        else {
            $userName = $arResult["ORDER_PROPS"]["F_COMPANY_NAME"]["VALUE"]; //для юрлица
        }
    ?>
    <?
        $arName = explode( " ", $userName);
        if (count($arName)==2) {
            $name=$arName[0];
            $last_name=$arName[1];
        } else {
            $name=$arName[0];
            $last_name=$arResult["ORDER"]["USER_LAST_NAME"];
        }
    ?>
    <?
        foreach ($_SESSION["CATALOG_USER_COUPONS"] as $coupon) {
            $couponStr.=$coupon;
            if (count($_SESSION["CATALOG_USER_COUPONS"])>1) {
                $couponStr.=', ';
            }
        }
    ?>
    <script type="text/javascript">
        // формирование сервиса  Get4Click
        var _iPromoBannerObj = function() {
            this.htmlElementId = 'promocode-element-container';
            this.params = {
                '_shopId': '306',
                '_bannerId': '472',
                '_customerFirstName': '<?=$name?>',
                '_customerLastName': '<?=$last_name?>',
                '_customerEmail': '<?=$arResult["ORDER_PROPS"]["EMAIL"]["VALUE"]?>',
                '_customerPhone': '<?=$arResult["ORDER_PROPS"]["PHONE"]["VALUE"]?>',
                /*  '_customerGender': 'CUSTOMER_GENDER',  */
                '_orderId': '<?=$arResult["ORDER"]["ID"]?>',
                '_orderValue': '<?=$arResult["ORDER"]["PRICE"]?>',
                '_orderCurrency': 'RUB',
                '_usedPromoCode': '<?=$couponStr?>'
            };

            this.lS=function(s){document.write('<sc'+'ript type="text/javascript" src="'+s+'" async="true"></scr'+'ipt>');},
            this.gc=function(){return document.getElementById(this.htmlElementId);};
            var r=[];for(e in this.params){if(typeof(e)==='string'){r.push(e+'='+encodeURIComponent(this.params[e]));}}r.push('method=main');r.push('jsc=iPromoCpnObj');this.lS(('https:'==document.location.protocol ? 'https://':'http://')+'get4click.ru/wrapper.php?'+r.join('&'));};

        var iPromoCpnObj = new _iPromoBannerObj();
    </script>

    <?if (!empty($_SESSION['googleECommerce'])) {?>
        <!--Criteo-->
        <script type="text/javascript" src="//static.criteo.net/js/ld/ld.js" async="true"></script>
        <script type="text/javascript">
            window.criteo_q = window.criteo_q || [];
            window.criteo_q.push(
                { event: "setAccount", account: 18519 },
                <?if($USER->IsAuthorized()){?>
                    { event: "setEmail", email: "<?=$USER->GetEmail()?>" },
                    <?}?>
                { event: "setSiteType", type: "d" },
                { event: "trackTransaction", id: <?=$arResult["ORDER"]["ID"]?>, item: <?=$_SESSION['criteo']?>}
            );
        </script>

        <!--google eCommerce-->
        <?/* Enhanced Ecommerce новый код 2016.05.23 для поля category и coupon */?>
        <script>

            dataLayer.push({
                'ecommerce': {
                    'purchase': {
                        'actionField': {
                            'id': '<?=$arResult["ORDER"]["ID"]?>',                         // Transaction ID. Required for purchases and refunds.
                            'affiliation': 'Alpinabook',
                            'revenue': '<?=$arResult['ORDER']['PRICE']?>',                     // Total transaction value (incl. tax and shipping)
                            'tax':'<?=$arResult['ORDER']['TAX_VALUE']?>',
                            'shipping': '<?=$arResult['ORDER']['PRICE_DELIVERY']?>',
                            'coupon': '<?=$couponStr?>'
                        },
                        'products': [
                            <?foreach($_SESSION['googleEnhancedECommerce'] as $googleEnhancedECommerce){?>
                                {
                                    <?=$googleEnhancedECommerce?>
                                },
                                <?}?>
                        ]
                    }
                },
                'discountPerc': '<?=$_SESSION['EMAIL_DISCOUNT_PERCENT_MED']?>',
                'discountRUB': '<?=substr($_SESSION['EMAIL_DISCOUNT_SUM_TOTAL'],0,-5)?>'
            });
        </script>
        <?/* Старый код google ecommerce ?>
            <script>
            dataLayer.push({
            'transactionId': '<?=$arResult["ORDER"]["ID"]?>',
            'transactionAffiliation': 'Alpinabook',
            'transactionTotal': '<?=$arResult['ORDER']['PRICE']?>',
            'transactionTax': '<?=$arResult['ORDER']['TAX_VALUE']?>',
            'transactionShipping': '<?=$arResult['ORDER']['PRICE_DELIVERY']?>',
            'transactionProducts': [
            <?foreach($_SESSION['googleECommerce'] as $googleItem){?>
            {
            <?=$googleItem?>
            },
            <?}?>
            ]
            });

            </script>
        <?*/?>
        <?  //получаем email из заказа. у физлиц будет EMAIL, у юрлиц F_EMAIL
            $orderProps = CSaleOrderPropsValue::GetList(array(),array("ORDER_ID"=>$arResult["ORDER_ID"],"CODE"=>array("EMAIL","F_EMAIL")),false,false,array());
            while($arProp = $orderProps->Fetch()) {
                $userEmal = $arProp["VALUE"];
            }
        ?>
        <script type="text/javascript">
            rrApiOnReady.push(function() {
                try {
                    rrApi.order({
                        transaction: <?=$arResult["ORDER"]["ID"]?>,
                        items: <?=$_SESSION['retailRocket']?>
                    });
                } catch(e) {}
            });
            rrApiOnReady.push(function () { rrApi.setEmail("<?=$userEmal?>"); });
        </script>

        <!-- Facebook Conversion Code for Оформление заказов - Альпина 1 -->
        <script>(function() {
                var _fbq = window._fbq || (window._fbq = []);
                if (!_fbq.loaded) {
                    var fbds = document.createElement('script');
                    fbds.async = true;
                    fbds.src = '//connect.facebook.net/en_US/fbds.js';
                    var s = document.getElementsByTagName('script')[0];
                    s.parentNode.insertBefore(fbds, s);
                    _fbq.loaded = true;
                }
            })();
            window._fbq = window._fbq || [];
            window._fbq.push(['track', '6027030777492', {'value':'<?=$arResult['ORDER']['PRICE']?>','currency':'RUB'}]);
        </script>
        <noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6027030777492&amp;cd[value]=<?=$arResult['ORDER']['PRICE']?>&amp;cd[currency]=RUB&amp;noscript=1" /></noscript>

        <script type="text/javascript">
            window.flocktory = window.flocktory || [];
            window.flocktory.push(['postcheckout', {
                user: {
                    name: '<?=$userName?>',
                    email: '<?=$USER->GetEmail()?>',
                },
                order: {
                    id: '<?=$arResult["ORDER"]["ID"]?>',
                    price: <?=$arResult["ORDER"]["PRICE"]?>,
                    items: <?=$_SESSION['floctory']?>
                },
            }]);
        </script>

        <?unset($_SESSION['socioMatic'])?>
        <?unset($_SESSION['criteo'])?>
        <?unset($_SESSION['googleECommerce'])?>
        <?unset($_SESSION['googleEnhancedECommerce'])?>
        <?unset($_SESSION['floctory'])?>
        <?unset($_SESSION['retailRocket'])?>

        <?}?>



    <div class="confirmWrapper">
        <div class="finishOrdWrap">
            <div class="centerWrapper">
                <div class="rightBlockWrap">
                    <p class="blockTitle">Уважаемый клиент!</p>
                    <p class="blokText">В качестве благодарности за покупку вам предоставляется возможность выбрать один из подарков наших партнеров.</p>
                    <p class="giftCont"><a href="#">Получить подарок</a></p>
                </div>

                <div class="mainInfoWrap">
                    <p class="ordTitle">Заказ №<?=$arResult["ORDER"]["ACCOUNT_NUMBER"]?> сформирован</p>
                    <p class="OrdAkses">Ваш заказ №<?=$arResult["ORDER"]["ACCOUNT_NUMBER"]?> от <?=$arResult["ORDER"]["DATE_INSERT"]?> успешно создан.</p>
                    <p class="ordHint">Вы можете следить за выполнением заказа в <a href="/personal/order/">Личном кабинете.</a> Обратите внимание, что для входа в этот раздел, вам необходимо будет ввести логин и пароль</p>
                </div>
            </div>
        </div>

        <?
            if (!empty($arResult["PAY_SYSTEM"]))
            {
            ?>
            <br /><br />
            <div id="promocode-element-container"></div>
            <? if ($arResult["PAY_SYSTEM"]["ID"] != 1 && $arResult["PAY_SYSTEM"]["ID"] != 12) { ?>
                <table class="sale_order_full_table" >
                    <tr <? /*if ($arResult["PAY_SYSTEM"]["ID"] == RFI_PAYSYSTEM_ID && $_SESSION['rfi_recurrent_type'] == "next" && $_SESSION['rfi_bank_tab'] == "spg" && $arResult["UF_RECURRENT_ID"]) { ?> style="display: none" <? }*/ ?>>
                        <? if ($arResult["PAY_SYSTEM"]["ID"] != RFI_PAYSYSTEM_ID) { ?>
                            <td class="ps_logo">
                                <div class="pay_name"><?=GetMessage("SOA_TEMPL_PAY")?></div>
                                <?if($arResult["PAY_SYSTEM"]["ID"] == PAYPAL_PAYSYSTEM_ID){?>
                                    <div class = "PayPal_button">
                                        <?
                                            $service = \Bitrix\Sale\PaySystem\Manager::getObjectById($arResult["ORDER"]['PAY_SYSTEM_ID']);

                                            if ($arResult["PAY_SYSTEM"]["NEW_WINDOW"] == "Y")
                                            {
                                            ?>
                                            <script language="JavaScript">
                                                window.open('<?=$arParams["PATH_TO_PAYMENT"]?>?ORDER_ID=<?=urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))?>&PAYMENT_ID=<?=$arResult['ORDER']["PAYMENT_ID"]?>');
                                            </script>
                                            <?= GetMessage("SOA_TEMPL_PAY_LINK", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))."&PAYMENT_ID=".$arResult['ORDER']["PAYMENT_ID"]))?>
                                            <?
                                                if (CSalePdf::isPdfAvailable() && $service->isAffordPdf())
                                                {
                                                ?><br />
                                                <?= GetMessage("SOA_TEMPL_PAY_PDF", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))."&PAYMENT_ID=".$arResult['ORDER']["PAYMENT_ID"]."&pdf=1&DOWNLOAD=Y")) ?>
                                                <?
                                                }
                                            }
                                            else
                                            {
                                                if ($service)
                                                {
                                                    /** @var \Bitrix\Sale\Order $order */
                                                    $order = \Bitrix\Sale\Order::load($arResult["ORDER_ID"]);

                                                    /** @var \Bitrix\Sale\PaymentCollection $paymentCollection */
                                                    $paymentCollection = $order->getPaymentCollection();

                                                    /** @var \Bitrix\Sale\Payment $payment */
                                                    foreach ($paymentCollection as $payment)
                                                    {
                                                        if (!$payment->isInner())
                                                        {
                                                            $context = \Bitrix\Main\Application::getInstance()->getContext();
                                                            $service->initiatePay($payment, $context->getRequest());
                                                            break;
                                                        }
                                                    }
                                                }
                                                else
                                                {
                                                    echo '<span style="color:red;">'.GetMessage("SOA_TEMPL_ORDER_PS_ERROR").'</span>';
                                                }
                                            }
                                        ?>
                                    </div>
                                    <?} else {?>
                                    <?=CFile::ShowImage($arResult["PAY_SYSTEM"]["LOGOTIP"], 100, 100, "border=0", "", false);?>
                                    <div class="paysystem_name"><?= $arResult["PAY_SYSTEM"]["NAME"] ?></div><br>    
                                    <?}?>                                
                            </td>
                            <td>
                                <? if ($arResult["PAY_SYSTEM"]["ID"] == "13")
                                    {?>
                                    <?= $arResult["PAY_SYSTEM"]["BUFFERED_OUTPUT"]?>
                                    <?}?>
                            </td>
                            <? } else { ?>
                            <td colspan="2">
                                <? if ($arResult["PAY_SYSTEM"]["ID"] == "13")
                                    {?>
                                    <?= $arResult["PAY_SYSTEM"]["BUFFERED_OUTPUT"]?>
                                    <?}?>
                            </td>
                            <? } ?>
                    </tr>
                    <?
                        if (strlen($arResult["PAY_SYSTEM"]["ACTION_FILE"]) > 0)
                        {
                        ?>
                        <tr>
                            <td>
                                <span style="color: #627478;font-family: 'Walshein_regular';"><?=GetMessage("DIGITAL_BOOK")?></span>
                                <br />
                                <span <?if($arResult["PAY_SYSTEM"]["ID"] == PAYPAL_PAYSYSTEM_ID) echo "style='display:none'"?>>
                                <?
                                    $service = \Bitrix\Sale\PaySystem\Manager::getObjectById($arResult["ORDER"]['PAY_SYSTEM_ID']);

                                    if ($arResult["PAY_SYSTEM"]["NEW_WINDOW"] == "Y")
                                    {
                                    ?>
                                    <script language="JavaScript">
                                        window.open('<?=$arParams["PATH_TO_PAYMENT"]?>?ORDER_ID=<?=urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))?>&PAYMENT_ID=<?=$arResult['ORDER']["PAYMENT_ID"]?>');
                                    </script>
                                    <?= GetMessage("SOA_TEMPL_PAY_LINK", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))."&PAYMENT_ID=".$arResult['ORDER']["PAYMENT_ID"]))?>
                                    <?
                                        if (CSalePdf::isPdfAvailable() && $service->isAffordPdf())
                                        {
                                        ?><br />
                                        <?= GetMessage("SOA_TEMPL_PAY_PDF", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))."&PAYMENT_ID=".$arResult['ORDER']["PAYMENT_ID"]."&pdf=1&DOWNLOAD=Y")) ?>
                                        <?
                                        }
                                    }
                                    else
                                    {
                                        if ($service)
                                        {
                                            /** @var \Bitrix\Sale\Order $order */
                                            $order = \Bitrix\Sale\Order::load($arResult["ORDER_ID"]);

                                            /** @var \Bitrix\Sale\PaymentCollection $paymentCollection */
                                            $paymentCollection = $order->getPaymentCollection();

                                            /** @var \Bitrix\Sale\Payment $payment */
                                            foreach ($paymentCollection as $payment)
                                            {
                                                if (!$payment->isInner())
                                                {
                                                    $context = \Bitrix\Main\Application::getInstance()->getContext();
                                                    $service->initiatePay($payment, $context->getRequest());
                                                    break;
                                                }
                                            }
                                        }
                                        else
                                        {
                                            echo '<span style="color:red;">'.GetMessage("SOA_TEMPL_ORDER_PS_ERROR").'</span>';
                                        }
                                    }
                                ?>


                            </td>
                            <td>
                            </td>
                        </tr>
                        <?
                        }
                    ?>
                </table>
                </span>
                <? } elseif ($arResult["PAY_SYSTEM"]["ID"] == CASHLESS_PAYSYSTEM_ID && $arResult["ORDER"]["PERSON_TYPE_ID"] != LEGAL_ENTITY_PERSON_TYPE_ID) {
                    echo '<span style="font-size:18px;color:#424d4f">'.GetMessage("WAIT_FOR_BILL").'</span>';
                }?>
                <br>
                <?
                if ($arResult["PAY_SYSTEM"]["ID"] == CASHLESS_PAYSYSTEM_ID && $arResult["ORDER"]["PERSON_TYPE_ID"] == LEGAL_ENTITY_PERSON_TYPE_ID) {
                    $order_info = CSaleOrder::GetByID($arResult["ORDER"]["ID"]);
                    $order_props = CSaleOrderPropsValue::GetOrderProps($arResult["ORDER"]["ID"]);
                    while ($props = $order_props -> Fetch()) {
                        if ($props["CODE"] == "F_COMPANY_NAME") {
                            $company_name = $props["VALUE"];
                        }
                        if ($props["CODE"] == "F_INN") {
                            $company_inn = $props["VALUE"];
                        }
                        if ($props["CODE"] == "F_KPP") {
                            $company_kpp = $props["VALUE"];
                        }
                        if ($props["CODE"] == "F_ADDRESS_FULL") {
                            $address = $props["VALUE"];
                        }
                        if ($props["CODE"] == "F_PHONE") {
                            $phone = $props["VALUE"];
                        } 
                    }?>
                    <div class="expense_offer_block">
                        <div style="text-align: center"><?= GetMessage("BLANK_TITLE") ?></div><br>
                        <table class="receiver_block">
                            <tr>
                                <td rowspan="2" colspan="4"><div><?= GetMessage("RECEIVER_BANK_NAME") ?></div><span><?= GetMessage("RECEIVER_BANK_NAME_TITLE") ?></span></td>
                                <td><?= GetMessage("BIK_TITLE") ?></td>
                                <td><?= GetMessage("BIK") ?></td>
                            </tr>
                            <tr>
                                <td><?= GetMessage("ACCOUNT_NUMBER_TITLE") ?></td>
                                <td><?= GetMessage("ACCOUNT_BANK_NUMBER") ?></td>
                            </tr>
                            <tr>
                                <td><?= GetMessage("INN_TITLE") ?></td>
                                <td><?= GetMessage("INN") ?></td>
                                <td><?= GetMessage("KPP_TITLE") ?></td>
                                <td><?= GetMessage("KPP") ?></td>
                                <td rowspan="2"><?= GetMessage("ACCOUNT_NUMBER_TITLE") ?></td>
                                <td rowspan="2"><?= GetMessage("ACCOUNT_NUMBER") ?></td>
                            </tr>
                            <tr>
                                <td colspan="4"><div><?= GetMessage("RECEIVER") ?></div><span><?= GetMessage("RECEIVER_TITLE") ?></span></td>
                            </tr>
                        </table>
                        <br>
                        <div class="order_doc_title"><?= GetMessage("BLANK_NUMBER_TITLE") ?> <?= $arResult["ORDER"]["ID"] ?> <?= GetMessage("FROM_DATE") ?> <?= FormatDate("j F", MakeTimeStamp(date("d.m.Y", strtotime($order_info["DATE_INSERT"])), "DD.MM.YYYY HH:MI:SS")) ?></div>
                        <br>
                        <table class="order_company_info">
                            <tr>
                                <td><?= GetMessage("PROVIDER_TITLE") ?></td>
                                <td>Общество с ограниченной ответственностью "Альпина Паблишер", ИНН 7705396957, КПП 770501001, 115035, Москва г, Космодамианская наб, дом № 4/22, корпус Б, оф.ПОМ. IX,  КОМН.1, тел.: (495) 980-53-54</td>
                            </tr>
                        </table>
                        <br>
                        <table class="order_company_info">
                            <tr>
                                <td><?= GetMessage("CONSIGNOR_TITLE") ?></td>
                                <td>Общество с ограниченной ответственностью "Альпина Паблишер", ИНН 7705396957, КПП 770501001, 115035, Москва г, Космодамианская наб, дом № 4/22, корпус Б, оф.ПОМ. IX,  КОМН.1, тел.: (495) 980-53-54</td>
                            </tr>
                        </table>
                        <br> 
                        <table class="order_company_info">
                            <tr>
                                <td><?= GetMessage("BUYER_TITLE") ?></td>
                                <td><?= $company_name ?>, ИНН <?= $company_inn ?>, КПП <?= $company_kpp ?>, <?= $address ?>, тел.: <?= $phone ?></td>
                            </tr>
                        </table>
                        <br> 
                        <table class="order_company_info">
                            <tr>
                                <td><?= GetMessage("CONSIGNEE_TITLE") ?></td>
                                <td><?= $company_name ?>, <?= GetMessage("INN_TITLE") ?> <?= $company_inn ?>, <?= GetMessage("KPP_TITLE") ?> <?= $company_kpp ?>, <?= $address ?>, <?= GetMessage("PHONE_TITLE") ?> <?= $phone ?></td>
                            </tr>
                        </table>
                        <br>
                        <table class="basket_list">
                            <tr>
                                <th><?= GetMessage("NUMBER") ?></th>
                                <th><?= GetMessage("ITEMS") ?></th>
                                <th><?= GetMessage("QUANTITY") ?></th>
                                <th><?= GetMessage("QUANTITY_MEASURE") ?></th>
                                <th><?= GetMessage("PRICE") ?></th>
                                <th><?= GetMessage("VAT_RATE") ?></th>
                                <th><?= GetMessage("VAT") ?></th>
                                <th><?= GetMessage("SUMMARY") ?></th>
                            </tr>
                            <? $count = 1;
                            $vat_rate = 0;
                            $arResult["ORDER"]["VAT_RATE_10_SUMM"] = 0;
                            $arResult["ORDER"]["VAT_RATE_18_SUMM"] = 0;
                            $basket_list = CSaleBasket::GetList (array(), array("ORDER_ID" => $arResult["ORDER"]["ID"]), false, false, array());
                            while ($basket = $basket_list -> Fetch()) {
                               if ($basket["VAT_RATE"] * 10 <= 1) {
                                   $multiplier = 0.0909;
                                   $arResult["ORDER"]["VAT_RATE_10_SUMM"] += round($basket["PRICE"] * $basket["QUANTITY"] * $multiplier, 2);
                               } else {
                                   $multiplier = 0.1525;
                                   $arResult["ORDER"]["VAT_RATE_18_SUMM"] += round($basket["PRICE"] * $basket["QUANTITY"] * $multiplier, 2);
                               }?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td><?= $basket["NAME"] ?></td>
                                    <td><?= $basket["QUANTITY"] ?></td>
                                    <td>шт.</td>
                                    <td><?= round($basket["PRICE"], 2) ?></td>
                                    <td><?= round($basket["VAT_RATE"] * 100) . "%" ?></td>
                                    <td><?= round($basket["PRICE"] * $basket["QUANTITY"] * $multiplier, 2) ?></td>
                                    <td><?= round($basket["PRICE"] * $basket["QUANTITY"], 2) ?></td>
                                </tr>
                            <? $count++;
                            $vat_rate = $basket["VAT_RATE"] * 100;
                            }
                            ?>
                        </table>
                        <br>
                        <table class="basket_summary">
                            <tr>
                                <td><?= GetMessage("VAT_TEXT") ?></td>
                                <td><?= GetMessage("PRICE_VALUE") ?></td>
                                <td><?= round($arResult["ORDER"]["PRICE"] - $arResult["ORDER"]["PRICE_DELIVERY"], 2) ?></td>
                            </tr>
                            <? if ($arResult["ORDER"]["VAT_RATE_10_SUMM"] > 0) {?>
                                <tr>
                                    <td></td>
                                    <td><?= GetMessage("INCLUDING_VAT_10") ?></td>
                                    <td><?= round($arResult["ORDER"]["VAT_RATE_10_SUMM"], 2) ?></td>
                                </tr>
                            <? } ?>
                            <? if ($arResult["ORDER"]["VAT_RATE_18_SUMM"] > 0) {?>
                                <tr>
                                    <td></td>
                                    <td><?= GetMessage("INCLUDING_VAT_18") ?></td>
                                    <td><?= round($arResult["ORDER"]["VAT_RATE_18_SUMM"], 2) ?></td>
                                </tr>
                            <? } ?>
                            <tr>
                                <td></td>
                                <td><?= GetMessage("TOTAL_TO_PAY") ?></td>
                                <td><?= round($arResult["ORDER"]["PRICE"] - $arResult["ORDER"]["PRICE_DELIVERY"], 2) ?></td>
                            </tr>
                        </table>
                        <div class="additional_info">
                           <?= GetMessage("ADDITIONAL_INFO") ?>
                        </div><br>
                        <span><?= GetMessage("TOTAL_ITEMS") . round($arResult["ORDER"]["PRICE"] - $arResult["ORDER"]["PRICE_DELIVERY"], 2) . GetMessage("ROUBLES") ?></span><br>
                        <span class="price_string"><?= num2str(round($arResult["ORDER"]["PRICE"] - $arResult["ORDER"]["PRICE_DELIVERY"], 2)) ?></span>
                        <div class="quotes_block">
                            <table>
                                <tr>
                                    <td><?= GetMessage("HEAD") ?></td>
                                    <td><?= GetMessage("CEO") ?><br><div><?= GetMessage("POSITION") ?></div></td>
                                    <td><br><div><?= GetMessage("QUOTE") ?></div></td>
                                    <td><?= GetMessage("CEO_NAME") ?><br><div><?= GetMessage("QUOTE_TRANSCRIPT") ?></div></td>
                                </tr>
                                <tr>
                                    <td><?= GetMessage("ACCOUNTANT") ?></td>
                                    <td></td>
                                    <td><br><div><?= GetMessage("QUOTE") ?></div></td>
                                    <td><?= GetMessage("ACCOUNTANT_NAME") ?><br><div><?= GetMessage("QUOTE_TRANSCRIPT") ?></div></td>
                                </tr>
                            </table>
                        </div>
                  </div>     
                <?}
        }?>

    </div>

    <? }
    else
    {
    ?>
    <b><?=GetMessage("SOA_TEMPL_ERROR_ORDER")?></b><br /><br />

    <table class="sale_order_full_table">
        <tr>
            <td>
                <?=GetMessage("SOA_TEMPL_ERROR_ORDER_LOST", Array("#ORDER_ID#" => $arResult["ACCOUNT_NUMBER"]))?>
                <?=GetMessage("SOA_TEMPL_ERROR_ORDER_LOST1")?>
            </td>
        </tr>
    </table>
    <?
    }
?>

<script>
    $(function(){
        var result = $(".confirmWrapper").html();
        $(".orderBody").parent().html(result);
    })
</script>