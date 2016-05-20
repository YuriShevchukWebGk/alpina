<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");
    CJSCore::Init(array("fx"));
    $curPage = $APPLICATION->GetCurPage(true);
    $theme = COption::GetOptionString("main", "wizard_eshop_bootstrap_theme_id", "blue", SITE_ID);
    /*?>
    <!DOCTYPE html>
    <html xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
    <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
    <link rel="shortcut icon" type="image/x-icon" href="<?=SITE_DIR?>favicon.ico" />
    <?$APPLICATION->ShowHead();?>
    <?
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/colors.css");
    $APPLICATION->SetAdditionalCSS("/bitrix/css/main/bootstrap.css");
    $APPLICATION->SetAdditionalCSS("/bitrix/css/main/font-awesome.css");
    ?>
    <title><?$APPLICATION->ShowTitle()?></title>
    </head>
    <body class="bx-background-image bx-<?=$theme?>" <?=$APPLICATION->ShowProperty("backgroundImage")?>>
    <div id="panel"><?$APPLICATION->ShowPanel();?></div>
    <?$APPLICATION->IncludeComponent("bitrix:eshop.banner", "", array());?>
    <div class="bx-wrapper" id="bx_eshop_wrap">
    <header class="bx-header">
    <div class="bx-header-section container">
    <div class="row">
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
    <div class="bx-logo">
    <a class="bx-logo-block hidden-xs" href="<?=SITE_DIR?>">
    <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/company_logo.php"), false);?>
    </a>
    <a class="bx-logo-block hidden-lg hidden-md hidden-sm text-center" href="<?=SITE_DIR?>">
    <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/company_logo_mobile.php"), false);?>
    </a>
    </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
    <div class="bx-inc-orginfo">
    <div>
    <span class="bx-inc-orginfo-phone"><i class="fa fa-phone"></i> <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/telephone.php"), false);?></span>
    </div>
    </div>
    </div>
    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
    <div class="bx-worktime">
    <div class="bx-worktime-prop">
    <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/schedule.php"), false);?>
    </div>
    </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 hidden-xs">
    <?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "", array(
    "PATH_TO_BASKET" => SITE_DIR."personal/cart/",
    "PATH_TO_PERSONAL" => SITE_DIR."personal/",
    "SHOW_PERSONAL_LINK" => "N",
    "SHOW_NUM_PRODUCTS" => "Y",
    "SHOW_TOTAL_PRICE" => "Y",
    "SHOW_PRODUCTS" => "N",
    "POSITION_FIXED" =>"N",
    "SHOW_AUTHOR" => "Y",
    "PATH_TO_REGISTER" => SITE_DIR."login/",
    "PATH_TO_PROFILE" => SITE_DIR."personal/"
    ),
    false,
    array()
    );?>
    </div>
    </div>
    <div class="row">
    <div class="col-md-12 hidden-xs">
    <?$APPLICATION->IncludeComponent("bitrix:menu", "catalog_horizontal", array(
    "ROOT_MENU_TYPE" => "left",
    "MENU_CACHE_TYPE" => "A",
    "MENU_CACHE_TIME" => "36000000",
    "MENU_CACHE_USE_GROUPS" => "Y",
    "MENU_THEME" => "site",
    "CACHE_SELECTED_ITEMS" => "N",
    "MENU_CACHE_GET_VARS" => array(
    ),
    "MAX_LEVEL" => "3",
    "CHILD_MENU_TYPE" => "left",
    "USE_EXT" => "Y",
    "DELAY" => "N",
    "ALLOW_MULTI_SELECT" => "N",
    ),
    false
    );?>
    </div>
    </div>
    <?if ($curPage != SITE_DIR."index.php"):?>
    <div class="row">
    <div class="col-lg-12">
    <?$APPLICATION->IncludeComponent("bitrix:search.title", "visual", array(
    "NUM_CATEGORIES" => "1",
    "TOP_COUNT" => "5",
    "CHECK_DATES" => "N",
    "SHOW_OTHERS" => "N",
    "PAGE" => SITE_DIR."catalog/",
    "CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS") ,
    "CATEGORY_0" => array(
    0 => "iblock_catalog",
    ),
    "CATEGORY_0_iblock_catalog" => array(
    0 => "all",
    ),
    "CATEGORY_OTHERS_TITLE" => GetMessage("SEARCH_OTHER"),
    "SHOW_INPUT" => "Y",
    "INPUT_ID" => "title-search-input",
    "CONTAINER_ID" => "search",
    "PRICE_CODE" => array(
    0 => "BASE",
    ),
    "SHOW_PREVIEW" => "Y",
    "PREVIEW_WIDTH" => "75",
    "PREVIEW_HEIGHT" => "75",
    "CONVERT_CURRENCY" => "Y"
    ),
    false
    );?>
    </div>
    </div>
    <?endif?>

    <?if ($curPage != SITE_DIR."index.php"):?>
    <div class="row">
    <div class="col-lg-12" id="navigation">
    <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array(
    "START_FROM" => "0",
    "PATH" => "",
    "SITE_ID" => "-"
    ),
    false,
    Array('HIDE_ICONS' => 'Y')
    );?>
    </div>
    </div>
    <h1 class="bx-title dbg_title"><?=$APPLICATION->ShowTitle(false);?></h1>
    <?endif?>
    </div>
    </header>

    <div class="workarea">
    <div class="container bx-content-seection">
    <div class="row">
    <?$isCatalogPage = preg_match("~^".SITE_DIR."catalog/~", $curPage);?>
    <div class="bx-content <?=($isCatalogPage ? "col-xs-12" : "col-md-9 col-sm-8")?>">
*/?>
<!doctype html>
<html>
<head>
    <!--<meta http-equiv="Content-type" content="text/html; charset=utf-8"> -->
    <title><?$APPLICATION->ShowTitle()?></title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>    
    <?$APPLICATION->ShowHead();?>
	<?$APPLICATION->ShowProperty('FACEBOOK_META');?>
	
    <link rel="stylesheet" href="/css/style.css" type="text/css">
    <link rel="stylesheet" href="/css/easySlider.css" type="text/css">

    <script type="text/javascript" src="/js/fancybox-2/jquery.fancybox.js"></script>
    <script type="text/javascript" src="/js/fancybox-2/helpers/jquery.fancybox-thumbs.js"></script>

    <script src="/js/circle-progress.js"></script>
    <script src="/js/jquery.appear.js"></script>
    <script src="/js/easySlider.js"></script>
    <script src="/js/inputmask.js"></script>
    
    <script src="<?=SITE_TEMPLATE_PATH?>/js/prettyCheckable.min.js"></script>
    <script src="<?=SITE_TEMPLATE_PATH?>/js/selectize.min.js"></script>

    <script src="/js/main.js"></script> 
	<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png?v=WGG39kPBLm">
	<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png?v=WGG39kPBLm">
	<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png?v=WGG39kPBLm">
	<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png?v=WGG39kPBLm">
	<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png?v=WGG39kPBLm">
	<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png?v=WGG39kPBLm">
	<link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png?v=WGG39kPBLm">
	<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png?v=WGG39kPBLm">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png?v=WGG39kPBLm">
	<link rel="icon" type="image/png" href="/favicon-32x32.png?v=WGG39kPBLm" sizes="32x32">
	<link rel="icon" type="image/png" href="/favicon-194x194.png?v=WGG39kPBLm" sizes="194x194">
	<link rel="icon" type="image/png" href="/favicon-96x96.png?v=WGG39kPBLm" sizes="96x96">
	<link rel="icon" type="image/png" href="/android-chrome-192x192.png?v=WGG39kPBLm" sizes="192x192">
	<link rel="icon" type="image/png" href="/favicon-16x16.png?v=WGG39kPBLm" sizes="16x16">
	<link rel="manifest" href="/manifest.json?v=WGG39kPBLm">
	<link rel="mask-icon" href="/safari-pinned-tab.svg?v=WGG39kPBLm" color="#5bbad5">
	<link rel="shortcut icon" href="/favicon.ico?v=WGG39kPBLm">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/mstile-144x144.png?v=WGG39kPBLm">
	<meta name="theme-color" content="#ffffff">	
    <link rel="stylesheet" type="text/css" href="/js/fancybox-2/jquery.fancybox.css" id="fancycss" media="screen" />
    <link rel="stylesheet" type="text/css" href="/js/fancybox-2/helpers/jquery.fancybox-thumbs.css" id="fancycss" media="screen" />   
	<?include_once($_SERVER["DOCUMENT_ROOT"] . '/custom-scripts/ab_tests.php'); //Хардовые AB-тесты?>
