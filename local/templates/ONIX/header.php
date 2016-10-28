<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");
    CJSCore::Init(array("fx"));
    $curPage = $APPLICATION->GetCurPage(true);
    $theme = COption::GetOptionString("main", "wizard_eshop_bootstrap_theme_id", "blue", SITE_ID);
?>

<!doctype html>
<html>
<head>
   
    <title><?$APPLICATION->ShowTitle()?></title>
   

    <?$APPLICATION->ShowHead();?>
    
</head>
<body itemscope itemtype="http://schema.org/WebPage">
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<a href="/bitrix/">перейти в административный раздел</a>