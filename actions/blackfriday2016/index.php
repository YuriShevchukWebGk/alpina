<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER;
CModule::IncludeModule("iblock");
$today = date("w");
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="robots" content="index, follow"/>
    <meta charset="utf-8"/>
    <title>Скидки до 70%! Черная пятница 2016 — Интернет-магазин «Альпина Паблишер»</title>
    <meta name="keywords" content=""/>
    <meta name="description" content="Черная пятница в интернет-магазине пройдет с 24 по 26 ноября. Скидки до 70%!"/>
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
	
	<meta property="og:title" content="Настоящие скидки до 70%! Черная пятница 2016 — Интернет-магазин «Альпина Паблишер»" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="/actions/blackfriday2016/" />
	<meta property="og:image" content="/images/blackfriday2016.png" />
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
        <p class="telephone" style="font-size: 14px;font-family: 'Walshein_regular'">
            +7 (495) 980 80 77
        </p>
    </div>
</header>
<?$booksArray = array(
array('name'=>'Атлант расправил плечи (три тома в одной книге)','id'=>'65392','link'=>'/catalog/BusinessNovels/65392/?from=bflanding','img'=>'/upload/iblock/418/4185c8e06140ef5314b7067d7ca58b62.jpg','oldprice'=>'849','newprice'=>'679,2','discount'=>'20'),
array('name'=>'7 навыков высокоэффективных людей: Мощные инструменты развития личности','id'=>'7351','link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/7351/?from=bflanding','img'=>'/upload/iblock/c00/c00f64a7ee1a098f9921dcd8cf6f0054.jpg','oldprice'=>'699','newprice'=>'629,1','discount'=>'10'),
array('name'=>'Вся кремлевская рать: Краткая история современной России','id'=>'8722','link'=>'/catalog/Policy/8722/?from=bflanding','img'=>'/upload/iblock/cec/cec7b1c0466e91e54db5a985a5c1dbda.jpg','oldprice'=>'479','newprice'=>'431,1','discount'=>'10'),
array('name'=>'Мужчина в отрыве: Игры, порно и потеря идентичности','id'=>'80687','link'=>'/catalog/PopularPsychologyPersonalEffectiveness/80687/?from=bflanding','img'=>'/upload/iblock/678/6787d9f5910d0241ee611d5834b4f264.jpg','oldprice'=>'479','newprice'=>'431,1','discount'=>'10'),
array('name'=>'После трех уже поздно (СУПЕРОБЛОЖКА)','id'=>'66489','link'=>'/catalog/BooksForParents/66489/?from=bflanding','img'=>'/upload/iblock/62e/62e451ecdf9f4d9e7f7385cd83e93f6f.jpg','oldprice'=>'448','newprice'=>'358,4','discount'=>'20'),
array('name'=>'Развитие памяти по методикам спецслужб: Карманная версия','id'=>'8522','link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8522/?from=bflanding','img'=>'/upload/iblock/bec/beca338fbb8a11ac0a9b51f74f6a35fa.jpg','oldprice'=>'399','newprice'=>'319,2','discount'=>'20'),
array('name'=>'География гениальности: Где и почему рождаются великие идеи','id'=>'80512','link'=>'/catalog/CreativityAndCreation/80512/?from=bflanding','img'=>'/upload/iblock/151/151be4194890b1b5fde34e6307134de1.jpg','oldprice'=>'479','newprice'=>'431,1','discount'=>'10'),
array('name'=>'Антистресс для занятых людей: Медитативная раскраска (Макси)','id'=>'8624','link'=>'/catalog/CreativityAndCreation/8624/?from=bflanding','img'=>'/upload/iblock/034/0341a322a5dfbba3aa42fb29f15980f6.jpg','oldprice'=>'399','newprice'=>'199,5','discount'=>'50'),
array('name'=>'McDonald`s: Как создавалась империя','id'=>'6037','link'=>'/catalog/SuccessStory/6037/?from=bflanding','img'=>'/upload/iblock/fc5/fc5e1662ed8070fd9c09a64f6378e8f1.jpg','oldprice'=>'469','newprice'=>'281,4','discount'=>'40'),
array('name'=>'Без воды: Как писать предложения и отчеты для первых лиц','id'=>'7928','link'=>'/catalog/PrezentatsiiRitorika/7928/?from=bflanding','img'=>'/upload/iblock/f51/f51c9d654463a3cccc299493d73af047.jpg','oldprice'=>'399','newprice'=>'319,2','discount'=>'20'),
array('name'=>'В поисках потока: Психология включенности в повседневность','id'=>'6994','link'=>'/catalog/PopularPsychologyPersonalEffectiveness/6994/?from=bflanding','img'=>'/upload/iblock/3db/3db988d41f0e5483b54741a631c97362.jpg','oldprice'=>'366','newprice'=>'329,4','discount'=>'10'),
array('name'=>'Восьмой навык: Руководство пользователя','id'=>'6219','link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/6219/?from=bflanding','img'=>'/upload/iblock/407/40771e4ac2e69d36a5d258ac50581a8b.jpg','oldprice'=>'366','newprice'=>'292,8','discount'=>'20'),
array('name'=>'Вязание без слез: Базовые техники и понятные схемы для создания изделий любого размера','id'=>'68998','link'=>'/catalog/CreativityAndCreation/68998/?from=bflanding','img'=>'/upload/iblock/9ca/9cae643a0b6a3321c10fe0c46837c832.png','oldprice'=>'448','newprice'=>'403,2','discount'=>'10'),
array('name'=>'Идеальный руководитель: Почему им нельзя стать и что из этого следует','id'=>'5891','link'=>'/catalog/GeneralManagment/5891/?from=bflanding','img'=>'/upload/iblock/77f/77f6d21a5d6b437cffb5f5a64309b47e.jpg','oldprice'=>'559','newprice'=>'447,2','discount'=>'20'),
array('name'=>'Мозгоускорители: Как научиться эффективно мыслить, используя приемы из разных наук','id'=>'75968','link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/75968/?from=bflanding','img'=>'/upload/iblock/ef8/ef8ba1e99fb2839dfc517ce71674239b.jpg','oldprice'=>'479','newprice'=>'383,2','discount'=>'20'),
array('name'=>'Запомнить все: Усвоение знаний без скуки и зубрежки','id'=>'8430','link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8430/?from=bflanding','img'=>'/upload/iblock/a6f/a6f1d8ccc230b6298305b5d73fdb5943.jpg','oldprice'=>'479','newprice'=>'383,2','discount'=>'20'),
array('name'=>'Режим гения: Распорядок дня великих людей','id'=>'7819','link'=>'/catalog/PopularPsychologyPersonalEffectiveness/7819/?from=bflanding','img'=>'/upload/iblock/a8d/a8db1715c52d120fcabadb3879bb0f7a.jpg','oldprice'=>'479','newprice'=>'335,3','discount'=>'30'),
array('name'=>'Медитация и осознанность: 10 минут в день, которые приведут ваши мысли в порядок','id'=>'8008','link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8008/?from=bflanding','img'=>'/upload/iblock/775/77543a648fb8dcf951ff3cc0e5be5160.jpg','oldprice'=>'448','newprice'=>'358,4','discount'=>'20'),
array('name'=>'Ментальные ловушки: Глупости, которые делают разумные люди, чтобы испортить себе жизнь (ПЕРЕПЛЕТ)','id'=>'7030','link'=>'/catalog/PopularPsychologyPersonalEffectiveness/7030/?from=bflanding','img'=>'/upload/iblock/f72/f72b6d872bda3e46ed4ceea3247149f4.jpg','oldprice'=>'318','newprice'=>'190,8','discount'=>'40'),
array('name'=>'Муза не придет: Правда и мифы о том, как рождаются гениальные идеи','id'=>'8256','link'=>'/catalog/CreativityAndCreation/8256/?from=bflanding','img'=>'/upload/iblock/0b2/0b2e8e7501d378490c682cf052eacc5b.jpg','oldprice'=>'479','newprice'=>'287,4','discount'=>'40'),
array('name'=>'Обдуматый: Как освободиться от лишних мыслей и сфокусироваться на главном','id'=>'7825','link'=>'/catalog/PopularPsychologyPersonalEffectiveness/7825/?from=bflanding','img'=>'/upload/iblock/ff4/ff4022ede1c2b30601561e34cf8be929.jpg','oldprice'=>'399','newprice'=>'239,4','discount'=>'40'),
array('name'=>'101 идея для роста вашего бизнеса: Результаты новейших исследований эффективности людей и организаций','id'=>'8190','link'=>'/catalog/ProjectManagment/8190/?from=bflanding','img'=>'/upload/iblock/27a/27a602d65f41c83bba68911054735df6.jpg','oldprice'=>'479','newprice'=>'335,3','discount'=>'30'),
array('name'=>'FOREX: теория, психология, практика','id'=>'7659','link'=>'/catalog/InvestmentsStock/7659/?from=bflanding','img'=>'/upload/iblock/93e/93ece00970e23c4ba11f5fbf2af0d5df.gif','oldprice'=>'399','newprice'=>'239,4','discount'=>'40'),
array('name'=>'Как делать деньги на рынке Forex','id'=>'5669','link'=>'/catalog/InvestmentsStock/5669/?from=bflanding','img'=>'/upload/iblock/20d/20de5eef940d4669bd36ab9043115742.jpg','oldprice'=>'366','newprice'=>'219,6','discount'=>'40'),
array('name'=>'Как стать бизнесменом','id'=>'7006','link'=>'/catalog/SuccessStory/7006/?from=bflanding','img'=>'/upload/iblock/46a/46aa10a9ff20d1171b73fd8c466fe1d4.jpg','oldprice'=>'559','newprice'=>'391,3','discount'=>'30'),
array('name'=>'Forex Club: Win-win революция','id'=>'7988','link'=>'/catalog/InvestmentsStock/7988/?from=bflanding','img'=>'/upload/iblock/cf3/cf394f3f683c5d5542dcf2388437c152.jpg','oldprice'=>'196','newprice'=>'117,6','discount'=>'40'),
array('name'=>'На волне валютного тренда: Как предвидеть большие движения и использовать их в торговле на FOREX','id'=>'7787','link'=>'/catalog/InvestmentsStock/7787/?from=bflanding','img'=>'/upload/iblock/e1e/e1e9148b47d7157d1e35677126e9e3d3.jpg','oldprice'=>'688','newprice'=>'481,6','discount'=>'30'),
array('name'=>'Главная книга основателя бизнеса','id'=>'7932','link'=>'/catalog/StartupsInnovativeEntrepreneurship/7932/?from=bflanding','img'=>'/upload/iblock/765/765ebfd073076485ff8dc14d4a9f8c1b.jpg','oldprice'=>'725','newprice'=>'217,5','discount'=>'70'),
array('name'=>'Дао жизни: Мастер-класс от убежденного индивидуалиста','id'=>'6737','link'=>'/catalog/PopularPsychologyPersonalEffectiveness/6737/?from=bflanding','img'=>'/upload/iblock/5fe/5febbcbf648d7502172be81fafef1286.jpg','oldprice'=>'448','newprice'=>'358,4','discount'=>'20'),
array('name'=>'Ежедневник: Метод Глеба Архангельского (датированный, 2016)','id'=>'66444','link'=>'/catalog/TimeManagment/66444/?from=bflanding','img'=>'/upload/iblock/479/47904a160ae30c80289733909ded5956.jpg','oldprice'=>'799','newprice'=>'239,7','discount'=>'70'),
array('name'=>'Лучшая версия себя: Правила обретения счастья и смысла на работе и в жизни','id'=>'8572','link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8572/?from=bflanding','img'=>'/upload/iblock/af0/af059cc9288fd253127f6c3ddcb6a4b1.jpg','oldprice'=>'399','newprice'=>'279,3','discount'=>'30'),
array('name'=>'Свободен! Как вырваться из ментальной тюрьмы','id'=>'8702','link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8702/?from=bflanding','img'=>'/upload/iblock/d9a/d9afc74cdd0062c80b01f12916d9323c.jpg','oldprice'=>'399','newprice'=>'239,4','discount'=>'40'),
array('name'=>'Тайм-менеджмент по Брайану Трейси: Как заставить время работать на вас','id'=>'6313','link'=>'/catalog/PopularPsychologyPersonalEffectiveness/6313/?from=bflanding','img'=>'/upload/iblock/6a9/6a9a05bbb23ccfd4894ca368cbe5c6e7.jpg','oldprice'=>'399','newprice'=>'279,3','discount'=>'30'),
array('name'=>'Шаг за шагом к достижению цели: Метод кайдзен','id'=>'8137','link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8137/?from=bflanding','img'=>'/upload/iblock/bc4/bc40d7b07ed413fc419431bba8eed8ef.jpg','oldprice'=>'399','newprice'=>'319,2','discount'=>'20'),
array('name'=>'Идеальный порядок за 8 минут: Легкие решения для упрощения жизни и высвобождения времени','id'=>'7657','link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/7657/?from=bflanding','img'=>'/upload/iblock/18b/18b647a2f4032c1271e1a87206623ac5.jpg','oldprice'=>'399','newprice'=>'239,4','discount'=>'40'),
array('name'=>'Добейся максимума: Сильные стороны сотрудников на службе бизнеса (с кодом для теста)','id'=>'6625','link'=>'/catalog/HR/6625/?from=bflanding','img'=>'/upload/iblock/24c/24c235b0d9e532c224ec8da035850d6b.jpg','oldprice'=>'1290','newprice'=>'1161','discount'=>'10'),
array('name'=>'Как разговаривать с кем угодно, когда угодно и где угодно','id'=>'7032','link'=>'/catalog/NegotiationsBusinessCommunication/7032/?from=bflanding','img'=>'/upload/iblock/eae/eae99ea882677e685039b6ae467451dc.jpg','oldprice'=>'448','newprice'=>'403,2','discount'=>'10'),
array('name'=>'Как я создал Wal-Mart','id'=>'6269','link'=>'/catalog/SuccessStory/6269/?from=bflanding','img'=>'/upload/iblock/ad4/ad43ae1293ddb5239530b48f08c90488.jpg','oldprice'=>'479','newprice'=>'287,4','discount'=>'40'),
array('name'=>'Лидерство Мацуситы: Уроки выдающегося предпринимателя ХХ века','id'=>'5587','link'=>'/catalog/SuccessStory/5587/?from=bflanding','img'=>'/upload/iblock/c3f/c3fcafab5a3f60efdbc81791869f8c77.jpg','oldprice'=>'479','newprice'=>'287,4','discount'=>'40'),
array('name'=>'Личная эффективность на 100%: Сбросить балласт, найти себя, достичь цели','id'=>'7190','link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/7190/?from=bflanding','img'=>'/upload/iblock/5f5/5f5420a4b0a2cba3c3583017e618dacf.jpg','oldprice'=>'399','newprice'=>'319,2','discount'=>'20'),
array('name'=>'Маркетинг от А до Я: 80 концепций, которые должен знать каждый менеджер','id'=>'6385','link'=>'/catalog/Marketing/6385/?from=bflanding','img'=>'/upload/iblock/96e/96efd0e52910728cf72c61741730c7fc.jpg','oldprice'=>'448','newprice'=>'358,4','discount'=>'20'),
array('name'=>'Меньше, но лучше: Работать надо не 12 часов, а головой','id'=>'7575','link'=>'/catalog/TimeManagment/7575/?from=bflanding','img'=>'/upload/iblock/b41/b41019ae5b503d1dfd97267201793feb.jpg','oldprice'=>'479','newprice'=>'383,2','discount'=>'20'),
array('name'=>'111 тренировок в месяц: Как найти и удержать клиента ','id'=>'6627','link'=>'/catalog/Sales/6627/?from=bflanding','img'=>'/upload/iblock/8ac/8acd1c2619f45ffccbaaa7529a525733.jpg','oldprice'=>'489','newprice'=>'342,3','discount'=>'30'),
array('name'=>'50 советов по нематериальной мотивации','id'=>'7475','link'=>'/catalog/HR/7475/?from=bflanding','img'=>'/upload/iblock/d27/d27f53266c137551f53bd49951a51e55.jpg','oldprice'=>'399','newprice'=>'199,5','discount'=>'50'),
array('name'=>'50 советов по рекрутингу','id'=>'7365','link'=>'/catalog/HR/7365/?from=bflanding','img'=>'/upload/iblock/c8e/c8ec1718ce896208b1b79331b6db1331.jpg','oldprice'=>'479','newprice'=>'239,5','discount'=>'50'),
array('name'=>'8 принципов здоровья: Как увеличить жизненную энергию','id'=>'6355','link'=>'/catalog/HealthAndHealthyFood/6355/?from=bflanding','img'=>'/upload/iblock/795/7952cdd5ef13be64737841180b5d162f.jpg','oldprice'=>'366','newprice'=>'256,2','discount'=>'30'),
array('name'=>'MBA в кармане: Практическое руководство по развитию ключевых навыков управления','id'=>'7018','link'=>'/catalog/GeneralManagment/7018/?from=bflanding','img'=>'/upload/iblock/c1f/c1f695e48a7d2a0336ae1eb2615ae5a8.jpg','oldprice'=>'479','newprice'=>'239,5','discount'=>'50'),
array('name'=>'Sales-детонатор: Как добиться взрывного роста продаж','id'=>'8214','link'=>'/catalog/Sales/8214/?from=bflanding','img'=>'/upload/iblock/6ad/6adf14e628345f4a67aca2bf54a9deaf.jpg','oldprice'=>'399','newprice'=>'199,5','discount'=>'50'),
array('name'=>'Антистресс для занятых людей: Медитативная раскраска (карманный формат)','id'=>'8434','link'=>'/catalog/CreativityAndCreation/8434/?from=bflanding','img'=>'/upload/iblock/6e8/6e89f1a61746550e86ec164cc6959b75.jpg','oldprice'=>'318','newprice'=>'159','discount'=>'50'),
array('name'=>'Бахтале-зурале! Цыгане, которых мы не знаем','id'=>'7851','link'=>'/catalog/PublicismDocumentaryProse/7851/?from=bflanding','img'=>'/upload/iblock/114/114c094cc2eb67e4282530cf7e3a37a1.jpg','oldprice'=>'269','newprice'=>'80,7','discount'=>'70'),
array('name'=>'Бесплатная реклама: результат без бюджета','id'=>'6551','link'=>'/catalog/Marketing/6551/?from=bflanding','img'=>'/upload/iblock/cca/cca579ceed47c88b20c0e7ed4a7c7bff.jpg','oldprice'=>'399','newprice'=>'279,3','discount'=>'30'),
array('name'=>'Бизнес на автопилоте: Как собственнику отойти от дел и не потерять свой бизнес','id'=>'7587','link'=>'/catalog/GeneralManagment/7587/?from=bflanding','img'=>'/upload/iblock/0c7/0c7f1107f22e5bb71a0a88e7d9fa1b6b.jpg','oldprice'=>'448','newprice'=>'224','discount'=>'50'),
array('name'=>'Большое сафари','id'=>'8638','link'=>'/catalog/KnigiDlyaDetei/8638/?from=bflanding','img'=>'/upload/iblock/185/185b20b269a151a3903dc16654ebd75b.jpg','oldprice'=>'239','newprice'=>'119,5','discount'=>'50'),
array('name'=>'Быть бизнес-лидером: 16 историй успеха','id'=>'8204','link'=>'/catalog/SuccessStory/8204/?from=bflanding','img'=>'/upload/iblock/05f/05f4ee79aa914ba3720c9847fd05397b.jpg','oldprice'=>'399','newprice'=>'279,3','discount'=>'30'),
array('name'=>'Валютный трейдинг и межрыночный анализ: Как зарабатывать на изменениях глобальных рынков','id'=>'7679','link'=>'/catalog/InvestmentsStock/7679/?from=bflanding','img'=>'/upload/iblock/c44/c4463ba430e1f5f56f9b3f1933c77afd.jpg','oldprice'=>'719','newprice'=>'431,4','discount'=>'40'),
array('name'=>'Вечер веселых танцев','id'=>'8636','link'=>'/catalog/KnigiDlyaDetei/8636/?from=bflanding','img'=>'/upload/iblock/326/326ddd9d7b7ac62bd8a9ed1fac9d0f74.jpg','oldprice'=>'239','newprice'=>'119,5','discount'=>'50'),
array('name'=>'Воспоминания (карманный формат)','id'=>'8582','link'=>'/catalog/BiographiesAndMemoirs/8582/?from=bflanding','img'=>'/upload/iblock/b85/b85c00e2dd41793a3ac63494049f9325.jpg','oldprice'=>'318','newprice'=>'159','discount'=>'50'),
array('name'=>'Все отлично! Пять элементов благополучия','id'=>'8550','link'=>'/catalog/PopularPsychologyPersonalEffectiveness/8550/?from=bflanding','img'=>'/upload/iblock/188/188f9a439e2f3e1e9a477c872b29c11b.jpg','oldprice'=>'399','newprice'=>'239,4','discount'=>'40'),
array('name'=>'Гни свою линию: Приемы эффективной коммуникации','id'=>'5769','link'=>'/catalog/NegotiationsBusinessCommunication/5769/?from=bflanding','img'=>'/upload/iblock/708/708f539435c5a98d176eeec5574d3953.jpg','oldprice'=>'318','newprice'=>'159','discount'=>'50'),
array('name'=>'Групповой портрет на фоне мира','id'=>'66427','link'=>'/catalog/Gifts/66427/?from=bflanding','img'=>'/upload/iblock/416/416c2105cb92566b8b0a9cd6878006a9.jpg','oldprice'=>'4269','newprice'=>'2561,4','discount'=>'40'),
array('name'=>'Давид и Голиаф: Как аутсайдеры побеждают фаворитов (покетбук)','id'=>'8032','link'=>'/catalog/PopularPsychologyPersonalEffectiveness/8032/?from=bflanding','img'=>'/upload/iblock/95f/95feb32f5804da4eb6dbc28155db4357.jpg','oldprice'=>'318','newprice'=>'190,8','discount'=>'40'),
array('name'=>'Дары несовершенства: Как полюбить себя таким, какой ты есть','id'=>'7944','link'=>'/catalog/PopularPsychologyPersonalEffectiveness/7944/?from=bflanding','img'=>'/upload/iblock/5db/5dbe4c002a9b725a7e9f6e220193a9a2.jpg','oldprice'=>'318','newprice'=>'190,8','discount'=>'40'),
array('name'=>'Двенадцать минут любви','id'=>'7837','link'=>'/catalog/Fiction/7837/?from=bflanding','img'=>'/upload/iblock/bdf/bdfae3853825510de4bbee9716bb6eff.jpg','oldprice'=>'366','newprice'=>'183','discount'=>'50'),
array('name'=>'Двуглавая Россия: История в картинках','id'=>'7954','link'=>'/catalog/Gifts/7954/?from=bflanding','img'=>'/upload/iblock/a4c/a4c652dc8fc3358bc8d0329044b60f7a.jpg','oldprice'=>'639','newprice'=>'319,5','discount'=>'50'),
array('name'=>'Двухшаговые продажи: Практические рекомендации','id'=>'8342','link'=>'/catalog/Sales/8342/?from=bflanding','img'=>'/upload/iblock/065/0650a925343a7fa64d73fd62fe227fca.jpg','oldprice'=>'399','newprice'=>'279,3','discount'=>'30'),
array('name'=>'Дело не в кофе: корпоративная культура Starbucks','id'=>'5893','link'=>'/catalog/HR/5893/?from=bflanding','img'=>'/upload/iblock/6d1/6d161f6914cf6434355ed5352b98b184.jpg','oldprice'=>'399','newprice'=>'279,3','discount'=>'30'),
array('name'=>'Десять смертных грехов маркетинга','id'=>'6485','link'=>'/catalog/Marketing/6485/?from=bflanding','img'=>'/upload/iblock/ef8/ef8a32239be8e9cc798a0f303e847763.jpg','oldprice'=>'399','newprice'=>'319,2','discount'=>'20'),
array('name'=>'Детская мода Российской империи','id'=>'7720','link'=>'/catalog/BeautyAndHistoryOfFashion/7720/?from=bflanding','img'=>'/upload/iblock/69a/69afe278b755c895a761f42f485aaedd.jpg','oldprice'=>'2239','newprice'=>'1343,4','discount'=>'40'),
array('name'=>'Дикая природа: Медитативная раскраска для взрослых','id'=>'60927','link'=>'/catalog/CreativityAndCreation/60927/?from=bflanding','img'=>'/upload/iblock/429/429ecbf42eb2d123c1736225561196ae.jpg','oldprice'=>'360','newprice'=>'252','discount'=>'30'),
array('name'=>'Дневник сетевика: Советы моего спонсора о том, как построить прибыльный и стабильно растущий сетевой бизнес','id'=>'6405','link'=>'/catalog/Marketing/6405/?from=bflanding','img'=>'/upload/iblock/13a/13a0e9ee3a9a2da51e236a94b4792564.jpg','oldprice'=>'725','newprice'=>'507,5','discount'=>'30'),
array('name'=>'Доброе слово и револьвер менеджера','id'=>'8602','link'=>'/catalog/GeneralManagment/8602/?from=bflanding','img'=>'/upload/iblock/be2/be2802b9023a4583c466127da66dd844.jpg','oldprice'=>'399','newprice'=>'199,5','discount'=>'50'),
array('name'=>'Заложник: История менеджера ЮКОСа','id'=>'7849','link'=>'/catalog/Policy/7849/?from=bflanding','img'=>'/upload/iblock/4e6/4e64096d8d66dfcff4934a4d0ac7d2a6.jpg','oldprice'=>'399','newprice'=>'119,7','discount'=>'70'),
array('name'=>'Записки мужиковеда: Что каждый мужчина должен знать о своем здоровье и каждая женщина — о мужчине','id'=>'8079','link'=>'/catalog/HealthAndHealthyFood/8079/?from=bflanding','img'=>'/upload/iblock/f60/f60363183bc59dd84ef4b926359e7fc2.jpg','oldprice'=>'318','newprice'=>'95,4','discount'=>'70'),
array('name'=>'Защита активов и страхование: Что предлагает Швейцария ','id'=>'6829','link'=>'/catalog/InvestmentsStock/6829/?from=bflanding','img'=>'/upload/iblock/cb8/cb8e0a9e3ab30e80d6fe5c1e28410c9c.jpg','oldprice'=>'1049','newprice'=>'734,3','discount'=>'30'),
array('name'=>'Злючка-колючка','id'=>'8640','link'=>'/catalog/KnigiDlyaDetei/8640/?from=bflanding','img'=>'/upload/iblock/39a/39aa6b5289af9922ed0c9206d2ff10c9.jpg','oldprice'=>'239','newprice'=>'119,5','discount'=>'50'),
array('name'=>'И сотворил Бог нефть','id'=>'8556','link'=>'/catalog/Fiction/8556/?from=bflanding','img'=>'/upload/iblock/0fa/0fa9d104574a3d7965fd08a14e2d8b63.jpg','oldprice'=>'318','newprice'=>'222,6','discount'=>'30'),
array('name'=>'Империя приложений: Как создавать приложения-хиты','id'=>'7767','link'=>'/catalog/StartupsInnovativeEntrepreneurship/7767/?from=bflanding','img'=>'/upload/iblock/f9b/f9bb7294a9e9bafca0e548a2b780ae4f.jpg','oldprice'=>'479','newprice'=>'143,7','discount'=>'70'),
array('name'=>'Информация и общественное мнение: От репортажа в СМИ к реальным переменам','id'=>'6605','link'=>'/catalog/Marketing/6605/?from=bflanding','img'=>'/upload/iblock/695/695f672ac897d966d5fc62edc895ae93.jpg','oldprice'=>'725','newprice'=>'290','discount'=>'60'),
array('name'=>'Искусство возможности: Как сыграть свою лучшую партию в карь­ере и жизни','id'=>'7525','link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/7525/?from=bflanding','img'=>'/upload/iblock/5c7/5c7dcd0195620023533998680dcf0ca5.jpg','oldprice'=>'399','newprice'=>'279,3','discount'=>'30'),
array('name'=>'Искусство думать: Латеральное мышление как способ решения сложных задач','id'=>'8382','link'=>'/catalog/CreativityAndCreation/8382/?from=bflanding','img'=>'/upload/iblock/68a/68aa1e58990a9ce8a7369cf3da36de48.jpg','oldprice'=>'399','newprice'=>'279,3','discount'=>'30'),
array('name'=>'Искусство жить просто: Как избавиться от лишнего и обогатить свою жизнь','id'=>'8013','link'=>'/catalog/PopularPsychologyPersonalEffectiveness/8013/?from=bflanding','img'=>'/upload/iblock/770/7704df1784a01e5e95b5d25b9f26ee84.jpg','oldprice'=>'479','newprice'=>'431,1','discount'=>'10'),
array('name'=>'Искусство подбора персонала: Как оценить человека за час (Альбомная версия)','id'=>'66452','link'=>'/catalog/HR/66452/?from=bflanding','img'=>'/upload/iblock/758/7580d36d8eec239fdc7d8dea77fa6e45.jpg','oldprice'=>'639','newprice'=>'447,3','discount'=>'30'),
array('name'=>'Искусство слияний и поглощений','id'=>'6273','link'=>'/catalog/InvestmentsStock/6273/?from=bflanding','img'=>'/upload/iblock/2a7/2a73fbbd4a1a7aec2eef43f9fa5cb7db.jpg','oldprice'=>'2279','newprice'=>'1139,5','discount'=>'50'),
array('name'=>'Искусство словесной атаки: Практическое руководство','id'=>'5841','link'=>'/catalog/NegotiationsBusinessCommunication/5841/?from=bflanding','img'=>'/upload/iblock/e16/e167ca7108613f63a2395d56e16e7b66.jpg','oldprice'=>'318','newprice'=>'190,8','discount'=>'40'),
array('name'=>'Истоки морали: В поисках человеческого у приматов','id'=>'7946','link'=>'/catalog/PopularScience/7946/?from=bflanding','img'=>'/upload/iblock/070/0708a559964774cc1dac65b8f6488452.jpg','oldprice'=>'479','newprice'=>'335,3','discount'=>'30'),
array('name'=>'История Земли: От звездной пыли — к живой планете: Первые 4 500 000 000 лет','id'=>'8292','link'=>'/catalog/PopularScience/8292/?from=bflanding','img'=>'/upload/iblock/5e5/5e5e609f31c62c506b7e81d4ffcbbe0c.jpg','oldprice'=>'448','newprice'=>'403,2','discount'=>'10'),
array('name'=>'Как привлечь зарубежные инвестиции','id'=>'6747','link'=>'/catalog/InvestmentsStock/6747/?from=bflanding','img'=>'/upload/iblock/ed4/ed44d54916e5ad8196b3b73e4051d087.jpg','oldprice'=>'318','newprice'=>'222,6','discount'=>'30'),
array('name'=>'Как придумать идею, если вы не Огилви','id'=>'8314','link'=>'/catalog/CreativityAndCreation/8314/?from=bflanding','img'=>'/upload/iblock/478/4786d728a739442457e2feba2d00bcee.jpg','oldprice'=>'399','newprice'=>'359,1','discount'=>'10'),
array('name'=>'Как стать генеральным директором: Правила восхождения к вершинам власти в любой организации','id'=>'6537','link'=>'/catalog/GeneralManagment/6537/?from=bflanding','img'=>'/upload/iblock/bd6/bd671e15425a45a7ce230dd489348f2d.jpg','oldprice'=>'399','newprice'=>'279,3','discount'=>'30'),
array('name'=>'Как стать первым на YouTube: Секреты взрывной раскрутки','id'=>'7726','link'=>'/catalog/Marketing/7726/?from=bflanding','img'=>'/upload/iblock/457/4573de279350375b7fb65552b0174506.jpg','oldprice'=>'559','newprice'=>'503,1','discount'=>'10'),
array('name'=>'Как стать суперзвездой маркетинга: Необычные правила, благодаря которым победно зазвенит ваш кассовый аппарат','id'=>'6541','link'=>'/catalog/Marketing/6541/?from=bflanding','img'=>'/upload/iblock/c94/c949ca189fd15c75b9abfc81d897d9c6.jpg','oldprice'=>'399','newprice'=>'279,3','discount'=>'30'),
array('name'=>'Как убедить, что ты прав','id'=>'7750','link'=>'/catalog/NegotiationsBusinessCommunication/7750/?from=bflanding','img'=>'/upload/iblock/793/793f33583ef8623ff451686ce1b6861e.jpg','oldprice'=>'479','newprice'=>'287,4','discount'=>'40'),
array('name'=>'Капитализм по-китайски: Государство и бизнес','id'=>'6743','link'=>'/catalog/Economics/6743/?from=bflanding','img'=>'/upload/iblock/b21/b21ab9dea294c54cb4fb08aebde5bfb6.jpg','oldprice'=>'639','newprice'=>'383,4','discount'=>'40'),
array('name'=>'Клуб «Криптоамнезия»','id'=>'7694','link'=>'/catalog/Fiction/7694/?from=bflanding','img'=>'/upload/iblock/2cf/2cf65feef33514796685f26033157d08.jpg','oldprice'=>'269','newprice'=>'107,6','discount'=>'60'),
array('name'=>'Код Горыныча: Что можно узнать о русском народе из сказок','id'=>'6849','link'=>'/catalog/HobbyTravelingCars/6849/?from=bflanding','img'=>'/upload/iblock/e6b/e6b596d92b1ed39ebeaaeb538da5b4a4.jpg','oldprice'=>'318','newprice'=>'127,2','discount'=>'60'),
array('name'=>'Команда чемпионов продаж: Как создать идеальный отдел продаж и эффективно им управлять','id'=>'7970','link'=>'/catalog/Sales/7970/?from=bflanding','img'=>'/upload/iblock/6d5/6d57fb7a0bbee02ddef800d37dde0906.jpg','oldprice'=>'399','newprice'=>'239,4','discount'=>'40'),
array('name'=>'Командный подход: Создание высокоэффективной организации','id'=>'7877','link'=>'/catalog/HR/7877/?from=bflanding','img'=>'/upload/iblock/94e/94ef92c73a333ee77b43430c65f23528.jpg','oldprice'=>'479','newprice'=>'287,4','discount'=>'40'),
array('name'=>'Консерватизм и развитие: Основы общественного согласия','id'=>'8826','link'=>'/catalog/Policy/8826/?from=bflanding','img'=>'/upload/iblock/a51/a5170d6e720c05657485cb7d0aa4dcd4.jpg','oldprice'=>'799','newprice'=>'479,4','discount'=>'40'),
array('name'=>'Корпоративный тайм-менеджмент: Энциклопедия решений','id'=>'7373','link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/7373/?from=bflanding','img'=>'/upload/iblock/568/56819bf5d6c911df350f1e369b22474e.jpg','oldprice'=>'559','newprice'=>'335,4','discount'=>'40'),
array('name'=>'Кости, скалы и звезды: Наука о том, когда что произошло','id'=>'6777','link'=>'/catalog/PopularScience/6777/?from=bflanding','img'=>'/upload/iblock/786/786120d064c04b4e664a6b730c334d63.jpg','oldprice'=>'366','newprice'=>'146,4','discount'=>'60'),
array('name'=>'Краудсорсинг: Коллективный разум как инструмент развития бизнеса','id'=>'7286','link'=>'/catalog/StartupsInnovativeEntrepreneurship/7286/?from=bflanding','img'=>'/upload/iblock/a6a/a6a08e14f67085c129a8694dfb2bdf69.jpg','oldprice'=>'559','newprice'=>'335,4','discount'=>'40'),
array('name'=>'Крах Титанов: История о жадности и гордыне, о крушении Merrill Lynch','id'=>'7491','link'=>'/catalog/SuccessStory/7491/?from=bflanding','img'=>'/upload/iblock/1ed/1ed79bb95a7e0e5090991f18ba2a1350.jpg','oldprice'=>'599','newprice'=>'359,4','discount'=>'40'),
array('name'=>'Крылья мечты: Медитативная раскраска для взрослых','id'=>'8598','link'=>'/catalog/CreativityAndCreation/8598/?from=bflanding','img'=>'/upload/iblock/3f6/3f6af94a955274115868969e91f789b0.jpg','oldprice'=>'399','newprice'=>'239,4','discount'=>'40'),
array('name'=>'Культурный код: Как мы живем, что покупаем и почему','id'=>'5787','link'=>'/catalog/Marketing/5787/?from=bflanding','img'=>'/upload/iblock/48b/48b25d6b4d76105e6d7a7a87973c8340.jpg','oldprice'=>'479','newprice'=>'383,2','discount'=>'20'),
array('name'=>'Леди Ю','id'=>'7821','link'=>'/catalog/BiographiesAndMemoirs/7821/?from=bflanding','img'=>'/upload/iblock/dd4/dd42ee7a37248c47c36a4c9817c06a8d.jpg','oldprice'=>'399','newprice'=>'119,7','discount'=>'70'),
array('name'=>'Матрица перемен: Как повысить эффективность изменений в компании','id'=>'7942','link'=>'/catalog/GeneralManagment/7942/?from=bflanding','img'=>'/upload/iblock/5a0/5a0674a5478f25ee294faa5d74dd9aa6.jpg','oldprice'=>'366','newprice'=>'219,6','discount'=>'40'),
array('name'=>'Мегапроекты и риски: Анатомия амбиций','id'=>'8103','link'=>'/catalog/ProjectManagment/8103/?from=bflanding','img'=>'/upload/iblock/2e8/2e805710db2e1e14a2dced5abe19b764.jpg','oldprice'=>'479','newprice'=>'239,5','discount'=>'50'),
array('name'=>'Между «можно» и «нельзя»: Как установить границы для ребенка (карманный формат)','id'=>'8530','link'=>'/catalog/BooksForParents/8530/?from=bflanding','img'=>'/upload/iblock/08c/08ca547c6f446ba420c83fe698eee61f.jpg','oldprice'=>'318','newprice'=>'254,4','discount'=>'20'),
array('name'=>'Менеджмент систем: Как начать путь Toyota','id'=>'7432','link'=>'/catalog/LeanManufacturingQualityManagement/7432/?from=bflanding','img'=>'/upload/iblock/d2a/d2afa3703aeedc573024dbcdb25b6e3c.jpg','oldprice'=>'559','newprice'=>'391,3','discount'=>'30'),
array('name'=>'Миллиардеры поневоле: Альтернативная история создания FACEBOOK','id'=>'6745','link'=>'/catalog/SuccessStory/6745/?from=bflanding','img'=>'/upload/iblock/9bd/9bdea2c89c4834942d3ee964cb43c4b8.jpg','oldprice'=>'335','newprice'=>'167,5','discount'=>'50'),
array('name'=>'Мир 3.0: Глобальная интеграция без барьеров','id'=>'7775','link'=>'/catalog/Economics/7775/?from=bflanding','img'=>'/upload/iblock/266/266ec7ece238e8a5586d4f61a11aaa63.jpg','oldprice'=>'729','newprice'=>'437,4','discount'=>'40'),
array('name'=>'Мифы об эволюции человека','id'=>'8454','link'=>'/catalog/PopularScience/8454/?from=bflanding','img'=>'/upload/iblock/243/243083c9f4b677a500517935643fe6f0.jpg','oldprice'=>'448','newprice'=>'403,2','discount'=>'10'),
array('name'=>'Мобильный маркетинг: Как зарядить свой бизнес в мобильном мире','id'=>'7487','link'=>'/catalog/Marketing/7487/?from=bflanding','img'=>'/upload/iblock/125/1259f8fb9622c48f25e4d1474c415c57.jpg','oldprice'=>'479','newprice'=>'287,4','discount'=>'40'),
array('name'=>'Мужская лаборатория Джеймса Мэя: Книга о полезных вещах','id'=>'7746','link'=>'/catalog/CreativityAndCreation/7746/?from=bflanding','img'=>'/upload/iblock/f67/f67293d937ff9fa9889c12bb6e1a1326.jpg','oldprice'=>'399','newprice'=>'239,4','discount'=>'40'),
array('name'=>'Навигатор сделки: Практика стратегических продаж от А до... А','id'=>'7968','link'=>'/catalog/Sales/7968/?from=bflanding','img'=>'/upload/iblock/1e9/1e93aa0204a92f7780722cef925f2145.jpg','oldprice'=>'399','newprice'=>'239,4','discount'=>'40'),
array('name'=>'Навыки ребенка в действии: Как помочь детям преодолеть психологические проблемы','id'=>'7643','link'=>'/catalog/BooksForParents/7643/?from=bflanding','img'=>'/upload/iblock/dd1/dd112b8b4c6cb26f22213635e5037af5.jpg','oldprice'=>'269','newprice'=>'188,3','discount'=>'30'),
array('name'=>'Наследство в России: Игра по правилам и без','id'=>'8330','link'=>'/catalog/Law/8330/?from=bflanding','img'=>'/upload/iblock/4a8/4a81c758c390d4c3c64f7f0d3d4c86c5.jpg','oldprice'=>'639','newprice'=>'255,6','discount'=>'60'),
array('name'=>'Настольная книга вожатого','id'=>'8506','link'=>'/catalog/BooksForParents/8506/?from=bflanding','img'=>'/upload/iblock/175/175dad926de2175ba5fc621585f4df81.jpg','oldprice'=>'285','newprice'=>'199,5','discount'=>'30'),
array('name'=>'Не торопитесь посылать резюме: Нетрадиционные советы тем, кто хочет найти работу своей мечты','id'=>'6267','link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/6267/?from=bflanding','img'=>'/upload/iblock/c46/c460c229f8b32c74c788338acc427510.jpg','oldprice'=>'399','newprice'=>'319,2','discount'=>'20'),
array('name'=>'Неслучайные связи: Нетворкинг как образ жизни','id'=>'8161','link'=>'/catalog/NegotiationsBusinessCommunication/8161/?from=bflanding','img'=>'/upload/iblock/db1/db1fbe4fb244db1c122b443bdc980ae6.jpg','oldprice'=>'399','newprice'=>'199,5','discount'=>'50'),
array('name'=>'Никола Тесла: Наследие великого изобретателя','id'=>'7343','link'=>'/catalog/BiographiesAndMemoirs/7343/?from=bflanding','img'=>'/upload/iblock/f6e/f6e06725a4051efedc2b43b1ac497208.jpg','oldprice'=>'399','newprice'=>'239,4','discount'=>'40'),
array('name'=>'Операции с производными финансовыми инструментами: Учет, налоги, правовое регулирование','id'=>'7736','link'=>'/catalog/InvestmentsStock/7736/?from=bflanding','img'=>'/upload/iblock/f8a/f8a7ab92793bf806b73997a8df119293.jpg','oldprice'=>'659','newprice'=>'329,5','discount'=>'50'),
array('name'=>'Организация работы совета директоров: Практические рекомендации','id'=>'8224','link'=>'/catalog/GeneralManagment/8224/?from=bflanding','img'=>'/upload/iblock/770/770f213371df92d8917767222e0b0f02.jpg','oldprice'=>'479','newprice'=>'287,4','discount'=>'40'),
array('name'=>'Отличная компания: Как стать работодателем мечты','id'=>'7813','link'=>'/catalog/HR/7813/?from=bflanding','img'=>'/upload/iblock/7d7/7d7af1a5be8b2bf7dab87f7d1f67efd5.jpg','oldprice'=>'479','newprice'=>'287,4','discount'=>'40'),
array('name'=>'Партизанские продажи: Как увести клиента у конкурентов','id'=>'7683','link'=>'/catalog/Sales/7683/?from=bflanding','img'=>'/upload/iblock/c84/c8401f1f0c9e7fada9937fba7de1ac52.jpg','oldprice'=>'399','newprice'=>'239,4','discount'=>'40'),
array('name'=>'Переговоры каждый день: Как добиваться своего в любой ситуации','id'=>'7783','link'=>'/catalog/NegotiationsBusinessCommunication/7783/?from=bflanding','img'=>'/upload/iblock/564/56439a88ded864ef6a5aa7d64fd4f805.jpg','oldprice'=>'559','newprice'=>'447,2','discount'=>'20'),
array('name'=>'Переломный момент: Как незначительные изменения приводят к глобальным переменам','id'=>'8392','link'=>'/catalog/PopularPsychologyPersonalEffectiveness/8392/?from=bflanding','img'=>'/upload/iblock/b71/b717595dfb9ffcde566b090fb9b5c996.jpg','oldprice'=>'399','newprice'=>'279,3','discount'=>'30'),
array('name'=>'Пленники собственных мыслей: Смысл жизни и работы по Виктору Франклу','id'=>'6009','link'=>'/catalog/PopularPsychologyPersonalEffectiveness/6009/?from=bflanding','img'=>'/upload/iblock/3c8/3c8b3f0651d7e432f05a99a30e9c80a1.jpg','oldprice'=>'366','newprice'=>'219,6','discount'=>'40'),
array('name'=>'Победить с помощью инноваций : Практическое руководство по изменению и обновлению организации','id'=>'8163','link'=>'/catalog/StartupsInnovativeEntrepreneurship/8163/?from=bflanding','img'=>'/upload/iblock/952/952a76dabca2dd82bde3636258fe27d1.jpg','oldprice'=>'479','newprice'=>'239,5','discount'=>'50'),
array('name'=>'Политически значимые лица: Руководство для банков по предотвращению финансовых злоупотреблений','id'=>'7073','link'=>'/catalog/FinanceBanks/7073/?from=bflanding','img'=>'/upload/iblock/e1b/e1b4631ba05d224c865d1988e62d1e27.jpg','oldprice'=>'725','newprice'=>'290','discount'=>'60'),
array('name'=>'Популярно о микробиологии','id'=>'7481','link'=>'/catalog/PopularScience/7481/?from=bflanding','img'=>'/upload/iblock/200/2000a0aece676013dbcc75db3aef0de1.jpg','oldprice'=>'318','newprice'=>'190,8','discount'=>'40'),
array('name'=>'Пора в горы!','id'=>'8642','link'=>'/catalog/KnigiDlyaDetei/8642/?from=bflanding','img'=>'/upload/iblock/57a/57aef2b7442df205561a5dcbb9998bd1.jpg','oldprice'=>'239','newprice'=>'119,5','discount'=>'50'),
array('name'=>'Портфель проектов: Инструмент стратегического управления предприятием','id'=>'7716','link'=>'/catalog/CorporateGovernance/7716/?from=bflanding','img'=>'/upload/iblock/26a/26a9faeb0c30743af01ce12ccf23173f.jpg','oldprice'=>'456','newprice'=>'273,6','discount'=>'40'),
array('name'=>'После меня - продолжение...','id'=>'8746','link'=>'/catalog/SuccessStory/8746/?from=bflanding','img'=>'/upload/iblock/387/387133cd0b1ae6d1b881bf305fea4723.jpg','oldprice'=>'1099','newprice'=>'769,3','discount'=>'30'),
array('name'=>'Почему мы такие? 16 типов личности, определяющих, как мы живем, работаем и любим','id'=>'7855','link'=>'/catalog/PopularPsychologyPersonalEffectiveness/7855/?from=bflanding','img'=>'/upload/iblock/bf3/bf3ccf4ad72144ec9276faca2855d2c0.jpg','oldprice'=>'479','newprice'=>'383,2','discount'=>'20'),
array('name'=>'Правила аквастопа','id'=>'7061','link'=>'/catalog/Fiction/7061/?from=bflanding','img'=>'/upload/iblock/b32/b32538c9f44f3e4b3e78a75fcf61aecc.jpg','oldprice'=>'318','newprice'=>'190,8','discount'=>'40'),
array('name'=>'Правила карьеры: Все, что нужно для служебного роста','id'=>'6159','link'=>'/catalog/PopularPsychologyPersonalEffectiveness/6159/?from=bflanding','img'=>'/upload/iblock/a29/a29a16238af0ebfec1f6e524c8369586.jpg','oldprice'=>'399','newprice'=>'279,3','discount'=>'30'),
array('name'=>'Правила любви','id'=>'6307','link'=>'/catalog/PopularPsychologyPersonalEffectiveness/6307/?from=bflanding','img'=>'/upload/iblock/9a5/9a54cef90d970b87fd0cef3103c76630.jpg','oldprice'=>'399','newprice'=>'199,5','discount'=>'50'),
array('name'=>'Правила общения с детьми: 12 «нельзя», 12 «можно», 12 «надо»','id'=>'8654','link'=>'/catalog/BooksForParents/8654/?from=bflanding','img'=>'/upload/iblock/34a/34a98d4c122c1e495fde5a8870ed8496.jpg','oldprice'=>'299','newprice'=>'239,2','discount'=>'20'),
array('name'=>'Правила самоорганизации: Как все успевать, не напрягаясь','id'=>'6793','link'=>'/catalog/PopularPsychologyPersonalEffectiveness/6793/?from=bflanding','img'=>'/upload/iblock/6e5/6e52e91fcd6dd29e41a63b26e543ed02.jpg','oldprice'=>'366','newprice'=>'183','discount'=>'50'),
array('name'=>'Правила, которые стоит нарушать','id'=>'8075','link'=>'/catalog/PopularPsychologyPersonalEffectiveness/8075/?from=bflanding','img'=>'/upload/iblock/6d6/6d6b378f43f12811ab85cbe2e2a0ff3a.jpg','oldprice'=>'399','newprice'=>'239,4','discount'=>'40'),
array('name'=>'Работа мировых рынков: Управление финансовой инфраструктурой','id'=>'8516','link'=>'/catalog/InvestmentsStock/8516/?from=bflanding','img'=>'/upload/iblock/b1b/b1bac144125ee29a9c666052e29b7f53.jpg','oldprice'=>'1049','newprice'=>'629,4','discount'=>'40'),
array('name'=>'Преимущество сетей: Как извлечь максимальную пользу из альянсов и партнерских отношений','id'=>'8133','link'=>'/catalog/ProjectManagment/8133/?from=bflanding','img'=>'/upload/iblock/704/70474e0d3e8dd00e4683cb80e0b5b0f2.jpg','oldprice'=>'549','newprice'=>'274,5','discount'=>'50'),
array('name'=>'Продажа товаров и услуг по методу бережливого производства','id'=>'8004','link'=>'/catalog/Sales/8004/?from=bflanding','img'=>'/upload/iblock/46f/46f38115a18a19001ca13d65229dc8df.jpg','oldprice'=>'799','newprice'=>'559,3','discount'=>'30'),
array('name'=>'Прыг да скок, черничный пирог!','id'=>'8632','link'=>'/catalog/KnigiDlyaDetei/8632/?from=bflanding','img'=>'/upload/iblock/886/886e8f870224d91fa1f09377a1e5b10c.jpg','oldprice'=>'239','newprice'=>'119,5','discount'=>'50'),
array('name'=>'Разбитые окна, разбитый бизнес: Как мельчайшие детали влияют на большие достижения','id'=>'8456','link'=>'/catalog/GeneralManagment/8456/?from=bflanding','img'=>'/upload/iblock/8b7/8b7fbb2a8e95bb690cabe058b03ae7d2.jpg','oldprice'=>'529','newprice'=>'317,4','discount'=>'40'),
array('name'=>'Результативность: Секреты эффективного поведения','id'=>'8101','link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8101/?from=bflanding','img'=>'/upload/iblock/586/5862cf40ebacb6461762d7d826929a63.jpg','oldprice'=>'639','newprice'=>'383,4','discount'=>'40'),
array('name'=>'Реструктуризация сферы услуг ЖКХ','id'=>'7889','link'=>'/catalog/ProjectManagment/7889/?from=bflanding','img'=>'/upload/iblock/5bc/5bc0563f364af6a341703048ecc0985f.jpg','oldprice'=>'479','newprice'=>'239,5','discount'=>'50'),
array('name'=>'Рожденные с характером','id'=>'7885','link'=>'/catalog/BooksForParents/7885/?from=bflanding','img'=>'/upload/iblock/002/0022981a0c07cb9469723f6a18e0a59f.jpg','oldprice'=>'366','newprice'=>'292,8','discount'=>'20'),
array('name'=>'Рожденный читать: Как подружить ребенка с книгой','id'=>'8276','link'=>'/catalog/BooksForParents/8276/?from=bflanding','img'=>'/upload/iblock/e20/e20fa19fe573a5dadc46f20ab7739c00.jpg','oldprice'=>'366','newprice'=>'292,8','discount'=>'20'),
array('name'=>'Ройзман: Уральский Робин Гуд','id'=>'8212','link'=>'/catalog/BiographiesAndMemoirs/8212/?from=bflanding','img'=>'/upload/iblock/e1d/e1d2744f34872dacb9bcf754689913cc.jpg','oldprice'=>'479','newprice'=>'287,4','discount'=>'40'),
array('name'=>'Руководство астронавта по жизни на Земле. Чему научили меня 4000 часов на орбите','id'=>'8402','link'=>'/catalog/PopularScience/8402/?from=bflanding','img'=>'/upload/iblock/306/306148073c49b3c23f0041db87bdc76f.jpg','oldprice'=>'448','newprice'=>'403,2','discount'=>'10'),
array('name'=>'Руководство по улучшению бизнес-процессов','id'=>'8322','link'=>'/catalog/ProjectManagment/8322/?from=bflanding','img'=>'/upload/iblock/334/33464044557e2b6d0610fbfa3d1938e4.jpg','oldprice'=>'399','newprice'=>'279,3','discount'=>'30'),
array('name'=>'Русские байки: Вокруг света на Harley-Davidson','id'=>'7909','link'=>'/catalog/PublicismDocumentaryProse/7909/?from=bflanding','img'=>'/upload/iblock/a43/a43129f0bc27c18725317ea61bd4df5f.jpg','oldprice'=>'479','newprice'=>'287,4','discount'=>'40'),
array('name'=>'Русские налоговые сказки','id'=>'8040','link'=>'/catalog/PopularPsychologyPersonalEffectiveness/8040/?from=bflanding','img'=>'/upload/iblock/61b/61b4f8c4d6e97e762bc2674bc3b612da.jpg','oldprice'=>'399','newprice'=>'239,4','discount'=>'40'),
array('name'=>'Русское влияние в Евразии: Геополитическая история от становления государства до времен Путина','id'=>'8228','link'=>'/catalog/Policy/8228/?from=bflanding','img'=>'/upload/iblock/935/935400bb44ed6c5a867a8916053b87bd.jpg','oldprice'=>'639','newprice'=>'383,4','discount'=>'40'),
array('name'=>'Север Турции','id'=>'8248','link'=>'/catalog/HobbyTravelingCars/8248/?from=bflanding','img'=>'/upload/iblock/7ba/7baec317b81e29ac93a5a8c2d772ab20.jpg','oldprice'=>'989','newprice'=>'593,4','discount'=>'40'),
array('name'=>'Семь тетрадей: Избранное (в 2-х томах)','id'=>'7495','link'=>'/catalog/Fiction/7495/?from=bflanding','img'=>'/upload/iblock/366/366fdb4b9281a7950a166602588f9bd4.jpg','oldprice'=>'399','newprice'=>'119,7','discount'=>'70'),
array('name'=>'Сжиженный газ — будущее мировой энергетики','id'=>'62229','link'=>'/catalog/Economics/62229/?from=bflanding','img'=>'/upload/iblock/af3/af31d7d475c900f4766196f44cbbefb7.jpg','oldprice'=>'757','newprice'=>'302,8','discount'=>'60'),
array('name'=>'Сила обаяния: Как завоевывать сердца и добиваться успеха','id'=>'5873','link'=>'/catalog/PopularPsychologyPersonalEffectiveness/5873/?from=bflanding','img'=>'/upload/iblock/a96/a964d2fd534db5c6efbf00d63a0940c8.jpg','oldprice'=>'318','newprice'=>'190,8','discount'=>'40'),
array('name'=>'Синдром войны: О чем не говорят солдаты','id'=>'7827','link'=>'/catalog/PublicismDocumentaryProse/7827/?from=bflanding','img'=>'/upload/iblock/9b1/9b16ed74d172a74f629a1ed415b7912b.jpg','oldprice'=>'366','newprice'=>'219,6','discount'=>'40'),
array('name'=>'Сказать жизни «Да!»: психолог в концлагере (карманный формат)','id'=>'6341','link'=>'/catalog/PopularPsychologyPersonalEffectiveness/6341/?from=bflanding','img'=>'/upload/iblock/c90/c903327d1b0d96a46a4d1ed968a43e19.jpg','oldprice'=>'318','newprice'=>'286,2','discount'=>'10'),
array('name'=>'Собственник и менеджер: Строим эффективный бизнес. Сборник статей','id'=>'6413','link'=>'/catalog/GeneralManagment/6413/?from=bflanding','img'=>'/upload/iblock/fef/fef12f377e68e90b55049fcfcf0f5298.jpg','oldprice'=>'158','newprice'=>'94,8','discount'=>'40'),
array('name'=>'Совершенная машина продаж: 12 проверенных стратегий эффективности бизнеса','id'=>'7799','link'=>'/catalog/Sales/7799/?from=bflanding','img'=>'/upload/iblock/e85/e85c55931783719faeb77b1b35b39a14.jpg','oldprice'=>'559','newprice'=>'279,5','discount'=>'50'),
array('name'=>'Совет директоров: Инструкция по применению','id'=>'6087','link'=>'/catalog/CorporateGovernance/6087/?from=bflanding','img'=>'/upload/iblock/d4d/d4da459e281d309e1fce454455d15b0c.jpg','oldprice'=>'525','newprice'=>'315','discount'=>'40'),
array('name'=>'Создание успешного социального предприятия','id'=>'8474','link'=>'/catalog/StartupsInnovativeEntrepreneurship/8474/?from=bflanding','img'=>'/upload/iblock/48e/48e3abd2b00bc3c2cb498c780b684ba1.jpg','oldprice'=>'279','newprice'=>'167,4','discount'=>'40'),
array('name'=>'Состояние эффективности: Необычные методы самосовершенствования','id'=>'8312','link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8312/?from=bflanding','img'=>'/upload/iblock/6b7/6b76b4843336ee9dd84ad030bfa8ef35.jpg','oldprice'=>'389','newprice'=>'194,5','discount'=>'50'),
array('name'=>'Социальное предпринимательство: миссия – сделать мир лучше','id'=>'7940','link'=>'/catalog/StartupsInnovativeEntrepreneurship/7940/?from=bflanding','img'=>'/upload/iblock/334/334b9042bc5a404396221e1ec69f9147.jpg','oldprice'=>'639','newprice'=>'319,5','discount'=>'50'),
array('name'=>'Стартап в Сети: Мастер-классы успешных предпринимателей','id'=>'6984','link'=>'/catalog/StartupsInnovativeEntrepreneurship/6984/?from=bflanding','img'=>'/upload/iblock/e4d/e4d251362597b0ab995df92369030b8e.jpg','oldprice'=>'559','newprice'=>'335,4','discount'=>'40'),
array('name'=>'Стив Джобс о бизнесе: 250 высказываний человека, изменившего мир','id'=>'7143','link'=>'/catalog/SuccessStory/7143/?from=bflanding','img'=>'/upload/iblock/767/767635674b4bd22b91610dab4e7e0cd1.jpg','oldprice'=>'399','newprice'=>'199,5','discount'=>'50'),
array('name'=>'Стратегический менеджмент по Котлеру: Лучшие приемы и методы','id'=>'7513','link'=>'/catalog/CorporateGovernance/7513/?from=bflanding','img'=>'/upload/iblock/ad4/ad4d4553da5ce3e9ee28367e2074e5b4.jpg','oldprice'=>'479','newprice'=>'383,2','discount'=>'20'),
array('name'=>'Стратегия пеперони: Добавь перца в работу!','id'=>'8202','link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8202/?from=bflanding','img'=>'/upload/iblock/fe2/fe228beddad35bc29a056a5e8e4974d8.jpg','oldprice'=>'399','newprice'=>'239,4','discount'=>'40'),
array('name'=>'Стратегия успеха: Как избавиться от навязанных стереотипов и найти свой путь','id'=>'7962','link'=>'/catalog/PopularPsychologyPersonalEffectiveness/7962/?from=bflanding','img'=>'/upload/iblock/ab9/ab959ada6b23d9d2f3031e82de2958ff.jpg','oldprice'=>'559','newprice'=>'335,4','discount'=>'40'),
array('name'=>'Твитономика: Все, что нужно знать об экономике, коротко и по существу','id'=>'7952','link'=>'/catalog/Policy/7952/?from=bflanding','img'=>'/upload/iblock/791/791fce5ee7944e74ff8ae0a47fc46591.jpg','oldprice'=>'314','newprice'=>'219,8','discount'=>'30'),
array('name'=>'Творим с детьми: 20 мастер-классов в разных техниках','id'=>'67411','link'=>'/catalog/BooksForParents/67411/?from=bflanding','img'=>'/upload/iblock/e48/e48cf912bfbd4d7a4c95d6553c59cc93.jpg','oldprice'=>'479','newprice'=>'143,7','discount'=>'70'),
array('name'=>'Территориальные кластеры: Семь инструментов управления','id'=>'8268','link'=>'/catalog/GeneralManagment/8268/?from=bflanding','img'=>'/upload/iblock/348/3484e16b2142a6848a6417ad053fb9f1.jpg','oldprice'=>'499','newprice'=>'249,5','discount'=>'50'),
array('name'=>'Тренировка памяти: Экспресс-курс','id'=>'8097','link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8097/?from=bflanding','img'=>'/upload/iblock/272/272fa1d185784909a2af53783d90afbf.jpg','oldprice'=>'399','newprice'=>'319,2','discount'=>'20'),
array('name'=>'Тюремные люди','id'=>'8165','link'=>'/catalog/BiographiesAndMemoirs/8165/?from=bflanding','img'=>'/upload/iblock/9c9/9c90036192157508084de96d6751e08e.jpg','oldprice'=>'285','newprice'=>'171','discount'=>'40'),
array('name'=>'Тюрьма и воля','id'=>'7509','link'=>'/catalog/BiographiesAndMemoirs/7509/?from=bflanding','img'=>'/upload/iblock/954/954eb0afd748a4a9e165db607b8e0bec.jpg','oldprice'=>'318','newprice'=>'95,4','discount'=>'70'),
array('name'=>'Убеждай и побеждай: Секреты эффективной аргументации','id'=>'6545','link'=>'/catalog/NegotiationsBusinessCommunication/6545/?from=bflanding','img'=>'/upload/iblock/40c/40cedaf9fc616528011d7b092108c2ae.jpg','oldprice'=>'479','newprice'=>'335,3','discount'=>'30'),
array('name'=>'УМНО, или Управление маркетингом нетривиальным образом','id'=>'7771','link'=>'/catalog/Marketing/7771/?from=bflanding','img'=>'/upload/iblock/11a/11a3047c85a917d5197ff91233e8fffc.jpg','oldprice'=>'539','newprice'=>'323,4','discount'=>'40'),
array('name'=>'Управление продажами на территории: Теоретические основы и практические рекомендации','id'=>'7857','link'=>'/catalog/Sales/7857/?from=bflanding','img'=>'/upload/iblock/e99/e996541d88d53880c988cbaf2b3bdc3f.jpg','oldprice'=>'359','newprice'=>'215,4','discount'=>'40'),
array('name'=>'Управление результативностью: Как преодолеть разрыв между объявленной стратегией и реальными процессами','id'=>'8788','link'=>'/catalog/GeneralManagment/8788/?from=bflanding','img'=>'/upload/iblock/4a5/4a5ce1635f0501f43b5d40cde91899e2.jpg','oldprice'=>'599','newprice'=>'359,4','discount'=>'40'),
array('name'=>'Управляй своей мечтой: Как реализовать любой замысел, проект, план','id'=>'8218','link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8218/?from=bflanding','img'=>'/upload/iblock/fe5/fe57d00da61e7cf7bef8802040731592.jpg','oldprice'=>'479','newprice'=>'287,4','discount'=>'40'),
array('name'=>'Устала уставать: Простые способы восстановления при хроническом переутомлении','id'=>'75445','link'=>'/catalog/HealthAndHealthyFood/75445/?from=bflanding','img'=>'/upload/iblock/765/765cf857218b8c2ed0cc5f57d97c302f.jpg','oldprice'=>'448','newprice'=>'403,2','discount'=>'10'),
array('name'=>'Феноменальная память: Методы запоминания информации','id'=>'7424','link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/7424/?from=bflanding','img'=>'/upload/iblock/b77/b77f64d057b5682172fe3c34a2d13929.jpg','oldprice'=>'318','newprice'=>'254,4','discount'=>'20'),
array('name'=>'Фокус: Достижение приоритетных целей','id'=>'6966','link'=>'/catalog/PopularPsychologyPersonalEffectiveness/6966/?from=bflanding','img'=>'/upload/iblock/598/5984d6d41d0b2aa2425ed86379e56b3f.jpg','oldprice'=>'318','newprice'=>'190,8','discount'=>'40'),
array('name'=>'Хватит быть славным парнем! Как добиться желаемого в любви, работе и жизни','id'=>'8002','link'=>'/catalog/PersonalEffectivenessPracticalSkillManagerialPsychology/8002/?from=bflanding','img'=>'/upload/iblock/69b/69bfe7fad721ac31c91ca725c2c3e0a5.jpg','oldprice'=>'399','newprice'=>'319,2','discount'=>'20'),
array('name'=>'Царица парижских кабаре','id'=>'6996','link'=>'/catalog/BeautyAndHistoryOfFashion/6996/?from=bflanding','img'=>'/upload/iblock/bca/bca9a68dc285b16c502c0dea1e961109.jpg','oldprice'=>'318','newprice'=>'190,8','discount'=>'40'),
array('name'=>'Человек уставший: Как победить хроническую усталость и вернуть себе силы, энергию и радость жизни','id'=>'8386','link'=>'/catalog/HealthAndHealthyFood/8386/?from=bflanding','img'=>'/upload/iblock/7cc/7ccee3c318a3c3351bca353407bbd10a.jpg','oldprice'=>'479','newprice'=>'383,2','discount'=>'20'),
array('name'=>'Человеку свойственно продавать: Удивительная правда о том, как побуждать других к действию','id'=>'8318','link'=>'/catalog/Sales/8318/?from=bflanding','img'=>'/upload/iblock/593/5932e02dbd52e2b971780840966e7706.jpg','oldprice'=>'489','newprice'=>'342,3','discount'=>'30'),
array('name'=>'Через поражения — к победе: Законы Дарвина в жизни и бизнесе','id'=>'7345','link'=>'/catalog/PopularPsychologyPersonalEffectiveness/7345/?from=bflanding','img'=>'/upload/iblock/615/6155dc634f8ebfc7e7d103dcf1d9176a.jpg','oldprice'=>'448','newprice'=>'224','discount'=>'50'),
array('name'=>'Черная риторика: Власть и магия слова','id'=>'5833','link'=>'/catalog/NegotiationsBusinessCommunication/5833/?from=bflanding','img'=>'/upload/iblock/170/170b79071064b7d04b00d8dfc7314c98.jpg','oldprice'=>'366','newprice'=>'219,6','discount'=>'40'),
array('name'=>'Чувство вины','id'=>'7689','link'=>'/catalog/PublicismDocumentaryProse/7689/?from=bflanding','img'=>'/upload/iblock/611/6116b1c7b908fc31b445927c8cfb702f.jpg','oldprice'=>'318','newprice'=>'190,8','discount'=>'40'),
array('name'=>'Эйнштейн о религии','id'=>'6671','link'=>'/catalog/PsychologyPhilosophyHistoryOfReligion/6671/?from=bflanding','img'=>'/upload/iblock/b7c/b7c52ae2e091a61883be97ba97b9b47c.jpg','oldprice'=>'285','newprice'=>'228','discount'=>'20'),
array('name'=>'Экономическое равновесие: Теория объемной геометрии в экономике','id'=>'8410','link'=>'/catalog/InvestmentsStock/8410/?from=bflanding','img'=>'/upload/iblock/83b/83b54b8dbbc78583acf6d0b849fc200c.jpg','oldprice'=>'399','newprice'=>'239,4','discount'=>'40'),
array('name'=>'Этюды о моде и стиле','id'=>'5553','link'=>'/catalog/BeautyAndHistoryOfFashion/5553/?from=bflanding','img'=>'/upload/iblock/96d/96d5ae126f0777232d9f625e8da8829b.jpg','oldprice'=>'559','newprice'=>'391,3','discount'=>'30'),
array('name'=>'Юридический бизнес в России: По материалам третьего юридического форума. Москва, 12 апреля 2007 года','id'=>'6147','link'=>'/catalog/Law/6147/?from=bflanding','img'=>'/upload/iblock/a87/a87aeecfd4c6c45e6f85b2d4a760aeb3.jpg','oldprice'=>'89','newprice'=>'26,7','discount'=>'70'),
array('name'=>'Я говорю — меня слушают','id'=>'6685','link'=>'/catalog/PrezentatsiiRitorika/6685/?from=bflanding','img'=>'/upload/iblock/37f/37feed6435938c9ffc053e1a60f3b6da.jpg','oldprice'=>'399','newprice'=>'239,4','discount'=>'40'),
array('name'=>'Яндекс Воложа: История создания компании мечты','id'=>'7891','link'=>'/catalog/SuccessStory/7891/?from=bflanding','img'=>'/upload/iblock/58f/58f8d451cce2e950f022cebb502d9edb.jpg','oldprice'=>'479','newprice'=>'287,4','discount'=>'40')
);?>

