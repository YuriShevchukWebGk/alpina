$(document).ready(function(){

  $( "html, body" ).scrollTop(1);
  
  document.addEventListener("touchstart", function(){}, true);

  $(document).ajaxSuccess(function(q,w,e){
    console.log(q,w,e);
  });

  var form_label_add = function(){
    var input_text = $('input[type="text"]:not(.giftWrap input[name="email"]):not(#title-search-input-top):not(".js_changed"), input[type="password"]:not(".js_changed"), textarea:not(".js_changed")');
    if( input_text.get(0) ){
      for( i in input_text ){
        var it = input_text[i];
        if( it && it.outerHTML && it.getAttribute('placeholder') ){
          if( it.name == 'PERSONAL_PHONE' ){
            it.insertAdjacentHTML('beforebegin', '<label>Телефон</label>');
            it.setAttribute('placeholder', '');
            it.classList.add('js_changed');
          }else if( it.id != 'title-search-input' ){
            it.insertAdjacentHTML('beforebegin', '<label>'+it.getAttribute('placeholder')+'</label>');
            it.setAttribute('placeholder', '');
            it.classList.add('js_changed');
          }
        }
      }
    }
  }

  var price = function(){
    var prs = ['.bookPrice:not(.js_change)', '.price:not(.js_change)', '.priceOfBook:not(.js_change)'];
    if( prs ){
      $.each(prs, function(i, n){
        var t = $(n);
        if( t.get(0) ){
          t.each(function(){
            var tt = $(this);
            tt.addClass('js_change');
            if( tt.text().match(/Нет|(\d{1,}\s[а-я].*\s{1,})|(\d{1,}\s[а-я])|(\d{1,}\.\d{1,}\.\d{1,})/gi) ){
              if( tt.hasClass('js_no') == false ){
                tt.addClass('js_no');
              }
            }else if ( tt.text().match(/\%/gi) ){
				tt.html( tt.text().split('.')[0] +''+ '%' );
			} else {
              if( tt.hasClass('js_no') == true ){
                tt.removeClass('js_no');
              }
              if( tt.text().match( /\./gi ) ){
                tt.html( tt.text().split('.')[0] +''+ '<span class="rub"></span>' );
              }
            }
            if( tt.text().match(/дата/gi) ){
              if( tt.hasClass('js_no_text') == false ){
                tt.addClass('js_no_text');
              }
            }else{
              if( tt.hasClass('js_no_text') == true ){
                tt.removeClass('js_no_text');
              }
            }
            if( tt.find('span:last').text().match(/руб/gi) ){
              tt.find('span:last').html('<span class="rub"></span>');
            }
            console.log(tt.text().match(/руб\./gi))
            if( tt.text().match(/руб\./gi) ){
              tt.html( tt.html().replace(/руб\./, '<span class="rub"></span>') );
            }
          });
        }
      });
    }
  }
  
  // profile
  var check_password_dop_text = function(){
    var buap = $('.bx-auth-profile input[name="NEW_PASSWORD_CONFIRM"]');
    if( buap.hasClass('js_text_replaced') == false ){
      buap.addClass('js_text_replaced').after( $('.account-form > p') );
    }
  }

  var search_help = function(){
    if( $('.title-search-result:visible').is(':visible') ){
      if( $('body').hasClass('js_scroll_off') == false ){
        $('body').addClass('js_scroll_off');
      }
    }else{
      if( $('body').hasClass('js_scroll_off') == true ){
        $('body').removeClass('js_scroll_off');
      }
    }
  }

  var cart_popup = function(){
    if( $('.hidingBasketRight:visible').get(0) ){
      if( $('body').hasClass('js-cart-preview') == false ){
        $('body').addClass('js-cart-preview');
      }
    }else{
      if( $('body').hasClass('js-cart-preview') == true ){
        $('body').removeClass('js-cart-preview');
      }
    }
  }

  var cart_tottal_replacer = function(){
    if( $('#order_form_content').get(0) ){
      var totalCost = $('.totalCost:not(.js_changed)');
      var totalText = $('.totalText:not(.js_changed)');
      if( totalCost && totalText ){
        totalCost.addClass('js_changed');
        totalText.addClass('js_changed');
        totalCost.find('>span').remove();
        totalText.find('>span').remove();
        totalText.after('<div id="eski_tottal"></div>');
        totalCost.children().each(function(i,n){
          $('#eski_tottal').append('<div>'+ totalText.find('p:eq('+i+')').text() +'<span>'+ $(n).text()  +'</span></div>');
        });
        // totalCost.remove();
        // totalText.remove();
      }
    }
  }

  var catalog_splitter = function () {
    var cob = $('.x-series .otherBooks, .x-catalog .catalogBooks, .x-catalog .otherBooks, .x-search .sliderUl, .x-search .searchWidthWrapper');
    if( cob.get(0) ){
      cob.find('li:not(.js_changed)').each(function (i,n) {
        $(this).addClass('js_changed');
        if( (i+1) % 2 == 0 ){
          $(n).after('<div class="clear_2"></div>');
        }
        if( (i+1) % 3 == 0 ){
          $(n).after('<div class="clear_3"></div>');
        }
      });
      cob.find('.searchBook:not(.js_changed)').each(function (i,n) {
        $(this).addClass('js_changed');
        if( (i+1) % 2 == 0 ){
          $(n).after('<div class="clear_2"></div>');
        }
        if( (i+1) % 3 == 0 ){
          $(n).after('<div class="clear_3"></div>');
        }
      });
      cob.find('.bookWrapp:not(.js_changed)').each(function (i,n) {
        $(this).addClass('js_changed');
        if( (i+1) % 2 == 0 ){
          $(n).after('<div class="clear_2"></div>');
        }
        if( (i+1) % 3 == 0 ){
          $(n).after('<div class="clear_3"></div>');
        }
      });
    }
  }

  
  // main
  var m_b_b_n = $('.mainWrapp .books .book.bookNew');
  m_b_b_n.html( m_b_b_n.find('.coverSmall, .cover') );
  m_b_b_n.slick({
    arrows: false,
    centerMode: true,
    centerPadding: '15%',
    dots: true,
    adaptiveHeight: true,
    responsive: [
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 2000,
        settings: {
          centerMode: true,
          slidesToShow: 2,
          slidesToScroll: 2
        }
      }
    ]
  });

  $('.hintWrapp .titleMain:contains("Вам может быть интересно")').text('Интересно');
  $('.hintWrapp .titleMain:contains("Спецпредложения")').text('Скидки дня');
  $('.EditorChoiceWrapp .title:contains("Подборки книг")').text('Подборки');
  $('.allBooksWrapp .titleMain:contains("Все лучшие книги") a').text('Лучшее');
  $('.authorBooksWrapp > p:contains("Другие")').text('Еще от автора');
  $('.weRecomWrap .tile:contains("Также рекомендуем")').text('Рекомендуем');
  
  $('.saleWrapp .catalogWrapper > div:last').addClass('recomendation');
  
  $('.hintWrapp .saleSlider ul').slick({
    arrows: true,
    dots: false,
    slidesToShow: 2,
    slidesToScroll: 2,
    adaptiveHeight: true,
    responsive: [
      {
        breakpoint: 447,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          centerMode: true
        }
      },
      {
        breakpoint: 2000,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          centerMode: true
        }
      }
    ]
  });

  $('body:not(.x-catalog) .allBooksWrapp .catalogBooks').slick({
    arrows: true,
    dots: false,
    slidesToShow: 2,
    slidesToScroll: 2,
    adaptiveHeight: true,
    responsive: [
      {
        breakpoint: 447,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          centerMode: true
        }
      },
      {
        breakpoint: 2000,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          centerMode: true
        }
      }
    ]
  });

  $('.weRecomWrap .weRecomBlock').slick({
    arrows: true,
    dots: false,
    slidesToShow: 2,
    slidesToScroll: 2,
    adaptiveHeight: true,
    responsive: [
      {
        breakpoint: 447,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          centerMode: true
        }
      },
      {
        breakpoint: 2000,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          centerMode: true
        }
      }
    ]
  });

  $('.authorBoolSlider .sliderUl').slick({
    arrows: true,
    dots: false,
    slidesToShow: 2,
    slidesToScroll: 2,
    adaptiveHeight: true,
    responsive: [
      {
        breakpoint: 447,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          centerMode: true
        }
      },
      {
        breakpoint: 2000,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          centerMode: true
        }
      }
    ]
  });

  $('.reviewsWrapp .bigSlider_new ul').slick({
    arrows: true,
    dots: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    adaptiveHeight: true,
    responsive: [
      {
        breakpoint: 567,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 2000,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          centerMode: true,
          centerPadding: '20%',
        }
      }
    ]
  });
  

  var ecw = $('.EditorChoiceWrapp .books');
  ecw.html( ecw.find('a') );
  $('.EditorChoiceWrapp .books img:first').each(function(){
    var t = $(this);
    t.attr('src', t.attr('data-src'));
  });
  $('.EditorChoiceWrapp .books').slick({
    arrows: true,
    dots: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    adaptiveHeight: true,
    responsive: [
      {
        breakpoint: 567,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 2000,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          centerMode: true
        }
      }
    ]
  });

  $('.headBasket').on('click', function(){
    //$( "html, body" ).scrollTop(0);
	window.location.href = "/personal/cart/";
  });

  //contact
  $('.contactsTextWrap').after( $('.contactsFormWrap') );

  //delivery
  $('.deliveryTypeWrap').each( function(){
    var t = $(this);
    var tt = t.find('.title');
    if( !tt.get(0) ){
      t.show();
    }else{
      t.before( '<a href="javascript:void(0)">'+ tt.text() +'</a>' );
      tt.remove();
    }
  } );
  $('.deliveryTextWrap > a').on('click', function(){
    var t = $(this);
    t.siblings('.js_active').removeClass('js_active');
    t.addClass('js_active');
    $('html,body').animate({scrollTop: t.offset().top }, 300);
  });

  // events
  $('#events_wrap .bx-newslist .bx-newslist-container').each(function(){
    var a = $(this).find('> a');
    var div = $(this).find('> a + div');
    if( div.get(0) ){
      a.append(div);
    } 
  });

  // menu
  $( "#navigation .first_menu > span" ).load( "/ .books > ul" );
  if( $('#navigation .top').children().size() == 0 ){
    $('#navigation .top').addClass('js_no_el');
  }


  // close menu
  $('#navigation #authorisationPopup').on('click', function(){
    $('#side_menu').click();
  });

  // cart
  if( location.pathname.match(/\/cart|\/order/gi) ){
    $('.header').append('<div class="headBasket" onclick="history.back();"></div>');
  }
  

  /* ВСЕ КОМАНДЫ ПИШЕМ ВНУТРИ READY */
  // docs — http://owlgraphic.com/owlcarousel/
  // $("#owl-slider").owlCarousel();

  // ----------------------------
  // Кнопка наверх
  // ----------------------------
  $(window).scroll(function(){
    if ($(this).scrollTop() > 1000) {
      $('#backToTop').addClass('show');
    } else {
      $('#backToTop').removeClass('show');
    }
  });

  $('#backToTop').bind('click', function(){
    $('html, body').animate({scrollTop: 0});
  });

  // ----------------------------
  // Боковое меню
  // ----------------------------
  $('#side_menu').on('click',function(){
    $('#page').toggleClass('opened');
  });

  // ----------------------------
  // Показать верхнее меню
  // ----------------------------
  $('header .link a').bind('click',function() {
    var thisLink = $(this);
    var openBlockId = thisLink.parent().attr('id');
    var openBlockId = openBlockId+'Body';
    var openBlock = $('.hidden-block#'+openBlockId);
    openBlock.toggle();
    thisLink.toggleClass('active');
    $('.hidden-block').not(openBlock).hide();
    $('header .link a').not(thisLink).removeClass('active');
  });

  // ----------------------------
  // Переключение видов
  // ----------------------------
  var add_bg_color_and_filter = function(){
    if( !$('.label_filter').get(0) && $('ul.filterParams').get(0) ){
      $('ul.filterParams').before('<label class="label_filter">Сортировать товары по:</label>')
      $(document).on('click', '.filterParams', function(e){
        var t = $(this);
        if( $(e.target).is('ul') ){
          t.toggleClass('js_open');
        }
      });
      if( $('.label_filter').get(0) ){
        $('.label_filter').prev().nextAll().wrapAll('<div class="js_color-Changer" />');
      }
    }
  }

  $(document).on('click', '.priceOfBook', function(e){
    var t = $(this);
    var b = t.parent().find('a[onclick*="addtocart"]');
    if( b.get(0) ){
      t.addClass('js_in_cart');
      b.click();
    }else{
      t.parent().find('a').click();
    }
  });

  


  // ----------------------------
  // Переключение видов
  // ----------------------------
  $('.btn-group > .inside > .btn').bind('click',function() {
    var t = $(this);
    var p = t.parents('.multi-view');
    p.find('.btn').removeClass('active');
    p.find('.view').hide();
    t.addClass('active');
    p.find('.view:eq('+ t.index() +')').fadeIn(300);
  });
  $('.btn-group > .inside > .btn:first-child').addClass('active');
  $('.view-group > .view:first-child').show();

  // footer
  var footer = $('footer');
  var address = footer.find('[itemprop="address"]');
  var phone = footer.find('[itemprop="telephone"]');
  var mail = footer.find('[itemprop="email"]');
  var webServ = footer.find('.webServ');
  var aut = footer.find('[itemprop="author"]').clone().addClass('author');
  footer.find('.years').after( webServ );
  footer.find('.adress').after( aut );
  address.children().first().before('<a class="phone" href="tel:'+phone.text()+'">'+phone.text()+'</a><div class="clear"></div>');
  address.append('<div class="clear"></div><a class="mail" href="mailto:'+mail.text()+'"><span>'+mail.text()+'</span></a>');
  phone.remove();
  mail.remove();

  // detail
  var det = $('.x-catalog .productElementWrapp');
  if( det.get(0) ){
    var menu = det.find('.productsMenu');
    var left_img = det.find('.element_item_img');
    var left = det.find('.leftColumn');
    var right = det.find('.rightColumn');
    var right_price = right.find('.wrap_prise_top .newPrice');
    var right_shiping = right.find('.shippings');

    var btn_buy_wrap = $('.wrap_prise_bottom');
    var btn_wish_btn = $('a[onclick*="addToWishList"], .AlreadyInWishlist');
    btn_wish_btn.addClass('btn_wish');
    btn_buy_wrap.append( btn_wish_btn );

    if( right_price.get(0) ){
      right_price.after( left_img );
    }else{
      right.find('.priceBasketWrap').after( left_img );
    }
    if( right_shiping.get(0) ){
      right_shiping.after(left);
    }else{
      right.find('.priceBasketWrap').after(left);
    }
    menu.before( right );
    // menu
    var menu = $('.productsMenu li');
    menu.each(function() {
      var t = $(this).attr('data-id');
      $(this).after( $('div[id="prodBlock'+t+'"]') );
    });

    menu.on('click', function () {
      var t = $(this);
      if( t.hasClass('js_active') ){
        t.removeClass('js_active');
      }else{
        t.parent().find('.js_active').removeClass('js_active');
        t.addClass('js_active');
        $('html,body').animate({scrollTop: t.offset().top + 'px'},300);
      }
      if( t.next().hasClass('recenzion') == true ){
        $('.productsMenu .recenzion .slick-dots').remove();
        $('.productsMenu .recenzion').slick('reinit');
      }
    });

    $('.elementDescriptWrap .typesOfProduct .productType a:contains("iPhone")').html('Купить<br/> книгу для<br/> iOS');
    $('.elementDescriptWrap .typesOfProduct .productType a:contains("Android")').html('Купить<br/> книгу для<br/> Android');

    var det_img = $('.wrap_prise_top .element_item_img > a');
    det_img.off().unbind();
    det_img.removeClass('fancybox').attr('target', '_blank');
    
    // recenzion
    $('.productsMenu .recenzion').find(' > a').each(function () {
      var t = $(this);
      t.next().andSelf().wrapAll('<div class="recenzion_item"></div>');
    });
    $('.productsMenu .recenzion').slick({
      arrows: false,
      dots: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      adaptiveHeight: true
    });
  }

  var orderHistor_title = $('.historyWrap .tableTitle > p');
  var orderHistor_head = $('.historyWrap .orderNumbLine');
  if( orderHistor_title.get(0) && orderHistor_head.get(0) ){
    orderHistor_head.each(function(){
      $(this).children().each(function(){
        var t_i = $(this).index();
        $(this).attr('data-text', orderHistor_title[t_i].innerText );
      });
    });
  }

  var allTimer = function(){
    setTimeout(function(){
      price();
      form_label_add();
      check_password_dop_text();
      search_help();
      cart_popup();
      cart_tottal_replacer();
      catalog_splitter();
      add_bg_color_and_filter();

      allTimer();
    }, 300);
  };
  allTimer();

});



