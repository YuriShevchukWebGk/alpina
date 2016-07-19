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

<? $curr_dir = $APPLICATION -> GetCurDir(); ?>
<div class="wrapperCategor">
    <div class="categoryWrapper">

        <div class="catalogIcon">
        </div>
        <div class="basketIcon">
        </div>

        <div class="contentWrapp">
            
            <p class="grayTitle"></p>
             
         <ul class="filterParams">
         
            <? $i = 1;
            foreach (array("POPULARITY", "DATE", "PRICE") as $sort_option) {?>
                <li <?if ($_REQUEST['SORT'] == $sort_option) { ?> class="active" <?}?>>
                 <p data-id="<?= $i ?>">
                     <?if ($_REQUEST['SORT'] == $sort_option && $_REQUEST["DIRECTION"] == 'ASC') {?>
                         <a href="<?= $curr_dir ?>?SORT=<?= $sort_option ?>&DIRECTION=DESC"><?= GetMessage("BY_" . $sort_option) ?></a>
                     <?} else {?>
                         <a href="<?= $curr_dir ?>?SORT=<?= $sort_option ?>&DIRECTION=ASC"><?= GetMessage("BY_" . $sort_option) ?></a>
                     <?}?>
                 </p>
             </li>    
            <?
            $i++;
            }?>
         </ul>
         <div class="otherBooks" id="block1">
             <ul>

                 <?$criteoCounter = 0; 
                 $criteoItems = Array(); 
                 $gtmEcommerceImpressions = '';
                     foreach ($arResult["ITEMS"] as $cell => $arItem) {  
                         foreach ($arItem["PRICES"] as $code => $arPrice) { 
                         ?>
                         <li>
                             <div class="categoryBooks">
                                 <div class="sect_badge">
                                     <?if (($arItem["PROPERTIES"]["discount_ban"]["VALUE"] != "Y") 
                                         && $arItem['PROPERTIES']['spec_price']['VALUE'] ) {
                                                if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/img/" . $arItem['PROPERTIES']['spec_price']['VALUE'] . "percent.png")) { 
                                                    echo '<img class="discount_badge" src="/img/' . $arItem['PROPERTIES']['spec_price']['VALUE'] . 'percent.png">';
                                                }

                                     }?>
                                 </div>
                                 
                                 <a href="<?= $arItem["DETAIL_PAGE_URL"]?>" onclick="productClickTracking(<?= $arItem["ID"];?>, '<?= $arItem["NAME"];?>', '<?= ceil($arPrice["DISCOUNT_VALUE_VAT"])?>','<?= $arResult["NAME"]?>', <?= ($cell+1)?>, 'Catalog Section');">
                                     <div class="section_item_img">
                                         <?if ($arResult[$arItem["ID"]]["PICTURE"]["src"]) {?>               
                                             <img src=<?= $arResult[$arItem["ID"]]["PICTURE"]["src"] ?>>
                                         <?} else {?>
                                             <img src="/images/no_photo.png" width="142" height="142">    
                                         <?}?>
                                         <?if(!empty($arItem["PROPERTIES"]["number_volumes"]["VALUE"])) {?>
                                             <span class="volumes"><?= $arItem["PROPERTIES"]["number_volumes"]["VALUE"] ?></span>
                                         <?}?>
                                     </div> 
                                     <p class="nameBook" title="<?= $arItem["NAME"]?>"><?= $arItem["NAME"] ?></p>
                                     <p class="bookAutor"><?= $arResult[$arItem["ID"]]["CURRENT_AUTHOR"]["NAME"] ?></p>
                                     <p class="tapeOfPack"><?= $arItem["PROPERTIES"]["COVER_TYPE"]["VALUE"] ?></p>
                                     <?

                                            if ($arPrice["DISCOUNT_VALUE_VAT"]) { ?>
                                                <p class="priceOfBook"><?= ceil($arPrice["DISCOUNT_VALUE_VAT"])?> <span><?= GetMessage("ROUBLES") ?></span></p>
                                            <? } else { ?>
                                                <p class="priceOfBook"><?= ceil($arPrice["ORIG_VALUE_VAT"])?> <span><?= GetMessage("ROUBLES") ?></span></p>
                                            <? }
                                         ?>
                                         <? if (intval($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) == getXMLIDByCode(CATALOG_IBLOCK_ID, "STATE", "net_v_nal")) {?>
                                            <p class="unavailableBook"><?= $arItem["PROPERTIES"]["STATE"]["VALUE"] ?></p>
                                            
                                         <?} else {
                                             if ($arResult[$arItem["ID"]]["GIFTS_COUNT"] == 0) {
                                        ?>
                                                <a class="ask_form_for_gift product<?= $arItem["ID"];?>" href="javascript:void(0)">
                                                    <p class="giftBook" data-id="<?= $arItem["ID"] ?>"><?= GetMessage("TO_SUSPEND") ?></p>
                                                </a>
                                             <?} else {?>
                                                <p class="giftedBook" data-id="<?= $arItem["ID"] ?>"><?= $arResult[$arItem["ID"]]["GIFTS_COUNT"] ?> шт. уже купили</p>       
                                             <?}
                                         }?>
                                 
                             </a>
                                 
                             </div>        
                         </li>
                         <?      //}
                         }
                         if($criteoCounter<3){
                             array_push($criteoItems, $arItem['ID']);  
                         }
                         $criteoCounter++;

                         $gtmEcommerceImpressions .= "{";
                         $gtmEcommerceImpressions .= "'name': '" . $arItem["NAME"] . "',";
                         $gtmEcommerceImpressions .= "'id': '" . $arItem['ID'] . "',";
                         $gtmEcommerceImpressions .= "'price': '" . ceil($arPrice["DISCOUNT_VALUE_VAT"]) . "',";
                         $gtmEcommerceImpressions .= "'category': '" . $arResult["NAME"] . "',";
                         $gtmEcommerceImpressions .= "'list': 'category - " . $arResult["NAME"] . "',";
                         $gtmEcommerceImpressions .= "'position': '" . ($cell+1) . "'";
                         $gtmEcommerceImpressions .= "},";                        
                 }?>

                 <script type="text/javascript">
                     <!-- //dataLayer GTM -->
                     dataLayer.push({
                         'categoryName' : '<?= $arResult["NAME"] ?>',
                         'categoryId' : '<?= $arResult['ID']; ?>',
                         'ecommerce': {
                             'impressions': [
                                 <?= $gtmEcommerceImpressions ?>
                             ]
                         }

                     });
                     <!-- // dataLayer GTM -->
                 </script>


                 <!--Criteo counter-->
                 <script type="text/javascript" src="//static.criteo.net/js/ld/ld.js" async="true"></script>
                 <script type="text/javascript">
                     window.criteo_q = window.criteo_q || [];
                     window.criteo_q.push(
                         { event: "setAccount", account: 18519 },
                         <?if ($USER->IsAuthorized()) {?>  
                             { event: "setEmail", email: "<?= $USER->GetEmail() ?>" },
                         <?}?>
                         { event: "setSiteType", type: "d" },
                         { event: "viewList", item: [<?foreach ($criteoItems as $criteoItem) {echo $criteoItem.', ';};?>]}
                     );
                 </script>                    
             </ul>

         </div>
            <div class="wishlist_info">
                <div class="CloseWishlist"><img src="/img/catalogLeftClose.png"></div>
                <span></span>
            </div>   

            <?= $arResult["NAV_STRING"] ?>            
        </div>
      
    </div>
