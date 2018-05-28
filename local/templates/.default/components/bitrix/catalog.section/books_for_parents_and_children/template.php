<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    /** @var array $arResult["ORIGINAL_PARAMETERS"] */
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
.wrapperCategor, .categoryWrapper .contentWrapp {height:auto;}
</style>
<?
$navnum = $arResult["NAV_RESULT"]->NavNum;
if ($_REQUEST["PAGEN_" . $navnum]) {
    //$_SESSION[$APPLICATION -> GetCurDir()] = $_REQUEST["PAGEN_" . $navnum];
}
if($arResult["ID"] == SECTION_ID_FOR_CHILDREN){
    $for_chyldren = "";
}
$for_chyldren = false;
$is_bot_detected = false;
if (isset($_SERVER["HTTP_USER_AGENT"]) && preg_match('/bot|crawl|slurp|spider|mediapartners/i', $_SERVER['HTTP_USER_AGENT'])) {
    $is_bot_detected = true;
}?>


<style>
.wrapperCategor.forChildrenWrapper {
    background-color: #fff6e5;
    overflow: hidden;
}

.wrapperCategor.forChildrenWrapper .categoryWrapper {
    background-color: #fff6e5;
}

.wrapperCategor.forChildrenWrapper .categoryWrapper h1 {
    color: #e7a41b;
    margin-bottom: -38px;
}

.wrapperCategor.forChildrenWrapper .categoryWrapper .alpinaChildrenLogo {
    width: 137px;
    height: 53px;
    object-fit: contain;
}

.wrapperCategor.forChildrenWrapper .categoryWrapper .alpinaChildrenLogo {
    width: 137px;
    height: 53px;
    object-fit: contain;
}

.wrapperCategor.forChildrenWrapper .doner_tags a, .wrapperCategor.forChildrenWrapper .doner_tags span {
    margin-bottom: 0px;
}

.wrapperCategor.forChildrenWrapper .categoryWrapper .sectionTextWrap {
    position: relative;
    margin-top: 30px;
}

.wrapperCategor.forChildrenWrapper .categoryWrapper .sectionTextWrap p{
    width: 556px;
    height: 120px;
    font-family: Walshein_regular;
    font-size: 16px;
    font-weight: normal;
    font-style: normal;
    font-stretch: normal;
    line-height: 1.5;
    letter-spacing: normal;
    text-align: left;
    color: #555e60;
    position: relative;
    z-index: 1;
}

.wrapperCategor.forChildrenWrapper .categoryWrapper .sectionTextWrap img{
    position: absolute;
    bottom: -14px;
    right: -60px;
    z-index: 0;
}

.wrapperCategor.forChildrenWrapper .categoryWrapper .sectionTextWrap img{
    position: absolute;
    bottom: -14px;
    right: -60px;
    z-index: 0;
}

.wrapperCategor.forChildrenWrapper .categoryWrapper .childBannerBlocks{
    margin-top: 45px;
}

.wrapperCategor.forChildrenWrapper .categoryWrapper .childBannerBlocks .childBannerBlock{
    width: 285px;
    height: 268px;
    display: inline-block;
    margin: 0 5px;
}

.wrapperCategor.forChildrenWrapper .categoryWrapper .childBannerBlocks .childBannerBlock:first-child{
    margin: 0 5px 0 0;
}

.wrapperCategor.forChildrenWrapper .categoryWrapper .childBannerBlocks .childBannerBlock:last-child{
    margin: 0 0 0 5px;
}

.wrapperCategor.forChildrenWrapper .categoryWrapper .childBannerBlocks .childBannerBlock img{
    max-width:100%;
    max-height:100%;
    height: auto;
    border-radius: 5px;
}

.wrapperCategor.forChildrenWrapper .categoryWrapper .childrenBooks {
    margin-top: 60px;
    overflow: hidden;
}

.socServiceWrap {
    top: 231px;
    right: 60px;
    position: fixed;
    width: 120px;
    text-align: center;
    font-family: Walshein_regular;
    font-size: 16px;
    font-weight: normal;
    font-style: normal;
    font-stretch: normal;
    z-index: 9999;
}

.socServiceWrap .socServiceRound {
    display: block;
    border-radius: 32px;
    width: 64px;
    height: 64px;
    margin: 6px auto;
}

.socServiceWrap .socServiceRound.socServiceInstagram {
    background-color: #404040;
}
.socServiceWrap .socServiceRound.socServiceFacebook {
    background-color: #17b2c4
}
.socServiceWrap .socServiceRound.socServiceVK {
    background-color: #7f92b1;
}

.socServiceWrap .socServiceRound.socServiceInstagram img{
    margin-top: 16px;
    width: 32px;
}
.socServiceWrap .socServiceRound.socServiceFacebook img{
    margin-top: 12px;
    width: 32px;
    margin-left: -7px;
}
.socServiceWrap .socServiceRound.socServiceVK img{
    margin-top: 8px;
    width: 50px;
}

.wrapperCategor.forChildrenWrapper .childrenBooksSubscribe {
    width: 875px;
    height: 409px;
    border-radius: 5px;
    background-color: #e7a65f;
    position: relative;
}

.wrapperCategor.forChildrenWrapper .childrenBooksSubscribe .giftWrap {
    overflow: hidden;
}

.wrapperCategor.forChildrenWrapper .childrenBooksSubscribe .title {
    margin: 40px 0 0 50px;
    width: 391px;
    height: 51px;
    font-size: 36px;
    font-weight: 900;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    text-align: left;
    color: #ffffff;
    overflow: hidden;
}

.wrapperCategor.forChildrenWrapper .childrenBooksSubscribe .description {
    margin: 10px 0 0 50px;
    width: 336px;
    height: 48px;
    font-size: 16px;
    font-weight: normal;
    font-style: normal;
    font-stretch: normal;
    line-height: 1.5;
    letter-spacing: normal;
    text-align: left;
    color: #3f4a4d;
    overflow: hidden;
}

.wrapperCategor.forChildrenWrapper .childrenBooksSubscribe .giftWrap:before {
    content: "";
}

.wrapperCategor.forChildrenWrapper .childrenBooksSubscribe .pii.no-mobile {
    margin: 40px 0 0 50px;
    float: none;
    width: 391px;
    height: 72px;
    font-size: 16px;
    font-weight: normal;
    font-style: normal;
    font-stretch: normal;
    line-height: 1.5;
    letter-spacing: normal;
    text-align: left;
    color: #ffffff;
}

.wrapperCategor.forChildrenWrapper .demarcation {
    width: 875px;
    height: 2px;
    border: solid 1px rgba(151, 151, 151, 0.3);
    position: relative;
}

.wrapperCategor.forChildrenWrapper .demarcation img.bookWithBall {
    position: absolute;
    right: -58px;
    bottom: -70px;
}

.wrapperCategor.forChildrenWrapper .demarcation img.baloons {
    position: absolute;
    left: -190px;
    bottom: -484px;
}

.wrapperCategor.forChildrenWrapper .childrenBooksSubscribe .pii.no-mobile a {
  color: #3f4a4d;
}

.wrapperCategor.forChildrenWrapper .childrenBooksSubscribe form {
    margin: 40px 0 0 50px;
    width: 418px;
    height: 58px;
    position: relative;
}

.wrapperCategor.forChildrenWrapper .childrenBooksSubscribe input[type="text"] {
    background-color: #ffffff;
    box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.14);
    float: none;
    height: 100%;
    margin: 0;
}

.wrapperCategor.forChildrenWrapper .childrenBooksSubscribe input[type="text"]::placeholder {
    opacity: 0.5;
    font-size: 16px;
    font-weight: normal;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    text-align: left;
    color: #637477;
}

.wrapperCategor.forChildrenWrapper input[type="button"] {
    position: absolute;
    right: 22px;
    top: 0px;
    border: none;
    width: 60px;
    height: 58px;
    background: url(/img/giftInpBack.png) no-repeat #fff;
    background-position-y: center;
    cursor: pointer;
}

.wrapperCategor.forChildrenWrapper .giftRound {
    position: absolute;
    width: 80px;
    height: 80px;
    right: 21px;
    top: -10px;
    border-radius: 40px;
    background: url(/img/for_children/gift-2.png) no-repeat #486796;
    background-position: center;
    z-index: 2;
}

.wrapperCategor.forChildrenWrapper .bookCover {
    width: 313px;
    height: 369px;
    box-shadow: 0 10px 15px 0 rgba(147, 109, 63, 0.5);
    right: 40px;
    top: 40px;
    position: absolute;
}

.wrapperCategor.forChildrenWrapper .giftWrap {
    margin: 0px;
    padding: 0px;
    height: 100%;
}

.wrapperCategor.forChildrenWrapper .bookCover img {
    width: 313px;
    position: inherit;
    left: 0;
    top: 0;
    z-index: 1;
}

