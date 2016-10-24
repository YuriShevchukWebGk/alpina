<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER;
$today = date("w");
/*if (!$USER->isAdmin()) {
	header("Location: ");
	exit();
}*/?>
<!DOCTYPE html>
<html>
<head>
	<meta name="robots" content="noindex, nofollow"/>
    <meta charset="utf-8"/>
    <title>День рождения интернет-магазина</title>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <link href="css/style.css?123" rel="stylesheet">
    <link href="css/template_57363f3dd71b4bfd17109917de7b3143.css?123" rel="stylesheet">
	<link href="css/newstyle.css?123" rel="stylesheet">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

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
	
	<meta property="og:title" content="День рождения интернет-магазина" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="https://www.alpinabook.ru/actions/bday/" />
	<meta property="og:image" content="https://www.alpinabook.ru/actions/bday/img/cakes.png" />
	<meta property="og:site_name" content="www.alpinabook.ru" />
	<meta property="fb:admins" content="1425804193" />
	<meta property="fb:app_id" content="138738742872757" />

</head>
<body>
<script type="text/javascript" src="/js/jquery.cookie.js"></script>
<script>
$(document).ready(function(){

	$window = $(window);

	$('section[data-type="background"]').each(function(){
		var $bgobj = $(this); // Назначаем объект

		$(window).scroll(function() {

			// Прокручиваем фон со скоростью var.
			// Значение yPos отрицательное, так как прокручивание осуществляется вверх!
			var yPos = -(($window.scrollTop() - 150) / $bgobj.data('speed')); 

			// Размещаем все вместе в конечной точке
			var coords = '50% '+ yPos + 'px';

			// Смещаем фон
			$bgobj.css({ backgroundPosition: coords });

		}); 

	});
	
	$("#closeparal").click(function() {
		close_paral();
	});
}); 
/* 
 * Создаем элементы HTML5 для IE
 */

