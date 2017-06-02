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
        city = JSON.parse(data);
        self.__makeSelectTag(method, country, state, zip, boxbery_id);
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

        function emptyOption(operator){
            if(operator){
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
            } else {
                select_tag = '';
                if(country == "Москва"){
                    window.boxbery.getData("DeliveryCosts", country, state); // рендерим новые
                } else {
                    window.boxbery.getData("ListZips", country, state); // рендерим новые
                }
            }
        }
        var Region = [],
            City = [],
            ZipCity = [],
            citiName = [];

        if(country == undefined){
            method_city = state+'#';
        } else {
            method_city = state+'#'+country;
        }

        city.forEach(function(elem) {
            if(elem.Area == "Москва"){
                Region[elem.Area] = elem.Region;
            } else if(elem.Area == "Московская"){
                Region[elem.Area] = elem.Region;
            }
        })
        city.forEach(function(elem) {
            if(elem.Area != "Москва" && elem.Area != "Московская"){
                Region[elem.Area] = elem.Region;
            }

            citiName = elem.City;
            if(!City[elem.Area+'#'+elem.Region]){
                City[elem.Area+'#'+elem.Region] = [];
                City[elem.Area+'#'+elem.Region].push(citiName);
            } else {
               City[elem.Area+'#'+elem.Region].push(citiName);
            }

        });

      /*  var key, Region = new Array();
            for (key in Region_old){
                console.log(Region_old[key]);
                Region [Area[Region_old[key]]] = Region_old [key];
            }
                */
        city.forEach(function(elem) {
              ZipCity[elem.City] = elem.Zip
        });

    var empty_region = true;
    if(method == 'CourierListCities'){
        emptyOption(true);
        for(elem in Region) {
            option_tag = document.createElement('option');
            option_tag.setAttribute("value", elem);
            option_tag.innerHTML = elem;
            select_tag.appendChild(option_tag);
        }
    }else if('CourierListCities&Region' == method){

        if(Region[state]){
            emptyOption(true);
            for(elem in Region) {
                if(Region[elem] && elem == state){
                    empty_region = false;
                    option_tag = document.createElement('option');
                    option_tag.setAttribute("value", Region[elem]);
                    option_tag.innerHTML = Region[elem];
                    select_tag.appendChild(option_tag);
                } else {
                    empty_region = true;
                }
            };
        } else {
            empty_region = false;
            emptyOption(false);
        }


    }

    if('ListZips' == method){

        var key = 0;
        var arCity = [];
        emptyOption(true);
        empty_region = true;
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

    if(empty_region){
        document.querySelector('.boxberySelectContainer').appendChild(select_tag);
    }
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
    $("#boxbery_cost").val(city.price);
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
