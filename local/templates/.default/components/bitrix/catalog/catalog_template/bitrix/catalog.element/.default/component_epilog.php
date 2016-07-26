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
// так как в component_epilog.php недоступен $arResult["AUTHOR_NAME"], используем функционал из result_modifier.php
$author_name = '';
if (!is_array($arResult['PROPERTIES']['AUTHORS']['VALUE'])
    && !empty($arResult['PROPERTIES']['AUTHORS']['VALUE'])) {
        $arResult['PROPERTIES']['AUTHORS']['VALUE'] = array($arResult['PROPERTIES']['AUTHORS']['VALUE']);
}
foreach ($arResult['PROPERTIES']['AUTHORS']['VALUE'] as $AUTHOR_KEY => $author) {
    if (!empty ($arResult['PROPERTIES']['AUTHORS']['VALUE'][$AUTHOR_KEY]) ) {
        $aElProperties = CIBlockElement::GetByID($arResult['PROPERTIES']['AUTHORS']['VALUE'][$AUTHOR_KEY])->GetNext();
        $aElProperties['LAST_NAME'] = CIBlockElement::GetProperty(AUTHORS_IBLOCK_ID,  $arResult['PROPERTIES']['AUTHORS']['VALUE'][$AUTHOR_KEY],  array(),  array('CODE' => 'LAST_NAME'))->Fetch();
        $aElProperties['FIRST_NAME'] = CIBlockElement::GetProperty(AUTHORS_IBLOCK_ID,  $arResult['PROPERTIES']['AUTHORS']['VALUE'][$AUTHOR_KEY],  array(),  array('CODE' => 'FIRST_NAME'))->Fetch();
        $aElProperties['SHOWINAUTHORS'] = CIBlockElement::GetProperty(AUTHORS_IBLOCK_ID,  $arResult['PROPERTIES']['AUTHORS']['VALUE'][$AUTHOR_KEY],  array(),  array('CODE' => 'SHOWINAUTHORS'))->Fetch();
        $aElProperties['ORIG_NAME'] = CIBlockElement::GetProperty(AUTHORS_IBLOCK_ID,  $arResult['PROPERTIES']['AUTHORS']['VALUE'][$AUTHOR_KEY],  array(),  array('CODE' => 'ORIG_NAME'))->Fetch();

        if (strlen ($aElProperties['FIRST_NAME']['VALUE']) > 0) {
            $author_name .= (strlen ($author_name) > 0 ? ', ' : '') . $aElProperties['FIRST_NAME']['VALUE'];
        }
        if (strlen ($aElProperties['LAST_NAME']['VALUE']) > 0) {
            $author_name .= (strlen ($author_name) > 0 ? ' ' : '') . $aElProperties['LAST_NAME']['VALUE'];
        }
        if (strlen ($aElProperties['ORIG_NAME']['VALUE']) > 0) {
            $author_name .= " / " . (strlen ($author_name) > 0 ? ' ' : '') . $aElProperties['ORIG_NAME']['VALUE'];
        }
    }
} 
if (strlen ($arResult['PROPERTIES']["ISBN"]["VALUE"]) ) {
    $title = GetMessage("BOOK") . '«' . $arResult["NAME"] . '» ' . $author_name . ' / ISBN ' . $arResult['PROPERTIES']["ISBN"]["VALUE"] .  GetMessage("TO_BUY_WITH_DELIVERY");
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
?>