<?$i = 0;?>

<style>
#slide1text1 {

}

</style>

<?
foreach ($booksArray as $m => $single) {
	$arSelect = Array("DETAIL_PICTURE");
	$arFilter = Array("IBLOCK_ID"=>4,"ID"=>$single['id']);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
	while ($ob = $res->GetNextElement()) {
		$arFields = $ob->GetFields();
		$booksArray[$m]["DETAIL_PICTURE"] = $arFields["DETAIL_PICTURE"];
	}
}
?>
    <div class="landing">
        <div class="mainWrapp">
            <div class="slide1">
				<div class="slide1text1">
					ВСЕМ СТОЯТЬ! ЭТО ОГРАБЛЕНИЕ!
				</div>
				<?if (!$USER->isAdmin() && $today != 4) {?><center><iframe src="files/bf.html" height="420" width="100%" scrolling="no" style="border:none;margin:0 auto;"></iframe></center>
				<div class="slide1text2">
					Лучшие книги Альпины дешевле, чем на черном рынке:<br />
					<span>Скидки — до 70%</span><br />
					Только четыре дня, с 24 по 27 ноября
				</div>
				<?} else { echo '<br /><br />';}?>
				<div class="slide1text3">
					позвать друзей в банду
					<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
					<script src="//yastatic.net/share2/share.js"></script>
					<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki" data-counter=""></div>
				</div>
				
				<div id="slide1img">
				</div>
				<?if ($USER->isAdmin() || $today == 4) {?>
				<div id="shp1"></div>
				<div id="slide2">
					<div id="slide2img1"></div>
					<div id="slide2text1">
						Золотой запас
					</div>
					<div class="hintWrapp">
						<?for ($i = 0;$i < 7; $i++) {?>
							<div class="bookWrap">
								<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'blackFridayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});"><div class="discount"><?=$booksArray[$i]["discount"]?>%</div>
									<img src="<?=CFile::ResizeImageGet($booksArray[$i]["DETAIL_PICTURE"], array("width" => 140, "height" => 200), BX_RESIZE_IMAGE_PROPORTIONAL, true)[src];?>" alt="<?=$booksArray[$i]["name"]?>" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
									<p>
									<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="newprice"><?=round(-$booksArray[$i]["oldprice"]*($booksArray[$i]["discount"]/100-1))?> руб.</span>
									</p>									
								</a>
							</div>
						<?}?>
					</div>
					<div class="hintWrapp">
						<?for ($i = 7;$i < 14; $i++) {?>
							<div class="bookWrap">
								<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'blackFridayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});"><div class="discount"><?=$booksArray[$i]["discount"]?>%</div>
									<img src="<?=CFile::ResizeImageGet($booksArray[$i]["DETAIL_PICTURE"], array("width" => 140, "height" => 200), BX_RESIZE_IMAGE_PROPORTIONAL, true)[src];?>" alt="<?=$booksArray[$i]["name"]?>" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
									<p>
									<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="newprice"><?=round(-$booksArray[$i]["oldprice"]*($booksArray[$i]["discount"]/100-1))?> руб.</span>
									</p>									
								</a>
							</div>
						<?}?>
					</div>
					<div class="hintWrapp" style="margin-top:140px;background: yellow;box-shadow: 0px 5px 5px 0px rgba(0, 0, 0, 0.18), 0px 10px 7px 0px rgba(0, 0, 0, 0.14);padding-bottom:40px;">
						<div id="shp2"></div>
						<div id="slide2text2">
							Ловкость рук и никакого мошенничества
						</div>					
						<?for ($i = 14;$i < 21; $i++) {?>
							<div class="bookWrap">
								<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'blackFridayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});"><div class="discount"><?=$booksArray[$i]["discount"]?>%</div>
									<img src="<?=CFile::ResizeImageGet($booksArray[$i]["DETAIL_PICTURE"], array("width" => 140, "height" => 200), BX_RESIZE_IMAGE_PROPORTIONAL, true)[src];?>" alt="<?=$booksArray[$i]["name"]?>" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
									<p>
									<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="newprice"><?=round(-$booksArray[$i]["oldprice"]*($booksArray[$i]["discount"]/100-1))?> руб.</span>
									</p>									
								</a>
							</div>
						<?}?>
						<div id="shp3"></div>
					</div>
					<div class="hintWrapp">
						<div id="slide2text3" style="padding-top:70px;">
							Мой первый миллион
						</div>					
						<?for ($i = 21;$i < 28; $i++) {?>
							<div class="bookWrap">
								<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'blackFridayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});"><div class="discount"><?=$booksArray[$i]["discount"]?>%</div>
									<img src="<?=CFile::ResizeImageGet($booksArray[$i]["DETAIL_PICTURE"], array("width" => 140, "height" => 200), BX_RESIZE_IMAGE_PROPORTIONAL, true)[src];?>" alt="<?=$booksArray[$i]["name"]?>" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
									<p>
									<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="newprice"><?=round(-$booksArray[$i]["oldprice"]*($booksArray[$i]["discount"]/100-1))?> руб.</span>
									</p>									
								</a>
							</div>
						<?}?>
					</div>
						<div id="slide2text3" style="padding-top:70px;">
							Без шума и пыли
						</div>					
					<div class="hintWrapp">
						<?for ($i = 28;$i < 35; $i++) {?>
							<div class="bookWrap">
								<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'blackFridayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});"><div class="discount"><?=$booksArray[$i]["discount"]?>%</div>
									<img src="<?=CFile::ResizeImageGet($booksArray[$i]["DETAIL_PICTURE"], array("width" => 140, "height" => 200), BX_RESIZE_IMAGE_PROPORTIONAL, true)[src];?>" alt="<?=$booksArray[$i]["name"]?>" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
									<p>
									<span class="oldprice"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="newprice"><?=round(-$booksArray[$i]["oldprice"]*($booksArray[$i]["discount"]/100-1))?> руб.</span>
									</p>									
								</a>
							</div>
						<?}?>
						<div id="shp4"></div>
					</div>
				</div>
				<div class="hintWrapp" style="margin:100px auto 0;border:3px solid #f4ca00; max-width:1700px;">
					<center><div id="slide2text4">
						Идеальное ограбление
					</div></center>
					<?for ($i = 35;$i < 42; $i++) {?>
						<div class="bookWrap">
							<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'blackFridayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});"><div class="discount" style="background:yellow;color:#000"><?=$booksArray[$i]["discount"]?>%</div>
								<img src="<?=CFile::ResizeImageGet($booksArray[$i]["DETAIL_PICTURE"], array("width" => 140, "height" => 200), BX_RESIZE_IMAGE_PROPORTIONAL, true)[src];?>" alt="<?=$booksArray[$i]["name"]?>" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
								<p>
								<span class="oldprice" style="color:#fff;"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="newprice" style="color:#fff;"><?=round(-$booksArray[$i]["oldprice"]*($booksArray[$i]["discount"]/100-1))?> руб.</span>
								</p>									
							</a>
						</div>
					<?}?>
					<div id="shp5"></div>
				</div>	
				<div id="shp6"></div>
					<div class="hintWrapp">
						<?for ($i = 42;$i < 200; $i++) {?>
							<div class="bookWrap">
								<a href="<?=$booksArray[$i]["link"]?>" onclick="dataLayer.push({event: 'ab-test-gtm', action: 'blackFridayClick-<?=$label?>',label: '<?=$booksArray[$i]["name"]?>'});"><div class="discount" style="background:yellow;color:#000"><?=$booksArray[$i]["discount"]?>%</div>
									<img src="<?=CFile::ResizeImageGet($booksArray[$i]["DETAIL_PICTURE"], array("width" => 140, "height" => 200), BX_RESIZE_IMAGE_PROPORTIONAL, true)[src];?>" alt="<?=$booksArray[$i]["name"]?>" alt="<?=$booksArray[$i]["name"]?>" title="<?=$booksArray[$i]["name"]?>" />
									<p>
									<span class="oldprice" style="color:#fff;"><?=$booksArray[$i]["oldprice"]?> руб.</span> <span class="newprice" style="color:#fff;"><?=round(-$booksArray[$i]["oldprice"]*($booksArray[$i]["discount"]/100-1))?> руб.</span>
									</p>									
								</a>
							</div>
						<?}?>
						
					</div>				
				<div class="slide1text3" style="padding-bottom:50px;">
					
					
				</div>
				
            </div>

			
            </div>		
			<div class="footer">

            </div>				
			<?}?>
        </div>


 </body>
 </html>
 