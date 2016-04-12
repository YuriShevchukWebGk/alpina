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


<div class="allBooksWrapp">
            <div class="catalogWrapper">
            
                <div class="catalogIcon comingSoonCatIcon"></div>
                <div class="basketIcon comingSoonBasIcon"></div>
            
                <p class="titleMain"><?$APPLICATION->ShowTitle()?></p>
                <div class="catalogBooks">
                    <?foreach($arResult["ITEMS"] as $arItem)
                    {
                        foreach ($arItem["PRICES"] as $code => $arPrice)
                        {
                            if ($arPrice["PRINT_DISCOUNT_VALUE"])
                            {
                        $pict = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width'=>142, 'height'=>210), BX_RESIZE_IMAGE_EXACT, true);
                        ?>
                    <div class="bookWrapp">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                        <img src="<?=$pict["src"]?>">
                        </a>
                        <p class="bookName"><?=$arItem["NAME"]?></p>
                        <p class="bookPrice"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></p>
                    </div>
                    <?      }
                        }
                    }?>
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
                            $(this).html(truncate($(this).html(), 20));    
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
