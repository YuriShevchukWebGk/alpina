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
<?/*
*/
//arshow($arResult["ITEMS"][0]);
//arshow($arResult);
$navnum = $arResult["NAV_RESULT"]->NavNum;
if ($_REQUEST["PAGEN_".$navnum])
{
    $_SESSION[$APPLICATION -> GetCurDir()] = $_REQUEST["PAGEN_".$navnum];
}
?>

<div class="allBooksWrapp">
            <div class="catalogWrapper">
                <p class="titleMain"><a href="/catalog/all-books/">Все лучшие книги</a></p>
                <div class="catalogBooks">
                    <?foreach($arResult["ITEMS"] as $cell => $arItem)
                    {
                        foreach ($arItem["PRICES"] as $code => $arPrice)
                        {
                            if ($arPrice["VALUE"])
                            {
                                $pict = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width'=>147, 'height'=>216), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                                $curr_author = CIBlockElement::GetByID($arItem["PROPERTIES"]["AUTHORS"]["VALUE"][0]) -> Fetch();
                            ?>
                            <div class="bookWrapp">
                                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" onclick="productClickTracking(<?= $arItem["ID"];?>, '<?= $arItem["NAME"];?>', '<?= ceil($arPrice["DISCOUNT_VALUE_VAT"])?>','', <?= ($cell+1)?>, 'Allbooks Main');">
                                    <div class="item_img">   
                                             <?if($pict["src"] != ''){?>
                                                <img src="<?=$pict["src"]?>">    
                                             <?}else{?>
                                                <img src="/images/no_photo.png">      
                                             <?}?>
                                            <?if(!empty($arItem["PROPERTIES"]["number_volumes"]["VALUE"])){?>
                                              <span class="volumes"><?=$arItem["PROPERTIES"]["number_volumes"]["VALUE"]?></span>
                                            <?}?>
                                    </div>
                                    <p class="bookName" title="<?=$arItem["NAME"]?>"><?=$arItem["NAME"]?></p>
                                    <p class="bookAutor"><?=$curr_author["NAME"]?></p>
                                    <p class="tapeOfPack"><?=$arItem["PROPERTIES"]["COVER_TYPE"]["VALUE"]?></p>
                                    <?
                                        if ($arPrice["DISCOUNT_VALUE_VAT"])
                                        {
                                        ?>
                                        <p class="bookPrice"><?=ceil($arPrice["DISCOUNT_VALUE_VAT"])?><span></span></p>
                                        <?
                                        }
                                        else
                                        {
                                        ?>
                                        <p class="bookPrice"><?=ceil($arPrice["ORIG_VALUE_VAT"])?><span></span></p>
                                        <?
                                        }
                                    ?>
                                </a>
                            </div>
                            <?      
                            } 
                        }
                    }?>
                </div>
				<?echo $_REQUEST["SORT"]?>
                <a href="#" class="allBooks">Показать ещё</a>
            </div>
</div>
<?
    if (!isset($_SESSION[$APPLICATION -> GetCurDir()]))
    {
        $_SESSION[$APPLICATION -> GetCurDir()] = 1;
    }
?>
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
			$.get('/catalog/all-books/?SORT=POPULARITY&PAGEN_<?=$navnum?>='+page, function(data) {
				var next_page = $('.catalogBooks .bookWrapp', data);
				$('.catalogBooks').append(next_page);
				page++;          
			})
			.done(function() {
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
			}
			return false;
		});
    });
</script>
