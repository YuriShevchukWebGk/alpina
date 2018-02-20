<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/**
 * @var $arResult array
 * @var $arParams array
 * @var $APPLICATION CMain
 * @var $USER CUser
 * @var $component CBitrixComponent
 * @var $this CBitrixComponentTemplate
 * @var $city
 */

$this->setFrameMode(true);
$frame = $this->createFrame()->begin("");

$usrChoiceTitle = "";
$usrSelCity = "";
$arUsrCh = $arResult["USER_CHOICE"];
$arAutoDt = $arResult["AUTODETECT"];
$arAuto = $arResult["auto"];
$sMode = $arResult['MODE_LOCATION'];
$arCity = array();

if(!empty($arUsrCh) && is_array($arUsrCh))
{
    if(is_array($arUsrCh["CITY"]) && !empty($arUsrCh["CITY"]["SOCR"]))
    {
        $usrChoiceTitle = $arUsrCh["CITY"]["SOCR"].'. '.$arUsrCh["CITY"]["NAME"].', '.$arUsrCh["REGION"]["FULL_NAME"]
        .(!empty($arUsrCh['DISTRICT']['SOCR']) ? ', '.$arUsrCh['DISTRICT']['NAME'].' '.$arUsrCh['DISTRICT']['SOCR'].'.' : '');
        $usrSelCity = (!empty($arUsrCh["CITY"]["NAME"]) ? $arUsrCh["CITY"]["NAME"] : '');
    }
    if(is_array($arUsrCh["CITY"]) && empty($arUsrCh["CITY"]["NAME"])
        && is_array($arUsrCh["REGION"]) && !empty($arUsrCh["REGION"]["NAME"]))
    {
        $usrChoiceTitle = $arUsrCh["REGION"]["FULL_NAME"];
        $usrSelCity = $arUsrCh["REGION"]["NAME"];
        if(!empty($arUsrCh["REGION"]["SOCR"]) && $arUsrCh["REGION"]["SOCR"] != GetMessage('ALTASIB_GEOBASE_SOCR_G'))
            $usrSelCity .= " ".$arUsrCh["REGION"]["SOCR"];
    }
    elseif(!empty($arUsrCh["COUNTRY_RU"]) || !empty($arUsrCh["CITY_RU"]))
    {
        $usrChoiceTitle = (($arResult['RU_ENABLE'] == "Y") ? $usrSelCity = $arUsrCh["CITY_RU"] :
                (!empty($arUsrCh["CITY"]) ? $usrSelCity = $arUsrCh["CITY"] : ''))
            .(!empty($arUsrCh['REGION']) ? ', '.$arUsrCh['REGION'] : '')
            .((!empty($arUsrCh["COUNTRY_RU"]) && $arResult['RU_ENABLE'] == "Y") ?
            ' ('.$arUsrCh["COUNTRY_RU"].')' : (!empty($arUsrCh["COUNTRY"]) ? ' ('.$arUsrCh["COUNTRY"].')' : ''));
    }
    elseif(!empty($arUsrCh["CITY_NAME"]))
    {
        $usrChoiceTitle = ($usrSelCity = $arUsrCh["CITY_NAME"])
            .(!empty($arUsrCh['REGION_NAME']) ? ', '.$arUsrCh['REGION_NAME'] : '')
            .(!empty($arUsrCh['COUNTRY_NAME']) ? ' ('.$arUsrCh['COUNTRY_NAME'].')' : '');
    }
}