.wrapperCategor.forChildrenWrapper .childrenCooperation {
    width: 875px;
    height: 243px;
    border-radius: 5px;
    background-color: #ffffff;
    position: relative;
}

.wrapperCategor.forChildrenWrapper .childrenClew {
    position: absolute;
    left: -150px;
}

.wrapperCategor.forChildrenWrapper .childrenCooperation .title {
    margin: 40px 0 0 50px;
    width: 557px;
    height: 51px;
    font-size: 36px;
    font-weight: 900;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    text-align: left;
    color: #486796;
}

.wrapperCategor.forChildrenWrapper .childrenCooperation .textBlock {
    position: relative;
    overflow: hidden;
}

.wrapperCategor.forChildrenWrapper .childrenCooperation .text {
    margin: 10px 0 0 50px;
    width: 461px;
    font-size: 16px;
    font-weight: normal;
    font-style: normal;
    font-stretch: normal;
    line-height: 1.5;
    letter-spacing: normal;
    text-align: left;
    color: #3f4a4d;
}

.wrapperCategor.forChildrenWrapper .childrenCooperation .childrenCooperationImg {
    position: absolute;
    width: 228px;
    height: 282px;
    bottom: 0;
    right: 0;
}


.wrapperCategor.forChildrenWrapper .childrenCooperation .childrenCooperationImg img{
    width: 228px;
    object-fit: contain;
}

.wrapperCategor.forChildrenWrapper .childrenCooperation .childrenCooperationPillow {
    position: absolute;
    width: 119px;
    height: 88px;
    top: 181px;
    left: -59px;
}

.wrapperCategor.forChildrenWrapper .childrenCooperation .childrenCooperationPillow img{
    width: 119px;
    object-fit: contain;
}

.wrapperCategor.forChildrenWrapper .childrenGiftEdition {
    width: auto;
    height: auto;
    position: relative;
    margin-bottom: 80px;
    margin-top: 80px;
}


.wrapperCategor.forChildrenWrapper .childrenGiftEdition .textBlock {
    position: relative;
    overflow: hidden;
}

.wrapperCategor.forChildrenWrapper .childrenGiftEdition .title {
    margin: 0px;
    width: 365px;
    height: 84px;
    font-size: 36px;
    font-weight: 900;
    font-style: normal;
    font-stretch: normal;
    line-height: 1.17;
    letter-spacing: normal;
    text-align: left;
    color: #e23a43;
}

.wrapperCategor.forChildrenWrapper .childrenGiftEdition .text {
    margin: 20px 0 0 0;
    width: 430px;
    height: 48px;
    font-size: 16px;
    font-weight: normal;
    font-style: normal;
    font-stretch: normal;
    line-height: 1.5;
    letter-spacing: normal;
    text-align: left;
    color: #3f4a4d;
}

.wrapperCategor.forChildrenWrapper .childrenGiftEdition .phone {
    margin: 40px 0 0 0;
    width: 278px;
    height: 42px;
    font-size: 36px;
    font-weight: normal;
    font-style: normal;
    font-stretch: normal;
    line-height: 1.17;
    letter-spacing: normal;
    text-align: left;
    color: #414c4f;
}


.wrapperCategor.forChildrenWrapper .childrenGiftEdition .childrenCooperationImg {
    position: absolute;
    width: 228px;
    height: 282px;
    bottom: 0;
    right: 0;
}


.wrapperCategor.forChildrenWrapper .childrenGiftEdition .childrenCooperationImg img{
    width: 228px;
    object-fit: contain;
}

.wrapperCategor.forChildrenWrapper .childrenGiftEdition .childrenCooperationPillow {
    position: absolute;
    width: 119px;
    height: 88px;
    top: 181px;
    left: -59px;
}

.wrapperCategor.forChildrenWrapper .childrenGiftEdition .childrenCooperationPillow img{
    width: 119px;
    object-fit: contain;
}

.wrapperCategor.forChildrenWrapper .childrenGiftEdition .childrenGiftEditionImg {
    position:absolute;
    bottom: -60px;
    right: 0;
}

.wrapperCategor.forChildrenWrapper .childrenGiftEdition .childrenGiftEditionGift {
    position:absolute;
    left: 300px;
    bottom: -84px;
}

.wrapperCategor.forChildrenWrapper .childrenGiftEdition .childrenGiftEditionDog {
    position: absolute;
    left: -237px;
    bottom: -60px;
}
</style>


<div class="socServiceWrap">
    <p>Мы в соцсетях</p>
    <ul>
        <li>
            <a href="https://www.instagram.com/alpinadeti/" class="socServiceRound socServiceInstagram"><img src="/img/instagram-icon-good.png"></a>
        </li>
        <li>
            <a href="https://vk.com/alpinadeti"             class="socServiceRound socServiceVK"><img src="/img/vk-white.png"></a>
        </li>
        <li>
            <a href="https://www.facebook.com/alpinadeti/"  class="socServiceRound socServiceFacebook"><img src="/img/facebook-logo-png-white-i6.png"></a>
        </li>
    </ul>
</div>

