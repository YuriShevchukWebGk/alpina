<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
    $bDefaultColumns = $arResult["GRID"]["DEFAULT_COLUMNS"];
    $colspan = ($bDefaultColumns) ? count($arResult["GRID"]["HEADERS"]) : count($arResult["GRID"]["HEADERS"]) - 1;
    $bPropsColumn = false;
    $bUseDiscount = false;
    $bPriceType = false;
    $bShowNameWithPicture = ($bDefaultColumns) ? true : false; // flat to show name and picture column in one column
?>

<?

    $itemsForCriteo = Array();
    $googleECommerce = Array();
    $itemsForFloctory = Array();
    $itemsForRetailRocket = array();


    foreach ($arResult["BASKET_ITEMS"] as $key => $basketItem) {
        array_push($itemsForCriteo,"{ id: '".$basketItem["PRODUCT_ID"]."', price: ".$basketItem["PRICE"].", quantity: ".$basketItem["QUANTITY"]." }");
        array_push($itemsForFloctory,"{ id: '".$basketItem["PRODUCT_ID"]."', price: ".$basketItem["PRICE"].", quantity: ".$basketItem["QUANTITY"].", title: '".$basketItem["NAME"]."' }");
        array_push($itemsForRetailRocket,"{ id: '".$basketItem["PRODUCT_ID"]."', price: ".$basketItem["PRICE"].", qnt: ".$basketItem["QUANTITY"]." }");

        // --- for google ecommerce

        $itemRes = CIBlockElement::GetByID($basketItem["PRODUCT_ID"]);
        if($itemData = $itemRes->GetNext()){
            $itemSectionID = $itemData['IBLOCK_SECTION_ID'];
        }

        $productSectionName = CIBlockSection::GetByID($itemSectionID);
        if($filteredSection = $productSectionName->GetNext()){
            $parentSectionName = $filteredSection['NAME']; 
        }

        array_push($googleECommerce,"'name': '".$basketItem['NAME']."','sku': '".$basketItem["PRODUCT_ID"]."','category': '".$parentSectionName."','price': '".$basketItem["PRICE"]."','quantity': '".$basketItem["QUANTITY"]."'");   
    }

    // --- criteo
    $comma_separated_criteo = implode(",", $itemsForCriteo);
    $comma_separated_criteo = '['.$comma_separated_criteo.']';
    $_SESSION['criteo'] = $comma_separated_criteo;
    // ---- google ecommerce
    $_SESSION['googleECommerce'] = $googleECommerce; 
    // ----  floctory
    $comma_separated_floctory = implode(",", $itemsForFloctory);
    $comma_separated_floctory = '['.$comma_separated_floctory.']';
    $_SESSION['floctory'] = $comma_separated_floctory;
    //---- retail rocket
    $comma_separated_retailRocket = implode(",", $itemsForRetailRocket);
    $comma_separated_retailRocket = '['.$comma_separated_retailRocket.']';
    $_SESSION['retailRocket'] = $comma_separated_retailRocket;


?>