$notAutoShowPopup = false;

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
            if($_SESSION["ALTASIB_GEOBASE_CODE"]["CITY"]["NAME"]){
                $usrSelCity = $_SESSION["ALTASIB_GEOBASE_CODE"]["CITY"]["NAME"];
            } else {
                $usrSelCity = $_SESSION["ALTASIB_GEOBASE"]["CITY_NAME"];
            }
            //arshow($_SESSION,false)?>
            <?if($usrSelCity != "Москва"){ ?>
                <li><a href='#' onclick="getInfo('box');dataLayer.push({event: 'otherEvents', action: 'infoPopup', label: 'box'});return false;"><?= GetMessage("MAIL_DELIVERY") ?></a><br />
                    <?if($arBasketPrice > FREE_SHIPING){ ?>
                        <b><?=GetMessage("DELIVRY_SALE")?></b>
                    <? } else {?>
                        <b><?=GetMessage("COUNTRY_DELIVERY")?> </b>
                    <?}?>

                </li>
                <?if(strpos($usrSelCity, 'Украина') <= 0){?>
                    <li class="flippost"><?= GetMessage("MAIL_DELIVERY_PP") ?><br />
                        <?if($arBasketPrice > FREE_SHIPING){ ?>
                            <b><?=GetMessage("DELIVRY_SALE")?></b>
                        <? } else {?>
                            <b><?=$_SESSION["price_delivery_flippost"].' руб.'?></b>
                        <?}?>

                    </li>
                <?}?>
            <?}?>
            <?if(strpos($usrSelCity, 'Украина') <= 0){?>
                <li class="boxbery"> Доставка в
                    <a href='#' class="city_pull" data-city="<?=$usrSelCity?>" onclick="getInfo('boxberry');dataLayer.push({event: 'otherEvents', action: 'infoPopup', label: 'boxberry'});return false;">
                        <?= GetMessage("DELIVERY_POST_SITY") ?>

                    </a> в <?
                        if(!empty($usrSelCity))
                            echo $usrSelCity;
                        elseif($arParams["RIGHT_ENABLE"] == "Y" && ((is_array($arAutoDt) && !empty($arAutoDt["CITY"]["NAME"])) || (is_array($arAuto) && !empty($arAuto["CITY_NAME"]))))
                        {
                            if(is_array($arAutoDt) && isset($arAutoDt["CITY"]["NAME"]))
                                echo $arAutoDt["CITY"]["NAME"];
                            elseif(is_array($arAuto) && isset($arAuto["CITY_NAME"]))
                                echo $arAuto["CITY_NAME"];
                        }
                        elseif(isset($arParams["SPAN_RIGHT"]))
                        {
                            echo $arParams["SPAN_RIGHT"];
                            $notAutoShowPopup = true;
                        }
                        else
                        {
                            echo GetMessage("ALTASIB_GEOBASE_SELECT_".$sMode);
                            $notAutoShowPopup = true;
                        }
                       ?>
                    <?if($arBasketPrice > FREE_SHIPING){ ?>
                        <b><?=GetMessage("DELIVRY_SALE")?></b>
                    <? } else {?>
                        <?= GetMessage("CATALOG_QUANTITY_FROM", Array ("#FROM#" => "")) ?> <b><?=$_SESSION['price_delivery'].' руб.'?></b>
                    <?}?>
                </li>
            <?}?>


<?if($_REQUEST["get_select"] != 'Y'):?>
<script language="JavaScript">
if(typeof altasib_geobase=="undefined")
    var altasib_geobase={};
altasib_geobase.codes=jQuery.parseJSON('<?=json_encode($arResult['SEL_CODES']);?>');
altasib_geobase.socrs=['<?=implode("','",$arResult['SOCRS']);?>'];
altasib_geobase.is_mobile=false;
altasib_geobase.COOKIE_PREFIX='<?=COption::GetOptionString("main", "cookie_name", "BITRIX_SM");?>';
altasib_geobase.bitrix_sessid='<?=bitrix_sessid();?>';
altasib_geobase.SITE_ID='<?=SITE_ID?>';
</script>
<?endif?>
<?if($arParams["LOADING_AJAX"] != 'Y' || $_REQUEST["get_select"] == 'Y'):?>
<script language="JavaScript">
if(typeof altasib_geobase=="undefined")var altasib_geobase={};
altasib_geobase.bitrix_sessid='<?=bitrix_sessid();?>';
</script>


<?if($arResult["POPUP_BACK"] != 'N'){
    ?><div id="altasib_geobase_popup_back"></div>
<?}?>

<?
    if($arResult["SHOW_SMALL"] == "Y"):?>

<?    endif;?>
<?endif?>
<?$frame->end(); ?>