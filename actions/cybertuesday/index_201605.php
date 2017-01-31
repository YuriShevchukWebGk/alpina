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
	background: url(img/headern.jpg) no-repeat 50% 50%;
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
	font-size: 23px;
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
array("img"=>"7","name"=>"Тюремные люди","discount"=>"40","oldprice"=>"285","newprice"=>"171","RND"=>"0,00861689737103621","link"=>"/catalog/BiographiesAndMemoirs/8165/","ID"=>"8165"),
array("img"=>"39","name"=>"Мифы об эволюции человека","discount"=>"20","oldprice"=>"359","newprice"=>"287,2","RND"=>"0,0505727488061175","link"=>"/catalog/PopularScience/8454/","ID"=>"8454"),
array("img"=>"30","name"=>"Книга о самых невообразимых животных: Бестиарий XXI века","discount"=>"20","oldprice"=>"725","newprice"=>"580","RND"=>"0,0871301297345309","link"=>"/catalog/PopularScience/8446/","ID"=>"8446"),
array("img"=>"32","name"=>"Странная девочка","discount"=>"20","oldprice"=>"479","newprice"=>"383,2","RND"=>"0,0919438588634316","link"=>"/catalog/PopularPsychologyPersonalEffectiveness/8712/","ID"=>"8712"),
array("img"=>"27","name"=>"Бьюти-мифы: Вся правда о ботоксе","discount"=>"20","oldprice"=>"529","newprice"=>"423,2","RND"=>"0,117020048723384","link"=>"/catalog/BeautyAndHistoryOfFashion/8254/","ID"=>"8254"),
array("img"=>"43","name"=>"Вторая мировая война: Ад на земле","discount"=>"20","oldprice"=>"899","newprice"=>"719,2","RND"=>"0,138452890901276","link"=>"/catalog/PublicismDocumentaryProse/8246/","ID"=>"8246"),
array("img"=>"9","name"=>"Групповой портрет на фоне мира","discount"=>"40","oldprice"=>"4269","newprice"=>"2561,4","RND"=>"0,167712681110883","link"=>"/catalog/Gifts/66427/","ID"=>"66427"),
array("img"=>"44","name"=>"Шпаргалки для боссов: Жесткие и честные уроки управления","discount"=>"20","oldprice"=>"479","newprice"=>"383,2","RND"=>"0,175679242682875","link"=>"/catalog/GeneralManagment/8698/","ID"=>"8698"),
array("img"=>"3","name"=>"Антистресс для занятых людей: Медитативная раскраска","discount"=>"40","oldprice"=>"318","newprice"=>"190,8","RND"=>"0,221048978974571","link"=>"/catalog/CreativityAndCreation/8434/","ID"=>"8434"),
array("img"=>"17","name"=>"Аргументируй это! Как убедить кого угодно в чем угодно","discount"=>"30","oldprice"=>"559","newprice"=>"391,3","RND"=>"0,26663043586228","link"=>"/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8242/","ID"=>"8242"),
array("img"=>"48","name"=>"Здоровый сон - счастливый ребенок","discount"=>"20","oldprice"=>"479","newprice"=>"383,2","RND"=>"0,271025771367114","link"=>"/catalog/BooksForParents/8175/","ID"=>"8175"),
array("img"=>"35","name"=>"Как придумать идею","discount"=>"20","oldprice"=>"399","newprice"=>"319,2","RND"=>"0,276755177857528","link"=>"/catalog/CreativityAndCreation/8314/","ID"=>"8314"),
array("img"=>"51","name"=>"Семь навыков высокоэффективных людей (Обложка с клапанами","discount"=>"10","oldprice"=>"448","newprice"=>"403,2","RND"=>"0,285377467203807","link"=>"/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8194/","ID"=>"8194"),
array("img"=>"36","name"=>"Цена человека. Заложник чеченской войны","discount"=>"20","oldprice"=>"399","newprice"=>"319,2","RND"=>"0,303469441824816","link"=>"/catalog/PublicismDocumentaryProse/8460/","ID"=>"8460"),
array("img"=>"14","name"=>"После трех уже поздно (обложка с клапанами)","discount"=>"30","oldprice"=>"369","newprice"=>"258,3","RND"=>"0,305563318169919","link"=>"/catalog/BooksForParents/66487/","ID"=>"66487"),
array("img"=>"52","name"=>"Руководство астронавта по жизни на Земле. Чему научили меня 4000 часов на орбите","discount"=>"20","oldprice"=>"448","newprice"=>"358,4","RND"=>"0,308490119321168","link"=>"/catalog/PublicismDocumentaryProse/8402/","ID"=>"8402"),
array("img"=>"40","name"=>"Застенчивый ребенок","discount"=>"20","oldprice"=>"339","newprice"=>"271,2","RND"=>"0,311082373120711","link"=>"/catalog/PopularPsychologyPersonalEffectiveness/8584/","ID"=>"8584"),
array("img"=>"23","name"=>"Режим гения: Распорядок дня великих людей","discount"=>"30","oldprice"=>"479","newprice"=>"335,3","RND"=>"0,390291348823001","link"=>"/catalog/PopularPsychologyPersonalEffectiveness/7819/","ID"=>"7819"),
array("img"=>"33","name"=>"Медитация для занятых людей: Восстановление внутренней гармонии где бы вы ни были","discount"=>"20","oldprice"=>"399","newprice"=>"319,2","RND"=>"0,391233234062537","link"=>"/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8756/","ID"=>"8756"),
array("img"=>"31","name"=>"Не кричите на детей! Как разрешать конфликты с детьми и делать так","discount"=>"20","oldprice"=>"479","newprice"=>"383,2","RND"=>"0,420052417733542","link"=>"/catalog/BooksForParents/8714/","ID"=>"8714"),
array("img"=>"37","name"=>"Искусство думать: Латеральное мышление как способ решения сложных задач","discount"=>"20","oldprice"=>"399","newprice"=>"319,2","RND"=>"0,444915346209703","link"=>"/catalog/CreativityAndCreation/8382/","ID"=>"8382"),
array("img"=>"28","name"=>"Ловушка для внимания: Как вызвать и удержать интерес к идее","discount"=>"20","oldprice"=>"479","newprice"=>"383,2","RND"=>"0,499730059137612","link"=>"/catalog/Marketing/8594/","ID"=>"8594"),
array("img"=>"21","name"=>"Спотыкаясь о счастье","discount"=>"30","oldprice"=>"448","newprice"=>"313,6","RND"=>"0,523504158025795","link"=>"/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8278/","ID"=>"8278"),
array("img"=>"12","name"=>"Результативность: Секреты эффективного поведения","discount"=>"40","oldprice"=>"639","newprice"=>"383,4","RND"=>"0,558199435982334","link"=>"/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8101/","ID"=>"8101"),
array("img"=>"50","name"=>"Атлант расправил плечи (три тома в одной книге)","discount"=>"20","oldprice"=>"749","newprice"=>"599,2","RND"=>"0,564808043147991","link"=>"/catalog/Gifts/65392/","ID"=>"65392"),
array("img"=>"25","name"=>"Сам себе шеф-повар: Как научиться готовить без рецептов (Обложка)","discount"=>"20","oldprice"=>"479","newprice"=>"383,2","RND"=>"0,577940523429363","link"=>"/catalog/HealthAndHealthyFood/8650/","ID"=>"8650"),
array("img"=>"49","name"=>"Британия: MIND THE GAP","discount"=>"20","oldprice"=>"318","newprice"=>"254,4","RND"=>"0,586825741746038","link"=>"/catalog/HobbyTravelingCars/8085/","ID"=>"8085"),
array("img"=>"8","name"=>"Сама уверенность: Как преодолеть внутренние барьеры и реализовать себя","discount"=>"40","oldprice"=>"479","newprice"=>"287,4","RND"=>"0,593505542583972","link"=>"/catalog/SelfConfidence/8464/","ID"=>"8464"),
array("img"=>"22","name"=>"Бунин и Набоков. История соперничества","discount"=>"30","oldprice"=>"318","newprice"=>"222,6","RND"=>"0,597715587269234","link"=>"/catalog/BiographiesAndMemoirs/8177/","ID"=>"8177"),
array("img"=>"53","name"=>"Я бабочка","discount"=>"10","oldprice"=>"299","newprice"=>"269,1","RND"=>"0,645255857858363","link"=>"/catalog/KnigiDlyaDetei/8784/","ID"=>"8784"),
array("img"=>"47","name"=>"Трололо: Нельзя просто так взять и выпустить книгу про троллинг","discount"=>"20","oldprice"=>"529","newprice"=>"423,2","RND"=>"0,663816154385093","link"=>"/catalog/PopularPsychologyPersonalEffectiveness/8752/","ID"=>"8752"),
array("img"=>"10","name"=>"Экономическое равновесие: Теория объемной геометрии в экономике","discount"=>"40","oldprice"=>"399","newprice"=>"239,4","RND"=>"0,675457959425869","link"=>"/catalog/InvestmentsStock/8410/","ID"=>"8410"),
array("img"=>"19","name"=>"Крылья мечты: Медитативная раскраска для взрослых","discount"=>"30","oldprice"=>"399","newprice"=>"279,3","RND"=>"0,677838225991471","link"=>"/catalog/CreativityAndCreation/8598/","ID"=>"8598"),
array("img"=>"29","name"=>"Развитие памяти по методикам спецслужб","discount"=>"20","oldprice"=>"729","newprice"=>"583,2","RND"=>"0,681925263218149","link"=>"/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8093/","ID"=>"8093"),
array("img"=>"41","name"=>"Инструменты бережливого производства II: Карманное руководство по практике применения Lean","discount"=>"20","oldprice"=>"224","newprice"=>"179,2","RND"=>"0,686962292589153","link"=>"/catalog/LeanManufacturingQualityManagement/5609/","ID"=>"5609"),
array("img"=>"2","name"=>"Работа мировых рынков: Управление финансовой инфраструктурой","discount"=>"40","oldprice"=>"1049","newprice"=>"629,4","RND"=>"0,690463201176673","link"=>"/catalog/Economics/8516/","ID"=>"8516"),
array("img"=>"45","name"=>"Суперобъекты: Звезды размером с город","discount"=>"20","oldprice"=>"448","newprice"=>"358,4","RND"=>"0,69949877772491","link"=>"/catalog/PopularScience/8760/","ID"=>"8760"),
array("img"=>"1","name"=>"Антистресс для занятых людей: Медитативная раскраска (Макси)","discount"=>"40","oldprice"=>"399","newprice"=>"239,4","RND"=>"0,730866640814943","link"=>"/catalog/CreativityAndCreation/8624/","ID"=>"8624"),
array("img"=>"26","name"=>"Договориться можно обо всем! (Обложка)","discount"=>"20","oldprice"=>"399","newprice"=>"319,2","RND"=>"0,737713712822109","link"=>"/catalog/NegotiationsBusinessCommunication/66435/","ID"=>"66435"),
array("img"=>"11","name"=>"Самоучитель топ-менеджера","discount"=>"40","oldprice"=>"709","newprice"=>"425,4","RND"=>"0,747616018399384","link"=>"/catalog/GeneralManagment/7718/","ID"=>"7718"),
array("img"=>"18","name"=>"Ваши взрослые дети: Руководство для родителей","discount"=>"30","oldprice"=>"399","newprice"=>"279,3","RND"=>"0,754936239738891","link"=>"/catalog/BooksForParents/8696/","ID"=>"8696"),
array("img"=>"13","name"=>"160 развивающих игр для детей от рождения до 3 лет","discount"=>"30","oldprice"=>"448","newprice"=>"313,6","RND"=>"0,825587775753728","link"=>"/catalog/BooksForParents/7893/","ID"=>"7893"),
array("img"=>"34","name"=>"Успеть за 120 минут: Как создать условия для максимально эффективной работы","discount"=>"20","oldprice"=>"399","newprice"=>"319,2","RND"=>"0,8404238698637","link"=>"/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8856/","ID"=>"8856"),
array("img"=>"42","name"=>"Иллюзия выбора: Кто принимает решения за нас и почему это не всегда плохо","discount"=>"20","oldprice"=>"529","newprice"=>"423,2","RND"=>"0,843359536688697","link"=>"/catalog/PopularPsychologyPersonalEffectiveness/60907/","ID"=>"60907"),
array("img"=>"46","name"=>"Теряя невинность: Как я построил бизнес","discount"=>"20","oldprice"=>"639","newprice"=>"511,2","RND"=>"0,843391413798734","link"=>"/catalog/SuccessStory/66516/","ID"=>"66516"),
array("img"=>"15","name"=>"Визуализируй это! Как использовать графику","discount"=>"30","oldprice"=>"559","newprice"=>"391,3","RND"=>"0,846113603258287","link"=>"/catalog/PrezentatsiiRitorika/7833/","ID"=>"7833"),
array("img"=>"24","name"=>"Эти важные мелочи: 163 способа добиться совершенства","discount"=>"30","oldprice"=>"639","newprice"=>"447,3","RND"=>"0,860224469263107","link"=>"/catalog/GeneralManagment/6908/","ID"=>"6908"),
array("img"=>"20","name"=>"Правила общения с детьми: 12 «нельзя»","discount"=>"30","oldprice"=>"299","newprice"=>"209,3","RND"=>"0,866405066414735","link"=>"/catalog/BooksForParents/8654/","ID"=>"8654"),
array("img"=>"16","name"=>"Психология ребенка от 0 до 2: Как общение стимулирует развитие","discount"=>"30","oldprice"=>"399","newprice"=>"279,3","RND"=>"0,905260388123887","link"=>"/catalog/BooksForParents/8700/","ID"=>"8700"),
array("img"=>"6","name"=>"Русское влияние в Евразии","discount"=>"40","oldprice"=>"639","newprice"=>"383,4","RND"=>"0,914136263106618","link"=>"/catalog/Policy/8228/","ID"=>"8228"),
array("img"=>"4","name"=>"Личная власть","discount"=>"40","oldprice"=>"399","newprice"=>"239,4","RND"=>"0,937882430598084","link"=>"/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/7887/","ID"=>"7887"),
array("img"=>"5","name"=>"Быть женщиной: Откровения отъявленной феминистки","discount"=>"40","oldprice"=>"318","newprice"=>"190,8","RND"=>"0,944929365465586","link"=>"/catalog/SelfConfidence/8149/","ID"=>"8149"),
array("img"=>"38","name"=>"Книга о потерянном времени: У вас больше возможностей","discount"=>"20","oldprice"=>"479","newprice"=>"383,2","RND"=>"0,976896985249441","link"=>"/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8470/","ID"=>"8470")
);?>

