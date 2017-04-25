function Boxbery(boxbery_id) {
    self = this;
    self.boxbery_id = boxbery_id;
    self.queryObj = {};
    self.returnedData = [];
    self.availibleMethods = ['CourierListCities', 'CourierListCities&Region', 'ListZips','DeliveryCosts'];
    self.selectFirstString = {
        'CourierListCities':'Выберите область',
        'CourierListCities&Region':'Выберите регион',
        'ListZips':'Выберите город'
    };
}

 /*******
 *
 *  Creating object for post ajax query
 *
 * protected
 *
 * @param string method
 * @param string country
 * @param string state
 * @param string city
 * @param float weight
 *
 * @return void
 *
 *******/

Boxbery.prototype.__makeQueryArray = function(method, country, state, city, weight) {

    switch(method) {
        case 'CourierListCities':
            self.queryObj = {
                method : method
            };
            break;
        case 'ListZips':
            self.queryObj = {
                method : method,
                country : country,
                state : state
            };
            break;
        case 'DeliveryCosts':
            self.queryObj = {
                method : method,
                country : country,
                city : city,
                weight : weight,
            };
            break;
    }
}

 /*******
 *
 * Making ajax request
 *
 * protected
 *
 * @param string method
 * @param string country - optional
 *
 * @return void
 *
 *******/


Boxbery.prototype.__getQueryData = function(method,country) {
    $.post("/boxbery/delivery_post.php", self.queryObj, function(data) {
        self.returnedData = JSON.parse(data);
        console.log(data);
/*        if(method=='CourierListCities' && self.returnedData.length == 0){ // --- some countries don't have states,get cities in this case
            self.getData('CourierListCities',country);
        } else {
            self.__makeSelectTag(method);
        }      */
    });
}

 /*******
 *
 * Creating HTML select tag
 *
 * protected
 *
 * @param string method
 *
 * @return void
 *
 *******/

Boxbery.prototype.__makeSelectTag = function(method) {
    //nextMethodIndex = self.availibleMethods.indexOf(method) + 1;

   /* if(!self.availibleMethods[nextMethodIndex]){ // -- final API method getTarif don't have select tag
        self.__printPrice();
        return false;
    }    */

    select_tag = document.createElement('select');
    select_tag.setAttribute("class", 'boxberySelect');

    if (method == 'CourierListCities') {
        select_tag.setAttribute("id", 'boxberyCountrySelect');
    }

    select_tag.setAttribute("data-method", self.availibleMethods[nextMethodIndex]);

    option_tag = document.createElement('option');
    option_tag.innerHTML = self.selectFirstString[method];
    option_tag.value = "";
    select_tag.appendChild(option_tag);

    self.returnedData.forEach(function(elem) {
        option_tag = document.createElement('option');
        option_tag.setAttribute("value", elem.first);
        console.log(elem.second);
        option_tag.innerHTML = elem.second.replace(/\(.+\)/, '');
        select_tag.appendChild(option_tag);
    });

    document.querySelector('.boxberySelectContainer').appendChild(select_tag);
}

/*******
 *
 * protected
 *
 * @return void
 *
 *******/

/*Boxbery.prototype.__printPrice = function() {
    document.querySelector('.deliveryPriceTable').innerHTML = self.returnedData[0].first + ' руб.';
    $(".ID_DELIVERY_ID_" + self.boxbery_id).html(self.returnedData[0].first + ' руб.');
    finalSumWithoutDiscount = parseFloat($('.SumTable').html().replace(" ", "")) + parseFloat(self.returnedData[0].first);
    $('.finalSumTable').html( finalSumWithoutDiscount.toFixed(2) + ' руб.');
    $("#boxbery_cost").val(self.returnedData[0].first);
    var delivery_time = Math.round(self.returnedData[0].second) + 3; //сорк доставки. добавляем к сроку, полученному из запроса 3 дня
    $("#boxbery_delivery_time").show();
    $("#boxbery_delivery_time span").html(delivery_time);
}   */

 /*******
 *
 * public
 *
 * @param string method
 * @param string country
 * @param string state
 *
 * @return void
 *
 *******/

Boxbery.prototype.getData = function(method, country, state, city, weight) {
    self.__makeQueryArray(method, country, state, city, weight);
    self.__getQueryData(method,country);
}
