$(document).on("ready", function(){                                                                              
    $.ajax({
        type: "POST",                                               
        url: "/ajax/ajax_boxberry_address_update.php",
        data: {ORDER_ID: '92721'},
        success: function(data){            
            $(".adm-detail-content-table tbody").append("<tr><td class=\"js-boxberry-change-adress\"></td></tr>");
            $(".js-boxberry-change-adress").html(data);
        }
    });   
    function boxberry_callback(result){ 
        window.boxberry_result = result;
        //setAddressDataBoxberry(result);
        //fitDeliveryDataBoxberry(result.period, result.price);
        console.log(result);
    }             
});                   