<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (!CModule::IncludeModule("mobileapp")) die();

CMobile::Init();
IncludeTemplateLangFile(__FILE__);
?>
<!DOCTYPE html>
<html<?=$APPLICATION->ShowProperty("Manifest");?> class="<?=CMobile::$platform;?>">
<head>
	<?$APPLICATION->ShowHead();?>
	<meta http-equiv="Content-Type" content="text/html;charset=<?=SITE_CHARSET?>"/>
	<meta name="format-detection" content="telephone=no">
	<!--<link href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/template_styles.css")?>" type="text/css" rel="stylesheet" />-->
	<?//$APPLICATION->ShowHeadStrings();?>
	<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/script.js");?>
	<?CJSCore::Init('ajax');?>
	<title><?$APPLICATION->ShowTitle()?></title>
    
    
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
	<?$APPLICATION->ShowProperty('FACEBOOK_META');?>
</head>
<?$APPLICATION->IncludeComponent("bitrix:eshopapp.data","",Array(
),false, Array("HIDE_ICONS" => "Y"));
?>
<body id="body" class="<?=$APPLICATION->ShowProperty("BodyClass");?>" itemscope itemtype="http://schema.org/WebPage">
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-PM87GH"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PM87GH');</script>
<!-- End Google Tag Manager -->
<?if (!CMobile::getInstance()->getDevice()) $APPLICATION->ShowPanel();?>

<script type="text/javascript">
	app.pullDown({
		enable:true,
		callback:function(){document.location.reload();},
		downtext:"<?=GetMessage("MB_PULLDOWN_DOWN")?>",
		pulltext:"<?=GetMessage("MB_PULLDOWN_PULL")?>",
		loadtext:"<?=GetMessage("MB_PULLDOWN_LOADING")?>"
	});
</script>
<?
if ($APPLICATION->GetCurPage(true) != SITE_DIR."eshop_app/personal/cart/index.php")
{
?>
	<script type="text/javascript">
		app.addButtons({menuButton: {
			type:    'basket',
			style:   'custom',
			callback: function()
			{
				app.openNewPage("<?=SITE_DIR?>eshop_app/personal/cart/");
			}
		}});
	</script>
<?
}
?>
<div class="wrap">
<?
?>