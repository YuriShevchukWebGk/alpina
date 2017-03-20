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
    .slideWrapp {background-color:#fff;}
    .circle strong {color:#333;}
    .slideWrapp .titleSlide {color:#666;}
    .slideWrapp .textSlide {color:#888;}
    </style>
<div class="slideWrapp">
    <ul class="roundSlider">
        <?foreach($arResult["ITEMS"] as $key => $arItem)
            {?>
            <li class="firstSlide" style="background-image: url(<?=$arItem["DETAIL_PICTURE"]["SRC"]?>)">
                <?if ($arItem["PROPERTIES"]["LINK"]["VALUE"]){?>
                    <a href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>" target="_blank" onclick="dataLayer.push({'event' : 'otherEvents', 'action' : 'bannersOnMain', 'label' : '<?=$arItem["NAME"]?>'});">
                <?}?>
                <div class="catalogWrapper">
                    <p class="titleSlide">
                        <?=$arItem["PREVIEW_TEXT"]?>
                    </p>
                    <p class="textSlide">
                        <?=$arItem["DETAIL_TEXT"]?>
                    </p>
                    <?foreach($arResult["ITEMS"] as $item_key => $item_value)
                        {?>
                        <!-- определение текущего слайда и присвоение класса к соответствующей кнопке слайда с соответствующей анимацией -->

                        <div class="<?if ($item_key==$key){?>circle circle<?=($item_key+1)?><?}else{?>buttons" data-number="<?=($item_key+1)?><?}?>">
                            <?if($item_key==$key) {?><strong><?=($item_key+1)?></strong><?} else {?><p><?=($item_key+1)?></p><?}?>
                        </div>

                        <?}?>
                </div> 
                <?if ($arItem["PROPERTIES"]["LINK"]["VALUE"]){?>
                    </a>
                <?}?>   
            </li>
            <?}?>
    </ul>
</div>