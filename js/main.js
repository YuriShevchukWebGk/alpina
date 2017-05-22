//Обрезка длинных названий
function truncate(str, maxlength){
    if (str.length > maxlength){
        return str.slice(0, maxlength-3) + '...';
    }
    return str;
}

//Инициализация анимации кружка в слайдере
function roundSliderCall(slideNum){

    $('.circle'+slideNum).circleProgress({
        value: 1.0,
        size: 44,
        startAngle:0,
        fill: {
            color: ["#586D62"]
        },
        emptyFill:"#82928A",
        animation: {
            duration: 4000,
            easing: 'circleProgressEasing'
        }
    });
}

//Инициализация анимации смены слайда(главная)
function roundSliderCallRotate(){//alert(slideNumer);
    if ($('.roundSlider li').length == slideNumer){
        $('.slideWrapp ul').animate({left:0},500);
    }else{
        var slideWidth = $('.slideWrapp li').css('width').slice(0, -2);
        $('.slideWrapp ul').animate({left: -(slideWidth*(slideNumer))+'px'},500);
    }

    if($('.roundSlider li').length == slideNumer){
        slideNumer = 1;
    }else{
        slideNumer++;
    }

    roundSliderCall(slideNumer);
}
//Инициализация анимации смены слайда(категория)
function roundSlCallRotateCateg(){
    if ($('.roundSlideWrapp li').length == slideNumRound){
        $('.roundSlideWrapp ul').animate({left:0},500);
    }else{
        var slideWidth = $('.roundSlideWrapp li').css('width').slice(0, -2);
        slideWidth = +slideWidth + 2;
        $('.roundSlideWrapp ul').animate({left: -(slideWidth*(slideNumRound))+'px'},500);
    }

    if($('.roundSlideWrapp li').length == slideNumRound){
        slideNumRound =1;
    }else{
        slideNumRound++;
    }

    roundSliderCall(slideNumRound);
}

