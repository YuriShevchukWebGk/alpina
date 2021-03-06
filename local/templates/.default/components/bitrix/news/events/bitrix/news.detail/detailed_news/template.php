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
?>
<style>
ul{list-style-type:disc}
</style>
<div class="newsBodyWrap">
    <div class="newsPageTitleWrap">
        <div class="centerWrapper">
            <p><a href="/">Главная</a> > <a href="/events/">Мероприятия</a> > <?=$arResult["NAME"]?></p>
            <?if (strpos($APPLICATION->GetCurDir(), "events") !== false) {?>
				<h1>Мероприятия</h1>
			<?} else if (strstr($APPLICATION -> GetCurDir(), "news", true) != "") {?>
				<h1><a href="/events/">Новости</a></h1>
			<?}?>
        </div>
    </div>
    <div class="content">
        <div class="catalogWrapper">
            <div class="newsTitle">
                <?=$arResult["NAME"]?>
            </div>
            <div class="newsInfo">
                <div class="newsPhoto">
                    <img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>">
                </div>    
            </div>
            <div class="textWrap">

                <?=$arResult["DETAIL_TEXT"]?>
            </div>
        </div>    
    </div>
    
    <?/*if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
        <span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
    <?endif;?>
    <?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
        <h3><?=$arResult["NAME"]?></h3>
    <?endif;?>
    <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
        <p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
    <?endif;*/?>
    
</div>

        