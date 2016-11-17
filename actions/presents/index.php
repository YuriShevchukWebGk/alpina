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
    <title>Новогодние подарки</title>
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
	
	<meta property="og:title" content="Книги для учеников и студентов, их родителей и учителей со скидкой до 40%" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="https://www.alpinabook.ru/actions/september1/" />
	<meta property="og:image" content="https://www.alpinabook.ru/actions/september1/img/board_big.jpg" />
	<meta property="og:site_name" content="www.alpinabook.ru" />
	<meta property="fb:admins" content="1425804193" />
	<meta property="fb:app_id" content="138738742872757" />

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
//Для учителей
array('name'=>'Классный учитель ','id'=>'75273','link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/75273/','img'=>'1','oldprice'=>'399','newprice'=>'','discount'=>'20'),
array('name'=>'Обучение как приключение ','id'=>'8380','link'=>'/catalog/CreativityAndCreation/8380/','img'=>'2','oldprice'=>'479','newprice'=>'','discount'=>'20'),
//
//Для родителей
array('name'=>'Что такое интеллект и как его развивать ','id'=>'7704','link'=>'/catalog/BooksForParents/7704/','img'=>'3','oldprice'=>'479','newprice'=>'','discount'=>'40'),
array('name'=>'Все на одного: Как защитить ребенка от травли в школе ','id'=>'60925','link'=>'/catalog/BooksForParents/60925/','img'=>'4','oldprice'=>'369','newprice'=>'','discount'=>'40'),
array('name'=>'Наши хорошие подростки ','id'=>'6649','link'=>'/catalog/BooksForParents/6649/','img'=>'5','oldprice'=>'366','newprice'=>'','discount'=>'40'),
array('name'=>'Ваши взрослые дети ','id'=>'8696','link'=>'/catalog/BooksForParents/8696/','img'=>'6','oldprice'=>'399','newprice'=>'','discount'=>'40'),
array('name'=>'Уже взрослый, еще ребенок ','id'=>'8476','link'=>'/catalog/BooksForParents/8476/','img'=>'7','oldprice'=>'448','newprice'=>'','discount'=>'40'),
//
//Чтобы всё запоминать
array('name'=>'Развитие памяти по методикам спецслужб ','id'=>'8522','link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8522/','img'=>'8','oldprice'=>'399','newprice'=>'','discount'=>'20'),
array('name'=>'Эйнштейн гуляет по Луне: Наука и искусство запоминания ','id'=>'7815','link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/7815/','img'=>'9','oldprice'=>'399','newprice'=>'','discount'=>'40'),
array('name'=>'Запомнить все: Усвоение знаний без скуки и зубрежки ','id'=>'8430','link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8430/','img'=>'10','oldprice'=>'479','newprice'=>'','discount'=>'40'),
array('name'=>'Быстрый ум: Как забывать лишнее и помнить нужное ','id'=>'8159','link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8159/','img'=>'11','oldprice'=>'429','newprice'=>'','discount'=>'40'),
//
//Чтобы всё успевать
array('name'=>'Победи прокрастинацию ','id'=>'8155','link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8155/','img'=>'12','oldprice'=>'479','newprice'=>'','discount'=>'40'),
array('name'=>'Тайм-менеджмент для школьника ','id'=>'8666','link'=>'/catalog/BooksForParents/8666/','img'=>'13','oldprice'=>'529','newprice'=>'','discount'=>'40'),
array('name'=>'Тайм-менеджмент для детей ','id'=>'7399','link'=>'/catalog/BooksForParents/7399/','img'=>'14','oldprice'=>'559','newprice'=>'','discount'=>'40'),
//
//Для тех, кто ещё не определился с профессией
array('name'=>'Призвание: Как найти себя во взрослой жизни ','id'=>'8398','link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8398/','img'=>'15','oldprice'=>'318','newprice'=>'','discount'=>'40'),
//
//Мозговня
array('name'=>'Мозг. Инструкция по применению ','id'=>'7724','link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/7724/','img'=>'16','oldprice'=>'479','newprice'=>'','discount'=>'30'),
array('name'=>'Мозг зомби ','id'=>'78102','link'=>'/catalog/PopularPsychologyPersonalEffectiveness/78102/','img'=>'17','oldprice'=>'448','newprice'=>'','discount'=>'20'),
array('name'=>'Мозг прирученный ','id'=>'8320','link'=>'/catalog/PopularPsychologyPersonalEffectiveness/8320/','img'=>'18','oldprice'=>'479','newprice'=>'','discount'=>'40'),
array('name'=>'Мозгоускорители ','id'=>'75968','link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/75968/','img'=>'19','oldprice'=>'479','newprice'=>'','discount'=>'20'),
//
//Математика и смекалка
array('name'=>'5 минут на размышление ','id'=>'8660','link'=>'/catalog/CreativityAndCreation/8660/','img'=>'20','oldprice'=>'399','newprice'=>'','discount'=>'30'),
array('name'=>'Магия математики: Как найти икс и зачем это нужно ','id'=>'75436','link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/75436/','img'=>'21','oldprice'=>'479','newprice'=>'','discount'=>'30'),
array('name'=>'Думай как математик ','id'=>'8528','link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8528/','img'=>'22','oldprice'=>'459','newprice'=>'','discount'=>'30'),
array('name'=>'Математическая смекалка ','id'=>'68989','link'=>'/catalog/PopularScience/68989/','img'=>'23','oldprice'=>'399','newprice'=>'','discount'=>'30'),
array('name'=>'Невероятные числа профессора Стюарта ','id'=>'67827','link'=>'/catalog/PopularScience/67827/','img'=>'24','oldprice'=>'559','newprice'=>'','discount'=>'40'),
array('name'=>'Величайшие математические задачи ','id'=>'8298','link'=>'/catalog/PopularScience/8298/','img'=>'25','oldprice'=>'479','newprice'=>'','discount'=>'40'),
//
//Писательство
array('name'=>'Пиши ещё! ','id'=>'80484','link'=>'/catalog/ArtOfWriting/80484/','img'=>'26','oldprice'=>'448','newprice'=>'','discount'=>'20'),
array('name'=>'История на миллион долларов ','id'=>'66460','link'=>'/catalog/ArtOfWriting/66460/','img'=>'27','oldprice'=>'529','newprice'=>'','discount'=>'30'),
array('name'=>'Анатомия истории ','id'=>'79730','link'=>'/catalog/ArtOfWriting/79730/','img'=>'28','oldprice'=>'559','newprice'=>'','discount'=>'20'),
array('name'=>'Путешествие писателя ','id'=>'8438','link'=>'/catalog/ArtOfWriting/8438/','img'=>'29','oldprice'=>'562','newprice'=>'','discount'=>'40'),
array('name'=>'Школа литературного и сценарного мастерства ','id'=>'8570','link'=>'/catalog/ArtOfWriting/8570/','img'=>'30','oldprice'=>'479','newprice'=>'','discount'=>'40'),
array('name'=>'Восемь комедийных характеров ','id'=>'8684','link'=>'/catalog/ArtOfWriting/8684/','img'=>'31','oldprice'=>'479','newprice'=>'','discount'=>'40'),
array('name'=>'Как писать хорошо ','id'=>'7785','link'=>'/catalog/ArtOfWriting/7785/','img'=>'32','oldprice'=>'---','newprice'=>'','discount'=>'40'),
//
//Биология и эволюция
array('name'=>'Происхождение жизни ','id'=>'69020','link'=>'/catalog/PopularScience/69020/','img'=>'33','oldprice'=>'559','newprice'=>'','discount'=>'20'),
array('name'=>'Популярно о микробиологии ','id'=>'7481','link'=>'/catalog/PopularScience/7481/','img'=>'34','oldprice'=>'318','newprice'=>'','discount'=>'40'),
array('name'=>'Микрокосм ','id'=>'7897','link'=>'/catalog/PopularScience/7897/','img'=>'35','oldprice'=>'448','newprice'=>'','discount'=>'40'),
array('name'=>'Эволюция: Триумф идеи ','id'=>'6998','link'=>'/catalog/PopularScience/6998/','img'=>'36','oldprice'=>'559','newprice'=>'','discount'=>'40'),
array('name'=>'Мифы об эволюции человека ','id'=>'8454','link'=>'/catalog/PopularScience/8454/','img'=>'37','oldprice'=>'---','newprice'=>'','discount'=>'30'),
array('name'=>'Книга о самых невообразимых животных: Бестиарий XXI века ','id'=>'8446','link'=>'/catalog/PopularScience/8446/','img'=>'38','oldprice'=>'725','newprice'=>'','discount'=>'40'),
array('name'=>'Стой, кто ведет? ','id'=>'7918','link'=>'/catalog/PopularScience/7918/','img'=>'39','oldprice'=>'969','newprice'=>'','discount'=>'40'),
array('name'=>'Паразит — царь природы ','id'=>'6837','link'=>'/catalog/PopularScience/6837/','img'=>'40','oldprice'=>'399','newprice'=>'','discount'=>'40'),
//
//Врачебное
array('name'=>'Будущее медицины ','id'=>'76690','link'=>'/catalog/PopularScience/76690/','img'=>'41','oldprice'=>'599','newprice'=>'','discount'=>'40'),
array('name'=>'Здоровье по Дарвину ','id'=>'80473','link'=>'/catalog/PopularScience/80473/','img'=>'42','oldprice'=>'479','newprice'=>'','discount'=>'20'),
array('name'=>'С ума сойти! ','id'=>'70007','link'=>'/catalog/HealthAndHealthyFood/70007/','img'=>'43','oldprice'=>'399','newprice'=>'','discount'=>'20'),
//
//Инженерам и изобретателям
array('name'=>'Интернет вещей ','id'=>'75330','link'=>'/catalog/PopularScience/75330/','img'=>'44','oldprice'=>'479','newprice'=>'','discount'=>'40'),
array('name'=>'Будущее вещей: Как сказка и фантастика становятся реальностью ','id'=>'8480','link'=>'/catalog/PopularScience/8480/','img'=>'45','oldprice'=>'479','newprice'=>'','discount'=>'40'),
array('name'=>'Последнее изобретение человечества ','id'=>'8562','link'=>'/catalog/PopularScience/8562/','img'=>'46','oldprice'=>'399','newprice'=>'','discount'=>'40'),
array('name'=>'Роботы наступают: развитие технологий и будущее без работы ','id'=>'83139','link'=>'/catalog/PopularScience/83139/','img'=>'47','oldprice'=>'529','newprice'=>'','discount'=>'20'),
//
//Космос
array('name'=>'Руководство астронавта по жизни на Земле ','id'=>'8402','link'=>'/catalog/PublicismDocumentaryProse/8402/','img'=>'48','oldprice'=>'448','newprice'=>'','discount'=>'40'),
array('name'=>'История Земли: От звездной пыли — к живой планете ','id'=>'8292','link'=>'/catalog/PopularScience/8292/','img'=>'49','oldprice'=>'448','newprice'=>'','discount'=>'40'),
array('name'=>'Голубая точка. Космическое будущее человечества ','id'=>'75264','link'=>'/catalog/PopularScience/75264/','img'=>'50','oldprice'=>'479','newprice'=>'','discount'=>'40'),
//
//Физика
array('name'=>'Будущее разума ','id'=>'8290','link'=>'/catalog/PopularScience/8290/','img'=>'51','oldprice'=>'529','newprice'=>'','discount'=>'40'),
array('name'=>'Красота физики ','id'=>'8852','link'=>'/catalog/PopularScience/8852/','img'=>'52','oldprice'=>'639','newprice'=>'','discount'=>'40'),
array('name'=>'Физика будущего ','id'=>'7071','link'=>'/catalog/PopularScience/7071/','img'=>'53','oldprice'=>'479','newprice'=>'','discount'=>'40'),
array('name'=>'Мир, полный демонов: Наука — как свеча во тьме ','id'=>'7990','link'=>'/catalog/PopularScience/7990/','img'=>'54','oldprice'=>'479','newprice'=>'','discount'=>'40'),
array('name'=>'Гиперпространство ','id'=>'8026','link'=>'/catalog/PopularScience/8026/','img'=>'55','oldprice'=>'529','newprice'=>'','discount'=>'40'),
array('name'=>'Объясняя мир: Истоки современной науки ','id'=>'8790','link'=>'/catalog/PopularScience/8790/','img'=>'56','oldprice'=>'479','newprice'=>'','discount'=>'40'),
array('name'=>'Космос Эйнштейна ','id'=>'8738','link'=>'/catalog/PopularScience/8738/','img'=>'57','oldprice'=>'479','newprice'=>'','discount'=>'40'),
array('name'=>'Физика невозможного ','id'=>'6305','link'=>'/catalog/PopularScience/6305/','img'=>'58','oldprice'=>'448','newprice'=>'','discount'=>'40'),
//
//Английский язык и страноведение
array('name'=>'Приключения английского языка ','id'=>'7752','link'=>'/catalog/PublicismDocumentaryProse/7752/','img'=>'59','oldprice'=>'529','newprice'=>'','discount'=>'40'),
array('name'=>'Лондон. Биография ','id'=>'8466','link'=>'/catalog/HobbyTravelingCars/8466/','img'=>'60','oldprice'=>'799','newprice'=>'','discount'=>'40'),
array('name'=>'Британия: MIND THE GAP, или Как стать своим ','id'=>'8085','link'=>'/catalog/HobbyTravelingCars/8085/','img'=>'61','oldprice'=>'318','newprice'=>'','discount'=>'40'),
array('name'=>'Австралия — Terra Incognita ','id'=>'6910','link'=>'/catalog/HobbyTravelingCars/6910/','img'=>'62','oldprice'=>'299','newprice'=>'','discount'=>'40'),
array('name'=>'Сингапур: Восьмое чудо света ','id'=>'7467','link'=>'/catalog/HobbyTravelingCars/7467/','img'=>'63','oldprice'=>'479','newprice'=>'','discount'=>'40'),
//
//История
array('name'=>'Король Артур и рыцари Круглого стола ','id'=>'7641','link'=>'/catalog/PublicismDocumentaryProse/7641/','img'=>'64','oldprice'=>'479','newprice'=>'','discount'=>'40'),
array('name'=>'Первая мировая война: Катастрофа 1914 года ','id'=>'8186','link'=>'/catalog/PublicismDocumentaryProse/8186/','img'=>'65','oldprice'=>'729','newprice'=>'','discount'=>'40'),
array('name'=>'Вторая мировая война: Ад на земле ','id'=>'8246','link'=>'/catalog/PublicismDocumentaryProse/8246/','img'=>'66','oldprice'=>'899','newprice'=>'','discount'=>'40'),

);?>

