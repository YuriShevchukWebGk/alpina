<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER;
$today = date("w");
/*if ($today == 3) {
	header("Location: http://www.alpinabook.ru/actions/may32/");
	exit();
}*/?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="format-detection" content="telephone=no">
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <title>Киберпонедельник? Кибервторник!</title>
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

	<meta property="og:title" content="Киберпонедельник? Кибервторник!" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="http://www.alpinabook.ru/actions/cybertuesday/" />
	<meta property="og:image" content="http://www.alpinabook.ru/actions/cybertuesday/img/headern.jpg" />
	<meta property="og:site_name" content="www.alpinabook.ru" />
	<meta property="fb:admins" content="1425804193" />
	<meta property="fb:app_id" content="138738742872757" /> 

</head>
<body>
<style>
.bookWrap {
	display:inline-block;
	width:170px;
	height:225px;
	padding:20px 0;
}
.bookWrap a {
	text-decoration:none;
}
.diff {
	color: green!important;
	font-size: 14px!important;
}
.bookWrap img {
	width:140px;
	box-shadow: 0 9px 5px 0 rgba(0, 0, 0, 0.18), 0 10px 7px 0 rgba(0, 0, 0, 0.14);
}
.bookWrap p {
	padding: 10px 0 0;
}
.bookWrap span {
	color: #7b8c90;
	font-family: "Walshein_regular";
	font-size: 16px;
	position: relative;
	padding-top:15px;
	
}
.bookWrap .oldprice::before {
    content: "";
    width: 100%;
    height: 1px;
    background: #ff4126;
    position: absolute;
    top: 68%;
    left: 0;
}
.bookWrap .oldprice {
	font-size:14px;
}
.landing .bg, .hintWrapp {
	background:none;
	margin:0;
	padding:14px 0;
}
.mainWrapp {
	background:url(img/a.jpg) no-repeat 100% 26%, url(img/b.jpg) no-repeat 0% 39%,url(img/c.jpg) no-repeat 0% 68%,url(img/d.jpg) no-repeat 100% 100% #f7ebe0;
}
.landing .slide1 {
	background: url(img/headern201701.jpg) no-repeat 50% 50%;
}
.landing .slide2 {
	background: url(img/middle.jpg) no-repeat 50% 50%;
	height:585px;
    margin: 20px 0 14px;
}
.mainWrapp::before {
	height:auto;
}
.landing .footer img {
	margin:0;
}
header .lkWrapp {
    right: 33px;
}

