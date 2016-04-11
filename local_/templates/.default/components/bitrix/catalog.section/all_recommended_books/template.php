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


<div class="weRecomBlock">
    <?foreach ($arResult["ITEMS"] as $arItem)
    {
        $pict = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width'=>142, 'height'=>210), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        foreach ($arItem["PRICES"] as $code => $arPrice)
        {?>
        <div class="bookWrapp">
            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" onmousedown="try { rrApi.recomMouseDown(<?=$arItem["ID"]?>, {methodName: 'UpSellItemToItems'}) } catch(e) {}">
            <div class="section_item_img">
                <img src="<?=$pict["src"]?>">
            </div>
            <p class="bookName" title="<?=$arItem["NAME"]?>"><?=$arItem["NAME"]?></p>
            <?
            if (intval($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) != 22 && intval($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) != 23)
            {
            ?>
                <p class="bookPrice"><?=ceil($arPrice["DISCOUNT_VALUE_VAT"])?> <span>руб.</span></p>
            <?
            }
            else if (intval($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) == 23)
            {
            ?>
                <p class="bookPrice"><?=$arItem["PROPERTIES"]["STATE"]["VALUE"]?></p>
            <?
            }
            else
            {
            ?>
                <p class="bookPrice"><?=$arItem["PROPERTIES"]["SOON_DATE_TIME"]["VALUE"]?></p>
            <?    
            }
            ?>        
            </a>
        </div>
        <?}?>
    <?}?>            
                
</div>


