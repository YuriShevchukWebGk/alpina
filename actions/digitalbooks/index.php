<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER;
if (!$USER->isAdmin()) {
	//header(&quot;Location: http://www.alpinabook.ru&laquo;);
	//exit();
}?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<meta name="format-detection" content="telephone=no">
<!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<title>Электронная версия книги в&nbsp;подарок</title>
<meta name="keywords" content=""/>
<meta name="description" content=""/>
<link href="css/style.css" rel="stylesheet">
<link href="css/template_57363f3dd71b4bfd17109917de7b3143.css" rel="stylesheet">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<link rel="apple-touch-icon" sizes="57x57" href="http://www.alpinabook.ru/apple-touch-icon-57x57.png?v=WGG39kPBLm">
<link rel="apple-touch-icon" sizes="60x60" href="http://www.alpinabook.ru/apple-touch-icon-60x60.png?v=WGG39kPBLm">
<link rel="apple-touch-icon" sizes="72x72" href="http://www.alpinabook.ru/apple-touch-icon-72x72.png?v=WGG39kPBLm">
<link rel="apple-touch-icon" sizes="76x76" href="http://www.alpinabook.ru/apple-touch-icon-76x76.png?v=WGG39kPBLm">
<link rel="apple-touch-icon" sizes="114x114"
          href="http://www.alpinabook.ru/apple-touch-icon-114x114.png?v=WGG39kPBLm">
<link rel="apple-touch-icon" sizes="120x120"
          href="http://www.alpinabook.ru/apple-touch-icon-120x120.png?v=WGG39kPBLm">
<link rel="apple-touch-icon" sizes="144x144"
          href="http://www.alpinabook.ru/apple-touch-icon-144x144.png?v=WGG39kPBLm">
<link rel="apple-touch-icon" sizes="152x152"
          href="http://www.alpinabook.ru/apple-touch-icon-152x152.png?v=WGG39kPBLm">
<link rel="apple-touch-icon" sizes="180x180"
          href="http://www.alpinabook.ru/apple-touch-icon-180x180.png?v=WGG39kPBLm">
<link rel="icon" type="image/png" href="http://www.alpinabook.ru/favicon-32x32.png?v=WGG39kPBLm" sizes="32x32">
<link rel="icon" type="image/png" href="http://www.alpinabook.ru/favicon-194x194.png?v=WGG39kPBLm" sizes="194x194">
<link rel="icon" type="image/png" href="http://www.alpinabook.ru/favicon-96x96.png?v=WGG39kPBLm" sizes="96x96">
<link rel="icon" type="image/png" href="http://www.alpinabook.ru/android-chrome-192x192.png?v=WGG39kPBLm"
          sizes="192x192">
<link rel="icon" type="image/png" href="http://www.alpinabook.ru/favicon-16x16.png?v=WGG39kPBLm" sizes="16x16">
<link rel="manifest" href="http://www.alpinabook.ru/manifest.json?v=WGG39kPBLm">
<link rel="mask-icon" href="http://www.alpinabook.ru/safari-pinned-tab.svg?v=WGG39kPBLm">
<link rel="shortcut icon" href="http://www.alpinabook.ru/favicon.ico?v=WGG39kPBLm">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/mstile-144x144.png?v=WGG39kPBLm">
<meta name="theme-color" content="#ffffff">

	<meta property="og:title" content="32 мая. Лишний день весны обязательно нужен!" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="http://www.alpinabook.ru/actions/may32/" />
	<meta property="og:image" content="http://www.alpinabook.ru/actions/cybertuesday/img/headern.jpg" />
	<meta property="og:site_name" content="www.alpinabook.ru" />
	<meta property="fb:admins" content="1425804193" />
	<meta property="fb:app_id" content="138738742872757" /> 

</head>
<body>
<script>
$(document).ready(function() {
	//alert($('body').width());
});
</script>
<style>
body, html {
	background: url(img/back-1b.jpg) repeat-y #040404;
	min-width:1200px;
	height:auto;
}
@media screen and (max-width: 980px) {
   body, html, footer {
	   min-width:1900px;
   }
}
@media only screen 
and (min-device-width : 320px) 
and (max-device-width : 568px) {
	body, html, footer {
	   max-width:1300px;
	   min-width:1300px;
   }
}

