<?
    /**
    * @global CMain $APPLICATION
    * @param array $arParams
    * @param array $arResult
    */
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
        die(); 
?>



<div class="bx-auth-profile">


    <script type="text/javascript">
        <!--
        var opened_sections = [<?
            $arResult["opened"] = $_COOKIE[$arResult["COOKIE_PREFIX"]."_user_profile_open"];
            $arResult["opened"] = preg_replace("/[^a-z0-9_,]/i", "", $arResult["opened"]);
            if (strlen($arResult["opened"]) > 0)
            {
                echo "'".implode("', '", explode(",", $arResult["opened"]))."'";
            }
            else
            {
                $arResult["opened"] = "reg";
                echo "'reg'";
            }
        ?>];
        //-->

        var cookie_prefix = '<?=$arResult["COOKIE_PREFIX"]?>';
    </script>


    <form class="account-form js-acc-edit" style="display: none;" method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
        <div class="account-form__close js-close-acc-edit"></div>
        <div class="account-form__set">
            <div class="account-form__set-head">Персональная информация</div>  

            <?ShowError($arResult["strProfileError"]);
            if ($arResult["strProfileError"]) {
                echo "<br>";
            }
            ?>
            <?
                if ($arResult['DATA_SAVED'] == 'Y') {
                    ShowNote(GetMessage('PROFILE_DATA_SAVED'));
                    echo "<br>";
                }
            ?>

            <div class="account-form__param" style="display: none; /*временно*/">                    
                <div class="common-inline-param">    
                    <input name="persontype" type="radio" class="common-radio-wrap js-create-radio">
                    <div class="common-radio-label js-label-satellite">Физическое лицо</div>
                </div>
                <div class="common-inline-param">
                    <input name="persontype" type="radio" class="common-radio-wrap js-create-radio">
                    <div class="common-radio-label js-label-satellite">Юридическое лицо</div>        
                </div>                       
            </div> 

            <div class="account-form__left">
                <input type="text" class="common-input account-form__inp" placeholder="Фамилия" name="LAST_NAME" maxlength="50" value="<?=$arResult["arUser"]["LAST_NAME"]?>">
                <input type="text" class="common-input account-form__inp" placeholder="Имя" name="NAME" maxlength="50" value="<?=$arResult["arUser"]["NAME"]?>">
                <?/*  <input type="text" class="common-input account-form__inp" placeholder="Отчество">  */?>
            </div>
            <!-- /left -->
            <div class="account-form__right">
                <input type="text" class="common-input account-form__inp" placeholder="E-mail" name="EMAIL" maxlength="50" value="<? echo $arResult["arUser"]["EMAIL"]?>">
                <input type="hidden" name="LOGIN" value="<?=$arResult["arUser"]["LOGIN"]?>">
                <input type="text" class="common-input account-form__inp" placeholder="+7(___)___-__-__" name="PERSONAL_PHONE" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>">
                <?/*  <input type="text" class="common-input account-form__inp" placeholder="Адрес доставки"> */?>
            </div>
            <!-- /right -->
        </div>
        <div class="account-form__set2">
            <div class="account-form__set-head">Смена пароля</div>
            <div class="account-form__left">
                <input type="password" class="common-input account-form__inp" placeholder="Новый пароль" name="NEW_PASSWORD" maxlength="50" value="" autocomplete="off" class="bx-auth-input">
            </div>
            <!-- /left -->
            <div class="account-form__right">
                <input type="password" class="common-input account-form__inp" placeholder="Подтверждение нового пароля" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off">
            </div>
            <!-- /right -->
        </div>
        <input type="submit" class="common-btn common-submit account-form__btn" value="Сохранить изменения" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("SAVE") : GetMessage("MAIN_ADD"))?>">          

        <?=$arResult["BX_SESSION_CHECK"]?>
        <input type="hidden" name="lang" value="<?=LANG?>" />
        <input type="hidden" name="ID" value=<?=$arResult["ID"]?> />      
        <?// ******************** /User properties ***************************************************?>
        <br />
        <p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>
        <div class="account-form__set2 bank_cards_set">
            <div class="account-form__set-head"><?= GetMessage('BANK_CARDS') ?></div>
            <div class="recurrent_card_exists" <? if (!$arResult["UF_RECURRENT_CARD_ID"]) { ?>style="display:none"<? } ?>>
	            <p><?= GetMessage('EXISTING_CARD_MESSAGE') ?></p>
				<ul class="saved_card_line">
					<li><?= $arResult["UF_RECURRENT_CARD_ID"] ?></li>
					<li data-delete-card="Y"><?= GetMessage('DELETE') ?></li>
				</ul>
            </div>
            <div class="empty_recurrent_card" <? if ($arResult["UF_RECURRENT_CARD_ID"]) { ?>style="display:none"<? } ?>>
	            <p><?= GetMessage('EMPTY_CARD_MESSAGE') ?></p>
            </div>
        </div>
    </form>
</div>