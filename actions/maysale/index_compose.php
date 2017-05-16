<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER;

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
    <title>Бумажные книги по 99 рублей, электронные — по 75 рублей!</title>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <link href="css/style.css?1" rel="stylesheet">
    <link href="css/template_57363f3dd71b4bfd17109917de7b3143.css?1" rel="stylesheet">

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

	<meta property="og:title" content="Бумажные книги по 99 рублей, электронные — по 75 рублей!" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="http://www.alpinabook.ru/actions/maysale/" />
	<meta property="og:image" content="http://www.alpinabook.ru/actions/maysale/img/header20170502.jpg" />
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
#slide1text {
	position: absolute;
	margin:0 auto;
	width:100%;
	top:130px;
	color: rgb(255, 255, 255);
	font-size: 40px;
	font-family: "Walshein_regular";
	text-align: center;
	line-height:140%;
}
#slide2text {
	margin:-300px auto 0;
	text-transform:uppercase;
	width:100%;
	color: rgb(255, 255, 255);
	font-size: 40px;
	font-family: "Walshein_bold";
	text-align: center;
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
array('no'=>0, 'img'=>'/upload/resize_cache/iblock/6ed/140_270_1/6ed46214621f5ecce18d9f9a41aeaf53.jpg', 'name'=>'Хватит мечтать, займись делом! Почему важнее хорошо работать, чем искать хорошую работу', 'discount'=>1, 'oldprice'=>448, 'newprice'=>443.52, 'link'=>'/catalog/PopularPsychologyPersonalEffectiveness/8412/', 'diff'=>4,48, 'id'=>8412),
array('no'=>1, 'img'=>'/upload/resize_cache/iblock/c75/140_270_1/c75ceb7c3888ffdaeb35af881a01d246.jpg', 'name'=>'О пользе лени: Инструкция по продуктивному ничегонеделанию', 'discount'=>1, 'oldprice'=>479, 'newprice'=>474.21, 'link'=>'/catalog/PopularPsychologyPersonalEffectiveness/8143/', 'diff'=>4,79, 'id'=>8143),
array('no'=>2, 'img'=>'/upload/resize_cache/iblock/a8d/140_270_1/a8db1715c52d120fcabadb3879bb0f7a.jpg', 'name'=>'Режим гения: Распорядок дня великих людей', 'discount'=>1, 'oldprice'=>479, 'newprice'=>474.21, 'link'=>'/catalog/PopularPsychologyPersonalEffectiveness/7819/', 'diff'=>4,79, 'id'=>7819),
array('no'=>3, 'img'=>'/upload/resize_cache/iblock/507/140_270_1/5070e84d30b1d9feed23940f8f0b8b8d.jpg', 'name'=>'Счастье по расчету: Как управлять своей жизнью, чтобы быть счастливым каждый день', 'discount'=>1, 'oldprice'=>479, 'newprice'=>474.21, 'link'=>'/catalog/PopularPsychologyPersonalEffectiveness/8578/', 'diff'=>4,79, 'id'=>8578),
array('no'=>4, 'img'=>'/upload/resize_cache/iblock/0a8/140_270_1/0a8791c38ccacdc8a9ff77db4772d58f.jpg', 'name'=>'Все лгут: Как выявить обман по мимике и жестам', 'discount'=>1, 'oldprice'=>318, 'newprice'=>314.82, 'link'=>'/catalog/PopularPsychologyPersonalEffectiveness/8206/', 'diff'=>3,18, 'id'=>8206),
array('no'=>5, 'img'=>'/upload/resize_cache/iblock/f67/140_270_1/f67293d937ff9fa9889c12bb6e1a1326.jpg', 'name'=>'Мужская лаборатория Джеймса Мэя: Книга о полезных вещах', 'discount'=>1, 'oldprice'=>399, 'newprice'=>395.01, 'link'=>'/catalog/CreativityAndCreation/7746/', 'diff'=>3,99, 'id'=>7746),
array('no'=>6, 'img'=>'/upload/resize_cache/iblock/391/140_270_1/391208541ebd5750c8f29f6523a3b2bf.jpg', 'name'=>'Не в знании сила: Как сомнения помогают нам развиваться', 'discount'=>1, 'oldprice'=>479, 'newprice'=>474.21, 'link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8440/', 'diff'=>4,79, 'id'=>8440),
array('no'=>7, 'img'=>'/upload/resize_cache/iblock/64e/140_270_1/64e6d7c4b73f51391a63fe243dc615b7.jpg', 'name'=>'Трололо: Нельзя просто так взять и выпустить книгу про троллинг', 'discount'=>1, 'oldprice'=>529, 'newprice'=>523.71, 'link'=>'/catalog/PopularPsychologyPersonalEffectiveness/8752/', 'diff'=>5,29, 'id'=>8752),
array('no'=>8, 'img'=>'/upload/resize_cache/iblock/28e/140_270_1/28e35d09a84aac34326cae684d26a313.jpg', 'name'=>'Города мечты', 'discount'=>1, 'oldprice'=>199, 'newprice'=>197.01, 'link'=>'/catalog/CreativityAndCreation/60919/', 'diff'=>1,99, 'id'=>60919),
array('no'=>9, 'img'=>'/upload/resize_cache/iblock/c58/140_270_1/c589a1014a40ab607fc8b44427f42bc6.jpg', 'name'=>'Борода и философия', 'discount'=>1, 'oldprice'=>448, 'newprice'=>443.52, 'link'=>'/catalog/Gifts/8710/', 'diff'=>4,48, 'id'=>8710),
array('no'=>10, 'img'=>'/upload/resize_cache/iblock/2fe/140_270_1/2fe6fe5ae71e64753045e2bdafc902c8.jpg', 'name'=>'Свобода воли, которой не существует (карманный формат)', 'discount'=>1, 'oldprice'=>318, 'newprice'=>314.82, 'link'=>'/catalog/PopularPsychologyPersonalEffectiveness/8448/', 'diff'=>3,18, 'id'=>8448),
array('no'=>11, 'img'=>'/upload/resize_cache/iblock/e1d/140_270_1/e1d2744f34872dacb9bcf754689913cc.jpg', 'name'=>'Ройзман: Уральский Робин Гуд', 'discount'=>1, 'oldprice'=>479, 'newprice'=>474.21, 'link'=>'/catalog/BiographiesAndMemoirs/8212/', 'diff'=>4,79, 'id'=>8212),
array('no'=>12, 'img'=>'/upload/resize_cache/iblock/0e5/140_270_1/0e566b173d53044f31195143199d02ad.jpg', 'name'=>'Путь журналиста', 'discount'=>1, 'oldprice'=>479, 'newprice'=>474.21, 'link'=>'/catalog/BiographiesAndMemoirs/6607/', 'diff'=>4,79, 'id'=>6607),
array('no'=>13, 'img'=>'/upload/resize_cache/iblock/53b/140_270_1/53b502855830cb802967be7d9acc749a.jpg', 'name'=>'Книга о вкусных и здоровых отношениях: Как приготовить дружбу, любовь и взаимопонимание', 'discount'=>1, 'oldprice'=>488, 'newprice'=>483.12, 'link'=>'/catalog/PopularPsychologyPersonalEffectiveness/8352/', 'diff'=>4,88, 'id'=>8352),
array('no'=>14, 'img'=>'/upload/resize_cache/iblock/3e2/140_270_1/3e27f001d85fe846168c81500f1053be.jpg', 'name'=>'Стратегия семейной жизни: Как реже мыть посуду, чаще заниматься сексом и меньше ссориться', 'discount'=>1, 'oldprice'=>429, 'newprice'=>424.71, 'link'=>'/catalog/PopularPsychologyPersonalEffectiveness/8024/', 'diff'=>4,29, 'id'=>8024),
array('no'=>15, 'img'=>'/upload/resize_cache/iblock/930/140_270_1/9301f3d2817f1673fc81aa15d03965e3.jpg', 'name'=>'Все сложно: Как спасти отношения, если вы рассержены, обижены или в отчаянии', 'discount'=>1, 'oldprice'=>399, 'newprice'=>395.01, 'link'=>'/catalog/PopularPsychologyPersonalEffectiveness/8546/', 'diff'=>3,99, 'id'=>8546),
array('no'=>16, 'img'=>'/upload/resize_cache/iblock/eae/140_270_1/eae99ea882677e685039b6ae467451dc.jpg', 'name'=>'Как разговаривать с кем угодно, когда угодно и где угодно', 'discount'=>1, 'oldprice'=>448, 'newprice'=>443.52, 'link'=>'/catalog/NegotiationsBusinessCommunication/7032/', 'diff'=>4,48, 'id'=>7032),
array('no'=>17, 'img'=>'/upload/resize_cache/iblock/ab9/140_270_1/ab959ada6b23d9d2f3031e82de2958ff.jpg', 'name'=>'Стратегия успеха: Как избавиться от навязанных стереотипов и найти свой путь', 'discount'=>1, 'oldprice'=>559, 'newprice'=>553.41, 'link'=>'/catalog/PopularPsychologyPersonalEffectiveness/7962/', 'diff'=>5,59, 'id'=>7962),
array('no'=>18, 'img'=>'/upload/resize_cache/iblock/2e2/140_270_1/2e231efea8357c9530aa5e8deac7de33.jpg', 'name'=>'Сильный ход: Нестандартные решения в рекламе', 'discount'=>1, 'oldprice'=>448, 'newprice'=>443.52, 'link'=>'/catalog/Marketing/60931/', 'diff'=>4,48, 'id'=>60931),
array('no'=>19, 'img'=>'/upload/resize_cache/iblock/9ab/140_270_1/9ab771a4fde140fd460463b4900f42c3.jpg', 'name'=>'Круто! Как подсознательное стремление выделиться правит экономикой и формирует облик нашего мира', 'discount'=>1, 'oldprice'=>529, 'newprice'=>523.71, 'link'=>'/catalog/Marketing/8858/', 'diff'=>5,29, 'id'=>8858),
array('no'=>20, 'img'=>'/upload/resize_cache/iblock/7cc/140_270_1/7ccee3c318a3c3351bca353407bbd10a.jpg', 'name'=>'Человек уставший: Как победить хроническую усталость и вернуть себе силы, энергию и радость жизни', 'discount'=>1, 'oldprice'=>479, 'newprice'=>474.21, 'link'=>'/catalog/HealthAndHealthyFood/8386/', 'diff'=>4,79, 'id'=>8386),
array('no'=>21, 'img'=>'/upload/resize_cache/iblock/b1c/140_270_1/b1cf66a2e9b02c088fc7fd492bcc6571.jpg', 'name'=>'Умным диеты не нужны: Последние научные открытия в области борьбы с лишним весом', 'discount'=>1, 'oldprice'=>479, 'newprice'=>474.21, 'link'=>'/catalog/HealthAndHealthyFood/8502/', 'diff'=>4,79, 'id'=>8502),
array('no'=>22, 'img'=>'/upload/resize_cache/iblock/5d4/140_270_1/5d434e74b97a3295d25cd64434268a47.jpg', 'name'=>'Цифровая диета: Как победить зависимость от гаджетов и технологий', 'discount'=>1, 'oldprice'=>448, 'newprice'=>443.52, 'link'=>'/catalog/PopularPsychologyPersonalEffectiveness/8426/', 'diff'=>4,48, 'id'=>8426),
array('no'=>23, 'img'=>'/upload/resize_cache/iblock/e85/140_270_1/e85c55931783719faeb77b1b35b39a14.jpg', 'name'=>'Совершенная машина продаж: 12 проверенных стратегий эффективности бизнеса', 'discount'=>1, 'oldprice'=>559, 'newprice'=>553.41, 'link'=>'/catalog/Sales/7799/', 'diff'=>5,59, 'id'=>7799),
array('no'=>24, 'img'=>'/upload/resize_cache/iblock/765/140_270_1/765ebfd073076485ff8dc14d4a9f8c1b.jpg', 'name'=>'Главная книга основателя бизнеса: Кого брать с собой, как делить прибыль, как распределять роли и другие вопросы, которые надо решить с самого начала', 'discount'=>1, 'oldprice'=>725, 'newprice'=>717.75, 'link'=>'/catalog/StartupsInnovativeEntrepreneurship/7932/', 'diff'=>7,25, 'id'=>7932),
array('no'=>25, 'img'=>'/upload/resize_cache/iblock/532/140_270_1/532f0db427c546f4e691d071075857e4.jpg', 'name'=>'Проектируя бизнес: Как захватить рынок, адаптируясь к переменам. Опыт Coca-Cola', 'discount'=>1, 'oldprice'=>529, 'newprice'=>523.71, 'link'=>'/catalog/ProjectManagment/67413/', 'diff'=>5,29, 'id'=>67413),
array('no'=>26, 'img'=>'/upload/resize_cache/iblock/791/140_270_1/791fce5ee7944e74ff8ae0a47fc46591.jpg', 'name'=>'Твитономика: Все, что нужно знать об экономике, коротко и по существу', 'discount'=>1, 'oldprice'=>314, 'newprice'=>310.86, 'link'=>'/catalog/Policy/7952/', 'diff'=>3,14, 'id'=>7952),
array('no'=>27, 'img'=>'/upload/resize_cache/iblock/323/140_270_1/323be80f23f0fd34353c3d79b89b58cc.jpg', 'name'=>'Иллюзия выбора: Кто принимает решения за нас и почему это не всегда плохо', 'discount'=>1, 'oldprice'=>529, 'newprice'=>523.71, 'link'=>'/catalog/PopularPsychologyPersonalEffectiveness/60907/', 'diff'=>5,29, 'id'=>60907),
array('no'=>28, 'img'=>'/upload/resize_cache/iblock/513/140_270_1/513bce4505ea97433f040ea68673e1a4.jpg', 'name'=>'Полицейская проверка: Практические рекомендации адвоката по защите бизнеса', 'discount'=>1, 'oldprice'=>559, 'newprice'=>553.41, 'link'=>'/catalog/Law/8356/', 'diff'=>5,59, 'id'=>8356),
array('no'=>29, 'img'=>'/upload/resize_cache/iblock/5b8/140_270_1/5b827eb0c7f25ec756e1e328c257a84c.jpg', 'name'=>'Стартап: Модель для сборки', 'discount'=>1, 'oldprice'=>399, 'newprice'=>395.01, 'link'=>'/catalog/StartupsInnovativeEntrepreneurship/75688/', 'diff'=>3,99, 'id'=>75688),
array('no'=>30, 'img'=>'/upload/resize_cache/iblock/5e6/140_270_1/5e62f9d5ed7e209d358aa54636c456ac.jpg', 'name'=>'Самый счастливый малыш на детской площадке: Как воспитывать ребенка от года до четырех лет дружелюбным, терпеливым и послушным', 'discount'=>1, 'oldprice'=>448, 'newprice'=>443.52, 'link'=>'/catalog/BooksForParents/67906/', 'diff'=>4,48, 'id'=>67906),
array('no'=>31, 'img'=>'/upload/resize_cache/iblock/26f/140_270_1/26fc811cf7efe9b1c45b371a85666482.jpg', 'name'=>'Все на одного: Как защитить ребенка от травли в школе', 'discount'=>1, 'oldprice'=>369, 'newprice'=>365.31, 'link'=>'/catalog/BooksForParents/60925/', 'diff'=>3,69, 'id'=>60925),
array('no'=>32, 'img'=>'/upload/resize_cache/iblock/ee1/140_270_1/ee1eb859939d26fe38d6d0703b7e3399.jpg', 'name'=>'Баловать нельзя контролировать: Как воспитать счастливого ребенка', 'discount'=>1, 'oldprice'=>399, 'newprice'=>395.01, 'link'=>'/catalog/BooksForParents/8151/', 'diff'=>3,99, 'id'=>8151),
array('no'=>33, 'img'=>'/upload/resize_cache/iblock/a4b/140_270_1/a4b975280575017d8529cd959c997faf.jpg', 'name'=>'Воспитание без шаблонов: Научитесь слышать своего ребенка', 'discount'=>1, 'oldprice'=>479, 'newprice'=>474.21, 'link'=>'/catalog/BooksForParents/69015/', 'diff'=>4,79, 'id'=>69015),
array('no'=>34, 'img'=>'/upload/resize_cache/iblock/f73/140_270_1/f73f7cb86f6ce35e0fad0476037a3ab3.jpg', 'name'=>'160 развивающих игр для детей от рождения до трех лет', 'discount'=>1, 'oldprice'=>448, 'newprice'=>443.52, 'link'=>'/catalog/BooksForParents/7893/', 'diff'=>4,48, 'id'=>7893),
array('no'=>35, 'img'=>'/upload/resize_cache/iblock/783/140_270_1/783ae34a4c791999f4a9f8d6ef127e64.jpg', 'name'=>'Разговоры с детьми на сложные темы', 'discount'=>1, 'oldprice'=>399, 'newprice'=>395.01, 'link'=>'/catalog/BooksForParents/67424/', 'diff'=>3,99, 'id'=>67424),
array('no'=>36, 'img'=>'/upload/resize_cache/iblock/750/140_270_1/750e79019c9617e3194099da233a022d.jpg', 'name'=>'Торт: Кулинарный детектив', 'discount'=>1, 'oldprice'=>399, 'newprice'=>395.01, 'link'=>'/catalog/Fiction/89560/', 'diff'=>3,99, 'id'=>89560),
array('no'=>37, 'img'=>'/upload/resize_cache/iblock/6ed/140_270_1/6ed839f43c3383f9b2c9f23fc7a8de47.jpg', 'name'=>'Как мы делаем это: Эволюция и будущее репродуктивного поведения человека', 'discount'=>1, 'oldprice'=>479, 'newprice'=>474.21, 'link'=>'/catalog/PopularScience/8848/', 'diff'=>4,79, 'id'=>8848),
array('no'=>38, 'img'=>'/upload/resize_cache/iblock/b07/140_270_1/b077d8525c94f33970ff9e55eb45c066.jpg', 'name'=>'Миф о красоте: Стереотипы против женщин', 'discount'=>1, 'oldprice'=>559, 'newprice'=>553.41, 'link'=>'/catalog/PopularPsychologyPersonalEffectiveness/7871/', 'diff'=>5,59, 'id'=>7871),
array('no'=>39, 'img'=>'/upload/resize_cache/iblock/3c5/140_270_1/3c5cdce6edd07150340335625b5d2f9d.jpg', 'name'=>'Люди и кирпичи: 10 архитектурных сооружений, которые изменили мир', 'discount'=>1, 'oldprice'=>529, 'newprice'=>523.71, 'link'=>'/catalog/CreativityAndCreation/8596/', 'diff'=>5,29, 'id'=>8596),
array('no'=>40, 'img'=>'/upload/resize_cache/iblock/938/140_270_1/93807dc56d614b675de9abd5de2100f3.jpg', 'name'=>'Эти странные американцы', 'discount'=>1, 'oldprice'=>366, 'newprice'=>362.34, 'link'=>'/catalog/HobbyTravelingCars/69970/', 'diff'=>3,66, 'id'=>69970),
array('no'=>41, 'img'=>'/upload/resize_cache/iblock/cc0/140_270_1/cc09f15f71dd9e5b3d63a95faa8df78d.jpg', 'name'=>'В ожидании Америки', 'discount'=>1, 'oldprice'=>399, 'newprice'=>395.01, 'link'=>'/catalog/PublicismDocumentaryProse/7595/', 'diff'=>3,99, 'id'=>7595),
array('no'=>42, 'img'=>'/upload/resize_cache/iblock/61b/140_270_1/61b4f8c4d6e97e762bc2674bc3b612da.jpg', 'name'=>'Русские налоговые сказки', 'discount'=>1, 'oldprice'=>399, 'newprice'=>395.01, 'link'=>'/catalog/PopularPsychologyPersonalEffectiveness/8040/', 'diff'=>3,99, 'id'=>8040),
array('no'=>43, 'img'=>'/upload/resize_cache/iblock/9c9/140_270_1/9c90036192157508084de96d6751e08e.jpg', 'name'=>'Тюремные люди', 'discount'=>1, 'oldprice'=>285, 'newprice'=>282.15, 'link'=>'/catalog/BiographiesAndMemoirs/8165/', 'diff'=>2,85, 'id'=>8165),
array('no'=>44, 'img'=>'/upload/resize_cache/iblock/0f1/140_270_1/0f1165356df3f89bf36d69c3c3ca4428.jpg', 'name'=>'Успеть за 120 минут: Как создать условия для максимально эффективной работы', 'discount'=>1, 'oldprice'=>399, 'newprice'=>395.01, 'link'=>'/catalog/TimeManagment/8856/', 'diff'=>3,99, 'id'=>8856),
array('no'=>45, 'img'=>'/upload/resize_cache/iblock/1e8/140_270_1/1e80df031dfb582222179c8038f51056.jpg', 'name'=>'Идеальное тело за 20 минут', 'discount'=>1, 'oldprice'=>775, 'newprice'=>767.25, 'link'=>'/catalog/HealthAndHealthyFood/8798/', 'diff'=>7,75, 'id'=>8798),

);?>