@media only screen 
and (min-device-width : 320px) 
and (max-device-width : 568px) {
	body, html, footer {
	   max-width:1300px;
	   min-width:1300px;
   }
}

@media only screen 
and (min-device-width : 414px) 
and (max-device-width : 736px) 
and (orientation : portrait) {
	body, html, footer {
	   max-width:1650px;
	   min-width:1650px;
   }	
}


#wrap1, #wrap2, #wrap3, #wrap4 {
	width: 100%;
	margin: 0 auto;
	/*max-width:1000px;*/
}
#header1 {
  font-size: 72px;
  font-family: "Walshein_light";
  color: rgb( 151, 222, 15 );
  line-height: 1.028;
  text-align: center;
  position: relative;
  margin-top: 210px;
  z-index: 78;
}
#header2 {
  font-size: 32px;
  font-family: "Walshein_light";
  color: rgb(203, 203, 203);
  line-height: 1.5;
  text-align: center;
  position: relative;
  margin-top:60px;
  z-index: 77;
}
#header3 {
  font-size: 48px;
  font-family: "Walshein_light";
  color: rgb( 255, 255, 255 );
  line-height: 1.125;
  text-align: center;
  position: relative;
  margin-top: 20px;
  z-index: 75;
}
.underline {
	border-bottom:5px solid rgb( 151, 222, 15 );
}

#middle1 {
  font-size: 72px;
  font-family: "Walshein_light";
  color: rgb( 151, 222, 15 );
  line-height: 1.028;
  text-align: center;
  position: relative;
  margin-top: 240px;
  z-index: 30;
}
#middle2 {
  background: url(img/back-2.png) no-repeat 50% 0;
  position: relative;
  margin-top: 80px;
  width: 100%;
  height: 364px;
  z-index: 31;
}
#middle3 {
  font-size: 24px;
  font-family: "Walshein_light";
  color: rgb( 225, 225, 225 );
  line-height: 1.25;
  text-align: center;
  position: relative;
  margin-top:20px;
  z-index: 28;
}
#middle3 a {
	color:rgb( 151, 222, 15 );
	text-decoration:underline;
}
#middle3 a:hover {
	text-decoration:none;
}
#middle4 {
  font-size: 24px;
  font-family: "Walshein_regular";
  color: #838383;
  text-align: center;
  position: relative;
  margin-top: 15px;
  z-index: 29;
}
#middle4 span {
	color:rgb( 151, 222, 15 );
}
#down1 {
  font-size: 72px;
  font-family: "Walshein_light";
  color: rgb( 225, 225, 225 );
  line-height: 1.028;
  text-align: center;
  position: relative;
  margin-top: 230px;
  z-index: 35;
}
#down2 {
  font-size: 24px;
  font-family: "Walshein_light";
  color: rgb( 225, 225, 225 );
  line-height: 1.167;
  text-align: center;
  position: relative;
  margin-top: 50px;
  z-index: 34;
}
#down1 span {
	color:rgb( 151, 222, 15 );
}


#footer2 {
  font-size: 72px;
  font-family: "Walshein_light";
  color: rgb( 151, 222, 15 );
  line-height: 1.028;
  text-align: center;
  margin-right:250px;
  position: relative;
  margin-top:320px;
  z-index: 24;
}
#footer3 {
  position: relative;
  margin-top: 100px;
  z-index: 50;
  text-align:center;
  margin-right:250px;
  height: 230px;
}
#footer3 a {
	margin-right:50px;
	text-align:center;
	width:200px;
	padding: 15px 45px;
	border: 1px solid #31455a;
	color: rgb( 255, 255, 255 );
	font-family: "Walshein_light";
	font-size:30px;
	text-decoration: underline;
	background:#030306;
	opacity:0.5;
	border-radius: 10px;
	z-index:50;
}
#footer3 a:hover {
	text-decoration: none;
}
footer {
	width: 100%;
	background:#f3f3f3;
	color:#b9b9b9;
}
</style>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-PM87GH"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PM87GH');</script>
<!-- End Google Tag Manager -->
<header style="border-bottom:1px solid #eee;">
<a href="/">
<div class="logo catalogLogo">
<img src="/img/logo.png"> </div>
</a>
<div class="headerWrapper">
<ul class="menu">
<li><a href="/content/payment/">Оплата</a></li>
			<li><a href="/content/delivery/">Доставка</a></li>
			<li><a href="/content/discounts/">Скидки</a></li>
			<li><a href="/about/contacts/">Контакты</a></li>
