<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if (count($arResult["ITEMS"]) > 0){?>
    <div id="bookInBlogWrap" class="no-mobile">
        <p class="title"><?=GetMessage("TITLE")?></p>
        <div class="bookInBlog">
            <div class="">
                <ul class="bookInBlogPosts">
                    <?foreach ($arResult["ITEMS"] as $arItem) {
                        $pict = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array('width'=>102, 'height'=>102), BX_RESIZE_IMAGE_EXACT, true);?>
						<li class="bookInBlogPost">
							<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="Пост в блоге Альпины «<?=$arItem["NAME"]?>»">
								<img src="<?=$pict["src"]?>" title="Пост в блоге Альпины «<?=$arItem["NAME"]?>»" alt="<?=$arItem["NAME"]?>" />
								<span class="name">
									<span title="Пост в блоге Альпины «<?=$arItem["NAME"]?>»"><?echo strlen($arItem["NAME"])>50 ? substr($arItem["NAME"],0,50).'...' : $arItem["NAME"];?></span>
								</span>
								<p class="author"><?=$arItem["PROPERTIES"]["COVER_TYPE"]["VALUE"]?></p>
							</a>
						</li>
					<?}?>
                </ul>
            </div>
        </div>    
    </div>
<?}?>