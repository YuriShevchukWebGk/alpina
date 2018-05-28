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
    $gdeSlon = '';
$is_bot_detected = false;
if (isset($_SERVER["HTTP_USER_AGENT"]) && preg_match('/bot|crawl|slurp|spider|mediapartners/i', $_SERVER['HTTP_USER_AGENT'])) {
    $is_bot_detected = true;
}?>
<?if ($_REQUEST["DIRECTION"] == "DESC") {?>
    <style>
        .filterParams .active p:after {
            -moz-transform: scaleX(-1);
            -o-transform: scaleX(-1);
            -webkit-transform: scaleX(-1);
            transform: scaleX(-1);
            position: absolute;
        }

        .wrapperCategor .filterParams li.active {
            width:128px;
        }
    </style>
<?}?>
<style>
.childrenBooksBlock {

}
.childrenBooksBlock .seriesBlock {
    width: 619px;
    height: 51px;
}

.childrenBooksBlock .seriesTitle{
    display: inline-block;
}

.childrenBooksBlock .seriesTitle h2{
    font-size: 36px;
    font-weight: normal;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    text-align: left;
    color: #3f4a4d;
    margin: 0;
}

.childrenBooksBlock .allBooksButton {
    width: 117px;
    height: 34px;
    border-radius: 25px;
    border: solid 1px #17b2c4;
    text-align: center;
    line-height: 33px;
    display: inline-block;
    float: none;
    margin-top: 10px;
    margin-left: 30px;
    vertical-align: 6px;
}

.categoryWrapper .childrenBooksBlock .categoryBooks:hover {
    height: auto;
}

.categoryWrapper .childrenBooksBlock .otherBooks {
    margin-top: 47px;
}

.forChildrenWrapper .categoryWrapper .otherBooks li {
    display: inline-block;
    height: 470px;
    width: 216px;
    float: left;
}

.forChildrenWrapper .categoryWrapper .otherBooks li.bigItem {
    display: inline-block;
    height: 900px;
    width: 360px;
    margin-right: 84px;
}

.forChildrenWrapper .categoryWrapper .otherBooks li.bigItem .section_item_img {
    height: 528px;
    width: 360px;
    text-align: center;
    vertical-align: middle;
}

.forChildrenWrapper .categoryWrapper .otherBooks li.bigItem .section_item_img img {
    width: 360px;
}

.forChildrenWrapper .categoryWrapper .otherBooks li.bigItem .detailText{
    display: inline-block;
    padding-left: 4px;
    padding-top: 24px;
}

