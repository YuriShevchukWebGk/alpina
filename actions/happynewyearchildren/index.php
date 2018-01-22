<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER;
CModule::IncludeModule("iblock");
$books = array(
array('no'=>2, 'img'=>'/upload/resize_cache/iblock/149/210_500_1/149dc8679eb423dc99628ddbeaa2ba55.jpg', 'name'=>'Играем в науку', 'discount'=>30, 'oldprice'=>169, 'newprice'=>118, 'link'=>'/catalog/KnigiDlyaDetei/117349/', 'diff'=>50.7, 'id'=>117349, 'description'=>'Это книга простых экспериментов, доступных для ребенка. Наука окружит его даже дома!'),
array('no'=>3, 'img'=>'/upload/resize_cache/iblock/7dd/210_500_1/7ddf4f997c44b84f23e348e0e48d636b.jpg', 'name'=>'Дневник наблюдений. Гуляем в лесу и изучаем природу', 'discount'=>30, 'oldprice'=>169, 'newprice'=>118, 'link'=>'/catalog/KnigiDlyaDetei/380626/', 'diff'=>50.7, 'id'=>380626, 'description'=>'Книга научит юного читателя любить природу и исследовать её, записывая наблюдения.'),
array('no'=>4, 'img'=>'/upload/resize_cache/iblock/83c/210_500_1/83cfec2405ad1f875e2289e9bec10508.jpg', 'name'=>'История моей страны в картинках. Древние княжества, удивительные народы, сильные и смелые правители', 'discount'=>30, 'oldprice'=>169, 'newprice'=>118, 'link'=>'/catalog/KnigiDlyaDetei/380620/', 'diff'=>50.7, 'id'=>380620, 'description'=>'На каждом развороте – миллион интересных фактов из истории России!'),
array('no'=>5, 'img'=>'/upload/resize_cache/iblock/859/210_500_1/8596b13135ff8fe7786cde415a094a8e.jpg', 'name'=>'Летим в космос. Самые "улетные" космические приключения', 'discount'=>30, 'oldprice'=>169, 'newprice'=>118, 'link'=>'/catalog/KnigiDlyaDetei/380617/', 'diff'=>50.7, 'id'=>380617, 'description'=>'Так просто и понятно, что каждый захочет стать космонавтом!'),
array('no'=>6, 'img'=>'/upload/resize_cache/iblock/511/210_500_1/5110cd02a4f46e54e2591420bbd53e62.jpg', 'name'=>'Фруктовые истории. Из чего делают сок, варенье и другие вкусности', 'discount'=>30, 'oldprice'=>169, 'newprice'=>118, 'link'=>'/catalog/KnigiDlyaDetei/380612/', 'diff'=>50.7, 'id'=>380612, 'description'=>'Листая книжку, дети узнают, как арбуз попал в Россию и откуда у клубники усы?'),
array('no'=>7, 'img'=>'/upload/resize_cache/iblock/b5c/210_500_1/b5ca20c76bd29ffb1eee605a95c06fa9.jpg', 'name'=>'Овощные истории. Из чего делают суп, салат и другие вкусности', 'discount'=>30, 'oldprice'=>169, 'newprice'=>118, 'link'=>'/catalog/KnigiDlyaDetei/380591/', 'diff'=>50.7, 'id'=>380591, 'description'=>'Дети подружатся с овощами и полюбят их – как на картинках, так и в тарелке!'),
array('no'=>0, 'img'=>'/upload/resize_cache/iblock/185/210_500_1/185b20b269a151a3903dc16654ebd75b.jpg', 'name'=>'Большое сафари', 'discount'=>30, 'oldprice'=>239, 'newprice'=>167, 'link'=>'/catalog/KnigiDlyaDetei/8638/', 'diff'=>71.7, 'id'=>8638, 'description'=>'«Книга года: Выбирают дети» — 2015'),
array('no'=>1, 'img'=>'/upload/resize_cache/iblock/39a/210_500_1/39aa6b5289af9922ed0c9206d2ff10c9.jpg', 'name'=>'Злючка-колючка', 'discount'=>30, 'oldprice'=>239, 'newprice'=>167, 'link'=>'/catalog/KnigiDlyaDetei/8640/', 'diff'=>71.7, 'id'=>8640, 'description'=>'Приключение по обучающему мультфильму «Котики, вперед!»'),
array('no'=>8, 'img'=>'/upload/resize_cache/iblock/2ee/210_500_1/2ee4507ad4167ef491df024f6f14defb.jpg', 'name'=>'Я козел', 'discount'=>30, 'oldprice'=>299, 'newprice'=>209, 'link'=>'/catalog/KnigiDlyaDetei/82276/', 'diff'=>89.7, 'id'=>82276, 'description'=>'От Бориса Кузнецова, директора издательства «Росмэн»'),
array('no'=>9, 'img'=>'/upload/resize_cache/iblock/e44/210_500_1/e448b19d0d6fec225b949424282f0dc6.jpg', 'name'=>'Я скунс', 'discount'=>30, 'oldprice'=>299, 'newprice'=>209, 'link'=>'/catalog/KnigiDlyaDetei/82267/', 'diff'=>89.7, 'id'=>82267, 'description'=>'От Татьяны Устиновой, известного писателя и телеведущей. '),
array('no'=>10, 'img'=>'/upload/resize_cache/iblock/50e/210_500_1/50e9875b74c36faafe9435dd25bb6dfd.jpg', 'name'=>'Я английский бульдог', 'discount'=>30, 'oldprice'=>299, 'newprice'=>209, 'link'=>'/catalog/KnigiDlyaDetei/82282/', 'diff'=>89.7, 'id'=>82282, 'description'=>'От актера Стаса Садальского'),
array('no'=>11, 'img'=>'/upload/resize_cache/iblock/4a4/210_500_1/4a41e5de2cff8e4ef51a3bade9db2def.jpg', 'name'=>'Я малая панда', 'discount'=>30, 'oldprice'=>299, 'newprice'=>209, 'link'=>'/catalog/KnigiDlyaDetei/85132/', 'diff'=>89.7, 'id'=>85132, 'description'=>'От телеведущей и актрисы Татьяны Лазаревой'),
array('no'=>12, 'img'=>'/upload/resize_cache/iblock/54f/210_500_1/54f71dd7cb926fae04a1fa52d8ec5556.jpg', 'name'=>'Я летучая мышь', 'discount'=>30, 'oldprice'=>299, 'newprice'=>209, 'link'=>'/catalog/KnigiDlyaDetei/82280/', 'diff'=>89.7, 'id'=>82280, 'description'=>'От Марины Абрамовой, директора издательского холдинга ЭКСМО-АСТ'),
array('no'=>13, 'img'=>'/upload/resize_cache/iblock/7ac/210_500_1/7ac8329d2dc891df8113ad800d36aa04.jpg', 'name'=>'Я лось', 'discount'=>30, 'oldprice'=>299, 'newprice'=>209, 'link'=>'/catalog/KnigiDlyaDetei/65411/', 'diff'=>89.7, 'id'=>65411, 'description'=>'От Натальи Лосевой, директора «Мосгортура»'),
array('no'=>14, 'img'=>'/upload/resize_cache/iblock/fa1/210_500_1/fa1a2a82ddc9eedf9f7e61567ec8ceab.jpg', 'name'=>'Я мартышка', 'discount'=>30, 'oldprice'=>299, 'newprice'=>209, 'link'=>'/catalog/KnigiDlyaDetei/66407/', 'diff'=>89.7, 'id'=>66407, 'description'=>'От кинорежиссера Бориса Грачевского'),
array('no'=>15, 'img'=>'/upload/resize_cache/iblock/19f/210_500_1/19ffa40165740533d73afae647bfef0c.jpg', 'name'=>'Я слон', 'discount'=>30, 'oldprice'=>299, 'newprice'=>209, 'link'=>'/catalog/KnigiDlyaDetei/357377/', 'diff'=>89.7, 'id'=>357377, 'description'=>'От певца Леонида Агутина'),
array('no'=>16, 'img'=>'/upload/resize_cache/iblock/84e/210_500_1/84e88691e90b5e659ad58b0c791c0fb4.jpg', 'name'=>'Я вомбат', 'discount'=>30, 'oldprice'=>299, 'newprice'=>209, 'link'=>'/catalog/KnigiDlyaDetei/66411/', 'diff'=>89.7, 'id'=>66411, 'description'=>'От писателя Дмитрия Быкова'),
array('no'=>17, 'img'=>'/upload/resize_cache/iblock/323/210_500_1/323ef6a7f5da6a024c94a7f3f5d23b6e.jpg', 'name'=>'Я ленивец', 'discount'=>30, 'oldprice'=>299, 'newprice'=>209, 'link'=>'/catalog/KnigiDlyaDetei/65627/', 'diff'=>89.7, 'id'=>65627, 'description'=>'От телеведущего Антона Комолова'),
array('no'=>18, 'img'=>'/upload/resize_cache/iblock/735/210_500_1/73508b7c04fc664cfd1cdbe8e71f293a.jpg', 'name'=>'Я кот', 'discount'=>30, 'oldprice'=>299, 'newprice'=>209, 'link'=>'/catalog/KnigiDlyaDetei/82271/', 'diff'=>89.7, 'id'=>82271, 'description'=>'От актера Сергея Юрского'),
array('no'=>19, 'img'=>'/upload/resize_cache/iblock/d1b/210_500_1/d1b4280eef04e4369d6ae7b865038730.jpg', 'name'=>'Я змея', 'discount'=>30, 'oldprice'=>299, 'newprice'=>209, 'link'=>'/catalog/KnigiDlyaDetei/60897/', 'diff'=>89.7, 'id'=>60897, 'description'=>'От музыканта Андрея Макаревича'),
array('no'=>20, 'img'=>'/upload/resize_cache/iblock/d1e/210_500_1/d1ed6d12fd8f2bef63eb74b8a6b8f584.jpg', 'name'=>'Я дельфин', 'discount'=>30, 'oldprice'=>299, 'newprice'=>209, 'link'=>'/catalog/KnigiDlyaDetei/65631/', 'diff'=>89.7, 'id'=>65631, 'description'=>'От режиссера Владимира Мирзоева'),
array('no'=>21, 'img'=>'/upload/resize_cache/iblock/831/210_500_1/831f70354eb9829182acf3ca3bada188.jpg', 'name'=>'Я свинья', 'discount'=>30, 'oldprice'=>299, 'newprice'=>209, 'link'=>'/catalog/KnigiDlyaDetei/97247/', 'diff'=>89.7, 'id'=>97247, 'description'=>'От Константина Антипова, директора Высшей школы печати и медиаиндустрии'),
array('no'=>22, 'img'=>'/upload/resize_cache/iblock/e4c/210_500_1/e4c2eb81ae48cd6101a0561afd28aeeb.jpg', 'name'=>'Я лев', 'discount'=>30, 'oldprice'=>299, 'newprice'=>209, 'link'=>'/catalog/KnigiDlyaDetei/55606/', 'diff'=>89.7, 'id'=>55606, 'description'=>'От писателя Андрея Максимова'),
);
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="robots" content="index, follow"/>
    <meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width; initial-scale=1.0">
    <title>Новогодние подарки детям! -30% при заказе от трех книг</title>
    <meta name="keywords" content=""/>
    <meta name="description" content="Новогодние подарки детям! -30% при заказе от трех книг"/>
    <link href="style.css?2017121231" rel="stylesheet">
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="scripts.js"></script>
	
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
	
	<meta property="og:title" content="Новогодние подарки детям! -30% при заказе от трех книг" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="https://www.alpinabook.ru/actions/happynewyearchildren/" />
	<meta property="og:image" content="https://www.alpinabook.ru/actions/happynewyearchildren/img/social.jpg" />
	<meta property="og:site_name" content="www.alpinabook.ru" />
	<meta property="fb:admins" content="1425804193" />
	<meta property="fb:app_id" content="138738742872757" />
