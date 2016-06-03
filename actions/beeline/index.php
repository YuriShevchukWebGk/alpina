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
    <title>Акция для премиум-клиентов Beeline</title>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/template_57363f3dd71b4bfd17109917de7b3143.css" rel="stylesheet">
	<link href="css/newstyle.css" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

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
	<?/*
	<meta property="og:title" content="Акция для премиум-клиентов Beeline" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="http://www.alpinabook.ru/actions/cybertuesday/" />
	<meta property="og:image" content="http://www.alpinabook.ru/actions/cybertuesday/img/headern.jpg" />
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
array('name'=>'Думай как математик: Как решать любые проблемы быстрее и эффективнее (с автографом автора) ','id'=>'8528','link'=>'/catalog/temporary/8528/','img'=>'1','oldprice'=>'459','newprice'=>'367','discount'=>'20'),
array('name'=>'Мозг: Тонкая настройка. Наша жизнь с точки зрения нейронауки ','id'=>'55598','link'=>'/catalog/temporary/55598/','img'=>'2','oldprice'=>'529','newprice'=>'423','discount'=>'20'),
array('name'=>'5 минут на размышление: Лучшие головоломки советского времени ','id'=>'8660','link'=>'/catalog/temporary/8660/','img'=>'3','oldprice'=>'399','newprice'=>'319','discount'=>'20'),
array('name'=>'Развитие памяти по методикам спецслужб ','id'=>'8093','link'=>'/catalog/temporary/8093/','img'=>'4','oldprice'=>'729','newprice'=>'583','discount'=>'20'),
array('name'=>'Мозг. Инструкция по применению: Как использовать свои возможности по максимуму и без перегрузок ','id'=>'7724','link'=>'/catalog/temporary/7724/','img'=>'5','oldprice'=>'479','newprice'=>'383','discount'=>'20'),
array('name'=>'Договориться можно обо всем! Как добиваться максимума в любых переговорах ','id'=>'7028','link'=>'/catalog/temporary/7028/','img'=>'6','oldprice'=>'529','newprice'=>'423','discount'=>'20'),
array('name'=>'Аргументируй это! Как убедить кого угодно в чем угодно ','id'=>'8242','link'=>'/catalog/temporary/8242/','img'=>'7','oldprice'=>'559','newprice'=>'447','discount'=>'20'),
array('name'=>'Шпаргалки для боссов: Жесткие и честные уроки управления, которые лучше выучить на чужом опыте ','id'=>'8698','link'=>'/catalog/temporary/8698/','img'=>'8','oldprice'=>'479','newprice'=>'383','discount'=>'20'),
array('name'=>'Мои правила: Слушай, учись, смейся и будь лидером ','id'=>'8496','link'=>'/catalog/temporary/8496/','img'=>'9','oldprice'=>'509','newprice'=>'407','discount'=>'20'),
array('name'=>'Разработка ценностных предложений: Как создавать товары и услуги, которые захотят купить потребители. Ваш первый шаг ','id'=>'8564','link'=>'/catalog/temporary/8564/','img'=>'10','oldprice'=>'725','newprice'=>'580','discount'=>'20'),
array('name'=>'Стратегия семейной жизни: Как реже мыть посуду, чаще заниматься сексом и меньше ссориться ','id'=>'8024','link'=>'/catalog/temporary/8024/','img'=>'11','oldprice'=>'429','newprice'=>'343','discount'=>'20'),
array('name'=>'На крючке: Как разорвать круг нездоровых отношений ','id'=>'68411','link'=>'/catalog/temporary/68411/','img'=>'12','oldprice'=>'479','newprice'=>'383','discount'=>'20'),
array('name'=>'Все сложно: Как спасти отношения, если вы рассержены, обижены или в отчаянии ','id'=>'8546','link'=>'/catalog/temporary/8546/','img'=>'13','oldprice'=>'399','newprice'=>'319','discount'=>'20'),
array('name'=>'Как мы делаем это: Эволюция и будущее репродуктивного поведения человека ','id'=>'8848','link'=>'/catalog/temporary/8848/','img'=>'14','oldprice'=>'479','newprice'=>'383','discount'=>'20'),
array('name'=>'Почему мы такие? 16 типов личности, определяющих, как мы живем, работаем и любим ','id'=>'7855','link'=>'/catalog/temporary/7855/','img'=>'15','oldprice'=>'479','newprice'=>'383','discount'=>'20'),
array('name'=>'Стареть не обязательно! Будь вечно молодым (или сделай для этого всё возможное) ','id'=>'8862','link'=>'/catalog/temporary/8862/','img'=>'16','oldprice'=>'479','newprice'=>'383','discount'=>'20'),
array('name'=>'Бьюти-мифы: Вся правда о ботоксе, стволовых клетках, органической косметике и многом другом ','id'=>'8254','link'=>'/catalog/temporary/8254/','img'=>'17','oldprice'=>'529','newprice'=>'423','discount'=>'20'),
array('name'=>'Человек уставший: Как победить хроническую усталость и вернуть себе силы, энергию и радость жизни ','id'=>'8386','link'=>'/catalog/temporary/8386/','img'=>'18','oldprice'=>'479','newprice'=>'383','discount'=>'20'),
array('name'=>'Ешь, двигайся, спи: Как повседневные решения влияют на здоровье и долголетие ','id'=>'8091','link'=>'/catalog/temporary/8091/','img'=>'19','oldprice'=>'479','newprice'=>'383','discount'=>'20'),
array('name'=>'Век тревожности: Страхи, надежды, неврозы и поиски душевного покоя ','id'=>'66418','link'=>'/catalog/temporary/66418/','img'=>'20','oldprice'=>'479','newprice'=>'383','discount'=>'20'),
);

$digitalBooks = array(
	array('name'=>'Мозг. Инструкция по применению: Как использовать свои возможности по максимуму и без перегрузок ','id'=>'7724','link'=>'/catalog/temporary/7724/','img'=>'5','oldprice'=>'479','newprice'=>'383','discount'=>'20', 'code' => 'gift_brain'),
	array('name'=>'Аргументируй это! Как убедить кого угодно в чем угодно ','id'=>'8242','link'=>'/catalog/temporary/8242/','img'=>'7','oldprice'=>'559','newprice'=>'447','discount'=>'20', 'code' => 'gift_talks'),
	array('name'=>'Как мы делаем это: Эволюция и будущее репродуктивного поведения человека ','id'=>'8848','link'=>'/catalog/temporary/8848/','img'=>'14','oldprice'=>'479','newprice'=>'383','discount'=>'20', 'code' => 'gift_loves'),
	array('name'=>'Стареть не обязательно! Будь вечно молодым (или сделай для этого всё возможное) ','id'=>'8862','link'=>'/catalog/temporary/8862/','img'=>'16','oldprice'=>'479','newprice'=>'383','discount'=>'20', 'code' => 'gift_antiage')
);?>

<?$i = 0;?>

    <div class="landing">
        <div class="mainWrapp">
            <div class="slide1">
				<div id="slide1text">
                Большие скидки и книги в подарок<br />
				от «Альпины Паблишер» каждому<br />
				премиум-клиенту Beeline
				</div>
            </div>
			<div class="slide3">
				<div id="slide1text">
                С 4 по 30 июня вы можете купить<br />
				эти книги со скидкой 20%
				</div>
            </div>
			<div class="slide4">
				<div id="slide1text">
                Книги для нестандартного мышления<br />
				и укрепления памяти
				</div>
				<div class="hintWrapp">
					<?for ($i = $i;$i < 5; $i++) {?>
						<div class="bookWrap">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});">
								<img src="files/<?=$booksArray[$i]["img"]?>.jpg" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
								<p>
								<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="newprice"><?=$booksArray[$i]["newprice"]?> руб.</span>
								</p>
							</a>
						</div>
					<?}?>
				</div>
				<div id="slide1text">
                Книги для стремительной карьеры<br />
				и профессиональных успехов
				</div>
				<div class="hintWrapp">
					<?for ($i = $i;$i < 10; $i++) {?>
						<div class="bookWrap">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});">
								<img src="files/<?=$booksArray[$i]["img"]?>.jpg" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
								<p>
								<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span>  <span class="newprice"><?=$booksArray[$i]["newprice"]?> руб.</span>
								</p>
							</a>
						</div>
					<?}?>
				</div>					
            </div>	
			<div class="slide5">
				<div id="slide1text">
                Чтобы получить скидку,<br />
				необходимо при оформлении заказа<br />
				ввести промокод <span class="beelineUnderLine">beeline</span>
				<br />
					<div id="slide2text">
						Этот промокод действует с 4 по 30 июня
					</div>
				</div>
            </div>				
			<div class="slide6">
				<div id="slide1text">
                Книги для здоровых<br />
				и гармоничных отношений
				</div>
				<div class="hintWrapp">
					<?for ($i = $i;$i < 15; $i++) {?>
						<div class="bookWrap">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});">
								<img src="files/<?=$booksArray[$i]["img"]?>.jpg" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
								<p>
								<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="newprice"><?=$booksArray[$i]["newprice"]?> руб.</span>
								</p>
							</a>
						</div>
					<?}?>
				</div>
				<div id="slide1text">
                Книги для красоты, здоровья<br />
				и просто счастья
				</div>
				<div class="hintWrapp">
					<?for ($i = $i;$i < 20; $i++) {?>
						<div class="bookWrap">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});">
								<img src="files/<?=$booksArray[$i]["img"]?>.jpg" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
								<p>
								<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="newprice"><?=$booksArray[$i]["newprice"]?> руб.</span>
								</p>
							</a>
						</div>
					<?}?>
				</div>					
            </div>
				<div class="slide7">
				<div id="slide1text">
                Четыре свежих бестселлера<br />
				в электронном виде<br />
				совершенно <span class="beelineUnderLine">бесплатно!</span>
				</div>
            </div>
			
			<div class="bottom1">
				<div class="circle">
					1
				</div>
				<div class="slide1text">
					Загрузите на свой смартфон приложение «Бизнес.Книги» (это можно сделать <a href="https://adretaill.onelink.me/3956041590?pid=beeline" target="_blank">по ссылке</a>)
				</div>
            </div>
			<div class="bottom1">
				<div class="circle">
					2
				</div>
				<div class="slide1text">
					Для iOS-устройств: В приложении в правом верхнем углу нажмите кнопку «поиск»<br />
					<img src="img/search.jpg" />
					<br /><br />
					Для Android-устройств: Меню — Промокод<br /><br />
					<img src="img/promo.jpg" />
				</div>
            </div>
			<div class="bottom1">
				<div class="circle">
					3
				</div>
				<div class="slide1text">
					В строку поиска (на iOS) или в разделе Промокод<br />(на Android) введите следующие промо-коды:
				</div>
				<div class="hintWrapp">
					<?foreach ($digitalBooks as $book) {?>
						<div class="bookWrap" style="width:24%;display:block;float:left;">
							
								<div style="height:230px;"><img src="files/<?=$book["img"]?>.jpg" alt="<?=$book["name"]?>" title="<?=$book["name"]?>" /></div>
								<div style="padding:15px 0;">
									<span class="beelineUnderLine" style="font-size:32px;">
										<?=$book["code"]?>
									</span>
								</div>
								<p>
								<span class="newprice" style="font-size:12px;">«<?=$book["name"]?>»</span>
								</p>
							
						</div>
					<?}?>
				</div>					
            </div>
			<div class="bottom1 last">
				<div class="circle">
					4
				</div>
				<div class="slide1text">
					Бесплатная книга появится в списке ваших книг.<br />
					Просто коснитесь ее, чтобы загрузить на ваше устройство!<br />
					Читайте и наслаждайтесь :)
				</div>
            </div>
			<div class="footer">

            </div>				
        </div>

    </div>

 </body>
 </html>
 