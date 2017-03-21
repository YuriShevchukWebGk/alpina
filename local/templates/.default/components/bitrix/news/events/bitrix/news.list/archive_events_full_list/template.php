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
<?/*
<div class="newsBodyWrap " id="events_wrap">
    <div class="centerWrapper">
        <div class="bx-newslist events_wrap_2">
            <?if($arParams["DISPLAY_TOP_PAGER"]) {?>
                <?=$arResult["NAV_STRING"]?><br />
            <?}?>
            <div class="row">
            
                <?foreach($arResult["ITEMS"] as $key => $arItem) {?>
                    <?//if($key >= 6){
                        if (time() > strtotime($arItem["DATE_ACTIVE_TO"])) {
                            $arItem["NAME"] = "<span style='color:rgb(210, 210, 210);'>".$arItem["NAME"]." (Р·Р°РІРµСЂС€РµРЅРѕ)</span>";
                        }?>
                        <? 
                            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        ?>
                        
                        <div class="bx-newslist-container col-sm-6 col-md-4" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                            <?if($arParams["DISPLAY_PICTURE"]!="N") {?>
                                <?if (is_array($arItem["PREVIEW_PICTURE"])) {?>
                                <div class="bx-newslist-img">
                                    <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])) {?>
                                        <img
                                            src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                                            width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
                                            height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
                                            alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                                            title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
                                            />
                                    <?} else {?>
                                        <img
                                            src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                                            width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
                                            height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
                                            alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                                            title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
                                            />
                                    <?}?>
                                </div>
                                <?}?>
                            <?}?>
                            <div class="bx-newslist-block">
                               
                                <?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]) {?>
                                    <h3 class="bx-newslist-title">
                                        <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])) {?>
                                            <span ><?echo $arItem["NAME"]?></span>
                                        <?} else {?>
                                            <?echo $arItem["NAME"]?>
                                        <?}?>
                                    </h3>
                                <?}?>
                                <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]) {?>
                                    <div class="bx-newslist-content">
                                        <?echo $arItem["PREVIEW_TEXT"];?>
                                    </div>
                                <?}?>
                                
                                <?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty) {?>
                                    <?
                                        if(is_array($arProperty["DISPLAY_VALUE"])) {
                                            $value = implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
                                        } else {
                                            $value = $arProperty["DISPLAY_VALUE"];
                                        }
                                    ?>
                                    <?if($arProperty["CODE"] == "FORUM_MESSAGE_CNT") {?>
                                        <div class="bx-newslist-comments"><i class="fa fa-comments"></i> <?=$arProperty["NAME"]?>:
                                            <?=$value;?>
                                        </div>
                                    <?} else if ($value != "") {?>
                                        <div class="bx-newslist-other"> <?=$arProperty["NAME"]?>:
                                            <?=$value;?>
                                        </div>
                                    <?}?>
                                <?}?>
                                <div class="row" id="date_wrap">
                                    <?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DATE_ACTIVE_FROM"]) {?>
                                        <div class="col-xs-5">
                                            <div class="bx-newslist-date"><i class="fa fa-calendar-o"></i> <?echo FormatDate("j F", MakeTimeStamp($arItem["DATE_ACTIVE_FROM"])).' - '.FormatDate("j F", MakeTimeStamp($arItem["DATE_ACTIVE_TO"])); ?></div>
                                        </div>
                                         
                                    <?}?>
                                    <?if($arParams["USE_RATING"]=="Y") {?>
                                        <div class="col-xs-7 text-right">
                                            <?$APPLICATION->IncludeComponent(
                                                    "bitrix:iblock.vote",
                                                    "flat",
                                                    Array(
                                                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                                        "ELEMENT_ID" => $arItem["ID"],
                                                        "MAX_VOTE" => $arParams["MAX_VOTE"],
                                                        "VOTE_NAMES" => $arParams["VOTE_NAMES"],
                                                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                                                        "DISPLAY_AS_RATING" => $arParams["DISPLAY_AS_RATING"],
                                                        "SHOW_RATING" => "N",
                                                    ),
                                                    $component
                                                );?>
                                        </div>
                                    <?}?>
                                </div>
                               
                            </div>
                            </a>
                        </div>
                    <?//}?>
                <?}?>
            </div>
             <span class="moreNews">РџРѕРєР°Р·Р°С‚СЊ РµС‰С‘</span>
        </div>
    </div>
</div>
<?*/?>
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
