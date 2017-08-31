BX.saleOrderAjax = { // bad solution, actually, a singleton at the page

    BXCallAllowed: false,

    options: {},
    indexCache: {},
    controls: {},

    modes: {},
    properties: {},

    // called once, on component load
    init: function(options)
    {
        var ctx = this;
        this.options = options;

        window.submitFormProxy = BX.proxy(function(){
            ctx.submitFormProxy.apply(ctx, arguments);
        }, this);

        BX(function(){
            ctx.initDeferredControl();
        });
        BX(function(){
            ctx.BXCallAllowed = true; // unlock form refresher
        });

        this.controls.scope = BX('order_form_div');

        // user presses "add location" when he cannot find location in popup mode
        BX.bindDelegate(this.controls.scope, 'click', {className: '-bx-popup-set-mode-add-loc'}, function(){

            var input = BX.create('input', {
                attrs: {
                    type: 'hidden',
                    name: 'PERMANENT_MODE_STEPS',
                    value: '1'
                }
            });

            BX.prepend(input, BX('ORDER_FORM'));

            ctx.BXCallAllowed = false;
            submitForm();
        });
    },

    cleanUp: function(){

        for(var k in this.properties)
        {
            if (this.properties.hasOwnProperty(k))
            {
                if(typeof this.properties[k].input != 'undefined')
                {
                    BX.unbindAll(this.properties[k].input);
                    this.properties[k].input = null;
                }

                if(typeof this.properties[k].control != 'undefined')
                    BX.unbindAll(this.properties[k].control);
            }
        }

        this.properties = {};
    },

    addPropertyDesc: function(desc){
        this.properties[desc.id] = desc.attributes;
        this.properties[desc.id].id = desc.id;
    },

    // called each time form refreshes
    initDeferredControl: function()
    {
        var ctx = this,
            k,
            row,
            input,
            locPropId,
            m,
            control,
            code,
            townInputFlag,
            adapter;

        // first, init all controls
        if(typeof window.BX.locationsDeferred != 'undefined'){

            this.BXCallAllowed = false;

            for(k in window.BX.locationsDeferred){

                window.BX.locationsDeferred[k].call(this);
                window.BX.locationsDeferred[k] = null;
                delete(window.BX.locationsDeferred[k]);

                this.properties[k].control = window.BX.locationSelectors[k];
                delete(window.BX.locationSelectors[k]);
            }
        }

        for(k in this.properties){

            // zip input handling
            if(this.properties[k].isZip){
                row = this.controls.scope.querySelector('[data-property-id-row="'+k+'"]');
                if(BX.type.isElementNode(row)){

                    input = row.querySelector('input[type="text"]');
                    if(BX.type.isElementNode(input)){
                        this.properties[k].input = input;

                        // set value for the first "location" property met
                        locPropId = false;
                        for(m in this.properties){
                            if(this.properties[m].type == 'LOCATION'){
                                locPropId = m;
                                break;
                            }
                        }

                        if(locPropId !== false){
                            BX.bindDebouncedChange(input, function(value){

                                input = null;
                                row = null;

                                if(BX.type.isNotEmptyString(value) && /^\s*\d+\s*$/.test(value) && value.length > 3){

                                    ctx.getLocationByZip(value, function(locationId){
                                        ctx.properties[locPropId].control.setValueByLocationId(locationId);
                                    }, function(){
                                        try{
                                            ctx.properties[locPropId].control.clearSelected(locationId);
                                        }catch(e){}
                                    });
                                }
                            });
                        }
                    }
                }
            }

            // location handling, town property, etc...
            if(this.properties[k].type == 'LOCATION')
            {

                if(typeof this.properties[k].control != 'undefined'){

                    control = this.properties[k].control; // reference to sale.location.selector.*
                    code = control.getSysCode();

                    // we have town property (alternative location)
                    if(typeof this.properties[k].altLocationPropId != 'undefined')
                    {
                        if(code == 'sls') // for sale.location.selector.search
                        {
                            // replace default boring "nothing found" label for popup with "-bx-popup-set-mode-add-loc" inside
                            control.replaceTemplate('nothing-found', this.options.messages.notFoundPrompt);
                        }

                        if(code == 'slst')  // for sale.location.selector.steps
                        {
                            (function(k, control){

                                // control can have "select other location" option
                                control.setOption('pseudoValues', ['other']);

                                // insert "other location" option to popup
                                control.bindEvent('control-before-display-page', function(adapter){

                                    control = null;

                                    var parentValue = adapter.getParentValue();

                                    // you can choose "other" location only if parentNode is not root and is selectable
                                    if(parentValue == this.getOption('rootNodeValue') || !this.checkCanSelectItem(parentValue))
                                        return;

                                    var controlInApater = adapter.getControl();

                                    if(typeof controlInApater.vars.cache.nodes['other'] == 'undefined')
                                    {
                                        controlInApater.fillCache([{
                                            CODE:        'other',
                                            DISPLAY:    ctx.options.messages.otherLocation,
                                            IS_PARENT:    false,
                                            VALUE:        'other'
                                        }], {
                                            modifyOrigin:            true,
                                            modifyOriginPosition:    'prepend'
                                        });
                                    }
                                });

                                townInputFlag = BX('LOCATION_ALT_PROP_DISPLAY_MANUAL['+parseInt(k)+']');

                                control.bindEvent('after-select-real-value', function(){

                                    // some location chosen
                                    if(BX.type.isDomNode(townInputFlag))
                                        townInputFlag.value = '0';
                                });
                                control.bindEvent('after-select-pseudo-value', function(){

                                    // option "other location" chosen
                                    if(BX.type.isDomNode(townInputFlag))
                                        townInputFlag.value = '1';
                                });

                                // when user click at default location or call .setValueByLocation*()
                                control.bindEvent('before-set-value', function(){
                                    if(BX.type.isDomNode(townInputFlag))
                                        townInputFlag.value = '0';
                                });

                                // restore "other location" label on the last control
                                if(BX.type.isDomNode(townInputFlag) && townInputFlag.value == '1'){

                                    // a little hack: set "other location" text display
                                    adapter = control.getAdapterAtPosition(control.getStackSize() - 1);

                                    if(typeof adapter != 'undefined' && adapter !== null)
                                        adapter.setValuePair('other', ctx.options.messages.otherLocation);
                                }

                            })(k, control);
                        }
                    }
                }
            }
        }

        this.BXCallAllowed = true;
    },

    checkMode: function(propId, mode){

        //if(typeof this.modes[propId] == 'undefined')
        //    this.modes[propId] = {};

        //if(typeof this.modes[propId] != 'undefined' && this.modes[propId][mode])
        //    return true;

        if(mode == 'altLocationChoosen'){

            if(this.checkAbility(propId, 'canHaveAltLocation')){

                var input = this.getInputByPropId(this.properties[propId].altLocationPropId);
                var altPropId = this.properties[propId].altLocationPropId;

                if(input !== false && input.value.length > 0 && !input.disabled && this.properties[altPropId].valueSource != 'default'){

                    //this.modes[propId][mode] = true;
                    return true;
                }
            }
        }

        return false;
    },

    checkAbility: function(propId, ability){

        if(typeof this.properties[propId] == 'undefined')
            this.properties[propId] = {};

        if(typeof this.properties[propId].abilities == 'undefined')
            this.properties[propId].abilities = {};

        if(typeof this.properties[propId].abilities != 'undefined' && this.properties[propId].abilities[ability])
            return true;

        if(ability == 'canHaveAltLocation'){

            if(this.properties[propId].type == 'LOCATION'){

                // try to find corresponding alternate location prop
                if(typeof this.properties[propId].altLocationPropId != 'undefined' && typeof this.properties[this.properties[propId].altLocationPropId]){

                    var altLocPropId = this.properties[propId].altLocationPropId;

                    if(typeof this.properties[propId].control != 'undefined' && this.properties[propId].control.getSysCode() == 'slst'){

                        if(this.getInputByPropId(altLocPropId) !== false){
                            this.properties[propId].abilities[ability] = true;
                            return true;
                        }
                    }
                }
            }

        }

        return false;
    },

    getInputByPropId: function(propId){
        if(typeof this.properties[propId].input != 'undefined')
            return this.properties[propId].input;

        var row = this.getRowByPropId(propId);
        if(BX.type.isElementNode(row)){
            var input = row.querySelector('input[type="text"]');
            if(BX.type.isElementNode(input)){
                this.properties[propId].input = input;
                return input;
            }
        }

        return false;
    },

    getRowByPropId: function(propId){

        if(typeof this.properties[propId].row != 'undefined')
            return this.properties[propId].row;

        var row = this.controls.scope.querySelector('[data-property-id-row="'+propId+'"]');
        if(BX.type.isElementNode(row)){
            this.properties[propId].row = row;
            return row;
        }

        return false;
    },

    getAltLocPropByRealLocProp: function(propId){
        if(typeof this.properties[propId].altLocationPropId != 'undefined')
            return this.properties[this.properties[propId].altLocationPropId];

        return false;
    },

    toggleProperty: function(propId, way, dontModifyRow){

        var prop = this.properties[propId];

        if(typeof prop.row == 'undefined')
            prop.row = this.getRowByPropId(propId);

        if(typeof prop.input == 'undefined')
            prop.input = this.getInputByPropId(propId);

        if(!way){
            if(!dontModifyRow)
                BX.hide(prop.row);
            prop.input.disabled = true;
        }else{
            if(!dontModifyRow)
                BX.show(prop.row);
            prop.input.disabled = false;
        }
    },

    submitFormProxy: function(item, control)
    {
        var propId = false;
        for(var k in this.properties){
            if(typeof this.properties[k].control != 'undefined' && this.properties[k].control == control){
                propId = k;
                break;
            }
        }

        // turning LOCATION_ALT_PROP_DISPLAY_MANUAL on\off

        if(item != 'other'){

            if(this.BXCallAllowed){

                this.BXCallAllowed = false;
                submitForm();
            }

        }
    },

    getPreviousAdapterSelectedNode: function(control, adapter){

        var index = adapter.getIndex();
        var prevAdapter = control.getAdapterAtPosition(index - 1);

        if(typeof prevAdapter !== 'undefined' && prevAdapter != null){
            var prevValue = prevAdapter.getControl().getValue();

            if(typeof prevValue != 'undefined'){
                var node = control.getNodeByValue(prevValue);

                if(typeof node != 'undefined')
                    return node;

                return false;
            }
        }

        return false;
    },
    getLocationByZip: function(value, successCallback, notFoundCallback)
    {
        if(typeof this.indexCache[value] != 'undefined')
        {
            successCallback.apply(this, [this.indexCache[value]]);
            return;
        }

        ShowWaitWindow();

        var ctx = this;

        BX.ajax({

            url: this.options.source,
            method: 'post',
            dataType: 'json',
            async: true,
            processData: true,
            emulateOnload: true,
            start: true,
            data: {'ACT': 'GET_LOC_BY_ZIP', 'ZIP': value},
            //cache: true,
            onsuccess: function(result){

                CloseWaitWindow();
                if(result.result){

                    ctx.indexCache[value] = result.data.ID;

                    successCallback.apply(ctx, [result.data.ID]);

                }else
                    notFoundCallback.call(ctx);

            },
            onfailure: function(type, e){

                CloseWaitWindow();
                // on error do nothing
            }

        });
    }

}
function postamat(path){
    var postamat = $('#sPPDelivery').val();
    if(postamat != 'не выбрано'){
       path = false;
    }else{
       path = true;
    }
    return path;
}