<div class="wrapperCategor forChildrenWrapper">
    <div class="categoryWrapper">
        <div class="catalogIcon">
        </div>
        <div class="basketIcon">
        </div>
        <div class="contentWrapp">
            <p class="breadCrump no-mobile" itemprop="breadcrumb" itemscope="" itemtype="https://schema.org/BreadcrumbList">
                <span itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
                    <a href="/" title="Книги Альпина" itemprop="item">
                        <span itemprop="name">Книги Альпина</span>
                    </a>
                    <meta itemprop="position" content="1">
                </span>
                <?
                $num = 2;
                $navChain = CIBlockSection::GetNavChain(4, $arResult["ID"]);
                $stopNum = $navChain->nSelectedCount + 1;
                while ($arNav = $navChain->GetNext()) {?>
                <span itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
                    <span class="gap"></span>
                    <?if ($num != $stopNum) {?>
                        <a href="/catalog<?=$arNav[SECTION_PAGE_URL]?>" title="<?=$arNav[NAME]?>" itemprop="item">
                    <?}?>
                        <span itemprop="name"><?=$arNav[NAME]?></span>
                    <?if ($num != $stopNum) {?>
                        </a>
                    <?}?>
                    <meta itemprop="position" content="<?=$num?>">
                </span>
                <?
                $num++;
                }?>
            </p>
            <div itemprop="mainEntity" itemscope itemtype="http://schema.org/OfferCatalog">
                <link itemprop="url" href="<?=$_SERVER['REQUEST_URI']?>"/>
                <img src="/img/for_children/alpina_children_logo.svg" class="alpinaChildrenLogo">
                <h1 itemprop="name">
                    <?= $arResult["NAME"];?>
                </h1>
                <?
                $arData = array();
                $arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL");
                $arFilter = Array("IBLOCK_ID" => 80, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_THIS_SECTION" => $arResult["ID"]);
                $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
                while($ob = $res->GetNextElement()) {
                    $arData[] = $ob->GetFields();
                }
                if(count($arData) > 0) {?>
                    <div class="doner_tags">
                        <span>Популярные категории</span>
                        <?foreach($arData as $data) {?>
                            <a href="<?=$data["DETAIL_PAGE_URL"]?>"><?=$data["NAME"]?></a>
                        <?}?>
                    </div>
                <?}?>
                <?
                $arFilterSection = Array('IBLOCK_ID'=>$arResult['IBLOCK_ID'],'ID'=>$arResult["ID"], 'GLOBAL_ACTIVE'=>'Y');
                $dbSections = CIBlockSection::GetList(Array(), $arFilterSection, false, Array("ID","UF_TEXT_WRAP_1"));
                if($arSection = $dbSections->fetch()) {
                    $sectionText = $arSection["UF_TEXT_WRAP_1"];
                };
                ?>
                <div class="sectionTextWrap">
                    <?if(strlen($sectionText) > 0) {?>
                        <p><?=$sectionText?></p>
                    <?}?>
                    <img src="/img/for_children/bitmap1.png">
                </div>

                <?//Версточка баннеров?>
                <div class="childBannerBlocks">
                    <div class="childBannerBlock">
                        <?$APPLICATION->IncludeComponent(
                        	"bitrix:main.include",
                        	".default",
                        	array(
                        		"AREA_FILE_SHOW" => "file",
                        		"PATH" => "/include/child1.php",
                        		"COMPONENT_TEMPLATE" => ".default",
                        		"COMPOSITE_FRAME_MODE" => "A",
                        		"COMPOSITE_FRAME_TYPE" => "AUTO",
                        		"EDIT_TEMPLATE" => ""
                        	),
                        	false
                        );?>
                    </div><div class="childBannerBlock">
                        <?$APPLICATION->IncludeComponent(
                        	"bitrix:main.include",
                        	".default",
                        	array(
                        		"AREA_FILE_SHOW" => "file",
                        		"PATH" => "/include/child2.php",
                        		"COMPONENT_TEMPLATE" => ".default",
                        		"COMPOSITE_FRAME_MODE" => "A",
                        		"COMPOSITE_FRAME_TYPE" => "AUTO",
                        		"EDIT_TEMPLATE" => ""
                        	),
                        	false
                        );?>
                    </div><div class="childBannerBlock">
                        <?$APPLICATION->IncludeComponent(
                        	"bitrix:main.include",
                        	".default",
                        	array(
                        		"AREA_FILE_SHOW" => "file",
                        		"PATH" => "/include/child3.php",
                        		"COMPONENT_TEMPLATE" => ".default",
                        		"COMPOSITE_FRAME_MODE" => "A",
                        		"COMPOSITE_FRAME_TYPE" => "AUTO",
                        		"EDIT_TEMPLATE" => ""
                        	),
                        	false
                        );?>
                    </div>
                </div>
                <div class="childrenBooks childrenBooks_1">
                    <?
                    $booksCount = 4;
                    global $arThreeFilter;
                    $arThreeFilter = array(
                        "!PROPERTY_AFTER_THREE_YEARS" => false
                    );
                    $APPLICATION->IncludeComponent(
                        "bitrix:catalog.section",
                        "children_block",
                        array(
                            "IBLOCK_TYPE" => $arResult["ORIGINAL_PARAMETERS"]["IBLOCK_TYPE"],
                            "IBLOCK_ID" => $arResult["ORIGINAL_PARAMETERS"]["IBLOCK_ID"],
                            "SERIES_NAME" => "Книги для детей 2-3",
                            "BUTTON_NAME" => "Все книги",
                            "BUTTON_HREF" => "#",
                            "ELEMENT_SORT_FIELD" => $sort,
                            "ELEMENT_SORT_ORDER" => $order,
                            "ELEMENT_SORT_FIELD2" => "PROPERTY_STATE",
                            "ELEMENT_SORT_ORDER2" => "asc",
                            "PROPERTY_CODE" => $arResult["ORIGINAL_PARAMETERS"]["LIST_PROPERTY_CODE"],
                            "META_KEYWORDS" => $arResult["ORIGINAL_PARAMETERS"]["LIST_META_KEYWORDS"],
                            "META_DESCRIPTION" => $arResult["ORIGINAL_PARAMETERS"]["LIST_META_DESCRIPTION"],
                            "BROWSER_TITLE" => $arResult["ORIGINAL_PARAMETERS"]["LIST_BROWSER_TITLE"],
                            "SET_LAST_MODIFIED" => $arResult["ORIGINAL_PARAMETERS"]["SET_LAST_MODIFIED"],
                            "INCLUDE_SUBSECTIONS" => $arResult["ORIGINAL_PARAMETERS"]["INCLUDE_SUBSECTIONS"],
                            "BASKET_URL" => $arResult["ORIGINAL_PARAMETERS"]["BASKET_URL"],
                            "ACTION_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["ACTION_VARIABLE"],
                            "PRODUCT_ID_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_ID_VARIABLE"],
                            "SECTION_ID_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["SECTION_ID_VARIABLE"],
                            "PRODUCT_QUANTITY_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_QUANTITY_VARIABLE"],
                            "PRODUCT_PROPS_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_PROPS_VARIABLE"],
                            "FILTER_NAME" => "arThreeFilter",
                            "CACHE_TYPE" => $arResult["ORIGINAL_PARAMETERS"]["CACHE_TYPE"],
                            "CACHE_TIME" => $arResult["ORIGINAL_PARAMETERS"]["CACHE_TIME"],
                            "CACHE_FILTER" => $arResult["ORIGINAL_PARAMETERS"]["CACHE_FILTER"],
                            "CACHE_GROUPS" => $arResult["ORIGINAL_PARAMETERS"]["CACHE_GROUPS"],
                            "SET_TITLE" => $arResult["ORIGINAL_PARAMETERS"]["SET_TITLE"],
                            "MESSAGE_404" => $arResult["ORIGINAL_PARAMETERS"]["MESSAGE_404"],
                            "SET_STATUS_404" => $arResult["ORIGINAL_PARAMETERS"]["SET_STATUS_404"],
                            "SHOW_404" => $arResult["ORIGINAL_PARAMETERS"]["SHOW_404"],
                            "FILE_404" => $arResult["ORIGINAL_PARAMETERS"]["FILE_404"],
                            "DISPLAY_COMPARE" => $arResult["ORIGINAL_PARAMETERS"]["USE_COMPARE"],
                            "PAGE_ELEMENT_COUNT" => $booksCount,
                            "LINE_ELEMENT_COUNT" => $booksCount,
                            "PRICE_CODE" => $arResult["ORIGINAL_PARAMETERS"]["PRICE_CODE"],
                            "USE_PRICE_COUNT" => $arResult["ORIGINAL_PARAMETERS"]["USE_PRICE_COUNT"],
                            "SHOW_PRICE_COUNT" => $arResult["ORIGINAL_PARAMETERS"]["SHOW_PRICE_COUNT"],

                            "PRICE_VAT_INCLUDE" => $arResult["ORIGINAL_PARAMETERS"]["PRICE_VAT_INCLUDE"],
                            "USE_PRODUCT_QUANTITY" => $arResult["ORIGINAL_PARAMETERS"]['USE_PRODUCT_QUANTITY'],
                            "ADD_PROPERTIES_TO_BASKET" => (isset($arResult["ORIGINAL_PARAMETERS"]["ADD_PROPERTIES_TO_BASKET"]) ? $arResult["ORIGINAL_PARAMETERS"]["ADD_PROPERTIES_TO_BASKET"] : ''),
                            "PARTIAL_PRODUCT_PROPERTIES" => (isset($arResult["ORIGINAL_PARAMETERS"]["PARTIAL_PRODUCT_PROPERTIES"]) ? $arResult["ORIGINAL_PARAMETERS"]["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                            "PRODUCT_PROPERTIES" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_PROPERTIES"],

                            "DISPLAY_TOP_PAGER" => $arResult["ORIGINAL_PARAMETERS"]["DISPLAY_TOP_PAGER"],
                            "DISPLAY_BOTTOM_PAGER" => $arResult["ORIGINAL_PARAMETERS"]["DISPLAY_BOTTOM_PAGER"],
                            "PAGER_TITLE" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_TITLE"],
                            "PAGER_SHOW_ALWAYS" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_SHOW_ALWAYS"],
                            "PAGER_TEMPLATE" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_TEMPLATE"],
                            "PAGER_DESC_NUMBERING" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_DESC_NUMBERING"],
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_DESC_NUMBERING_CACHE_TIME"],
                            "PAGER_SHOW_ALL" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_SHOW_ALL"],
                            "PAGER_BASE_LINK_ENABLE" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_BASE_LINK_ENABLE"],
                            "PAGER_BASE_LINK" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_BASE_LINK"],
                            "PAGER_PARAMS_NAME" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_PARAMS_NAME"],

                            "OFFERS_CART_PROPERTIES" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_CART_PROPERTIES"],
                            "OFFERS_FIELD_CODE" => $arResult["ORIGINAL_PARAMETERS"]["LIST_OFFERS_FIELD_CODE"],
                            "OFFERS_PROPERTY_CODE" => $arResult["ORIGINAL_PARAMETERS"]["LIST_OFFERS_PROPERTY_CODE"],
                            "OFFERS_SORT_FIELD" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_FIELD"],
                            "OFFERS_SORT_ORDER" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_ORDER"],
                            "OFFERS_SORT_FIELD2" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_FIELD2"],
                            "OFFERS_SORT_ORDER2" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_ORDER2"],
                            "OFFERS_LIMIT" => $arResult["ORIGINAL_PARAMETERS"]["LIST_OFFERS_LIMIT"],

                            "SECTION_ID" => $arResult["ID"],
                            "SECTION_CODE" => $arResult["CODE"],
                            "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                            "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
                            "USE_MAIN_ELEMENT_SECTION" => $arResult["ORIGINAL_PARAMETERS"]["USE_MAIN_ELEMENT_SECTION"],
                            'CONVERT_CURRENCY' => $arResult["ORIGINAL_PARAMETERS"]['CONVERT_CURRENCY'],
                            'CURRENCY_ID' => $arResult["ORIGINAL_PARAMETERS"]['CURRENCY_ID'],
                            'HIDE_NOT_AVAILABLE' => $arResult["ORIGINAL_PARAMETERS"]["HIDE_NOT_AVAILABLE"],

                            'LABEL_PROP' => $arResult["ORIGINAL_PARAMETERS"]['LABEL_PROP'],
                            'ADD_PICT_PROP' => $arResult["ORIGINAL_PARAMETERS"]['ADD_PICT_PROP'],
                            'PRODUCT_DISPLAY_MODE' => $arResult["ORIGINAL_PARAMETERS"]['PRODUCT_DISPLAY_MODE'],

                            'OFFER_ADD_PICT_PROP' => $arResult["ORIGINAL_PARAMETERS"]['OFFER_ADD_PICT_PROP'],
                            'OFFER_TREE_PROPS' => $arResult["ORIGINAL_PARAMETERS"]['OFFER_TREE_PROPS'],
                            'PRODUCT_SUBSCRIPTION' => $arResult["ORIGINAL_PARAMETERS"]['PRODUCT_SUBSCRIPTION'],
                            'SHOW_DISCOUNT_PERCENT' => $arResult["ORIGINAL_PARAMETERS"]['SHOW_DISCOUNT_PERCENT'],
                            'SHOW_OLD_PRICE' => $arResult["ORIGINAL_PARAMETERS"]['SHOW_OLD_PRICE'],
                            'MESS_BTN_BUY' => $arResult["ORIGINAL_PARAMETERS"]['MESS_BTN_BUY'],
                            'MESS_BTN_ADD_TO_BASKET' => $arResult["ORIGINAL_PARAMETERS"]['MESS_BTN_ADD_TO_BASKET'],
                            'MESS_BTN_SUBSCRIBE' => $arResult["ORIGINAL_PARAMETERS"]['MESS_BTN_SUBSCRIBE'],
                            'MESS_BTN_DETAIL' => $arResult["ORIGINAL_PARAMETERS"]['MESS_BTN_DETAIL'],
                            'MESS_NOT_AVAILABLE' => $arResult["ORIGINAL_PARAMETERS"]['MESS_NOT_AVAILABLE'],

                            'TEMPLATE_THEME' => (isset($arResult["ORIGINAL_PARAMETERS"]['TEMPLATE_THEME']) ? $arResult["ORIGINAL_PARAMETERS"]['TEMPLATE_THEME'] : ''),
                            "ADD_SECTIONS_CHAIN" => "N",
                            'ADD_TO_BASKET_ACTION' => $basketAction,
                            'SHOW_CLOSE_POPUP' => isset($arResult["ORIGINAL_PARAMETERS"]['COMMON_SHOW_CLOSE_POPUP']) ? $arResult["ORIGINAL_PARAMETERS"]['COMMON_SHOW_CLOSE_POPUP'] : '',
                            'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
                            'BACKGROUND_IMAGE' => (isset($arResult["ORIGINAL_PARAMETERS"]['SECTION_BACKGROUND_IMAGE']) ? $arResult["ORIGINAL_PARAMETERS"]['SECTION_BACKGROUND_IMAGE'] : '')
                        ),
                        $component
                    );?>
                </div>
                <div class="childrenBooksSubscribe">
                    <div class="giftRound">
                    </div>
                    <div class="giftWrap">
                        <div class="some_info">
                            Заявка на подписку принята, ждите информацию на почту
                        </div>
                        <p class="title">
                            Книжка за подписку
                        </p>
                        <p class="description">
                            Подпишитесь на рассылку и получите книгу<br />в формате PDF бесплатно
                        </p>
                        <form action="/" method="post">
                            <input type="text" placeholder="Ваш e-mail" name="email" onkeypress="if (event.keyCode == 13) {return SubmitRequest(event);}">
                            <input type="button" value="">
                        </form>
						<div class="pii no-mobile">
                            * подписываясь на рассылку, вы соглашаетесь на обработку персональных данных в соответствии <a href="/content/pii/" target="_blank">с условиями</a>
                        </div>
						<div class="bookCover">
                            <img src="/img/for_children/book_mouse.jpg"/>
                        </div>
                    </div>
                </div>
                <div class="childrenBooks childrenBooks_2">
                    <?
                    $booksCount = 4;
                    global $arTwelveFilter;
                    $arTwelveFilter = array(
                        "!PROPERTY_AFTER_TWELVE_YEARS" => false
                    );
                    $APPLICATION->IncludeComponent(
                        "bitrix:catalog.section",
                        "children_block",
                        array(
                            "IBLOCK_TYPE" => $arResult["ORIGINAL_PARAMETERS"]["IBLOCK_TYPE"],
                            "IBLOCK_ID" => $arResult["ORIGINAL_PARAMETERS"]["IBLOCK_ID"],
                            "SERIES_NAME" => "Книги для детей 11-12",
                            "BUTTON_NAME" => "Все книги",
                            "BUTTON_HREF" => "#",
                            "ELEMENT_SORT_FIELD" => "PROPERTY_BIG_SECTION_IMAGE",
                            "ELEMENT_SORT_ORDER" => "desc",
                            "ELEMENT_SORT_FIELD2" => "PROPERTY_STATE",
                            "ELEMENT_SORT_ORDER2" => "asc",
                            "PROPERTY_CODE" => $arResult["ORIGINAL_PARAMETERS"]["LIST_PROPERTY_CODE"],
                            "META_KEYWORDS" => $arResult["ORIGINAL_PARAMETERS"]["LIST_META_KEYWORDS"],
                            "META_DESCRIPTION" => $arResult["ORIGINAL_PARAMETERS"]["LIST_META_DESCRIPTION"],
                            "BROWSER_TITLE" => $arResult["ORIGINAL_PARAMETERS"]["LIST_BROWSER_TITLE"],
                            "SET_LAST_MODIFIED" => $arResult["ORIGINAL_PARAMETERS"]["SET_LAST_MODIFIED"],
                            "INCLUDE_SUBSECTIONS" => $arResult["ORIGINAL_PARAMETERS"]["INCLUDE_SUBSECTIONS"],
                            "BASKET_URL" => $arResult["ORIGINAL_PARAMETERS"]["BASKET_URL"],
                            "ACTION_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["ACTION_VARIABLE"],
                            "PRODUCT_ID_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_ID_VARIABLE"],
                            "SECTION_ID_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["SECTION_ID_VARIABLE"],
                            "PRODUCT_QUANTITY_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_QUANTITY_VARIABLE"],
                            "PRODUCT_PROPS_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_PROPS_VARIABLE"],
                            "FILTER_NAME" => "arTwelveFilter",
                            "CACHE_TYPE" => $arResult["ORIGINAL_PARAMETERS"]["CACHE_TYPE"],
                            "CACHE_TIME" => $arResult["ORIGINAL_PARAMETERS"]["CACHE_TIME"],
                            "CACHE_FILTER" => $arResult["ORIGINAL_PARAMETERS"]["CACHE_FILTER"],
                            "CACHE_GROUPS" => $arResult["ORIGINAL_PARAMETERS"]["CACHE_GROUPS"],
                            "SET_TITLE" => $arResult["ORIGINAL_PARAMETERS"]["SET_TITLE"],
                            "MESSAGE_404" => $arResult["ORIGINAL_PARAMETERS"]["MESSAGE_404"],
                            "SET_STATUS_404" => $arResult["ORIGINAL_PARAMETERS"]["SET_STATUS_404"],
                            "SHOW_404" => $arResult["ORIGINAL_PARAMETERS"]["SHOW_404"],
                            "FILE_404" => $arResult["ORIGINAL_PARAMETERS"]["FILE_404"],
                            "DISPLAY_COMPARE" => $arResult["ORIGINAL_PARAMETERS"]["USE_COMPARE"],
                            "PAGE_ELEMENT_COUNT" => $booksCount,
                            "LINE_ELEMENT_COUNT" => $booksCount,
                            "PRICE_CODE" => $arResult["ORIGINAL_PARAMETERS"]["PRICE_CODE"],
                            "USE_PRICE_COUNT" => $arResult["ORIGINAL_PARAMETERS"]["USE_PRICE_COUNT"],
                            "SHOW_PRICE_COUNT" => $arResult["ORIGINAL_PARAMETERS"]["SHOW_PRICE_COUNT"],

                            "PRICE_VAT_INCLUDE" => $arResult["ORIGINAL_PARAMETERS"]["PRICE_VAT_INCLUDE"],
                            "USE_PRODUCT_QUANTITY" => $arResult["ORIGINAL_PARAMETERS"]['USE_PRODUCT_QUANTITY'],
                            "ADD_PROPERTIES_TO_BASKET" => (isset($arResult["ORIGINAL_PARAMETERS"]["ADD_PROPERTIES_TO_BASKET"]) ? $arResult["ORIGINAL_PARAMETERS"]["ADD_PROPERTIES_TO_BASKET"] : ''),
                            "PARTIAL_PRODUCT_PROPERTIES" => (isset($arResult["ORIGINAL_PARAMETERS"]["PARTIAL_PRODUCT_PROPERTIES"]) ? $arResult["ORIGINAL_PARAMETERS"]["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                            "PRODUCT_PROPERTIES" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_PROPERTIES"],

                            "DISPLAY_TOP_PAGER" => $arResult["ORIGINAL_PARAMETERS"]["DISPLAY_TOP_PAGER"],
                            "DISPLAY_BOTTOM_PAGER" => $arResult["ORIGINAL_PARAMETERS"]["DISPLAY_BOTTOM_PAGER"],
                            "PAGER_TITLE" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_TITLE"],
                            "PAGER_SHOW_ALWAYS" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_SHOW_ALWAYS"],
                            "PAGER_TEMPLATE" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_TEMPLATE"],
                            "PAGER_DESC_NUMBERING" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_DESC_NUMBERING"],
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_DESC_NUMBERING_CACHE_TIME"],
                            "PAGER_SHOW_ALL" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_SHOW_ALL"],
                            "PAGER_BASE_LINK_ENABLE" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_BASE_LINK_ENABLE"],
                            "PAGER_BASE_LINK" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_BASE_LINK"],
                            "PAGER_PARAMS_NAME" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_PARAMS_NAME"],

                            "OFFERS_CART_PROPERTIES" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_CART_PROPERTIES"],
                            "OFFERS_FIELD_CODE" => $arResult["ORIGINAL_PARAMETERS"]["LIST_OFFERS_FIELD_CODE"],
                            "OFFERS_PROPERTY_CODE" => $arResult["ORIGINAL_PARAMETERS"]["LIST_OFFERS_PROPERTY_CODE"],
                            "OFFERS_SORT_FIELD" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_FIELD"],
                            "OFFERS_SORT_ORDER" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_ORDER"],
                            "OFFERS_SORT_FIELD2" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_FIELD2"],
                            "OFFERS_SORT_ORDER2" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_ORDER2"],
                            "OFFERS_LIMIT" => $arResult["ORIGINAL_PARAMETERS"]["LIST_OFFERS_LIMIT"],

                            "SECTION_ID" => $arResult["ID"],
                            "SECTION_CODE" => $arResult["CODE"],
                            "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                            "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
                            "USE_MAIN_ELEMENT_SECTION" => $arResult["ORIGINAL_PARAMETERS"]["USE_MAIN_ELEMENT_SECTION"],
                            'CONVERT_CURRENCY' => $arResult["ORIGINAL_PARAMETERS"]['CONVERT_CURRENCY'],
                            'CURRENCY_ID' => $arResult["ORIGINAL_PARAMETERS"]['CURRENCY_ID'],
                            'HIDE_NOT_AVAILABLE' => $arResult["ORIGINAL_PARAMETERS"]["HIDE_NOT_AVAILABLE"],

                            'LABEL_PROP' => $arResult["ORIGINAL_PARAMETERS"]['LABEL_PROP'],
                            'ADD_PICT_PROP' => $arResult["ORIGINAL_PARAMETERS"]['ADD_PICT_PROP'],
                            'PRODUCT_DISPLAY_MODE' => $arResult["ORIGINAL_PARAMETERS"]['PRODUCT_DISPLAY_MODE'],

                            'OFFER_ADD_PICT_PROP' => $arResult["ORIGINAL_PARAMETERS"]['OFFER_ADD_PICT_PROP'],
                            'OFFER_TREE_PROPS' => $arResult["ORIGINAL_PARAMETERS"]['OFFER_TREE_PROPS'],
                            'PRODUCT_SUBSCRIPTION' => $arResult["ORIGINAL_PARAMETERS"]['PRODUCT_SUBSCRIPTION'],
                            'SHOW_DISCOUNT_PERCENT' => $arResult["ORIGINAL_PARAMETERS"]['SHOW_DISCOUNT_PERCENT'],
                            'SHOW_OLD_PRICE' => $arResult["ORIGINAL_PARAMETERS"]['SHOW_OLD_PRICE'],
                            'MESS_BTN_BUY' => $arResult["ORIGINAL_PARAMETERS"]['MESS_BTN_BUY'],
                            'MESS_BTN_ADD_TO_BASKET' => $arResult["ORIGINAL_PARAMETERS"]['MESS_BTN_ADD_TO_BASKET'],
                            'MESS_BTN_SUBSCRIBE' => $arResult["ORIGINAL_PARAMETERS"]['MESS_BTN_SUBSCRIBE'],
                            'MESS_BTN_DETAIL' => $arResult["ORIGINAL_PARAMETERS"]['MESS_BTN_DETAIL'],
                            'MESS_NOT_AVAILABLE' => $arResult["ORIGINAL_PARAMETERS"]['MESS_NOT_AVAILABLE'],

                            'TEMPLATE_THEME' => (isset($arResult["ORIGINAL_PARAMETERS"]['TEMPLATE_THEME']) ? $arResult["ORIGINAL_PARAMETERS"]['TEMPLATE_THEME'] : ''),
                            "ADD_SECTIONS_CHAIN" => "N",
                            'ADD_TO_BASKET_ACTION' => $basketAction,
                            'SHOW_CLOSE_POPUP' => isset($arResult["ORIGINAL_PARAMETERS"]['COMMON_SHOW_CLOSE_POPUP']) ? $arResult["ORIGINAL_PARAMETERS"]['COMMON_SHOW_CLOSE_POPUP'] : '',
                            'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
                            'BACKGROUND_IMAGE' => (isset($arResult["ORIGINAL_PARAMETERS"]['SECTION_BACKGROUND_IMAGE']) ? $arResult["ORIGINAL_PARAMETERS"]['SECTION_BACKGROUND_IMAGE'] : '')
                        ),
                        $component
                    );
                    ?>
                </div>
                <div class="demarcation">
                    <img class="bookWithBall" src="/img/for_children/bitmap8.png"/>
                    <img class="baloons" src="/img/for_children/bitmap3.png"/>
                </div>
                <div class="childrenBooks childrenBooks_3">
                    <?
                    $booksCount = 5;
                    global $arZoologyFilter;
                    $arZoologyFilter = array(
                        "PROPERTY_SERIES" => 66042
                    );
                    $APPLICATION->IncludeComponent(
                        "bitrix:catalog.section",
                        "children_block",
                        array(
                            "IBLOCK_TYPE" => $arResult["ORIGINAL_PARAMETERS"]["IBLOCK_TYPE"],
                            "IBLOCK_ID" => $arResult["ORIGINAL_PARAMETERS"]["IBLOCK_ID"],
                            "ELEMENT_SORT_FIELD" => "PROPERTY_BIG_SECTION_IMAGE",
                            "ELEMENT_SORT_ORDER" => "desc",
                            "ELEMENT_SORT_FIELD2" => "PROPERTY_STATE",
                            "ELEMENT_SORT_ORDER2" => "asc",
                            "SERIES_NAME" => "Занимательная зоология",
                            "BUTTON_NAME" => "Вся серия",
                            "BUTTON_HREF" => "/series/66042/",
                            "PROPERTY_CODE" => $arResult["ORIGINAL_PARAMETERS"]["LIST_PROPERTY_CODE"],
                            "META_KEYWORDS" => $arResult["ORIGINAL_PARAMETERS"]["LIST_META_KEYWORDS"],
                            "META_DESCRIPTION" => $arResult["ORIGINAL_PARAMETERS"]["LIST_META_DESCRIPTION"],
                            "BROWSER_TITLE" => $arResult["ORIGINAL_PARAMETERS"]["LIST_BROWSER_TITLE"],
                            "SET_LAST_MODIFIED" => $arResult["ORIGINAL_PARAMETERS"]["SET_LAST_MODIFIED"],
                            "INCLUDE_SUBSECTIONS" => $arResult["ORIGINAL_PARAMETERS"]["INCLUDE_SUBSECTIONS"],
                            "BASKET_URL" => $arResult["ORIGINAL_PARAMETERS"]["BASKET_URL"],
                            "ACTION_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["ACTION_VARIABLE"],
                            "PRODUCT_ID_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_ID_VARIABLE"],
                            "SECTION_ID_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["SECTION_ID_VARIABLE"],
                            "PRODUCT_QUANTITY_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_QUANTITY_VARIABLE"],
                            "PRODUCT_PROPS_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_PROPS_VARIABLE"],
                            "FILTER_NAME" => "arZoologyFilter",
                            "CACHE_TYPE" => $arResult["ORIGINAL_PARAMETERS"]["CACHE_TYPE"],
                            "CACHE_TIME" => $arResult["ORIGINAL_PARAMETERS"]["CACHE_TIME"],
                            "CACHE_FILTER" => $arResult["ORIGINAL_PARAMETERS"]["CACHE_FILTER"],
                            "CACHE_GROUPS" => $arResult["ORIGINAL_PARAMETERS"]["CACHE_GROUPS"],
                            "SET_TITLE" => $arResult["ORIGINAL_PARAMETERS"]["SET_TITLE"],
                            "MESSAGE_404" => $arResult["ORIGINAL_PARAMETERS"]["MESSAGE_404"],
                            "SET_STATUS_404" => $arResult["ORIGINAL_PARAMETERS"]["SET_STATUS_404"],
                            "SHOW_404" => $arResult["ORIGINAL_PARAMETERS"]["SHOW_404"],
                            "FILE_404" => $arResult["ORIGINAL_PARAMETERS"]["FILE_404"],
                            "DISPLAY_COMPARE" => $arResult["ORIGINAL_PARAMETERS"]["USE_COMPARE"],
                            "PAGE_ELEMENT_COUNT" => $booksCount,
                            "LINE_ELEMENT_COUNT" => $booksCount,
                            "PRICE_CODE" => $arResult["ORIGINAL_PARAMETERS"]["PRICE_CODE"],
                            "USE_PRICE_COUNT" => $arResult["ORIGINAL_PARAMETERS"]["USE_PRICE_COUNT"],
                            "SHOW_PRICE_COUNT" => $arResult["ORIGINAL_PARAMETERS"]["SHOW_PRICE_COUNT"],

                            "PRICE_VAT_INCLUDE" => $arResult["ORIGINAL_PARAMETERS"]["PRICE_VAT_INCLUDE"],
                            "USE_PRODUCT_QUANTITY" => $arResult["ORIGINAL_PARAMETERS"]['USE_PRODUCT_QUANTITY'],
                            "ADD_PROPERTIES_TO_BASKET" => (isset($arResult["ORIGINAL_PARAMETERS"]["ADD_PROPERTIES_TO_BASKET"]) ? $arResult["ORIGINAL_PARAMETERS"]["ADD_PROPERTIES_TO_BASKET"] : ''),
                            "PARTIAL_PRODUCT_PROPERTIES" => (isset($arResult["ORIGINAL_PARAMETERS"]["PARTIAL_PRODUCT_PROPERTIES"]) ? $arResult["ORIGINAL_PARAMETERS"]["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                            "PRODUCT_PROPERTIES" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_PROPERTIES"],

                            "DISPLAY_TOP_PAGER" => $arResult["ORIGINAL_PARAMETERS"]["DISPLAY_TOP_PAGER"],
                            "DISPLAY_BOTTOM_PAGER" => $arResult["ORIGINAL_PARAMETERS"]["DISPLAY_BOTTOM_PAGER"],
                            "PAGER_TITLE" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_TITLE"],
                            "PAGER_SHOW_ALWAYS" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_SHOW_ALWAYS"],
                            "PAGER_TEMPLATE" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_TEMPLATE"],
                            "PAGER_DESC_NUMBERING" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_DESC_NUMBERING"],
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_DESC_NUMBERING_CACHE_TIME"],
                            "PAGER_SHOW_ALL" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_SHOW_ALL"],
                            "PAGER_BASE_LINK_ENABLE" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_BASE_LINK_ENABLE"],
                            "PAGER_BASE_LINK" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_BASE_LINK"],
                            "PAGER_PARAMS_NAME" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_PARAMS_NAME"],

                            "OFFERS_CART_PROPERTIES" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_CART_PROPERTIES"],
                            "OFFERS_FIELD_CODE" => $arResult["ORIGINAL_PARAMETERS"]["LIST_OFFERS_FIELD_CODE"],
                            "OFFERS_PROPERTY_CODE" => $arResult["ORIGINAL_PARAMETERS"]["LIST_OFFERS_PROPERTY_CODE"],
                            "OFFERS_SORT_FIELD" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_FIELD"],
                            "OFFERS_SORT_ORDER" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_ORDER"],
                            "OFFERS_SORT_FIELD2" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_FIELD2"],
                            "OFFERS_SORT_ORDER2" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_ORDER2"],
                            "OFFERS_LIMIT" => $arResult["ORIGINAL_PARAMETERS"]["LIST_OFFERS_LIMIT"],

                            "SECTION_ID" => $arResult["ID"],
                            "SECTION_CODE" => $arResult["CODE"],
                            "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                            "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
                            "USE_MAIN_ELEMENT_SECTION" => $arResult["ORIGINAL_PARAMETERS"]["USE_MAIN_ELEMENT_SECTION"],
                            'CONVERT_CURRENCY' => $arResult["ORIGINAL_PARAMETERS"]['CONVERT_CURRENCY'],
                            'CURRENCY_ID' => $arResult["ORIGINAL_PARAMETERS"]['CURRENCY_ID'],
                            'HIDE_NOT_AVAILABLE' => $arResult["ORIGINAL_PARAMETERS"]["HIDE_NOT_AVAILABLE"],

                            'LABEL_PROP' => $arResult["ORIGINAL_PARAMETERS"]['LABEL_PROP'],
                            'ADD_PICT_PROP' => $arResult["ORIGINAL_PARAMETERS"]['ADD_PICT_PROP'],
                            'PRODUCT_DISPLAY_MODE' => $arResult["ORIGINAL_PARAMETERS"]['PRODUCT_DISPLAY_MODE'],

                            'OFFER_ADD_PICT_PROP' => $arResult["ORIGINAL_PARAMETERS"]['OFFER_ADD_PICT_PROP'],
                            'OFFER_TREE_PROPS' => $arResult["ORIGINAL_PARAMETERS"]['OFFER_TREE_PROPS'],
                            'PRODUCT_SUBSCRIPTION' => $arResult["ORIGINAL_PARAMETERS"]['PRODUCT_SUBSCRIPTION'],
                            'SHOW_DISCOUNT_PERCENT' => $arResult["ORIGINAL_PARAMETERS"]['SHOW_DISCOUNT_PERCENT'],
                            'SHOW_OLD_PRICE' => $arResult["ORIGINAL_PARAMETERS"]['SHOW_OLD_PRICE'],
                            'MESS_BTN_BUY' => $arResult["ORIGINAL_PARAMETERS"]['MESS_BTN_BUY'],
                            'MESS_BTN_ADD_TO_BASKET' => $arResult["ORIGINAL_PARAMETERS"]['MESS_BTN_ADD_TO_BASKET'],
                            'MESS_BTN_SUBSCRIBE' => $arResult["ORIGINAL_PARAMETERS"]['MESS_BTN_SUBSCRIBE'],
                            'MESS_BTN_DETAIL' => $arResult["ORIGINAL_PARAMETERS"]['MESS_BTN_DETAIL'],
                            'MESS_NOT_AVAILABLE' => $arResult["ORIGINAL_PARAMETERS"]['MESS_NOT_AVAILABLE'],

                            'TEMPLATE_THEME' => (isset($arResult["ORIGINAL_PARAMETERS"]['TEMPLATE_THEME']) ? $arResult["ORIGINAL_PARAMETERS"]['TEMPLATE_THEME'] : ''),
                            "ADD_SECTIONS_CHAIN" => "N",
                            'ADD_TO_BASKET_ACTION' => $basketAction,
                            'SHOW_CLOSE_POPUP' => isset($arResult["ORIGINAL_PARAMETERS"]['COMMON_SHOW_CLOSE_POPUP']) ? $arResult["ORIGINAL_PARAMETERS"]['COMMON_SHOW_CLOSE_POPUP'] : '',
                            'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
                            'BACKGROUND_IMAGE' => (isset($arResult["ORIGINAL_PARAMETERS"]['SECTION_BACKGROUND_IMAGE']) ? $arResult["ORIGINAL_PARAMETERS"]['SECTION_BACKGROUND_IMAGE'] : '')
                        ),
                        $component
                    );
                    ?>
                </div>
                <div class="childrenCooperation">
                    <div class="textBlock">
                        <div class="title">
                            Хотите с нами сотрудничать?
                        </div>
                        <div class="text">
                            Why Do Make Ahead Recipes Work So Well To Reduce
                            </br>
                            Your Dinner Party Stress
                            </br>
                            </br>
                            Пишите сюда  aaa@alpinabook.ru
                        </div>
                    </div>
                    <div class="childrenCooperationImg">
                        <img src="/img/for_children/group-16.png"/>
                    </div>
                    <div class="childrenCooperationPillow">
                        <img src="/img/for_children/bitmap4.png"/>
                    </div>
                </div>
                <div class="childrenBooks childrenBooks_1">
                    <?$booksCount = 9;
                    global $arFutureParents;
                    $arFutureParents = array(
                        "!PROPERTY_FOR_FUTURE_PARENTS" => false
                    );
                    $APPLICATION->IncludeComponent(
                        "bitrix:catalog.section",
                        "children_block",
                        array(
                            "IBLOCK_TYPE" => $arResult["ORIGINAL_PARAMETERS"]["IBLOCK_TYPE"],
                            "IBLOCK_ID" => $arResult["ORIGINAL_PARAMETERS"]["IBLOCK_ID"],
                            "ELEMENT_SORT_FIELD" => $sort,
                            "ELEMENT_SORT_ORDER" => $order,
                            "ELEMENT_SORT_FIELD2" => "PROPERTY_STATE",
                            "ELEMENT_SORT_ORDER2" => "asc",
                            "SERIES_NAME" => "Для будущих родителей",
                            "BUTTON_NAME" => "Все книги",
                            "BUTTON_HREF" => "#",
                            "PROPERTY_CODE" => $arResult["ORIGINAL_PARAMETERS"]["LIST_PROPERTY_CODE"],
                            "META_KEYWORDS" => $arResult["ORIGINAL_PARAMETERS"]["LIST_META_KEYWORDS"],
                            "META_DESCRIPTION" => $arResult["ORIGINAL_PARAMETERS"]["LIST_META_DESCRIPTION"],
                            "BROWSER_TITLE" => $arResult["ORIGINAL_PARAMETERS"]["LIST_BROWSER_TITLE"],
                            "SET_LAST_MODIFIED" => $arResult["ORIGINAL_PARAMETERS"]["SET_LAST_MODIFIED"],
                            "INCLUDE_SUBSECTIONS" => $arResult["ORIGINAL_PARAMETERS"]["INCLUDE_SUBSECTIONS"],
                            "BASKET_URL" => $arResult["ORIGINAL_PARAMETERS"]["BASKET_URL"],
                            "ACTION_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["ACTION_VARIABLE"],
                            "PRODUCT_ID_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_ID_VARIABLE"],
                            "SECTION_ID_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["SECTION_ID_VARIABLE"],
                            "PRODUCT_QUANTITY_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_QUANTITY_VARIABLE"],
                            "PRODUCT_PROPS_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_PROPS_VARIABLE"],
                            "FILTER_NAME" => "arFutureParents",
                            "CACHE_TYPE" => $arResult["ORIGINAL_PARAMETERS"]["CACHE_TYPE"],
                            "CACHE_TIME" => $arResult["ORIGINAL_PARAMETERS"]["CACHE_TIME"],
                            "CACHE_FILTER" => $arResult["ORIGINAL_PARAMETERS"]["CACHE_FILTER"],
                            "CACHE_GROUPS" => $arResult["ORIGINAL_PARAMETERS"]["CACHE_GROUPS"],
                            "SET_TITLE" => $arResult["ORIGINAL_PARAMETERS"]["SET_TITLE"],
                            "MESSAGE_404" => $arResult["ORIGINAL_PARAMETERS"]["MESSAGE_404"],
                            "SET_STATUS_404" => $arResult["ORIGINAL_PARAMETERS"]["SET_STATUS_404"],
                            "SHOW_404" => $arResult["ORIGINAL_PARAMETERS"]["SHOW_404"],
                            "FILE_404" => $arResult["ORIGINAL_PARAMETERS"]["FILE_404"],
                            "DISPLAY_COMPARE" => $arResult["ORIGINAL_PARAMETERS"]["USE_COMPARE"],
                            "PAGE_ELEMENT_COUNT" => $booksCount,
                            "LINE_ELEMENT_COUNT" => $booksCount,
                            "PRICE_CODE" => $arResult["ORIGINAL_PARAMETERS"]["PRICE_CODE"],
                            "USE_PRICE_COUNT" => $arResult["ORIGINAL_PARAMETERS"]["USE_PRICE_COUNT"],
                            "SHOW_PRICE_COUNT" => $arResult["ORIGINAL_PARAMETERS"]["SHOW_PRICE_COUNT"],

                            "PRICE_VAT_INCLUDE" => $arResult["ORIGINAL_PARAMETERS"]["PRICE_VAT_INCLUDE"],
                            "USE_PRODUCT_QUANTITY" => $arResult["ORIGINAL_PARAMETERS"]['USE_PRODUCT_QUANTITY'],
                            "ADD_PROPERTIES_TO_BASKET" => (isset($arResult["ORIGINAL_PARAMETERS"]["ADD_PROPERTIES_TO_BASKET"]) ? $arResult["ORIGINAL_PARAMETERS"]["ADD_PROPERTIES_TO_BASKET"] : ''),
                            "PARTIAL_PRODUCT_PROPERTIES" => (isset($arResult["ORIGINAL_PARAMETERS"]["PARTIAL_PRODUCT_PROPERTIES"]) ? $arResult["ORIGINAL_PARAMETERS"]["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                            "PRODUCT_PROPERTIES" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_PROPERTIES"],

                            "DISPLAY_TOP_PAGER" => $arResult["ORIGINAL_PARAMETERS"]["DISPLAY_TOP_PAGER"],
                            "DISPLAY_BOTTOM_PAGER" => $arResult["ORIGINAL_PARAMETERS"]["DISPLAY_BOTTOM_PAGER"],
                            "PAGER_TITLE" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_TITLE"],
                            "PAGER_SHOW_ALWAYS" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_SHOW_ALWAYS"],
                            "PAGER_TEMPLATE" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_TEMPLATE"],
                            "PAGER_DESC_NUMBERING" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_DESC_NUMBERING"],
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_DESC_NUMBERING_CACHE_TIME"],
                            "PAGER_SHOW_ALL" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_SHOW_ALL"],
                            "PAGER_BASE_LINK_ENABLE" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_BASE_LINK_ENABLE"],
                            "PAGER_BASE_LINK" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_BASE_LINK"],
                            "PAGER_PARAMS_NAME" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_PARAMS_NAME"],

                            "OFFERS_CART_PROPERTIES" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_CART_PROPERTIES"],
                            "OFFERS_FIELD_CODE" => $arResult["ORIGINAL_PARAMETERS"]["LIST_OFFERS_FIELD_CODE"],
                            "OFFERS_PROPERTY_CODE" => $arResult["ORIGINAL_PARAMETERS"]["LIST_OFFERS_PROPERTY_CODE"],
                            "OFFERS_SORT_FIELD" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_FIELD"],
                            "OFFERS_SORT_ORDER" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_ORDER"],
                            "OFFERS_SORT_FIELD2" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_FIELD2"],
                            "OFFERS_SORT_ORDER2" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_ORDER2"],
                            "OFFERS_LIMIT" => $arResult["ORIGINAL_PARAMETERS"]["LIST_OFFERS_LIMIT"],

                            "SECTION_ID" => $arResult["ID"],
                            "SECTION_CODE" => $arResult["CODE"],
                            "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                            "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
                            "USE_MAIN_ELEMENT_SECTION" => $arResult["ORIGINAL_PARAMETERS"]["USE_MAIN_ELEMENT_SECTION"],
                            'CONVERT_CURRENCY' => $arResult["ORIGINAL_PARAMETERS"]['CONVERT_CURRENCY'],
                            'CURRENCY_ID' => $arResult["ORIGINAL_PARAMETERS"]['CURRENCY_ID'],
                            'HIDE_NOT_AVAILABLE' => $arResult["ORIGINAL_PARAMETERS"]["HIDE_NOT_AVAILABLE"],

                            'LABEL_PROP' => $arResult["ORIGINAL_PARAMETERS"]['LABEL_PROP'],
                            'ADD_PICT_PROP' => $arResult["ORIGINAL_PARAMETERS"]['ADD_PICT_PROP'],
                            'PRODUCT_DISPLAY_MODE' => $arResult["ORIGINAL_PARAMETERS"]['PRODUCT_DISPLAY_MODE'],

                            'OFFER_ADD_PICT_PROP' => $arResult["ORIGINAL_PARAMETERS"]['OFFER_ADD_PICT_PROP'],
                            'OFFER_TREE_PROPS' => $arResult["ORIGINAL_PARAMETERS"]['OFFER_TREE_PROPS'],
                            'PRODUCT_SUBSCRIPTION' => $arResult["ORIGINAL_PARAMETERS"]['PRODUCT_SUBSCRIPTION'],
                            'SHOW_DISCOUNT_PERCENT' => $arResult["ORIGINAL_PARAMETERS"]['SHOW_DISCOUNT_PERCENT'],
                            'SHOW_OLD_PRICE' => $arResult["ORIGINAL_PARAMETERS"]['SHOW_OLD_PRICE'],
                            'MESS_BTN_BUY' => $arResult["ORIGINAL_PARAMETERS"]['MESS_BTN_BUY'],
                            'MESS_BTN_ADD_TO_BASKET' => $arResult["ORIGINAL_PARAMETERS"]['MESS_BTN_ADD_TO_BASKET'],
                            'MESS_BTN_SUBSCRIBE' => $arResult["ORIGINAL_PARAMETERS"]['MESS_BTN_SUBSCRIBE'],
                            'MESS_BTN_DETAIL' => $arResult["ORIGINAL_PARAMETERS"]['MESS_BTN_DETAIL'],
                            'MESS_NOT_AVAILABLE' => $arResult["ORIGINAL_PARAMETERS"]['MESS_NOT_AVAILABLE'],

                            'TEMPLATE_THEME' => (isset($arResult["ORIGINAL_PARAMETERS"]['TEMPLATE_THEME']) ? $arResult["ORIGINAL_PARAMETERS"]['TEMPLATE_THEME'] : ''),
                            "ADD_SECTIONS_CHAIN" => "N",
                            'ADD_TO_BASKET_ACTION' => $basketAction,
                            'SHOW_CLOSE_POPUP' => isset($arResult["ORIGINAL_PARAMETERS"]['COMMON_SHOW_CLOSE_POPUP']) ? $arResult["ORIGINAL_PARAMETERS"]['COMMON_SHOW_CLOSE_POPUP'] : '',
                            'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
                            'BACKGROUND_IMAGE' => (isset($arResult["ORIGINAL_PARAMETERS"]['SECTION_BACKGROUND_IMAGE']) ? $arResult["ORIGINAL_PARAMETERS"]['SECTION_BACKGROUND_IMAGE'] : '')
                        ),
                        $component
                    );?>
                </div>
                <div class="childrenGiftEdition">
                    <div class="textBlock">
                        <div class="title">
                            Выпустим детскую подарочную книгу
                        </div>
                        <div class="text">
                            В индивидуальном оформлении. Книга станет желанным подарком для детей сотрудников, клиентов и партнеров.
                        </div>
                        <div class="phone">
                            +7 900 202-20-20
                        </div>
                        <div class="manager">
                            <div class="avatar">
                            </div>
                            <div class="name">
                                Олег Тимирязев
                            </div>
                            <div class="position">
                                Менеджер
                            </div>
                        </div>
                    </div>
                    <div class="childrenGiftEditionDog">
                        <img src="/img/for_children/bitmap5.png"/>
                    </div>
                    <div class="childrenGiftEditionImg">
                        <img src="/img/for_children/bitmap6.png"/>
                    </div>
                    <div class="childrenGiftEditionGift">
                        <img src="/img/for_children/bitmap7.png"/>
                    </div>
                </div>
            </div>
        </div>
        <?$APPLICATION->IncludeComponent(
            "bitrix:menu",
            "catalog_left_menu",
            array(
                "ROOT_MENU_TYPE" => "top_books_left_menu",
                "MAX_LEVEL" => "1",
                "CHILD_MENU_TYPE" => "top",
                "USE_EXT" => "Y",
                "DELAY" => "N",
                "ALLOW_MULTI_SELECT" => "Y",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "MENU_CACHE_GET_VARS" => array(
                ),
                "COMPONENT_TEMPLATE" => "catalog_left_menu"
            ),
            false
        );?>
        <?$APPLICATION->IncludeComponent(
            "bitrix:catalog.section.list",
            "section.left.tree",
            array(
                "IBLOCK_TYPE" => "catalog",
                "IBLOCK_ID" => "4",
                "SECTION_ID" => "",
                "SECTION_CODE" => "",
                "COUNT_ELEMENTS" => "N",
                "TOP_DEPTH" => "2",
                "IBLOCK_HEADER_TITLE" => "Каталог книг",
                "IBLOCK_HEADER_LINK" => "",
                "SECTION_URL" => "#SITE_DIR#/catalog/#SECTION_CODE#/",
                "CACHE_TYPE" => "N",
                "CACHE_TIME" => "3600",
                "DISPLAY_PANEL" => "N",
                "ADD_SECTIONS_CHAIN" => "Y",
                "COMPONENT_TEMPLATE" => "section.left.tree",
                "SECTION_FIELDS" => array(
                    0 => "",
                    1 => "",
                ),
                "SECTION_USER_FIELDS" => array(
                    0 => "",
                    1 => "",
                ),
                "CACHE_GROUPS" => "N",
                "VIEW_MODE" => "LIST",
                "SHOW_PARENT_NAME" => "Y"
            ),
            false
        );?>
        <div class="childrenClew">
            <img src="/img/for_children/bitmap9.png"/>
        </div>
    </div>
