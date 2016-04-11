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
        <?foreach ($arResult["ITEMS"] as $arItem)
            {
                foreach ($arItem["PRICES"] as $code => $arPrice)
                {
                    if ($arPrice["PRINT_DISCOUNT_VALUE"])
                    {
                        $pict = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array('width'=>142, 'height'=>210), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                    ?>
                    <li>
                        <div class="bookWrapp">
                            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                                <div class="section_item_img">
                                    <?if($pict["src"] != ''){?>
                                                    <img src="<?=$pict["src"]?>">    
                                                <?}else{?>
                                                    <img src="/images/no_photo.png">      
                                                <?}?>
                                </div>
                                <p class="bookName" title="<?=$arItem["NAME"]?>"><?=$arItem["NAME"]?></p>
                                <p class="bookPriceLine"><?=ceil($arPrice["PRINT_VALUE_VAT"])?> <span>руб.</span></p>
                                <p class="bookPrice"><?=ceil($arPrice["DISCOUNT_VALUE_VAT"])?> <span>руб.</span></p>
                            </a>
                        </div>    
                    </li>
                    <?      }
                }
        }?>
    </ul>
    <img src="/img/arrowLeft.png" class="left">
    <img src="/img/arrowRight.png" class="right">
</div> 

