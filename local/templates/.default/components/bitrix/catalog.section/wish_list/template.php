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
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.5";
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<div class="wishlistBlock">

    <?  
        $uID = $USER -> GetID();

        //список разделов
        $sectionList = array();
        $sect = CIBlockSection::GetList(array(),array("IBLOCK_ID"=>4),false,array("ID","CODE","NAME"));
        while($arSect = $sect->Fetch()) {
            $sectionList[$arSect["ID"]] = $arSect; 
        }
        
        //список авторов
        $authors = array();
        $author = CIBlockElement::GetList(array(),array("IBLOCK_ID"=>29),false,false,array("ID","CODE","NAME"));  
        while($arAuthor = $author->Fetch()) {
            $authors[$arAuthor["ID"]] = $arAuthor; 
        }           
    ?>
    <?
        /*if ($_REQUEST["list"]) {
            $list_user = CUser::GetByID($_REQUEST["list"]) -> Fetch();
            $list_user_name = $list_user["NAME"]." ".$list_user["LAST_NAME"];
        }
        else {
            $list_user = CUser::GetByID($uID) -> Fetch();
            $list_user_name = $list_user["NAME"]." ".$list_user["LAST_NAME"];   
        }     */            
        foreach ($arResult["ITEMS"] as $arItem)
        {  
            if ($_REQUEST["list"])
            {     
                /*if ($arItem["NAME"] == $list_user_name)
                {   */
                    $this_item = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 4, "ID" => $arItem["PROPERTIES"]["PRODUCTS"]["VALUE"]), false, false, array("ID", "NAME", "DETAIL_PICTURE", "PROPERTY_AUTHORS", "PREVIEW_TEXT", "IBLOCK_SECTION_ID", "CATALOG_GROUP_1")) -> Fetch();
                    $this_sect = $sectionList[$this_item["IBLOCK_SECTION_ID"]];//CIBlockSection::GetByID($this_item["IBLOCK_SECTION_ID"])->Fetch();
                    $pict = CFile::ResizeImageGet($this_item["DETAIL_PICTURE"], array('width'=>146, 'height'=>210), BX_RESIZE_IMAGE_EXACT, true);
                    $author = $authors[$this_item["PROPERTY_AUTHORS_VALUE"]];
                ?>
                <div class="wishElement">
                    <div class="imgContainer"><a href="/catalog/<?=$this_sect["CODE"]?>/<?=$this_item["ID"]?>/"><img src="<?=$pict["src"]?>"></a></div>
                    <p class="wishBookName"><a href="/catalog/<?=$this_sect["CODE"]?>/<?=$this_item["ID"]?>/"><?=$this_item["NAME"]?></a></p>
                    <p class="wishBookAutor"><a href="/authors/<?=$author["ID"]?>/"><?=$author["NAME"]?></a></p>
                    <p class="wishBookPrice"><?if ($this_item["CATALOG_PRICE_1"] > 0) {echo ceil($this_item["CATALOG_PRICE_1"])." руб.";} else {echo "Нет в наличии";}?></p>
                    <div class="wishBookDescription"><?=$this_item["PREVIEW_TEXT"]?></div>
                    <? if ($this_item["CATALOG_PRICE_1"] > 0) 
                        {
                        ?>
                        <p class="inBasketContainer"><a href="/personal/cart/?action=ADD2BASKET&id=<?=$this_item["ID"]?>" onclick="addtocart(<?=$this_item["ID"];?>, '<?=$this_item["NAME"];?>');" class="wishInBasket">В корзину</a></p>
                        <?}
                        if ($_REQUEST["list"] != $uID)
                        {?>
                        <p class="wishDeleteContainer"><a href="javascript:void(0)" id="<?=$this_item["ID"]?>"class="wishDelete">Удалить</a></p>
                        <?}?>
                </div>    
                <?/*?>

                <?*/    //}
            }
            else
            {

               /* if ($arItem["NAME"] == $list_user_name)
                {     */
                    $this_item = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 4, "ID" => $arItem["PROPERTIES"]["PRODUCTS"]["VALUE"]), false, false, array("ID", "NAME", "DETAIL_PICTURE", "PROPERTY_AUTHORS", "PREVIEW_TEXT", "IBLOCK_SECTION_ID", "CATALOG_GROUP_1")) -> Fetch();
                    //arshow($this_item);
                    $this_sect = $sectionList[$this_item["IBLOCK_SECTION_ID"]];
                    $pict = CFile::ResizeImageGet($this_item["DETAIL_PICTURE"], array('width'=>146, 'height'=>210), BX_RESIZE_IMAGE_EXACT, true);
                    $author = $authors[$this_item["PROPERTY_AUTHORS_VALUE"]];
                ?>
                <div class="wishElement">
                    <div class="imgContainer"><a href="/catalog/<?=$this_sect["CODE"]?>/<?=$this_item["ID"]?>/"><img src="<?=$pict["src"]?>"></a></div>
                    <p class="wishBookName"><a href="/catalog/<?=$this_sect["CODE"]?>/<?=$this_item["ID"]?>/"><?=$this_item["NAME"]?></a></p>
                    <p class="wishBookAutor"><a href="/authors/<?=$author["ID"]?>/"><?=$author["NAME"]?></a></p>
                    <p class="wishBookPrice"><?if ($this_item["CATALOG_PRICE_1"] > 0) {echo ceil($this_item["CATALOG_PRICE_1"])." руб.";} else {echo "Нет в наличии";}?></p>
                    <div class="wishBookDescription"><?=$this_item["PREVIEW_TEXT"]?></div>
                    <? if ($this_item["CATALOG_PRICE_1"] > 0) 
                        {
                        ?>
                        <p class="inBasketContainer"><a href="/personal/cart/?action=ADD2BASKET&id=<?=$this_item["ID"]?>" onclick="addtocart_fromwishlist(<?=$this_item["ID"];?>, '<?=$this_item["NAME"];?>'); return false;" class="wishInBasket" id="wishItem_<?=$this_item["ID"]?>">В корзину</a></p>
                        <?}?>
                    <p class="wishDeleteContainer"><a href="javascript:void(0)" onclick="delete_wishlist_item(<?=$this_item["ID"]?>);" class="wishDelete">Удалить</a></p>
                </div>    
                <?/*?>

                <?*/    
               // }    
            }
    }?>
    <div class="del_notify"></div>       


    <div class="socialWishWrapper">
        <p class="socialWishText">Поделиться списком:</p>
        <div class="socServisesPict">
            <?/*?>
            <a href="http://vk.com/share.php?url=http://<?=$_SERVER["SERVER_NAME"]?>/personal/cart/?list=<?=$uID?>&title=Мой список желаний"><img src="/img/vkSocial.png"></a>
            <a href="https://twitter.com/intent/tweet?url=http://<?=$_SERVER["SERVER_NAME"]?>/personal/cart/?list=<?=$uID?>&text=Мой список желаний"><img src="/img/twitRegistrat.png"></a>
            <a href="https://www.facebook.com/sharer.php?u=http://<?=$_SERVER["SERVER_NAME"]?>/personal/cart/?list=<?=$uID?>"><img src="/img/facebookRegistr.png"></a> 
            <a href="https://plus.google.com/share?url=http://<?=$_SERVER["SERVER_NAME"]?>/personal/cart/?list=<?=$uID?>"><img src="/img/googlePlusReg.png"></a>
            <a href="http://www.ok.ru/dk?st.cmd=addShare&st.s=1&st._surl=http://<?=$_SERVER["SERVER_NAME"]?>/personal/cart/?list=<?=$uID?>"><img src="/img/oklRegistr.png"></a>
            <?*/?>
            <?require('include/socialbuttons.php');?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        <?if ($_REQUEST["list"])
            {?>
            $(".cartMenuWrap .basketItems:first-child").removeClass("active");
            $("#cardBlock1").hide();
            $(".cartMenuWrap .basketItems:last-child").addClass("active");
            $("#cardBlock2").show();
            <?}?>

    });
</script>
