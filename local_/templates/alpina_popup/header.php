<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");
    CJSCore::Init(array("fx"));
    $curPage = $APPLICATION->GetCurPage(true);
    $theme = COption::GetOptionString("main", "wizard_eshop_bootstrap_theme_id", "blue", SITE_ID);
?>
<!doctype html>
<html class="finishOrder">
<head>
    <!--<meta http-equiv="Content-type" content="text/html; charset=utf-8"> -->
    <title><?$APPLICATION->ShowTitle()?></title> 
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>   
    
    <link rel="stylesheet" href="/css/style.css" type="text/css">
    <link rel="stylesheet" href="/css/easySlider.css" type="text/css">

    <script type="text/javascript" src="/js/fancybox-2/jquery.fancybox.js"></script>
    <script type="text/javascript" src="/js/fancybox-2/helpers/jquery.fancybox-thumbs.js"></script>

    <script src="/js/circle-progress.js"></script>
    <script src="/js/jquery.appear.js"></script>
    <script src="/js/easySlider.js"></script>
    <script src="/js/inputmask.js"></script>

    <script src="/js/main.js"></script> 

    <link rel="stylesheet" type="text/css" href="/js/fancybox-2/jquery.fancybox.css" id="fancycss" media="screen" />
    <link rel="stylesheet" type="text/css" href="/js/fancybox-2/helpers/jquery.fancybox-thumbs.css" id="fancycss" media="screen" />       
  
    
    <?$APPLICATION->ShowHead();?>
    <?$APPLICATION->ShowProperty('FACEBOOK_META');?>
    
    
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
</head>
<body itemscope itemtype="http://schema.org/WebPage">
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
