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
$APPLICATION->AddHeadScript("/local/templates/.default/components/bitrix/news.list/series_banners/include/script.js");?>

<?if ($arResult['ELEMENTS']) {?>
    <div class="roundSlideWrapp">
        <ul class="roundSlider">
            <?foreach($arResult["ITEMS"] as $key => $arItem) {?>
                <li class="firstSlide">
                    <?if ($arItem["PROPERTIES"]["SERIE_BANNER_LINK"]["VALUE"]){?>
                        <a href="<?= $arItem["PROPERTIES"]["SERIE_BANNER_LINK"]["VALUE"] ?>">
                    <?}?>
                    <div class="catalogWrapper">
                        <img src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" class="roundCatBack">
                        <p class="titleSlide"><?= $arItem["PREVIEW_TEXT"] ?></p>
                        <p class="textSlide"><?= $arItem["DETAIL_TEXT"] ?></p>
                        <?foreach($arResult["ITEMS"] as $item_key => $item_value) {?>
                            <div class="<?if ($item_key == $key){?>circle circle<?= ($item_key+1) ?><? }else{ ?>buttons" data-number="<?= ($item_key+1) ?><? } ?>">
                                <?if ($item_key == $key) {?><strong><?= ($item_key+1) ?></strong><?} else {?><p><?= ($item_key+1) ?></p><?}?>
                            </div>
                        <?}?>
                    </div>
                    <?if ($arItem["PROPERTIES"]["SERIE_BANNER_LINK"]["VALUE"]) {?>
                        </a>
                    <?}?>
                </li>
            <?}?>
        </ul>    
    </div>    
<?}?>


          
