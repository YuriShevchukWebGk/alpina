<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
/** @var CBitrixComponent $component */?>
<div class="search-page" itemprop="mainEntity" itemscope itemtype="http://schema.org/ItemList">
	<link itemprop="url" href="<?=$_SERVER['REQUEST_URI']?>" />
    <?if (isset($arResult["REQUEST"]["ORIGINAL_QUERY"])) {?>
        <div class="search-language-guess">
            <?= GetMessage("CT_BSP_KEYBOARD_WARNING", array("#query#"=>'<a href="'.$arResult["ORIGINAL_QUERY_URL"].'">'.$arResult["REQUEST"]["ORIGINAL_QUERY"].'</a>')) ?>
            </div>
    <?}?>
    <?

	if (count($arResult["SEARCH"]) > 0) {?>
		<?$gdeslon = '';?>
        <div class="pageTitleWrap">
            <div class="catalogWrapper">
                <div class="catalogIcon searchCatalogModified">
                </div>
                <div class="basketIcon searchBasketModified">
                </div>
                <p class="title">Результаты поиска
                    <?if(is_object($arResult["NAV_RESULT"])) {?>
                        <span>по запросу "<?= $arResult["REQUEST"]["QUERY"] ?>" (<span itemprop="numberOfItems"><?= $arResult["NAV_RESULT"]->SelectedRowsCount()?> </span> результатов)</span>
                    <?}?>
                </p>
            </div>
        </div>


        <div class="AuthorsWrapp">
            <p class="title"></p>
            <div class="searchBooksWrap">
                <div class="searchWidthWrapper">
                    <?foreach($arResult["SEARCH"] as $arItem) {
                        if ($arItem["PARAM2"] == 71) {?>
                            <div class="searchBook" itemprop="itemListElement">
								<?$gdeslon .= $arItem["ITEM_ID"].':'.ceil( $newPrice).',';?>
                                <div>
                                    <a href="<?= $arItem["URL"]?>">
                                        <div class="search_item_img">
                                            <?if ($arResult["BLOG_INFO"][$arItem["ITEM_ID"]]["PICTURE"]["src"]) {?>
                                                <img src="<?=$arResult["BLOG_INFO"][$arItem["ITEM_ID"]]["PICTURE"]["src"]?>" itemprop="image">
                                            <?} else {?>
                                                <img src="/images/no_photo.png" width="155">
                                            <?}?>
                                        </div>
                                    </a>
                                </div>
                                <div class="descrWrap">
                                    <a href="<?= $arItem["URL"] ?>" itemprop="url">
                                        <p class="bookNames" title="<?= $arItem["TITLE"] ?>" itemprop="name"><?= $arItem["TITLE"] ?></p>
                                        <p class="autorName" itemprop="author"><?= $arResult["BOOK_AUTHOR_INFO"][$arResult["BLOG_INFO"][$arItem["ITEM_ID"]]["PROPERTY_AUTHORS_VALUE"]]?></p>
                                        <p class="wrapperType"><?= $arResult["BLOG_INFO"][$arItem["ITEM_ID"]]["PROPERTY_COVER_TYPE_VALUE"]?></p>

                                        <div class="description" itemprop="description"><?= $arItem["BODY_FORMATED"]?></div>

                                    </a>
                                </div>
                            </div>
                        <?}?>
                    <?}?>
                </div>
            </div>
        </div>

        <p>
        </p>
		<!-- gdeslon -->
		<script type="text/javascript" src="https://www.gdeslon.ru/landing.js?mode=list&amp;codes=<?=substr($gdeslon,0,-1)?>&amp;mid=79276&amp;cat_id=<?= $arResult['ID'];?>"></script>

    <?} else {?>
        <div class="catalogIcon">
        </div>
        <div class="basketIcon">
        </div>

        <div class="noResultBodyWrap">
            <div class="centerWrapper noResWrapp">
                <p class="noResultTitle">По вашему запросу ничего не найдено</p>
                <p class="noResText">К сожалению, по запросу "<?= $_REQUEST["q"] ?>" ничего не найдено, попробуйте изменить поисковый запрос или следуйте нашим рекомендациям.</p>
            </div>
        </div>
		<script type="text/javascript">
			$(document).ready(function() {
				dataLayer.push({
					event: 'searchResults',
					action: 'nothingFound',
					label: '<?=$_REQUEST["q"]?>'
				});
			});
		</script>

    <?}?>
</div>

<script>

var x = function(a, i) {
  return a.slice(0, i).join(' ');
};

/**
 * requires element to be width/height limited
 * element must be in the DOM and can't be with display none, put it with visibility hidden instead
 * element shall have no sub elements either O:)
 */
var ellipsisFill = function(e) {
  var d = '...',
      h = e.offsetHeight,
      w = e.innerHTML.split(' '),
      i = 0,
      l = w.length;
  e.innerHTML = '';
  while (h >= e.scrollHeight && i <= l) {
    e.innerHTML = x(w, ++i) + d;
  }
  if (i > l) { e.innerHTML = x(w,   i);     }
  else {       e.innerHTML = x(w, --i) + d; }
};


$(document).ready(function(){

    var elii = document.querySelectorAll('.bookNames');
    Array.prototype.forEach.call(elii, function(el, i){
           ellipsisFill(el);
    })



    updateSearchPage();


    // слайдер "те кто искали ..., купили"
    if($('.bookEasySlider').length > 0) {
        easySlider('.bookEasySlider', 6);
    }
    // скрывать заголовок блоков, если данный блок не содержит элементов
    if ($(".AuthorsWrapp .searchWidthWrapper .searchBook").size() == 0) {
        $(".AuthorsWrapp .title").hide();
    }
    if ($(".BooksWrapp .searchWidthWrapper .searchBook").size() == 0) {
        $(".BooksWrapp .title").hide();
    }
    if ($(".SeriesWrapp .searchWidthWrapper .searchBook").size() == 0) {
        $(".SeriesWrapp .title").hide();
    }
});

</script>