<?$i = 0;?>

    <div class="landing">
        <div class="mainWrapp">
            <div class="slide1">
				<div id="slide1text">
				До Нового Года осталось:<br />
				<div style="position: absolute;    left: 46%;    top:145px;    font-size: 120px;    color: #fff;"> 45</div><img src="img/button.png" />
				<br />
				<div style="font-size:48px;margin-top:-60px;">дней<br /><div style="text-decoration:underline;">А у вас еще нет подарков?</div></div>
				</div>
				<br />
				
            </div>
			<div class="slide3" style="height:200px;">
				<div id="slide1text">
                Наши книги – это знания,<br />
которые изменят жизнь ваших  друзей  в 2017 году!

				</div>
            </div>
			<div class="slide4">
				<div id="slide1text">
				<a name="math"></a>
                Подарки-бестселлеры,<br />
				которые помогут лучше жить и трудиться в новом году:
				</div>
				<img src="img/clips.png" style="z-index:10000;position:absolute;margin-top:70px;"/>
				<div class="hintWrapp" style="margin-top:200px;">
					<?for ($i = 19;$i < 26; $i++) {?>
						<div class="bookWrap" style="margin-top:-40px;width:230px;">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});">
								<img src="files/<?=$booksArray[$i]["img"]?>.jpg" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
							</a>
						</div>
					<?}?>
				</div>
            </div>	
			<div class="slide5">
				<div id="slide1text">
                Низкие цены и высокие отношения!<br />
				Если вы закажете книг в подарок на сумму более 10 000 рублей, мы сделаем вам скидку 20%
				<br />
				</div>
            </div>				
			<div class="slide6">
				<div id="slide1text" style="font-size:30px;">
				<a name="teachers"></a>
                Подарки, которые раздвигают горизонты и приближают будущее
				</div>
				<div class="hintWrapp">
					<?for ($i = 0;$i < 6; $i++) {?>
						<div class="bookWrap">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});">
								<img src="files/<?=$booksArray[$i]["img"]?>.jpg" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
							</a>
						</div>
					<?}?>
				</div>
            </div>
			<div class="slide3">
				<div id="slide1text" style="font-size:30px;">
				Еще мы можем сделать красивые суперобложки с логотипом вашей компании,<br />
				фотографией любимого кота вашего босса или с чем вы захотите :)
				</div>
            </div>			
			<div class="slide5" style="background:#fff;height:1360px;text-align:center;">
				<div id="slide1text">
                <img src="img/cat.png" />
				</div>
				<div id="slide1text" style="font-size:30px;color:#777;margin-top:40px;">
				<a name="teachers"></a>
                Подарки, которые оценят настоящие профессионалы
				</div>
				<div class="hintWrapp">
					<?for ($i = 10;$i < 16; $i++) {?>
						<div class="bookWrap">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'cyberTuesdayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});">
								<img src="files/<?=$booksArray[$i]["img"]?>.jpg" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
							</a>
						</div>
					<?}?>
				</div>
				<img src="img/fir.png" />
            </div>
			<div class="slide3">
				<div id="slide1text" style="font-size:30px;">
				Мы придумаем, соберем и с любовью упакуем для вас и ваших коллег любую подборку из наших лучших книг.<br />
				Просто напишите или позвоните нам, все остальное мы берем на себя 
				</div>
            </div>				
            </div>		
			<div class="footer">

            </div>				
			
        </div>

    </div>

 </body>
 </html>
 