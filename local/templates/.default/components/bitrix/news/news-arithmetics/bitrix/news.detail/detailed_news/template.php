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

<div class="newsBodyWrap">
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
    <p class="back_to_arithmetics_page"><a href="/good-arithmetics/"><?= GetMessage ("T_GOOD_ARITHMETICS_DETAIL_BACK") ?></a></p>
    
</div>

        