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
global $authorName;
?>
<div class="autorBooksWrap" itemscope itemtype="http://schema.org/ItemList">
	<a name="books" />
	<link itemprop="url" href="<?=$_SERVER['REQUEST_URI']?>#books" />
    <div class="catalogWrapper">
        <h2 style="margin:0;" class="titleMain" itemprop="name">Книги <?=$authorName?></h2>
        <div class="catalogBooks">
            <?foreach($arResult["ITEMS"] as $arItem)
                {
                    foreach ($arItem["PRICES"] as $code => $arPrice)
                    {
                        //if ($arPrice["PRINT_DISCOUNT_VALUE"])
                        //{
                            $pict = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width'=>147, 'height'=>216), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                        ?>
                    <div class="bookWrapp" itemprop="itemListElement" itemscope itemtype="http://schema.org/Book">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                        <div class="section_item_img">
                            <img src="<?=$pict["src"]?>" itemprop="image" alt="Книга «<?=$arItem["NAME"]?>»" title="Книга «<?=$arItem["NAME"]?>»">
                        </div>
                        <p class="bookName" itemprop="name"><?=$arItem["NAME"]?></p>
                        </a>
						<meta itemprop="description" content="<?=htmlspecialchars(strip_tags($arItem['PREVIEW_TEXT']))?>" />
                        <?
                        if (intval($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) != 22 && intval($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) != 23)
                        {  
                            if ($arPrice["DISCOUNT_VALUE_VAT"])
                            {
                            ?>
                            <p class="bookPrice" itemprop="offers" itemscope itemtype="http://schema.org/Offer"><link itemprop="availability" href="http://schema.org/InStock"><span itemprop="price"><?=ceil($arPrice["DISCOUNT_VALUE_VAT"])?></span></p>
                            <?
                            }
                            else
                            {
                            ?>
                            <p class="bookPrice"itemprop="offers" itemscope itemtype="http://schema.org/Offer"><link itemprop="availability" href="http://schema.org/InStock"><span itemprop="price"><?=ceil($arPrice["ORIG_VALUE_VAT"])?></span></p>
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
                            <p class="bookPrice"><?=strtolower(FormatDate("j F", MakeTimeStamp($arItem['PROPERTIES']['SOON_DATE_TIME']['VALUE'], "DD.MM.YYYY")));?></p>
                    
                    <?      }
                        //}
                    }?>
                    </div>
                <?
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
        if (page >= maxpage)
        {
            $(".allBooks").hide();
        }
            $('.allBooks').click(function(){
                $.get('<?=$_SERVER["SCRIPT_URI"]?>'+'?PAGEN_<?=$navnum?>='+page, function(data) {
                    var next_page = $('.catalogBooks .bookWrapp', data);
                    //$('.catalogBooks').append('<br /><h3>Страница '+ page +'</h3><br />');
                    $('.catalogBooks').append(next_page);
                    page++;            
                })
                .done(function() {
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
