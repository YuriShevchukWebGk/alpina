<?
    /*define("NEED_AUTH", true);*/
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

    /*$userName = CUser::GetFullName();
    if (!$userName)
    $userName = CUser::GetLogin();
    ?>
    <script>
    <?if ($userName):?>
    BX.localStorage.set("eshop_user_name", "<?=CUtil::JSEscape($userName)?>", 604800);
    <?else:?>
    BX.localStorage.remove("eshop_user_name");
    <?endif?>

    <?if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0 && preg_match('#^/\w#', $_REQUEST["backurl"])):?>
    document.location.href = "<?=CUtil::JSEscape($_REQUEST["backurl"])?>";
    <?endif?>
    </script>

    <?
    $APPLICATION->SetTitle("Авторизация");
    ?>
    <p>Вы зарегистрированы и успешно авторизовались.</p>

    <p><a href="<?=SITE_DIR?>">Вернуться на главную страницу</a></p>
<?*/?>

<?if ($_REQUEST["forgot_password"]) {?>
    <div class="historyCoverWrap">
        <div class="centerWrapper">
            <p>Главная</p>    
            <h1>Восстановление пароля</h1>
        </div>
    </div>
    <div class="lostPassWrapper">
        <?
            $APPLICATION->IncludeComponent("bitrix:main.profile", "eshop", Array(
                "SET_TITLE" => "Y",    // Устанавливать заголовок страницы
                ),
                false
            );
        ?>
    </div>
<?} else if ($_REQUEST["change_password"]) {?>
    <div class="historyCoverWrap">
        <div class="centerWrapper">
            <p>Главная</p>    
            <h1>Смена пароля</h1>
        </div>
    </div>
    <div class="changePassWrapper">
        <?
            $APPLICATION->IncludeComponent("bitrix:system.auth.changepasswd", "flat", Array(
                "SET_TITLE" => "Y",    // Устанавливать заголовок страницы
                ),
                false
            );
        ?>
    </div>
<?} else {?>    
    <div class="historyCoverWrap">
        <div class="centerWrapper">
            <p>Главная</p>    
            <h1>Регистрация</h1>
        </div>
    </div>

    <div class="signinWrapper">
        <div class="centredWrapper">
            <?if (!$USER->IsAuthorized())
                {?>
                <div>
                    <div class="registrationLink <? if (!$_REQUEST["login"]) {?>active<?}?>">Регистрация</div>
                    <div class="signinLink <? if ($_REQUEST["login"]) {?>active<?}?>">Вход на сайт</div>
                </div>



                <div class="signinBlock">

                    <?$APPLICATION->IncludeComponent("bitrix:system.auth.authorize", "flat", Array(
                            "REGISTER_URL" => "",
                            "PROFILE_URL" => "",
                            "SHOW_ERRORS" => "Y"
                            ),
                            false
                        );?>
                </div>

                <div class="registrationBlock">

                    <?$APPLICATION->IncludeComponent("bitrix:system.auth.registration", "flat", Array(

                            ),
                            false
                        );?> 
                </div>
                <?}
                else
                {?>
                <div class="reg_text">

                    <p>Спасибо за регистрацию! Теперь Вам будут доступны накопительные скидки и бонусы</p>

                    <br>

                    <p><a href="<?=SITE_DIR?>">Вернуться на главную страницу</a></p>

                </div>
                <?}?>
        </div>
    </div>
    <?}?>
<script>
    $(document).ready(function(){
        $("body").addClass("changePassWr");
    })
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>