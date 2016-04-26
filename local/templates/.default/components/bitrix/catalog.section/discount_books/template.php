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

<div class="saleSlider">  <!--слайдер блока "Мы рекомендуем"-->
    <ul>
        <?foreach ($arResult["ITEMS"] as $arItem) {
                foreach ($arItem["PRICES"] as $code => $arPrice) {
                    if ($arPrice["PRINT_DISCOUNT_VALUE"]) {
                        $pict = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array('width'=>142, 'height'=>210), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                    ?>
                    <li>
                        <div class="bookWrapp">
                            <div class="sect_badge">
                                <? if (($arItem["PROPERTIES"]["discount_ban"]["VALUE"] != "Y") 
                                        && $arItem['PROPERTIES']['spec_price']['VALUE'] ) {
                                            switch ($arItem['PROPERTIES']['spec_price']['VALUE']) {
                                                case 10:
                                                    echo '<img class="discount_badge" src="/img/10percent.png">';
                                                    break;
                                                case 15:
                                                    echo '<img class="discount_badge" src="/img/15percent.png">';
                                                    break;
                                                case 20:
                                                    echo '<img class="discount_badge" src="/img/20percent.png">';
                                                    break;
                                                case 30:
                                                    echo '<img class="discount_badge" src="/img/30percent.png">';
                                                    break;
                                                case 40:
                                                    echo '<img class="discount_badge" src="/img/40percent_black.png">';
                                                    break;

                                            } 
                                }?>
                            </div>
                            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                                <div class="section_item_img">
                                    <?if($pict["src"] != ''){?>
                                        <img src="<?=$pict["src"]?>">    
                                    <?}else{?>
                                        <img src="/images/no_photo.png">      
                                    <?}?>
                                </div>
                                <p class="bookName" title="<?=$arItem["NAME"]?>"><?=$arItem["NAME"]?></p>
                                <p class="tapeOfPack"><?=$arItem["PROPERTIES"]["COVER_TYPE"]["VALUE"]?></p>
                                <p class="bookPriceLine"><?=ceil($arPrice["PRINT_VALUE_VAT"])?> <span>руб.</span></p>
                                <p class="bookPrice"><?=ceil($arPrice["DISCOUNT_VALUE_VAT"])?> <span>руб.</span></p>
                            </a>
                        </div>    
                    </li>
                    <?}
                }
        }?>
    </ul>
    <img src="/img/arrowLeft.png" class="left">
    <img src="/img/arrowRight.png" class="right">
</div> 

