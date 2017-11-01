<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$frame = $this->createFrame()->begin();?>
<?if($arResult["GEO_CITY"]):

    //Путь до файлов обработчиков
    $arJSParams = array(
        "AJAX_URL" => array(
            "SELECT" => $templateFolder . "/ajax_select_city.php",
            "GET" => $templateFolder . "/ajax_geobase_get.php",
            "SAVE" => $templateFolder . "/ajax_geobase_save.php",
        ),
        "CLASS" => array(
            "WRAP_QUESTION_REASAPEKT" => "wrapQuestionReaspekt"
        )
    );
// Выведем актуальную корзину для текущего пользователя

$arBasketPrice = 0;

// Печатаем массив, содержащий актуальную на текущий момент корзину
$dbBasketItems = CSaleBasket::GetList(
        array(
                "NAME" => "ASC",
                "ID" => "ASC"
            ),
        array(
                "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                "LID" => SITE_ID,
                "ORDER_ID" => "NULL",
                "DELAY" => "N"
            ),
        false,
        false,
        array("ID", "PRICE","QUANTITY")
    );
while ($arItems = $dbBasketItems->Fetch()){
    $all_summ = $arItems["PRICE"] * $arItems["QUANTITY"];
    $arBasketPrice += $all_summ;
}


    if ($arResult["SET_LOCAL_DB"] == "local_db") :?>

            <?if($_SESSION["REASPEKT_GEOBASE"]["CITY"] != "Москва"){ ?>
                <li><?= GetMessage("MAIL_DELIVERY") ?><br />
                    <?if($arBasketPrice > FREE_SHIPING){ ?>
                        <a href='#' onclick="getInfo('box');dataLayer.push({event: 'otherEvents', action: 'infoPopup', label: 'box'});return false;"><?=GetMessage("DELIVRY_SALE")?></a>

                    <? } else {?>
                        <a href='#' onclick="getInfo('box');dataLayer.push({event: 'otherEvents', action: 'infoPopup', label: 'box'});return false;"><?=GetMessage("COUNTRY_DELIVERY")?></a>
                    <?}?>

                </li>
                <li class="flippost"><?= GetMessage("MAIL_DELIVERY_PP") ?><br />
                    <?if($arBasketPrice > FREE_SHIPING){ ?>
                        <b><?=GetMessage("DELIVRY_SALE")?></b>
                    <? } else {?>
                        <b><?=$_SESSION["price_delivery_flippost"].' руб.'?></b>
                    <?}?>

                </li>
            <?}?>
            <li class="boxbery"><?= GetMessage("DELIVERY_POST_SITY") ?>
                <a href='#' class="city_pull" data-city="<?=$arResult["GEO_CITY"]["CITY"]?>" onclick="getInfo('boxberry');dataLayer.push({event: 'otherEvents', action: 'infoPopup', label: 'boxberry'});return false;">
                    <?=$arResult["GEO_CITY"]["CITY"]?>
                </a>
                <?if($arBasketPrice > FREE_SHIPING){ ?>
                    <b><?=GetMessage("DELIVRY_SALE")?></b>
                <? } else {?>
                    <?= GetMessage("CATALOG_QUANTITY_FROM", Array ("#FROM#" => "")) ?> <b><?=$_SESSION['price_delivery'].' руб.'?></b>
                <?}?>
            </li>

            <li ><a href='#' data-reaspektmodalbox-href="<?=$templateFolder?>/ajax_popup_city.php" class="cityLinkPopupReaspekt linkReaspekt"><?=GetMessage('REASPEKT_GEOIP_TITLE_YOU_CITY')?></a></li>
            <?if($arResult["GEO_CITY"]["CITY"] == ""){ ?>
                <li><?= GetMessage("INTERNATIONAL_DELIVERY") ?></li>
            <?}?>
            <?if (
                $arParams["CHANGE_CITY_MANUAL"] == "Y"
                && $arResult["CHANGE_CITY"] == "N"
            ) :?>
            <div class="<?=$arJSParams["CLASS"]["WRAP_QUESTION_REASAPEKT"]?>">
                <div class="questionYourCityReaspekt"><?=GetMessage("REASPEKT_GEOIP_TITLE_YOU_CITY");?>:</div>
                <div class="questionCityReaspekt"><strong><?=$arResult["GEO_CITY"]["CITY"]?></strong> (<?=$arResult["GEO_CITY"]["REGION"]?>)</div>
                <div class="questionButtonReaspekt reaspekt_clearfix">
                    <div class="questionNoReaspekt cityLinkPopupReaspekt" data-reaspektmodalbox-href="<?=$templateFolder?>/ajax_popup_city.php"><?=GetMessage("REASPEKT_GEOIP_BUTTON_N");?></div>
                    <div class="questionYesReaspekt" onClick="objJCReaspektGeobase.onClickReaspektSaveCity('N');"><?=GetMessage("REASPEKT_GEOIP_BUTTON_Y");?></div>
                </div>
            </div>
            <?endif;?>

        <script type="text/javascript">
        $('.cityLinkPopupReaspekt').ReaspektModalBox();
        var objJCReaspektGeobase = new JCReaspektGeobase(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
        </script>
    <?else:?>
        <div class="wrapGeoIpReaspekt">
            <strong><?=$arResult["GEO_CITY"]["CITY"]?></strong>
        </div>
    <?endif;
endif;?>
<?$frame->beginStub();?>
<?$frame->end();?>
