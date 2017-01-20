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
<meta name="viewport" content="width=device-width; initial-scale=1">
<meta name="viewport" content="width=1200">
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

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png?v=WGG39kPBLm">
<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png?v=WGG39kPBLm">
<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png?v=WGG39kPBLm">
<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png?v=WGG39kPBLm">
<link rel="apple-touch-icon" sizes="114x114"
          href="/apple-touch-icon-114x114.png?v=WGG39kPBLm">
<link rel="apple-touch-icon" sizes="120x120"
          href="/apple-touch-icon-120x120.png?v=WGG39kPBLm">
<link rel="apple-touch-icon" sizes="144x144"
          href="/apple-touch-icon-144x144.png?v=WGG39kPBLm">
<link rel="apple-touch-icon" sizes="152x152"
          href="/apple-touch-icon-152x152.png?v=WGG39kPBLm">
<link rel="apple-touch-icon" sizes="180x180"
          href="/apple-touch-icon-180x180.png?v=WGG39kPBLm">
<link rel="icon" type="image/png" href="/favicon-32x32.png?v=WGG39kPBLm" sizes="32x32">
<link rel="icon" type="image/png" href="/favicon-194x194.png?v=WGG39kPBLm" sizes="194x194">
<link rel="icon" type="image/png" href="/favicon-96x96.png?v=WGG39kPBLm" sizes="96x96">
<link rel="icon" type="image/png" href="/android-chrome-192x192.png?v=WGG39kPBLm"
          sizes="192x192">
<link rel="icon" type="image/png" href="/favicon-16x16.png?v=WGG39kPBLm" sizes="16x16">
<link rel="manifest" href="/manifest.json?v=WGG39kPBLm">
<link rel="mask-icon" href="/safari-pinned-tab.svg?v=WGG39kPBLm">
<link rel="shortcut icon" href="/favicon.ico?v=WGG39kPBLm">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/mstile-144x144.png?v=WGG39kPBLm">
<meta name="theme-color" content="#ffffff">

	<meta property="og:title" content="Читай как тебе удобно! Покупая бумажную книгу, электронную получаешь в подарок" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="/actions/freedigitalbooks/" />
	<meta property="og:image" content="/actions/freedigitalbooks/img/astro.jpg" />
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
	background: url(img/back-1c.jpg) repeat-y #040404 70% 0%;
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
.menu li a {
	font-size: 16px;
}

#wrap1, #wrap2, #wrap3, #wrap4, #wrap5 {
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
  margin: 20px auto 0;
  max-width: 800px;
  z-index: 28;
}
#middle3 a, #middle4 a, #faq a {
	color:rgb( 151, 222, 15 );
	text-decoration:underline;
}
#middle3 a:hover, #middle4 a:hover, #faq a:hover {
	text-decoration:none;
}
#middle4 {
  font-size: 24px;
  font-family: "Walshein_regular";
  color: rgb(203, 203, 203);
  text-align: center;
  position: relative;
  margin: 15px auto 0;
  max-width: 800px;
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
  text-align: center;
  position: relative;
  margin: 50px auto 0;
  max-width: 1100px;
  z-index: 34;
}
#down1 span {
	color:rgb( 151, 222, 15 );
}
#faq {
  font-size: 24px;
  font-family: "Walshein_light";
  color: rgb( 225, 225, 225 );
  text-align: left;
  position: relative;
  margin: 50px auto 0;
  max-width: 1100px;
  z-index: 34;	
}

#faq .quest {
	font-size: 32px;
}
#faq .headfaq {
	font-size: 48px;
	font-weight:bold;
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
		Покупая бумажную книгу &laquo;Альпины&raquo; на&nbsp;нашем сайте, вы&nbsp;также	получаете ее&nbsp;в&nbsp;электронном виде на&nbsp;своих устройствах iOS и&nbsp;Android. <a href="#req" style="color:red;font-size:72px;">*</a>
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
		Купите книгу на&nbsp;сайте <a href="http://www.alpina.ru">alpina.ru</a> и&nbsp;сразу после оплаты
		вы&nbsp;получите уникальную одноразовую ссылку. Используйте ссылки,
		чтобы загружать электронные версии книг в&nbsp;приложении <a href="https://adretaill.onelink.me/3956041590?pid=ialpinabook" target="_blank">&laquo;Бизнес.Книги&raquo;</a>
		на&nbsp;вашем телефоне или планшете.
	</div>
	<br />
	<div id="middle4">
		<a name="req"></a>
		<span>Дорогой друг!</span> <br />
		<?/*В&nbsp;редких случаях у&nbsp;нас может не&nbsp;оказаться электронной книги, которую вы&nbsp;купили в&nbsp;бумаге. На&nbsp;такие книги наше предложение не&nbsp;распространяется.*/?>
		Предложение распространяется на&nbsp;книги со&nbsp;специальным знаком &laquo;Бесплатная электронная книга в&nbsp;комплекте&raquo;,<br />как на&nbsp;изображении ниже.
		<br /><br />
		<img src="img/badge.jpg" style="border-radius: 15px;" />
		<br /><br />
		Сейчас услуга &laquo;Знание, а&nbsp;не&nbsp;носитель&raquo; работает
		на&nbsp;всех платформах Android и&nbsp;на&nbsp;платформах iOS, начиная с&nbsp;версии iOS8 и&nbsp;выше (iOS7&nbsp;на стадии доработки).
		
		Если у&nbsp;вас возникают сложности с&nbsp;получением бесплатных электронных книг,
		напишите нам на&nbsp;адрес <a href="mailto:shop@alpinabook.ru">shop@alpinabook.ru</a> или позвоните: +7 (495) 980 80 77.
	</div>
