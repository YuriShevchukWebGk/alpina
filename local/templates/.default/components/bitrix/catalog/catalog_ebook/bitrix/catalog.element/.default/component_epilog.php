<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
use Bitrix\Main\Loader;
global $APPLICATION;
if (isset($templateData['TEMPLATE_THEME']))
{
	$APPLICATION->SetAdditionalCSS($templateData['TEMPLATE_THEME']);
}
if (isset($templateData['TEMPLATE_LIBRARY']) && !empty($templateData['TEMPLATE_LIBRARY']))
{
	$loadCurrency = false;
	if (!empty($templateData['CURRENCIES']))
		$loadCurrency = Loader::includeModule('currency');
	CJSCore::Init($templateData['TEMPLATE_LIBRARY']);
	if ($loadCurrency)
	{
	?>   
	<script type="text/javascript">
		BX.Currency.setCurrencies(<? echo $templateData['CURRENCIES']; ?>);  
    </script>
<?
	}
}
if (isset($templateData['JS_OBJ']))
{
?><script type="text/javascript">
BX.ready(BX.defer(function(){
	if (!!window.<? echo $templateData['JS_OBJ']; ?>)
	{
		window.<? echo $templateData['JS_OBJ']; ?>.allowViewedCount(true);
	}
}));
</script><?
}
// установка мета-свойств заголовка и описания
// так как в component_epilog.php недоступен $arResult["AUTHOR_NAME"] и $arResult["PREVIEW_TEXT"], используем функционал из result_modifier.php
$author_name = '';
$ar_properties = array();
if (!is_array($arResult['PROPERTIES']['AUTHORS']['VALUE'])
    && !empty($arResult['PROPERTIES']['AUTHORS']['VALUE'])) {
        $arResult['PROPERTIES']['AUTHORS']['VALUE'] = array($arResult['PROPERTIES']['AUTHORS']['VALUE']);
}    
$authors_IDs = $arResult['PROPERTIES']['AUTHORS']['VALUE'];
if (!empty($authors_IDs)) {
    $authors_list = CIBlockElement::GetList (
        array(), 
        array("IBLOCK_ID" => AUTHORS_IBLOCK_ID, "ID" => $authors_IDs), 
        false, 
        false, 
        array(
            "ID", 
			"PROPERTY_LAST_NAME", 
            "PROPERTY_FIRST_NAME", 
            "PROPERTY_ALT_NAME", 
            "PROPERTY_ORIG_NAME"
        )
    );

    while ($authors = $authors_list -> Fetch()) {
        $ar_properties["ALT_NAME"] = $authors["PROPERTY_ALT_NAME_VALUE"];
        $ar_properties["ORIG_NAME"] = $authors["PROPERTY_ORIG_NAME_VALUE"];

        if (strlen ($ar_properties['ALT_NAME']) > 0) {
            $author_name .= (strlen ($author_name) > 0 ? ', ' : '') . $ar_properties['ALT_NAME'];
        } else {
			if (strlen ($ar_properties['FIRST_NAME']) > 0) {
				$author_name .= (strlen ($author_name) > 0 ? ', ' : '') . $ar_properties['FIRST_NAME'];
			}
			if (strlen ($ar_properties['LAST_NAME']) > 0) {
				$author_name .= (strlen ($author_name) > 0 ? ' ' : '') . $ar_properties['LAST_NAME'];
			}
		}
    }
} 

//print_r($arResult["PROPERTIES"]);


$title = $arResult["PROPERTIES"]["SHORT_NAME"]["VALUE"];

if(strlen($arResult["PROPERTIES"]["SECOND_NAME"]["VALUE"])){
	$title .= '. ' . $arResult["PROPERTIES"]["SECOND_NAME"]["VALUE"];
}

$title .= " - ". $arResult["AUTHOR_NAME"] ." - ";

if (strlen($arResult['PROPERTIES']["ISBN"]["VALUE"])){
	$title .= 'купить электронную книгу, | читать цифровую книгу бесплатно онлайн';
}

$APPLICATION->SetPageProperty("title", $title);

if (!empty($arResult['TAGS']))
	$APPLICATION->SetPageProperty("keywords", $arResult["TAGS"]);
else
	$APPLICATION->SetPageProperty("keywords", GetMessage("KEYWORDS"));

$sect_name = $arResult['IPROPERTY_VALUES']['SECTION_PAGE_TITLE']!=''?$arResult['IPROPERTY_VALUES']['SECTION_PAGE_TITLE']:$arResult['SECTION']['NAME'];
$key_name = preg_replace('/[^\w\s]/u', "", strtolower($arResult["NAME"]) );
$description = '📕 Купить электронную книгу: ' . $arResult["PROPERTIES"]["SHORT_NAME"]["VALUE"] .'. '. $arResult["PROPERTIES"]["SECOND_NAME"]["VALUE"] . '; ' .$arResult["PROPERTIES"]["COVER_TYPE"]["VALUE"]. '; дата издания: ' . $arResult["PROPERTIES"]["YEAR"]["VALUE"] . '; 💳 цена ' . round(($arResult["PROPERTIES"]["alpina_digital_price"]["VALUE"]), 2) . ' &#8381; формат epub.';

$APPLICATION->SetPageProperty("description", $description); 

$APPLICATION->SetPageProperty("keywords-new", 'купить книга '.$key_name);
	
$APPLICATION->AddHeadString('<meta property="og:title" content=\''.$APPLICATION->GetPageProperty('title').'\' />',false);
$APPLICATION->AddHeadString('<meta property="og:description" content=\''.strip_tags($APPLICATION->GetPageProperty('description')).'\' />',false);
$APPLICATION->AddHeadString('<meta property="og:image" content="https://'.SITE_SERVER_NAME.$templateData["OG_IMAGE"].'" />',false);
$APPLICATION->AddHeadString('<meta property="og:type" content="website" />',false);
$APPLICATION->AddHeadString('<meta property="og:url" content="'.$arResult["CANONICAL_PAGE_URL"].'" />',false);
$APPLICATION->AddHeadString('<meta property="og:site_name" content="ООО «Альпина Паблишер»" />',false);
$APPLICATION->AddHeadString('<meta property="og:locale" content="ru_RU" />',false);
$APPLICATION->AddHeadString('<meta name="relap-title" content="'.$arResult["NAME"].'">',false);
$APPLICATION->AddHeadString('<link rel="prefetch" href="'.$arResult["MAIN_PICTURE"].'">',false);

$APPLICATION->AddHeadString('<meta name="twitter:card" content="summary">');
$APPLICATION->AddHeadString('<meta name="twitter:site" content="@alpinabookru" />');
$APPLICATION->AddHeadString('<meta name="twitter:title" content=\''.$APPLICATION->GetPageProperty('title').'\' />',false);
$APPLICATION->AddHeadString('<meta name="twitter:description" content=\''.strip_tags($APPLICATION->GetPageProperty('description')).'\' />',false);
$APPLICATION->AddHeadString('<meta name="twitter:image" content="https://'.SITE_SERVER_NAME.$templateData["OG_IMAGE"].'" />',false);
$APPLICATION->AddHeadString('<meta name="twitter:url" content="'.$arResult["CANONICAL_PAGE_URL"].'" />',false);

if ('https://'.SITE_SERVER_NAME.$APPLICATION->GetCurPageParam() != $arResult["CANONICAL_PAGE_URL"]) {
	$APPLICATION->AddHeadString('<link rel="canonical" href="'.$arResult["CANONICAL_PAGE_URL"].'" />',false);
}
?>
