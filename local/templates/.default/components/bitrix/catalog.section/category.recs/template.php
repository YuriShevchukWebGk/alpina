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

<div class="bestSlider">
    <div>
        <ul>
        <?foreach ($arResult["ITEMS"] as $arItem)
        {
            $pict = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array('width'=>142, 'height'=>210), BX_RESIZE_IMAGE_PROPORTIONAL, true);
            foreach ($arItem["PRICES"] as $code => $arPrice)
            {?>
            <li>
                <div class="bookWrapp">
                    <?$curr_author = CIBlockElement::GetByID($arItem["PROPERTIES"]["AUTHORS"]["VALUE"][0]) -> Fetch();?>
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                        <div class="section_item_img">
                            <?
                            if ($pict["src"])
                            {
                            ?>
                                <img src="<?=$pict["src"]?>">
                            <?
                            }
                            else
                            {
                            ?>
                                <img src="/images/no_photo.png">
                            <?
                            }
                            ?>
                            <?if(!empty($arItem["PROPERTIES"]["number_volumes"]["VALUE"])){?>
                            <span class="volumes"><?=$arItem["PROPERTIES"]["number_volumes"]["VALUE"]?></span>
                            <?}?>
                        </div>
                        <p class="bookName" title="<?=$arItem["NAME"]?>"><?=$arItem["NAME"]?></p>
                        <p class="bookAutor"><?=$curr_author["NAME"]?></p>
                        <p class="tapeOfPack"><?=$arItem["PROPERTIES"]["COVER_TYPE"]["VALUE"]?></p>
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
                    
                    <?
                        $dbBasketItems = CSaleBasket::GetList(array(), array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL", "PRODUCT_ID" => $arItem["ID"]), false, false, array("ID", "CALLBACK_FUNC", "MODULE", "PRODUCT_ID", "QUANTITY", "PRODUCT_PROVIDER_CLASS"))->Fetch();
                     ?>
                     <?
                     if(intval($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) != 23){ 
                        if ($dbBasketItems["QUANTITY"] == 0){?>
                            <a class="product<?=$arItem["ID"];?>" href="<?echo $arItem["ADD_URL"]?>" onclick="addtocart(<?=$arItem["ID"];?>, '<?=$arItem["NAME"];?>');return false;"><p class="basketBook">В корзину</p></a>
                        <?} else {?>
                            <a class="product<?=$arItem["ID"];?>" href="/personal/cart/"><p class="basketBook" style="background-color: #A9A9A9;color: white;">Оформить</p></a>                         
                        <?}  
                     } 
                      ?>
                     
                </div>        
            </li>
        <?  }
        }
        ?>
        </ul>
        <img src="/img/arrowLeft.png" class="left">
        <img src="/img/arrowRight.png" class="rigth">
    </div>        
</div>