document.createElement("article");
document.createElement("section");
</script>
<style>
	#paralwrap {
		background: url('img/cakes.png') no-repeat scroll 50% 83px;
		height: 630px;
	}
	#paralwrap .internal {
		z-index: 94;
		max-width: 600px;
		margin: 0px auto;
		text-align: center;
		padding-top:20px;
		line-height:1.067;
	}
	#paralwrap .internal a {
		font-size: 58px;
		font-family: 'Walshein_bold';
		color: rgb( 151, 222, 15 );
	}
	#paralwrap .internal a:hover {
		text-decoration:underline;
	}
	#paralwrap #closeparal {
		color:#fff;
		font-size:18px;
        font-weight:bold;
		text-align:right;
		padding: 20px 20px 0;
		cursor:pointer;
	}
	#paralwrap #closeparal:hover {
		text-decoration:underline;
	}
	.menu a {
		font-size: 16px!important;
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
            <img src="/img/logo.png">        </div>
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
  <!--      <a href="/personal/cart/">
            <div class="headBasket"></div>
		</a>          -->
  <!--      <a href="/personal/profile/" id="">
            <div>
                <img src="/img/lkImg.png">
            </div>
        </a>       -->
        <p class="telephone" style="font-size: 14px;font-family: 'Walshein_regular'">
            +7 (495) 980 80 77
        </p>
    </div>
	<section data-speed="2" id="paralwrap" data-type="background"><div class="internal"></div></section>
</header>

<style>
body {
	background: url(img/backn.jpg) no-repeat 50% 50%;
	height: 1863px;
}
.topblock {
	
	height: 630px;
}
.topblock .toptext {
	font-family: 'Walshein_black';
	font-size:42px;
	color: #fff;
	padding-top: 30px;
}
.topblock .toptext2 {
	font-family: 'Walshein_black';
	margin-top: -50px;
	font-size: 230px;
	color: rgb( 255, 1, 67 );
	text-shadow: 0.262px 4.993px 0px rgb( 255, 255, 255 );
}

.secondblock {
	margin-top: -80px;
}
.secondblock .toptext {
	font-family: 'Walshein_black';
	font-size: 60px;
	color: #fff;
	line-height: 1.067;
}
.secondblock .toptext2 {
	font-family: 'Walshein_regular';
	font-size: 40px;
	color: rgb( 123, 47, 67 );
	margin-top: 60px;
}
.middleblock {
	width: 1366px;
	margin: 40px auto 0;
	height: 425px;
}
.middleblock .item {
	float: left;
	width: 330px;
	height: 380px;
}
.middleblock .item img {
	padding: 20px 0;
}
.middleblock .item .text {
	font-size: 24px;
	color: rgb( 123, 47, 67 );
	font-family: 'Walshein_regular';
}

.bottomblock {
	font-family: 'Walshein_regular';
	font-size: 40px;
	color: rgb( 255, 255, 255 );
	clear: both;
	margin-top: 80px;
}

.buttons {
	height: 290px;
	background: #fff;
	text-aling: center;
	width: auto;
	margin: 100px auto 0;
	padding-top: 100px;
}

.buttons .wrap {
	width: 1300px;
	margin: 0 auto;
}

.buttons a {
	color: rgb( 255, 255, 255 );
	background-color: rgb( 255, 1, 67 );
	padding: 20px 50px;
	margin: 0 45px;
	display: block;
	float: left;
	font-size: 30px;
	font-family: 'Walshein_black';
	border-radius: 43px;
}
.buttons a:hover {
	text-decoration: underline;
}
.conditions {
	margin: 0 auto;
	width: 1100px;
	clear: both;
	padding-top: 30px;
	padding-bottom: 90px;
	font-size: 18px;
	color: rgb( 123, 47, 67 );
	font-family: 'Walshein_regular';
	text-align: left;
}
.conditions ul {
    list-style-type: circle;
}
.winner {
	display:inline-block;
	text-align:center;
	width:150px;
}
.winners {
	margin: 0 auto;
	max-width: 600px;
}
</style>

    <div class="landing">
		<div class="topblock">
			<div class="toptext">
				Нашему интернет-магазину
			</div>
			<div class="toptext2">
				16 лет
			</div>
		</div>
		
		<div class="secondblock">
			<div class="toptext">
				Дарим подарки<br />
				абсолютно всем!
			</div>
			<div class="toptext2">
				Заказывая книги в интернет-магазине с 4 до 11 октября,<br />
				вы получаете подарок.<br />
				Например, вы можете выиграть:<br />
			</div>
		</div>
		
		<div class="middleblock">
			<div class="item">
				<img src="img/1b.png" />
				<div class="text">
					Ящик шампанского<br />
					от наших друзей — <br />
					компании <a href="http://www.invisible.ru/alpina/" target="_blank" rel="nofollow">Invisible.ru.</a>
				</div>
			</div>
			<div class="item">
				<img src="img/2b.png" />
				<div class="text">
					Сотни заряженных на добро<br />
					и счастье браслетов,<br />
					закладок и значков.
				</div>
			</div>
			<div class="item">
				<img src="img/3b.png" />
				<div class="text">
					Двадцать футболок<br />
					с принтами обложек<br />
					наших лучших книг.
				</div>
			</div>
			<div class="item">
				<img src="img/4b.png" />
				<div class="text">
					Одну из двух подарочных<br />
					карт «Детского мира»<br />
					номиналом 5000 рублей.
				</div>
			</div>			
		</div>	
		<div class="bottomblock">
			Мы зажигаем свечи на торте и<br />
			зовем всех на праздник. Да, вы приглашены!<br />
			Приходите без подарка, подарки всем будем дарить мы.<br />
			16 лет — не шутка, и мы намерены кутить целую неделю!
		</div>
			
		<div class="secondblock" style="margin-top: 40px;">
			<div class="toptext">
				Победители
			</div>
			<div class="toptext2">
				Футболку получают заказы:<br />
				<div class="winners">
				<div class="winner">75048</div><div class="winner">
				75097</div><div class="winner">
				75294</div><div class="winner">
				75500</div><div class="winner">
				75398</div><div class="winner">
				75138</div><div class="winner">
				74958</div><div class="winner">
				75471</div><div class="winner">
				75327</div><div class="winner">
				75139</div><div class="winner">
				74958</div><div class="winner">
				75462</div><div class="winner">
				75277</div><div class="winner">
				75359</div><div class="winner">
				75185</div><div class="winner">
				75358</div><div class="winner">
				74944</div><div class="winner">
				75328</div><div class="winner">
				75035</div><div class="winner">
				74948</div><div class="winner">
				</div>


				<iframe width="560" height="315" src="https://www.youtube.com/embed/mha1x58lTPQ" frameborder="0" allowfullscreen></iframe><br /><br />
				
				Подарочный сертификат в «Детский мир» получают заказы:<br />
				75509<br />
				75234<br />
				<iframe width="560" height="315" src="https://www.youtube.com/embed/lKmfuNIUbFY" frameborder="0" allowfullscreen></iframe><br /><br />
				
				Ящик шампанского получает обладатель заказа 75057<br />
				<iframe width="560" height="315" src="https://www.youtube.com/embed/FlU8YqC5fsE" frameborder="0" allowfullscreen></iframe>
			</div>
		</div>
			
		<?/*} else {?>
		<div class="buttons">
			<div class="wrap">
				<a href="/catalog/new/?SORT=NEW">Новинки</a>
				<a href="/catalog/all-books/">Перейти к выбору книг</a>
				<a href="/catalog/bestsellers/">Бестселлеры</a>
			</div>
			<!-- noindex -->
			<div class="conditions">
			<h3>Условия акции:</h3><ul>
				<li>В акции участвуют заказы, оформленные в период с 04.10.16 00:01 по 11.10.2016 23:59 (по московскому времени).</li>
				<li>Во все заказы, попадающие под условия проведения акции, будет добавлена закладка, значок или браслет в случайном порядке.</li>
				<li>В розыгрыше главных призов участвуют заказы, оформленные в период проведения акции и оплаченные не позднее 12.10.2016 23:59 (по московскому времени). Главными призами являются футболки, подарочные карты и ящик шампанского.</li>
				<li>Итоги акции будут опубликованы не позднее 20.10.2016 на сайте https://www.alpinabook.ru/actions/bday/.</li>
			</ul>
			</div>
			<!-- /noindex -->
		</div>
		<?}*/?>
		
		
		
		
		
    </div>
 </body>
 </html>
 