</ul> 
</div>
<div class="lkWrapp">
<p class="telephone" style="font-size: 14px;font-family: 'Walshein_regular'">
+7 (495) 980 80 77
</p>
</div>
</header>

<div id="wrap1">
	<div id="header1">
		Будущее книг настало.<br />
		Мы&nbsp;придумали чтение заново.
	</div>
	<div id="header2">
		Это не&nbsp;временная акция, но&nbsp;наш новый принцип:
	</div>
	<div id="header3">
		Покупая бумажную книгу &laquo;Альпины&raquo; на&nbsp;нашем сайте,
		вы&nbsp;также получаете ее&nbsp;в&nbsp;электронном виде на&nbsp;всех своих устройствах.
		<br />
		<span class="underline">Бесплатно и&nbsp;моментально.</span>
	</div>
</div>

<div id="wrap2">
	<div id="middle1">
		Как это работает?
	</div>
	<div id="middle2">

	</div>
	<div id="middle3">
		Купите книгу на&nbsp;сайте <a href="http://www.alpina.ru">alpina.ru</a> и&nbsp;сразу после оплаты<br />
		вы&nbsp;получите уникальный одноразовый код. Используйте коды,<br />
		чтобы скачать элетронную версию в&nbsp;приложении <a href="https://adretaill.onelink.me/3956041590?pid=ialpinabook">&laquo;Бизнес.Книги&raquo;</a>.
	</div>
	<div id="middle4">
		<span>Важный момент:</span> в&nbsp;редких случаях у&nbsp;нас может не&nbsp;оказаться<br />
		электронной книги, которую вы&nbsp;купили в&nbsp;бумаге, и&nbsp;тогда мы<br />
		подарим вам похожу книгу по&nbsp;этой&nbsp;же теме.
	</div>	
</div>

<div id="wrap3">
	<div id="down1">
		Мы&nbsp;верим в&nbsp;абсолютное<br />
		право на&nbsp;информацию.<br />
		<span>Книга&nbsp;&mdash; это знание, а&nbsp;не&nbsp;носитель.</span>
	</div>
	<div id="down2">
		Нет смысла ждать больших изменений, если можно встать у&nbsp;их&nbsp;истоков. Мы&nbsp;решились быть первым<br />
		в&nbsp;России и&nbsp;в&nbsp;мире издательством, которое сделало удобство чтения своей официальной политикой.<br />
		Вам больше не&nbsp;нужно носить с&nbsp;собой тяжелые тома&nbsp;&mdash; книга всегда будет под рукой в&nbsp;телефоне<br />
		или на&nbsp;планшете. А&nbsp;дома вы&nbsp;сможете наслаждаться скрипом переплета и&nbsp;запахом свежей бумаги, шумно<br />
		листать страницы и&nbsp;делать пометки на&nbsp;полях.
	</div>
</div>

<div id="wrap4">
	<div id="footer1">
	</div>
	<div id="footer2">
		Мы&nbsp;сделали чтение<br />
		по-настоящему удобным
	</div>	
	<div id="footer3">
		<a href="/catalog/new/?SORT=NEW" class="button">Новинки</a>
		<a href="/catalog/bestsellers/" class="button">Бестселлеры</a>
		<a href="/catalog/all-books/" class="button">Лучшие книги</a>
	</div>
</div>
<footer itemscope="" id="WPFooter" itemtype="http://schema.org/WPFooter">
<div class="catalogWrapper">
<div class="footerMenu">
<div>
<a href="/">
<img src="img/logo.png">
</a>
				 <br>
				 <br>
				 <a href="http://blog.alpinabook.ru/" target="_blank">
