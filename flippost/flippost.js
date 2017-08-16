function Flippost(flippost_id) { 
    self = this;
    self.flippost_id = flippost_id;
    self.queryObj = {};
    self.returnedData = [];
    self.availibleMethods = ['getCountries', 'getStates', 'getCities','getTarif'];
    self.selectFirstString = {
        'getCountries':'Выберите страну',
        'getStates':'Выберите область (штат) или город',
        'getCities':'Выберите город'
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

Flippost.prototype.__makeQueryArray = function(method, country, state, city, weight) {  
    switch(method) {
        case 'getCountries':
            self.queryObj = {
                method : method
            };
            break;
        case 'getStates':
            self.queryObj = {
                method : method, 
                country : country
            };
            break;
        case 'getCities':   
            self.queryObj = {
                method : method,
                country : country,
                weight : weight,
                state : state
            };
            break;
        case 'getTarif':
            self.queryObj = {
                method : method,
                city : city,
                weight : weight,
                country : country,
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


Flippost.prototype.__getQueryData = function(method, country) {         
    $.post("/flippost/delivery_post.php", self.queryObj, function(data) {
        self.returnedData = JSON.parse(data);    
        if(method=='getStates' && self.returnedData.length == 0){ // --- some countries don't have states,get cities in this case
            self.getData('getCities', country);
        } else if(method=='getCities' && self.returnedData.length == 0) { // Если мы выбрали штат (город) у которого больше нет наследников       
            self.getData('getTarif', country, self.queryObj.state, self.queryObj.state, self.queryObj.weight); 
        } else {                                              
            self.__makeSelectTag(method);
        }

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

Flippost.prototype.__makeSelectTag = function(method) {  
    nextMethodIndex = self.availibleMethods.indexOf(method) + 1;

    if(!self.availibleMethods[nextMethodIndex]){ // -- final API method getTarif don't have select tag
        self.__printPrice();
        return false;
    }

    select_tag = document.createElement('select');
    select_tag.setAttribute("class", 'flippostSelect');

    if (method == 'getCountries') {
        select_tag.setAttribute("id", 'flippostCountrySelect');
    }

    select_tag.setAttribute("data-method", self.availibleMethods[nextMethodIndex]);
    option_tag = document.createElement('option');
    option_tag.innerHTML = self.selectFirstString[method];
    option_tag.value = "";
    select_tag.appendChild(option_tag);   
    
    self.returnedData.forEach(function(elem) {
        option_tag = document.createElement('option');
        option_tag.setAttribute("value", elem.first);
        option_tag.innerHTML = elem.second.replace(/\(.+\)/, '');
        select_tag.appendChild(option_tag);
    });

    document.querySelector('.flippostSelectContainer').appendChild(select_tag);
}

/*******
 *
 * protected
 *
 * @return void
 *
 *******/

Flippost.prototype.__printPrice = function() { 
    document.querySelector('.deliveryPriceTable').innerHTML = self.returnedData[0].first + ' руб.';
    $(".ID_DELIVERY_ID_" + self.flippost_id).html(self.returnedData[0].first + ' руб.');
    finalSumWithoutDiscount = parseFloat($('.SumTable').html().replace(" ", "")) + parseFloat(self.returnedData[0].first);
    $('.finalSumTable').html( finalSumWithoutDiscount.toFixed(2) + ' руб.');
    $("#flippost_cost").val(self.returnedData[0].first);
    var delivery_time = self.returnedData[0].second + 3; //сорк доставки. добавляем к сроку, полученному из запроса 3 дня
    $("#flippost_delivery_time").show();
    $("#flippost_delivery_time span").html(delivery_time);
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

Flippost.prototype.getData = function(method, country, state, city, weight) {            
    self.__makeQueryArray(method, country, state, city, weight);
    self.__getQueryData(method,country);
}
