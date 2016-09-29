<?
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");
    //CJSCore::Init(array("fx"));
    //$curPage = $APPLICATION->GetCurPage(true);
?>
<!doctype html>
<html>
<head>
    <title><?$APPLICATION->ShowTitle()?></title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    
    <script type="text/javascript" src="/js/fancybox-2/jquery.fancybox.js"></script>
    <script type="text/javascript" src="/js/fancybox-2/helpers/jquery.fancybox-thumbs.js"></script>
    <link rel="stylesheet" href="/css/style.css?<?=filemtime($_SERVER["DOCUMENT_ROOT"].'/css/style.css')?>" type="text/css">
    <?$APPLICATION->ShowHead();?>
	<meta name="yandex-verification" content="7771afb530c4322e" />
</head>
<body itemscope itemtype="http://schema.org/WebPage">
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-MT3TZF"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MT3TZF');</script>
<!-- End Google Tag Manager -->
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<header>
    <div class="headerBackroundImage">
        <div class="headerLogo">
            <a href="/"><img src="/local/templates/alpina_holding/images/IAlpinaBooks.png"></a>
        </div>        
        <div class="headerText">
            <?/*$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_RECURSIVE" => "Y",
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => "/include/header_text.php"
                )
            );*/?>
        </div>
        <div class="headerPublisherRibbon">
            <?$APPLICATION->IncludeComponent(
	            "bitrix:main.include", 
	            ".default", 
	            array(
		            "AREA_FILE_RECURSIVE" => "Y",
		            "AREA_FILE_SHOW" => "sect",
		            "AREA_FILE_SUFFIX" => "inc",
		            "EDIT_TEMPLATE" => "",
		            "PATH" => "/include/header_text.php",
		            "COMPONENT_TEMPLATE" => ".default"
	            ),
	            false
            );?>
        </div>
    </div>
</header>