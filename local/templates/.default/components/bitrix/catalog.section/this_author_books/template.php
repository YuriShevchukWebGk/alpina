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

    <?if (count($arResult["ITEMS"]) > 0){?>
               
    <div class="authorBooksWrapp">
        <p>Другие книги автора</p>    
        <div class="authorBoolSlider">
            <div class="sliderContainer">
                <ul class="sliderUl">
                    <?foreach ($arResult["ITEMS"] as $arItem)
                    {
                        $pict = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array('width'=>147, 'height'=>216), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                        foreach ($arItem["PRICES"] as $arPrice)
                        {?>
                    <li class="sliderElement">
                        <div class="">
                            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                            <div class="section_item_img">
                                <img src="<?=$pict["src"]?>" class="bookImg" title="<?=$arItem["NAME"]?>" alt="<?=$arItem["NAME"]?>" />
                            </div>
                            <p class="bookName"><?=$arItem["NAME"]?></p>
                            <p class="tapeOfPack"><?=$arItem["PROPERTIES"]["COVER_TYPE"]["VALUE"]?></p>
                            <?
                                if ($arPrice["DISCOUNT_VALUE_VAT"])
                                {
                                ?>
                                    <p class="bookPrice"><?=ceil($arPrice["DISCOUNT_VALUE_VAT"])?> <span></span></p>
                                <?
                                }
                                else
                                {
                                ?>
                                    <p class="bookPrice"><?=ceil($arPrice["ORIG_VALUE_VAT"])?> <span></span></p>
                                <?
                                }
                            ?>
                            </a>
                        </div>    
                    </li>
                    <?  }
                    }?>

                </ul>
                <img src="/img/arrowLeft.png" class="left">
                <img src="/img/arrowRight.png" class="rigth">
            </div>
        </div>    
    </div>
    
    <?}?>
<script>
$(document).ready(function(){
    $(".authorBoolSlider li .tapeOfPack").each(function(){
        $(this).html(truncate($(this).html(), 15));
    })
})
</script>