<?
global $USER;
$alpExps = unserialize($APPLICATION->get_cookie("alpExps"));
$alpExps  = (!$alpExps ? array() : $alpExps);

if ($alpExps['updateExp'] != "160516") {
	$alpExps = array();
	$alpExps['updateExp'] = "160516";
}

$alpExps['cyberTuesday']	= (!$alpExps['cyberTuesday'] ? rand(1,3) : $alpExps['cyberTuesday']);
?>

<?if ($alpExps['cyberTuesday'] == 1) {?>
	<?
	$randKeys = shuffle($booksArray);
	$label = 'randomizeProds';
	?>
	<script type="text/javascript">
		$(document).ready(function() {
			dataLayer.push({
				event: 'ab-test-gtm',
				action: 'cyberTuesday',
				label: '<?=$label?>'
			});
			console.log('cyberTuesday <?=$label?>');
		});
	</script>
<?} elseif ($alpExps['cyberTuesday'] == 2) {?>
	<?
	$randKeys = shuffle($booksArray);
	$label = 'fixedProds';
	?>
	<script type="text/javascript">
		$(document).ready(function() {
			dataLayer.push({
				event: 'ab-test-gtm',
				action: 'cyberTuesday',
				label: '<?=$label?>'
			});
			console.log('cyberTuesday <?=$label?>');
		});
	</script>
<?} elseif ($alpExps['cyberTuesday'] == 3) {?>
	<?
	$label = 'customizedProds';
	?>
	<script type="text/javascript">
		$(document).ready(function() {
			dataLayer.push({
				event: 'ab-test-gtm',
				action: 'cyberTuesday',
				label: '<?=$label?>'
			});
			console.log('cyberTuesday <?=$label?>');
		});
	</script>
<?}?>