<?$i = 0;?>

    <div class="landing">
        <div class="mainWrapp">
            <div class="slide1">
				<img src="img/header20170502.jpg" style="width:100%;max-width:1900px;min-width:520px"/>
				<div id="slide1text">
					<span style="font-family: 'Walshein_bold';font-size:72px;">ТШЙОРТ ПОБЬЕРИ!</span>
					<br /><br />
					Все бумажные книги<br />
					по <b>99</b> рублей,
					<br /><br />
					а электронные —<br />
					по <b>75</b> рублей <span style="cursor:help;" title="точную стоимость электронной версии можно увидеть на странице книги">*</span>
					<script type="text/javascript" src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js" charset="utf-8"></script>
					<script type="text/javascript" src="//yastatic.net/share2/share.js" charset="utf-8"></script>
					<div class="ya-share2" data-services="vkontakte,facebook" data-counter="" style="position: absolute;width:100%;margin: 40px auto 0;"></div>
				</div>
            </div>

			<div class="bg">
				<div class="hintWrapp">
				<div class="title">Я не трус... но я боюсь</div>
				<?while ($i < 7) {?>
					<div class="bookWrap">
						<a href="<?=$booksArray[$i]["link"]?>?from=maysale">
							<img src="<?=$booksArray[$i]["img"]?>" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
							<p>
							<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="diff">-<?=($booksArray[$i]["oldprice"] - 99)?> руб.</span>
							<br />
							<span class="newprice">99 руб.</span>
							</p>
						</a>
					</div>
					<?
					$i++;
				}?>
				</div>
				
				
				<div class="hintWrapp">
				<div class="title">Ребята, на его месте должен быть я</div>
				<?while ($i < 13) {?>
					<div class="bookWrap">
						<a href="<?=$booksArray[$i]["link"]?>?from=maysale">
							<img src="<?=$booksArray[$i]["img"]?>" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
							<p>
							<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="diff">-<?=($booksArray[$i]["oldprice"] - 99)?> руб.</span>
							<br />
							<span class="newprice">99 руб.</span>
							</p>
						</a>
					</div>
					<?
					$i++;
				}?>
				</div>
				
				
				<div class="hintWrapp">
				<div class="title">Как ты могла подумать такое?<br />Ты, жена моя, мать моих детей!</div>
				<?while ($i < 16) {?>
					<div class="bookWrap">
						<a href="<?=$booksArray[$i]["link"]?>?from=maysale">
							<img src="<?=$booksArray[$i]["img"]?>" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
							<p>
							<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="diff">-<?=($booksArray[$i]["oldprice"] - 99)?> руб.</span>
							<br />
							<span class="newprice">99 руб.</span>
							</p>
						</a>
					</div>
					<?
					$i++;
				}?>
				</div>
				
				<center style="margin: 50px 0;padding:50px;background:#f4f4f4;">
					<iframe src="//coub.com/embed/trjr7?muted=false&autostart=false&originalSize=false&startWithHD=false" allowfullscreen="true" frameborder="0" width="640" height="272"></iframe>
					<div style="color:#c0955c; text-transform:uppercase;margin:30px 0; font-size:32px;font-family: 'Walshein_bold';">с сегодняшнего дня и 9 мая включительно</div>
					<div class="title" style="font-size:24px;">все бумажные книги, что вы найдете здесь,<br />стоят по 99 рублей, почти все электронные версии — по 75 рублей*.
					<br /><br />
					<span style="font-size:18px;">* точную стоимость электронной версии можно увидеть на странице книги</span>
					</div>
				</center>
				
				<div class="slide2">
					<img src="img/middle20170502.jpg" style="width:100%;max-width:1900px;min-width:520px"/>
					<div id="slide2text">
						шел по улице,<br />
						потерял сознание,<br />
						очнулся...<br />
						все по 99 рублей!
					</div>
				</div>
				
				<div class="hintWrapp" style="margin-top:60px;">
				<div class="title">Клевать будет так, что клиент позабудет обо всем на свете</div>
				<?while ($i < 20) {?>
					<div class="bookWrap">
						<a href="<?=$booksArray[$i]["link"]?>?from=maysale">
							<img src="<?=$booksArray[$i]["img"]?>" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
							<p>
							<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="diff">-<?=($booksArray[$i]["oldprice"] - 99)?> руб.</span>
							<br />
							<span class="newprice">99 руб.</span>
							</p>
						</a>
					</div>
					<?
					$i++;
				}?>
				</div>
				
				
				<div class="hintWrapp">
				<div class="title">Береги руку, Сеня</div>
				<?while ($i < 23) {?>
					<div class="bookWrap">
						<a href="<?=$booksArray[$i]["link"]?>?from=maysale">
							<img src="<?=$booksArray[$i]["img"]?>" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
							<p>
							<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="diff">-<?=($booksArray[$i]["oldprice"] - 99)?> руб.</span>
							<br />
							<span class="newprice">99 руб.</span>
							</p>
						</a>
					</div>
					<?
					$i++;
				}?>
				</div>
				
				
				<div class="hintWrapp">
				<div class="title">Как говорит наш дорогой шеф</div>
				<?while ($i < 30) {?>
					<div class="bookWrap">
						<a href="<?=$booksArray[$i]["link"]?>?from=maysale">
							<img src="<?=$booksArray[$i]["img"]?>" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
							<p>
							<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="diff">-<?=($book["oldprice"] - 99)?> руб.</span>
							<br />
							<span class="newprice">99 руб.</span>
							</p>
						</a>
					</div>
					<?
					$i++;
				}?>
				</div>
				
				<div class="hintWrapp">
				<div class="title">Идиот! Дитям мороженое!</div>
				<?while ($i < 36) {?>
					<div class="bookWrap">
						<a href="<?=$booksArray[$i]["link"]?>?from=maysale">
							<img src="<?=$booksArray[$i]["img"]?>" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
							<p>
							<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="diff">-<?=($booksArray[$i]["oldprice"] - 99)?> руб.</span>
							<br />
							<span class="newprice">99 руб.</span>
							</p>
						</a>
					</div>
					<?
					$i++;
				}?>
				</div>
				
				<div class="hintWrapp">
				<div class="title">Дичь не улетит, она жареная</div>
				<?while ($i < 37) {?>
					<div class="bookWrap">
						<a href="<?=$booksArray[$i]["link"]?>?from=maysale">
							<img src="<?=$booksArray[$i]["img"]?>" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
							<p>
							<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="diff">-<?=($booksArray[$i]["oldprice"] - 99)?> руб.</span>
							<br />
							<span class="newprice">99 руб.</span>
							</p>
						</a>
					</div>
					<?
					$i++;
				}?>
				</div>
				
				<div class="hintWrapp">
				<div class="title">Невиноватая я, он сам пришел!</div>
				<?while ($i < 39) {?>
					<div class="bookWrap">
						<a href="<?=$booksArray[$i]["link"]?>?from=maysale">
							<img src="<?=$booksArray[$i]["img"]?>" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
							<p>
							<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="diff">-<?=($booksArray[$i]["oldprice"] - 99)?> руб.</span>
							<br />
							<span class="newprice">99 руб.</span>
							</p>
						</a>
					</div>
					<?
					$i++;
				}?>
				</div>
				
				<div class="hintWrapp">
				<div class="title">Руссо туристо — облико морале, ферштейн?!</div>
				<?while ($i < 42) {?>
					<div class="bookWrap">
						<a href="<?=$booksArray[$i]["link"]?>?from=maysale">
							<img src="<?=$booksArray[$i]["img"]?>" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
							<p>
							<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="diff">-<?=($booksArray[$i]["oldprice"] - 99)?> руб.</span>
							<br />
							<span class="newprice">99 руб.</span>
							</p>
						</a>
					</div>
					<?
					$i++;
				}?>
				</div>
				
				<div class="hintWrapp">
				<div class="title">Шикарный план, шеф!</div>
				<?while ($i < 44) {?>
					<div class="bookWrap">
						<a href="<?=$booksArray[$i]["link"]?>?from=maysale">
							<img src="<?=$booksArray[$i]["img"]?>" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
							<p>
							<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="diff">-<?=($booksArray[$i]["oldprice"] - 99)?> руб.</span>
							<br />
							<span class="newprice">99 руб.</span>
							</p>
						</a>
					</div>
					<?
					$i++;
				}?>
				</div>
				
				<div class="hintWrapp">
				<div class="title">В двенадцать нуль-нуль все будет готово!</div>
				<?while ($i < 45) {?>
					<div class="bookWrap">
						<a href="<?=$booksArray[$i]["link"]?>?from=maysale">
							<img src="<?=$booksArray[$i]["img"]?>" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
							<p>
							<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="diff">-<?=($booksArray[$i]["oldprice"] - 99)?> руб.</span>
							<br />
							<span class="newprice">99 руб.</span>
							</p>
						</a>
					</div>
					<?
					$i++;
				}?>
				</div>
				
				<center style="margin: 50px 0;padding:50px;background:#f4f4f4;">
					<div class="title">Когда купил книгу за 99 рублей!</div>
					<br />
					<iframe src="//coub.com/embed/uxey?muted=false&autostart=false&originalSize=false&startWithHD=false" allowfullscreen="true" frameborder="0" width="640" height="290"></iframe>
				</center>
			</div>

        </div>

    </div>

 </body>
 </html>
 