function focus_imput() {
    $(".clientInfoWrap input").focus(function() {
        var lf = arguments.callee.lastFocused;
        if (lf) {
            if ($(lf).val().length == 0) {
                lf.focus();
                return true;
            }
        }
        arguments.callee.lastFocused = this;
    });
};

/**
 *
 * Подстановка данных об адресе в верстку
 *
 * @param object delivery_data
 */

//Передаем данные в скрытые поля input для доставки boxberry
function setAddressDataBoxberry(delivery_data) {
    $(".boxberry_error").hide();
    // адрес доставки в блоке самой доставки
    $(".boxberry_point_addr").html(delivery_data.address);
    // далее подставляем инфу в скрытые инпуты, для передачи дальше
    $("#boxberry_delivery_data").val(delivery_data.id);
    $("#ORDER_PROP_94").val(delivery_data.address); // физ-лицо
    $("#ORDER_PROP_95").val(delivery_data.address); // юр-лицо
    $("#ORDER_PROP_5").val(delivery_data.id); // физ-лицо
    $("#ORDER_PROP_14").val(delivery_data.id); // юр-лицо
    // устанавливаем флаг, что город выбран, нужно для js валидации
    $("#boxberry_selected").val(1);
}

//<-- вычисляем сегодняшнюю дату и разбиваем по частям --//
// расчет дня недели