<?$APPLICATION->set_cookie("alpExps", serialize($alpExps));?>

<?$i = 0;?>

    <div class="landing">
        <div class="mainWrapp">
            <div class="slide1">
				<div id="slide1text">
                Не сбавляем обороты, не переводим дух!<br />
				Честные скидки от <b>10%</b> до <b>40%</b> на лучшие новинки весны и <br />
				бестселлеры всех времён (года)
				</div>
            </div>
			<?if ($label == 'customizedProds') {?>
				<style>
				.mainWrapp {
					background:url(img/a.jpg) no-repeat 100% 26%, url(img/b.jpg) no-repeat 0% 39%,url(img/c.jpg) no-repeat 0% 58%,url(img/d.jpg) no-repeat 100% 100% #f7ebe0;
				}
				</style>
				<?$booksArray = array(
				array("img"=>"50","name"=>"Атлант расправил плечи (три тома в одной книге)","discount"=>"20","oldprice"=>"749","newprice"=>"599,2","RND"=>"0,564808043147991","link"=>"/catalog/Gifts/65392/","ID"=>"65392"),
				array("img"=>"51","name"=>"Семь навыков высокоэффективных людей (Обложка с клапанами","discount"=>"10","oldprice"=>"448","newprice"=>"403,2","RND"=>"0,285377467203807","link"=>"/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8194/","ID"=>"8194"),
				array("img"=>"3","name"=>"Антистресс для занятых людей: Медитативная раскраска","discount"=>"40","oldprice"=>"318","newprice"=>"190,8","RND"=>"0,221048978974571","link"=>"/catalog/CreativityAndCreation/8434/","ID"=>"8434"),
				array("img"=>"1","name"=>"Антистресс для занятых людей: Медитативная раскраска (Макси)","discount"=>"40","oldprice"=>"399","newprice"=>"239,4","RND"=>"0,730866640814943","link"=>"/catalog/CreativityAndCreation/8624/","ID"=>"8624"),
				array("img"=>"19","name"=>"Крылья мечты: Медитативная раскраска для взрослых","discount"=>"30","oldprice"=>"399","newprice"=>"279,3","RND"=>"0,677838225991471","link"=>"/catalog/CreativityAndCreation/8598/","ID"=>"8598"),
				array("img"=>"13","name"=>"160 развивающих игр для детей от рождения до 3 лет","discount"=>"30","oldprice"=>"448","newprice"=>"313,6","RND"=>"0,825587775753728","link"=>"/catalog/BooksForParents/7893/","ID"=>"7893"),
				array("img"=>"14","name"=>"После трех уже поздно (обложка с клапанами)","discount"=>"30","oldprice"=>"369","newprice"=>"258,3","RND"=>"0,305563318169919","link"=>"/catalog/BooksForParents/66487/","ID"=>"66487"),
				array("img"=>"16","name"=>"Психология ребенка от 0 до 2: Как общение стимулирует развитие","discount"=>"30","oldprice"=>"399","newprice"=>"279,3","RND"=>"0,905260388123887","link"=>"/catalog/BooksForParents/8700/","ID"=>"8700"),
				array("img"=>"18","name"=>"Ваши взрослые дети: Руководство для родителей","discount"=>"30","oldprice"=>"399","newprice"=>"279,3","RND"=>"0,754936239738891","link"=>"/catalog/BooksForParents/8696/","ID"=>"8696"),
				array("img"=>"20","name"=>"Правила общения с детьми: 12 «нельзя»","discount"=>"30","oldprice"=>"299","newprice"=>"209,3","RND"=>"0,866405066414735","link"=>"/catalog/BooksForParents/8654/","ID"=>"8654"),
				array("img"=>"31","name"=>"Не кричите на детей! Как разрешать конфликты с детьми и делать так","discount"=>"20","oldprice"=>"479","newprice"=>"383,2","RND"=>"0,420052417733542","link"=>"/catalog/BooksForParents/8714/","ID"=>"8714"),
				array("img"=>"40","name"=>"Застенчивый ребенок","discount"=>"20","oldprice"=>"339","newprice"=>"271,2","RND"=>"0,311082373120711","link"=>"/catalog/PopularPsychologyPersonalEffectiveness/8584/","ID"=>"8584"),
				array("img"=>"48","name"=>"Здоровый сон - счастливый ребенок","discount"=>"20","oldprice"=>"479","newprice"=>"383,2","RND"=>"0,271025771367114","link"=>"/catalog/BooksForParents/8175/","ID"=>"8175"),
				array("img"=>"53","name"=>"Я бабочка","discount"=>"10","oldprice"=>"299","newprice"=>"269,1","RND"=>"0,645255857858363","link"=>"/catalog/KnigiDlyaDetei/8784/","ID"=>"8784"),
				array("img"=>"9","name"=>"Групповой портрет на фоне мира","discount"=>"40","oldprice"=>"4269","newprice"=>"2561,4","RND"=>"0,167712681110883","link"=>"/catalog/Gifts/66427/","ID"=>"66427"),
				array("img"=>"8","name"=>"Сама уверенность: Как преодолеть внутренние барьеры и реализовать себя","discount"=>"40","oldprice"=>"479","newprice"=>"287,4","RND"=>"0,593505542583972","link"=>"/catalog/SelfConfidence/8464/","ID"=>"8464"),
				array("img"=>"25","name"=>"Сам себе шеф-повар: Как научиться готовить без рецептов (Обложка)","discount"=>"20","oldprice"=>"479","newprice"=>"383,2","RND"=>"0,577940523429363","link"=>"/catalog/HealthAndHealthyFood/8650/","ID"=>"8650"),
				array("img"=>"27","name"=>"Бьюти-мифы: Вся правда о ботоксе","discount"=>"20","oldprice"=>"529","newprice"=>"423,2","RND"=>"0,117020048723384","link"=>"/catalog/BeautyAndHistoryOfFashion/8254/","ID"=>"8254"),
				array("img"=>"38","name"=>"Книга о потерянном времени: У вас больше возможностей","discount"=>"20","oldprice"=>"479","newprice"=>"383,2","RND"=>"0,976896985249441","link"=>"/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8470/","ID"=>"8470"),
				array("img"=>"5","name"=>"Быть женщиной: Откровения отъявленной феминистки","discount"=>"40","oldprice"=>"318","newprice"=>"190,8","RND"=>"0,944929365465586","link"=>"/catalog/SelfConfidence/8149/","ID"=>"8149"),
				array("img"=>"2","name"=>"Работа мировых рынков: Управление финансовой инфраструктурой","discount"=>"40","oldprice"=>"1049","newprice"=>"629,4","RND"=>"0,690463201176673","link"=>"/catalog/Economics/8516/","ID"=>"8516"),
				array("img"=>"6","name"=>"Русское влияние в Евразии","discount"=>"40","oldprice"=>"639","newprice"=>"383,4","RND"=>"0,914136263106618","link"=>"/catalog/Policy/8228/","ID"=>"8228"),
				array("img"=>"10","name"=>"Экономическое равновесие: Теория объемной геометрии в экономике","discount"=>"40","oldprice"=>"399","newprice"=>"239,4","RND"=>"0,675457959425869","link"=>"/catalog/InvestmentsStock/8410/","ID"=>"8410"),
				array("img"=>"11","name"=>"Самоучитель топ-менеджера","discount"=>"40","oldprice"=>"709","newprice"=>"425,4","RND"=>"0,747616018399384","link"=>"/catalog/GeneralManagment/7718/","ID"=>"7718"),
				array("img"=>"12","name"=>"Результативность: Секреты эффективного поведения","discount"=>"40","oldprice"=>"639","newprice"=>"383,4","RND"=>"0,558199435982334","link"=>"/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8101/","ID"=>"8101"),
				array("img"=>"41","name"=>"Инструменты бережливого производства II: Карманное руководство по практике применения Lean","discount"=>"20","oldprice"=>"224","newprice"=>"179,2","RND"=>"0,686962292589153","link"=>"/catalog/LeanManufacturingQualityManagement/5609/","ID"=>"5609"),
				array("img"=>"46","name"=>"Теряя невинность: Как я построил бизнес","discount"=>"20","oldprice"=>"639","newprice"=>"511,2","RND"=>"0,843391413798734","link"=>"/catalog/SuccessStory/66516/","ID"=>"66516"),
				array("img"=>"35","name"=>"Как придумать идею","discount"=>"20","oldprice"=>"399","newprice"=>"319,2","RND"=>"0,276755177857528","link"=>"/catalog/CreativityAndCreation/8314/","ID"=>"8314"),
				array("img"=>"44","name"=>"Шпаргалки для боссов: Жесткие и честные уроки управления","discount"=>"20","oldprice"=>"479","newprice"=>"383,2","RND"=>"0,175679242682875","link"=>"/catalog/GeneralManagment/8698/","ID"=>"8698"),
				array("img"=>"42","name"=>"Иллюзия выбора: Кто принимает решения за нас и почему это не всегда плохо","discount"=>"20","oldprice"=>"529","newprice"=>"423,2","RND"=>"0,843359536688697","link"=>"/catalog/PopularPsychologyPersonalEffectiveness/60907/","ID"=>"60907"),
				array("img"=>"15","name"=>"Визуализируй это! Как использовать графику","discount"=>"30","oldprice"=>"559","newprice"=>"391,3","RND"=>"0,846113603258287","link"=>"/catalog/PrezentatsiiRitorika/7833/","ID"=>"7833"),
				array("img"=>"28","name"=>"Ловушка для внимания: Как вызвать и удержать интерес к идее","discount"=>"20","oldprice"=>"479","newprice"=>"383,2","RND"=>"0,499730059137612","link"=>"/catalog/Marketing/8594/","ID"=>"8594"),
				array("img"=>"17","name"=>"Аргументируй это! Как убедить кого угодно в чем угодно","discount"=>"30","oldprice"=>"559","newprice"=>"391,3","RND"=>"0,26663043586228","link"=>"/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8242/","ID"=>"8242"),
				array("img"=>"26","name"=>"Договориться можно обо всем! (Обложка)","discount"=>"20","oldprice"=>"399","newprice"=>"319,2","RND"=>"0,737713712822109","link"=>"/catalog/NegotiationsBusinessCommunication/66435/","ID"=>"66435"),
				array("img"=>"29","name"=>"Развитие памяти по методикам спецслужб","discount"=>"20","oldprice"=>"729","newprice"=>"583,2","RND"=>"0,681925263218149","link"=>"/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8093/","ID"=>"8093"),
				array("img"=>"23","name"=>"Режим гения: Распорядок дня великих людей","discount"=>"30","oldprice"=>"479","newprice"=>"335,3","RND"=>"0,390291348823001","link"=>"/catalog/PopularPsychologyPersonalEffectiveness/7819/","ID"=>"7819"),
				array("img"=>"24","name"=>"Эти важные мелочи: 163 способа добиться совершенства","discount"=>"30","oldprice"=>"639","newprice"=>"447,3","RND"=>"0,860224469263107","link"=>"/catalog/GeneralManagment/6908/","ID"=>"6908"),
				array("img"=>"32","name"=>"Странная девочка","discount"=>"20","oldprice"=>"479","newprice"=>"383,2","RND"=>"0,0919438588634316","link"=>"/catalog/PopularPsychologyPersonalEffectiveness/8712/","ID"=>"8712"),
				array("img"=>"33","name"=>"Медитация для занятых людей: Восстановление внутренней гармонии где бы вы ни были","discount"=>"20","oldprice"=>"399","newprice"=>"319,2","RND"=>"0,391233234062537","link"=>"/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8756/","ID"=>"8756"),
				array("img"=>"34","name"=>"Успеть за 120 минут: Как создать условия для максимально эффективной работы","discount"=>"20","oldprice"=>"399","newprice"=>"319,2","RND"=>"0,8404238698637","link"=>"/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8856/","ID"=>"8856"),
				array("img"=>"37","name"=>"Искусство думать: Латеральное мышление как способ решения сложных задач","discount"=>"20","oldprice"=>"399","newprice"=>"319,2","RND"=>"0,444915346209703","link"=>"/catalog/CreativityAndCreation/8382/","ID"=>"8382"),
				array("img"=>"4","name"=>"Личная власть","discount"=>"40","oldprice"=>"399","newprice"=>"239,4","RND"=>"0,937882430598084","link"=>"/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/7887/","ID"=>"7887"),
				array("img"=>"21","name"=>"Спотыкаясь о счастье","discount"=>"30","oldprice"=>"448","newprice"=>"313,6","RND"=>"0,523504158025795","link"=>"/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8278/","ID"=>"8278"),
				array("img"=>"30","name"=>"Книга о самых невообразимых животных: Бестиарий XXI века","discount"=>"20","oldprice"=>"725","newprice"=>"580","RND"=>"0,0871301297345309","link"=>"/catalog/PopularScience/8446/","ID"=>"8446"),
				array("img"=>"39","name"=>"Мифы об эволюции человека","discount"=>"20","oldprice"=>"359","newprice"=>"287,2","RND"=>"0,0505727488061175","link"=>"/catalog/PopularScience/8454/","ID"=>"8454"),
				array("img"=>"43","name"=>"Вторая мировая война: Ад на земле","discount"=>"20","oldprice"=>"899","newprice"=>"719,2","RND"=>"0,138452890901276","link"=>"/catalog/PublicismDocumentaryProse/8246/","ID"=>"8246"),
				array("img"=>"45","name"=>"Суперобъекты: Звезды размером с город","discount"=>"20","oldprice"=>"448","newprice"=>"358,4","RND"=>"0,69949877772491","link"=>"/catalog/PopularScience/8760/","ID"=>"8760"),
				array("img"=>"52","name"=>"Руководство астронавта по жизни на Земле. Чему научили меня 4000 часов на орбите","discount"=>"20","oldprice"=>"448","newprice"=>"358,4","RND"=>"0,308490119321168","link"=>"/catalog/PublicismDocumentaryProse/8402/","ID"=>"8402"),
				array("img"=>"47","name"=>"Трололо: Нельзя просто так взять и выпустить книгу про троллинг","discount"=>"20","oldprice"=>"529","newprice"=>"423,2","RND"=>"0,663816154385093","link"=>"/catalog/PopularPsychologyPersonalEffectiveness/8752/","ID"=>"8752"),
				array("img"=>"49","name"=>"Британия: MIND THE GAP","discount"=>"20","oldprice"=>"318","newprice"=>"254,4","RND"=>"0,586825741746038","link"=>"/catalog/HobbyTravelingCars/8085/","ID"=>"8085"),
				array("img"=>"22","name"=>"Бунин и Набоков. История соперничества","discount"=>"30","oldprice"=>"318","newprice"=>"222,6","RND"=>"0,597715587269234","link"=>"/catalog/BiographiesAndMemoirs/8177/","ID"=>"8177"),
				array("img"=>"7","name"=>"Тюремные люди","discount"=>"40","oldprice"=>"285","newprice"=>"171","RND"=>"0,00861689737103621","link"=>"/catalog/BiographiesAndMemoirs/8165/","ID"=>"8165"),
				array("img"=>"36","name"=>"Цена человека. Заложник чеченской войны","discount"=>"20","oldprice"=>"399","newprice"=>"319,2","RND"=>"0,303469441824816","link"=>"/catalog/PublicismDocumentaryProse/8460/","ID"=>"8460")
				);?>
				
				<div class="bg">
					<!-- 1 -->
					<div class="hintWrapp">
					<p class="titleMain">Бестселлеры всех времён</p>
					<?for ($i = $i;$i < 2; $i++) {?>
						<div class="bookWrap">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});">
								<img src="files/<?=$booksArray[$i]["img"]?>.jpg" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
								<p>
								<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <?/*<span>-<?=$booksArray[$i]["discount"]?>%</span>*/?>
								<br />
								<span class="newprice"><?=$booksArray[$i]["newprice"]?> руб.</span>
								</p>
							</a>
						</div>
						<?}?>
					</div>
					<!-- 2 -->
					<div class="hintWrapp">
					<p class="titleMain">Медитативные раскраски</p>
					<?for ($i = $i;$i < 5; $i++) {?>
						<div class="bookWrap">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});">
								<img src="files/<?=$booksArray[$i]["img"]?>.jpg" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
								<p>
								<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <?/*<span>-<?=$booksArray[$i]["discount"]?>%</span>*/?>
								<br />
								<span class="newprice"><?=$booksArray[$i]["newprice"]?> руб.</span>
								</p>
							</a>
						</div>
						<?}?>
					</div>
					<!-- 3 -->
					<div class="hintWrapp">
					<p class="titleMain">Детям и родителям</p>
					<?for ($i = $i;$i < 14; $i++) {?>
						<div class="bookWrap">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});">
								<img src="files/<?=$booksArray[$i]["img"]?>.jpg" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
								<p>
								<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <?/*<span>-<?=$booksArray[$i]["discount"]?>%</span>*/?>
								<br />
								<span class="newprice"><?=$booksArray[$i]["newprice"]?> руб.</span>
								</p>
							</a>
						</div>
						<?}?>
					</div>
					<!-- 4 -->
					<div class="hintWrapp">
					<p class="titleMain">Роскошный подарок</p>
					<?for ($i = $i;$i < 15; $i++) {?>
						<div class="bookWrap">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});">
								<img src="files/<?=$booksArray[$i]["img"]?>.jpg" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
								<p>
								<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <?/*<span>-<?=$booksArray[$i]["discount"]?>%</span>*/?>
								<br />
								<span class="newprice"><?=$booksArray[$i]["newprice"]?> руб.</span>
								</p>
							</a>
						</div>
						<?}?>
					</div>
					<!-- 5 -->
					<div class="hintWrapp">
					<p class="titleMain">Женские хитрости</p>
					<?for ($i = $i;$i < 20; $i++) {?>
						<div class="bookWrap">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});">
								<img src="files/<?=$booksArray[$i]["img"]?>.jpg" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
								<p>
								<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <?/*<span>-<?=$booksArray[$i]["discount"]?>%</span>*/?>
								<br />
								<span class="newprice"><?=$booksArray[$i]["newprice"]?> руб.</span>
								</p>
							</a>
						</div>
						<?}?>
					</div>
					<div class="slide2"></div>
					<!-- 6 -->
					<div class="hintWrapp">
					<p class="titleMain">Экономика</p>
					<?for ($i = $i;$i < 23; $i++) {?>
						<div class="bookWrap">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});">
								<img src="files/<?=$booksArray[$i]["img"]?>.jpg" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
								<p>
								<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <?/*<span>-<?=$booksArray[$i]["discount"]?>%</span>*/?>
								<br />
								<span class="newprice"><?=$booksArray[$i]["newprice"]?> руб.</span>
								</p>
							</a>
						</div>
						<?}?>
					</div>
					<!-- 7 -->
					<div class="hintWrapp">
					<p class="titleMain">Бизнес</p>
					<?for ($i = $i;$i < 30; $i++) {?>
						<div class="bookWrap">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});">
								<img src="files/<?=$booksArray[$i]["img"]?>.jpg" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
								<p>
								<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <?/*<span>-<?=$booksArray[$i]["discount"]?>%</span>*/?>
								<br />
								<span class="newprice"><?=$booksArray[$i]["newprice"]?> руб.</span>
								</p>
							</a>
						</div>
						<?}?>
					</div>
					<!-- 8 -->
					<div class="hintWrapp">
					<p class="titleMain">Переговоры и презентации</p>
					<?for ($i = $i;$i < 34; $i++) {?>
						<div class="bookWrap">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});">
								<img src="files/<?=$booksArray[$i]["img"]?>.jpg" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
								<p>
								<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <?/*<span>-<?=$booksArray[$i]["discount"]?>%</span>*/?>
								<br />
								<span class="newprice"><?=$booksArray[$i]["newprice"]?> руб.</span>
								</p>
							</a>
						</div>
						<?}?>
					</div>
					<!-- 9 -->
					<div class="hintWrapp">
					<p class="titleMain">Личная эффективность</p>
					<?for ($i = $i;$i < 43; $i++) {?>
						<div class="bookWrap">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});">
								<img src="files/<?=$booksArray[$i]["img"]?>.jpg" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
								<p>
								<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <?/*<span>-<?=$booksArray[$i]["discount"]?>%</span>*/?>
								<br />
								<span class="newprice"><?=$booksArray[$i]["newprice"]?> руб.</span>
								</p>
							</a>
						</div>
						<?}?>
					</div>
					<!-- 10 -->
					<div class="hintWrapp">
					<p class="titleMain">Научпоп</p>
					<?for ($i = $i;$i < 48; $i++) {?>
						<div class="bookWrap">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});">
								<img src="files/<?=$booksArray[$i]["img"]?>.jpg" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
								<p>
								<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <?/*<span>-<?=$booksArray[$i]["discount"]?>%</span>*/?>
								<br />
								<span class="newprice"><?=$booksArray[$i]["newprice"]?> руб.</span>
								</p>
							</a>
						</div>
						<?}?>
					</div>
					<!-- 11 -->
					<div class="hintWrapp">
					<p class="titleMain">Культура и общество</p>
					<?for ($i = $i;$i < 53; $i++) {?>
						<div class="bookWrap">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});">
								<img src="files/<?=$booksArray[$i]["img"]?>.jpg" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
								<p>
								<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <?/*<span>-<?=$booksArray[$i]["discount"]?>%</span>*/?>
								<br />
								<span class="newprice"><?=$booksArray[$i]["newprice"]?> руб.</span>
								</p>
							</a>
						</div>
						<?}?>
					</div>					
				</div>				
				
				
				
			<?} else {?>
				<div class="bg">
					<div class="hintWrapp">
					<?foreach ($booksArray as $book) {
						if ($i < 24) {?>
						<div class="bookWrap">
							<a href="<?=$book["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$book["name"]?>'});">
								<img src="files/<?=$book["img"]?>.jpg" alt="<?=$book["name"]?>" title="<?=$book["name"]?>" />
								<p>
								<span class="oldprice"><?=$book["oldprice"]?> руб.</span> <?/*<span>-<?=$book["discount"]?>%</span>*/?>
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
						<?for ($i = $i;$i < 53; $i++) {?>
						<div class="bookWrap">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});">
								<img src="files/<?=$booksArray[$i]["img"]?>.jpg" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
								<p>
								<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <?/*<span>-<?=$booksArray[$i]["discount"]?>%</span>*/?>
								<br />
								<span class="newprice"><?=$booksArray[$i]["newprice"]?> руб.</span>
								</p>
							</a>
						</div>
						<?}?>
					</div>
				</div>
			<?}?>
        </div>

        <div class="footer">
            <img src="img/footer.jpg" alt="" />
			<script type="text/javascript" src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js" charset="utf-8"></script>
			<script type="text/javascript" src="//yastatic.net/share2/share.js" charset="utf-8"></script>
			<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,gplus" data-counter="" style="position: absolute;left: 48%;bottom: 200px;"></div>
        </div>
    </div>

 </body>
 </html>
 