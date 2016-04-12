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
$uID = $USER -> GetID();
?>
<div class="wishlistBlock">

    <?foreach ($arResult["ITEMS"] as $arItem)
        {
            $curr_user = CUser::GetByID($USER -> GetID()) -> Fetch();
            $user = $curr_user["NAME"]." ".$curr_user["LAST_NAME"];
            if ($arItem["NAME"] == $user)
            {?>
            <?
                $this_item = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 4, "ID" => $arItem["PROPERTIES"]["PRODUCTS"]["VALUE"]), false, false, array("ID", "NAME", "DETAIL_PICTURE", "PROPERTY_AUTHORS", "PREVIEW_TEXT", "IBLOCK_SECTION_ID", "CATALOG_GROUP_1")) -> Fetch();
                //arshow($this_item);
                $this_sect = CIBlockSection::GetByID($this_item["IBLOCK_SECTION_ID"])->Fetch();
                $pict = CFile::ResizeImageGet($this_item["DETAIL_PICTURE"], array('width'=>146, 'height'=>210), BX_RESIZE_IMAGE_EXACT, true);
            ?>
            <div class="wishElement">
                <div class="imgContainer"><a href="/catalog/<?=$this_sect["CODE"]?>/<?=$this_item["ID"]?>/"><img src="<?=$pict["src"]?>"></a></div>
                <p class="wishBookName"><a href="/catalog/<?=$this_sect["CODE"]?>/<?=$this_item["ID"]?>/"><?=$this_item["NAME"]?></a></p>
                <p class="wishBookAutor"><a href="#">Джонатан Бэйлор</a></p>
                <p class="wishBookPrice"><?if ($this_item["CATALOG_PRICE_1"] > 0) {echo ceil($this_item["CATALOG_PRICE_1"])." руб.";} else {echo "Нет в наличии";}?></p>
                <div class="wishBookDescription"><?=$this_item["PREVIEW_TEXT"]?></div>
                <? if ($this_item["CATALOG_PRICE_1"] > 0) 
                    {
                    ?>
                    <p class="inBasketContainer" id="wishItem_<?=$this_item["ID"]?>"><a href="/personal/cart/?action=ADD2BASKET&id=<?=$this_item["ID"]?>" onclick="addtocart(<?=$this_item["ID"];?>, '<?=$this_item["NAME"];?>'); return false;" class="wishInBasket" id="wishItem_<?=$this_item["ID"]?>">В корзину</a></p>
                    <?}?>
                <p class="wishDeleteContainer"><a href="javascript:void(0)" onclick="delete_wishlist_item(<?=$this_item["ID"]?>);" class="wishDelete">Удалить</a></p>
            </div>
            <?/*?>
                <div class="wishElement">
                <div class="imgContainer"><a href="#"><img src="/img/book956.png"></a></div>
                <p class="wishBookName"><a href="#">Дело не в калориях</a></p>
                <p class="wishBookAutor"><a href="#">Джонатан Бэйлор</a></p>
                <p class="wishBookPrice">655 руб.</p>
                <p class="wishBookDescription">Эта книга рассказывает об истории России на всем протяжении правления Владимира Путина, с 2000 по 2015 год. В основу книги легли документы, открытые источники и десятки уникальных личных интервью, которые </p>
                <p class="inBasketContainer"><a href="#" class="wishInBasket">В корзину</a></p>
                <p class="wishDeleteContainer"><a href="#" class="wishDelete">Удалить</a></p>
                </div>
                <div class="wishElement">
                <div class="imgContainer"><a href="#"><img src="/img/book956.png"></a></div>
                <p class="wishBookName"><a href="#">Дело не в калориях</a></p>
                <p class="wishBookAutor"><a href="#">Джонатан Бэйлор</a></p>
                <p class="wishBookPrice">655 руб.</p>
                <p class="wishBookDescription">Эта книга рассказывает об истории России на всем протяжении правления Владимира Путина, с 2000 по 2015 год. В основу книги легли документы, открытые источники и десятки уникальных личных интервью, которые </p>
                <p class="inBasketContainer"><a href="#" class="wishInBasket">В корзину</a></p>
                <p class="wishDeleteContainer"><a href="#" class="wishDelete">Удалить</a></p>
                </div>
                <?*/
            }
    }?>
    <div class="del_notify"></div> 
    <div class="socialWishWrapper">
        <p class="socialWishText">Поделиться списком:</p>
        <div class="socServisesPict">
            <a href="http://vk.com/share.php?url=http://<?=$_SERVER["SERVER_NAME"]?>/personal/cart/?list=<?=$uID?>&title=Мой список желаний"><img src="/img/vkSocial.png"></a>
            <a href="https://twitter.com/intent/tweet?url=http://<?=$_SERVER["SERVER_NAME"]?>/personal/cart/?list=<?=$uID?>&text=Мой список желаний"><img src="/img/twitRegistrat.png"></a>
            <a href="https://www.facebook.com/sharer.php?u=http://<?=$_SERVER["SERVER_NAME"]?>/personal/cart/?list=<?=$uID?>"><img src="/img/facebookRegistr.png"></a>
            <a href="https://plus.google.com/share?url=http://<?=$_SERVER["SERVER_NAME"]?>/personal/cart/?list=<?=$uID?>"><img src="/img/googlePlusReg.png"></a>
            <a href="http://www.ok.ru/dk?st.cmd=addShare&st.s=1&st._surl=http://<?=$_SERVER["SERVER_NAME"]?>/personal/cart/?list=<?=$uID?>"><img src="/img/oklRegistr.png"></a>
        </div>
    </div>
</div>
