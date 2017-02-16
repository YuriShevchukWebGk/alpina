<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

    if($USER->IsAuthorized() || $arParams["ALLOW_AUTO_REGISTER"] == "Y")
    {
        if($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y")
        {
            if(strlen($arResult["REDIRECT_URL"]) > 0)
            {
                $APPLICATION->RestartBuffer(); ?>
            <script type="text/javascript">
                window.top.location.href='<?=CUtil::JSEscape($arResult["REDIRECT_URL"])?>';
            </script>
            <? die();
            }
        }
    }

    $APPLICATION->SetAdditionalCSS($templateFolder."/style_cart.css");
    $APPLICATION->SetAdditionalCSS($templateFolder."/style.css");
    $APPLICATION->AddHeadString('<script type="text/javascript" src="/flippost/flippost.js"></script>');    
    $APPLICATION->AddHeadString('<script type="text/javascript" src="https://points.boxberry.de/js/boxberry.js"></script>'); 
	// доставка гуру
	$APPLICATION->AddHeadScript($templateFolder . "/include/guru/js/collection-search-provider.js");
	//$APPLICATION->AddHeadString('<script src="http://api.dostavka.guru/client/collection-search-provider.js"></script>');
	$APPLICATION->AddHeadString('<script src="https://api-maps.yandex.ru/2.1/?load=package.standard,package.geoObjects&lang=ru-RU" type="text/javascript"></script>');
	$APPLICATION->SetAdditionalCSS($templateFolder . "/include/guru/css/guru.css");
	$APPLICATION->AddHeadScript($templateFolder . "/include/guru/js/guru.js");

    $window = strpos($_SERVER['HTTP_USER_AGENT'],"Windows");
    include ('include/functions.php');
?>

<style>
    /* Лучше так, чем городить адовые городушки на js */
    input#ID_DELIVERY_ID_<?= FLIPPOST_ID ?>:checked ~ div.flippostSelectContainer {
        display: block;
    }
    
    input#ID_DELIVERY_ID_<?= GURU_DELIVERY_ID ?>:checked ~ div.guru_delivery_wrapper {
        display: block;
    } 
       
    input#ID_DELIVERY_ID_<?= BOXBERRY_PICKUP_DELIVERY_ID ?>:checked ~ div.boxberry_delivery_wrapper {
        display: block;
    }  
    
	#order_form_div .location-block-wrapper {
		max-width: 100%;
	}

	.bx-slst .quick-location-tag:before {
	    content: url(/img/beforeInputRadio.png);
		left: -8px;
		position: relative;
		top: 7px;
	}
	.bx-slst .quick-location-tag {
		background:#fff!important;
		border:0;
		font-size:16px;
		padding: 0 48px 0 0 !important;
	}
	.addCircle:before {
		content: url(/img/chekedInpRadio.png)!important;
	}
	.rfi_bank_vars {
		display:none;
	}

</style>


