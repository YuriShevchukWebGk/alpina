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

<div class="deliveryTypeWrap">
                <?foreach ($arResult["ITEMS"] as $arItem)
                {?>
                    <p class="position"><?=$arItem["PROPERTIES"]["job"]["VALUE"]?></p>
                    <span class="title"><?=$arItem["NAME"]?></span>
                    <? if ($arItem["PREVIEW_PICTURE"]["ID"])
                    {?>
                        <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>">
                    <?}?>
                    <?=$arItem["PROPERTIES"]["email"]["VALUE"]?>
                    <br><br>
                <?}?>
</div>