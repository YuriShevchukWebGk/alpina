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

Boxbery.prototype.__makeQueryArray = function(method, country, state, zip, weight, boxbery_id) {

    switch(method) {
        case 'CourierListCities':
            self.queryObj = {
                method : method
            };
            break;
        case 'CourierListCities&Region':
            self.queryObj = {
                method : method
            };
            break;
        case 'ListZips':
            self.queryObj = {
                method : method,
                zip : zip,
            };
            break;
        case 'DeliveryCosts':
            self.queryObj = {
                method : method,
                zip : zip,
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


Boxbery.prototype.__getQueryData = function(method, country, state, zip, boxbery_id) {
    $.post("/boxbery/delivery_post.php", self.queryObj, function(data) {
     //   self.returnedData = JSON.parse(data);

        city = JSON.parse(data);
        self.__makeSelectTag(method, country, state, zip, boxbery_id);
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

Boxbery.prototype.__makeSelectTag = function(method, country, state, zip, boxbery_id) {
    nextMethodIndex = self.availibleMethods.indexOf(method) + 1;

    if(!self.availibleMethods[nextMethodIndex]){ // -- final API method getTarif don't have select tag
        self.__printPrice(boxbery_id);
        return false;
    }
        function in_array(value, array)
        {
            for(var i = 0; i < array.length; i++)
            {
                if(array[i] == value) return true;
            }
            return false;
        }




        function emptyOption(){
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
        }
        var Region = [],
            City = [],
            ZipCity = [];
        var citiName = [];

        if(country == undefined){
            method_city = state+'#';
        } else {
            method_city = state+'#'+country;
        }
    // if(method != 'ListZips'){

        city.forEach(function(elem) {
            Region[elem.Area] = elem.Region;

            citiName = elem.City;

            if(!City[elem.Area+'#'+elem.Region]){
                City[elem.Area+'#'+elem.Region] = [];
                City[elem.Area+'#'+elem.Region].push(citiName);
            } else {
               City[elem.Area+'#'+elem.Region].push(citiName);
            }

        });

        city.forEach(function(elem) {
            ZipCity[elem.City] = elem.Zip
        });


    if(method == 'CourierListCities'){
        emptyOption();
        for(elem in Region) {
            option_tag = document.createElement('option');
            option_tag.setAttribute("value", elem);
            option_tag.innerHTML = elem;
            select_tag.appendChild(option_tag);

        }
    }else if('CourierListCities&Region' == method){

        console.log(state);
        console.log(Region[state]);
        if(Region[state]){
            emptyOption();
            for(elem in Region) {
                if(Region[elem] && elem == state){
                    empty_region = 'N';
                    option_tag = document.createElement('option');
                    option_tag.setAttribute("value", Region[elem]);
                    option_tag.innerHTML = Region[elem];
                    select_tag.appendChild(option_tag);
                } else {
                    empty_region = 'Y';

                    var foo = $('select[data-method="ListZips"]'); // сносим все последующие селекты, т.к. они больше не нужны

                    foo.detach(); //удаляем элемент
                }
            };
        } else {
            method = 'ListZips';
            select_tag = '';
        }


    }else if('ListZips' == method){
        var key = 0;
        var arCity = [];
        emptyOption();
        for(arrElem in City) {
            for(cityName in City[arrElem]) {
                key++;
                if(arrElem == method_city && !in_array( City[arrElem][cityName], arCity )){
                    option_tag = document.createElement('option');
                    option_tag.setAttribute("value", ZipCity[City[arrElem][cityName]]);
                    option_tag.innerHTML = City[arrElem][cityName];
                    select_tag.appendChild(option_tag);
                }
                arCity[key] = City[arrElem][cityName];
            }
        };

    }

  /*  if('ListZips' == method){
        var arCity = [];
        var key = 0
        for(elem in City) {
            key++;
            if(!in_array( City[elem], arCity ) ){
                option_tag = document.createElement('option');
                option_tag.setAttribute("value", elem);
                option_tag.innerHTML = City[elem];
                select_tag.appendChild(option_tag);
            }
            arCity[key] = City[elem];
        };

    }     */


    document.querySelector('.boxberySelectContainer').appendChild(select_tag);
}

/*******
 *
 * protected
 *
 * @return void
 *
 *******/

Boxbery.prototype.__printPrice = function(boxbery_id) {
    document.querySelector('.deliveryPriceTable').innerHTML = city.price + ' руб.';
    $(".ID_DELIVERY_ID_50").html(city.price + ' руб.');
    finalSumWithoutDiscount = parseFloat($('.SumTable').html().replace(" ", "")) + parseFloat(city.price);
    $('.finalSumTable').html( finalSumWithoutDiscount.toFixed(2) + ' руб.');
    $("#boxbery_cost").val(city.delivery_period);
    var delivery_time = Math.round(city.delivery_period) + 3; //сорк доставки. добавляем к сроку, полученному из запроса 3 дня
    $("#boxbery_delivery_time").show();
    $("#boxbery_delivery_time span").html(delivery_time);
}

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

Boxbery.prototype.getData = function(method, country, state, city, weight, zip, boxbery_id) {
    self.__makeQueryArray(method, country, state, city, weight, zip, boxbery_id);
    self.__getQueryData(method,country, state, zip, boxbery_id);
}
