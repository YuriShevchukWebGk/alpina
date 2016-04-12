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

<div class="deliveryTextWrap">
                <?foreach ($arResult["ITEMS"] as $arItem)
                {?>
                <div class="deliveryTypeWrap" id="<?=$arItem["CODE"]?>">
                    <p class="title"><?=$arItem["NAME"]?></p>
                    <? if ($arItem["PREVIEW_PICTURE"]["ID"])
                    {?>
                        <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>">
                    <?}?>
                    <?=$arItem["PREVIEW_TEXT"]?>
                </div>
                <?}?>
</div>