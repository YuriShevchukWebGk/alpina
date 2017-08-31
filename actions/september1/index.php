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
	<meta name="robots" content="index, follow"/>
	<meta charset="utf-8"/>
	<title>Книги для учеников и студентов, их родителей и учителей со скидкой до 40%</title>
	<meta name="keywords" content=""/>
	<meta name="description" content=""/>
	<link href="css/style.css?123" rel="stylesheet">
	<link href="css/template_57363f3dd71b4bfd17109917de7b3143.css?123" rel="stylesheet">
	<link rel="stylesheet" href="css/newstyle.css?<?=filemtime($_SERVER["DOCUMENT_ROOT"].'/actions/september1/css/newstyle.css')?>" type="text/css">

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
	
	<meta property="og:title" content="Книги для учеников и студентов, их родителей и учителей со скидкой до 40%" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="https://www.alpinabook.ru/actions/september1/" />
	<meta property="og:image" content="https://www.alpinabook.ru/actions/september1/img/header_fb.jpg" />
	<meta property="og:site_name" content="www.alpinabook.ru" />
	<meta property="og:description" content="Распродажа книг с 30 августа по 3 сентября 2017 года!" />
	<meta property="fb:admins" content="1425804193" />
	<meta property="fb:app_id" content="138738742872757" />