</style>
<div class="contentWrapp childrenBooksBlock">
    <div class="seriesBlock">
        <div class="seriesTitle">
            <h2><?=$arParams["SERIES_NAME"]?></h2>
        </div>
        <div class="allBooksButton">
            <a href="<?=$arParams["BUTTON_HREF"]?>"><?=$arParams["BUTTON_NAME"]?></a>
        </div>
    </div>
    <div class="otherBooks">
        <ul>
            <?foreach ($arResult["ITEMS"] as $arItem) {

                if($arItem["BIG_ITEM"]) {
                    $pict = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array('width'=>360, 'height'=>528), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                } else {
                    $pict = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array('width'=>147, 'height'=>216), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                }

                foreach ($arItem["PRICES"] as $code => $arPrice) {
                ?>
                <li <?if($arItem["BIG_ITEM"]) { echo "class='bigItem'"; }?>>
                    <div class="categoryBooks">
                        <div class="sect_badge">
                            <?if(($arItem["PROPERTIES"]["discount_ban"]["VALUE"] != "Y") && $arItem['PROPERTIES']['spec_price']['VALUE'])  {
                                switch ($arItem['PROPERTIES']['spec_price']['VALUE']) {
                                    case 10:
                                        echo '<img class="discount_badge" src="/img/10percent.png">';
                                    break;
                                    case 15:
                                        echo '<img class="discount_badge" src="/img/15percent.png">';
                                    break;
                                    case 20:
                                        echo '<img class="discount_badge" src="/img/20percent.png">';
                                    break;
                                    case 30:
                                        echo '<img class="discount_badge" src="/img/30percent.png">';
                                    break;
                                    case 40:
                                        echo '<img class="discount_badge" src="/img/40percent_black.png">';
                                    break;
                                }
                            }?>
                        </div>
                        <?
                        $dbBasketItems = CSaleBasket::GetList(array(), array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL", "PRODUCT_ID" => $arItem["ID"]), false, false, array("ID", "CALLBACK_FUNC", "MODULE", "PRODUCT_ID", "QUANTITY", "PRODUCT_PROVIDER_CLASS"))->Fetch();

                        $curr_author = CIBlockElement::GetByID($arItem["PROPERTIES"]["AUTHORS"]["VALUE"][0]) -> Fetch();
                        ?>
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                            <div class="section_item_img">
                                <?if ($pict["src"]) {?>
                                    <img src="<?=$pict["src"]?>" alt="<?=$arItem["NAME"];?>">
                                <?} else {?>
                                    <img src="/images/no_photo.png" width="142" height="142">
                                <?}?>
                            </div>
                            <p class="nameBook"><?=$arItem["NAME"]?></p>
                        </a>
                        <p class="bookAutor" title="<?=$curr_author["NAME"]?>"><?echo mb_strlen($curr_author["NAME"]) > 18 ? mb_substr($curr_author["NAME"],0,15).'...' : $curr_author["NAME"]?></p>
                        <p class="tapeOfPack"><?=$arItem["PROPERTIES"]["COVER_TYPE"]["VALUE"]?></p>
                        <?if($arItem["BIG_ITEM"]) {?>
                        <div class="detailText">
                            <?=$arItem["DETAIL_TEXT"]?>
                        </div>
                        <?}?>
                        <?
                        if (intval($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) != 22 && intval($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) != 23) {
                        ?>
                            <p class="priceOfBook"><?=ceil($arPrice["DISCOUNT_VALUE_VAT"])?> <? if (!$is_bot_detected){?><span class="rub_symbol">i</span><?} else {?><span>руб.</span><?}?></p>
                            <?if ($dbBasketItems["QUANTITY"] == 0) {?>
                                <a class="product<?=$arItem["ID"];?>" href="<?echo $arItem["ADD_URL"]?>" onclick="addtocart(<?=$arItem["ID"];?>, '<?=$arItem["NAME"];?>');return false;"><p class="basketBook">В корзину</p></a>
                            <?} else {?>
                                <a class="product<?=$arItem["ID"];?>" href="/personal/cart/"><p class="basketBook" style="background-color: #A9A9A9;color: white;">Оформить</p></a>
                            <?}
                        } else if (intval($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) == 23) {?>
                            <p class="priceOfBook"><?=$arItem["PROPERTIES"]["STATE"]["VALUE"]?></p>
                        <?} else {?>
                            <p class="priceOfBook"><?=strtolower(FormatDate("f Y", MakeTimeStamp($arItem['PROPERTIES']['SOON_DATE_TIME']['VALUE'], "DD.MM.YYYY HH:MI:SS")));?></p>
                            <a class="product<?=$arItem["ID"];?>" href="<?echo $arItem["ADD_URL"]?>" onclick="addtocart(<?=$arItem["ID"];?>, '<?=$arItem["NAME"];?>');return false;"><p class="basketBook">Предзаказ</p></a>
                        <?}
                        $gdeSlon .= $arItem['ID'].':'.ceil($arPrice["DISCOUNT_VALUE_VAT"]).',';
                        if ($USER -> IsAuthorized()) {?>
                            <p class="basketLater" id="<?=$arItem["ID"]?>">Куплю позже</p>
                        <?}?>
                    </div>
                </li>
                <?
                }
            }?>
        </ul>
    </div>
</div>


<!-- GdeSlon -->
<script type="text/javascript" src="//www.gdeslon.ru/landing.js?mode=list&amp;codes=<?=substr($gdeSlon,0,-1)?>&amp;mid=79276"></script>
<script>
    // скрипт ajax-подгрузки товаров в блоке "Все книги"
    $(document).ready(function() {

        $(".bigItem .detailText").each(function(e) {
            $(this).find("h3").remove();
            if($(this).length > 0) {
                $(this).html(truncate($(this).html(), 360));
            }
        });

        <?$navnum = $arResult["NAV_RESULT"]->NavNum;?>
        <?if (isset($_REQUEST["PAGEN_".$navnum])) {?>
            var page = <?=$_REQUEST["PAGEN_".$navnum]?> + 1;
            <?}else{?>
            var page = 2;
            <?}?>
        var maxpage = <?=($arResult["NAV_RESULT"]->NavPageCount)?>;
        $('.showMore').click(function(){
            var otherBooks = $(this).siblings(".otherBooks");

            <?if (isset($_REQUEST["SORT"])) {?>
                var section_url = '<?= $arResult["SECTION_PAGE_URL"] . "?" . $_SERVER["QUERY_STRING"] . "&PAGEN_" . $navnum . "=" ?>';
            <?} else {?>
                var section_url = '<?= $arResult["SECTION_PAGE_URL"] . "?PAGEN_" . $navnum . "=" ?>';
            <?}?>
            $.get(section_url + page, function(data) {
                var next_page = $('.otherBooks ul li', data);
                //$('.catalogBooks').append('<br /><h3>Страница '+ page +'</h3><br />');
                $('.otherBooks ul').append(next_page);
                page++;
            })
            .done(function() {
                $(".nameBook").each(function() {
                    if($(this).length > 0) {
                        $(this).html(truncate($(this).html(), 40));
                    }
                });
                var otherBooksHeight = 1340 * Math.ceil(($(".otherBooks ul li").length / 15));
                //var categorHeight = 2750 + 1190 * (($(".otherBooks ul li").length - 15) / 15);
                var categorHeight = 1600 + Math.ceil(($(".otherBooks ul li").length - 15) / 5) * 450;
                otherBooks.css("height", otherBooksHeight+"px");
                $(".wrapperCategor").css("height", categorHeight+"px");
                $(".contentWrapp").css("height", categorHeight-10+"px");
            });
            if (page == maxpage) {
                $('.showMore').hide();
                //$('.phpages').hide();
            }
            return false;

        });
        <?
        if (!$USER -> IsAuthorized()) {?>
        $(".categoryWrapper .categoryBooks").hover(function(){
            $(this).css("height", "390px");
        });
        <?}?>
    });
</script>