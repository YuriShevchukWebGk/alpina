<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */

//one css for all system.auth.* forms
$APPLICATION->SetAdditionalCSS("/bitrix/css/main/system.auth/flat/style.css");
?>
<div class="historyCoverWrap">
    <div class="centerWrapper">
        <p><?= GetMessage("MAIN_PAGE") ?></p>    
        <h1><?= GetMessage("PASSWORD_CHANGE") ?></h1>
    </div>
</div>
<div class="changePassWrapper">
    <div class="bx-authform">

        <?
        if(!empty($arParams["~AUTH_RESULT"])) {
            $text = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);
        ?>
            <div class="alert <?= ($arParams["~AUTH_RESULT"]["TYPE"] == "OK" ? "alert-success" : "alert-danger") ?>"><?= nl2br(htmlspecialcharsbx($text)) ?></div>
        <?}?>

        <form method="post" action="<?= $arResult["AUTH_FORM"] ?>" name="bform">
            <?if (strlen($arResult["BACKURL"]) > 0) { ?>
                <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>" />
            <?}?>
            <input type="hidden" name="AUTH_FORM" value="Y">
            <input type="hidden" name="TYPE" value="CHANGE_PWD">

            <div class="bx-authform-formgroup-container">
                
                <div class="bx-authform-input-container">
                    <input type="text" name="USER_LOGIN" maxlength="255" value="<?= $arResult["LAST_LOGIN"] ?>" placeholder="<?= GetMessage("AUTH_LOGIN") ?>"/>
                </div>
            </div>

            <div class="bx-authform-formgroup-container">
                
                <div class="bx-authform-input-container">
                    <input type="text" name="USER_CHECKWORD" maxlength="255" value="<?= $arResult["USER_CHECKWORD"] ?>" placeholder="<?= GetMessage("AUTH_CHECKWORD") ?>"/>
                </div>
            </div>

            <div class="bx-authform-formgroup-container">
                
                <div class="bx-authform-input-container">
                    <?if($arResult["SECURE_AUTH"]) {?>
                        <div class="bx-authform-psw-protected" id="bx_auth_secure" style="display:none">
                            <div class="bx-authform-psw-protected-desc">
                                <span></span><?= GetMessage("AUTH_SECURE_NOTE") ?>
                            </div>
                        </div>

                        <script type="text/javascript">
                        document.getElementById('bx_auth_secure').style.display = '';
                        </script>
                    <?}?>
                    <input type="password" name="USER_PASSWORD" maxlength="255" value="<?= $arResult["USER_PASSWORD"] ?>" autocomplete="off" placeholder="<?= GetMessage("AUTH_NEW_PASSWORD_REQ") ?>"/>
                </div>
            </div>

            <div class="bx-authform-formgroup-container">
                
                <div class="bx-authform-input-container">
                    <?if($arResult["SECURE_AUTH"]) {?>
                        <div class="bx-authform-psw-protected" id="bx_auth_secure_conf" style="display:none">
                            <div class="bx-authform-psw-protected-desc">
                                <span></span><?= GetMessage("AUTH_SECURE_NOTE") ?>
                            </div>
                        </div>

                        <script type="text/javascript">
                        document.getElementById('bx_auth_secure_conf').style.display = '';
                        </script>
                    <?}?>
                    <input type="password" name="USER_CONFIRM_PASSWORD" maxlength="255" value="<?= $arResult["USER_CONFIRM_PASSWORD"] ?>" autocomplete="off" placeholder="<?= GetMessage("AUTH_NEW_PASSWORD_CONFIRM") ?>"/>
                </div>
            </div>

            <div class="bx-authform-formgroup-container" style="text-align: center;">
                <input type="submit" class="btn btn-primary" name="change_pwd" value="<?= GetMessage("AUTH_CHANGE") ?>" />
            </div>

            <div class="bx-authform-description-container">
                <?= $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"]; ?>
            </div>

            <div class="bx-authform-link-container">
                <a href="<?= $arResult["AUTH_AUTH_URL"] ?>"><b><?= GetMessage("AUTH_AUTH") ?></b></a>
            </div>

        </form>

    </div>
</div>

<script type="text/javascript">
document.bform.USER_LOGIN.focus();

<?if ($arParams["~AUTH_RESULT"]["TYPE"] == "OK") {?>
    $(".bx-authform").html("<h2>Пароль успешно изменен</h2>");    
<?}?>
</script>
