$(document).on("ready", function(){
    var order_id = getParameterByName('ID');
    if (order_id != '') {
        $.ajax({
            type: "POST",
            url: "/ajax/ajax_boxberry_address_update.php",
            data: {ORDER_ID: order_id},
            success: function(data){
                $(".adm-bus-table-caption-title:contains('Адрес доставки')").parent(".adm-bus-table-container").find(".adm-detail-content-table tbody").append("<tr><td class=\"adm-detail-content-cell-r\"></td><td class=\"adm-detail-content-cell-r js-boxberry-change-adress\" style=></td></tr>");
                $(".js-boxberry-change-adress").html(data);
            }
        });
    } else {
        alert('Не удается получить номер заказа');
    };
});

//Получаем гет параметры из url
function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

//Функция callback для работы боксберри
function boxberry_callback(result){
    var order_id = getParameterByName('ID');
    if (order_id != '') {
        $.ajax({
            type: "POST",
            url: "/ajax/ajax_boxberry_address_update.php",
            data: {ORDER_ID: order_id, PVZ_ID: result.id,  ADDRESS: result.address, PRICE: result.price},
            success: function(data){
                $(".js-boxberry-change-adress").html(data);
                location.reload();
            }
        });
    } else {
        alert('Не удается получить номер заказа');
    };
}