</div>

<div id="wrap3">
	<div id="down1">
		Мы&nbsp;верим в&nbsp;абсолютное<br />
		право на&nbsp;информацию.<br />
		<span>Книга&nbsp;&mdash; это знание, а&nbsp;не&nbsp;носитель.</span>
	</div>
	<div id="down2">
		Нет смысла ждать больших изменений, если можно встать у&nbsp;их&nbsp;истоков. Мы&nbsp;решились быть первым в&nbsp;России и&nbsp;в&nbsp;мире издательством, которое сделало удобство чтения своей официальной политикой. Вам больше не&nbsp;нужно носить с&nbsp;собой тяжелые тома&nbsp;&mdash; книга всегда будет под рукой в&nbsp;телефоне или на&nbsp;планшете. А&nbsp;дома вы&nbsp;сможете наслаждаться скрипом переплета и&nbsp;запахом свежей бумаги, шумно листать страницы и&nbsp;делать пометки на&nbsp;полях.
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

<div id="wrap5">
	<div id="faq">
<span class="headfaq">Часто задаваемые вопросы</span> <br />
		<br />
		<span class="quest">ВОПРОС 1: Что делать, если книги не&nbsp;загрузились?</span> <br />
		<br />
		1. Каким устройством вы&nbsp;пользуетесь? С&nbsp;любыми телефонами и&nbsp;планшетами на&nbsp;Android проблем быть не&nbsp;должно, так&nbsp;же как с&nbsp;айфонами и&nbsp;айпадами с&nbsp;версией прошивки 8.0 и&nbsp;новее. Трудности могут возникнуть только с&nbsp;версией iOS&nbsp;7 (узнать версию прошивки на&nbsp;своем телефоне можно: Настройки&nbsp;&mdash; Основные&nbsp;&mdash; Об&nbsp;этом устройстве&nbsp;&mdash; Версия). Самый простой вариант решения&nbsp;&mdash; обновить ПО.<br />
		<br />
		2. Если это не&nbsp;помогло, проблема может быть в&nbsp;том, что вы&nbsp;вводите не&nbsp;тот логин/пароль при активации уникальной ссылки.<br />
		При активации ссылки на&nbsp;скачивание бесплатных книг нужно вводить именно логин и&nbsp;пароль от&nbsp;приложения &laquo;Бизнес.Книги&raquo;. Либо просто заходить через фейсбук и&nbsp;в&nbsp;приложении, и&nbsp;на&nbsp;странице скачивания бесплатных книг.<br />
		Увы, это издержки тестовой версии, над которыми мы&nbsp;уже работаем. В&nbsp;будущем вам не&nbsp;придется делать лишних шагов и&nbsp;электронные книги сами будут автоматически загружаться на&nbsp;ваш телефон или планшет сразу после покупки бумажных книг. Следите за&nbsp;нашими обновлениями :)<br />
		<br />
		3. Если&nbsp;же вы&nbsp;все сделали правильно, но&nbsp;по-прежнему книжек не&nbsp;видно, напишите нам, мы&nbsp;быстро ответим вам!&nbsp;<a href="mailto:shop@alpinabook.ru">shop@alpinabook.ru</a><br />
		<br />
		<span class="quest">ВОПРОС 2: Что делать, если книги загрузились, но&nbsp;не&nbsp;все?</span> <br />
		<br />
		Возможно, книги, которые не&nbsp;загрузились, вы&nbsp;уже приобрели ранее в&nbsp;приложении. Проверьте в&nbsp;приложении в&nbsp;разделе &laquo;Мои книги&raquo;.<br />
		Если книги не&nbsp;загрузились по&nbsp;другой причине, напишите нам на&nbsp;<a href="mailto:shop@alpinabook.ru">shop@alpinabook.ru</a>, и&nbsp;мы&nbsp;быстро решим проблему.<br />
		<br />
		<span class="quest">ВОПРОС 3: Что делать, если в&nbsp;электронном виде загрузились не&nbsp;все&nbsp;книги, которые я&nbsp;заказывал?</span> <br />
		<br />
		1. Будьте внимательны, в&nbsp;редких случаях у&nbsp;нас может не&nbsp;оказаться электронной книги, которую вы&nbsp;купили в&nbsp;бумаге. Тогда в&nbsp;карточке книги вы&nbsp;просто не&nbsp;увидите упоминания о&nbsp;бесплатной электронной книге. Мы&nbsp;постоянно работаем над тем, чтобы таких книг было меньше.<br />
		<br />
		2. Если вы&nbsp;проверили список обещанных электронных книг в&nbsp;письме или личном кабинете и&nbsp;уверены, что загрузилось не&nbsp;то, что должно было, напишите нам на&nbsp;<a href="mailto:shop@alpinabook.ru">shop@alpinabook.ru</a>.<br />
		<br />
		<span class="quest">ВОПРОС 4: Какой пароль вводить на&nbsp;сайте интернет-магазина и&nbsp;в&nbsp;приложении?</span> <br />
		<br />
		1. Самое простое&nbsp;&mdash; входить во&nbsp;всех случаях с&nbsp;помощью фейсбука, чтобы не&nbsp;запутаться.<br />
		<br />
		2. Если у&nbsp;вас нет акаунта в&nbsp;фейсбуке или вы&nbsp;не&nbsp;хотите его использовать, необходимо зарегистрироваться. Для простоты вы&nbsp;можете завести одинаковые логин/пароль в&nbsp;интернет-магазине и&nbsp;приложении, чтобы не&nbsp;путаться.<br />
		<br />
		3. Впрочем, вы&nbsp;можете завести разные логины и&nbsp;пароли для аккаунтов в&nbsp;магазине и&nbsp;приложении, это не&nbsp;помешает вам получать электронные книги. Однако в&nbsp;этом случае важно помнить: на&nbsp;странице активации уникальной ссылки вам нужно вводить данные именно мобильного приложения.<br />
		<br />
		<span class="quest">ВОПРОС 5: Могу&nbsp;ли я&nbsp;купить электронные книги без бумажных?</span> <br />
		<br />
		Да, конечно. Электронные книги по-прежнему доступны в&nbsp;приложении &laquo;Бизнес.Книги&raquo; по&nbsp;выгодной цене.<br />
		<br />
		<span class="quest">ВОПРОС 6: Могу&nbsp;ли я&nbsp;получить книги, которые покупал на&nbsp;вашем сайте ранее, 16&nbsp;августа 2016&nbsp;года?</span> <br />
		<br />
		Если&nbsp;бы электронные книги получали только новые пользователи, это было&nbsp;бы несправедливо по&nbsp;отношению к&nbsp;нашим старым друзьям и&nbsp;лояльным покупателям. Мы&nbsp;уже работаем над тем, чтобы вы&nbsp;могли скачать в&nbsp;электронном виде все книги, которые когда-либо заказывали на&nbsp;нашем сайте, и&nbsp;обещаем вам в&nbsp;скором времени выпустить обновление, которое позволит это сделать.<br />
		<br />
		<span class="quest">ВОПРОС 7: Что делать, если не&nbsp;удается зарегистрироваться на&nbsp;странице с&nbsp;промокодом и&nbsp;в&nbsp;приложении?</span> <br />
		<br />
		Не&nbsp;помним, когда последний раз такое было. Но&nbsp;если это случилось с&nbsp;вами, просто напишите нам на&nbsp;<a href="mailto:shop@alpinabook.ru">shop@alpinabook.ru</a>, и&nbsp;мы&nbsp;быстро все исправим.<br />
		<br />
		<span class="quest">ВОПРОС 8: Если я&nbsp;покупаю несколько экземпляров одной и&nbsp;той&nbsp;же книги, получу&nbsp;ли я&nbsp;несколько экземпляров электронной?</span><br /><br />

		Нет, одному пользователю, зарегистрированному в&nbsp;приложении, мы&nbsp;подарим только одну электронную книгу на&nbsp;его мобильгное устройство. Кроме того, услуга &laquo;Знание, а&nbsp;не&nbsp;носитель&raquo; действует только для физических лиц и&nbsp;не&nbsp;распространяется на&nbsp;юридических лиц.</div>
		</div>

<center><div style="margin:20px auto 40px;"><script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script><script src="//yastatic.net/share2/share.js"></script><div class="ya-share2" data-services="vkontakte,facebook" data-counter=""></div></div></center>
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
	<meta itemprop="logo" content="/img/logo.png">
	&copy;&nbsp;2000-2016, <span itemprop="name">ООО &laquo;Альпина Паблишер&raquo;</span>
</span> </div>
<a target="_blank" href="https://itunes.apple.com/app/id429622051?mt=8">
<img src="img/appleicon.png" />
</a>
<a target="_blank" href="https://play.google.com/store/apps/details?id=ru.alpina.alpina_retail">
<img src="img/androidicon.png" />
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