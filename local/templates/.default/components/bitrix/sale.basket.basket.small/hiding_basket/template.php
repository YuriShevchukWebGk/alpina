<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>        
<div class="confirmTopWrap"> 
    <a href="/personal/cart/" onclick="dataLayer.push({'event' : 'smallCartInteractions', 'action' : 'orderConfirmTop'});">
    <div class="confirm">
        <p>Оформить заказ</p>
    </div>
    </a>
</div> 
<p class="title">Корзина</p>
<div class="basketBooks">
    <?foreach ($arResult["ITEMS"] as $arItem) {
        $thisItem = CIBlockElement::GetList(array(), array("ID"=>$arItem["PRODUCT_ID"]), false, false, array("ID", "DETAIL_PICTURE", "DETAIL_PAGE_URL"))->Fetch();
        $thisItemSect = CIBlockSection::GetByID($thisItem["IBLOCK_SECTION_ID"]) -> Fetch();
        $thisItemPict = CFile::GetPath($thisItem["DETAIL_PICTURE"]);
        ?>
    <div class="basketBook" basket-id="<?=$arItem["ID"]?>" product-id="<?=$arItem["PRODUCT_ID"]?>">
        <div class="bookImage">
            <a href="/catalog/<?=$thisItemSect["CODE"]?>/<?=$thisItem["ID"]?>/"><img src="<?=$thisItemPict?>"></a>
        </div>
        <div>
            <a href="/catalog/<?=$thisItemSect["CODE"]?>/<?=$thisItem["ID"]?>/">
                <p class="bookNameBask"><?=$arItem["NAME"]?></p>
            </a>
            <p class="bookPrice"><?=$arItem["PRICE_FORMATED"]?></p>
            
            <? if ($arItem['PRODUCT_PROVIDER_CLASS'] != "GiftProductProvider") { // для подарков sailplay не выводим +-?>
            <div class="countMenu">
                <p class="countOfBook" id="countOfBook_<?=$arItem["ID"]?>"><?=round($arItem["QUANTITY"])?></p>
                <a href="javascript:void(0);" class="plus" onclick="update_quant('plus', this);"></a>
                <a href="javascript:void(0);" class="minus" onclick="update_quant('minus', this);"></a>        
            </div>
            <? } ?>
            <div class="delItem" onclick="delete_basket_item(<?=$arItem["ID"]?>);">
                <img src="/img/catalogLeftClose.png">    
            </div>
            
        </div>
    </div>
    <?}?>    
        
</div>
<?
$arResult["TOTAL_AMOUNT"] = 0;
$arResult["TOTAL_ITEMS"] = 0;   
foreach ($arResult["ITEMS"] as $arItem) {
    if ($arItem["DELAY"]=="N") {
        $arResult["TOTAL_AMOUNT"] += $arItem["PRICE"] * $arItem["QUANTITY"];
        $arResult["TOTAL_ITEMS"] += $arItem["QUANTITY"];    
    }
}
?>
<div class="bottomBlock">
    <div class="result">
        <p class="resultText">Итого</p>
        <p class="count">Кол-во: <?=$arResult["TOTAL_ITEMS"]?></p>
        <p class='price'><?=$arResult["TOTAL_AMOUNT"]?> <span>руб.</span></p>
    </div>
    <a href="/personal/cart/" class="bottomBasketConfirm" onclick="dataLayer.push({'event' : 'smallCartInteractions', 'action' : 'orderConfirmBottom'});">
    <div class="confirm">
        <p>Оформить заказ</p>
    </div>
    </a>
</div>
<script>
$(document).ready(function() {
    // обрезка длинных названий
    $(".bookNameBask").each(function() {
        if($(this).length > 0) {
        	$(this).html(truncate($(this).html(), 20));    
        }    
    });
});
</script>