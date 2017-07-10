<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER;
$today = date("w");
/*if (!$USER->isAdmin()) {
	header("Location: http://www.alpinabook.ru");
	exit();
}*/?>
<!DOCTYPE html>
<html>
<head>
	<meta name="robots" content="noindex, nofollow"/>
    <meta charset="utf-8"/>
    <title>Бесплатная доставка Boxberry!</title>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/template_57363f3dd71b4bfd17109917de7b3143.css" rel="stylesheet">
	<link href="css/newstyle.css" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

    <link rel="icon" type="image/png" href="https://www.alpinabook.ru/favicon-32x32.png?v=WGG39kPBLm" sizes="32x32">
    <link rel="icon" type="image/png" href="https://www.alpinabook.ru/favicon-194x194.png?v=WGG39kPBLm" sizes="194x194">
    <link rel="icon" type="image/png" href="https://www.alpinabook.ru/favicon-96x96.png?v=WGG39kPBLm" sizes="96x96">
    <link rel="icon" type="image/png" href="https://www.alpinabook.ru/android-chrome-192x192.png?v=WGG39kPBLm"
          sizes="192x192">
    <link rel="icon" type="image/png" href="https://www.alpinabook.ru/favicon-16x16.png?v=WGG39kPBLm" sizes="16x16">
    <link rel="manifest" href="https://www.alpinabook.ru/manifest.json?v=WGG39kPBLm">
    <link rel="mask-icon" href="https://www.alpinabook.ru/safari-pinned-tab.svg?v=WGG39kPBLm">
    <link rel="shortcut icon" href="https://www.alpinabook.ru/favicon.ico?v=WGG39kPBLm">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/mstile-144x144.png?v=WGG39kPBLm">
    <meta name="theme-color" content="#ffffff">
	<?/*
	<meta property="og:title" content="Акция для премиум-клиентов Beeline" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="https://www.alpinabook.ru/actions/cybertuesday/" />
	<meta property="og:image" content="https://www.alpinabook.ru/actions/cybertuesday/img/headern.jpg" />
	<meta property="og:site_name" content="www.alpinabook.ru" />
	<meta property="fb:admins" content="1425804193" />
	<meta property="fb:app_id" content="138738742872757" /> */?>

</head>
<body>


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
        <p class="telephone" style="font-size: 14px;font-family: 'Walshein_regular'">
            +7 (495) 980 80 77
        </p>
    </div>
</header>

<?$i = 0;?>

    <div class="landing">
        <div class="mainWrapp">
            <div class="slide1">
				<div class="toptext">
					<img src="img/logonew.png" style="float:left;" />
					<img src="img/aplogo.png" style="float:right;" />
					<div class="clear">
					Совместная акция Интернет-магазина издательства
					<br />
					Альпина Паблишер и Boxberry
					</div>
				</div>
			</div>
            <div class="slide2">
				<h1>
					Доставка в пункты выдачи Boxberry
				</h1>
				<h2>
					БЕСПЛАТНО
					<br/>
					на все заказы!
				</h2>
				<h4>
					Акция действует до 23.07.2017
				</h4>
			</div>
			
			
            <div class="slide3">
				<div class="wrap3">
				<h3 style="margin:0; background:#fff;">
					Чтобы получить бесплатную доставку
				</h3>
				<div class="step">
					<div class="no">1</div>
					<div class="title">Добавьте в корзину<br />понравившуюся книгу</div>
					<img src="img/step1.png" />
				</div>
				<div class="arrow">→</div>
				<div class="step">
					<div class="no">2</div>
					<div class="title">Перейдите в корзину<br />и выберите удобный пункт выдачи</div>
					<img src="img/free.jpg" />
				</div>
				<div class="arrow">→</div>
				<div class="step">
					<div class="no">3</div>
					<div class="title">Завершите<br />оформление заказа</div>
					<img src="img/step3.png?2" />
				</div>
				</div>
				<div class="clear"></div>
				<a href="/catalog/bestsellers/?from=freedeliverylanding">Перейти к покупкам</a>
			</div>
			
			
			
			
			
			
			
			
			<div class="footer">
            </div>				
        </div>

    </div>

 </body>
 </html>
 