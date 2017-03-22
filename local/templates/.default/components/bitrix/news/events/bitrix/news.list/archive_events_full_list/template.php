<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$this->addExternalCss("/bitrix/css/main/bootstrap.css");
$this->addExternalCss("/bitrix/css/main/font-awesome.css");
$this->addExternalCss($this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css');
?>
<div class="deliveryPageTitleWrap">
    <div class="centerWrapper">
        <p><?= GetMessage("MAIN_PAGE") ?></p>
        <h1><?= GetMessage("EVENTS_ARCHIVE") ?></h1>
    </div>
</div>
<script>
// С„СѓРЅРєС†РёСЏ РїРѕ СЂР°СЃРєСЂС‹С‚РёСЋ РґРѕРїРѕР»РЅРёС‚РµР»СЊРЅС‹С… СЌР»РµРјРµРЅС‚РѕРІ СЃРїРёСЃРєР° РЅРѕРІРѕСЃС‚РµР№ РїСЂРё РЅР°Р¶Р°С‚РёРё РЅР° "РџРѕРєР°Р·Р°С‚СЊ РµС‰С‘"
$(document).ready(function() {
        <?$navnum = $arResult["NAV_RESULT"]->NavNum;?>
        <?if (isset($_REQUEST["PAGEN_".$navnum])) {?>
            var page = <?=$_REQUEST["PAGEN_".$navnum]?> + 1;
        <?}else{?>
            var page = 2;
        <?}?>
        var maxpage = <?=($arResult["NAV_RESULT"]->NavPageCount)?>;
            $('.moreNews').click(function(){
                $.fancybox.showLoading();
                $.get('<?=$arResult["SECTION_PAGE_URL"]?>?PAGEN_<?=$navnum?>='+page, function(data) {
                    var next_page_top = $('.events_wrap_top > .row .bx-newslist-container', data);
                    var next_page_bottom = $('.events_wrap_2 > .row .bx-newslist-container', data);
                    $('.events_wrap_2 > .row').append(next_page_top);
                    $('.events_wrap_2 > .row').append(next_page_bottom);
                    page++;            
                })
                .done(function() {
                    $.fancybox.hideLoading();
                    $(".bx-newslist-content").each(function() {
                        if($(this).length > 0) {
                            $(this).html(truncate($(this).html(), 280));    
                        }    
                    })
    
                });
                if (page == maxpage) {
                    $('.moreNews').hide();
                }
                return false;
            });
    });
</script>  