</div>
<?
if (!isset($_SESSION[$APPLICATION -> GetCurDir()])) {
    $_SESSION[$APPLICATION -> GetCurDir()] = 1;
}
?>
<script>
    // скрипт ajax-подгрузки товаров в блоке "Все книги"
    $(document).ready(function() {
        $(".leftMenu ul li").each(function(){
            if ($(this).children("a").attr("href") == "<?= $APPLICATION -> GetCurDir()?>") {
                $(this).children("a").find("p").css("font-weight", "bold");
                if ($(this).closest("ul").hasClass("secondLevel")) {
                    $(this).closest("ul").parent("li").find("a p").addClass("activeListName");
                    $(this).closest("ul").parent("li").find(".secondLevel").show();
                } else {
                    $(this).find("ul.secondLevel a p").addClass("activeListName");
                    $(this).find("ul.secondLevel").show();
                }
            }
        });
        <?$navnum = $arResult["NAV_RESULT"]->NavNum;
        if ($navnum == 1) {
            $navnum = 2;
        }
        switch ($arResult["ORIGINAL_PARAMETERS"]["ELEMENT_SORT_FIELD"]) {
            case "CATALOG_PRICE_1":
            $sort = "PRICE";
            break;

            case "PROPERTY_shows_a_day":
            $sort = "POPULARITY";
            break;

            case "PROPERTY_SOON_DATE_TIME":
            $sort = "DATE";
            break;
        }?>
        <?if (isset($_REQUEST["PAGEN_".$navnum])) {
           ?>
            var page = <?= $_REQUEST["PAGEN_".$navnum]?> + 1;
        <?} else {?>
            var page = 2;
        <?}?>
        var maxpage = <?= ($arResult["NAV_RESULT"]->NavPageCount)?>;
        if ($(".bx-pagination").size() > 0) {
            var WrappHeight = $(".wrapperCategor").height();
            var DescriptionHeight = $(".catalogDescription").height();
            var RecHeight = $(".grayTitle").height();
            if (RecHeight == 0) {
                RecHeight = 550;
            }
            var BooksLiLength = $(".otherBooks ul li").length;

            var startHeight = WrappHeight+RecHeight+100 + DescriptionHeight + Math.ceil((BooksLiLength - 15) / 5) * 455;
            //$(".wrapperCategor").css("height", startHeight+"px");
        }
        <?if (isset($_SESSION[$APPLICATION -> GetCurDir()])) {?>
            var upd_page = <?= $_SESSION[$APPLICATION -> GetCurDir()]?>;
            for (i = 2; i <= upd_page; i++) {
                 <?if ($_REQUEST["SORT"]) {?>
                    $.get(window.location.href + '&PAGEN_<?= $navnum?>=' + page, function(data) {
                        var next_page = $('.otherBooks ul li', data);
                        $('.otherBooks ul').append(next_page);
                        page++;
                    })
                 <?} else {?>
                     $.get('<?= $arResult["SECTION_PAGE_URL"]?>?SORT=<?= $sort?>&DIRECTION=<?= $arResult["ORIGINAL_PARAMETERS"]["ELEMENT_SORT_ORDER2"]?>&PAGEN_<?= $navnum?>='+page,
                        function(data) {
                            var next_page = $('.otherBooks ul li', data);
                            $('.otherBooks ul').append(next_page);
                            page++;
                        }
                     )
                 <?}?>
                .done(function() {
                    $(".nameBook").each(function() {
                            if($(this).length > 0) {
                                $(this).html(truncate($(this).html(), 40));
                            }
                    });
                    var otherBooksHeight = 1350 * ($(".otherBooks ul li").length / 15);

                    var categorHeight = WrappHeight+RecHeight+200+ Math.ceil(($(".otherBooks ul li").length - BooksLiLength) / 5) * 455;

                    $(".otherBooks").css("height", otherBooksHeight+"px");
                });
                if (upd_page == maxpage) {
                    $('.showMore').hide();
                }
            }
        <?}?>
        <?if (!$USER -> IsAuthorized()) {?>
            $(".categoryWrapper .categoryBooks").hover(function() {
                $(this).css("height", "420px");
            });

        <?}?>
        cackle_widget = window.cackle_widget || [];
        cackle_widget.push({widget: 'ReviewRating', id: 36574, html: '{{=it.stars}}{{?it.numr > 0}} {{=it.numr+it.numv}} {{=it.reviews}}{{?}}'});
        (function() {
            var mc = document.createElement('script');
            mc.type = 'text/javascript';
            mc.async = true;
            mc.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cackle.me/widget.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(mc, s.nextSibling);
        })();
    });
</script>