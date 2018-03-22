<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$i = 1;
if (count($arResult["ITEMS"]) > 0){?>
    <div id="bookInBlogWrap" class="no-mobile">
        <p class="titleMain title"><a href="/blog/"><?=GetMessage("TITLE")?></a></p>
        <div class="bookInBlog">
            <div class="">
                <ul class="bookInBlogPosts">
                    <?foreach ($arResult["ITEMS"] as $arItem) {
						if (!empty($arItem["IBLOCK_SECTION_ID"])) {
							$section = CIBlockSection::GetByID($arItem["IBLOCK_SECTION_ID"]);
							$section = $section->GetNext();
						}
						if ($i == 1) {
							$pict = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array('width'=>388, 'height'=>226), BX_RESIZE_IMAGE_EXACT, true);?>
							<li class="bookInBlogPost mainPostInBlog">
								<div class="date"><?=strtoupper(FormatDate("d M", MakeTimeStamp($arItem["ACTIVE_FROM"])))?></div>
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="Пост в блоге Альпины «<?=$arItem["NAME"]?>»">
									<img src="<?=$pict["src"]?>" title="Пост в блоге Альпины «<?=$arItem["NAME"]?>»" alt="<?=$arItem["NAME"]?>" />
									<span class="name">
										<?if ($section) {?>
											<div class="cat"><?=$section["NAME"]?></div>
										<?}?>
										<span title="Пост в блоге Альпины «<?=$arItem["NAME"]?>»"><?echo strlen($arItem["NAME"])>50 ? substr($arItem["NAME"],0,50).'...' : $arItem["NAME"];?></span>
									</span>
									<p class="author"><?=$arItem["PROPERTIES"]["COVER_TYPE"]["VALUE"]?></p>
								</a>
							</li>
						<?} else {
							$pict = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array('width'=>102, 'height'=>102), BX_RESIZE_IMAGE_EXACT, true);?>
							<li class="bookInBlogPost">
								<div class="date"><?=strtoupper(FormatDate("d M", MakeTimeStamp($arItem["ACTIVE_FROM"])))?></div>
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="Пост в блоге Альпины «<?=$arItem["NAME"]?>»">
									<img src="<?=$pict["src"]?>" title="Пост в блоге Альпины «<?=$arItem["NAME"]?>»" alt="<?=$arItem["NAME"]?>" />
									<span class="name">
										<?if ($section) {?>
											<div class="cat"><?=$section["NAME"]?></div>
										<?}?>
										<span title="Пост в блоге Альпины «<?=$arItem["NAME"]?>»"><?echo strlen($arItem["NAME"])>50 ? substr($arItem["NAME"],0,50).'...' : $arItem["NAME"];?></span>
									</span>
									<p class="author"><?=$arItem["PROPERTIES"]["COVER_TYPE"]["VALUE"]?></p>
								</a>
							</li>
						<?}
						$i++;?>
					<?}?>
                </ul>
            </div>
        </div>    
    </div>
<?}?>