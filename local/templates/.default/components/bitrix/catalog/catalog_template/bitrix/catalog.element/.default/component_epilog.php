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
        function buy_certificate_popup(){
            $('.layout').show();
            $('.certificate_popup').show();                                                
        }                                               
        function create_certificate_order(){
            var form_valid = true;
            var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
            // просматриваем все поля на предмет заполненности
            $(".active_certificate_block input").each(function(){
                if (!$(this).val()) {   
                    form_valid = false;
                    $(this).css("border-color", "red");    
                } else {
                    if ($(this).attr("name") == 'natural_email' || $(this).attr("name") == 'legal_email') {                      
                        if (!(pattern.test($(this).val()))) {    
                            form_valid = false;
                            $(this).css("border-color", "red");
                        } else {
                            $(this).css("border-color", "#f0f0f0");   
                        }       
                    }                                     
                }
            });                   
            // если все ок, то сабмитим
            if (form_valid) {
                var natural_person_email = $("#natural_email").val(),
                selected_tab = $(".certificate_tab_active").data("popup-block");
                $("input[name='certificate_quantity']").val($(".transparent_input").val());
                var certificate_price = parseInt($("input[name='certificate_price']").val()); 
                var certificate_quantity = parseInt($(".transparent_input").val()); 
                $.ajax({
                    url: '/ajax/ajax_create_certificate_order.php',
                    type: "POST",
                    data: {
                        data: $("#certificate_form").serialize(),
                        person_type: selected_tab
                    }
                }).done(function(result) {
                    var certificate_result = JSON.parse(result);
                    if (certificate_result.status == "success") {
                        order_id = certificate_result.data;
                        $("#certificate_form").remove();
                        if (selected_tab == "natural_person") {
                            // физ. лицо
                            var success_message = "<?= GetMessage('NATURAL_SUCCESS_MESSAGE') ?>"; 
                            $(".submit_rfi").attr("data-email", natural_person_email);  
                            $(".submit_rfi").attr("data-comment", "CERT_" + order_id);  
                            $(".submit_rfi").attr("data-orderid", "CERT_" + order_id);         
                            $(".submit_rfi").attr("data-cost", certificate_price * certificate_quantity);   
                            $(".submit_rfi").click();
                            $("<span>" + success_message.replace("#NUM#", order_id) + "</span>").insertBefore(".certificate_popup_close");
                        } else {
                            // юр. лицо
                            var success_message = "<?= GetMessage('LEGAL_SUCCESS_MESSAGE') ?>";
                            $("<span>" + success_message.replace("#NUM#", order_id) + "</span>").insertBefore(".certificate_popup_close");
                        }
                    } else {
                        console.error(certificate_result.data);
                    }
                });
            }
        }
        // переключение табов в попапе
        $(".certificate_buy_type li").click(function() {
            if(!$(this).hasClass("certificate_tab_active")) {
                $(".certificate_buy_type li").removeClass("certificate_tab_active");
                $(this).addClass("certificate_tab_active");
                $(".popup_form_data > div").removeClass("active_certificate_block");
                $("div[class='" + $(this).data("popup-block") + "']").addClass("active_certificate_block");
            }
        });
        // закрытие попапа
        $(".certificate_popup_close").click(function(){
            $(".certificate_popup").hide();
            $('.layout').hide();
        })
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
    $title = GetMessage("BOOK") . '«' . $arResult["NAME"] . '» ' . $author_name . ' ' . $arResult["PROPERTIES"]["YEAR"]["VALUE"] . " г. — ".  GetMessage("TO_BUY_WITH_DELIVERY").' / ISBN ' . $arResult['PROPERTIES']["ISBN"]["VALUE"];
} else if ($MEDIA_TYPE) {
    $title = $arResult["NAME"] . ' ' . $author_name . ' / ISBN ' . $arResult['PROPERTIES']["ISBN"]["VALUE"] .  GetMessage("TO_BUY_WITH_DELIVERY");
} else {
    $title = GetMessage("BOOK") . '«' . $arResult["NAME"] . '» ' . $author_name . ' ' . $arResult["PROPERTIES"]["YEAR"]["VALUE"] . " г. — ".  GetMessage("TO_BUY_WITH_DELIVERY");
}
if (!empty ($title) )  {
    $APPLICATION -> SetPageProperty("title", $title);
}
$curr_elem_info = CIBlockElement::GetByID($arResult["ID"]) -> Fetch();
$APPLICATION->SetPageProperty("description", $curr_elem_info["PREVIEW_TEXT"]); 
$APPLICATION->SetPageProperty("keywords", GetMessage("KEYWORDS"));

if($arResult['IBLOCK_SECTION_ID']=='132' || $arResult['IBLOCK_SECTION_ID']=='133'){
	$sect_name = $arResult['IPROPERTY_VALUES']['SECTION_PAGE_TITLE']!=''?$arResult['IPROPERTY_VALUES']['SECTION_PAGE_TITLE']:$arResult['SECTION']['NAME'];
	$key_name = preg_replace('/[^\w\s]/u', "", strtolower($arResult["NAME"]) );
	$APPLICATION->SetPageProperty("description", 'Издательство Альпина Паблишер предлагает купить книгу '.$arResult["NAME"].', автор '.$author_name.' и другие книги в разделе "'.$sect_name.'" в собственном интернет-магазине. Доступны печатные и цифровые версии.'); 
	$APPLICATION->SetPageProperty("keywords", 'купить книга '.$key_name);
	$APPLICATION->SetPageProperty("keywords-new", 'купить книга '.$key_name);
}
	
$APPLICATION->AddHeadString('<meta property="og:title" content=\''.$APPLICATION->GetPageProperty('title').'\' />',false);
$APPLICATION->AddHeadString('<meta property="og:description" content=\''.strip_tags($APPLICATION->GetPageProperty('description')).'\' />',false);
$APPLICATION->AddHeadString('<meta property="og:image" content="https://'.SITE_SERVER_NAME.$templateData["OG_IMAGE"].'" />',false);
$APPLICATION->AddHeadString('<meta property="og:type" content="website" />',false);
$APPLICATION->AddHeadString('<meta property="og:url" content="'.'https://'.SITE_SERVER_NAME.$APPLICATION->GetCurPage().'" />',false);
$APPLICATION->AddHeadString('<meta property="og:site_name" content="ООО «Альпина Паблишер»" />',false);
$APPLICATION->AddHeadString('<meta property="og:locale" content="ru_RU" />',false);
$APPLICATION->AddHeadString('<meta name="relap-title" content="'.$arResult["NAME"].'">',false);
$APPLICATION->AddHeadString('<link rel="prefetch" href="'.$arResult["MAIN_PICTURE"].'">',false);
// $APPLICATION->SetPageProperty('FACEBOOK_META', $fb_meta);   
?>