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
<?
CModule::IncludeModule("sale");
//$BuyerList = CUser::GetByID($USER->GetID());  
$arBasketItems = array();
$dbBasketItems = CSaleBasket::GetList(
    array(
        "NAME" => "ASC",
        "ID" => "ASC"
    ),
    array(
        "FUSER_ID" => CSaleBasket::GetBasketUserID(),
        "LID" => SITE_ID,
        "ORDER_ID" => "NULL"
    ),
    false,
    false,
    array("ID","PRICE","NAME","QUANTITY","DISCOUNT_PRICE","ORDER_PAYED")
);
while ($arItems = $dbBasketItems->Fetch()) {
    if (strlen($arItems["CALLBACK_FUNC"]) > 0) {
        CSaleBasket::UpdatePrice($arItems["ID"], 
            $arItems["CALLBACK_FUNC"], 
            $arItems["MODULE"], 
            $arItems["PRODUCT_ID"], 
            $arItems["QUANTITY"]);
        $arItems = CSaleBasket::GetByID($arItems["ID"]);
    }
    if($arItems["QUANTITY"] > 1){
        $arItems["PRICE"]*=$arItems["QUANTITY"];
    } 
    $arBasketItems["sum_pruce"] += $arItems["PRICE"];

}
$rr = CCatalogDiscountSave::GetRangeByDiscount($arOrder = array(), $arFilter = array(), $arGroupBy = false, $arNavStartParams = false, $arSelectFields = array());
$ar_sale = array();
while($ar_sale=$rr->Fetch()){
    $ar_sale_1[] = $ar_sale;
}
$SavingsDiscount =  CCatalogDiscountSave::GetDiscount(array('USER_ID' => $USER->GetID()), true);  
global $discount;
if($USER->IsAuthorized()){// blackfriday черная пятница
    if($SavingsDiscount[0]["SUMM"] < $ar_sale_1[0]["RANGE_FROM"]){ 
        $printDiscountText = "<span class='sale_price'>Вам не хватает ".($ar_sale_1[0]["RANGE_FROM"] - $SavingsDiscount[0]["SUMM"])." руб. до получения скидки в ".$ar_sale_1[0]["VALUE"]."%</span>";
    }elseif($SavingsDiscount[0]["SUMM"] < $ar_sale_1[1]["RANGE_FROM"]){ 
        $printDiscountText = "<span class='sale_price'>Вам не хватает ".($ar_sale_1[1]["RANGE_FROM"] - $SavingsDiscount[0]["SUMM"])." руб. до получения скидки в ".$ar_sale_1[1]["VALUE"]."%</span>";
        $discount = $ar_sale_1[0]["VALUE"]; // процент накопительной скидки
    }else{
        $discount = $ar_sale_1[1]["VALUE"];  // процент накопительной скидки
    } 
}else{ 
    if($arBasketItems["sum_pruce"] < $ar_sale_1[0]["RANGE_FROM"]){ 
        $printDiscountText = "<span class='sale_price'>Вам не хватает ".($ar_sale_1[0]["RANGE_FROM"] - $arBasketItems["sum_pruce"])." руб. до получения скидки в ".$ar_sale_1[0]["VALUE"]."%</span>";                            
    }elseif($arBasketItems["sum_pruce"] < $ar_sale_1[1]["RANGE_FROM"]){ 
        $printDiscountText = "<span class='sale_price'>Вам не хватает ".($ar_sale_1[1]["RANGE_FROM"] - $arBasketItems["sum_pruce"])." руб. до получения скидки в ".$ar_sale_1[1]["VALUE"]."%</span>"; 
        $discount = $ar_sale_1[0]["VALUE"];  // процент накопительной скидки
    }else{
        $discount = $ar_sale_1[1]["VALUE"];  // процент накопительной скидки
    }   
}

?>
          <div class="uLookSlider">
                <div>
                    <ul>
                        <?foreach ($arResult["ITEMS"] as $arItem) {
                            $pict = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array('width'=>142, 'height'=>210), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                            foreach ($arItem["PRICES"] as $arPrice) {?>
                                <li>
                                    <div class="">
                                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                                            <div class="section_item_img">
                                                <img src="<?=$pict["src"]?>" class="bookImg" title="<?=$arItem["NAME"]?>" alt="<?=$arItem["NAME"]?>">
                                            </div>
                                            <p class="bookName" title="<?=$arItem["NAME"]?>"><?=$arItem["NAME"]?></p>
                                            <p class="tapeOfPack"><?=$arItem["PROPERTIES"]["COVER_TYPE"]["VALUE"]?></p>
                                            <?
                                            if (intval($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) != 22 
                                                && intval($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) != 23) {
                                                    if ($discount) {?>
                                                    <p class="bookPrice"><?=($arPrice["DISCOUNT_VALUE_VAT"]*(1 - $discount/100))?> <span>руб.</span></p>
                                                    <?
                                                    } else {
                                                    ?>    
                                                    <p class="bookPrice"><?=($arPrice["DISCOUNT_VALUE_VAT"])?> <span>руб.</span></p>
                                                    <?
                                                    }
                                                    ?>
                                            <?
                                            } else if (intval($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) == 23) {
                                            ?>
                                                <p class="bookPrice"><?=$arItem["PROPERTIES"]["STATE"]["VALUE"]?></p>
                                            <?
                                            } else {?>
                                                <p class="bookPrice"><?=strtolower(FormatDate("j F Y", MakeTimeStamp($arItem['PROPERTIES']['SOON_DATE_TIME']['VALUE'], "DD.MM.YYYY HH:MI:SS")));?></p>
                                            <?}?>
                                        </a>
                                    </div>    
                                </li>
                          <?}
                        }?>

                    </ul>
                    <img src="/img/arrowLeft.png" class="left">
                    <img src="/img/arrowRight.png" class="rigth">
                </div>
          </div>

