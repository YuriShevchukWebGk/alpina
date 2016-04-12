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


                <div class="recomendation">
                    <p class="titleMain">Мы рекомендуем</p>
                    <div class="saleSlider">
                    <ul>
                        
                        <?foreach ($arResult["ITEMS"] as $arItem)
                        {
                            foreach ($arItem["PRICES"] as $code => $arPrice)
                            {//arshow($arItem);?>
                        <li>
                            <div class="bookWrapp">
                                <img src=<?=$arItem['PREVIEW_PICTURE']['SRC']?>>
                                <p class="bookName"><?=$arItem['NAME']?></p>
                                <p class="bookPrice"><?=$arPrice['PRINT_DISCOUNT_VALUE']?></p>
                            </div>    
                        </li>    
                        <?  } 
                        }?>
                    </ul>
                    <img src="/img/arrowLeft.png" class="left">
                    <img src="/img/arrowRight.png" class="right">
                    </div>
                </div>

