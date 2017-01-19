//Создание точек на карте------
function maps_init_GURU(points, center_1, center_2){
if(center_1==''){
var center_1=55.755768;
var center_2=37.617671;
}
ymaps.ready(init);
function init() {
            var myMap = new ymaps.Map('YMapsID', {
                    center: [center_1, center_2],
                    zoom: 8,
                    behaviors: ["default", "scrollZoom"]
                }),
                collection = new ymaps.GeoObjectCollection();
                myMap.controls.add(
                   new ymaps.control.ZoomControl()
                );    
            myMap.geoObjects.add(collection);
            for(var i = 0, len = points.length; i < len; i++) {
                collection.add(
                    new ymaps.Placemark(points[i].coords, {
                        balloonContentHeader: points[i].label+' ',
                        balloonContentBody: ''+points[i].way_desc+'<div>Время работы: <b>'+points[i].time+'</b><br>'+points[i].params+'Срок доставки в днях: <b>'+points[i].days+'</b><br><input style="padding:8px;" type="button" pf="'+points[i].pf+'" value="Выбрать" class="select-point" rel="'+points[i].id+'" city="'+points[i].city+'" name="'+points[i].label+'" region="'+points[i].region+'"  date="'+points[i].date+'"> </div>',
                        balloonContentFooter: '<b>Точный адрес:</b> <i>'+points[i].desc+'</i>',
                        hintContent: points[i].label,
                        searchStr: '<b>'+points[i].label+'</b> '+points[i].desc+'<br>'
                    },
                    
                    
        {
        iconLayout: 'default#image',
        iconImageHref: 'http://dostavka.guru/map_icon2.png',
        iconImageSize: [31, 40],
        iconImageOffset: [-20, -20],
        // Определим интерактивную область над картинкой.
        iconShape: {
            type: 'Circle',
            coordinates: [0, 0],
            radius: 20
        }
        }            
                    )
                );
            }
document.getElementById('message-map-link').onclick = function () {        
if($('.geo_class').val()){
var myGeocoder = ymaps.geocode($('.geo_class').val()+' Россия');
            var ccc=myGeocoder.then(
                function (res) {
                    if(res.geoObjects.get(0).geometry.getCoordinates()!=''){
                        myMap.setCenter(res.geoObjects.get(0).geometry.getCoordinates(), 11, {
                            checkZoomRange: true
                        });
                    }else{}        
                },
                function (err) {
                    alert('Ошибка: объект на карте не найден!');
                }
            );    
}else{}
};    
    }
}
//---------------------------------------
//ОТКРЫТЬ КАРТУ
function open_GURU_map(){
    $('#YMapsID').css('top', '100px');
    $('#close_map').css('top', '110px');
    return false;
}
//------------
//ЗАКРЫТЬ КАРТУ
function close_GURU_map(){
    $('#YMapsID').css('top', '-2000px');
    $('#close_map').css('top', '-2000px');
    return false;
}
//------------
//создание карты
function new_map_new_center(){
    $.post("http://api.dostavka.guru/client/get_pvz_codes_2.php",
    {init: 'get_pvz' }).success(function(data) {
        var center_1='37.617671';
        var center_2='55.755768';
            var points = eval("obj = " + data);
            if(data==''){
                alert('Нет соединения с сервером пунктов выдачи!');
                return false;
            }
            maps_init_GURU(points, center_1, center_2);
            open_GURU_map();
    });
}
$(document).ready(function(){
    $.post("http://api.dostavka.guru/client/get_pvz_codes_2.php",
    {init: 'get_pvz' }).success(function(data) {
        var center_1='';
        var center_2='';
            var points = eval("obj = " + data);
            if(data==''){
                alert('Нет соединения с сервером пунктов выдачи!');
                return false;
            }
            maps_init_GURU(points, center_1, center_2);
    });
});
//--------------
$(document).ready(function(){
    //ТРИГЕРЫ
    $('.message-map-link').live('click', function(){
        open_GURU_map();//открыть каррту
        return false;
    });
    
    $("#close_map").live('click', function(){
        close_GURU_map();//закрыть карту
        return false;
    });
    //ПОЛУЧИТЬ ДАННЫЕ ПО ВЫБОРУ ПУНКТА
    $('.select-point').live('click', function(){
        var code=$(this).attr('rel');//Код пвз
        var city=$(this).attr('city');//Город пвз
        var name=$(this).attr('name');//Наименование пвз
        var region=$(this).attr('region');//Регтон пвз
        var date_pvz=$(this).attr('date');//Ближайшая дата доставки
        
        //Здесь код, который заполнит нужные поля Вашей информационной системы
        
        
        alert('Выбран пункт: '+code);
        
        
        //-------------------------------------------------------------------
        
        close_GURU_map();//закрыть карту
        return false;
    });
});    