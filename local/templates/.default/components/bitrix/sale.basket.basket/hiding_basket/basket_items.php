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
<?//Простенькая переключалка, между корзиной и предзаказом?>
<script>
$(".hidingBasketRight .title").on("click", function(){  
    if (this.id == 'preorder_title' && !$(this).hasClass('active')) { 
        $('#basket_list').hide();
        $('#preorder_list').show(); 
        $('#basket_title').removeClass('active');
        $(this).addClass('active');        
        $('.hidingBasketRight .result').hide();            
    } else if (this.id == 'basket_title' && !$(this).hasClass('active')) { 
        $('#preorder_list').hide(); 
        $('#basket_list').show();
        $('#preorder_title').removeClass('active');
        $(this).addClass('active');             
        $('.hidingBasketRight .result').show();
    }            
});
</script> 
<?                   
//Проверим находимся ли мы на странице с предзаказанным товаром, и преобразуем ссылку в корзину                                                             
if (!empty($arResult["GRID"]["ROWS"]))
{   
    $hasDelayed = '';
    $preorderPage = '';
    foreach ($arResult["GRID"]["ROWS"] as $arItem) {                                       
        if ($arItem["DELAY"] == "Y") {
            $hasDelayed = 'Y'; 
            if (stripos($_SERVER['HTTP_REFERER'], trim($arItem['DETAIL_PAGE_URL'], '/'))) {
                if (strpos($arParams['PATH_TO_ORDER'], '?')) {
                    $arParams['PATH_TO_ORDER'] .= '&preorder=Y';
                }
                else {
                    $arParams['PATH_TO_ORDER'] .= '?preorder=Y';
                } 
            };
        }                
    }
}?>                                     
<div class="confirmTopWrap"> 
    <a href="<?=$arParams['PATH_TO_ORDER']?>">
        <div class="confirm">
            <p><?=GetMessage("TSB1_2ORDER")?></p>
        </div>
    </a>
</div>    
<p class="title <?if($arParams['DELAY'] != 'Y') { echo 'active'; }?>" id="basket_title"><?=GetMessage("TSB1_CART")?></p>      
<?if($hasDelayed == 'Y') {?>
    <p class="title <?if($arParams['DELAY'] == 'Y') { echo 'active'; }?>" id="preorder_title"><?=GetMessage("TSB1_PREORDER")?></p>    
<?}?>  
<?                
if (!empty($arResult["GRID"]["ROWS"]))
{
?>
    <div data-role="basket-item-list" class="basketBooks" id="basket_list" <?if($arParams['DELAY'] == 'Y') { echo 'style="display:none"'; }?>>                                                                         
        <?foreach ($arResult["GRID"]["ROWS"] as $arItem) {
            if ($arItem["DELAY"] == "N") {   
                $thisItem = CIBlockElement::GetList(array(), array("ID"=>$arItem["PRODUCT_ID"]), false, false, array("ID", "DETAIL_PICTURE", "DETAIL_PAGE_URL"))->Fetch();
                $thisItemSect = CIBlockSection::GetByID($thisItem["IBLOCK_SECTION_ID"]) -> Fetch();
                $thisItemPict = CFile::GetPath($thisItem["DETAIL_PICTURE"]);
                if (strlen (stristr($arItem["PRICE"], ".")) == 2) {
                    $arItem["PRICE"] .= "0";
                }?>
                <div class="basketBook" basket-id="<?=$arItem["ID"]?>" product-id="<?=$arItem["PRODUCT_ID"]?>" basket-delay="<?=$arItem["DELAY"]?>"> 
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
                            <?=$arItem["PRICE"]?><span></span>
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
                <?$arResult["TOTAL_ITEMS"] += $arItem["QUANTITY"];    
            } 
            ?>    
        <?}?> 
    </div>
    <?if ($hasDelayed == 'Y') {?>
    <div data-role="preorder-item-list" class="basketBooks" id="preorder_list" <?if($arParams['DELAY'] != 'Y') { echo 'style="display:none"'; }?>>
    <?}?>
        <?foreach ($arResult["GRID"]["ROWS"] as $arItem) {
            if ($arItem["DELAY"] == "Y") {   
                $thisItem = CIBlockElement::GetList(array(), array("ID"=>$arItem["PRODUCT_ID"]), false, false, array("ID", "DETAIL_PICTURE", "DETAIL_PAGE_URL"))->Fetch();
                $thisItemSect = CIBlockSection::GetByID($thisItem["IBLOCK_SECTION_ID"]) -> Fetch();
                $thisItemPict = CFile::GetPath($thisItem["DETAIL_PICTURE"]);
                ?>
                <div class="basketBook" basket-id="<?=$arItem["ID"]?>" product-id="<?=$arItem["PRODUCT_ID"]?>" basket-delay="<?=$arItem["DELAY"]?>"> 
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
                            <?=$arItem["PRICE"]?><span></span>
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
            } 
            ?>    
        <?}?> 
    </div>  
<?}
if (strlen (stristr($arResult["allSum"], ".")) == 2) {
    $arResult["allSum"] .= "0";
}?>
<div class="bottomBlock">
    <div class="result" <?if($arParams['DELAY'] == 'Y') { echo 'style="display:none"'; }?>>
        <p class="resultText"><?=GetMessage("TSB1_RESULT")?></p>
        <p class="count"><?=GetMessage("TSB1_TOTAL_PRICE")?><?=$arResult["TOTAL_ITEMS"]?></p>
        <p class='price'><?=$arResult["allSum"]?><b class="rubsign"></b></p>
    </div>

    <a href="<?=$arParams['PATH_TO_ORDER']?>" class="bottomBasketConfirm">
        <div class="confirm">
            <p><?=GetMessage("TSB1_2ORDER")?></p>
        </div>
    </a>
</div>     