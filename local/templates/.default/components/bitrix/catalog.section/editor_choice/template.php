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

<style>
.allBooksWrapp .bookName {
	padding-top:0;
	margin-top:16px;
}
</style>
<div class="allBooksWrapp">
            <div class="catalogWrapper">
            
                <div class="catalogIcon editorsCatalogIcon"></div>
                <div class="basketIcon editorsBasketIcon"></div>
                <p class="titleMain"><?$APPLICATION->ShowTitle()?></p>
                <div class="catalogBooks">
                    <?foreach($arResult["ITEMS"] as $arItem)
                    {
                        foreach ($arItem["PRICES"] as $code => $arPrice)
                        {
                            if ($arPrice["PRINT_DISCOUNT_VALUE"])
                            {
                        $pict = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array('width'=>142, 'height'=>210), BX_RESIZE_IMAGE_PROPORTIONA, true);
                        $dbBasketItems = CSaleBasket::GetList(array(), array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL", "PRODUCT_ID" => $arItem["ID"]), false, false, array("ID", "CALLBACK_FUNC", "MODULE", "PRODUCT_ID", "QUANTITY", "PRODUCT_PROVIDER_CLASS"))->Fetch();
                        $curr_author = CIBlockElement::GetByID($arItem["PROPERTIES"]["AUTHORS"]["VALUE"][0]) -> Fetch();
                        ?>
                    <div class="bookWrapp">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                            <div class="section_item_img">
                                <?
                                if ($pict["src"])
                                {
                                ?>               
                                    <img src=<?=$pict["src"]?>>
                                <?
                                }
                                else
                                {
                                ?>
                                    <img src="/images/no_photo.png" width="142" height="142">    
                                <?
                                }
                                ?>
                            </div>
                        <p class="bookName" title="<?=$arItem["NAME"]?>"><?=$arItem["NAME"]?></p>
                        <p class="bookAutor"><?=$curr_author["NAME"]?></p>
                        <p class="tapeOfPack"><?=$arItem["PROPERTIES"]["COVER_TYPE"]["VALUE"]?></p>
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
                                ?>
                                </a>
                                <?  
                                if ($dbBasketItems["QUANTITY"] == 0)
                                {?>
                                    <a class="product<?=$arItem["ID"];?>" href="<?echo $arItem["ADD_URL"]?>" onclick="addtocart(<?=$arItem["ID"];?>, '<?=$arItem["NAME"];?>');return false;"><p class="basketBook">В корзину</p></a>
                                <?   
                                }
                                else
                                {
                                    ?>
                                <a class="product<?=$arItem["ID"];?>" href="/personal/cart/"><p class="basketBook" style="background-color: #A9A9A9;color: white;">Оформить</p></a> 
                                <?
                                }
                            }
                            else if (intval($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) == 23)
                            {?>
                            <p class="bookPrice"><?=$arItem["PROPERTIES"]["STATE"]["VALUE"]?></p>
                            </a>        
                            <?}
                            else
                            {?>
                            <p class="bookPrice"><?=strtolower(FormatDate("j F", MakeTimeStamp($arItem['PROPERTIES']['SOON_DATE_TIME']['VALUE'], "DD.MM.YYYY HH:MI:SS")));?></p>
                            </a>    
                            <?}
                        ?>
                        <?
                            if ($USER -> IsAuthorized())
                            {
                            ?>
                            <p class="basketLater" id="<?=$arItem["ID"]?>">Куплю позже</p>
                            <?
                            }
                        ?>
                        </a>
                    </div>
                    <?      }
                        }
                    }?>
                </div>
                <div class="wishlist_info">
                    <div class="CloseWishlist"><img src="/img/catalogLeftClose.png"></div>
                    <span></span>
                </div>
                <a href="#" class="allBooks">Показать ещё</a>
            </div>
</div>

<script>
// скрипт ajax-подгрузки товаров в блоке "Все книги"
$(document).ready(function() {
        <?$navnum = $arResult["NAV_RESULT"]->NavNum;?>
        <?if (isset($_REQUEST["PAGEN_".$navnum])) {?>
            var page = <?=$_REQUEST["PAGEN_".$navnum]?> + 1;
        <?}else{?>
            var page = 2;
        <?}?>
        var maxpage = <?=($arResult["NAV_RESULT"]->NavPageCount)?>;
            $('.allBooks').click(function(){
                $.fancybox.showLoading();
                $.get('<?=$arResult["SECTION_PAGE_URL"]?>?PAGEN_<?=$navnum?>='+page, function(data) {
                    var next_page = $('.catalogBooks .bookWrapp', data);
                    //$('.catalogBooks').append('<br /><h3>Страница '+ page +'</h3><br />');
                    $('.catalogBooks').append(next_page);
                    page++;            
                })
                .done(function() 
                {
                    $.fancybox.hideLoading();
                    $(".bookName").each(function()
                    {
                        if($(this).length > 0)
                        {
                            $(this).html(truncate($(this).html(), 40));    
                        }    
                    });
    
                });
                if (page == maxpage) {
                    $('.allBooks').hide();
                    //$('.phpages').hide();
                }
                return false;
            });
});
</script>
