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
    <title>Дни больших перемен! Скидки до 40%</title>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/template_57363f3dd71b4bfd17109917de7b3143.css" rel="stylesheet">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

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

	<meta property="og:title" content="Дни больших перемен! Скидки до 40%" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="https://www.alpinabook.ru/actions/daysofbigchanges/" />
	<meta property="og:image" content="https://www.alpinabook.ru/actions/daysofbigchanges/img/header.jpg" />
	<meta property="og:site_name" content="Интернет-магазин «Альпина Паблишер»" />
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
	#aeaeae;
}
.landing .slide1 {
	background: url(img/header.jpg) no-repeat 50% 50%;
	height:400px;
}
.landing .slide2 {
	background: url(img/middle1.jpg) no-repeat 34% 50%;
	height:400px;
    margin: 10px 0 34px;
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
	background: url(img/footer1.jpg) no-repeat 50% 50%;
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
.landing {
	width:100%;
	min-width:780px;
}
.landing .hintWrapp {
	width:100%;
	max-width:1140px;
}
@media screen and (max-device-width: 414px){
    body{
        width:100%;
    }
	.bookWrap {
		width:100%;
		height:420px;
		max-width:290px;
	}
	.menu li a {
		font-size: 24px;
	}
	header {
		height:70px;
	}
	.bookWrap img {
		width:220px;
	}
	.bookWrap .oldprice {
		font-size:24px;
	}
	.diff {
		font-size: 24px!important;
	}
	.bookWrap span {
		font-size:32px;
	}
    .slideWrapp .catalogWrapper {
        width: 100%;
        margin-left:175px;
    }
    .slideWrapp .firstSlide {
        width:auto !important;
    }
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
        <p class="telephone" style="font-size: 14px;font-family: 'Walshein_regular'">
            +7 (495) 980 80 77
        </p>
    </div>
</header>
<?$booksArray = array(
array('no'=>1, 'img'=>'/upload/resize_cache/iblock/102/140_270_1/102117bda99fd7a14159d9d066e11cb2.jpg', 'name'=>'Беспокойный ум: Моя победа над биполярным расстройством', 'discount'=>30, 'oldprice'=>448, 'newprice'=>313.6, 'link'=>'/catalog/PopularPsychologyPersonalEffectiveness/124359/', 'diff'=>134.4, 'id'=>124359),
array('no'=>2, 'img'=>'/upload/resize_cache/iblock/fdc/140_270_1/fdcb64a96e155bdeb55629423bc17271.jpg', 'name'=>'Пиши, сокращай: Как создавать сильный текст', 'discount'=>30, 'oldprice'=>589, 'newprice'=>412.3, 'link'=>'/catalog/Marketing/81365/', 'diff'=>176.7, 'id'=>81365),
array('no'=>3, 'img'=>'/upload/resize_cache/iblock/7bc/140_270_1/7bc4f1b5edbd137a40e08586b796bb83.jpg', 'name'=>'Состав: Как нас обманывают производители продуктов питания', 'discount'=>30, 'oldprice'=>448, 'newprice'=>313.6, 'link'=>'/catalog/HealthAndHealthyFood/84627/', 'diff'=>134.4, 'id'=>84627),
array('no'=>4, 'img'=>'/upload/resize_cache/iblock/04e/140_270_1/04ebea45c5d4f8a2a7432f6d3d92ac62.jpg', 'name'=>'Синдром белки в колесе: Как сохранить здоровье и сберечь нервы в мире бесконечных дел', 'discount'=>30, 'oldprice'=>559, 'newprice'=>391.3, 'link'=>'/catalog/PopularPsychologyPersonalEffectiveness/95670/', 'diff'=>167.7, 'id'=>95670),
array('no'=>5, 'img'=>'/upload/resize_cache/iblock/2bb/140_270_1/2bb1673967913fd0f7e571d35a6267c2.jpg', 'name'=>'Фитнес после 40: В прекрасной форме в любом возрасте', 'discount'=>30, 'oldprice'=>479, 'newprice'=>335.3, 'link'=>'/catalog/HealthAndHealthyFood/67409/', 'diff'=>143.7, 'id'=>67409),
array('no'=>6, 'img'=>'/upload/resize_cache/iblock/ca1/140_270_1/ca18702a8495775df9335dfad475791c.jpg', 'name'=>'Страх близости: Как перестать защищаться и начать любить', 'discount'=>30, 'oldprice'=>366, 'newprice'=>256.2, 'link'=>'/catalog/PopularPsychologyPersonalEffectiveness/115679/', 'diff'=>109.8, 'id'=>115679),
array('no'=>7, 'img'=>'/upload/resize_cache/iblock/f14/140_270_1/f144022648b133b378fc14383598db8c.jpg', 'name'=>'Иностранный для взрослых: Как выучить новый язык в любом возрасте', 'discount'=>30, 'oldprice'=>479, 'newprice'=>335.3, 'link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/82845/', 'diff'=>143.7, 'id'=>82845),
array('no'=>8, 'img'=>'/upload/resize_cache/iblock/01e/140_270_1/01e6cb23c31868745d2656d94d5aecc2.jpg', 'name'=>'Как работает экономика: Что Rolling Stones, Гарри Поттер и большой спорт могут рассказать о свободном рынке', 'discount'=>30, 'oldprice'=>529, 'newprice'=>370.3, 'link'=>'/catalog/Economics/89055/', 'diff'=>158.7, 'id'=>89055),
array('no'=>9, 'img'=>'/upload/resize_cache/iblock/9dd/140_270_1/9dd9b03fb8afd588c5212ae35a34aab2.jpg', 'name'=>'Жесткий менеджмент: Заставьте людей работать на результат', 'discount'=>30, 'oldprice'=>479, 'newprice'=>335.3, 'link'=>'/catalog/GeneralManagment/7377/', 'diff'=>143.7, 'id'=>7377),
array('no'=>10, 'img'=>'/upload/resize_cache/iblock/1a0/140_270_1/1a04302caca56c9421b775be6d3ef486.jpg', 'name'=>'Доброе утро каждый день: Как рано вставать и все успевать', 'discount'=>30, 'oldprice'=>399, 'newprice'=>279.3, 'link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/80496/', 'diff'=>119.7, 'id'=>80496),
array('no'=>11, 'img'=>'/upload/resize_cache/iblock/841/140_270_1/8411c6f97bf15f2c7e827fc4591769ea.jpg', 'name'=>'Атлант расправил плечи (в 3-х томах)', 'discount'=>30, 'oldprice'=>1199, 'newprice'=>839.3, 'link'=>'/catalog/BusinessNovels/6115/', 'diff'=>359.7, 'id'=>6115),
array('no'=>12, 'img'=>'/upload/resize_cache/iblock/6d3/140_270_1/6d321d7d57d4d1137cf16a6837c92088.jpg', 'name'=>'Дневник тренировок: Для записи достижений и побед', 'discount'=>30, 'oldprice'=>479, 'newprice'=>335.3, 'link'=>'/catalog/HealthAndHealthyFood/89051/', 'diff'=>143.7, 'id'=>89051),
array('no'=>13, 'img'=>'/upload/resize_cache/iblock/75d/140_270_1/75dac5f9ca56df26f67b9a317d311dc5.jpg', 'name'=>'Железная хватка: Как развить в себе качества, необходимые для достижения успеха', 'discount'=>30, 'oldprice'=>399, 'newprice'=>279.3, 'link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/85679/', 'diff'=>119.7, 'id'=>85679),
array('no'=>14, 'img'=>'/upload/resize_cache/iblock/2ee/140_270_1/2ee4507ad4167ef491df024f6f14defb.jpg', 'name'=>'Я козел', 'discount'=>30, 'oldprice'=>299, 'newprice'=>209.3, 'link'=>'/catalog/KnigiDlyaDetei/82276/', 'diff'=>89.7, 'id'=>82276),
array('no'=>14, 'img'=>'/upload/resize_cache/iblock/6ee/140_270_1/6eeda12a7e8b1b9de58c7591f823ebec.jpg', 'name'=>'SPQR: История Древнего Рима', 'discount'=>30, 'oldprice'=>725, 'newprice'=>507.5, 'link'=>'/catalog/PopularScience/90639/', 'diff'=>217.5, 'id'=>90639),
array('no'=>15, 'img'=>'/upload/resize_cache/iblock/b07/140_270_1/b075f6c0f2cce319dbfb1e736c35903b.jpg', 'name'=>'Как научиться оптимизму: Измените взгляд на мир и свою жизнь', 'discount'=>30, 'oldprice'=>479, 'newprice'=>335.3, 'link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/7835/', 'diff'=>143.7, 'id'=>7835),
array('no'=>15, 'img'=>'/upload/resize_cache/iblock/46a/140_270_1/46ae66c40b6de6456720d56c13f37c2a.jpg', 'name'=>'Как работают над сценарием в Южной Калифорнии', 'discount'=>30, 'oldprice'=>699, 'newprice'=>489.3, 'link'=>'/catalog/ArtOfWriting/78987/', 'diff'=>209.7, 'id'=>78987),
array('no'=>16, 'img'=>'/upload/resize_cache/iblock/ef8/140_270_1/ef8ba1e99fb2839dfc517ce71674239b.jpg', 'name'=>'Мозгоускорители: Как научиться эффективно мыслить, используя приемы из разных наук', 'discount'=>30, 'oldprice'=>479, 'newprice'=>335.3, 'link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/75968/', 'diff'=>143.7, 'id'=>75968),
array('no'=>19, 'img'=>'/upload/resize_cache/iblock/28e/140_270_1/28e35d09a84aac34326cae684d26a313.jpg', 'name'=>'Города мечты', 'discount'=>40, 'oldprice'=>199, 'newprice'=>119.4, 'link'=>'/catalog/CreativityAndCreation/60919/', 'diff'=>79.6, 'id'=>60919),
array('no'=>20, 'img'=>'/upload/resize_cache/iblock/5a0/140_270_1/5a0674a5478f25ee294faa5d74dd9aa6.jpg', 'name'=>'Матрица перемен: Как повысить эффективность изменений в компании', 'discount'=>40, 'oldprice'=>366, 'newprice'=>219.6, 'link'=>'/catalog/GeneralManagment/7942/', 'diff'=>146.4, 'id'=>7942),
array('no'=>21, 'img'=>'/upload/resize_cache/iblock/ede/140_270_1/ede16721e1422a179217cf9c5b1c3bbf.jpg', 'name'=>'Как мы покупали русский интернет', 'discount'=>40, 'oldprice'=>479, 'newprice'=>287.4, 'link'=>'/catalog/SuccessStory/93327/', 'diff'=>191.6, 'id'=>93327),
array('no'=>22, 'img'=>'/upload/resize_cache/iblock/708/140_270_1/708f539435c5a98d176eeec5574d3953.jpg', 'name'=>'Гни свою линию: Приемы эффективной коммуникации', 'discount'=>40, 'oldprice'=>318, 'newprice'=>190.8, 'link'=>'/catalog/NegotiationsBusinessCommunication/5769/', 'diff'=>127.2, 'id'=>5769),
array('no'=>23, 'img'=>'/upload/resize_cache/iblock/151/140_270_1/151be4194890b1b5fde34e6307134de1.jpg', 'name'=>'География гениальности: Где и почему рождаются великие идеи', 'discount'=>40, 'oldprice'=>479, 'newprice'=>287.4, 'link'=>'/catalog/CreativityAndCreation/80512/', 'diff'=>191.6, 'id'=>80512),
array('no'=>24, 'img'=>'/upload/resize_cache/iblock/034/140_270_1/0341a322a5dfbba3aa42fb29f15980f6.jpg', 'name'=>'Антистресс для занятых людей: Медитативная раскраска (Макси)', 'discount'=>40, 'oldprice'=>399, 'newprice'=>239.4, 'link'=>'/catalog/CreativityAndCreation/8624/', 'diff'=>159.6, 'id'=>8624),
array('no'=>24, 'img'=>'/upload/resize_cache/iblock/9ca/140_270_1/9cae643a0b6a3321c10fe0c46837c832.png', 'name'=>'Вязание без слез: Базовые техники и понятные схемы для создания изделий любого размера', 'discount'=>30, 'oldprice'=>448, 'newprice'=>313.6, 'link'=>'/catalog/CreativityAndCreation/68998/', 'diff'=>134.4, 'id'=>68998),
array('no'=>25, 'img'=>'/upload/resize_cache/iblock/69b/140_270_1/69b1e3379ddeb5aa3033e059bbb2d8dd.jpg', 'name'=>'Взрывной рост: Почему экспоненциальные организации в десятки раз продуктивнее вашей (и что с этим делать)', 'discount'=>30, 'oldprice'=>559, 'newprice'=>391.3, 'link'=>'/catalog/StartupsInnovativeEntrepreneurship/115583/', 'diff'=>167.7, 'id'=>115583),
array('no'=>26, 'img'=>'/upload/resize_cache/iblock/705/140_270_1/705a328921eb40269724ae2bbea050a3.jpg', 'name'=>'Биржа для блондинок', 'discount'=>40, 'oldprice'=>529, 'newprice'=>317.4, 'link'=>'/catalog/InvestmentsStock/8000/', 'diff'=>211.6, 'id'=>8000),
array('no'=>28, 'img'=>'/upload/resize_cache/iblock/c23/140_270_1/c2392b9c18cd796ded63a6b75efe8e65.jpg', 'name'=>'Алгоритм успешного общения при подборе персонала: Лайфхаки для руководителей и HR', 'discount'=>40, 'oldprice'=>529, 'newprice'=>317.4, 'link'=>'/catalog/HR/80508/', 'diff'=>211.6, 'id'=>80508),
array('no'=>29, 'img'=>'/upload/resize_cache/iblock/c02/140_270_1/c0218856aef4811ca7f7c0805ecdd54e.jpg', 'name'=>'E-Learning: Как сделать электронное обучение понятным, качественным и доступным', 'discount'=>40, 'oldprice'=>799, 'newprice'=>479.4, 'link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8860/', 'diff'=>319.6, 'id'=>8860),
array('no'=>30, 'img'=>'/upload/resize_cache/iblock/080/140_270_1/0809d879045a8fc6bf90d15a8bf0db40.jpg', 'name'=>'Энергетика йоги: Практический курс', 'discount'=>30, 'oldprice'=>1209, 'newprice'=>846.3, 'link'=>'/catalog/Yoga/66543/', 'diff'=>362.7, 'id'=>66543),
array('no'=>31, 'img'=>'/upload/resize_cache/iblock/507/140_270_1/5070e84d30b1d9feed23940f8f0b8b8d.jpg', 'name'=>'Счастье по расчету: Как управлять своей жизнью, чтобы быть счастливым каждый день', 'discount'=>40, 'oldprice'=>479, 'newprice'=>287.4, 'link'=>'/catalog/PopularPsychologyPersonalEffectiveness/8578/', 'diff'=>191.6, 'id'=>8578),
array('no'=>32, 'img'=>'/upload/resize_cache/iblock/806/140_270_1/806a729043274d3ac4d36df8b0e71351.jpg', 'name'=>'Сид Вишес: Слишком быстр, чтобы жить...', 'discount'=>40, 'oldprice'=>399, 'newprice'=>239.4, 'link'=>'/catalog/PublicismDocumentaryProse/7817/', 'diff'=>159.6, 'id'=>7817),
array('no'=>33, 'img'=>'/upload/resize_cache/iblock/557/140_270_1/5578b7e6d3061d25a8616b164b9c432d.jpg', 'name'=>'Сборник задач I и II Открытых чемпионатов школ по экономике', 'discount'=>40, 'oldprice'=>435, 'newprice'=>261, 'link'=>'/catalog/Economics/7579/', 'diff'=>174, 'id'=>7579),
array('no'=>34, 'img'=>'/upload/resize_cache/iblock/0a0/140_270_1/0a0c2c46b183b66b30394b810dc3e492.jpg', 'name'=>'Россия 2000-х: Путин и другие', 'discount'=>40, 'oldprice'=>366, 'newprice'=>219.6, 'link'=>'/catalog/PublicismDocumentaryProse/8274/', 'diff'=>146.4, 'id'=>8274),
array('no'=>35, 'img'=>'/upload/resize_cache/iblock/65d/140_270_1/65dc0411fbfe022dfd49a81053bab587.jpg', 'name'=>'Рассказы о самом-самом и Записки Рейнгартена', 'discount'=>40, 'oldprice'=>399, 'newprice'=>239.4, 'link'=>'/catalog/Fiction/8222/', 'diff'=>159.6, 'id'=>8222),
array('no'=>36, 'img'=>'/upload/resize_cache/iblock/5bc/140_270_1/5bc0563f364af6a341703048ecc0985f.jpg', 'name'=>'Реструктуризация сферы услуг ЖКХ', 'discount'=>40, 'oldprice'=>479, 'newprice'=>287.4, 'link'=>'/catalog/ProjectManagment/7889/', 'diff'=>191.6, 'id'=>7889),
array('no'=>37, 'img'=>'/upload/resize_cache/iblock/2da/140_270_1/2da43e3fe2690d4850ba380a65d0a6b5.jpg', 'name'=>'Про меня и Свету: Дневник онкологического больного', 'discount'=>30, 'oldprice'=>399, 'newprice'=>279.3, 'link'=>'/catalog/BiographiesAndMemoirs/8668/', 'diff'=>119.7, 'id'=>8668),
array('no'=>38, 'img'=>'/upload/resize_cache/iblock/da3/140_270_1/da340ac38a6d937c23f95f6610fd0a7f.jpg', 'name'=>'Личная власть', 'discount'=>40, 'oldprice'=>399, 'newprice'=>239.4, 'link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/7887/', 'diff'=>159.6, 'id'=>7887),
array('no'=>39, 'img'=>'/upload/resize_cache/iblock/eee/140_270_1/eee6866a3afc2ec3110f7a119eb395b3.jpg', 'name'=>'Настольная книга по внутреннему аудиту: Риски и бизнес-процессы', 'discount'=>30, 'oldprice'=>990, 'newprice'=>693, 'link'=>'/catalog/FinancialManagment/7823/', 'diff'=>297, 'id'=>7823),
array('no'=>40, 'img'=>'/upload/resize_cache/iblock/63d/140_270_1/63db449e17f7f0aa26fd4b193fda45cf.jpg', 'name'=>'Опять совещание?! Как превратить пустые обсуждения в эффективные', 'discount'=>30, 'oldprice'=>479, 'newprice'=>335.3, 'link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/7589/', 'diff'=>143.7, 'id'=>7589),
array('no'=>41, 'img'=>'/upload/resize_cache/iblock/c8e/140_270_1/c8ec1718ce896208b1b79331b6db1331.jpg', 'name'=>'50 советов по рекрутингу', 'discount'=>30, 'oldprice'=>479, 'newprice'=>335.3, 'link'=>'/catalog/HR/7365/', 'diff'=>143.7, 'id'=>7365),
array('no'=>42, 'img'=>'/upload/resize_cache/iblock/6fd/140_270_1/6fd6e2f2d22e911488052fcb04ac027b.jpg', 'name'=>'Дни поражений и побед', 'discount'=>30, 'oldprice'=>479, 'newprice'=>335.3, 'link'=>'/catalog/BiographiesAndMemoirs/8019/', 'diff'=>143.7, 'id'=>8019),

);?>

<?$i = 0;?>
    <div class="landing">
        <div class="mainWrapp">
            <div class="slide1">
				<div id="slide1text">
                
				</div>
            </div>
			<div style="
			margin: 0 auto;
			width: 100%;
			text-align: center;
			font-size: 48px;
			font-family: &quot;Walshein_regular&quot;;
			margin-top: 50px;max-width:900px;
			"><span style="color:red">С&nbsp;28&nbsp;по&nbsp;30&nbsp;марта</span> <br />Дни больших перемен!<br /><span style="font-size:24px;color:#888;">Иногда хочется чего-то нового в&nbsp;обыденной жизни, взять и&nbsp;все изменить в&nbsp;один день. Для желающих поменять жизнь к&nbsp;лучшему создан специальный праздник.</span></div>
			<div class="bg">
				<div class="hintWrapp">
				<?foreach ($booksArray as $book) {
					if ($i < 24) {?>
					<div class="bookWrap">
						<a href="<?=$book["link"]?>?from=daysofchanges">
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
						<a href="<?=$book["link"]?>?from=daysofchanges">
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
            <img src="img/footer1.jpg" style="width:100%; max-width: 1770px;text-align:center;" alt="" />
			<script type="text/javascript" src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js" charset="utf-8"></script>
			<script type="text/javascript" src="//yastatic.net/share2/share.js" charset="utf-8"></script>
			<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,gplus" data-counter="" style="position: absolute;left: 48%;bottom: 80px;"></div>
        </div>
    </div>

 </body>
 </html>
 