</head>
<body class="historyBodyWr" itemscope itemtype="http://schema.org/WebPage">

<?if ($USER->IsAuthorized()) {
	$rsCurUser = CUser::GetByID($USER->GetID());
    $arCurUser = $rsCurUser->Fetch();
	$userGTMData = "";
	$userGTMData = (!empty($arCurUser["NAME"]) ? "'user_name' : '".$arCurUser["NAME"]."'," : "");
	$userGTMData .= (!empty($arCurUser["EMAIL"]) ? "'user_email' : '".$arCurUser["EMAIL"]."'," : "");
	$userGTMData .= (!empty($arCurUser["UF_GENDER"]) ? "'user_gender' : '".$arCurUser["UF_GENDER"]."'" : "");
	
	?>
	
	<script type="text/javascript">
	dataLayer = [{
		'userId' : <?=$USER->GetID()?>,
		'event' : 'authentication',
		'userRegCategory' : 'UserRegistered',
		<?=$userGTMData?>
	}];
	</script>
<?} else {?>
	<script type="text/javascript">
	dataLayer = [{
		'userRegCategory' : 'UserUnregistered'
	}];
	</script>
<?}?>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-PM87GH"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PM87GH');</script>
<!-- End Google Tag Manager -->
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<header>
    <a href="/">
        <div class="logo catalogLogo">
            <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include", 
                    ".default", 
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "AREA_FILE_RECURSIVE" => "Y",
                        "EDIT_TEMPLATE" => "",
                        "COMPONENT_TEMPLATE" => ".default",
                        "PATH" => "/include/logoMini.php"
                    ),
                    false
                );?>
        </div>
    </a>
    <div class="catalogHead headCatalog">
        <p>Каталог</p>
    </div>
    <div class="headerWrapper">
        <ul class="menu">
            <!--<li><a href="/content/payment.php">РћРїР»Р°С‚Р°</a></li>
            <li><a href="/content/delivery.php">Р”РѕСЃС‚Р°РІРєР°</a></li>
            <li><a href="/content/discounts.php">РЎРєРёРґРєРё</a></li>
            <li><a href="/content/where-order-content.php">Р“РґРµ РјРѕР№ Р·Р°РєР°Р·?</a></li>
            <li><a href="/content/team.php">РљРѕРјР°РЅРґР°</a></li>
            <li><a href="/content/contacts.php">РљРѕРЅС‚Р°РєС‚С‹</a></li>-->
            <?$APPLICATION->IncludeComponent("bitrix:menu", "top_menu", Array(
                    "ROOT_MENU_TYPE" => "top",    // РўРёРї РјРµРЅСЋ РґР»СЏ РїРµСЂРІРѕРіРѕ СѓСЂРѕРІРЅСЏ
                    "MAX_LEVEL" => "1",    // РЈСЂРѕРІРµРЅСЊ РІР»РѕР¶РµРЅРЅРѕСЃС‚Рё РјРµРЅСЋ
                    "CHILD_MENU_TYPE" => "top",    // РўРёРї РјРµРЅСЋ РґР»СЏ РѕСЃС‚Р°Р»СЊРЅС‹С… СѓСЂРѕРІРЅРµР№
                    "USE_EXT" => "Y",    // РџРѕРґРєР»СЋС‡Р°С‚СЊ С„Р°Р№Р»С‹ СЃ РёРјРµРЅР°РјРё РІРёРґР° .С‚РёРї_РјРµРЅСЋ.menu_ext.php
                    "DELAY" => "N",    // РћС‚РєР»Р°РґС‹РІР°С‚СЊ РІС‹РїРѕР»РЅРµРЅРёРµ С€Р°Р±Р»РѕРЅР° РјРµРЅСЋ
                    "ALLOW_MULTI_SELECT" => "Y",    // Р Р°Р·СЂРµС€РёС‚СЊ РЅРµСЃРєРѕР»СЊРєРѕ Р°РєС‚РёРІРЅС‹С… РїСѓРЅРєС‚РѕРІ РѕРґРЅРѕРІСЂРµРјРµРЅРЅРѕ
                    "MENU_CACHE_TYPE" => "N",    // РўРёРї РєРµС€РёСЂРѕРІР°РЅРёСЏ
                    "MENU_CACHE_TIME" => "3600",    // Р’СЂРµРјСЏ РєРµС€РёСЂРѕРІР°РЅРёСЏ (СЃРµРє.)
                    "MENU_CACHE_USE_GROUPS" => "Y",    // РЈС‡РёС‚С‹РІР°С‚СЊ РїСЂР°РІР° РґРѕСЃС‚СѓРїР°
                    "MENU_CACHE_GET_VARS" => "",    // Р—РЅР°С‡РёРјС‹Рµ РїРµСЂРµРјРµРЅРЅС‹Рµ Р·Р°РїСЂРѕСЃР°
                    ),
                    false
                );?>
        </ul>    
    </div>
    <div class="lkWrapp">
        <div class="headBasket">
            <div class="BasketQuant">
            </div>
        </div>
        <a href="/personal/profile/" <?if (!$USER->IsAuthorized()){?>id="authorisationPopup"<?}?>>
            <div>
                <img src="/img/lkImg.png">
            </div>
        </a>
        <p class="telephone"><!--+7 (495) 980 80 77-->
            <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include", 
                    ".default", 
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "AREA_FILE_RECURSIVE" => "Y",
                        "EDIT_TEMPLATE" => "",
                        "COMPONENT_TEMPLATE" => ".default",
                        "PATH" => "/include/telephone.php"
                    ),
                    false
                );?>

        </p>

    </div>
