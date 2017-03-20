<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
use Bitrix\Sale\DiscountCouponsManager;

if (!empty($arResult["ERROR_MESSAGE"])) {
    ShowError($arResult["ERROR_MESSAGE"]);    
}                                          

$bDelayColumn  = false;
$bDeleteColumn = false;
$bWeightColumn = false;
$bPropsColumn  = false;
$bPriceType    = false;                         
?>
<?$arResult["TOTAL_ITEMS"] = 0;?>  
                                         
<div class="confirmTopWrap"> 
    <a href="<?=$arParams['PATH_TO_ORDER']?>">
        <div class="confirm">
            <p><?=GetMessage("TSB1_2ORDER")?></p>
        </div>
    </a>
</div> 
<p class="title"><?=GetMessage("TSB1_CART")?></p>  
<?                
if (!empty($arResult["GRID"]["ROWS"]))
{
?>
    <div data-role="basket-item-list" class="basketBooks">                                                                         
            <?foreach ($arResult["GRID"]["ROWS"] as $arItem) {?>
                <?                 
                $thisItem = CIBlockElement::GetList(array(), array("ID"=>$arItem["PRODUCT_ID"]), false, false, array("ID", "DETAIL_PICTURE", "DETAIL_PAGE_URL"))->Fetch();
                $thisItemSect = CIBlockSection::GetByID($thisItem["IBLOCK_SECTION_ID"]) -> Fetch();
                $thisItemPict = CFile::GetPath($thisItem["DETAIL_PICTURE"]);
                ?>
                <div class="basketBook" basket-id="<?=$arItem["ID"]?>" product-id="<?=$arItem["PRODUCT_ID"]?>"> 
                    <div class="bookImage">                 
                        <?if($arItem["DETAIL_PAGE_URL"]) {?>
                            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="<?=$thisItemPict?>" alt="<?=$arItem["NAME"]?>"></a>
                        <?} else {?>
                            <img src="<?=$thisItemPict?>" alt="<?=$arItem["NAME"]?>" />
                        <?}?> 
                        <div class="delItem" onclick="delete_basket_item(<?=$arItem["ID"]?>);" title="<?=GetMessage("TSB1_DELETE")?>"><img src="/img/catalogLeftClose.png"></div>
                    </div>                     
                    <?if ($arItem["DETAIL_PAGE_URL"]):?>
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                            <p class="bookNameBask"><?=$arItem["NAME"]?></p>
                        </a>                                                                
                    <?else:?>
                        <p class="bookNameBask"><?=$arItem["NAME"]?></p>
                    <?endif?>    
                    <?if ($arItem["PRICE_FORMATED"]) {?>                                          
                        <p class="bookPrice">                                                           
                            <?=$arItem["PRICE_FORMATED"]?>                            
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
    </div>  
<?}?>
<div class="bottomBlock">
    <div class="result">
        <p class="resultText"><?=GetMessage("TSB1_RESULT")?></p>
        <p class="count"><?=GetMessage("TSB1_TOTAL_PRICE")?><?=$arResult["TOTAL_ITEMS"]?></p>
        <p class='price'><?=$arResult["allSum_FORMATED"]?></p>
    </div>
    <a href="<?=$arParams['PATH_TO_ORDER']?>" class="bottomBasketConfirm">
        <div class="confirm">
            <p><?=GetMessage("TSB1_2ORDER")?></p>
        </div>
    </a>
</div>     