<script>
	window.THIS_TEMPLATE_PATH = '<?= $templateFolder ?>';
	window.GURU_DELIVERY_ID = '<?= GURU_DELIVERY_ID ?>';
    window.BOXBERRY_PICKUP_DELIVERY_ID = '<?= BOXBERRY_PICKUP_DELIVERY_ID ?>';
    //дополнительные функции, необходимые для работы
    function setOptions() {

        if ($.browser.msie && $.browser.version <= 9) {

        } else {

                $("#ORDER_PROP_24").mask("+9(999)999-99-999");   //для физлица
                $("#ORDER_PROP_11").mask("+7(999)999-99-99");  //для юрлица
                $("#pp_sms_phone").mask("+79999999999");
        }


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
                if ($(this).data('rfi-payment') == "spg") {
                    $(".recurrent_tabs").show();
                } else {
                    $(".recurrent_tabs").hide();
                }
                $(".rfi_bank_vars li").removeClass('active_rfi_button');
                $(this).addClass('active_rfi_button');
                localStorage.setItem('active_rfi_button',$(this).data('rfi-payment'));
                $.post("/ajax/rfi_bank_tabs.php", {
                    rfi_bank_tab : $(this).data('rfi-payment')
                    }, function(data) {}
                );
            }
        })

        $("body").on('click','.recurrent_tabs li:not(:last-child)',function(){
            if(!$(this).hasClass('active_recurrent_tab')){
                $(".recurrent_tabs li").removeClass('active_recurrent_tab');
                $(this).addClass('active_recurrent_tab');
                localStorage.getItem('active_rfi_recurrent');
                localStorage.setItem('active_rfi_recurrent', $(this).data('rfi-recurrent-type'));
                $.post("/ajax/rfi_recurrent.php", {
                    rfi_recurrent_type : $(this).data('rfi-recurrent-type')
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
		var disabledDates = ['01/01/2017','01/02/2017','01/03/2017','01/04/2017','01/05/2017','01/06/2017']; //даты для отключения mm/dd/yyyy
        function disableSpecificDaysAndWeekends(date) {
            var noWeekend = $.datepicker.noWeekends(date);
			if (noWeekend[0]) {
				return editDays(date);
			} else {
				return noWeekend;
			}
        }
		function editDays(date) {
			for (var i = 0; i < disabledDates.length; i++) {
				if (new Date(disabledDates[i]).toString() == date.toString()) {
					 return [false];
				}
			}
			return [true];
		}

        hourfordeliv = <?=date("H");?>;
        ourday = <?=date("w");?>;
        if (hourfordeliv < 25) {
            if (ourday == 1) { //понедельник
                minDatePlus = 1;
            } else if (ourday == 2) { //вторник
                if (hourfordeliv < 7)
                    minDatePlus = 0;
                else
                    minDatePlus = 1;
            } else if (ourday == 3) { //среда
                if (hourfordeliv < 8)
                    minDatePlus = '15.02.2017';
                else
                    minDatePlus = 1;
            } else if (ourday == 4) { //четверг
                minDatePlus = 1;
            } else if (ourday == 5) { //пятница
                minDatePlus = 3;
            } else if (ourday == 6) { //суббота
                minDatePlus = 2;
            } else if (ourday == 0) { //воскресенье
                minDatePlus = 1;
            }
        }
        if (parseInt($('.order_weight').text()) / 1000 > 5) { //Если вес больше 10кг, доставка плюс один день
            minDatePlus++;
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
        $("#ORDER_PROP_44, #ORDER_PROP_45").mask("99.99.9999",{placeholder:"дд.мм.гггг"});

        if ($("#ID_DELIVERY_ID_11").is(':checked')) { //Если выбрана доставка почтой России
            $(".inputTitle:contains('Получатель')").parent().append('<span class="hideInfo warningMessage" style="display:inline;color:grey">(ФИО полностью)</span>');
			$(".inputTitle:contains('Адрес доставки')").html('Город и адрес доставки');
        } else {
            $(".inputTitle:contains('Получатель')").html('Получатель <span class="bx_sof_req">*</span></p>');
			$(".inputTitle:contains('Адрес доставки')").html('Адрес доставки');
            $(".hideInfo").hide();
        }

        if ($("#ID_DELIVERY_ID_<?= DELIVERY_PICK_POINT ?>").attr("checked") != "checked") {
            $("#ID_DELIVERY_ID_<?= DELIVERY_PICK_POINT ?>").closest("div").find(".bx_result_price").find("a").hide();
        }
        // скрываем поле "Адрес" для доставки гуру, т.к. мы будем писать туда свои данные
        if ($("#ID_DELIVERY_ID_<?= GURU_DELIVERY_ID ?>").attr("checked") == "checked") {
            $(".clientInfoWrap div[data-property-id-row='5']").hide(); // физ лицо
            $(".clientInfoWrap div[data-property-id-row='14']").hide(); // юр лицо
        }         
        // скрываем поле "Адрес" для доставки boxberry, т.к. мы будем писать туда свои данные        
        if ($("#ID_DELIVERY_ID_<?= BOXBERRY_PICKUP_DELIVERY_ID ?>").attr("checked") == "checked") {
            $(".clientInfoWrap div[data-property-id-row='5']").hide(); // физ лицо
            $(".clientInfoWrap div[data-property-id-row='14']").hide(); // юр лицо
        }

        //Подсвечиваем активное местоположение в избранных
        var locationID = $(".bx-ui-slst-target[name=ORDER_PROP_2], .bx-ui-slst-target[name=ORDER_PROP_3]").val();
        //$('.quick-location-tag[data-id="' + locationID + '"]').attr("style", 'background: #00a0af !important; color: white !important;');
		$('.quick-location-tag[data-id="' + locationID + '"]').addClass('addCircle');
		
		$('#ORDER_PROP_24, #ORDER_PROP_11').bind("change keyup input click", function() {
			if (this.value.match(/[^\(\)\-\+0-9]/g)) {
				this.value = this.value.replace(/[^\(\)\-\+0-9]/g, '');
			}
		});
		$('#ORDER_PROP_24,#ORDER_PROP_11').val('+7');
    }

    $(function(){
        $('.application input[type=image]').attr('src','/images/pay.jpg');
        /*try {
        submitForm();
        }
        catch(err) {
        }*/
        setOptions();
    })
    //далее костыль
    var stopupdate = false;
    $('body').click(function(){
        if (!stopupdate) {
            setOptions();
            stopupdate = true;
        }
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
                                    $(".flippost_error").hide();
                                    if ($("#ID_DELIVERY_ID_<?= DELIVERY_PICK_POINT ?>").attr("checked") != "checked") {
                                        $("#ID_DELIVERY_ID_<?= DELIVERY_PICK_POINT ?>").closest("div").find(".bx_result_price").find("a").hide();
                                    }
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
                                        if ($(".js_delivery_block").css("display") == "none") {
                                            deliveryFlag = true;
                                        }
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
                                        if (flag) {
                                            // склеиваем адрес для flippost
                                            if ($("#ID_DELIVERY_ID_<?= FLIPPOST_ID ?>").is(':checked')) {
                                                // Если не выбрана даже страна, то показываем ошибку
                                                $(".flippostSelect").each(function() {
                                                    if (!$(this).val().length) {flag = false; return false;};
                                                });
                                                if (flag) {
                                                    var flippost_address = [
                                                        $('select[data-method="getStates"] option:checked').text(), // страна
                                                        $('select[data-method="getCities"] option:checked').text(), // область
                                                        $('select[data-method="getTarif"] option:checked').text(), // город
                                                    ],
                                                    flippost_string_address = "";
                                                    flippost_string_address = flippost_address.join(", ");
                                                    $("#ORDER_PROP_5").val(flippost_string_address + " " + $("#ORDER_PROP_5").val());
                                                    $(".flippost_error").hide();
                                                } else {
                                                    $('html, body').animate({
                                                        scrollTop: $(".js_delivery_block").offset().top
                                                        }, 500);
                                                    $(".flippost_error").show();
                                                }
                                            }
                                        }
                                        // доставка гуру
                                        if (flag) {
                                            if ($("#ID_DELIVERY_ID_<?= GURU_DELIVERY_ID ?>").is(':checked')) {
                                            	if(!$("#guru_selected").val()) {
                                            		$('html, body').animate({
                                                        scrollTop: $(".js_delivery_block").offset().top
                                                        }, 500);
                                                    $(".guru_error").show();
                                                    flag = false; return false;
                                            	} else {
                                            		$(".guru_error").hide();
                                            	}
                                            }
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

                                function ajaxResult(res) {
                                    window.flippost = !(window.flippost instanceof Flippost) ? new Flippost(<?= FLIPPOST_ID ?>) : window.flippost;
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
                                    //доп функции/////////////////////////////////
                                    setOptions();
                                    
                                    // скрываем поле "Адрес" для доставки гуру, т.к. мы будем писать туда свои данные
                                    if ($("#ID_DELIVERY_ID_<?= GURU_DELIVERY_ID ?>").attr("checked") == "checked") {
							            $(".clientInfoWrap div[data-property-id-row='5']").hide(); // физ лицо
							            $(".clientInfoWrap div[data-property-id-row='14']").hide(); // юр лицо
							        }

                                    //2. подсветка варианта оплаты для электронных платежей
                                    if(localStorage.getItem('active_rfi_button')){
                                        $('li[data-rfi-payment="'+localStorage.getItem('active_rfi_button')+'"]').addClass('active_rfi_button');
                                        if (localStorage.getItem('active_rfi_button') == "spg") {
                                            $(".recurrent_tabs").show();
                                        } else {
                                            $(".recurrent_tabs").hide();
                                        }
                                    }

                                    //2. подсветка варианта оплаты для электронных платежей
                                    if (localStorage.getItem('active_rfi_recurrent') && $('li[data-rfi-recurrent-type="'+localStorage.getItem('active_rfi_recurrent')+'"]').length) {
                                        $('li[data-rfi-recurrent-type="'+localStorage.getItem('active_rfi_recurrent')+'"]').click();
                                    } else {
                                        $('li[data-rfi-recurrent-type="new"]').click();
                                    }

                                    // т.к. битрикс после ajax перезагружает всю страницу, то вешаем хендлер заново после каждого аякса
                                    if ($(".js_delivery_block").length) {
                                        if ($("#ID_DELIVERY_ID_<?= FLIPPOST_ID ?>").is(':checked')) {
                                            !$("#flippostCountrySelect").length ? window.flippost.getData("getCountries") : "";
                                            $(".js_delivery_block").on('change', '.flippostSelect', function() {
                                                var country = $('select[data-method="getStates"]').val(),
                                                state   = $('select[data-method="getCities"]').val(),
                                                city    = $('select[data-method="getTarif"]').val(),
                                                weight  = parseInt($('.order_weight').text()) / 1000,
                                                method  = $(this).data("method"); // какой метод вызывать следующим
                                                $(this).nextAll("select").remove(); // сносим все последующие селекты, т.к. они больше не нужны
                                                window.flippost.getData(method, country, state, city, weight); // рендерим новые
                                            });
                                        }
                                    }
                                    // инициализация карты доставки гуру после каждого аякса
                                   $.post(
								   	window.location.origin + window.THIS_TEMPLATE_PATH + "/include/guru/ajax/pvz_init.php",
								    {}
								   ).success(function(data) {
								   		var pvz = JSON.parse(data);
								        var center_1='';
								        var center_2='';
								            var points = eval("obj = " + pvz.result);
								            if(pvz.result==''){
								                alert('Нет соединения с сервером пунктов выдачи!');
								                return false;
								            }
								            maps_init_GURU(points, center_1, center_2);
								    });
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
                                    <?/*<p class="blockText">Выберите ваше местоположение</p> <br>*/?>

                                    <?//блок с местоположением
                                        if ($arResult["ORDER_PROP"]["USER_PROPS_N"][2]) {
                                            $location[] = ($arResult["ORDER_PROP"]["USER_PROPS_N"][2]);
                                        } else {
                                            $location[] = ($arResult["ORDER_PROP"]["USER_PROPS_N"][3]);
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
                <?$APPLICATION->IncludeComponent("bitrix:sale.location.selector.steps", ".default", array(

                        ),
                        false,
                        array(
                            "ACTIVE_COMPONENT" => "Y"
                        )
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
		<br />
		<span style="font-family: 'Walshein_regular';font-size: 14px;">Нажимая на кнопку «Оформить заказ», вы соглашаетесь с условиями <a href="/info_popup/oferta.php" onclick="return false;" class="cartMenuPopup">публичной оферты</a></span>
    </div>
</div>
<script>
    $(document).ready(function(){
        if ($("#ID_DELIVERY_ID_<?= DELIVERY_PICK_POINT ?>").attr("checked") != "checked") {
            $("#ID_DELIVERY_ID_<?= DELIVERY_PICK_POINT ?>").closest("div").find(".bx_result_price").find("a").hide();
        }
    })
</script>