// плавное скрытие блока информационного сообщения при нажатии на Х
function close_notice(id){
	$("#notice_warn").slideUp();
	$.cookie('notice_warn', id, {path: '/', expires: 3 });
}
//отправка главы
function sendchapter(bookid) {
	$(".takePartWrap button").after('<div id="loadingInfo"><div class="spinner"><div class="spinner-icon"></div></div></div>').hide();
	$.ajax({
		type: "POST",
		url: "/ajax/send_chapter.php",
		data: {email: $("#chapter-email").val(), book: bookid}
	}).done(function( strResult ) {
            if (strResult == 'ok')
				$(".takePartWrap").html("<span style='color:#00abb8;font-size:20px; font-family: \'Walshein_regular\';'>Глава отправлена</span>");
        });
};
$(document).ready(function(){
	$(".element_item_img").hover(
	  function() {
		$(this).find('img').css({'filter':'grayscale(0.7)', '-webkit-filter':'grayscale(0.7)', '-moz-filter':'grayscale(0.7)', '-o-filter':'grayscale(0.7)', '-ms-filter':'grayscale(0.7)'});
		$('.bookPreviewButton').css('display','block');
	  }, function() {
		$(this).find('img').css({'filter':'none', '-webkit-filter':'none', '-moz-filter':'none', '-o-filter':'none', '-ms-filter':'none'});
		$('.bookPreviewButton').css('display','none');
	  }
	);
    //скрывание попапа при клике по фону
    if($('.layout2').length > 0){
        $('.layout2').click(function(){
            $('.layout2').hide();
            $('.contacsFormMessage').hide();
        })
    }
    //скрытие текста в карточке товара
    if($('.showAllWrapp').length > 0){
        if($('.showAllWrapp').css('height').slice(0,-2) > 558){
            $('.showAllWrapp').append('<p class="readMore"><span>Читать далее...</span></p>');
            $('.showAllWrapp').css('height','558px');
        }

        $('.readMore').click(function(){
            $('.showAllWrapp').css('height','auto');
            $('.readMore').hide();
        })


    }
    //Плавающая шапка на странице профиля
    $(window).on('scroll', function(){
        if($(window).scrollTop() > 210) {
            $('.top-section__edit-acc').addClass('slidingTop');    
        };    
        if($(window).scrollTop() < 210) {
            $('.top-section__edit-acc').removeClass('slidingTop');    
        };            
    })                                                       
    
    
    
    //скролящееся меню на странице оплата
    if($('.delivMenuWrapp').length > 0){
        heightFromElement = $(".delivMenuWrapp").offset().top;
        $(window).scroll(function(){
            console.log(!($('.delivMenuWrapp').hasClass('slidingDelivMenu')) && ($(window).scrollTop() > $(".delivMenuWrapp").offset().top));
			var scrollBottom = $(window).scrollTop() + $(window).height();
            if(!($('.delivMenuWrapp').hasClass('slidingDelivMenu')) && ($(window).scrollTop() > $(".delivMenuWrapp").offset().top)){
                $('.delivMenuWrapp').addClass('slidingDelivMenu');
            }
            if(($('.delivMenuWrapp').hasClass('slidingDelivMenu')) && (($(window).scrollTop() < heightFromElement) || scrollBottom > 3000)){
                $('.delivMenuWrapp').removeClass('slidingDelivMenu');
				//alert($('footer').height());
            }
        })
        /*
        window.onscroll = function(heightFromElement){
        alert(!($('.delivMenuWrapp').hasClass('slidingDelivMenu')) && ($(window).scrollTop() > heightFromElement));
        if(!($('.delivMenuWrapp').hasClass('slidingDelivMenu')) && ($(window).scrollTop() > heightFromElement)){

        }*/
        /*else{
        console.log(2);
        $('.delivMenuWrapp').addClass('slidingDelivMenu');
        }*/

        /*}*/

    }



    if($('.wishlist_info').length > 0){
        $('.layout').click(function(){
            if($('.wishlist_info').css('display') == 'block'){
                $(this).hide();
                $('.wishlist_info').hide();
            }
        })
    }



    if($('.videoWrapp').length > 0){
        $('.videoWrapp iframe:nth-child(1)').show();
    }
    if($('.productSelectTitle').length > 0){
        $('.productSelectTitle').click(function(){
            $('.videoWrapp iframe').show();
            return false;
        })
    }

    if($(".some_info").length > 0){
        $('.layout').click(function(){
            $('.some_info').hide();
            $(this).hide();
        })
    }

    if($(".certificate_popup").length > 0){
        $('.layout').click(function(){
            $('.certificate_popup').hide();
            $(this).hide();
        })
    }
    
    if($(".subscr_result").length > 0){
        $('.layout').click(function(){
            $('.subscr_result').hide();
            $(this).hide();
        })
    }

    // скрывать блок списка купивших в дар книгу при нажатии на свободном месте окна браузера
    if($(".gifted_books_buyers_list").length > 0){
        $('.layout').click(function(){
            $('.gifted_books_buyers_list').hide();
            $(this).hide();
        })
    }


    // функционал "Где мой заказ"

    $("#check-order").click(function(){
        $("#info-order").slideUp();
        $.ajax({
            type: "POST",
            url: "/ajax/whereOrder.php",
            data: { orderID: $("#order-id").val() }
        }).done(function( strResult ) {
            var obj = jQuery.parseJSON(strResult);
            if(obj[0]=="error") {
                $(".error_message").html("Заказ №"+$("#order-id").val()+" не найден.");
                $(".error_message").slideDown();

            } else if (obj[0] == "error_auth") {
                $(".error_message").html("Пожалуйста, авторизуйтесь для использования функционала 'Где мой заказ?'");
                $(".error_message").slideDown();
            } else {
                $(".error_message").slideUp();
                $("#status-value").html(obj[0]);
                $("#change-value").html(obj[1]);
                $("#info-order").slideDown();
            }
        });
    })

   if($('.basketItems').length > 0){
        var GetArr = parseGetParams();
        if(GetArr.liked == "yes"){
            $('.cartMenuWrap .basketItems').removeClass('active');
            $('.cartMenuWrap .basketItems:nth-child(2)').addClass('active');
            $('#cardBlock1').hide();
            $('#cardBlock2').show();

        }
    }

    // функционал "Книга в подарок"
    /*$(".giftWrap input[type=button]").click(function(){
    $.post("/ajax/request_add.php", {email: $(".giftWrap input[type=text]").val()}, function(data){
    $(".layout").show();
    $(".some_info").show();
    $(".some_info").html(data);
    })
    });*/

    $(".giftWrap input[type=button]").click(function(){

        CheckRequestFields();
    });

    // скрывать всплывайки при нажатии на любом свободном месте
    $(".some_info").click(function(){
        $(".some_info").hide();
        $(".layout").hide();
    });

    // скрывать стрелки слайдера, если элементов меньше 6
    if ($(".saleSlider ul li").size() < 6)
    {
        $(".saleSlider .left").hide();
        $(".saleSlider .right").hide();
    }

    if ($(".otherEasySlider ul li").size() < 6)
    {
        $(".otherEasySlider .left").hide();
        $(".otherEasySlider .rigth").hide();
    }

    // если блок "Мероприятия товара" отображается - поправить вёрстку страницы автора

    if ($(".autorInfo .events").css("display") == "block")
    {
        $(".content").css("min-height", "840px");
    }

    if ($(".autorInfo .textWrap").height() > 300)
    {
        $(".content .catalogWrapper").css("height", $(".autorInfo .textWrap").height() + 100 + "px");
    }

    //позиционирование всплывающего блока купивших в дар данную книгу

    if($('.ask_form_for_gift').length > 0){
        $('.ask_form_for_gift').click(function(e){
            e.preventDefault();
            $('.layout').show();

            var window_width = $(window).width();
            var block_top_coordinate = window.pageYOffset + (window.innerHeight / 2);
            var block_left_coordinate = window_width / 2 - ($('.gift_popup_form').width() / 2);
            $('.gift_popup_form').css({
                "top" : block_top_coordinate,
                "left": block_left_coordinate
            });
            $(".item_id").attr("value", $(this).find(".giftBook").attr("data-id"));
            $('.gift_popup_form').show();
        })
    }

    // вызов функции оформления заказа и вызова формы оплаты на данную книгу, покупаемую в дар
    $(".gift_button").on("click", function(){
        var item_id = $(".item_id").attr("value");
        console.log(isEmail($(".gift_email").val()));
        if (isEmail($(".gift_email").val()) != false) {
            add_giftbook($(".buyer_name").val(), item_id, $(".gift_quantity").val(), $(".gift_email").val());
        }
    })

    // позиционирование всплывающего блока формы ввода пользовательских полей для покупки книги в дар
    if($('.gift_popup_form').length > 0){
        $('.layout').click(function(){
            if($('.gift_popup_form').css('display') == 'block'){
                $(this).hide();
                $('.gift_popup_form').hide();
            }
        })
    }

    if($('#authorisationPopup').length > 0){
        $('#authorisationPopup').click(function(e){
            e.preventDefault();
            $('.layout').show();

            var winH = $(window).height();
            var winW = $(window).width();
            var blokT = winH / 2 - ($('.authorisationWrapper').height() / 2);
            var blokL = winW / 2 - ($('.authorisationWrapper').width() / 2);
            $('.authorisationWrapper').css({
                "top" : blokT,
                "left": blokL
            });

            $('.authorisationWrapper').show();
        })
    }

    if($('#authorisationClose').length > 0){
        $('#authorisationClose, .layout').click(function(){
            $('.layout').hide();
            $('.authorisationWrapper').hide();
        })
    }
    if($('.signinWrapper').length > 0){
        $('.registrationLink').click(function(){
            $(this).addClass('active');
            $('.signinLink').removeClass('active');
            $('.signinBlock').hide();
            $('.registrationBlock').show();
        });
        $('.signinLink').click(function(){
            $(this).addClass('active');
            $('.registrationLink').removeClass('active');
            $('.signinBlock').show();
            $('.registrationBlock').hide();
        })
    }
    
    if ($('.hidingBasketRight').length > 0 || $('#basket_container').length > 0 ) {
        update_quant();                                               
    } 

    if ($(".hidingBasketRight .basketBooks .basketBook").length == 0)
    {
        $(".BasketQuant").css("display", "none");
    }
    //плавающий блок в карточке товара
    /*if(('.productElementWrapp').length >0){
    if ($(window).scrollTop() > $('.productAction').offset().top + $('.productAction').height() ){
    $('.priceBasketWrap').css({'position':'fixed', 'top':'20px', 'left':'20px'})
    };
    }*/
    //картока товара. Раскрытие торговых предложений
    if ($('.elementDescriptWrap .otherTypes').length > 0){
        $('.elementDescriptWrap .otherTypes').click(function(){
            var wrapBlockHeight = $('.typesOfProduct').height();
            var countType = $('.productType').length;
            var BLOCKSINLINE = 3;//это так по дизайну
            var lines = Math.ceil(countType/BLOCKSINLINE);
            if ($('.typesOfProduct').height() < 180)
            {
                $('.typesOfProduct').height(wrapBlockHeight*lines);
            }
        });
    };

    //купон в корзине
    if ($('.promocode').length > 0){
        $('.promocode').click(function(){
            $('#couponInp').toggle();
        })
    };

    //авторы скролл по алфавиту
    if ($('.alphabet').length > 0){
        $('.alphabet span').click(function(){
            $(window).scrollTop($('#letterBlock'+$(this).attr("data-id")).offset().top);
        });
    };


    //смена блоков в корзине
    if($('.cartMenuWrap .basketItems').length > 0){
        $('.cartMenuWrap .basketItems').click(function(){
            $('.cartMenuWrap .basketItems').removeClass("active");
            $(this).addClass("active");
            $('.yourBooks').hide();
            $('#cardBlock'+$(this).attr('data-id')).show();
        })
    }


    //смена блоков на детальной карточке
    if($('.productElementWrapp').length >0){
        $('.productsMenu li').click(function(){
            $('.productsMenu li').removeClass('active');
            $(this).addClass('active');
            $('#prodBlock1, #prodBlock2, #prodBlock3, #prodBlock4, #prodBlock5').hide();
            $('#prodBlock'+$(this).attr('data-id')).show();
            if (!$(".productsMenu li:first-child").hasClass("active"))
            {
                //$(".productsMenu li:first-child").css("width", "90px");
            }
            else
            {
               // $(".productsMenu li:first-child").css("width", "110px");
            }
            if ($(".productsMenu li:nth-child(2)").hasClass("active"))
            {
                //$(".productsMenu li:nth-child(2)").css("width", "105px");
            }
            else
            {

            }
            $(".productsMenu li:not(:first-child, :nth-child(2))").each(function(){
                if (!$(this).hasClass("active"))
                {
                   // $(this).css("width", "80px");
                }
                else
                {
                  //  $(this).css("width", "91px");
                }
            });
            if ($("#prodBlock3").css("display") == "block") {
                $("#prodBlock3").css("height", $(".ReviewsFormWrap").height() + 90);
            }
        })
    }




    //в категориях смена болоков
    $('.filterParams p').click(function(){
        $('.filterParams li').removeClass("active");
        $(this).parent('li').addClass("active");
        $('.otherBooks').hide();
        $('#block'+ $(this).attr("data-id")).show();

    })


    //история заказов(переключение заказов)

    $('.historyBodywrap .ordTitle').click(function(){
        $('.historyBodywrap .orderNumbLine').removeClass("active");
        $(".hiddenOrderInf").hide();
        $(this).parent('div').addClass('active');
        var idOrder = $(this).attr('data-id');
        $(".hidOrdInfo"+idOrder).show();
    })

    //Вызываем слайдер на странице поиск(Те что искали, купили)
    if($('.bookEasySlider').length > 0){
        easySlider('.bookEasySlider', 6);
    }
    //слайдер на странице категории(снизу(вам также может быть интересно))
    if($('.otherEasySlider').length > 0){
        easySlider('.otherEasySlider',6);
    }
    if($('.authorBoolSlider').length >0){
        easySlider('.authorBoolSlider',6);
    }

    if($('.uLookSlider').length > 0){
        easySlider('.uLookSlider',6);
    }

    if($('.bestSlider').length > 0){
        easySlider('.bestSlider', 5);
    }

    if ($(".bestSlider ul li").size() < 6)
    {
        $(".bestSlider .left").hide();
        $(".bestSlider .rigth").hide();

    }

    if ($(".authorBoolSlider ul li").size() < 6)
    {
        $(".authorBoolSlider .left").hide();
        $(".authorBoolSlider .rigth").hide();

    }
    // отображение блоков на странице регистрации/авторизации

    if ($(".signinLink").hasClass("active")) {
        $(".registrationBlock").hide();
        $(".signinBlock").show();
    }

    //плагин кастомизации селектов в оформлении заказа
    if($('.userCountry').length > 0){
        $('.userCountry').selectric();
    }
    if($('.userCity').length > 0){
        $('.userCity').selectric();
    }



    //плагин кастомизации селектов в оформлении заказа
    if($('.userCountry').length > 0){
        $('.userCountry').selectric();
    }
    if($('.userCity').length > 0){
        $('.userCity').selectric();
    }

    //Проверяем наличие слайера на странице(с анимированными кругамин а главной)
    if($('.slideWrapp ul').length >0){
        //номер слайда(с анимированными кругами)
        slideNumer = 1;
        roundSliderCall(slideNumer);
        //Вызов смены слайда
        interval = setInterval(roundSliderCallRotate, 4000);
    }
    //Измение слайда по клику(слайдер с анимированными кружками)
    $('.slideWrapp .buttons').click(function(e){
        e.preventDefault();
        clearInterval(interval);
        slideNumer = $(this).attr('data-number');
        roundSliderCall(slideNumer);
        interval = setInterval(roundSliderCallRotate, 4000);
        var slideWidth = $('.slideWrapp li').css('width').slice(0, -2);
        $('.slideWrapp ul').animate({left: -(slideWidth*(slideNumer-1))+'px'},500);
    })

    //Проверка и подключение слайдера с кругами на странице категории
    if($('.roundSlideWrapp ul').length > 0){
        slideNumRound = 1;
        roundSliderCall(slideNumRound);
        interval = setInterval(roundSlCallRotateCateg, 4000);
    }
    //Измение слайда по клику(слайдер с анимированными кружками страница категории)
    $('.roundSlideWrapp .buttons').click(function(e){
        e.preventDefault();
        clearInterval(interval);
        slideNumRound = $(this).attr('data-number');
        roundSliderCall(slideNumRound);
        interval = setInterval(roundSlCallRotateCateg, 4000);
        var slideWidth = $('.roundSlideWrapp li').css('width').slice(0, -2);
        $('.roundSlideWrapp ul').animate({left: -(slideWidth*(slideNumRound-1))+'px'},500);
    })








    //меню на странице категории(левое)
    $('.categoryWrapper .leftMenu .firstLevel>li>a').click(function(){
        if ($(this).find("p").hasClass('activeListName')) {
            $('.categoryWrapper .leftMenu li ul').hide();
            $(this).find("p").removeClass('activeListName');
        }else{
            $('.categoryWrapper .leftMenu>ul>li>p').removeClass('activeListName');
            $(this).find("p").addClass('activeListName')
            $('.categoryWrapper .leftMenu li ul').hide();
            $(this).parent('li').find('ul').show();
        }
    })

    $('.hidingCatalogLeft .firstLevel>li>a').click(function(){
        if ($(this).find("p").hasClass('activeListName')) {
            $('.hidingCatalogLeft li ul').hide();
            $(this).find("p").removeClass('activeListName');
        }else{
            $('.hidingCatalogLeft .leftMenu>ul>li>p').removeClass('activeListName');
            $(this).find("p").addClass('activeListName')
            $('.hidingCatalogLeft li ul').hide();
            $(this).parent('li').find('ul').show();
        }
    })


    var basketOpenFlag = false;
    //Открытие всплывающего каталога
    $('.catalogIcon, .headCatalog, .ContentcatalogIcon, .howToCatalogWrapper').click(function(){
        $('.hidingCatalogLeft, .layout').toggle();
    })
    //Лткрытие всплывающей корзины
    $('.basketIcon, .headBasket, .ContentbasketIcon, .howToBasketWrapper').click(function(basketOpenFlag){
        $('.hidingBasketRight, .layout, .windowClose').toggle();

        if($('.hidingBasketRight, .layout, .windowClose').css('display') == 'block'){
            $('html').css('overflow','hidden');
        }else{
            $('html').css('overflow','auto');
        }

    })

    //закртытие боковых меню
    $('.windowClose').on('click', function(){
        $(this).closest(".hidingBasketRight").hide();
        $(".hidingCatalogLeft").hide();
        $('.layout').hide();
        $('.windowClose').hide();
        $('html').css('overflow','auto');
    })

    $('.layout').on('click', function(){
        if ($(".hidingBasketRight").css("display") == "block")
        {
            $(".hidingBasketRight").hide();
            $('.windowClose').hide();
            $('html').css('overflow','auto');
        }
        if ($(".hidingCatalogLeft").css("display") == "block")
        {
            $(".hidingCatalogLeft").hide();
        }
        $('.layout').hide();
    })

    //Верхнее меню на главной
    $(window).scroll(function(){
        $('.slidingTopMenu').show();
        /*$(".footer_search_form").html($(".searchWrap .catalogWrapper").html());
        $(".searchWrap .catalogWrapper").html("");
        $(".headFind").each(function(){
        $(this).removeClass("headFind");
        $(this).addClass("headFindCatalog");
        });*/
        if($(window).scrollTop() == 0){
            $('.slidingTopMenu').hide();
            /*$(".searchWrap .catalogWrapper").html($(".footer_search_form").html());
            $(".footer_search_form").html("");
            $(".headFindCatalog").each(function(){
            $(this).removeClass("headFindCatalog");
            $(this).addClass("headFind");
            });*/

        }
    })

    $(".bookName").each(function()
        {
            if($(this).length > 0)
            {
                $(this).html(truncate($(this).html(), 32));
            }
        }
    );





    $('.slideWrapp li').css('width',$(window).width()+'px');



    var widthOfSlide = '196px';
    var intwidthOfSlide = 196;
    var countLi = $('.saleWrapp ul li').size();
    if (countLi < 6)
    {
        $(".saleWrapp .left").hide();
        $(".saleWrapp .right").hide();
    }
    //alert(attrLeft[0]);
    $(".saleWrapp .right").on("click", function(){
        attrLeft = $(".saleWrapp ul").css("left").split("px");
        if (attrLeft[0] <= -(countLi-7)*intwidthOfSlide)
        {
            $('.saleWrapp .right').hide();
        }
    });

    $(".otherEasySlider .right").on("click", function(){
        attrLeft = $(".otherEasySlider ul").css("left").split("px");
        if (attrLeft[0] <= -(countLi-7)*intwidthOfSlide)
        {
            $('.otherEasySlider .rigth').hide();
        }
    });

     $(".authorBoolSlider .rigth").on("click", function(){
        $(".authorBoolSlider .left").show();
        attrLeft = $(".authorBoolSlider ul").css("left").split("px");
        if (attrLeft[0] <= -(countLi-7)*intwidthOfSlide)
        {
            $('.authorBoolSlider .rigth').hide();
        }
    });

    $(".authorBoolSlider .left").on("click", function(){
        $(".authorBoolSlider .rigth").show();
        if ($(".authorBoolSlider ul").css("left") == '-'+widthOfSlide)
        {
            $('.authorBoolSlider .left').hide();
        }
    });

    var ulWidth = (countLi-7) * widthOfSlide.slice(0, -2);

    $('.saleWrapp .left').click(function(){
        $('.saleWrapp ul').animate({left:'+='+ widthOfSlide},500);
        $('.saleWrapp .right').show();

        if($('.saleWrapp ul').css('left') == '-'+widthOfSlide){
            $('.saleWrapp .left').hide();
        }
    })

    $('.otherEasySlider .left').click(function(){
        $('.otherEasySlider ul').animate({left:'+='+ widthOfSlide},500);
        $('.otherEasySlider .rigth').show();

        if($('.otherEasySlider ul').css('left') == '-'+widthOfSlide){
            $('.otherEasySlider .left').hide();
        }
    })

    $('.saleWrapp .right').click(function(){
        $('.saleWrapp ul').animate({left:'-='+ widthOfSlide},500);
        $('.saleWrapp .left').show();

        if($('.saleWrapp ul').css('left') == '-'+ulWidth+'px'){
            $('.saleWrapp .right').hide();
        }
    })
    if($('.saleWrapp ul').css('left') == '0px'){
        $('.saleWrapp .left').hide();
    }

    var widthOfSlideReccomend = '196px';
    var intwidthOfSlideReccomend = 196;
    var countLiRec = $('.recomendation ul li').size();
    if (countLiRec < 7)
    {
        $(".recomendation .left").hide();
        $(".recomendation .right").hide();
    }
    var ulWidthRec = (countLi-7) * widthOfSlideReccomend.slice(0, -2);
    $(".recomendation .right").on("click", function(){
        attrLeft = $(this).closest(".recomendation").find("ul").css("left").split("px");
        if (attrLeft[0] <= -(countLi-7)*intwidthOfSlideReccomend)
        {
            $(this).hide();
        }
    });
    $('.recomendation .left').click(function(){
        $(this).closest(".recomendation").find("ul").animate({left:'+='+ widthOfSlideReccomend},500);
        $(this).closest(".recomendation").find(".right").show();

        if($(this).closest(".recomendation").find("ul").css('left') == '-'+widthOfSlideReccomend){
            $(this).closest(".recomendation").find(".left").hide();
        }
    })
    $('.recomendation .right').click(function(){
        $(this).closest(".recomendation").find("ul").animate({left:'-='+ widthOfSlideReccomend},500);
        $(this).closest(".recomendation").find(".left").show();

        if($(this).closest(".recomendation").find("ul").css('left') == '-'+ulWidthRec+'px'){
            $(this).closest(".recomendation").find(".right").hide();
        }
    })
    $(".recomendation").each(function(){
        if($(this).find('ul').css('left') == '0px'){
            $(this).find('.left').hide();
        }
    });


    //Слайдер отзывы
    /*var widthOfSlideReview = '389px';
    var countLiReview = $('.bigSlider ul li').size();
    var ulWidthRewiew = (countLiReview-3)*widthOfSlideReview.slice(0,-2);
    $('#left').click(function(){
    if ($('.bigSlider ul').css('left') == '0px') {
    $('.bigSlider ul').animate({left:'-'+ulWidthRewiew+'px'},500);
    }else{
    $('.bigSlider ul').animate({left:'+='+ widthOfSlideReview},500);
    }
    })
    $('#right').click(function(){
    if (($('.bigSlider ul').css('left') == '-'+ulWidthRewiew+'px') || ($('.bigSlider ul').css('left') == ulWidthRewiew+'px') || (countLiReview < 4)) {
    $('.bigSlider ul').animate({left:0},500);
    }else{
    $('.bigSlider ul').animate({left:'-='+ widthOfSlideReview},500);
    }
    })*/

    // слайдер отзывов на главной
    if (typeof fxSlider == 'function'){
        fxSlider('bigSlider','left','right', false, 500,3);
    }

    /*var quantityOfReview = $('.bigSlider ul li').length;
    var nowSlide = 1;//номер первого видимого слайда
    var reviewSlideWidth = $('.bigSlider ul li').outerWidth(true);
    var sliderEnd = (quantityOfReview-3)*reviewSlideWidth;
    $('#left').click(function(){

    if(nowSlide == 1){
    $('.bigSlider ul').animate({left:'-'+sliderEnd+'px'},500);
    nowSlide = quantityOfReview-2;
    }else{
    $('.bigSlider ul').animate({left:'+='+reviewSlideWidth+'px'});
    nowSlide--;
    }
    })
    $('#right').click(function(){
    if(nowSlide == (quantityOfReview-2)){
    $('.bigSlider ul').animate({left:0},500);
    nowSlide = 1;
    }else{
    $('.bigSlider ul').animate({left:'-='+reviewSlideWidth+'px'});
    nowSlide++;
    }
    })    */


    //убираем placeholder поиск вверху главной
    $('#title-search-input-top').focus(function(){
        $(this).data('placeholder',$(this).attr('placeholder'))
        $(this).attr('placeholder','');
    });
    $('#title-search-input-top').blur(function(){
        $(this).attr('placeholder',$(this).data('placeholder'));
    });



    //Блоки на главном начальном слайде
    var BlocksChangingFunc;
    $('.books > ul span').mouseover(function(){
        var $this = $(this);
        BlocksChangingFunc = setTimeout(function(){
            if (!$this.hasClass("active"))
            {
                //$('.book').css('display','none');
                $('.book').stop(true, true).fadeOut();
                switch ($this.attr('data-id')){
                    case "1":
                        //$('.bookNew').css('display','block');
                        $('.bookNew').delay(500).fadeIn();
                        break
                    case "2":
                        //$('.bookBest').css('display','block');
                        $('.bookBest').delay(500).fadeIn();
                        break
                    case "3":
                        //$('.bookSoon').css('display','block');
                        $('.bookSoon').delay(500).fadeIn();
                        break
                    case "4":
                        //$('.bookMust').css('display','block');
                        $('.bookMust').delay(500).fadeIn();
                        break
                };
                $('.books > ul li').removeClass('first');
                $this.parent().addClass('first');
                $('.books > ul span').removeClass('active');
                $this.addClass('active');
				$this.click(function() {
					return false;
				});
				function stopReturn() {
					setTimeout(function(){
					$this.unbind('click')}, 600 );
				}
				stopReturn();				
            }
            }, 200);

    });
    $(".books > ul span").mouseout(function(){
        clearTimeout(BlocksChangingFunc);
    })
	
	//Progress Bar START
	$('a').click(function() {
		var link = $(this).attr("href");
		var target = $(this).attr("target");
		if (!$(this).parents().hasClass('leftMenu') && !$(this).parents().hasClass('hidingCatalogLeft')) {
			if (!link.match(/([\#\(\)]|pdf|freedigitalbooks|\/personal\/cart\/|info\_popup|ADD2BASKET)/) && target != "_blank") {
				NProgress.start();
			};
		}
	});
	NProgress.set(0.6);
	setTimeout(function() { NProgress.done();}, 200);
	//Progress Bar END
});


function update_quant(sign, e)
{                  
    //изменение кол-ва в выезжающей корзине
    /*$('.hidingBasketRight .plus').on('click', function(){
    var numbOfBooks = parseInt($(this).parent().children('p').html());
    var new_count = numbOfBooks+1;
    $(this).parent().children('p').html(new_count);
    update_basket($(this), "plus");
    })
    $('.hidingBasketRight .minus').on('click', function(){
    var numbOfBooks = $(this).parent().children('p').html();
    if (numbOfBooks > '1'){
    $(this).parent().children('p').html(numbOfBooks-1);
    }
    update_basket($(this), "minus");
    })*/
    var numbOfBooks = parseInt($(e).parent().children('p').html());
    switch (sign)
    {
        case "plus":
            var new_count = numbOfBooks+1;
            $(e).parent().children('p').html(new_count);
            break;
        case "minus":
            if (numbOfBooks > 1)
            {
                $(e).parent().children('p').html(numbOfBooks-1);
            }
            break;
    }
    update_basket(e);                                                
}

function update_basket(e)
{
    var quantity = $(e).closest(".countMenu").find(".countOfBook").html();
    var id = $(e).closest(".basketBook").attr("basket-id");
    var product = $(e).closest(".basketBook").attr("product-id");
    var delay = $(e).closest(".basketBook").attr("basket-delay");
    $.post("/ajax/ajax_add2basket.php", {quantity: quantity, id: id, product: product, delay: delay, action: 'update'}, function(data){
        $(".hidingBasketRight").html(data);
        var total_quant = parseInt($(".hidingBasketRight p.count").text().replace(/\D/g, ""));
        $(".BasketQuant").html(total_quant);
    });
}

function addtocart(productid, name, product_status) {
    //product_status 22-нет в наличии;
    quantity = $(".transparent_input").val();
	$(".inBasket").hide();
	$("#loadingInfo").show();
	
	$("a.product"+productid).find(".basketBook").css("background-color", "#A9A9A9");
	
    $.post('/ajax/ajax_add2basket.php', {action: "add", productid: productid, quantity:quantity, product_status:product_status}, function(data)
        {
			$("#loadingInfo").hide();
			$(".inBasket").show();
            $(".inBasket").css("background-color", "#A9A9A9");
            $(".inBasket").html("В корзине");

            $("#wishItem_"+productid+" a").css("background-color", "#A9A9A9");
            $("#wishItem_"+productid+" a").css("color", "white");
            $("#wishItem_"+productid+" a").html("В корзине");

            $(".inBasket").closest("a").attr("href", "/personal/cart/");
            $(".inBasket").closest("a").attr("title", "Перейти в корзину");
            $("#wishItem_"+productid+" a").attr("href", "/personal/cart");
            $("#wishItem_"+productid+" a").attr("title", "Перейти в корзину");
            $(".inBasket").closest("a").removeAttr("onclick");
            $("#wishItem_"+productid+" a").removeAttr("onclick");
            if ($("a.product"+productid).length > 0)
            {
                // для раздела каталога и карточки товара
                $("a.product"+productid).find(".basketBook").css("background-color", "#A9A9A9");
                $("a.product"+productid).find(".basketBook").html("Оформить");

                // для странциы результатов поиска
                $("a.product"+productid).find(".basket").css("background-color", "#A9A9A9");
                $("a.product"+productid).find(".basket").html("Оформить");
                $("a.product"+productid + " p").css('color', '#fff');

                $("a.product"+productid).attr("href", "/personal/cart/");
                $("a.product"+productid).attr("onclick", "");
            }
            $(".BasketQuant").css("display", "block");
            $(".hidingBasketRight").html(data);
            var total_quant = parseInt($(".hidingBasketRight p.count").text().replace(/\D/g, ""));
            $(".BasketQuant").html(total_quant);
            // обновляем блок с ценой и описанием до следующей скидки
            //$(".wrap_prise_top").load(window.location.href + " .wrap_prise_top > *");
    })
}
function addtocart_fromwishlist (productid, name, product_status) {
	$(".loadingInfo_"+productid).show();
	$(".wishlistBlock").find("a#wishItem_"+productid).hide();
    $.post('/ajax/ajax_add2basketfromwishlist.php', {action: "add", productid: productid, product_status: product_status}, function(data)
        {
            $(".wishlistBlock").find("a#wishItem_"+productid).css("background-color", "#A9A9A9");
            $(".wishlistBlock").find("a#wishItem_"+productid).css("color", "white");
            $(".wishlistBlock").find("a#wishItem_"+productid).html("В корзине");
            $(".wishlistBlock").find("a#wishItem_"+productid).attr("title", "Перейти в корзину");
            $(".wishlistBlock").find("a#wishItem_"+productid).addClass("goToCart");
            $("#basket_container").html(data);
            // $("#cardBlock2").html(data[1]);
            update_wishlist();
			$(".loadingInfo_"+productid).hide();
			$(".wishlistBlock").find("a#wishItem_"+productid).show();
    })
}

/***********
*
*  добавление в корзину и автоматическое оформление заказа на книгу, покупаемую в дар
*
* @param name - название подвешенного товара
* @param productid - ID подвешенного товара в инфоблоке товаров
* @param quantity - количество подвешенного товара, добавленного в заказ
* @return data :
* в случае успешного создания заказа - ID созданного заказа с подвешенным товаром
* в противном случае передаётся строка "err" и прерывается работа функции
*
*/
function add_giftbook (name, productid, quantity, email) {
    $.post('/ajax/ajax_addgiftbook.php', {name: name, productid: productid, quantity: quantity, email: email}, function(data) {
        if (data != "err") {
            if ($("a.product" + productid).length > 0) {
                document.location.href = "/personal/order/payment/?ORDER_ID=" + data;
            }
        }
    })
}

/********
* формирование списка купивших данный подвешенный товар
*
* @param item_id - ID подвешенного товара
* @return data - HTML-код таблицы с форматированным списком купивших товар и
* соответствующее кол-во купленного товара
* @var total_buyers_count - общее купленное кол-во подвешенного товара
*
*/
function makeGiftBuyersList (item_id) {
    $.post('/ajax/making_buyers_list.php', {item_id: item_id}, function(data) {
        if (data != "") {
            $(".layout").show();
            var winW = $(window).width(),
            blokT = window.pageYOffset + ($('.gifted_books_buyers_list').width() / 2),
            blokL = winW / 2 - ($('.gifted_books_buyers_list').width() / 2),
            total_buyers_count = 0;
            $('.gifted_books_buyers_list').css({
                "top" : blokT,
                "left": blokL
            });
            $(".gifted_books_buyers_list").show();
            $(".buyers_list").html(data);
            $(".buyers_list table tr:not(:first-child)").each(function(){
                total_buyers_count += parseInt($(this).find(".rounded_number").html());
            });
            $(".rounded_summary_number").html(total_buyers_count);
        }
    })
}
function update_wishlist () {
    $.post('/ajax/upd_wishlist.php', {}, function(data)
        {
            $('.cartMenuWrap .basketItems').removeClass("active");
            $(".cartMenuWrap .basketItems:nth-child(2)").addClass("active");
            $("#cardBlock1").hide();
            $("#cardBlock2").html(data);
            $("#cardBlock2").show();
            $(".cartMenuWrap .basketItems:nth-child(2) p span").html("<span>(" + $(".wishlistBlock .wishElement").size() + ")</span>");
            if($('.cartMenuWrap .basketItems').length > 0){
                $('.cartMenuWrap .basketItems').click(function(){
                    $('.cartMenuWrap .basketItems').removeClass("active");
                    $(this).addClass("active");
                    $('.yourBooks').hide();
                    $('#cardBlock'+$(this).attr('data-id')).show();
                })
            }

    });
}
function update_sect_page(sort, direction, sect_code) {
    $.post('/ajax/update_sect_page.php', {sort: sort, direction: direction, sect_code: sect_code}, function(data)
        {
            $(".cat_block").html(data);
            if($('.bestSlider').length > 0){
                easySlider('.bestSlider', 5);
            }

            if ($(".bestSlider ul li").size() < 6)
            {
                $(".bestSlider .left").hide();
                $(".bestSlider .rigth").hide();

            }
            $(".filterParams li").removeClass("active");
            switch (sort) {
                case "popularity":
                    $(".filterParams li:first-child").addClass("active");
                    break;
                case "date":
                    $(".filterParams li:nth-child(2)").addClass("active");
                    break;
                case "price":
                    $(".filterParams li:nth-child(3)").addClass("active");
                    break;
            }
            if (sort != "popularity" && direction == "desc") {
                $(".filterParams li.active").addClass("dir_desc");
            }
            $(".filterParams li.active").on("click", function(){
                if (direction == "asc")
                {
                    update_sect_page (sort, "desc", sect_code);
                }
                else if (sort != "popularity")
                {
                    update_sect_page (sort, "asc", sect_code);
                }
            })

            if (($(".filterParams li:nth-child(2)").hasClass("active")) && (direction == "desc"))
            {
                $(".filterParams li:nth-child(2)").css("width", "153px");
            }

            $('.categoryWrapper .leftMenu .firstLevel>li>a').click(function(){
                if ($(this).find("p").hasClass('activeListName')) {
                    $('.categoryWrapper .leftMenu li ul').hide();
                    $(this).find("p").removeClass('activeListName');
                }else{
                    $('.categoryWrapper .leftMenu>ul>li>p').removeClass('activeListName');
                    $(this).find("p").addClass('activeListName')
                    $('.categoryWrapper .leftMenu li ul').hide();
                    $(this).parent('li').find('ul').show();
                }
            })
    });
}

function delete_basket_item(productid) {

    $.post('/ajax/ajax_deletefrombasket.php', {productid: productid}, function(data)
        {
            $(".hidingBasketRight").html(data);
            var total_quant = parseInt($(".hidingBasketRight p.count").text().replace(/\D/g, ""));
            $(".BasketQuant").html(total_quant);
    })
}

function delete_wishlist_item(id) {

    $.post("/ajax/ajax_deletefromwishlist.php", {id: id}, function(data){
        if ($("#cardBlock2").size() > 0)
        {
            $("#cardBlock2").html(data);
            $(".cartMenuWrap .basketItems:last-child span").html("(" + $(".wishlistBlock .wishElement").size() + ")");
        }
        else
        {
            $(".wishlistWrapp").html(data);
            $(".wishBookDescription").each(function()
                {
                    if($(this).length > 0)
                    {
                        $(this).html(truncate($(this).html(), 250));
                    }
            });
        }
    });
}

function parseGetParams() {
    var $_GET = {};
    var __GET = window.location.search.substring(1).split("&");
    for(var i=0; i<__GET.length; i++) {
        var getVar = __GET[i].split("=");
        $_GET[getVar[0]] = typeof(getVar[1])=="undefined" ? "" : getVar[1];
    }
    return $_GET;
}



function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
function isTelephone(telephone){
    //var regex = /^((8|\+7)[\- ]?)?(\(?\d{3,4}\)?[\- ]?)?[\d\- ]{5,10}$/;
var regex = /^((\+[0-9]{1})[\- ]?)?(\(?\d{3,4}\)?[\- ]?)?[\d\- ]{5,10}$/;
    return regex.test(telephone);
}


/*function CheckingExistingEmail() {
$.post('/ajax/CheckingExistingEmail.php', {email: $("#ORDER_PROP_6").val()}, function(data)
{
//$("#hidden_email").html($("#ORDER_PROP_6").html());
$("#ORDER_PROP_6").attr("value", data);
chekingFields("Y");
})
} */

function chekingFields(parametr){
    var flag = true;
    /*$('input.clientInfo').each(function(){
    if($(this).val() == ""){
    flag = false;
    $(this).parent("div").children(".warningMessage").show();
    }else{
    $(this).parent("div").children(".warningMessage").hide();
    }
    })*/

    if($('#ORDER_PROP_7').val() == ''){
        flag = false;
        $('#ORDER_PROP_7').parent("div").children(".warningMessage").show();
        // сперва получаем позицию элемента относительно документа
        var scrollTop = $('#ORDER_PROP_7').offset().top;
        $(document).scrollTop(scrollTop);
        document.getElementById("ORDER_PROP_7").focus();
    }

    if(isEmail($('#ORDER_PROP_6').val()) == false){
        flag = false;
        $('#ORDER_PROP_6').parent("div").children(".warningMessage").html('Некорректно введен e-mail');
        $('#ORDER_PROP_6').parent("div").children(".warningMessage").show();
        var scrollTop = $('#ORDER_PROP_6').offset().top;
        $(document).scrollTop(scrollTop);
        document.getElementById("ORDER_PROP_6").focus();
    }

    if(isTelephone($('#ORDER_PROP_24').val()) == false){
        flag = false;
        $('#ORDER_PROP_24').parent("div").children(".warningMessage").show();
        var scrollTop = $('#ORDER_PROP_24').offset().top;
        $(document).scrollTop(scrollTop);
        document.getElementById("ORDER_PROP_24").focus();
    }
    var deliveryFlag= false;
    $('input[name=DELIVERY_ID]').each(function(){
        if($(this).prop("checked")){
            deliveryFlag = true;
        }
    })
    if(deliveryFlag == false){
        flag = false;
        $('.deliveriWarming').show();
    }

    if($('#ORDER_PROP_7').val() == false){
        flag = false;
        $('#ORDER_PROP_7').parent("div").children(".warningMessage").show();
    }


    if(flag){
        submitForm(parametr);
    }

    return false;
}

function updateSearchPage() {

    $('.showMore').hide();

    $(".bookName").each(function() {
        if($(this).length > 0) {
            $(this).html(truncate($(this).html(), 20));
        }
    });

    /*$(".descrWrap .bookNames").each(function()
    {
    if($(this).length > 0)
    {
    $(this).html(truncate($(this).html(), 50));
    }
    });*/
    $(".descrWrap .description").each(function() {
            if($(this).length > 0) {
                $(this).html(truncate($(this).html(), 120));
            }
    });
    if($('.bookEasySlider').length > 0) {
        easySlider('.bookEasySlider', 6);
    }
}

//book subscribe (in product card)
function newSubFunction(submitButton){
    var book_id = submitButton.previousElementSibling.dataset.book_id;
    var sub_mail = submitButton.previousElementSibling.value;
    var re = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(re.test(sub_mail)){
        $.post("/ajax/book_subscribe.php", {
            book_id : book_id,
            sub_mail : sub_mail
            }, function(data) {
                if(data.match(/exist/)){
                    $(".subscr_result").html("Вы уже подписаны на появление данной книги в продаже");
                    $(".layout").show();
                    $(".subscr_result").show();
                    //alert("Вы уже подписаны на появление данной книги в продаже.");
                }else if(data.match(/success/)){
                    $(".subscr_result").html("Мы сообщим Вам о появлении книги");
                    $(".layout").show();
                    $(".subscr_result").show();
                    //alert("Мы сообщим Вам о появлении книги.");
                }
        });
    }
    else
    {
        $(".subscr_result").html("Введите корректный e-mail адрес.");
        $(".subscr_result").show();
        $(".layout").show();

    }
}

function CheckRequestFields() {
    var emailAddres = $('.giftWrap input[type=text]').val();
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (regex.test(emailAddres))
    {
        $.post("/ajax/request_add.php", {email: $(".giftWrap input[type=text]").val()}, function(data){
            $(".layout").show();
            $(".some_info").show();
            $(".some_info").html(data);
        })
    }
    else
    {
        $(".layout").show();
        $(".some_info").show();
        $(".some_info").html('Кажется, вы ошиблись в написании своего адреса');
    }
}

function SubmitRequest(e){
    if (e.keyCode == 13)
    {
        CheckRequestFields();
    }
    return false;
}

$(function() {
	$('body').append('<div style="width:64px;background:#85959a; height:64px; border-radius:80px;text-align:center; position:fixed; bottom:10px; right:10px; cursor:pointer; display:none; color:#fff; font-family:\'Walshein_black\'; font-size:40px;" id="toTop" class="no-mobile">↑</div>');
	$(window).scroll(function() {
		if($(this).scrollTop() != 0) {
			$('#toTop').fadeIn();
		} else {
			$('#toTop').fadeOut();
		}
	});
	$('#toTop').click(function() {
		$('body,html').animate({scrollTop:0},800);
	});
});

//Переключение между вкладками элетронных книги и бумажных в карточке товара
function selectversion(cl,id) {
	if (cl == "passive") {
		$("#diffversions").find(".passive").removeClass("passive").addClass("temp");
		$("#diffversions").find(".active").removeClass("active").addClass("passive");
		$("#diffversions").find(".temp").addClass("active").removeClass("temp");
	}
	if (id == "paperversion") {
		$(".paperVersionWrap, .digitalBookMark, .typesOfProduct, .shippings, .buyLater, .epubHide").show();
		$(".digitalVersionWrap, .epub").hide();
	} else {
		$(".paperVersionWrap, .digitalBookMark, .typesOfProduct, .shippings, .buyLater, .epubHide").hide();
		$(".digitalVersionWrap, .epub").show();
	}
	var bookName = $(".productName").text();
	dataLayer.push({'event' : 'selectVersion', 'action' : id+' '+cl, 'label': bookName});
	return false;
}

function docReadyComponent(id) {
	$(".element_item_img").hover(
	  function() {
		$(this).find('img').css({'filter':'grayscale(0.7)', '-webkit-filter':'grayscale(0.7)', '-moz-filter':'grayscale(0.7)', '-o-filter':'grayscale(0.7)', '-ms-filter':'grayscale(0.7)'});
		$('.bookPreviewButton').css('display','block');
	  }, function() {
		$(this).find('img').css({'filter':'none', '-webkit-filter':'none', '-moz-filter':'none', '-o-filter':'none', '-ms-filter':'none'});
		$('.bookPreviewButton').css('display','none');
	  }
	);

	//скрытие текста в карточке товара
	if($('.showAllWrapp').length > 0){
		if($('.showAllWrapp').css('height').slice(0,-2) > 558){
			$('.showAllWrapp').append('<p class="readMore"><span>Читать далее...</span></p>');
			$('.showAllWrapp').css('height','558px');
		}

		$('.readMore').click(function(){
			$('.showAllWrapp').css('height','auto');
			$('.readMore').hide();
		})


	}

	$.ajax({
		type: "POST",
		url: "/ajax/book_views.php",
		data: {id: id}
	}).done(function( strResult ) {
		$(".bookViews").html(strResult);
	 });
	 
	if($('.wishlist_info').length > 0){
		$('.layout').click(function(){
			if($('.wishlist_info').css('display') == 'block'){
				$(this).hide();
				$('.wishlist_info').hide();
			}
		})
	}



	if($('.videoWrapp').length > 0){
		$('.videoWrapp iframe:nth-child(1)').show();
	}
	if($('.productSelectTitle').length > 0){
		$('.productSelectTitle').click(function(){
			$('.videoWrapp iframe').show();
			return false;
		})
	}

	if($(".some_info").length > 0){
		$('.layout').click(function(){
			$('.some_info').hide();
			$(this).hide();
		})
	}

	if($(".subscr_result").length > 0){
		$('.layout').click(function(){
			$('.subscr_result').hide();
			$(this).hide();
		})
	}

	$(".giftWrap input[type=button]").click(function(){

		CheckRequestFields();
	});

	// скрывать всплывайки при нажатии на любом свободном месте
	$(".some_info").click(function(){
		$(".some_info").hide();
		$(".layout").hide();
	});

	// скрывать стрелки слайдера, если элементов меньше 6
	if ($(".saleSlider ul li").size() < 6)
	{
		$(".saleSlider .left").hide();
		$(".saleSlider .right").hide();
	}

	if ($(".otherEasySlider ul li").size() < 6)
	{
		$(".otherEasySlider .left").hide();
		$(".otherEasySlider .rigth").hide();
	}

	// если блок "Мероприятия товара" отображается - поправить вёрстку страницы автора

	if ($(".autorInfo .events").css("display") == "block")
	{
		$(".content").css("min-height", "840px");
	}

	if ($(".autorInfo .textWrap").height() > 300)
	{
		$(".content .catalogWrapper").css("height", $(".autorInfo .textWrap").height() + 100 + "px");
	}

	if($('#authorisationPopup').length > 0){
		$('#authorisationPopup').click(function(e){
			e.preventDefault();
			$('.layout').show();

			var winH = $(window).height();
			var winW = $(window).width();
			var blokT = winH / 2 - ($('.authorisationWrapper').height() / 2);
			var blokL = winW / 2 - ($('.authorisationWrapper').width() / 2);
			$('.authorisationWrapper').css({
				"top" : blokT,
				"left": blokL
			});

			$('.authorisationWrapper').show();
		})
	}

	if($('#authorisationClose').length > 0){
		$('#authorisationClose, .layout').click(function(){
			$('.layout').hide();
			$('.authorisationWrapper').hide();
		})
	}
	if($('.signinWrapper').length > 0){
		$('.registrationLink').click(function(){
			$(this).addClass('active');
			$('.signinLink').removeClass('active');
			$('.signinBlock').hide();
			$('.registrationBlock').show();
		});
		$('.signinLink').click(function(){
			$(this).addClass('active');
			$('.registrationLink').removeClass('active');
			$('.signinBlock').show();
			$('.registrationBlock').hide();
		})
	} 
                      
    //Если возникнут проблемы с корзиной нужно вернуть             
	//update_quant();


	if ($(".hidingBasketRight .basketBooks .basketBook").length == 0)
	{
		$(".BasketQuant").css("display", "none");
	}
	//плавающий блок в карточке товара
	/*if(('.productElementWrapp').length >0){
	if ($(window).scrollTop() > $('.productAction').offset().top + $('.productAction').height() ){
	$('.priceBasketWrap').css({'position':'fixed', 'top':'20px', 'left':'20px'})
	};
	}*/
	//картока товара. Раскрытие торговых предложений
	if ($('.elementDescriptWrap .otherTypes').length > 0){
		$('.elementDescriptWrap .otherTypes').click(function(){
			var wrapBlockHeight = $('.typesOfProduct').height();
			var countType = $('.productType').length;
			var BLOCKSINLINE = 3;//это так по дизайну
			var lines = Math.ceil(countType/BLOCKSINLINE);
			if ($('.typesOfProduct').height() < 180)
			{
				$('.typesOfProduct').height(wrapBlockHeight*lines);
			}
		});
	};

	//смена блоков на детальной карточке
	if($('.productElementWrapp').length >0){
		$('.productsMenu li').click(function(){
			$('.productsMenu li').removeClass('active');
			$(this).addClass('active');
			$('#prodBlock1, #prodBlock2, #prodBlock3, #prodBlock4, #prodBlock5').hide();
			$('#prodBlock'+$(this).attr('data-id')).show();
			if (!$(".productsMenu li:first-child").hasClass("active"))
			{
				//$(".productsMenu li:first-child").css("width", "90px");
			}
			else
			{
			   // $(".productsMenu li:first-child").css("width", "110px");
			}
			if ($(".productsMenu li:nth-child(2)").hasClass("active"))
			{
				//$(".productsMenu li:nth-child(2)").css("width", "105px");
			}
			else
			{

			}
			$(".productsMenu li:not(:first-child, :nth-child(2))").each(function(){
				if (!$(this).hasClass("active"))
				{
				   // $(this).css("width", "80px");
				}
				else
				{
				  //  $(this).css("width", "91px");
				}
			});
			if ($("#prodBlock3").css("display") == "block") {
				$("#prodBlock3").css("height", $(".ReviewsFormWrap").height() + 90);
			}
		})
	}


	//Верхнее меню на главной
	$(window).scroll(function(){
		$('.slidingTopMenu').show();
		/*$(".footer_search_form").html($(".searchWrap .catalogWrapper").html());
		$(".searchWrap .catalogWrapper").html("");
		$(".headFind").each(function(){
		$(this).removeClass("headFind");
		$(this).addClass("headFindCatalog");
		});*/
		if($(window).scrollTop() == 0){
			$('.slidingTopMenu').hide();
			/*$(".searchWrap .catalogWrapper").html($(".footer_search_form").html());
			$(".footer_search_form").html("");
			$(".headFindCatalog").each(function(){
			$(this).removeClass("headFindCatalog");
			$(this).addClass("headFind");
			});*/

		}
	})

	$(".bookName").each(function()
		{
			if($(this).length > 0)
			{
				$(this).html(truncate($(this).html(), 32));
			}
		}
	);





	$('.slideWrapp li').css('width',$(window).width()+'px');



	var widthOfSlide = '196px';
	var intwidthOfSlide = 196;
	var countLi = $('.saleWrapp ul li').size();
	if (countLi < 6)
	{
		$(".saleWrapp .left").hide();
		$(".saleWrapp .right").hide();
	}
	//alert(attrLeft[0]);
	$(".saleWrapp .right").on("click", function(){
		attrLeft = $(".saleWrapp ul").css("left").split("px");
		if (attrLeft[0] <= -(countLi-7)*intwidthOfSlide)
		{
			$('.saleWrapp .right').hide();
		}
	});

	$(".otherEasySlider .right").on("click", function(){
		attrLeft = $(".otherEasySlider ul").css("left").split("px");
		if (attrLeft[0] <= -(countLi-7)*intwidthOfSlide)
		{
			$('.otherEasySlider .rigth').hide();
		}
	});

	 $(".authorBoolSlider .rigth").on("click", function(){
		$(".authorBoolSlider .left").show();
		attrLeft = $(".authorBoolSlider ul").css("left").split("px");
		if (attrLeft[0] <= -(countLi-7)*intwidthOfSlide)
		{
			$('.authorBoolSlider .rigth').hide();
		}
	});

	$(".authorBoolSlider .left").on("click", function(){
		$(".authorBoolSlider .rigth").show();
		if ($(".authorBoolSlider ul").css("left") == '-'+widthOfSlide)
		{
			$('.authorBoolSlider .left').hide();
		}
	});

	var ulWidth = (countLi-7) * widthOfSlide.slice(0, -2);

	$('.saleWrapp .left').click(function(){
		$('.saleWrapp ul').animate({left:'+='+ widthOfSlide},500);
		$('.saleWrapp .right').show();

		if($('.saleWrapp ul').css('left') == '-'+widthOfSlide){
			$('.saleWrapp .left').hide();
		}
	})

	$('.otherEasySlider .left').click(function(){
		$('.otherEasySlider ul').animate({left:'+='+ widthOfSlide},500);
		$('.otherEasySlider .rigth').show();

		if($('.otherEasySlider ul').css('left') == '-'+widthOfSlide){
			$('.otherEasySlider .left').hide();
		}
	})

	$('.saleWrapp .right').click(function(){
		$('.saleWrapp ul').animate({left:'-='+ widthOfSlide},500);
		$('.saleWrapp .left').show();

		if($('.saleWrapp ul').css('left') == '-'+ulWidth+'px'){
			$('.saleWrapp .right').hide();
		}
	})
	if($('.saleWrapp ul').css('left') == '0px'){
		$('.saleWrapp .left').hide();
	}

	var widthOfSlideReccomend = '196px';
	var intwidthOfSlideReccomend = 196;
	var countLiRec = $('.recomendation ul li').size();
	if (countLiRec < 7)
	{
		$(".recomendation .left").hide();
		$(".recomendation .right").hide();
	}
	var ulWidthRec = (countLi-7) * widthOfSlideReccomend.slice(0, -2);
	$(".recomendation .right").on("click", function(){
		attrLeft = $(this).closest(".recomendation").find("ul").css("left").split("px");
		if (attrLeft[0] <= -(countLi-7)*intwidthOfSlideReccomend)
		{
			$(this).hide();
		}
	});
	$('.recomendation .left').click(function(){
		$(this).closest(".recomendation").find("ul").animate({left:'+='+ widthOfSlideReccomend},500);
		$(this).closest(".recomendation").find(".right").show();

		if($(this).closest(".recomendation").find("ul").css('left') == '-'+widthOfSlideReccomend){
			$(this).closest(".recomendation").find(".left").hide();
		}
	})
	$('.recomendation .right').click(function(){
		$(this).closest(".recomendation").find("ul").animate({left:'-='+ widthOfSlideReccomend},500);
		$(this).closest(".recomendation").find(".left").show();

		if($(this).closest(".recomendation").find("ul").css('left') == '-'+ulWidthRec+'px'){
			$(this).closest(".recomendation").find(".right").hide();
		}
	})
	$(".recomendation").each(function(){
		if($(this).find('ul').css('left') == '0px'){
			$(this).find('.left').hide();
		}
	});


	// слайдер отзывов на главной
	if (typeof fxSlider == 'function'){
		fxSlider('bigSlider','left','right', false, 500,3);
	}



	//убираем placeholder поиск вверху главной
	$('#title-search-input-top').focus(function(){
		$(this).data('placeholder',$(this).attr('placeholder'))
		$(this).attr('placeholder','');
	});
	$('#title-search-input-top').blur(function(){
		$(this).attr('placeholder',$(this).data('placeholder'));
	});

	$(".books > ul span").mouseout(function(){
		clearTimeout(BlocksChangingFunc);
	})
	
	//Progress Bar START
	$('a').click(function() {
		var link = $(this).attr("href");
		var target = $(this).attr("target");
		if (!$(this).parents().hasClass('leftMenu') && !$(this).parents().hasClass('hidingCatalogLeft')) {
			if (!link.match(/([\#\(\)]|pdf|freedigitalbooks|\/personal\/cart\/|info\_popup|ADD2BASKET)|\/personal\/profile\//) && target != "_blank") {
				NProgress.start();
			};
		}
	});
	NProgress.set(0.6);
	setTimeout(function() { NProgress.done();}, 200);
	//Progress Bar END
}