<img src="/img/footerBlogLogo.png">
</a>				
</div>
<div>


	<p><a class="bottomMenuLink" href="/content/publisher/">О&nbsp;группе компаний</a></p>
	<p><a class="bottomMenuLink" href="/authors/">Алфавитный указатель авторов</a></p>
	<p><a class="bottomMenuLink" href="/content/partnersProgram/">Партнерская программа</a></p>
</div>
<div>


	<p><a class="bottomMenuLink" href="/content/delivery/">Доставка</a></p>
	<p><a class="bottomMenuLink" href="/content/payment/">Оплата</a></p>
	<p><a class="bottomMenuLink" href="/content/howto/">Как заказать</a></p>
	<p><a class="bottomMenuLink" href="/actions/">Акции</a></p>
</div>
<div>


	<p><a target="_blank" class="bottomMenuLink" href="http://blog.alpinabook.ru/">Блог</a></p>
	<p><a target="_blank" class="bottomMenuLink" href="http://www.alpinab2b.ru">Услуги B2B</a></p>
	<p><a target="_blank" class="bottomMenuLink" href="http://alpinatd.ru/">E-learning</a></p>
	<p><a target="_blank" class="bottomMenuLink" href="http://www.alpinab2b.ru/Alpina-Digital/">Online<br>библиотека</a></p>
</div>
<div>


	<p><a class="bottomMenuLink" href="/content/whereToBuy/">Где купить</a></p>
	<p><a class="bottomMenuLink" href="/events/">Мероприятия</a></p>
	<p><a class="bottomMenuLink" href="/about/contacts/">Контакты</a></p>
	<p><a class="bottomMenuLink" href="/content/publisher/authors/">Авторам</a></p>
</div> 
</div>
<div class="footerContacts">
<div class="yaMarket">
<a target="_blank" href="https://clck.yandex.ru/redir/dtype=stred/pid=47/cid=2508/*https://market.yandex.ru/shop/28038/reviews?sort_by=grade">
<img src="img/yam.png">
<p>Оценка</p>
<p class="stars"><span><img src="img/star.png"></span><span><img src="img/star.png"></span><span><img src="img/star.png"></span><span><img src="img/star.png"></span><span><img src="img/star.png"></span></p> 
</a>
</div>
<div class="adress">

<span itemscope="" itemtype="http://schema.org/PostalAddress">
	<span itemprop="addressLocality">Москва</span>, <span itemprop="streetAddress">4-я Магистральная улица, д.5, 2&nbsp;подъезд, 2&nbsp;этаж</span> <br>
	<span itemprop="telephone">+7 (495) 980 80 77</span>&nbsp;<span itemprop="email">shop@alpinabook.ru</span>
</span> <div class="years">
<span itemscope="" itemtype="http://schema.org/Organization">
	<meta itemprop="url" content="http://www.alpinabook.ru">
	<meta itemprop="logo" content="http://www.alpinabook.ru/img/logo.png">
	&copy;&nbsp;2000-2016, <span itemprop="name">ООО &laquo;Альпина Паблишер&raquo;</span>
</span> </div>
<a target="_blank" href="https://itunes.apple.com/app/id429622051?mt=8&amp;&amp;referrer=click%3Dc6b2bce4-1b6e-4b91-a143-410714207241">
<img src="img/icons.png" />
</a>
</div>
<div class="webServ">
<a href="http://vk.com/ideabooks" target="_blank" rel="nofollow"><img src="/img/vkImg.png"></a>
<a href="https://twitter.com/AlpinaBookRu" target="_blank" rel="nofollow"><img src="/img/twitterImg.png"></a>
<a href="https://www.facebook.com/alpinabook/" target="_blank" rel="nofollow"><img src="/img/fbImg.png"></a>
<a href="http://www.youtube.com/user/AlpinaPublishers" target="_blank" rel="nofollow"><img src="/img/youImg.png"></a>
<a href="https://plus.google.com/+alpinabook?prsrc=5" target="_blank" rel="nofollow"><img src="/img/googImg.png"></a>
<a href="http://instagram.com/alpinabook" target="_blank" rel="nofollow"><img src="/img/instImg.png"></a>
</div>
</div>
</div>
</footer>
</body>
</html>