</div>
<div class="gift_popup_form">
    <form action="" method="post">
    <table>
        <tr>
            <td><?= GetMessage("NAME") ?></td>
            <td><input type="text" name="buyer_name" class="buyer_name"></td>
        </tr>
        <tr>
            <td><?= GetMessage("QUANTITY") ?></td>
            <td><input type="text" name="gift_quantity" class="gift_quantity"></td>
        </tr>
    </table>
    <input type="button" name="gift_button" class="gift_button" value="<?= GetMessage("TO_BUY") ?>">
    <input type="hidden" name="item_id" class="item_id" value="">
    </form>
</div>
<div class="gifted_books_buyers_list" style="display:none;">
    <div class="list_block">
        <div class="list_header">
        <?= GetMessage("BOUGHT_GIFT_BOOKS") ?>
        </div>
        <div class="buyers_list">
        </div>
        <div class="summary_buyers_count">
            <table>
                <tr>
                    <td><?= GetMessage("TOTALLY_BOUGHT") ?></td>
                    <td><div class="rounded_summary_number"></div></td>
                </tr>
            </table>
        </div>
    </div>
    <img src="/img/catalogLeftClose.png" class="popup_list_Close" onclick="$('.gifted_books_buyers_list, .layout').hide();" style="display: inline;">
</div>
<script>
    // скрипт ajax-подгрузки товаров в блоке "Все книги"
    $(document).ready(function() {
        $(".leftMenu ul li").each(function(){
            if ($(this).children("a").attr("href") == "<?= $APPLICATION -> GetCurDir() ?>") {
                $(this).children("a").find("p").css("font-weight", "bold"); 
                if ($(this).closest("ul").hasClass("secondLevel")) {
                    $(this).closest("ul").parent("li").find("a p").addClass("activeListName"); 
                    $(this).closest("ul").parent("li").find(".secondLevel").show();       
                } else {
                    $(this).find("ul.secondLevel a p").addClass("activeListName"); 
                    $(this).find("ul.secondLevel").show();  
                }   
            }
        })
        <?$navnum = $arResult["NAV_RESULT"]->NavNum;
        switch ($arParams["ELEMENT_SORT_FIELD2"]) {
            case "CATALOG_PRICE_1":
            $sort = "PRICE";
            break;
            
            case "PROPERTY_POPULARITY":
            $sort = "POPULARITY";
            break;
            
            case "PROPERTY_YEAR":
            $sort = "DATE";
            break;
        }?>
        <?if (isset($_REQUEST["PAGEN_".$navnum])) {
           ?>
            var page = <?= $_REQUEST["PAGEN_".$navnum] ?> + 1;
        <?} else {?>
            var page = 2;
        <?}?>
        var maxpage = <?= ($arResult["NAV_RESULT"]->NavPageCount) ?>;
        var WrappHeight = $(".wrapperCategor").height();
        var RecHeight = $(".grayTitle").height();
        var BooksLiLength = $(".otherBooks ul li").length;
        
        var startHeight = WrappHeight+RecHeight+ Math.ceil(($(".otherBooks ul li").length - 18) / 6) * 455;
        $(".wrapperCategor").css("height", startHeight+"px");
        

        <?if (!$USER -> IsAuthorized()) {?>
            $(".categoryWrapper .categoryBooks").hover(function() {
                $(this).css("height", "390px");
            });
        <?}?>
        
        <?if (!$_REQUEST["SORT"]) {?>
            $(".filterParams li:first-child").addClass("active");    
        <?} ?>    
    });
</script>