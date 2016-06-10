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

<div class="wishlistBlock">

    <?foreach ($arResult["ITEMS"] as $arItem) {

        $prodSection = $arResult["SECTIONS_LIST"][$arResult["PRODUCT_FIELDS"][$arItem["PROPERTIES"]["PRODUCTS"]["VALUE"]]["IBLOCK_SECTION_ID"]];
        $author = $arResult["AUTHORS"][$arResult["PRODUCT_FIELDS"][$arItem["PROPERTIES"]["PRODUCTS"]["VALUE"]]["PROPERTY_AUTHORS_VALUE"]];
        $unavailable_statuses_array = array (
            getXMLIDByCode (CATALOG_IBLOCK_ID, "STATE", "soon"), 
            getXMLIDByCode (CATALOG_IBLOCK_ID, "STATE", "net_v_nal")
        );
        ?>
        <div class="wishElement">
            <div class="imgContainer"><a href="/catalog/<?= $prodSection["CODE"] ?>/<?= $arResult["PRODUCT_FIELDS"][$arItem["PROPERTIES"]["PRODUCTS"]["VALUE"]]["ID"]?>/"><img src="<?= $arResult["PICTURE"][$arItem["PROPERTIES"]["PRODUCTS"]["VALUE"]]["src"] ?>"></a></div>
            <p class="wishBookName"><a href="/catalog/<?= $prodSection["CODE"] ?>/<?= $arResult["PRODUCT_FIELDS"][$arItem["PROPERTIES"]["PRODUCTS"]["VALUE"]]["ID"]?>/"><?= $arResult["PRODUCT_FIELDS"][$arItem["PROPERTIES"]["PRODUCTS"]["VALUE"]]["NAME"] ?></a></p>
            <p class="wishBookAutor"><a href="/authors/<?= $author["ID"] ?>/"><?= $author["NAME"] ?></a></p>
            <p class="wishBookPrice">
                <?if ($arResult["PRODUCT_FIELDS"][$arItem["PROPERTIES"]["PRODUCTS"]["VALUE"]]["CATALOG_PRICE_1"] > 0) {
                    echo ceil($arResult["PRODUCT_FIELDS"][$arItem["PROPERTIES"]["PRODUCTS"]["VALUE"]]["CATALOG_PRICE_1"]) . GetMessage("ROUBLES");
                } else {
                    echo GetMessage("CT_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE");
                }?>
            </p>
            <div class="wishBookDescription"><?= $arResult["PRODUCT_FIELDS"][$arItem["PROPERTIES"]["PRODUCTS"]["VALUE"]]["PREVIEW_TEXT"] ?></div>
            <? if ($arResult["PRODUCT_FIELDS"][$arItem["PROPERTIES"]["PRODUCTS"]["VALUE"]]["CATALOG_PRICE_1"] > 0
                && !in_array($arResult["PRODUCT_FIELDS"][$arItem["PROPERTIES"]["PRODUCTS"]["VALUE"]]["PROPERTY_STATE_ENUM_ID"], $unavailable_statuses_array)) {?>
                    <p class="inBasketContainer" id="wishItem_<?=$arResult["PRODUCT_FIELDS"][$arItem["PROPERTIES"]["PRODUCTS"]["VALUE"]]["ID"]?>">
                        <a href="/personal/cart/?action=ADD2BASKET&id=<?=$arResult["PRODUCT_FIELDS"][$arItem["PROPERTIES"]["PRODUCTS"]["VALUE"]]["ID"]?>" 
                            onclick="addtocart(<?=$arResult["PRODUCT_FIELDS"][$arItem["PROPERTIES"]["PRODUCTS"]["VALUE"]]["ID"];?>, '<?=$arResult["PRODUCT_FIELDS"][$arItem["PROPERTIES"]["PRODUCTS"]["VALUE"]]["NAME"];?>'); return false;" 
                            class="wishInBasket" id="wishItem_<?=$arResult["PRODUCT_FIELDS"][$arItem["PROPERTIES"]["PRODUCTS"]["VALUE"]]["ID"]?>">
                                <?= GetMessage("CT_BCS_TPL_MESS_BTN_ADD_TO_BASKET") ?>
                        </a>
                    </p>
            <?}?>
            <p class="wishDeleteContainer">
                <a href="javascript:void(0)" 
                    onclick="delete_wishlist_item(<?=$arResult["PRODUCT_FIELDS"][$arItem["PROPERTIES"]["PRODUCTS"]["VALUE"]]["ID"]?>);" 
                    class="wishDelete">
                        <?= GetMessage("DELETE") ?>
                </a>
            </p>
        </div>
    <?}?>
    <div class="del_notify"></div> 
    <div class="socialWishWrapper">
        <p class="socialWishText"><?= GetMessage("SHARE_A_LIST") ?></p>
        <div class="socServisesPict">
            <a href="http://vk.com/share.php?url=http://<?= $arResult["SERVER_NAME"] ?>/personal/cart/?list=<?=$arResult["USER_ID"]?>&title=<?= GetMessage("MY_WISH_LIST") ?>"><img src="/img/vkSocial.png"></a>
            <a href="https://twitter.com/intent/tweet?url=http://<?= $arResult["SERVER_NAME"] ?>/personal/cart/?list=<?=$arResult["USER_ID"]?>&text=<?= GetMessage("MY_WISH_LIST") ?>"><img src="/img/twitRegistrat.png"></a>
            <a href="https://www.facebook.com/sharer.php?u=http://<?= $arResult["SERVER_NAME"] ?>/personal/cart/?list=<?=$arResult["USER_ID"]?>"><img src="/img/facebookRegistr.png"></a>
            <a href="https://plus.google.com/share?url=http://<?= $arResult["SERVER_NAME"] ?>/personal/cart/?list=<?=$arResult["USER_ID"]?>"><img src="/img/googlePlusReg.png"></a>
            <a href="http://www.ok.ru/dk?st.cmd=addShare&st.s=1&st._surl=http://<?= $arResult["SERVER_NAME"] ?>/personal/cart/?list=<?=$arResult["USER_ID"]?>"><img src="/img/oklRegistr.png"></a>
        </div>
    </div>
</div>