</head>
<body>
<style>
.hideInfo {display:none!important;}
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
        <p class="telephone">
			<a href="tel:+74951200704">+7 (495) 120 07 04</a>
			<br>
			<a href="tel:+78005505322">+7 (800) 550 53 22</a>
		</p>
    </div>
</header>

<div id="mainWrapp">
	<div id="actionWrapp">
		<div id="header">
			<div class="ball">
				Гарантия<br />доставки до<br />Нового года
			</div>
			<img src="img/tree.png" align="right" />
			<span class="title">Новогодние подарки детям</span>
			<br />
			<span class="description"><span class="red">-30%</span> при заказе от&nbsp;<span class="red">трех</span> книг</span>
			<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
			<script src="//yastatic.net/share2/share.js"></script>
			<center><div class="ya-share2" data-services="facebook,vkontakte,odnoklassniki" data-counter=""></div></center>
		</div>
	</div>
	<div id="descriptionWrapp">
		Дарите детям познавательные книги!<img src="img/gift.png" align="right" />
		<br /><br />
		С&nbsp;книгами <span class="red">&laquo;Альпина.Дети&raquo;</span> каждый ребенок станет <span class="blue">любознательным</span>, захочет заниматься <span class="blue">наукой</span>, изучать <span class="blue">историю</span>, знакомиться с&nbsp;<span class="blue">животными</span>, улететь в&nbsp;космос. И&nbsp;увидит, как интересно <span class="blue">исследовать мир</span>.
		<br /><br />
		При заказе <span class="red">до&nbsp;15&nbsp;декабря</span> мы&nbsp;гарантированно доставим вам заказ <span class="red">до&nbsp;Нового года в&nbsp;любую точку России</span>. 
		<br /><br />
		Получить скидку&nbsp;30% очень просто! Цена автоматически станет меньше, как только в&nbsp;вашей корзине будет более трех книг с&nbsp;этой страницы.
	</div>
	<div class="blueBlock">
		<div class="booksWrap">
			<?for ($i = 0;$i < 8; $i++) {?>
				<div class="bookWrap">
					<a href="<?=$books[$i]["link"]?>" target="_blank">
						<span class="title"><?=$books[$i]["description"]?></span>
						<img src="<?=$books[$i]["img"]?>" title="<?=$books[$i]["name"]?>" align="center" />
						<span class="price">
							<span class="old"><?=$books[$i]["oldprice"]?><span class="rubsign"></span></span>
							<span class="new"><?=$books[$i]["newprice"]?><span class="rubsign"></span></span>
						</span>
					</a>
				</div>
			<?}?>
		</div>
	</div>
	
	<div class="whiteBlock">
		<div class="booksWrap">
			<?for ($i = 8;$i < 23; $i++) {?>
				<div class="bookWrap">
					<a href="<?=$books[$i]["link"]?>">
						<span class="title"><?=$books[$i]["description"]?></span>
						<img src="<?=$books[$i]["img"]?>" title="<?=$books[$i]["name"]?>" align="center" />
						<span class="price">
							<span class="old"><?=$books[$i]["oldprice"]?><span class="rubsign"></span></span>
							<span class="new"><?=$books[$i]["newprice"]?><span class="rubsign"></span></span>
						</span>
					</a>
				</div>
			<?}?>
		</div>
	</div>
