function buy_certificate_popup(){
    //$('body').find('.layout').show();
    $('body').find('.certificate_popup').show();                                                
}                                               
function create_certificate_order(){
    var form_valid = true;
    var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
    // просматриваем все поля на предмет заполненности
    $(".active_certificate_block input").each(function(){
        if (!$(this).val()) {   
            form_valid = false;
            $(this).css("border-color", "red");    
        } else {
            if ($(this).attr("name") == 'natural_email' || $(this).attr("name") == 'legal_email') {                      
                if (!(pattern.test($(this).val()))) {    
                    form_valid = false;
                    $(this).css("border-color", "red");
                } else {
                    $(this).css("border-color", "#f0f0f0");   
                }       
            }                                     
        }
    });                
    // если все ок, то сабмитим
    if (form_valid) {
        var natural_person_email = $("#natural_email").val(),
        selected_tab = $(".certificate_tab_active").data("popup-block");
        $("input[name='certificate_quantity']").val($(".transparent_input").val());
        var certificate_price = parseInt($("input[name='certificate_price']").val());   
        var certificate_quantity = parseInt($(".transparent_input").val()); 
        $.ajax({
            url: '/ajax/ajax_create_certificate_order.php',
            type: "POST",
            data: {
                data: $("#certificate_form").serialize(),
                person_type: selected_tab
            }
        }).done(function(result) {
            var certificate_result = JSON.parse(result);
            if (certificate_result.status == "success") {
                order_id = certificate_result.data;
                $("#certificate_form").remove();
                if (selected_tab == "natural_person") {
                    // физ. лицо
                    var success_message = "<?= GetMessage('NATURAL_SUCCESS_MESSAGE') ?>"; 
                    $(".submit_rfi").attr("data-email", natural_person_email);  
                    $(".submit_rfi").attr("data-comment", "CERT_" + order_id);  
                    $(".submit_rfi").attr("data-orderid", "CERT_" + order_id);         
                    $(".submit_rfi").attr("data-cost", certificate_price * certificate_quantity);  
                    $(".submit_rfi").click();
                    $("<span>" + success_message.replace("#NUM#", order_id) + "</span>").insertBefore(".certificate_popup_close");
                    $(".certificate_popup_close").click();
                } else {
                    // юр. лицо
                    var success_message = "<?= GetMessage('LEGAL_SUCCESS_MESSAGE') ?>";
                    $("<span>" + success_message.replace("#NUM#", order_id) + "</span>").insertBefore(".certificate_popup_close");
                    $(".certificate_popup_close").click();
                }
            } else {
                console.error(certificate_result.data);
            }
        });
    }
}
// переключение табов в попапе
$(".certificate_buy_type li").click(function() {
    if(!$(this).hasClass("certificate_tab_active")) {
        $(".certificate_buy_type li").removeClass("certificate_tab_active");
        $(this).addClass("certificate_tab_active");
        $(".popup_form_data > div").removeClass("active_certificate_block");
        $("div[class='" + $(this).data("popup-block") + "']").addClass("active_certificate_block");
    }
});
// закрытие попапа
$(".certificate_popup_close").click(function(){
    $(".certificate_popup").hide();
    $('.layout').hide();
})