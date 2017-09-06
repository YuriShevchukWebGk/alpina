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
?>

<style>
.allBooksWrapp .bookName {
	padding-top:0;
	margin-top:16px;
}
.banner {
	text-align:center;
	margin:20px auto 40px
}
.description {
	font-family:Walshein_light!important;
	font-size:20px;
	text-align:left;
	margin-bottom:40px;
}
ul {
	list-style-type:circle;
	padding:20px 40px
}
.bagsTop,.bagsBottom {
	width:100%;
	clear:both;
}
.bagsTop img,.bagsBottom img {
	width:100%;
	max-width:500px;
	margin:10px 30px;
	display:inline-block;
	height:auto!important
}
.bagsTop {
	margin-bottom:80px
}
</style>
<div class="mibf allBooksWrapp">
            <div class="catalogWrapper">

                <p class="titleMain"><?$APPLICATION->ShowTitle()?></p>
				<img src="img/landing2.jpg" class="banner no-mobile" />
				<div class="description">
					С 6 по 10 сентября в Москве проходит Международная книжная выставка-ярмарка. Мы в деле! И у нас целых три стенда:<ul>
						<li>D11 (взрослый),</li>
						<li>F38 (детский),</li>
						<li>D29 (AnimalBooks и Московский зоопарк).</li>
					</ul>
					Мы понимаем, что не все наши читатели смогут туда попасть. Но это не мешает получить свою сумку книг с выставки!<br /><br />Здесь вы найдёте все лучшие новинки этого сезона. Закажите пять из них, получите скидку 10% и выберите в подарок любую из наших фирменных сумок. А мы доставим её и книги в любую точку мира!
					<br /><br />
					Акция распространяется на заказы, сделанные в интернет-магазине «Альпина Паблишер», и действует с 6 по 10 сентября включительно.
				</div>
                <div class="catalogBooks">
					<div class="bagsTop">
						<?for($i = 1;$i <= 4; $i++) {?>
							<img src="img/<?=$i?>.jpg" style="height:auto!important" />
						<?}?>
					</div>

                    <?foreach($arResult["ITEMS"] as $arItem)
                    {
                        foreach ($arItem["PRICES"] as $code => $arPrice)
                        {
                            if ($arPrice["PRINT_DISCOUNT_VALUE"])
                            {
                        $pict = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array('width'=>142, 'height'=>210), BX_RESIZE_IMAGE_PROPORTIONA, true);
                        $dbBasketItems = CSaleBasket::GetList(array(), array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL", "PRODUCT_ID" => $arItem["ID"]), false, false, array("ID", "CALLBACK_FUNC", "MODULE", "PRODUCT_ID", "QUANTITY", "PRODUCT_PROVIDER_CLASS"))->Fetch();
                        $curr_author = CIBlockElement::GetByID($arItem["PROPERTIES"]["AUTHORS"]["VALUE"][0]) -> Fetch();
                        ?>
                    <div class="bookWrapp">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                            <div class="section_item_img">
                                <?
                                if ($pict["src"])
                                {
                                ?>               
                                    <img src=<?=$pict["src"]?>>
                                <?
                                }
                                else
                                {
                                ?>
                                    <img src="/images/no_photo.png" width="142" height="142">    
                                <?
                                }
                                ?>
                            </div>
                        <p class="bookName" title="<?=$arItem["NAME"]?>"><?=$arItem["NAME"]?></p>
                        <p class="bookAutor"><?=$curr_author["NAME"]?></p>
                        <p class="tapeOfPack"><?=$arItem["PROPERTIES"]["COVER_TYPE"]["VALUE"]?></p>
                        <?
                            if (intval($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) != 22 && intval($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) != 23)
                            {

                                if ($arPrice["DISCOUNT_VALUE_VAT"])
                                {
                                ?>
                                    <p class="bookPrice"><?=ceil($arPrice["DISCOUNT_VALUE_VAT"])?> <span></span></p>
                                <?
                                }
                                else
                                {
                                ?>
                                    <p class="bookPrice"><?=ceil($arPrice["ORIG_VALUE_VAT"])?> <span></span></p>
                                <?
                                }
                                ?>
                                </a>
                                <?  
                                if ($dbBasketItems["QUANTITY"] == 0)
                                {?>
                                    <a class="product<?=$arItem["ID"];?>" href="<?echo $arItem["ADD_URL"]?>" onclick="addtocart(<?=$arItem["ID"];?>, '<?=$arItem["NAME"];?>');return false;"><p class="basketBook">В корзину</p></a>
                                <?   
                                }
                                else
                                {
                                    ?>
                                <a class="product<?=$arItem["ID"];?>" href="/personal/cart/"><p class="basketBook" style="background-color: #A9A9A9;color: white;">Оформить</p></a> 
                                <?
                                }
                            }
                            else if (intval($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) == 23)
                            {?>
                            <p class="bookPrice"><?=$arItem["PROPERTIES"]["STATE"]["VALUE"]?></p>
                            </a>        
                            <?}
                            else
                            {?>
                            <p class="bookPrice"><?=strtolower(FormatDate("j F", MakeTimeStamp($arItem['PROPERTIES']['SOON_DATE_TIME']['VALUE'], "DD.MM.YYYY HH:MI:SS")));?></p>
                            </a>    
                            <?}
                        ?>
                        <?
							$gdeSlon .= $arItem['ID'].':'.ceil($arPrice["DISCOUNT_VALUE_VAT"]).',';
                            if ($USER -> IsAuthorized())
                            {
                            ?>
                            <p class="basketLater" id="<?=$arItem["ID"]?>">Куплю позже</p>
                            <?
                            }
                        ?>
                        </a>
                    </div>
                    <?      }
                        }
                    }?>
					<div class="bagsBottom">
						<?for($i = 1;$i <= 6; $i++) {?>
							<img src="img/bag_<?=$i?>.jpg" style="width:100%;max-width:500px;margin:10px 30px;float:left">
						<?}?>
					</div>
                </div>
                <div class="wishlist_info">
                    <div class="CloseWishlist"><img src="/img/catalogLeftClose.png"></div>
                    <span></span>
                </div>
            </div>
</div>
<!-- GdeSlon -->
<script type="text/javascript" src="//www.gdeslon.ru/landing.js?mode=list&amp;codes=<?=substr($gdeSlon,0,-1)?>&amp;mid=79276"></script>
