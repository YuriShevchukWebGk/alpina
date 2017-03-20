<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$this->IncludeLangFile('template.php');

$cartId = $arParams['cartId'];?>
<?$arResult["TOTAL_ITEMS"] = 0;?>  
                                         
<div class="confirmTopWrap"> 
    <a href="<?=$arParams['PATH_TO_BASKET']?>" onclick="dataLayer.push({'event' : 'smallCartInteractions', 'action' : 'orderConfirmTop'});">
        <div class="confirm">
            <p><?=GetMessage("TSB1_2ORDER")?></p>
        </div>
    </a>
</div> 
<p class="title"><?=GetMessage("TSB1_CART")?></p>  

<?/*require(realpath(dirname(__FILE__)).'/top_template.php');*/

if ($arParams["SHOW_PRODUCTS"] == "Y" && $arResult['NUM_PRODUCTS'] > 0)
{
?>
	<div data-role="basket-item-list" class="basketBooks">                    
		<?foreach ($arResult["CATEGORIES"] as $category => $items) {
			if (empty($items))
				continue;
			?>                                                                                 
			<?foreach ($items as $arItem) {?>
                <?
                $thisItem = CIBlockElement::GetList(array(), array("ID"=>$arItem["PRODUCT_ID"]), false, false, array("ID", "DETAIL_PICTURE", "DETAIL_PAGE_URL"))->Fetch();
                $thisItemSect = CIBlockSection::GetByID($thisItem["IBLOCK_SECTION_ID"]) -> Fetch();
                $thisItemPict = CFile::GetPath($thisItem["DETAIL_PICTURE"]);
                ?>
				<div class="basketBook" basket-id="<?=$arItem["ID"]?>" product-id="<?=$arItem["PRODUCT_ID"]?>"> 
					<div class="bookImage">
						<?if ($arParams["SHOW_IMAGE"] == "Y" && $arItem["PICTURE_SRC"]):?>
							<?if($arItem["DETAIL_PAGE_URL"]):?>
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="<?=$thisItemPict?>" alt="<?=$arItem["NAME"]?>"></a>
							<?else:?>
								<img src="<?=$thisItemPict?>" alt="<?=$arItem["NAME"]?>" />
							<?endif?>
						<?endif?>     
						<div class="delItem" onclick="<?=$cartId?>.removeItemFromCart(<?=$arItem['ID']?>)" title="<?=GetMessage("TSB1_DELETE")?>"><img src="/img/catalogLeftClose.png"></div>
					</div>                     
					<?if ($arItem["DETAIL_PAGE_URL"]):?>
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                            <p class="bookNameBask"><?=$arItem["NAME"]?></p>
                        </a>                                                                
					<?else:?>
						<p class="bookNameBask"><?=$arItem["NAME"]?></p>
					<?endif?>           
					<?if (true) {/*$category != "SUBSCRIBE") TODO */?>
                        <p class="bookPrice">                             
							<?if ($arParams["SHOW_PRICE"] == "Y" && $arParams["SHOW_SUMMARY"] == "Y") {?>
								<?=$arItem["PRICE_FMT"]?>
							<?}?>                       
						</p>
					<?}?>                
                    <? if ($arItem['PRODUCT_PROVIDER_CLASS'] != "GiftProductProvider") { // для подарков sailplay не выводим +-?>
                        <div class="countMenu">
                            <p class="countOfBook" id="countOfBook_<?=$arItem["ID"]?>"><?=round($arItem["QUANTITY"])?></p>
                            <a href="javascript:void(0);" class="plus" onclick="update_quant('plus', this);"></a>
                            <a href="javascript:void(0);" class="minus" onclick="update_quant('minus', this);"></a>        
                        </div>
                    <? } ?>
                </div> 
                <?
                if ($arItem["DELAY"]=="N") {                                                
                    $arResult["TOTAL_ITEMS"] += $arItem["QUANTITY"];    
                } 
                ?>
			<?}?>
		<?}?>    
	</div>  
    <div class="bottomBlock">
        <div class="result">
            <p class="resultText"><?=GetMessage("TSB1_RESULT")?></p>
            <p class="count"><?=GetMessage("TSB1_TOTAL_PRICE")?><?=$arResult["TOTAL_ITEMS"]?></p>
            <p class='price'><?=$arResult["TOTAL_PRICE"]?></p>
        </div>
        <a href="/personal/cart/" class="bottomBasketConfirm" onclick="dataLayer.push({'event' : 'smallCartInteractions', 'action' : 'orderConfirmBottom'});">
            <div class="confirm">
                <p><?=GetMessage("TSB1_2ORDER")?></p>
            </div>
        </a>
    </div>                                                                                        
	<script>                      
		BX.ready(function(){
			<?=$cartId?>.fixCart();
		});
	</script>
<?
}