.landing .a {
	background: url(img/a.png) no-repeat 50% 50%;
	height: 585px;
	margin: 20px 0 14px;	
}
.slide1 #slide1text {
	position: relative;
	margin: 0 auto;
	top: 473px;
	color: rgb(255, 255, 255);
	font-size: 24px;
	font-family: "Walshein_regular";
	text-align: center;
	width: 668px;	
	line-height:140%;
}
.titleMain {
    position: relative;
    padding-bottom: 25px;
    margin-bottom: 20px;
    color: #627478;
    font-family: "Walshein_regular";
    font-size: 24px;
    padding-top: 30px;
}
.titleMain::after {
	content: "";
	width: 140px;
	height: 3px;
	background: #627477;
	position: absolute;
	bottom: 0;
	left: 50%;
	margin: 0 0 0 -70px;	
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
</header>
<?$booksArray = array(
array('no'=>0, 'img'=>'/upload/resize_cache/iblock/841/140_270_1/8411c6f97bf15f2c7e827fc4591769ea.jpg', 'name'=>'Атлант расправил плечи (в 3-х томах)', 'discount'=>40, 'oldprice'=>1199, 'newprice'=>719.4, 'link'=>'/catalog/BusinessNovels/6115/', 'diff'=>479.6, 'id'=>6115),
array('no'=>1, 'img'=>'/upload/resize_cache/iblock/6ee/140_270_1/6eeda12a7e8b1b9de58c7591f823ebec.jpg', 'name'=>'SPQR: История Древнего Рима', 'discount'=>30, 'oldprice'=>725, 'newprice'=>507.5, 'link'=>'/catalog/PopularScience/90639/', 'diff'=>217.5, 'id'=>90639),
array('no'=>2, 'img'=>'/upload/resize_cache/iblock/fdc/140_270_1/fdcb64a96e155bdeb55629423bc17271.jpg', 'name'=>'Пиши, сокращай: Как создавать сильный текст', 'discount'=>30, 'oldprice'=>589, 'newprice'=>412.3, 'link'=>'/catalog/Marketing/81365/', 'diff'=>176.7, 'id'=>81365),
array('no'=>3, 'img'=>'/upload/resize_cache/iblock/6c8/140_270_1/6c8166e737b30343a4ce1f575eb1097b.jpg', 'name'=>'Битва за Рунет: Как власть манипулирует информацией и следит за каждым из нас', 'discount'=>40, 'oldprice'=>479, 'newprice'=>287.4, 'link'=>'/catalog/PublicismDocumentaryProse/89045/', 'diff'=>191.6, 'id'=>89045),
array('no'=>4, 'img'=>'/upload/resize_cache/iblock/1a0/140_270_1/1a04302caca56c9421b775be6d3ef486.jpg', 'name'=>'Доброе утро каждый день: Как рано вставать и все успевать', 'discount'=>30, 'oldprice'=>399, 'newprice'=>279.3, 'link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/80496/', 'diff'=>119.7, 'id'=>80496),
array('no'=>5, 'img'=>'/upload/resize_cache/iblock/69b/140_270_1/69b1e3379ddeb5aa3033e059bbb2d8dd.jpg', 'name'=>'Взрывной рост: Почему экспоненциальные организации в десятки раз продуктивнее вашей (и что с этим делать)', 'discount'=>30, 'oldprice'=>559, 'newprice'=>391.3, 'link'=>'/catalog/StartupsInnovativeEntrepreneurship/115583/', 'diff'=>167.7, 'id'=>115583),
array('no'=>6, 'img'=>'/upload/resize_cache/iblock/f14/140_270_1/f144022648b133b378fc14383598db8c.jpg', 'name'=>'Иностранный для взрослых: Как выучить новый язык в любом возрасте', 'discount'=>30, 'oldprice'=>479, 'newprice'=>335.3, 'link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/82845/', 'diff'=>143.7, 'id'=>82845),
array('no'=>7, 'img'=>'/upload/resize_cache/iblock/213/140_270_1/213fa194a0207161f052f170285ef6fd.jpg', 'name'=>'Мой взгляд на будущее мира', 'discount'=>30, 'oldprice'=>559, 'newprice'=>391.3, 'link'=>'/catalog/Economics/115014/', 'diff'=>167.7, 'id'=>115014),
array('no'=>8, 'img'=>'/upload/resize_cache/iblock/a8c/140_270_1/a8c2da982d3fc28a33e9c10ef25a2920.jpg', 'name'=>'Современные яды: Дозы, действие, последствия', 'discount'=>30, 'oldprice'=>479, 'newprice'=>335.3, 'link'=>'/catalog/PopularScience/84737/', 'diff'=>143.7, 'id'=>84737),
array('no'=>9, 'img'=>'/upload/resize_cache/iblock/7f8/140_270_1/7f86d9a2fde2004fed75d41128c0760b.jpg', 'name'=>'Работа с возражениями: 200 приемов продаж для холодных звонков и личных встреч', 'discount'=>30, 'oldprice'=>448, 'newprice'=>313.6, 'link'=>'/catalog/Sales/94415/', 'diff'=>134.4, 'id'=>94415),
array('no'=>10, 'img'=>'/upload/resize_cache/iblock/9d1/140_270_1/9d114306c33f0c81c32abb08d8ff34e3.jpg', 'name'=>'Анатомия истории: 22 шага к созданию успешного сценария', 'discount'=>40, 'oldprice'=>559, 'newprice'=>335.4, 'link'=>'/catalog/ArtOfWriting/79730/', 'diff'=>223.6, 'id'=>79730),
array('no'=>11, 'img'=>'/upload/resize_cache/iblock/7fe/140_270_1/7fe8a129b8a09109b56726b6b556c265.jpg', 'name'=>'Будущее работы: Что нужно делать сегодня, чтобы быть востребованным завтра', 'discount'=>40, 'oldprice'=>479, 'newprice'=>287.4, 'link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/7089/', 'diff'=>191.6, 'id'=>7089),
array('no'=>12, 'img'=>'/upload/resize_cache/iblock/5c8/140_270_1/5c82584b7cccf32f9624000ed930285f.jpg', 'name'=>'Будущее разума', 'discount'=>30, 'oldprice'=>529, 'newprice'=>370.3, 'link'=>'/catalog/PopularScience/8290/', 'diff'=>158.7, 'id'=>8290),
array('no'=>13, 'img'=>'/upload/resize_cache/iblock/089/140_270_1/0891627cedc50f0ed139ea937b591090.jpg', 'name'=>'В поисках энергии: Ресурсные войны, новые технологии и будущее энергетики', 'discount'=>30, 'oldprice'=>1199, 'newprice'=>839.3, 'link'=>'/catalog/Economics/8052/', 'diff'=>359.7, 'id'=>8052),
array('no'=>14, 'img'=>'/upload/resize_cache/iblock/9ca/140_270_1/9cae643a0b6a3321c10fe0c46837c832.png', 'name'=>'Вязание без слез: Базовые техники и понятные схемы для создания изделий любого размера', 'discount'=>40, 'oldprice'=>448, 'newprice'=>268.8, 'link'=>'/catalog/CreativityAndCreation/68998/', 'diff'=>179.2, 'id'=>68998),
array('no'=>15, 'img'=>'/upload/resize_cache/iblock/151/140_270_1/151be4194890b1b5fde34e6307134de1.jpg', 'name'=>'География гениальности: Где и почему рождаются великие идеи', 'discount'=>40, 'oldprice'=>479, 'newprice'=>287.4, 'link'=>'/catalog/CreativityAndCreation/80512/', 'diff'=>191.6, 'id'=>80512),
array('no'=>16, 'img'=>'/upload/resize_cache/iblock/ef9/140_270_1/ef92d13119c1a35cc9a360041bd326df.jpg', 'name'=>'Век тревожности: Страхи, надежды, неврозы и поиски душевного покоя', 'discount'=>40, 'oldprice'=>479, 'newprice'=>287.4, 'link'=>'/catalog/PopularPsychologyPersonalEffectiveness/66418/', 'diff'=>191.6, 'id'=>66418),
array('no'=>17, 'img'=>'/upload/resize_cache/iblock/e23/140_270_1/e239ba5966620c68bb98d25a472f828d.jpg', 'name'=>'Голубая точка. Космическое будущее человечества', 'discount'=>30, 'oldprice'=>479, 'newprice'=>335.3, 'link'=>'/catalog/PopularScience/75264/', 'diff'=>143.7, 'id'=>75264),
array('no'=>18, 'img'=>'/upload/resize_cache/iblock/065/140_270_1/0650a925343a7fa64d73fd62fe227fca.jpg', 'name'=>'Двухшаговые продажи: Практические рекомендации', 'discount'=>40, 'oldprice'=>399, 'newprice'=>239.4, 'link'=>'/catalog/Sales/8342/', 'diff'=>159.6, 'id'=>8342),
array('no'=>19, 'img'=>'/upload/resize_cache/iblock/c17/140_270_1/c17ce1ede7a262fc8e11c9ec6c0fa74c.png', 'name'=>'Еда без границ. Правила вкусных путешествий', 'discount'=>40, 'oldprice'=>448, 'newprice'=>268.8, 'link'=>'/catalog/HobbyTravelingCars/92702/', 'diff'=>179.2, 'id'=>92702),
array('no'=>20, 'img'=>'/upload/resize_cache/iblock/9b4/140_270_1/9b4b4df5c8f68a11a1a293cbcc1b63a8.png', 'name'=>'Торт: Кулинарный детектив', 'discount'=>40, 'oldprice'=>399, 'newprice'=>239.4, 'link'=>'/catalog/Fiction/89560/', 'diff'=>159.6, 'id'=>89560),
array('no'=>21, 'img'=>'/upload/resize_cache/iblock/ddf/140_270_1/ddfcb363f585e3ad69f878a8b7e81f00.jpg', 'name'=>'Захватчики: Люди и собаки против неандертальцев', 'discount'=>30, 'oldprice'=>448, 'newprice'=>313.6, 'link'=>'/catalog/PopularScience/86999/', 'diff'=>134.4, 'id'=>86999),
array('no'=>22, 'img'=>'/upload/resize_cache/iblock/d07/140_270_1/d07c4d0661ee0bbb0622eea90a43899f.jpg', 'name'=>'Искусство жить просто: Как избавиться от лишнего и обогатить свою жизнь (Покетбук)', 'discount'=>40, 'oldprice'=>318, 'newprice'=>190.8, 'link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8272/', 'diff'=>127.2, 'id'=>8272),
array('no'=>23, 'img'=>'/upload/resize_cache/iblock/ede/140_270_1/ede16721e1422a179217cf9c5b1c3bbf.jpg', 'name'=>'Как мы покупали русский интернет', 'discount'=>40, 'oldprice'=>479, 'newprice'=>287.4, 'link'=>'/catalog/SuccessStory/93327/', 'diff'=>191.6, 'id'=>93327),
array('no'=>24, 'img'=>'/upload/resize_cache/iblock/48b/140_270_1/48b25d6b4d76105e6d7a7a87973c8340.jpg', 'name'=>'Культурный код: Как мы живем, что покупаем и почему', 'discount'=>40, 'oldprice'=>479, 'newprice'=>287.4, 'link'=>'/catalog/Marketing/5787/', 'diff'=>191.6, 'id'=>5787),
array('no'=>25, 'img'=>'/upload/resize_cache/iblock/2c1/140_270_1/2c141a801368a26f03e13d64d6759f75.jpg', 'name'=>'Математическая смекалка', 'discount'=>40, 'oldprice'=>448, 'newprice'=>268.8, 'link'=>'/catalog/CreativityAndCreation/68989/', 'diff'=>179.2, 'id'=>68989),
array('no'=>26, 'img'=>'/upload/resize_cache/iblock/64a/140_270_1/64a6027fa7fdbe80c375598f0647f0fb.jpg', 'name'=>'Поток: Психология оптимального переживания', 'discount'=>40, 'oldprice'=>448, 'newprice'=>268.8, 'link'=>'/catalog/PopularPsychologyPersonalEffectiveness/66494/', 'diff'=>179.2, 'id'=>66494),
array('no'=>27, 'img'=>'/upload/resize_cache/iblock/bec/140_270_1/beca338fbb8a11ac0a9b51f74f6a35fa.jpg', 'name'=>'Развитие памяти по методикам спецслужб: Карманная версия', 'discount'=>40, 'oldprice'=>399, 'newprice'=>239.4, 'link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8522/', 'diff'=>159.6, 'id'=>8522),
array('no'=>28, 'img'=>'/upload/resize_cache/iblock/92f/140_270_1/92f54b5767eb71aad316d9043fdcc6de.jpg', 'name'=>'Странная девочка, которая влюбилась в мозг: Как знание нейробиологии помогает стать привлекательнее, счастливее и лучше', 'discount'=>40, 'oldprice'=>479, 'newprice'=>287.4, 'link'=>'/catalog/PopularPsychologyPersonalEffectiveness/8712/', 'diff'=>191.6, 'id'=>8712),
array('no'=>29, 'img'=>'/upload/resize_cache/iblock/b81/140_270_1/b816d8a17d57b69b01d88597e0ad0aa3.jpg', 'name'=>'Темная материя и динозавры: Удивительная взаимосвязь событий во Вселенной', 'discount'=>30, 'oldprice'=>559, 'newprice'=>391.3, 'link'=>'/catalog/PopularScience/94623/', 'diff'=>167.7, 'id'=>94623),
array('no'=>30, 'img'=>'/upload/resize_cache/iblock/767/140_270_1/767635674b4bd22b91610dab4e7e0cd1.jpg', 'name'=>'Стив Джобс о бизнесе: 250 высказываний человека, изменившего мир', 'discount'=>40, 'oldprice'=>399, 'newprice'=>239.4, 'link'=>'/catalog/SuccessStory/7143/', 'diff'=>159.6, 'id'=>7143),
array('no'=>31, 'img'=>'/upload/resize_cache/iblock/dd1/140_270_1/dd112b8b4c6cb26f22213635e5037af5.jpg', 'name'=>'Навыки ребенка в действии: Как помочь детям преодолеть психологические проблемы', 'discount'=>40, 'oldprice'=>269, 'newprice'=>161.4, 'link'=>'/catalog/BooksForParents/7643/', 'diff'=>107.6, 'id'=>7643),
array('no'=>32, 'img'=>'/upload/resize_cache/iblock/01c/140_270_1/01cc08bc7e472ec8a742635026de2526.png', 'name'=>'Как начать жить и не облажаться', 'discount'=>40, 'oldprice'=>448, 'newprice'=>268.8, 'link'=>'/catalog/PopularPsychologyPersonalEffectiveness/84633/', 'diff'=>179.2, 'id'=>84633),
array('no'=>33, 'img'=>'/upload/resize_cache/iblock/50e/140_270_1/50e9875b74c36faafe9435dd25bb6dfd.jpg', 'name'=>'Я английский бульдог', 'discount'=>40, 'oldprice'=>299, 'newprice'=>179.4, 'link'=>'/catalog/KnigiDlyaDetei/82282/', 'diff'=>119.6, 'id'=>82282),
array('no'=>34, 'img'=>'/upload/resize_cache/iblock/4a5/140_270_1/4a5ce1635f0501f43b5d40cde91899e2.jpg', 'name'=>'Управление результативностью: Как преодолеть разрыв между объявленной стратегией и реальными процессами', 'discount'=>40, 'oldprice'=>599, 'newprice'=>359.4, 'link'=>'/catalog/GeneralManagment/8788/', 'diff'=>239.6, 'id'=>8788),
array('no'=>35, 'img'=>'/upload/resize_cache/iblock/034/140_270_1/0341a322a5dfbba3aa42fb29f15980f6.jpg', 'name'=>'Антистресс для занятых людей: Медитативная раскраска (Макси)', 'discount'=>40, 'oldprice'=>399, 'newprice'=>239.4, 'link'=>'/catalog/CreativityAndCreation/8624/', 'diff'=>159.6, 'id'=>8624),
array('no'=>36, 'img'=>'/upload/resize_cache/iblock/c02/140_270_1/c0218856aef4811ca7f7c0805ecdd54e.jpg', 'name'=>'E-Learning: Как сделать электронное обучение понятным, качественным и доступным', 'discount'=>40, 'oldprice'=>799, 'newprice'=>479.4, 'link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8860/', 'diff'=>319.6, 'id'=>8860),
array('no'=>37, 'img'=>'/upload/resize_cache/iblock/d19/140_270_1/d19be8f7bccdd1daabac8ccfdd92c92d.jpg', 'name'=>'Икигай: Японский секрет долгой и счастливой жизни', 'discount'=>30, 'oldprice'=>399, 'newprice'=>279.3, 'link'=>'/catalog/PopularPsychologyPersonalEffectiveness/67639/', 'diff'=>119.7, 'id'=>67639),
array('no'=>38, 'img'=>'/upload/resize_cache/iblock/5a5/140_270_1/5a55d11db008d2787e1727133d9fd57c.jpg', 'name'=>'Играем в науку', 'discount'=>30, 'oldprice'=>479, 'newprice'=>335.3, 'link'=>'/catalog/KnigiDlyaDetei/117349/', 'diff'=>143.7, 'id'=>117349),
array('no'=>39, 'img'=>'/upload/resize_cache/iblock/532/140_270_1/532f0db427c546f4e691d071075857e4.jpg', 'name'=>'Проектируя бизнес: Как захватить рынок, адаптируясь к переменам. Опыт Coca-Cola', 'discount'=>30, 'oldprice'=>529, 'newprice'=>370.3, 'link'=>'/catalog/ProjectManagment/67413/', 'diff'=>158.7, 'id'=>67413),
array('no'=>40, 'img'=>'/upload/resize_cache/iblock/9a5/140_270_1/9a54cef90d970b87fd0cef3103c76630.jpg', 'name'=>'Правила любви', 'discount'=>40, 'oldprice'=>399, 'newprice'=>239.4, 'link'=>'/catalog/PopularPsychologyPersonalEffectiveness/6307/', 'diff'=>159.6, 'id'=>6307),
array('no'=>41, 'img'=>'/upload/resize_cache/iblock/9d5/140_270_1/9d517448b84b28f8d065fe6e28cca1ce.jpg', 'name'=>'Теперь я ем всё, что хочу! Система питания Давида Яна', 'discount'=>30, 'oldprice'=>285, 'newprice'=>199.5, 'link'=>'/catalog/HealthAndHealthyFood/7653/', 'diff'=>85.5, 'id'=>7653),
array('no'=>42, 'img'=>'/upload/resize_cache/iblock/9cc/140_270_1/9cc9b5ab511fac8f2e4d978557a986d9.jpg', 'name'=>'Спортивное питание: Что есть до, во время и после тренировки', 'discount'=>30, 'oldprice'=>529, 'newprice'=>370.3, 'link'=>'/catalog/HealthAndHealthyFood/68979/', 'diff'=>158.7, 'id'=>68979),
array('no'=>43, 'img'=>'/upload/resize_cache/iblock/326/140_270_1/326ddd9d7b7ac62bd8a9ed1fac9d0f74.jpg', 'name'=>'Вечер веселых танцев', 'discount'=>40, 'oldprice'=>239, 'newprice'=>143.4, 'link'=>'/catalog/KnigiDlyaDetei/8636/', 'diff'=>95.6, 'id'=>8636),
array('no'=>44, 'img'=>'/upload/resize_cache/iblock/f2c/140_270_1/f2c1ce83ab67b54fb0343d3cf7937724.jpg', 'name'=>'Будущее медицины: Ваше здоровье в ваших руках', 'discount'=>30, 'oldprice'=>599, 'newprice'=>419.3, 'link'=>'/catalog/PopularScience/76690/', 'diff'=>179.7, 'id'=>76690),
array('no'=>45, 'img'=>'/upload/resize_cache/iblock/e48/140_270_1/e485722857500f0fb00557f28c8a85b8.jpg', 'name'=>'Как стать богатым', 'discount'=>30, 'oldprice'=>399, 'newprice'=>279.3, 'link'=>'/catalog/SuccessStory/6001/', 'diff'=>119.7, 'id'=>6001),
array('no'=>46, 'img'=>'/upload/resize_cache/iblock/a8a/140_270_1/a8a67117c42a23b412228eb6f7879c48.jpg', 'name'=>'15 секретов управления временем: Как успешные люди успевают все', 'discount'=>40, 'oldprice'=>448, 'newprice'=>268.8, 'link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/80824/', 'diff'=>179.2, 'id'=>80824),
array('no'=>47, 'img'=>'/upload/resize_cache/iblock/ef1/140_270_1/ef1e5f448b9806a7f46f49eed125cb3b.jpg', 'name'=>'Идеальный маркетинг: О чем забыли 98% маркетологов', 'discount'=>40, 'oldprice'=>609, 'newprice'=>365.4, 'link'=>'/catalog/Marketing/8498/', 'diff'=>243.6, 'id'=>8498),
array('no'=>48, 'img'=>'/upload/resize_cache/iblock/5b0/140_270_1/5b04862da9b3f3cf3bd141fa546a0087.jpg', 'name'=>'Хороший стресс как способ стать сильнее и лучше', 'discount'=>30, 'oldprice'=>529, 'newprice'=>370.3, 'link'=>'/catalog/PopularPsychologyPersonalEffectiveness/69966/', 'diff'=>158.7, 'id'=>69966),
array('no'=>49, 'img'=>'/upload/resize_cache/iblock/8a0/140_270_1/8a0c73a6c41bb16aba2e135b27568d3e.jpg', 'name'=>'Конверсия: Как превратить лиды в продажи', 'discount'=>30, 'oldprice'=>529, 'newprice'=>370.3, 'link'=>'/catalog/Marketing/92952/', 'diff'=>158.7, 'id'=>92952),

);?>

<?$i = 0;?>

    <div class="landing">
        <div class="mainWrapp">
            <div class="slide1">
				<div id="slide1text">
                Не сбавляем обороты, не переводим дух!<br />
				Честные скидки от <b>30%</b> до <b>40%</b> на лучшие новинки зимы<br /> и
				бестселлеры всех времён (года)
				</div>
            </div>
			<?if ($USER->isAdmin()) {?><center><iframe src="files/bf.html" height="420" width="100%" scrolling="no" style="border:none;margin:0 auto;"></iframe></center><?}?>
			<div class="bg">
				<div class="hintWrapp">
				<?foreach ($booksArray as $book) {
					if ($i < 24) {?>
					<div class="bookWrap">
						<a href="<?=$book["link"]?>?from=cybertuesday">
							<img src="<?=$book["img"]?>" alt="<?=$book["name"]?>" title="<?=$book["name"]?>" />
							<p>
							<span class="oldprice"><?=$book["oldprice"]?> руб.</span> <span class="diff">-<?=$book["diff"]?> руб.</span>
							<br />
							<span class="newprice"><?=$book["newprice"]?> руб.</span>
							</p>
						</a>
					</div>
					<?
					$i++;
					}
				}?>
				</div>
				<div class="slide2"></div>
				<div class="hintWrapp">
				<?
				$i = 0;
				foreach ($booksArray as $book) {
					if ($i > 23) {?>
					<div class="bookWrap">
						<a href="<?=$book["link"]?>?from=cybertuesday">
							<img src="<?=$book["img"]?>" alt="<?=$book["name"]?>" title="<?=$book["name"]?>" />
							<p>
							<span class="oldprice"><?=$book["oldprice"]?> руб.</span> <span class="diff">-<?=$book["diff"]?> руб.</span>
							<br />
							<span class="newprice"><?=$book["newprice"]?> руб.</span>
							</p>
						</a>
					</div>
					<?
					}
					$i++;
				}?>
				</div>
			</div>

        </div>

        <div class="footer">
            <img src="img/footer.jpg" alt="" />
			<script type="text/javascript" src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js" charset="utf-8"></script>
			<script type="text/javascript" src="//yastatic.net/share2/share.js" charset="utf-8"></script>
			<div class="ya-share2" data-services="vkontakte,facebook" data-counter="" style="position: absolute;left: 48%;bottom: 200px;"></div>
        </div>
    </div>

 </body>
 </html>
 