function getDay(day,mon,year, new_day){
     date_new = new Date(year, mon, day);
     d_new = date_new.getDate();
     var month = ["","январь", "февраль", "март", "апрель", "май", "июнь", "июль", "август", "сентябрь", "октябрь", "ноябрь", "декабрь"];
     var days = ["","понедельник","вторник","среда","четверг","пятница","суббота","воскресенье"];

     if(day - new_day > 28){
        mon = parseInt(mon + 2, 10); //если месяц двухсимвольный и <10
     } else {
        mon = parseInt(mon + 1, 10); //если месяц двухсимвольный и <10
     }

     day = parseInt(day, 10); //если день двухсимвольный и <10

     var a = parseInt((14-mon)/12, 10);
     var y = year-a;
     var m = mon+12*a-2;

     var d = (7000+parseInt(d_new+y+parseInt(y/4, 10)-parseInt(y/100, 10)+parseInt(y/400, 10)+(31*m)/12, 10))%7;

     if(d == 5 || d == 6){
       d_new = d_new + 2;
     } else if(d == 7){
       d_new = d_new + 1;
     } else {
       d_new = d_new + 2;
     }
     d = (7000+parseInt(d_new+y+parseInt(y/4, 10)-parseInt(y/100, 10)+parseInt(y/400, 10)+(31*m)/12, 10))%7;


 return days[d] +', '+ d_new +' '+ month[mon] +', '+ y;
}
date = new Date();

