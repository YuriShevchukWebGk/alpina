<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?>
<html lang="ru">
<head>
<!--eski.mobi--><script class="eskimobi" data-type="mobile">!function(a,b,c,d,e){function g(a,c,d,e){var f=b.getElementsByTagName("script")[0];e.src?a.src=e.src:e.innerHTML&&(a.innerHTML=e.innerHTML),a.id=c,a.setAttribute("class",d),f.parentNode.insertBefore(a,f)}a.Mobify={points:[+new Date]};var f=/((; )|#|&|^)mobify=(\d)/.exec(location.hash+"; "+b.cookie);if(f&&f[3]){if(!+f[3])return}else if(!c())return;b.write('<div id="eski-overlay" style="font-family:Helvetica-Light,Helvetica,Arial,sans-serif;font-weight:light;font-size:300%;line-height:100%;position:absolute;top:42%;left:0;right:0;text-align:center;color: #999;">\u0417\u0430\u0433\u0440\u0443\u0437\u043A\u0430...</div><plaintext style="display:none">'),setTimeout(function(){var c=a.Mobify=a.Mobify||{};c.capturing=!0;var f=b.createElement("script"),h=function(){var c=new Date;c.setTime(c.getTime()+18e5),b.cookie="mobify=0; expires="+c.toGMTString()+"; path=/",a.location=a.location.href};f.onload=function(){if(e){var a=b.createElement("script");if(a.onerror=h,"string"==typeof e)g(a,"main-executable","mobify",{src:e});else{var c="var main = "+e.toString()+"; main();";g(a,"main-executable","mobify",{innerHTML:c})}}},f.onerror=h,g(f,"mobify-js","mobify",{src:d})})}(window,document,function(){var ua=navigator.userAgent||navigator.vendor||window.opera,m=false;if(/mobi|phone|ipod|nokia|android/i.test(ua))m=true;if(/msie|windows|media\scenter|opera\smini|ipad|android\s3|android\s2|iphone\sos\s(4|5|6)|ipad\sos\s(4|5|6)/i.test(ua)||screen.width>1024)m=false;return m;},"/eskimobi/eski.mobi.min.js?20170906","/eskimobi/mobi.js?20171018");</script><!--/eski.mobi-->
<?$APPLICATION->ShowHead();?>
<title><?$APPLICATION->ShowTitle()?></title>
    <script src="/js/fxSlider.js"></script>
    <script type="text/javascript">
//                alert(screen.width) ;
        if (screen.width<=360) {
            $('head').append('<meta name="viewport" content="user-scalable=yes, initial-scale=0.3, maximum-scale=0.8, width=device-width">');
        } else if(screen.width<=415){
            $('head').append('<meta name="viewport" content="user-scalable=yes, initial-scale=0.5, maximum-scale=0.8, width=device-width">');
        } else if(screen.width<=960){
            $('head').append('<meta name="viewport" content="user-scalable=yes, initial-scale=0.8, maximum-scale=0.8, width=device-width">');
        } else if (screen.width<1024) {
            $('head').append('<meta name="viewport" content="user-scalable=yes, initial-scale=0.5, maximum-scale=0.8, width=device-width">');
        }
    </script> 
	
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
	
	<?$APPLICATION->ShowProperty('FACEBOOK_META');?>
	<?include($_SERVER["DOCUMENT_ROOT"] . '/custom-scripts/ab_tests.php'); //Хардовые AB-тесты?>
	<!-- header .default -->
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgcolor="#FFFFFF" itemscope itemtype="https://schema.org/WebPage">
<!-- Yandex.Metrika counter --> <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter1611177 = new Ya.Metrika({ id:1611177, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, ecommerce:"dataLayer" }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/1611177" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
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
<?$APPLICATION->ShowPanel()?>

<?if($USER->IsAdmin()):?>

<div style="border:red solid 1px">
	<form action="/bitrix/admin/site_edit.php" method="GET">
		<input type="hidden" name="LID" value="<?=SITE_ID?>" />
		<p><font style="color:red"><?echo GetMessage("DEF_TEMPLATE_NF")?> </font></p>
		<input type="submit" name="set_template" value="<?echo GetMessage("DEF_TEMPLATE_NF_SET")?>" />
	</form>
</div>

<?endif?>