<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");
    CJSCore::Init(array("fx"));
    $curPage = $APPLICATION->GetCurPage(true);
    $theme = COption::GetOptionString("main", "wizard_eshop_bootstrap_theme_id", "blue", SITE_ID);
?>
<!doctype html>
<html lang="ru">
<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-WJ59CKW');</script>
<!-- End Google Tag Manager -->
<!--eski.mobi--><script class="eskimobi" data-type="mobile">!function(a,b,c,d,e){function g(a,c,d,e){var f=b.getElementsByTagName("script")[0];e.src?a.src=e.src:e.innerHTML&&(a.innerHTML=e.innerHTML),a.id=c,a.setAttribute("class",d),f.parentNode.insertBefore(a,f)}a.Mobify={points:[+new Date]};var f=/((; )|#|&|^)mobify=(\d)/.exec(location.hash+"; "+b.cookie);if(f&&f[3]){if(!+f[3])return}else if(!c())return;b.write('<div id="eski-overlay" style="font-family:Helvetica-Light,Helvetica,Arial,sans-serif;font-weight:light;font-size:300%;line-height:100%;position:absolute;top:42%;left:0;right:0;text-align:center;color: #999;">\u0417\u0430\u0433\u0440\u0443\u0437\u043A\u0430...</div><plaintext style="display:none">'),setTimeout(function(){var c=a.Mobify=a.Mobify||{};c.capturing=!0;var f=b.createElement("script"),h=function(){var c=new Date;c.setTime(c.getTime()+18e5),b.cookie="mobify=0; expires="+c.toGMTString()+"; path=/",a.location=a.location.href};f.onload=function(){if(e){var a=b.createElement("script");if(a.onerror=h,"string"==typeof e)g(a,"main-executable","mobify",{src:e});else{var c="var main = "+e.toString()+"; main();";g(a,"main-executable","mobify",{innerHTML:c})}}},f.onerror=h,g(f,"mobify-js","mobify",{src:d})})}(window,document,function(){var ua=navigator.userAgent||navigator.vendor||window.opera,m=false;if(/mobi|phone|ipod|nokia|android/i.test(ua))m=true;if(/msie|windows|media\scenter|opera\smini|ipad|android\s3|android\s2|iphone\sos\s(4|5|6)|ipad\sos\s(4|5|6)/i.test(ua)||screen.width>1024)m=false;return m;},"/eskimobi/eski.mobi.min.js?20170906","/eskimobi/mobi.js?201710182");</script><!--/eski.mobi-->
    <title><?$APPLICATION->ShowTitle()?></title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>


    <link rel="stylesheet" href="/css/style.css?<?=filemtime($_SERVER["DOCUMENT_ROOT"].'/css/style.css')?>" type="text/css">

    <script src="/js/jquery.appear.js"></script>

    <script src="/js/main.js?<?=filemtime($_SERVER["DOCUMENT_ROOT"].'/js/main.js')?>"></script>
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
    <?if ($_SERVER["HTTP_HTTPS"]) {
        $protocol_name = "https://";
    } else {
        $protocol_name = "http://";
    }?>
    <link rel="amphtml" href="http://amp.alpinabook.ru/mobile/alpinabook-ru/amp/?p=<?= $protocol_name . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"] ?>">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/mstile-144x144.png?v=WGG39kPBLm">
	<meta name="theme-color" content="#ffffff">
    <meta name="yandex-verification" content="9b63e2cc68c18dd9" />
    <link rel="stylesheet" type="text/css" href="/js/fancybox-2/jquery.fancybox.css" id="fancycss" media="screen" />
    <link rel="stylesheet" type="text/css" href="/js/fancybox-2/helpers/jquery.fancybox-thumbs.css" id="fancycss" media="screen" />


     <?$APPLICATION->ShowHead();?>

    <?include_once($_SERVER["DOCUMENT_ROOT"] . '/local/templates/.default/include/initial_scale_values.php');?>
	<? file_exists($_SERVER["DOCUMENT_ROOT"] . '/custom-scripts/ab_tests.php') ? include($_SERVER["DOCUMENT_ROOT"] . '/custom-scripts/ab_tests.php') : ""; //Хардовые AB-тесты?>
	<?$APPLICATION->ShowProperty('FACEBOOK_META');?>
	<!-- header .content -->
	<script type="text/javascript" src="https://www.gdeslon.ru/landing.js?mode=other&amp;mid=79276" async></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>

</head>
<body itemscope itemtype="<?=preg_match("/(.*)\/about\/contacts\/(.*)/i", $_SERVER['REQUEST_URI']) ? 'https://schema.org/ContactPage' : 'https://schema.org/WebPage'?>">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WJ59CKW"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<!-- Yandex.Metrika counter --> <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter1611177 = new Ya.Metrika({ id:1611177, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, ecommerce:"dataLayer" }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/1611177" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
<?if ($USER->IsAuthorized()) {
	$rsCurUser = CUser::GetByID($USER->GetID());
    $arCurUser = $rsCurUser->Fetch();
	$userGTMData = (!empty($arCurUser["NAME"]) ? "'user_name' : '" . $arCurUser["NAME"] . "'," : "");
	$userGTMData .= (!empty($arCurUser["EMAIL"]) ? "'user_email' : '" . $arCurUser["EMAIL"] . "'," : "");
	$userGTMData .= (!empty($arCurUser["UF_GENDER"]) ? "'user_gender' : '" . $arCurUser["UF_GENDER"] . "'" : "");

	?>

	<script type="text/javascript">
	dataLayer = [{
		'userId' : <?= $USER->GetID() ?>,
		'event' : 'authentication',
		'userRegCategory' : 'UserRegistered',
		<?= $userGTMData ?>
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
<?include_once($_SERVER["DOCUMENT_ROOT"] . '/local/templates/.default/include/info_message_component.php');?>
<header>
    <a href="/">
        <div class="logo">
            <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    ".default",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "AREA_FILE_RECURSIVE" => "Y",
                        "EDIT_TEMPLATE" => "",
                        "COMPONENT_TEMPLATE" => ".default",
                        "PATH" => "/include/logo.php"
                    ),
                    false
                );?>
        </div>
    </a>
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
                "MENU_CACHE_USE_GROUPS" => "N",    // РЈС‡РёС‚С‹РІР°С‚СЊ РїСЂР°РІР° РґРѕСЃС‚СѓРїР°
                "MENU_CACHE_GET_VARS" => "",    // Р—РЅР°С‡РёРјС‹Рµ РїРµСЂРµРјРµРЅРЅС‹Рµ Р·Р°РїСЂРѕСЃР°
                ),
                false
            );?>
        </ul>
    </div>
	<?$frame = new \Bitrix\Main\Page\FrameBuffered("header");
	$frame->begin();?>
	<script>
		function basketOpenFlag() {
			$('.hidingBasketRight, .layout, .windowClose').toggle();
			if ($('.hidingBasketRight, .layout, .windowClose').css('display') == 'block') {
				$('html').css('overflow', 'hidden');
			} else {
				$('html').css('overflow', 'auto');
			}
		}

		$(document).ready(function(){
			$("#authorisationPopup").click(function() {
				$('.layout').show();

				var winH = $(window).height();
				var winW = $(window).width();
				var blokT = winH / 2 - ($('.authorisationWrapper').height() / 2);
				var blokL = winW / 2 - ($('.authorisationWrapper').width() / 2);
				$('.authorisationWrapper').css({
					"top": blokT,
					"left": blokL
				});

				$('.authorisationWrapper').show();
				return false;
			});
            setTimeout(function() { $('.lkWrapp').show() }, 800);

		});
	</script>
	<div class="lkWrapp" style="display: none;">
		<a href="/personal/cart/" onclick="basketOpenFlag();return false;">
			<div class="headBasket">
				<div class="BasketQuant"></div>
			</div>
		</a>

		<?if(CUser::IsAuthorized()) {?>
			<a href="/personal/cart/?liked=yes">
				<div class="headLiked">
					<?
					$curr_user = CUser::GetByID($USER -> GetID()) -> Fetch();
					$user = $curr_user["NAME"]." ".$curr_user["LAST_NAME"];
					$wishItemList = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 17, "NAME" => $user), false, false, array("NAME", "ID", "PROPERTY_PRODUCTS"));
					?>
					<div class="likedQuant"><?echo($wishItemList->SelectedRowsCount());?></div>
				</div>
			</a>
		<?}?>

		<a href="/personal/profile/" <?if (!$USER->IsAuthorized()){?>id="authorisationPopup"<?}?>>
			<div>
				<?echo !$USER->IsAuthorized() ? '<img src="/img/lkImg.png">' : '<img src="/img/lkImgBl.png">';?>
			</div>
		</a>

		<p class="telephone">
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
	<?$frame->beginStub();?>
    <?if(!CUser::IsAuthorized()) {?>
	<div class="lkWrapp" style="display: none;">
		<a href="/personal/cart/" onclick="basketOpenFlag();return false;">
			<div class="headBasket">
				<div class="BasketQuant" style="display: none;"></div>
			</div>
		</a>


		<a href="/personal/profile/" id="authorisationPopup">
			<div>
				<img src="/img/lkImg.png">
			</div>
		</a>

		<p class="telephone">
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
    <?}?>
	<?$frame->end();?>
</header>

