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
            "PROPERTY_SHOWINAUTHORS", 
            "PROPERTY_ORIG_NAME"
        )
    );

    while ($authors = $authors_list -> Fetch()) {
        $ar_properties["LAST_NAME"] = $authors["PROPERTY_LAST_NAME_VALUE"];
        $ar_properties["FIRST_NAME"] = $authors["PROPERTY_FIRST_NAME_VALUE"];
        $ar_properties["SHOWINAUTHORS"] = $authors["PROPERTY_SHOWINAUTHORS_VALUE"];
        $ar_properties["ORIG_NAME"] = $authors["PROPERTY_ORIG_NAME_VALUE"];

        if (strlen ($ar_properties['FIRST_NAME']) > 0) {
            $author_name .= (strlen ($author_name) > 0 ? ', ' : '') . $ar_properties['FIRST_NAME'];
        }
        if (strlen ($ar_properties['LAST_NAME']) > 0) {
            $author_name .= (strlen ($author_name) > 0 ? ' ' : '') . $ar_properties['LAST_NAME'];
        }
        if (strlen ($ar_properties['ORIG_NAME']) > 0) {
            $author_name .= " (".$ar_properties['ORIG_NAME'].")";
        }
    }
} 
if (strlen ($arResult['PROPERTIES']["ISBN"]["VALUE"]) ) {
    $title = GetMessage("BOOK") . '«' . $arResult["NAME"] . '» ' . $author_name ." — ".  GetMessage("TO_BUY_WITH_DELIVERY").' / ISBN ' . $arResult['PROPERTIES']["ISBN"]["VALUE"];
} else if ($MEDIA_TYPE) {
    $title = $arResult["NAME"] . ' ' . $author_name . ' / ISBN ' . $arResult['PROPERTIES']["ISBN"]["VALUE"] .  GetMessage("TO_BUY_WITH_DELIVERY");
} else {
    $title = $arResult["NAME"] . ' ' . $author_name . GetMessage("TO_BUY_WITH_DELIVERY");    
}
if (!empty ($title) )  {
    $APPLICATION -> SetPageProperty("title", $title);
}
$curr_elem_info = CIBlockElement::GetByID($arResult["ID"]) -> Fetch();
$APPLICATION->SetPageProperty("description", $curr_elem_info["PREVIEW_TEXT"]); 
$APPLICATION->SetPageProperty("keywords", GetMessage("KEYWORDS"));
?>