<div class="bx_ordercart">
    <div class="totalPriceWrap">
        <div class="totalCost">
            <? if($_SESSION["CUSTOM_COUPON"]["DEFAULT_COUPON"]=="N") { 
                    $priceCustCoup = ((float)$arResult["ORDER_TOTAL_PRICE_FORMATED"] - (float)$_SESSION["CUSTOM_COUPON"]["COUPON_VALUE"]);
                    if($priceCustCoup < 0) {
                        $priceCustCoup = 0;
                    }  
                    $priceCustCoup = $priceCustCoup + (float)$arResult["DELIVERY_PRICE_FORMATED"];
                    echo '0 руб.';
                } else {
                    if (floatval($arResult['ORDER_WEIGHT']) > 0){?>
                    <p><?=$arResult["ORDER_WEIGHT_FORMATED"]?></p>
                    <?}?>     

                <?if ($bUseDiscount){
                    ?>
                    <p ><?=$arResult["ORDER_PRICE_FORMATED"]?><br/><span style="text-decoration:line-through; color:#828282;" class="SumTable"><?=$arResult["PRICE_WITHOUT_DISCOUNT"]?></span></p>
                    <?} else {?>
                    <p class="SumTable"><?=$arResult["ORDER_PRICE_FORMATED"]?></p>
                    <?}?>                    

                <? if (doubleval($arResult["DISCOUNT_PRICE"]) > 0){?>
                    <p><?echo $arResult["DISCOUNT_PRICE_FORMATED"]?></p>
                    <?}?>   

                <? if(!empty($arResult["TAX_LIST"])){
                        foreach($arResult["TAX_LIST"] as $val)
                        {?>
                        <p><?=$val["NAME"]?> <?=$val["VALUE_FORMATED"]?></p>
                        <?}
                    }
                }
            ?> 

            <?// if (doubleval($arResult["DELIVERY_PRICE"]) > 0){?>
            <p class="deliveryPriceTable"><?=$arResult["DELIVERY_PRICE_FORMATED"]?></p>  
            <?//}?>                               
            <? if($_SESSION["CUSTOM_COUPON"]["DEFAULT_COUPON"]=="N") {?>
                <p><span class="allCost finalSumTable"><?=$priceCustCoup?></span></p>    
                <?} else {    ?>
                <p><span class="allCost finalSumTable"><?=$arResult["ORDER_TOTAL_PRICE_FORMATED"]?></span></p> 
                <?}?>
        </div>
        <div class="totalText">
            <span style="display: none;" class="order_weight"><?=$arResult["ORDER_WEIGHT_FORMATED"]?></span>
            <?if (floatval($arResult['ORDER_WEIGHT']) > 0){?>
                <p>Вес</p>
                <?}?>    

            <p>Товаров на сумму</p>    

            <? if (doubleval($arResult["DISCOUNT_PRICE"]) > 0){?>
                <p>Скидка</p>
                <?}?>

            <? if(!empty($arResult["TAX_LIST"])){
                    foreach($arResult["TAX_LIST"] as $val)
                    {
                    ?>
                    <p><?=$val["VALUE_MONEY_FORMATED"]?></p>                          
                    <?
                    }
                }
            ?>
            <?
                $totalDiscountSum = 0;
                $totalDiscountPerc = $arResult['BASKET_ITEMS'][0]['DISCOUNT_PRICE_PERCENT_FORMATED'] ? $arResult['BASKET_ITEMS'][0]['DISCOUNT_PRICE_PERCENT_FORMATED'] : "0%";

                foreach ($arResult['BASKET_ITEMS'] as $key => $value) {
                    $totalDiscountSum +=$value['DISCOUNT_PRICE'];
                }

                $_SESSION['EMAIL_DISCOUNT_PERCENT_TOTAL'] = $totalDiscountPerc;
                $_SESSION['EMAIL_DISCOUNT_SUM_TOTAL'] = $totalDiscountSum." руб.";
                $_SESSION['EMAIL_ORDER_WEIGHT'] = $arResult["ORDER_WEIGHT_FORMATED"];
            ?>     
            <?
                $yourCurrentDiscountSavePerc = "0%";
                $yourCurrentDiscountSaveText = "До 10% накопительной скидки осталось 3000 руб.";
                $discSave = CCatalogDiscountSave::GetDiscount(array('USER_ID' => $USER->GetID()));
                if($discSave){
                    if($discSave[0]['VALUE']==20){
                        $yourCurrentDiscountSavePerc = "20%";
                        $yourCurrentDiscountSaveText = "У вас уже максимальный размер накопительной скидки.";
                    } else if($discSave[0]['VALUE']==10){
                        $discSaveDiff = getDiffToNextDiscountSave($USER->GetID(),20);
                        $yourCurrentDiscountSavePerc = "10%";
                        $yourCurrentDiscountSaveText = "До 20% накопительной скидки осталось ".$discSaveDiff." руб.";
                    }
                } else {
                    $discSaveDiff = getDiffToNextDiscountSave($USER->GetID(),10);
                    $yourCurrentDiscountSavePerc = "0%";
                    $yourCurrentDiscountSaveText = "До 10% накопительной скидки осталось ".$discSaveDiff." руб.";
                }

                $_SESSION['EMAIL_CURRENT_DISCOUNT_SAVE_PERCENT'] = $yourCurrentDiscountSavePerc;
                $_SESSION['EMAIL_NEXT_DISCOUNT_SAVE_SUM'] = $yourCurrentDiscountSaveText;

            ?>

            <? //if (doubleval($arResult["DELIVERY_PRICE"]) > 0){?>
            <p>Доставка</p>      
            <?//}?>                       

            <p><span>Итого</span></p>

        </div>       


        <div style="clear:both;"></div> 

        <div class="grayLine"></div>   

        <p class="ordContain">    <!--chekingFields('Y')-->
            <a href="javascript:void();" onclick="submitForm('Y'); return false;" id="ORDER_CONFIRM_BUTTON" class="checkout orderConfirm">
                <?=GetMessage("SOA_TEMPL_BUTTON")?>
            </a>
        </p> 

    </div>

</div> 
<div class="warningnote"></div> 



