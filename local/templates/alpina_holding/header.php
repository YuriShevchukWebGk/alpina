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
</head>
<body itemscope itemtype="http://schema.org/WebPage">
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<header>
    <div class="headerBackroundImage">
        <div class="headerLogo">
            <a href="/"><img src="/local/templates/alpina_holding/images/IAlpinaBooks.png"></a>
        </div>        
        <div class="headerText">
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_RECURSIVE" => "Y",
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => "/include/header_text.php"
                )
            );?>
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