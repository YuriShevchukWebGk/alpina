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

<div class="newsPageTitleWrap">
    <div class="centerWrapper">
        <p>Главная</p>
        <? 
            if (strstr($APPLICATION -> GetCurDir(), "events", true) != "")
            {?>
            <h1>Мероприятия</h1>
            <?
            }
            else if (strstr($APPLICATION -> GetCurDir(), "news", true) != "")
            {
            ?>
            <h1>Новости</h1>
            <?
            }
        ?>
    </div>
</div>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"main_banners", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "main_banners",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "DETAIL_PICTURE",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "48",
		"IBLOCK_TYPE" => "news",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "LINK",
			2 => "",
		),
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	),
	false
);?>
<div class="newsBodyWrap">
    <div class="centerWrapper">
        <div class="bx-newslist">
            <?if($arParams["DISPLAY_TOP_PAGER"]):?>
                <?=$arResult["NAV_STRING"]?><br />
                <?endif;?>
            <div class="row">
                <?foreach($arResult["ITEMS"] as $arItem):?>
                    <? 
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="bx-newslist-container col-sm-6 col-md-4" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <div class="bx-newslist-block">
                            <?if($arParams["DISPLAY_PICTURE"]!="N"):?>
                                <?if ($arItem["VIDEO"]):?>
                                    <div class="bx-newslist-youtube embed-responsive embed-responsive-16by9" style="display: block;">
                                        <iframe
                                            src="<?echo $arItem["VIDEO"]?>"
                                            frameborder="0"
                                            allowfullscreen=""
                                            ></iframe>
                                    </div>
                                    <?elseif ($arItem["SOUND_CLOUD"]):?>
                                    <div class="bx-newslist-audio">
                                        <iframe
                                            width="100%"
                                            height="166"
                                            scrolling="no"
                                            frameborder="no"
                                            src="https://w.soundcloud.com/player/?url=<?echo urlencode($arItem["SOUND_CLOUD"])?>&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"
                                            ></iframe>
                                    </div>
                                    <?elseif ($arItem["SLIDER"] && count($arItem["SLIDER"]) > 1):?>
                                    <div class="bx-newslist-slider">
                                        <div class="bx-newslist-slider-container" style="width: <?echo count($arItem["SLIDER"])*100?>%;left: 0;">
                                            <?foreach ($arItem["SLIDER"] as $file):?>
                                                <div style="width: <?echo 100/count($arItem["SLIDER"])?>%;" class="bx-newslist-slider-slide">
                                                    <img src="<?=$file["SRC"]?>" alt="<?=$file["DESCRIPTION"]?>">
                                                </div>
                                                <?endforeach?>
                                            <div style="clear: both;"></div>
                                        </div>
                                        <div class="bx-newslist-slider-arrow-container-left"><div class="bx-newslist-slider-arrow"><i class="fa fa-angle-left" ></i></div></div>
                                        <div class="bx-newslist-slider-arrow-container-right"><div class="bx-newslist-slider-arrow"><i class="fa fa-angle-right"></i></div></div>
                                        <ul class="bx-newslist-slider-control">
                                            <?foreach ($arItem["SLIDER"] as $i => $file):?>
                                                <li rel="<?=($i+1)?>" <?if (!$i) echo 'class="current"'?>><span></span></li>
                                                <?endforeach?>
                                        </ul>
                                    </div>
                                    <script type="text/javascript">
                                        BX.ready(function() {
                                            new JCNewsSlider('<?=CUtil::JSEscape($this->GetEditAreaId($arItem['ID']));?>', {
                                                imagesContainerClassName: 'bx-newslist-slider-container',
                                                leftArrowClassName: 'bx-newslist-slider-arrow-container-left',
                                                rightArrowClassName: 'bx-newslist-slider-arrow-container-right',
                                                controlContainerClassName: 'bx-newslist-slider-control'
                                            });
                                        });
                                    </script>
                                    <?elseif ($arItem["SLIDER"]):?>
                                    <div class="bx-newslist-img">
                                        <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                                            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img
                                                src="<?=$arItem["SLIDER"][0]["SRC"]?>"
                                                width="<?=$arItem["SLIDER"][0]["WIDTH"]?>"
                                                height="<?=$arItem["SLIDER"][0]["HEIGHT"]?>"
                                                alt="<?=$arItem["SLIDER"][0]["ALT"]?>"
                                                title="<?=$arItem["SLIDER"][0]["TITLE"]?>"
                                                /></a>
                                            <?else:?>
                                            <img
                                                src="<?=$arItem["SLIDER"][0]["SRC"]?>"
                                                width="<?=$arItem["SLIDER"][0]["WIDTH"]?>"
                                                height="<?=$arItem["SLIDER"][0]["HEIGHT"]?>"
                                                alt="<?=$arItem["SLIDER"][0]["ALT"]?>"
                                                title="<?=$arItem["SLIDER"][0]["TITLE"]?>"
                                                />
                                            <?endif;?>
                                    </div>
                                    <?elseif (is_array($arItem["PREVIEW_PICTURE"])):?>
                                    <div class="bx-newslist-img">
                                        <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                                            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img
                                                src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                                                width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
                                                height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
                                                alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                                                title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
                                                /></a>
                                            <?else:?>
                                            <img
                                                src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                                                width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
                                                height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
                                                alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                                                title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
                                                />
                                            <?endif;?>
                                    </div>
                                    <?endif;?>
                                <?endif;?>
                            <?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
                                <h3 class="bx-newslist-title">
                                    <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                                        <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a>
                                        <?else:?>
                                        <?echo $arItem["NAME"]?>
                                        <?endif;?>
                                </h3>
                                <?endif;?>
                            <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
                                <div class="bx-newslist-content">
                                    <?echo $arItem["PREVIEW_TEXT"];?>
                                </div>
                                <?endif;?>
                            <?foreach($arItem["FIELDS"] as $code=>$value):?>
                                <?if($code == "SHOW_COUNTER"):?>
                                    <div class="bx-newslist-view"><i class="fa fa-eye"></i> <?=GetMessage("IBLOCK_FIELD_".$code)?>:
                                        <?=intval($value);?>
                                    </div>
                                    <?elseif(
                                        $value
                                        && (
                                            $code == "SHOW_COUNTER_START"
                                            || $code == "DATE_ACTIVE_FROM"
                                            || $code == "ACTIVE_FROM"
                                            || $code == "DATE_ACTIVE_TO"
                                            || $code == "ACTIVE_TO"
                                            || $code == "DATE_CREATE"
                                            || $code == "TIMESTAMP_X"
                                        )
                                    ):?>
                                    <?
                                        $value = CIBlockFormatProperties::DateFormat($arParams["ACTIVE_DATE_FORMAT"], MakeTimeStamp($value, CSite::GetDateFormat()));
                                    ?>
                                    <div class="bx-newslist-date"><i class="fa fa-calendar-o"></i> <?=GetMessage("IBLOCK_FIELD_".$code)?>:
                                        <?=$value;?>
                                    </div>
                                    <?elseif($code == "TAGS" && $value):?>
                                    <div class="bx-newslist-tags"><i class="fa fa-tag"></i> <?=GetMessage("IBLOCK_FIELD_".$code)?>:
                                        <?=$value;?>
                                    </div>
                                    <?elseif(
                                        $value
                                        && (
                                            $code == "CREATED_USER_NAME"
                                            || $code == "USER_NAME"
                                        )
                                    ):?>
                                    <div class="bx-newslist-author"><i class="fa fa-user"></i> <?=GetMessage("IBLOCK_FIELD_".$code)?>:
                                        <?=$value;?>
                                    </div>
                                    <?elseif ($value != ""):?>
                                    <div class="bx-newslist-other"><i class="fa"></i> <?=GetMessage("IBLOCK_FIELD_".$code)?>:
                                        <?=$value;?>
                                    </div>
                                    <?endif;?>
                                <?endforeach;?>
                            <?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
                                <?
                                    if(is_array($arProperty["DISPLAY_VALUE"]))
                                        $value = implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
                                    else
                                        $value = $arProperty["DISPLAY_VALUE"];
                                ?>
                                <?if($arProperty["CODE"] == "FORUM_MESSAGE_CNT"):?>
                                    <div class="bx-newslist-comments"><i class="fa fa-comments"></i> <?=$arProperty["NAME"]?>:
                                        <?=$value;?>
                                    </div>
                                    <?elseif ($value != ""):?>
                                    <div class="bx-newslist-other"><i class="fa"></i> <?=$arProperty["NAME"]?>:
                                        <?=$value;?>
                                    </div>
                                    <?endif;?>
                                <?endforeach;?>
                            <div class="row">
                                <?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
                                    <div class="col-xs-5">
                                        <div class="bx-newslist-date"><i class="fa fa-calendar-o"></i> <?echo $arItem["DISPLAY_ACTIVE_FROM"]?></div>
                                    </div>
                                    <?endif?>
                                <?if($arParams["USE_RATING"]=="Y"):?>
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
                                    <?endif?>
                            </div>
                            <div class="row">
                                <div class="col-xs-5">
                                    <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                                        <div class="bx-newslist-more"><a class="btn btn-primary btn-xs" href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo GetMessage("CT_BNL_GOTO_DETAIL")?></a></div>
                                        <?endif;?>
                                </div>
                                <?
                                    if ($arParams["USE_SHARE"] == "Y")
                                    {
                                    ?>
                                    <div class="col-xs-7 text-right">
                                        <noindex>
                                            <?
                                                $APPLICATION->IncludeComponent("bitrix:main.share", $arParams["SHARE_TEMPLATE"], array(
                                                    "HANDLERS" => $arParams["SHARE_HANDLERS"],
                                                    "PAGE_URL" => $arItem["~DETAIL_PAGE_URL"],
                                                    "PAGE_TITLE" => $arItem["~NAME"],
                                                    "SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
                                                    "SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
                                                    "HIDE" => $arParams["SHARE_HIDE"],
                                                    ),
                                                    $component,
                                                    array("HIDE_ICONS" => "Y")
                                                );
                                            ?>
                                        </noindex>
                                    </div>
                                    <?
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?endforeach;?>
            </div>
            <?/*if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
                <br /><?=$arResult["NAV_STRING"]?>
                <?endif;*/
            ?>
             <span class="moreNews">Показать ещё</span>
        </div>
    </div>
</div> 
<script>
// СЃРєСЂРёРїС‚ ajax-РїРѕРґРіСЂСѓР·РєРё С‚РѕРІР°СЂРѕРІ РІ Р±Р»РѕРєРµ "Р’СЃРµ РєРЅРёРіРё"
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
                    var next_page = $('.bx-newslist > .row .bx-newslist-container', data);
                    //$('.catalogBooks').append('<br /><h3>РЎС‚СЂР°РЅРёС†Р° '+ page +'</h3><br />');
                    $('.bx-newslist > .row').append(next_page);
                    page++;            
                })
                .done(function() 
                {
                    $.fancybox.hideLoading();
                    $(".bookName").each(function()
                    {
                        if($(this).length > 0)
                        {
                            $(this).html(truncate($(this).html(), 20));    
                        }    
                    });
    
                });
                if (page == maxpage) {
                    $('.moreNews').hide();
                    //$('.phpages').hide();
                }
                return false;
            });
    });
</script>
