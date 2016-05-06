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
<div id="fb-root"></div>
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.5";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<div class="wishlistBlock">

    <?$uID = $USER -> GetID();?>
    <?$unavailStatusesArr = array (
        getXMLIDByCode (CATALOG_IBLOCK_ID, "STATE", "soon"), 
        getXMLIDByCode (CATALOG_IBLOCK_ID, "STATE", "net_v_nal")
    );?>
    <?foreach ($arResult["ITEMS"] as $arItem) {    
        $prodSection = $arResult["SECTIONS_LIST"][$arResult["PRODUCT_FIELDS"][$arItem["ID"]]["IBLOCK_SECTION_ID"]];
        $author = $arResult["AUTHORS"][$arResult["PRODUCT_FIELDS"][$arItem["ID"]]["PROPERTY_AUTHORS_VALUE"]];?>
        <div class="wishElement">
            <div class="imgContainer"><a href="/catalog/<?= $prodSection["CODE"] ?>/<?= $arResult["PRODUCT_FIELDS"][$arItem["ID"]]["ID"]?>/"><img src="<?= $arResult["PICTURE"][$arItem["ID"]]["src"] ?>"></a></div>
            <p class="wishBookName"><a href="/catalog/<?= $prodSection["CODE"] ?>/<?= $arResult["PRODUCT_FIELDS"][$arItem["ID"]]["ID"]?>/"><?= $arResult["PRODUCT_FIELDS"][$arItem["ID"]]["NAME"] ?></a></p>
            <p class="wishBookAutor"><a href="/authors/<?= $author["ID"] ?>/"><?= $author["NAME"] ?></a></p>
            <p class="wishBookPrice">
                <?if ($arResult["PRODUCT_FIELDS"][$arItem["ID"]]["CATALOG_PRICE_1"] > 0) {
                    echo ceil ($arResult["PRODUCT_FIELDS"][$arItem["ID"]]["CATALOG_PRICE_1"]) . GetMessage("ROUBLES");
                } else {
                    echo GetMessage("NOT_IN_STOCK");
                }?>
            </p>
            <div class="wishBookDescription"><?= $arResult["PRODUCT_FIELDS"][$arItem["ID"]]["PREVIEW_TEXT"] ?></div>
            <?if ($_REQUEST["list"]) {
                if ($arResult["PRODUCT_FIELDS"][$arItem["ID"]]["CATALOG_PRICE_1"] > 0
                    && !in_array($arResult["PRODUCT_FIELDS"][$arItem["ID"]]["PROPERTY_STATE_ENUM_ID"], $unavailStatusesArr)) {?>
                        <p class="inBasketContainer">
                            <a href="/personal/cart/?action=ADD2BASKET&id=<?=$arResult["PRODUCT_FIELDS"][$arItem["ID"]]["ID"]?>" 
                                onclick="addtocart(<?= $arResult["PRODUCT_FIELDS"][$arItem["ID"]]["ID"]; ?>, '<?= $arResult["PRODUCT_FIELDS"][$arItem["ID"]]["NAME"]; ?>');" 
                                class="wishInBasket">
                                    <?= GetMessage("ADD_TO_BASKET") ?>
                            </a>
                        </p>
                <?}
                if ($_REQUEST["list"] != $uID) {?>
                    <p class="wishDeleteContainer">
                        <a href="javascript:void(0)" 
                            id="<?= $arResult["PRODUCT_FIELDS"][$arItem["ID"]]["ID"] ?>" 
                            class="wishDelete">
                                <?= GetMessage("DELETE") ?>
                        </a>
                    </p>
                <?}?>
            <?} else {?>
                <?if ($arResult["PRODUCT_FIELDS"][$arItem["ID"]]["CATALOG_PRICE_1"] > 0
                    && !in_array ($arResult["PRODUCT_FIELDS"][$arItem["ID"]]["PROPERTY_STATE_ENUM_ID"], $unavailStatusesArr)) {?>
                        <p class="inBasketContainer">
                            <a href="/personal/cart/?action=ADD2BASKET&id=<?= $arResult["PRODUCT_FIELDS"][$arItem["ID"]]["ID"] ?>" 
                                onclick="addtocart_fromwishlist(<?= $arResult["PRODUCT_FIELDS"][$arItem["ID"]]["ID"]; ?>, '<?= $arResult["PRODUCT_FIELDS"][$arItem["ID"]]["NAME"]; ?>'); return false;" 
                                class="wishInBasket" id="wishItem_<?= $arResult["PRODUCT_FIELDS"][$arItem["ID"]]["ID"] ?>">
                                    <?= GetMessage("ADD_TO_BASKET") ?>
                            </a>
                        </p>
                <?}?>
                    <p class="wishDeleteContainer">
                        <a href="javascript:void(0)" 
                            onclick="delete_wishlist_item(<?= $arResult["PRODUCT_FIELDS"][$arItem["ID"]]["ID"] ?>);" 
                            class="wishDelete">
                                <?= GetMessage("DELETE") ?>
                        </a>
                    </p>
                    
                        
            <?}?>
        </div>    
    <?}?>
    <div class="del_notify"></div>       


    <div class="socialWishWrapper">
        <p class="socialWishText"><?= GetMessage("SHARE_A_LIST") ?></p>
        <div class="socServisesPict">
            <?require('include/socialbuttons.php');?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        <?if ($_REQUEST["list"]) {?>
            $(".cartMenuWrap .basketItems:first-child").removeClass("active");
            $("#cardBlock1").hide();
            $(".cartMenuWrap .basketItems:last-child").addClass("active");
            $("#cardBlock2").show();
        <?}?>

    });
</script>