</div>
<footer>
	<div class="delivery">
		<div class="title">
			<img src="img/crystall.png" align="right" />
			Гарантия <span class="red">доставки до&nbsp;Нового года</span> при <span class="red">заказе до&nbsp;15&nbsp;декабря</span>!
		</div>
		<br style="clear:both;float:none">
		<div class="service">
			<a href=""><img src="img/kur.jpg" align="left" />Курьерская доставка по Москве в пределах МКАД</a>
			<br /><br />
			Бесплатная доставка от 2 000 руб. 
		</div>
		<div class="service">
			<a href=""><img src="img/sam.jpg" align="left" />Самовывоз из офисе в Москве</a>
			<br /><br />
			Бесплатно
		</div>
		<div class="service">
			<a href=""><img src="img/post.jpg" align="left" />Пункты выдачи заказов по всей России</a>
			<br /><br />
			Стоимость доставки рассчитывается автоматически при оформлении заказа 
		</div>
	</div>
	<div class="socials">
		<img src="img/bells.png" style="display:block;margin:-110px 0 40px 0" />
		<center><div class="ya-share2" data-services="facebook,vkontakte,odnoklassniki" data-counter=""></div></center>
	</div>
	<div class="bottom">
		<img src="img/bottom_logo.jpg" />
	</div>
</footer>
</body>
</html>
 