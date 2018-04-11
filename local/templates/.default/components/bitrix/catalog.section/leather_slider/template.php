<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<div class="saleSlider leatherSlider no-mobile">
	<p class="titleMain"><a href="/catalog/bigideas/">Маленькие книги — большие идеи</a></p>
    <ul>
        <?foreach ($arResult["ITEMS"] as $arItem) {
            foreach ($arItem["PRICES"] as $code => $arPrice) {
                if ($arPrice["PRINT_DISCOUNT_VALUE"]) {
                    $pict = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array('width'=>147, 'height'=>216), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                ?>
                <li>
                    <div class="bookWrapp">
						<p class="bookName" title="<?=$arItem["NAME"]?>"><?echo strstr($arItem["PROPERTIES"]["SHORT_NAME"]["VALUE"],'(', true) ? strstr($arItem["PROPERTIES"]["SHORT_NAME"]["VALUE"],'(', true) : $arItem["PROPERTIES"]["SHORT_NAME"]["VALUE"];?></p>
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                            <div class="section_item_img">
                                <?if($pict["src"] != ''){?>
                                    <img src="<?=$pict["src"]?>">    
                                    <?} else {?>
                                    <img src="/images/no_photo.png">      
                                    <?}?>
                            </div>
						<?/*<p class="tapeOfPack"><?=$arItem["PROPERTIES"]["COVER_TYPE"]["VALUE"]?></p>*/?>
                        </a>
                    </div>    
                </li>    
                <?}
            }
        }?>
    </ul>
</div>