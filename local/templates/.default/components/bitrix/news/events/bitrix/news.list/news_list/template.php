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
        <? 
            if (strstr($APPLICATION -> GetCurDir(), "events", true) != "") {?>
                <h1><?= GetMessage("EVENTS") ?></h1>
            <?
            } else if (strstr($APPLICATION -> GetCurDir(), "news", true) != "") {
            ?>
                <h1><?= GetMessage("NEWS") ?></h1>
            <?
            }
        ?>
    </div>
</div>

<div class="newsBodyWrap" id="events_wrap">
    <div class="centerWrapper">
        <div class="events_info">
            <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include", 
                    ".default", 
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "AREA_FILE_RECURSIVE" => "Y",
                        "EDIT_TEMPLATE" => "",
                        "COMPONENT_TEMPLATE" => ".default",
                        "PATH" => "/local/templates/.default/include/events_info.php"
                    ),
                    false
                );?>
        </div>
        
        <div class="bx-newslist events_wrap_top">
            <?if($arParams["DISPLAY_TOP_PAGER"]) {?>
                <?=$arResult["NAV_STRING"]?><br />
            <?}?>
            <div class="row">
            
                <?foreach($arResult["ITEMS"] as $key => $arItem) {?>
                    <?if($key < 5){ ?>
                      
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
                                    <?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]) {?>
                                        <div class="col-xs-5">
                                            <? 
                                            if ($arItem["DATE_ACTIVE_FROM"] == $arItem["DATE_ACTIVE_TO"]) {
                                            ?>
                                            <div class="bx-newslist-date"><i class="fa fa-calendar-o"></i> <?echo FormatDate("j F", MakeTimeStamp($arItem["DATE_ACTIVE_FROM"]));?></div>
                                            <?
                                            } else {
                                            ?>
                                            <div class="bx-newslist-date"><i class="fa fa-calendar-o"></i> <?echo FormatDate("j F", MakeTimeStamp($arItem["DATE_ACTIVE_FROM"])).' - '.FormatDate("j F", MakeTimeStamp($arItem["DATE_ACTIVE_TO"])); ?></div>
                                            <?
                                            }
                                            ?>
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
                      <? }?>
                <?}?>
            </div>
        </div>
    </div>
</div> 
<div class="slider_wrap">
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
        "DISPLAY_BOTTOM_PAGER" => "N",
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
        "IBLOCK_ID" => "49",
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
);   ?>
</div>
<div class="newsBodyWrap " id="events_wrap">
    <div class="centerWrapper">
        <div class="bx-newslist events_wrap_2">
            <?if($arParams["DISPLAY_TOP_PAGER"]) {?>
                <?=$arResult["NAV_STRING"]?><br />
            <?}?>
            <div class="row">
            
                <?foreach($arResult["ITEMS"] as $key => $arItem) {?>
                    <?if($key >= 5){ ?>
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
                    <?}?>
                <?}?>
            </div>
             <span class="moreNews">Показать ещё</span>
        </div>
    </div>
</div>

<script>
// функция по раскрытию дополнительных элементов списка новостей при нажатии на "Показать ещё"
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
                    var next_page = $('.events_wrap_2 > .row .bx-newslist-container', data);
                    $('.events_wrap_2 > .row').append(next_page);
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