</head>
<body>
<script>function getsubbook(){$.post("/ajax/request_add.php",{email:$("#subpop input[type=email]").val()},function(data){$(".errorinfo").html(data);})}$(document).ready(function(){$(".stopProp").click(function(e){e.stopPropagation();});});function closeX(){$('.hideInfo').hide();}</script>
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
			<img src="/img/logo.png">		</div>
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
array('no'=>0, 'img'=>'/upload/resize_cache/iblock/77e/77eab8dfa2e38bbadae03b9833892889/140_270_1/bec17a2c9de2df3ad1bdf69328b909d3.jpg', 'name'=>'Вселенная в вопросах и ответах. Задачи и тесты по астрономии и космонавтике', 'discount'=>10, 'oldprice'=>448, 'newprice'=>403,2, 'link'=>'/catalog/PopularScience/188794/', 'diff'=>44,8, 'id'=>188794),
array('no'=>1, 'img'=>'/upload/resize_cache/iblock/e23/140_270_1/e239ba5966620c68bb98d25a472f828d.jpg', 'name'=>'Голубая точка. Космическое будущее человечества', 'discount'=>10, 'oldprice'=>479, 'newprice'=>431,1, 'link'=>'/catalog/PopularScience/75264/', 'diff'=>47,9, 'id'=>75264),
array('no'=>2, 'img'=>'/upload/resize_cache/iblock/422/140_270_1/42215e58c5a8cf0caba1bdc0d93d1f0d.jpg', 'name'=>'Миллиарды и миллиарды: Размышления о жизни и смерти на рубеже тысячелетий', 'discount'=>10, 'oldprice'=>479, 'newprice'=>431,1, 'link'=>'/catalog/PopularScience/185974/', 'diff'=>47,9, 'id'=>185974),
array('no'=>3, 'img'=>'/upload/resize_cache/iblock/306/140_270_1/306148073c49b3c23f0041db87bdc76f.jpg', 'name'=>'Руководство астронавта по жизни на Земле. Чему научили меня 4000 часов на орбите', 'discount'=>10, 'oldprice'=>448, 'newprice'=>403,2, 'link'=>'/catalog/PopularScience/8402/', 'diff'=>44,8, 'id'=>8402),
array('no'=>4, 'img'=>'/upload/resize_cache/iblock/4ed/140_270_1/4ede51f92664228d5ca3ed411c280f0a.jpg', 'name'=>'Суперобъекты: Звезды размером с город', 'discount'=>10, 'oldprice'=>448, 'newprice'=>403,2, 'link'=>'/catalog/PopularScience/8760/', 'diff'=>44,8, 'id'=>8760),
array('no'=>5, 'img'=>'/upload/resize_cache/iblock/37c/140_270_1/37c6762816b23f32957ae2921ac4a373.jpg', 'name'=>'Дело не в генах: Почему (на самом деле) мы похожи на родителей', 'discount'=>20, 'oldprice'=>529, 'newprice'=>423,2, 'link'=>'/catalog/PopularScience/337905/', 'diff'=>105,8, 'id'=>337905),
array('no'=>6, 'img'=>'/upload/resize_cache/iblock/62f/140_270_1/62f2fa63de77f00a4a4519c64fbca109.jpg', 'name'=>'Достаточно ли мы умны, чтобы судить об уме животных?', 'discount'=>10, 'oldprice'=>529, 'newprice'=>476,1, 'link'=>'/catalog/PopularScience/91623/', 'diff'=>52,9, 'id'=>91623),
array('no'=>7, 'img'=>'/upload/resize_cache/iblock/71f/140_270_1/71f4404ffe1e4dbfb04b3afe7d04b737.jpg', 'name'=>'Здоровье по Дарвину: Почему мы болеем и как это связано с эволюцией', 'discount'=>30, 'oldprice'=>479, 'newprice'=>335,3, 'link'=>'/catalog/PopularScience/80473/', 'diff'=>143,7, 'id'=>80473),
array('no'=>8, 'img'=>'/upload/resize_cache/iblock/622/140_270_1/6221d4e572a07604ec1fe89c228233d1.jpg', 'name'=>'Происхождение жизни. От туманности до клетки', 'discount'=>10, 'oldprice'=>559, 'newprice'=>503,1, 'link'=>'/catalog/PopularScience/69020/', 'diff'=>55,9, 'id'=>69020),
array('no'=>9, 'img'=>'/upload/resize_cache/iblock/1a7/140_270_1/1a77b42036d1dde63fd15bf78a2c56ba.jpg', 'name'=>'Самая главная молекула', 'discount'=>10, 'oldprice'=>479, 'newprice'=>431,1, 'link'=>'/catalog/PopularScience/90651/', 'diff'=>47,9, 'id'=>90651),
array('no'=>10, 'img'=>'/upload/resize_cache/iblock/83e/140_270_1/83ec544318df8117496d31d2774dc442.jpg', 'name'=>'5 минут на размышление: Лучшие головоломки советского времени', 'discount'=>10, 'oldprice'=>399, 'newprice'=>359,1, 'link'=>'/catalog/CreativityAndCreation/8660/', 'diff'=>39,9, 'id'=>8660),
array('no'=>11, 'img'=>'/upload/resize_cache/iblock/261/140_270_1/2619d747705a78b678c6848810e07d71.png', 'name'=>'Озадачник: 133 вопроса на знание логики, математики и физики', 'discount'=>10, 'oldprice'=>399, 'newprice'=>359,1, 'link'=>'/catalog/CreativityAndCreation/81012/', 'diff'=>39,9, 'id'=>81012),
array('no'=>12, 'img'=>'/upload/resize_cache/iblock/a78/140_270_1/a7871a692173df0c4650a6b249b35323.jpg', 'name'=>'Homo Roboticus? Люди и машины в поисках взаимопонимания', 'discount'=>10, 'oldprice'=>479, 'newprice'=>431,1, 'link'=>'/catalog/PopularScience/341960/', 'diff'=>47,9, 'id'=>341960),
array('no'=>13, 'img'=>'/upload/resize_cache/iblock/a0b/140_270_1/a0b8f4cf103e7fb8c29df82a704e8d9e.jpg', 'name'=>'Братья Райт. Люди, которые научили мир летать', 'discount'=>10, 'oldprice'=>529, 'newprice'=>476,1, 'link'=>'/catalog/BiographiesAndMemoirs/182116/', 'diff'=>52,9, 'id'=>182116),
array('no'=>14, 'img'=>'/upload/resize_cache/iblock/26f/140_270_1/26fc811cf7efe9b1c45b371a85666482.jpg', 'name'=>'Все на одного: Как защитить ребенка от травли в школе', 'discount'=>20, 'oldprice'=>369, 'newprice'=>295,2, 'link'=>'/catalog/BooksForParents/60925/', 'diff'=>73,8, 'id'=>60925),
array('no'=>15, 'img'=>'/upload/resize_cache/iblock/0d6/140_270_1/0d6170d6d595caaafd57ad01153bfd36.jpg', 'name'=>'Математика для мам и пап: Домашка без мучений', 'discount'=>30, 'oldprice'=>529, 'newprice'=>370,3, 'link'=>'/catalog/BooksForParents/82371/', 'diff'=>158,7, 'id'=>82371),
array('no'=>16, 'img'=>'/upload/resize_cache/iblock/5d9/140_270_1/5d93020c4dbb0f44d8b4bc273775ccbb.jpg', 'name'=>'Ноль друзей: Как помочь ребенку справиться с одиночеством', 'discount'=>30, 'oldprice'=>399, 'newprice'=>279,3, 'link'=>'/catalog/BooksForParents/341845/', 'diff'=>119,7, 'id'=>341845),
array('no'=>17, 'img'=>'/upload/resize_cache/iblock/159/140_270_1/1590f12c0f08be62ebcc13dca6de30cd.jpg', 'name'=>'Хочу и буду: Принять себя, полюбить жизнь и стать счастливым', 'discount'=>20, 'oldprice'=>459, 'newprice'=>367,2, 'link'=>'/catalog/PopularPsychologyPersonalEffectiveness/186046/', 'diff'=>91,8, 'id'=>186046),
array('no'=>18, 'img'=>'/upload/resize_cache/iblock/ec1/140_270_1/ec1c68d4efd79a421b9971eb5661c55e.jpg', 'name'=>'Что такое интеллект и как его развивать: Роль образования и традиций', 'discount'=>40, 'oldprice'=>479, 'newprice'=>287,4, 'link'=>'/catalog/BooksForParents/7704/', 'diff'=>191,6, 'id'=>7704),
array('no'=>19, 'img'=>'/upload/resize_cache/iblock/6ee/140_270_1/6eeda12a7e8b1b9de58c7591f823ebec.jpg', 'name'=>'SPQR: История Древнего Рима', 'discount'=>20, 'oldprice'=>725, 'newprice'=>580, 'link'=>'/catalog/PopularScience/90639/', 'diff'=>145, 'id'=>90639),
array('no'=>20, 'img'=>'/upload/resize_cache/iblock/290/140_270_1/290f39cf0c50b0bd67d38ad7b80ffa70.jpg', 'name'=>'Битвы за еду и войны культур: Тайные двигатели истории', 'discount'=>20, 'oldprice'=>559, 'newprice'=>447,2, 'link'=>'/catalog/PublicismDocumentaryProse/182091/', 'diff'=>111,8, 'id'=>182091),
array('no'=>21, 'img'=>'/upload/resize_cache/iblock/e18/140_270_1/e18de9f65bf9e6e55d2433767e19fe07.jpg', 'name'=>'Люди Севера: История викингов. 793-1241', 'discount'=>20, 'oldprice'=>639, 'newprice'=>511,2, 'link'=>'/catalog/PopularScience/90631/', 'diff'=>127,8, 'id'=>90631),
array('no'=>22, 'img'=>'/upload/resize_cache/iblock/663/140_270_1/663e2e04562a1b3d49549f27148990f9.jpg', 'name'=>'Книга начинающего шахматиста', 'discount'=>20, 'oldprice'=>399, 'newprice'=>319,2, 'link'=>'/catalog/PopularScience/77797/', 'diff'=>79,8, 'id'=>77797),
array('no'=>23, 'img'=>'/upload/resize_cache/iblock/aa9/140_270_1/aa99b49c4109d800fe44927f31a7138c.jpg', 'name'=>'Магия математики: Как найти икс и зачем это нужно', 'discount'=>20, 'oldprice'=>479, 'newprice'=>383,2, 'link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/75436/', 'diff'=>95,8, 'id'=>75436),
array('no'=>24, 'img'=>'/upload/resize_cache/iblock/459/140_270_1/459ba4713351edd8519ef67718063f85.jpg', 'name'=>'Математические головоломки профессора Стюарта', 'discount'=>10, 'oldprice'=>529, 'newprice'=>476,1, 'link'=>'/catalog/PopularScience/90633/', 'diff'=>52,9, 'id'=>90633),
array('no'=>25, 'img'=>'/upload/resize_cache/iblock/a90/140_270_1/a90dbdfdf5ddbca216d8088a22a99448.jpg', 'name'=>'Невероятные числа профессора Стюарта', 'discount'=>10, 'oldprice'=>559, 'newprice'=>503,1, 'link'=>'/catalog/PopularScience/67827/', 'diff'=>55,9, 'id'=>67827),
array('no'=>26, 'img'=>'/upload/resize_cache/iblock/ba1/140_270_1/ba1e0bbdb071f6f59612f449e534d515.jpg', 'name'=>'Вера против фактов: Почему наука и религия несовместимы', 'discount'=>10, 'oldprice'=>529, 'newprice'=>476,1, 'link'=>'/catalog/PsychologyPhilosophyHistoryOfReligion/70085/', 'diff'=>52,9, 'id'=>70085),
array('no'=>27, 'img'=>'/upload/resize_cache/iblock/6f6/140_270_1/6f63e391ffab50ad01c09858a7b7b65a.jpg', 'name'=>'Скептик: Рациональный взгляд на мир', 'discount'=>20, 'oldprice'=>479, 'newprice'=>383,2, 'link'=>'/catalog/PopularScience/120654/', 'diff'=>95,8, 'id'=>120654),
array('no'=>28, 'img'=>'/upload/resize_cache/iblock/5ae/140_270_1/5ae4606d38389e98191548fb1ff154f6.jpg', 'name'=>'Череп Бетховена: Мрачные и загадочные истории из мира классической музыки', 'discount'=>30, 'oldprice'=>479, 'newprice'=>335,3, 'link'=>'/catalog/PublicismDocumentaryProse/182099/', 'diff'=>143,7, 'id'=>182099),
array('no'=>29, 'img'=>'/upload/resize_cache/iblock/435/140_270_1/4351073132a2244d600e6ca2e0b114bc.jpg', 'name'=>'Ньютон. Биография', 'discount'=>20, 'oldprice'=>409, 'newprice'=>327,2, 'link'=>'/catalog/BiographiesAndMemoirs/125899/', 'diff'=>81,8, 'id'=>125899),
array('no'=>30, 'img'=>'/upload/resize_cache/iblock/120/140_270_1/120afc5cd9be5a7a2f881ad06db10338.jpg', 'name'=>'Физика будущего', 'discount'=>10, 'oldprice'=>479, 'newprice'=>431,1, 'link'=>'/catalog/PopularScience/7071/', 'diff'=>47,9, 'id'=>7071),
array('no'=>31, 'img'=>'/upload/resize_cache/iblock/4e3/140_270_1/4e37e4fa945914e6f1601af8757f6a3d.jpg', 'name'=>'Физика невозможного', 'discount'=>10, 'oldprice'=>479, 'newprice'=>431,1, 'link'=>'/catalog/PopularScience/6305/', 'diff'=>47,9, 'id'=>6305),
array('no'=>32, 'img'=>'/upload/resize_cache/iblock/a8c/140_270_1/a8c2da982d3fc28a33e9c10ef25a2920.jpg', 'name'=>'Современные яды: Дозы, действие, последствия', 'discount'=>30, 'oldprice'=>479, 'newprice'=>335,3, 'link'=>'/catalog/PopularScience/84737/', 'diff'=>143,7, 'id'=>84737),
array('no'=>33, 'img'=>'/upload/resize_cache/iblock/7bc/140_270_1/7bc4f1b5edbd137a40e08586b796bb83.jpg', 'name'=>'Состав: Как нас обманывают производители продуктов питания', 'discount'=>40, 'oldprice'=>448, 'newprice'=>268,8, 'link'=>'/catalog/HealthAndHealthyFood/84627/', 'diff'=>179,2, 'id'=>84627),
array('no'=>34, 'img'=>'/upload/resize_cache/iblock/1a0/140_270_1/1a04302caca56c9421b775be6d3ef486.jpg', 'name'=>'Доброе утро каждый день: Как рано вставать и все успевать', 'discount'=>10, 'oldprice'=>399, 'newprice'=>359,1, 'link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/80496/', 'diff'=>39,9, 'id'=>80496),
array('no'=>35, 'img'=>'/upload/resize_cache/iblock/ef8/140_270_1/ef8ba1e99fb2839dfc517ce71674239b.jpg', 'name'=>'Мозгоускорители: Как научиться эффективно мыслить, используя приемы из разных наук', 'discount'=>20, 'oldprice'=>479, 'newprice'=>383,2, 'link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/75968/', 'diff'=>95,8, 'id'=>75968),
array('no'=>36, 'img'=>'/upload/resize_cache/iblock/eca/140_270_1/ecac079fcc7b8e23eefaf7a15ba4db38.jpg', 'name'=>'Мой продуктивный год: Как я проверил самые известные методики личной эффективности на себе', 'discount'=>10, 'oldprice'=>479, 'newprice'=>431,1, 'link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/82379/', 'diff'=>47,9, 'id'=>82379),
array('no'=>37, 'img'=>'/upload/resize_cache/iblock/7a7/7a76f7d455f650769bb204566e19529b/140_270_1/c205728cd867eb559e3d4a7aaf7b2809.jpg', 'name'=>'Революция сна: Как менять свою жизнь ночь за ночью', 'discount'=>10, 'oldprice'=>479, 'newprice'=>431,1, 'link'=>'/catalog/PopularPsychologyPersonalEffectiveness/186025/', 'diff'=>47,9, 'id'=>186025),
array('no'=>38, 'img'=>'/upload/resize_cache/iblock/fef/140_270_1/fef024ed647f8d47474e2403ddba6638.jpg', 'name'=>'Тайм-менеджмент для школьника: Как Федя Забывакин учился временем управлять', 'discount'=>40, 'oldprice'=>529, 'newprice'=>317,4, 'link'=>'/catalog/BooksForParents/8666/', 'diff'=>211,6, 'id'=>8666),
array('no'=>39, 'img'=>'/upload/resize_cache/iblock/f14/140_270_1/f144022648b133b378fc14383598db8c.jpg', 'name'=>'Иностранный для взрослых: Как выучить новый язык в любом возрасте', 'discount'=>20, 'oldprice'=>479, 'newprice'=>383,2, 'link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/82845/', 'diff'=>95,8, 'id'=>82845),
array('no'=>40, 'img'=>'/upload/resize_cache/iblock/46a/140_270_1/46ae66c40b6de6456720d56c13f37c2a.jpg', 'name'=>'Как работают над сценарием в Южной Калифорнии', 'discount'=>20, 'oldprice'=>699, 'newprice'=>559,2, 'link'=>'/catalog/ArtOfWriting/78987/', 'diff'=>139,8, 'id'=>78987),
array('no'=>41, 'img'=>'/upload/resize_cache/iblock/c5e/140_270_1/c5e4ad4090cdc53188be2da8a814e781.jpg', 'name'=>'Конструирование языков: От эсперанто до дотракийского', 'discount'=>10, 'oldprice'=>448, 'newprice'=>403,2, 'link'=>'/catalog/PopularScience/97236/', 'diff'=>44,8, 'id'=>97236),
array('no'=>42, 'img'=>'/upload/resize_cache/iblock/4cd/140_270_1/4cd89059bf08eae641d6255397136d6d.jpg', 'name'=>'Письма о добром и прекрасном', 'discount'=>20, 'oldprice'=>366, 'newprice'=>292,8, 'link'=>'/catalog/PopularPsychologyPersonalEffectiveness/80492/', 'diff'=>73,2, 'id'=>80492),
array('no'=>43, 'img'=>'/upload/resize_cache/iblock/fdc/140_270_1/fdcb64a96e155bdeb55629423bc17271.jpg', 'name'=>'Пиши, сокращай: Как создавать сильный текст', 'discount'=>10, 'oldprice'=>589, 'newprice'=>530,1, 'link'=>'/catalog/Marketing/81365/', 'diff'=>58,9, 'id'=>81365),

);?>
<?/*if ($USER->isAdmin()) {
	foreach ($booksArray as $m => $single) {
		echo $single[id];
		echo '<br />';
	}
}*/?>
<?$i = 0;?>

	<div class="landing">
		<div class="mainWrapp">
			<div class="slide1">
				<div id="slide1text">
				Звонок для учителя, скидки для вас:<br />
				<span>до 40%</span> на лучшие книги
				</div>
				<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki" data-counter="" style="position: absolute;left: 48%;top: 500px;"></div>
			</div>
			<div class="slide4">
				<div id="slide1text">
				<a name="parents"></a>
				Для родителей
				</div>
				<div class="hintWrapp">
					<?for ($i = 14;$i < 19; $i++) {?>
						<div class="bookWrap">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});">
								<img src="<?=$booksArray[$i]["img"]?>" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
								<p>
								<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="newprice"><?=round(-$booksArray[$i]["oldprice"]*($booksArray[$i]["discount"]/100-1))?> руб.</span>
								</p>
							</a>
						</div>
					<?}?>
				</div>
				<div id="slide1text">
				<a name="languages"></a>
				Языки и литература
				</div>
				<div class="hintWrapp">
					<?for ($i = 39;$i < 44; $i++) {?>
						<div class="bookWrap">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});">
								<img src="<?=$booksArray[$i]["img"]?>" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
								<p>
								<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="newprice"><?=round(-$booksArray[$i]["oldprice"]*($booksArray[$i]["discount"]/100-1))?> руб.</span>
								</p>
							</a>
						</div>
					<?}?>
				</div>			
			</div>	
			
			<div class="slide3">
				<div id="slide1text">
				<b>С 30 августа по 3 сентября</b> мы продаем лучшие<br />
				книги для учеников и студентов,<br />
				их родителей и учителей со <b>скидкой до 40%</b>
				</div>
			</div>				
			<div class="slide6">
				<div id="slide1text">
				<a name="physics"></a>
				Физика
				</div>
				<div class="hintWrapp">
					<?for ($i = 29;$i < 32; $i++) {?>
						<div class="bookWrap">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});">
								<img src="<?=$booksArray[$i]["img"]?>" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
								<p>
								<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="newprice"><?=round(-$booksArray[$i]["oldprice"]*($booksArray[$i]["discount"]/100-1))?> руб.</span>
								</p>
							</a>
						</div>
					<?}?>
					<?for ($i = 37;$i < 40; $i++) {?>
						<div class="bookWrap">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});">
								<img src="<?=$booksArray[$i]["img"]?>" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
								<p>
								<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="newprice"><?=round(-$booksArray[$i]["oldprice"]*($booksArray[$i]["discount"]/100-1))?> руб.</span>
								</p>
							</a>
						</div>
					<?}?>
				</div>
				<div id="slide1text">
				<a name="math"></a>
				Математика
				</div>
				<div class="hintWrapp">
					<?for ($i = 22;$i < 26; $i++) {?>
						<div class="bookWrap">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});">
								<img src="<?=$booksArray[$i]["img"]?>" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
								<p>
								<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="newprice"><?=round(-$booksArray[$i]["oldprice"]*($booksArray[$i]["discount"]/100-1))?> руб.</span>
								</p>
							</a>
						</div>
					<?}?>
				</div>
			</div>
				<div class="slide7">
				<div id="slide1text">
				И&nbsp;напоминаем, что теперь, покупая бумажные книги в&nbsp;нашем интернет-магазине, вы&nbsp;получаете их&nbsp;электронные копии на&nbsp;ваш телефон или планшет. Бесплатно и&nbsp;моментально.<br />
				<a href="/actions/freedigitalbooks/">Подробности</a> 
				</div>
			</div>
			<div class="slide8">
				<div id="slide1text">
				<a name="biology"></a>				
				Биология
				</div>
				<div class="hintWrapp">
					<?for ($i = 5;$i < 10; $i++) {?>
						<div class="bookWrap">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});">
								<img src="<?=$booksArray[$i]["img"]?>" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
								<p>
								<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span>  <span class="newprice"><?=round(-$booksArray[$i]["oldprice"]*($booksArray[$i]["discount"]/100-1))?> руб.</span>
								</p>
							</a>
						</div>
					<?}?>
				</div>		
				<div id="slide1text">
				<a name="astronomy"></a>
				Астрономия
				</div>
				<div class="hintWrapp">
					<?for ($i = 0;$i < 5; $i++) {?>
						<div class="bookWrap">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});">
								<img src="<?=$booksArray[$i]["img"]?>" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
								<p>
								<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="newprice"><?=round(-$booksArray[$i]["oldprice"]*($booksArray[$i]["discount"]/100-1))?> руб.</span>
								</p>
							</a>
						</div>
					<?}?>
				</div>

				<div id="slide1text">
				<a name="history"></a>
				История
				</div>
				<div class="hintWrapp">
					<?for ($i = 19;$i < 22; $i++) {?>
						<div class="bookWrap">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});">
								<img src="<?=$booksArray[$i]["img"]?>" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
								<p>
								<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="newprice"><?=round(-$booksArray[$i]["oldprice"]*($booksArray[$i]["discount"]/100-1))?> руб.</span>
								</p>
							</a>
						</div>
					<?}?>
				</div>
			</div>
			<div class="slide5">
				<div id="slide1text">
				Чтобы поднять вам настроение,<br />мы опускаем цены ниже школьного порога
				<br />
				</div>
			</div>
			<div class="slide8">
				<a name="chemistry"></a>
				<div id="slide1text">
				Химия и экология
				</div>
				<div class="hintWrapp">
					<?for ($i = 32;$i < 34; $i++) {?>
						<div class="bookWrap">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});">
								<img src="<?=$booksArray[$i]["img"]?>" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
								<p>
								<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="newprice"><?=round(-$booksArray[$i]["oldprice"]*($booksArray[$i]["discount"]/100-1))?> руб.</span>
								</p>
							</a>
						</div>
					<?}?>
				</div>
				<div id="slide1text">
				<a name="fac"></a>
				Факультатив
				</div>
				<div class="hintWrapp">
					<?for ($i = 26;$i < 29; $i++) {?>
						<div class="bookWrap">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});">
								<img src="<?=$booksArray[$i]["img"]?>" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
								<p>
								<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="newprice"><?=round(-$booksArray[$i]["oldprice"]*($booksArray[$i]["discount"]/100-1))?> руб.</span>
								</p>
							</a>
						</div>
					<?}?>
				</div>
				<div id="slide1text">
				<a name="crack"></a>
				Головоломки
				</div>
				<div class="hintWrapp">
					<?for ($i = 10;$i < 12; $i++) {?>
						<div class="bookWrap">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});">
								<img src="<?=$booksArray[$i]["img"]?>" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
								<p>
								<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="newprice"><?=round(-$booksArray[$i]["oldprice"]*($booksArray[$i]["discount"]/100-1))?> руб.</span>
								</p>
							</a>
						</div>
					<?}?>
				</div>
				<div id="slide1text">
				<a name="inventors"></a>
				Для изобретателей
				</div>
				<div class="hintWrapp">
					<?for ($i = 12;$i < 14; $i++) {?>
						<div class="bookWrap">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});">
								<img src="<?=$booksArray[$i]["img"]?>" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
								<p>
								<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="newprice"><?=round(-$booksArray[$i]["oldprice"]*($booksArray[$i]["discount"]/100-1))?> руб.</span>
								</p>
							</a>
						</div>
					<?}?>
				</div>	
				<div id="slide1text">
				<a name="time"></a>
				Чтобы всё успевать
				</div>
				<div class="hintWrapp">
					<?for ($i = 34;$i < 39; $i++) {?>
						<div class="bookWrap">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});">
								<img src="<?=$booksArray[$i]["img"]?>" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
								<p>
								<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="newprice"><?=round(-$booksArray[$i]["oldprice"]*($booksArray[$i]["discount"]/100-1))?> руб.</span>
								</p>
							</a>
						</div>
					<?}?>
				</div>


			</div>		
			<div class="footer">
				<script type="text/javascript" src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js" charset="utf-8"></script>
				<script type="text/javascript" src="//yastatic.net/share2/share.js" charset="utf-8"></script>
				<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki" data-counter="" style="position: absolute;left: 48%;bottom: 300px;"></div>
			</div>
			
		</div>

	</div>

 </body>
 </html>
 