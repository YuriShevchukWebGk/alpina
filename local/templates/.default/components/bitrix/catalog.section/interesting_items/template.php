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

<div class="categoryWrapperWhite">
        <div class="interestSlideWrap">
                <div class="interestSlider">
                    <p>Вам также будет интересно</p>
                    <div class="otherEasySlider">
                        <div>
                            <ul>
                                <?foreach ($arResult["ITEMS"] as $arItem)
                                {
                                    $pict = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array('width'=>142, 'height'=>210), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                                    foreach ($arItem["PRICES"] as $code => $arPrice)
                                    {?>
                                <li>
                                    <div class="">
                                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                                            <div class="section_item_img">
                                                <img src="<?=$pict["src"]?>" class="bookImg">
                                            </div>
                                            <p class="bookName" title="<?=$arItem["NAME"]?>"><?=$arItem["NAME"]?></p>
                                            <?
                                            if (intval($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) != 22 && intval($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) != 23)
                                            {
                                            
                                                if ($arPrice["DISCOUNT_VALUE_VAT"])
                                                {
                                                ?>
                                                    <p class="bookPrice"><?=ceil($arPrice["DISCOUNT_VALUE_VAT"])?> <span>руб.</span></p>
                                                <?
                                                }
                                                else
                                                {
                                                ?>
                                                    <p class="bookPrice"><?=ceil($arPrice["ORIG_VALUE_VAT"])?> <span>руб.</span></p>
                                                <?
                                                }
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
                                </li>
                                <?  }
                                }?>
                                
                            </ul>
                            <?/*<img src="/img/arrowLeft.png" class="left">
                            <img src="/img/arrowRight.png" class="rigth">*/?>
                        </div>
                    </div>
                </div>
            </div>