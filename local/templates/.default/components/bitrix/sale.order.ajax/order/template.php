<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();  
    
    /*$user = new CUser;
    $arAuthResult = $user->Add(Array(
        "LOGIN" => $NEW_LOGIN,
        "NAME" => $NEW_NAME,
        "LAST_NAME" => $NEW_LAST_NAME,
        "PASSWORD" => $NEW_PASSWORD,
        "CONFIRM_PASSWORD" => $NEW_PASSWORD_CONFIRM,
        "EMAIL" => $NEW_EMAIL,
        "GROUP_ID" => $GROUP_ID,
        "ACTIVE" => "Y",
        "LID" => SITE_ID,
        )
    );*/
    if($USER->IsAuthorized() || $arParams["ALLOW_AUTO_REGISTER"] == "Y")
    {
        if($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y")
        {
            if(strlen($arResult["REDIRECT_URL"]) > 0)
            {
                $APPLICATION->RestartBuffer();
            ?>







            <script type="text/javascript">
                window.top.location.href='<?=CUtil::JSEscape($arResult["REDIRECT_URL"])?>';
            </script>
            <?
                die();
            }

        }
    }

    $APPLICATION->SetAdditionalCSS($templateFolder."/style_cart.css");
    $APPLICATION->SetAdditionalCSS($templateFolder."/style.css");
    
    include ('include/functions.php');
?>

<script>  

    //дополнительные функции, необходимые для работы
    function setOptions() {
           
        //валидаторы телефонных номеров
        $("#ORDER_PROP_24").inputmask("+7 (999) 999-99-99");   //для физлица
        $("#ORDER_PROP_11").inputmask("+7 (999) 999-99-99");  //для юрлица
        $("#pp_sms_phone").inputmask("+79999999999");

        
        if($('#pp_sms_phone')){
            var phoneVal = $('#ORDER_PROP_24').val() || $('#ORDER_PROP_11').val();
            $('#pp_sms_phone').val(phoneVal);
        }
        //дублируем телефон для pickpoint
        $('body').on('change', '#ORDER_PROP_24', function(){
            $('#pp_sms_phone').val($('#ORDER_PROP_24').val());
        });     
        $('body').on('change', '#ORDER_PROP_11', function(){
            $('#pp_sms_phone').val($('#ORDER_PROP_11').val());       
        });



        /*-----
        * RFI Bank tab switcher
        * ----*/
        $("body").on('click','.rfi_bank_vars li',function(){
            if(!$(this).hasClass('active_rfi_button')){
                $(".rfi_bank_vars li").removeClass('active_rfi_button');
                $(this).addClass('active_rfi_button');
                localStorage.setItem('active_rfi_button',$(this).data('rfi-payment'));
                $.post("/ajax/rfi_bank_tabs.php", {
                    rfi_bank_tab : $(this).data('rfi-payment')
                    }, function(data) {}
                );    
            }
        })


        //ограничение на количество символов в комментарии
        $("#ORDER_DESCRIPTION").keydown(function(){
            var len = $(this).val().length; 
            if (len >=300 ) {
                $(this).val( $(this).val().substr(0,300)); 
            }
        })


        //календарь
        function disableSpecificDaysAndWeekends(date) {                                                                           
            var noWeekend = $.datepicker.noWeekends(date); 
            return !noWeekend[0] ? noWeekend : [true];  
        }         
        hourfordeliv = <?=date("H");?>;
        ourday = <?=date("w");?>;    
        if (hourfordeliv > 25) {
            if (ourday == 6){   //суббота
                minDatePlus = 2;
            } else if (ourday == 0) {    //воскресение
                //minDatePlus = 1; //blackfriday
                minDatePlus = 1;
            } else if (ourday == 5) {    //пятница                                            
                minDatePlus = 3;                                               
            } else {
                if (hourfordeliv > 19 && ourday == 4) { //четверг после 18 - доставка на понедельник
                    minDatePlus = 4;
                } else {
                    minDatePlus = 1;
                }                            
            }
        } else { // Майские праздники
                                             
            if (ourday == 1) { //понедельник
                minDatePlus = 2;
            } else if (ourday == 2) { //вторник
                minDatePlus = 2;
            } else if (ourday == 3) { //среда
                minDatePlus = 2;
            } else if (ourday == 4) { //четверг
                minDatePlus = 4;
            } else if (ourday == 5) { //пятница
                minDatePlus = 4;
            } else if (ourday == 6) { //суббота
                minDatePlus = 3;
            } else if (ourday == 0) { //воскресенье
                minDatePlus = 2;
			}
        }
        //дата, выбранная по умолчанию
        var curDay = minDatePlus;
        var newDay = ourday + minDatePlus;  
        //если день доставки попадает на субботу 
        if (newDay == 6) {
            curDay = curDay + 3;
        }     
        //для физических и юридических лиц
        $("#ORDER_PROP_44, #ORDER_PROP_45").datepicker({
            minDate: minDatePlus,
            defaultDate: minDatePlus,
            maxDate: "+3w +1d",
            beforeShowDay: disableSpecificDaysAndWeekends, //blackfriday черная пятница
            dateFormat: "dd.mm.yy",
            setDate:minDatePlus   
        });           
        $("#ORDER_PROP_44, #ORDER_PROP_45").datepicker( "setDate", curDay );             
        $("#ORDER_PROP_44, #ORDER_PROP_45").inputmask("d.m.y"); 
        
         
         
         //кастомизация select
         //$('#ORDER_PROP_29, #ORDER_PROP_30').selectric();
         

    }

    $(function(){
        submitForm();
           
        setOptions();  


        // ---- RF in foreign countries delivery button
        /*
        $('body').on('change', 'input[name="ORDER_PROP_2"]', function(){  
            if ($('#ID_DELIVERY_ID_16').is(':checked')){
                $('.deliveryPriceTable').html('Идет расчёт...');
                $.post("/ajax/RFPostForForeignCountries.php", {
                    weight : parseFloat($('.order_weight').text())
                    }, function(data) {
                        //console.log(parseFloat(data));     
                        $('.deliveryPriceTable').html(parseFloat(data) + ' руб.');
                        finalSum = parseFloat($('.SumTable').html()) + parseFloat(data);
                        $('.finalSumTable').html( finalSum.toFixed(2) + ' руб.');                         
                        $("label[for=ID_DELIVERY_ID_16] b").html(parseFloat(data) + ' руб.');        
                        // --- if discount exist
                        if($('.priceWithoutDiscount')){
                            finalSumWithoutDiscount = parseFloat($('.priceWithoutDiscount').html()) + parseFloat(data);
                            $('.priceWithoutDiscount').html(finalSumWithoutDiscount.toFixed(2) + ' руб.');
                        }              
                });
            }
        });  */
    })
</script>


<div class="breadCrumpWrap">
    <div class="centerWrapper">
        <?if($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y") {?>
            <p><a href="/personal/cart/" class="afterImg">Корзина</a><a href="/personal/order/make/" class="afterImg ">Оформление</a><a href="#" class="active">Завершение</a></p>
            <? } else {?>
            <p><a href="/personal/cart/" class="afterImg">Корзина</a><a href="/personal/order/make/" class="afterImg active">Оформление</a><a href="#">Завершение</a></p>
            <?}?>
    </div>
</div>  

<?
    if ($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y") {
        $bodyClass = "finishOrdWrap";
    }
    else {
        $bodyClass = "orderBodyWrapp";
    }
?>

<div class="<?=$bodyClass?>">    


    <div class="centerWrapper">

        <?if ($arResult["USER_VALS"]["CONFIRM_ORDER"] != "Y") {?>
            <div class="helpBlock">
                <p class="text">Сложности с оформлением заказа? Свяжитесь с нами, мы вам поможем!</p>
                <p class="telephone">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include", 
                        ".default", 
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "AREA_FILE_RECURSIVE" => "Y",
                            "EDIT_TEMPLATE" => "",
                            "COMPONENT_TEMPLATE" => ".default",
                            "PATH" => "/include/telephone.php"
                        ),
                        false
                    );?></p>    
                <p class="mailAdr">shop@alpinabook.ru</p>
            </div>  

            <?}?>


        <div class="orderBody">  

            <a name="order_form"></a>

            <div id="order_form_div" class="order-checkout">
                <NOSCRIPT>
                    <div class="errortext"><?=GetMessage("SOA_NO_JS")?></div>
                </NOSCRIPT>

                <?
                    if (!function_exists("getColumnName"))
                    {
                        function getColumnName($arHeader)
                        {
                            return (strlen($arHeader["name"]) > 0) ? $arHeader["name"] : GetMessage("SALE_".$arHeader["id"]);
                        }
                    }

                    if (!function_exists("cmpBySort"))
                    {
                        function cmpBySort($array1, $array2)
                        {
                            if (!isset($array1["SORT"]) || !isset($array2["SORT"]))
                                return -1;

                            if ($array1["SORT"] > $array2["SORT"])
                                return 1;

                            if ($array1["SORT"] < $array2["SORT"])
                                return -1;

                            if ($array1["SORT"] == $array2["SORT"])
                                return 0;
                        }
                    }
                ?>

                <div class="bx_order_make">
                    <? 
                        if(!$USER->IsAuthorized() && $arParams["ALLOW_AUTO_REGISTER"] == "N")
                        {
                            if(!empty($arResult["ERROR"]))
                            {
                                foreach($arResult["ERROR"] as $v)
                                    echo ShowError($v);
                            }
                            elseif(!empty($arResult["OK_MESSAGE"]))
                            {
                                foreach($arResult["OK_MESSAGE"] as $v)
                                    echo ShowNote($v);
                            }

                            include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/auth.php");
                        }
                        else
                        {
                            if($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y")
                            {
                                if(strlen($arResult["REDIRECT_URL"]) == 0)
                                {
                                    include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/confirm.php");
                                }
                            }
                            else
                            {
                            ?>
                            <script type="text/javascript">
                                <?if(CSaleLocation::isLocationProEnabled()):?>

                                    <?
                                        // spike: for children of cities we place this prompt
                                        $city = \Bitrix\Sale\Location\TypeTable::getList(array('filter' => array('=CODE' => 'CITY'), 'select' => array('ID')))->fetch();
                                    ?>

                                    BX.saleOrderAjax.init(<?=CUtil::PhpToJSObject(array(
                                        'source' => $this->__component->getPath().'/get.php',
                                        'cityTypeId' => intval($city['ID']),
                                        'messages' => array(
                                            'otherLocation' => '--- '.GetMessage('SOA_OTHER_LOCATION'),
                                            'moreInfoLocation' => '--- '.GetMessage('SOA_NOT_SELECTED_ALT'), // spike: for children of cities we place this prompt
                                            'notFoundPrompt' => '<div class="-bx-popup-special-prompt">'.GetMessage('SOA_LOCATION_NOT_FOUND').'.<br />'.GetMessage('SOA_LOCATION_NOT_FOUND_PROMPT', array(
                                                '#ANCHOR#' => '<a href="javascript:void(0)" class="-bx-popup-set-mode-add-loc">',
                                                '#ANCHOR_END#' => '</a>'
                                            )).'</div>'
                                        )
                                    ))?>);

                                    <?endif?>

                                var BXFormPosting = false;
                                function submitForm(val)
                                {     
                                    var flag = true;
                                    // дополнительная проверка полей и вывод ошибки  
                                    if (val == "Y")
                                    {
                                        if($("#ORDER_PROP_7").size() > 0 && $('#ORDER_PROP_7').val() == ''){
                                            flag = false;
                                            $('#ORDER_PROP_7').parent("div").children(".warningMessage").show(); 
                                            // сперва получаем позицию элемента относительно документа
                                            var scrollTop = $('#ORDER_PROP_7').offset().top;
                                            $(document).scrollTop(scrollTop);
                                            document.getElementById("ORDER_PROP_7").focus();
                                        } 

                                        if($("#ORDER_PROP_6").size() > 0 && isEmail($('#ORDER_PROP_6').val()) == false){
                                            flag = false;
                                            $('#ORDER_PROP_6').parent("div").children(".warningMessage").html('Некорректно введен e-mail');
                                            $('#ORDER_PROP_6').parent("div").children(".warningMessage").show(); 
                                            var scrollTop = $('#ORDER_PROP_6').offset().top;
                                            $(document).scrollTop(scrollTop);
                                            document.getElementById("ORDER_PROP_6").focus();
                                        }

                                        if($("#ORDER_PROP_24").size() > 0 && isTelephone($('#ORDER_PROP_24').val()) == false){
                                            flag = false;
                                            $('#ORDER_PROP_24').parent("div").children(".warningMessage").show(); 
                                            var scrollTop = $('#ORDER_PROP_24').offset().top;
                                            $(document).scrollTop(scrollTop);
                                            document.getElementById("ORDER_PROP_24").focus();
                                        }
                                        if($("#ORDER_PROP_5").size() > 0 && $('#ORDER_PROP_5').val() == false){
                                            flag = false;
                                            $('#ORDER_PROP_5').parent("div").children(".warningMessage").show(); 
                                            var scrollTop = $('#ORDER_PROP_5').offset().top;
                                            $(document).scrollTop(scrollTop);
                                            document.getElementById("ORDER_PROP_5").focus();
                                        }
                                        var deliveryFlag= false;
                                        $('input[name=DELIVERY_ID]').each(function(){
                                            if($(this).prop("checked")){
                                                deliveryFlag = true;
                                            }
                                        })
                                        if(deliveryFlag == false){
                                            flag = false;
                                            $('.deliveriWarming').show();
                                        } 

                                        if($("#ORDER_PROP_7").size() > 0 && $('#ORDER_PROP_7').val() == false){
                                            flag = false;
                                            $('#ORDER_PROP_7').parent("div").children(".warningMessage").show(); 
                                        } 
                                    } 

                                    if(flag){

                                        BXFormPosting = true;
                                        if(val != 'Y')
                                            BX('confirmorder').value = 'N';

                                        var orderForm = BX('ORDER_FORM');
                                        BX.showWait();

                                        <?if(CSaleLocation::isLocationProEnabled()):?>
                                            BX.saleOrderAjax.cleanUp();
                                            <?endif?>

                                        BX.ajax.submit(orderForm, ajaxResult);

                                    }
                                    return true;
                                }
                                /*function SwitchingPersonType(val)
                                {
                                    BXFormPosting = true;
                                    if(val != 'Y')
                                        BX('confirmorder').value = 'N';

                                    var orderForm = BX('ORDER_FORM');
                                    BX.showWait();

                                    <?if(CSaleLocation::isLocationProEnabled()):?>
                                        BX.saleOrderAjax.cleanUp();
                                        <?endif?>

                                    BX.ajax.submit(orderForm, ajaxResult);
                                    return true;
                                } */
                               
                                function ajaxResult(res)
                                {   
                                    var orderForm = BX('ORDER_FORM');
                                    try
                                    {
                                        // if json came, it obviously a successfull order submit

                                        var json = JSON.parse(res);
                                        BX.closeWait();

                                        if (json.error)
                                        {
                                            BXFormPosting = false;
                                            return;
                                        }
                                        else if (json.redirect)
                                        {
                                            window.top.location.href = json.redirect;
                                        }
                                    }
                                    catch (e)
                                    {
                                        // json parse failed, so it is a simple chunk of html

                                        BXFormPosting = false;
                                        BX('order_form_content').innerHTML = res;

                                        <?if(CSaleLocation::isLocationProEnabled()):?>
                                            BX.saleOrderAjax.initDeferredControl();
                                            <?endif?>
                                    }

                                    BX.closeWait();
                                    BX.onCustomEvent(orderForm, 'onAjaxSuccess');

                                    //1. дублируем телефон в поле для пикпоинт
                                    /*if($('#pp_sms_phone')){
                                        var phoneVal = $('#ORDER_PROP_24').val() || $('#ORDER_PROP_11').val();
                                        $('#pp_sms_phone').val(phoneVal);
                                    }*/
                                    
                                    //доп функции/////////////////////////////////
                                    setOptions();
                                    


                                    //2. подсветка варианта оплаты для электронных платежей 
                                    if(localStorage.getItem('active_rfi_button')){
                                        $('li[data-rfi-payment="'+localStorage.getItem('active_rfi_button')+'"]').addClass('active_rfi_button');
                                    }

                                    //3. международная доставка почтой России
                                    /*
                                    $('input:checked').each(function(){
                                        if($(this).attr('id')=='ID_DELIVERY_ID_16'){// ---- RF post foreign countries
                                            $('.deliveryPriceTable').html('Идет расчёт...');
                                            $.post("/ajax/RFPostForForeignCountries.php", {
                                                weight : parseFloat($('.order_weight').text())
                                                }, function(data) {
                                                    //console.log(parseFloat(data));     
                                                    $('.deliveryPriceTable').html(parseFloat(data) + ' руб.');
                                                    finalSum = parseFloat($('.SumTable').html()) + parseFloat(data);
                                                    $('.finalSumTable').html( finalSum.toFixed(2) + ' руб.');                         
                                                    $("label[for=ID_DELIVERY_ID_16] b").html(parseFloat(data) + ' руб.');   
                                                    // --- if discount exist
                                                    if($('.priceWithoutDiscount')){
                                                        finalSumWithoutDiscount = parseFloat($('.priceWithoutDiscount').html()) + parseFloat(data);
                                                        $('.priceWithoutDiscount').html(finalSumWithoutDiscount.toFixed(2) + ' руб.');
                                                    }              
                                            });
                                        } 
                                    }); */
                                    
                                    
                                }

                                function SetContact(profileId)
                                {
                                    BX("profile_change").value = "Y";
                                    submitForm();
                                }
                            </script>
                            <?if($_POST["is_ajax_post"] != "Y")
                                {
                                ?><form action="<?=$APPLICATION->GetCurPage();?>" method="POST" name="ORDER_FORM" id="ORDER_FORM" enctype="multipart/form-data">
                                    <?=bitrix_sessid_post()?>
                                    <div id="order_form_content">
                                        <?
                                        }
                                        else
                                        {
                                            $APPLICATION->RestartBuffer();
                                        }

                                        if($_REQUEST['PERMANENT_MODE_STEPS'] == 1)
                                        {
                                        ?>
                                        <input type="hidden" name="PERMANENT_MODE_STEPS" value="1" />
                                        <?
                                        }

                                        if(!empty($arResult["ERROR"]) && $arResult["USER_VALS"]["FINAL_STEP"] == "Y")
                                        {   
                                            foreach($arResult["ERROR"] as $v)
                                                echo ShowError($v);
                                        ?>
                                        <script type="text/javascript">
                                            top.BX.scrollToNode(top.BX('ORDER_FORM'));
                                        </script>
                                        <?
                                            echo "<br>";
                                        }

                                        include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props_format.php");     
                                        include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/person_type.php");
                                    ?>

                                    <p class="blockTitle">Местоположение</p>
                                    <p class="blockText">Выберите страну и город. В зависимости от выбора Вашего местоположения Вам будут предложены способы доставки и самовывоза.</p>
                                    <br>
                                    <?//блок с местоположением
                                        if ($arResult["ORDER_PROP"]["USER_PROPS_Y"][2]) {
                                            $location[] = ($arResult["ORDER_PROP"]["USER_PROPS_Y"][2]);
                                        } else {
                                            $location[] = ($arResult["ORDER_PROP"]["USER_PROPS_Y"][3]); 
                                        }

                                        PrintPropsForm($location, $arParams["TEMPLATE_LOCATION"]);
                                    ?>

                                    <?
                                        if ($arParams["DELIVERY_TO_PAYSYSTEM"] == "p2d")
                                        {
                                            include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/paysystem.php");
                                            include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery.php");
                                        }
                                        else
                                        {
                                            include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery.php");
                                            include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/paysystem.php");
                                        }

                                        include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props.php");

                                        include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/related_props.php");

                                        include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/summary.php");
                                        if(strlen($arResult["PREPAY_ADIT_FIELDS"]) > 0)
                                            echo $arResult["PREPAY_ADIT_FIELDS"];
                                    ?>

                                    <?if($_POST["is_ajax_post"] != "Y")
                                        {
                                        ?>
                                    </div>
                                    <input type="hidden" name="confirmorder" id="confirmorder" value="Y">
                                    <input type="hidden" name="profile_change" id="profile_change" value="N">
                                    <input type="hidden" name="is_ajax_post" id="is_ajax_post" value="Y">
                                    <input type="hidden" name="json" value="Y">

                                </form>
                                <?
                                    if($arParams["DELIVERY_NO_AJAX"] == "N")
                                    {
                                    ?>
                                    <div style="display:none;"><?$APPLICATION->IncludeComponent("bitrix:sale.ajax.delivery.calculator", "", array(), null, array('HIDE_ICONS' => 'Y')); ?></div>
                                    <?
                                    }
                                }
                                else
                                {
                                ?>
                                <script type="text/javascript">
                                    top.BX('confirmorder').value = 'Y';
                                    top.BX('profile_change').value = 'N';
                                </script>
                                <?
                                    die();
                                }  
                            }
                        }
                    ?>
                </div>
            </div>

        </div>

        <?if(CSaleLocation::isLocationProEnabled()):?>

            <div style="display: none">
                <?// we need to have all styles for sale.location.selector.steps, but RestartBuffer() cuts off document head with styles in it?>
                <?$APPLICATION->IncludeComponent(
                        "bitrix:sale.location.selector.steps", 
                        ".default", 
                        array(
                        ),
                        false
                    );?>
                <?$APPLICATION->IncludeComponent(
                        "bitrix:sale.location.selector.search", 
                        ".default", 
                        array(
                        ),
                        false
                    );?>
            </div>

            <?endif?>
    </div>
</div>