</header>

<div class="searchWrap">
    <div class="catalogWrapper">
        <!-- форма поиска -->
        <?$APPLICATION->IncludeComponent("bitrix:search.title", "search_form", 
                Array(
                    "CATEGORY_0" => "",    // Ограничение области поиска
                    "CATEGORY_0_TITLE" => "",    // Название категории
                    "CHECK_DATES" => "N",    // Искать только в активных по дате документах
                    "COMPONENT_TEMPLATE" => ".default",
                    "CONTAINER_ID" => "title-search",    // ID контейнера, по ширине которого будут выводиться результаты
                    "INPUT_ID" => "title-search-input",    // ID строки ввода поискового запроса
                    "NUM_CATEGORIES" => "1",    // Количество категорий поиска
                    "ORDER" => "date",    // Сортировка результатов
                    "PAGE" => "#SITE_DIR#search/index.php",    // Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
                    "SHOW_INPUT" => "Y",    // Показывать форму ввода поискового запроса
                    "SHOW_OTHERS" => "N",    // Показывать категорию "прочее"
                    "TOP_COUNT" => "5",    // Количество результатов в каждой категории
                    "USE_LANGUAGE_GUESS" => "Y",    // Включить автоопределение раскладки клавиатуры
                ),
                false
            );?>    
    </div>
</div>

<div class="historyCoverWrap">
    <div class="centerWrapper">
        <p><a href="/personal/">Личный кабинет</a></p>    
        <h1><?=$APPLICATION -> ShowTitle()?></h1>
    </div>
</div>

<div class="historyBodywrap">
    <div class="">
    
    <?if ($APPLICATION->GetCurDir() != "/personal/profile/") {?>

        <div class="orderHistorWrap">
        
        <?}?>