//<-- вычисляем сегодняшнюю дату и разбиваем по частям --//
/**
 *
 * Подстановка полученных значений в верстку
 *
 * @param string delivery_time
 */
function fitDeliveryDataBoxberry(delivery_time, delivery_price) {
    // установка цен внизу страницы
    if (delivery_price == 0) {
        var delivery_message = 'Бесплатно';
    } else {
        var delivery_message = delivery_price + ' руб.';
    }
    document.querySelector('.deliveryPriceTable').innerHTML = delivery_message;

    //Для eskimobi
    $('#eski_tottal div:eq(3) span').html(delivery_message);

    finalSumWithoutDiscount = parseFloat($('.SumTable').html().replace(" ", "")) + parseFloat(delivery_price);
    $('.finalSumTable').html(finalSumWithoutDiscount.toFixed(2) + ' руб.');

    //Для eskimobi
    $('#eski_tottal div:eq(4) span').html(finalSumWithoutDiscount.toFixed(2));

    // установка значений для блока с самой доставкой
    $(".ID_DELIVERY_ID_" + window.BOXBERRY_PICKUP_DELIVERY_ID).html(delivery_message);
    $("#boxberry_cost").val(delivery_price);
    if (parseInt(delivery_time) != 0) {
        // если значения не будет, то значит произошла ошибка и время доставки не показываем
        $("#boxberry_delivery_time").show();
        d = date.getDate() + parseInt(delivery_time);
        m = date.getMonth();
        y = date.getFullYear();
        $("#boxberry_delivery_time").html('Ожидаемая дата доставки: ' + getDay(d,m,y, parseInt(delivery_time)));
    }
}


//Callback функция для boxberry
function boxberry_callback(result){
    window.boxberry_result = result;
    setAddressDataBoxberry(result);
    fitDeliveryDataBoxberry(result.period, result.price);
}

