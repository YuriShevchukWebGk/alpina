<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Персональный раздел"); 
?>   
<? if ($USER->IsAuthorized()) { ?>
    <section class="l-section-wrap top-section color_1 full">
        <div class="container">
            <? $APPLICATION->IncludeComponent("bitrix:main.profile", "user_profile_sailplay", array(
                    "SET_TITLE" => "Y",
                    "AJAX_MODE" => "Y"
                    ),
                    false,
                    array(
                        "ACTIVE_COMPONENT" => "Y"
                    )
                ); ?>
        </div> 
    </section>              
    <? if ($user_mail = $USER->GetEmail()) { ?>
        <?
            if ($token = SailplayHelper::getAuth()) { // если удалось соединиться с Sailplay и получить токен
                if ($hash = SailplayHelper::getUserAuthHash($token, $user_mail)) { // если удалось получить auth_hash для пользователя, то отображаем ЛК ?>
                <app></app>
                <? }
            }
        ?>
        <? // Прелоадер для sailplay ?>
        <style>
            /* Не самое лучшее решение оставлять стили здесь, но альтернатива это создание отдельного шаблона для /personal/profile/ */ 
            .historyBodywrap > div > .full, .historyBodywrap > div > .l-section-wrap {
                display: none;
            }

            .historyBodywrap > div:first-child {
                min-height: 300px;
            }
        </style>
        <script>
            window.onload = function () { 
                $(".cssload-container").fadeOut(200);
                $(".historyBodywrap > div > .full").fadeIn(200);
                $(".historyBodywrap > div > .l-section-wrap").fadeIn(200);
                $(".rsOverflow.grab-cursor").css("width", "100%");
            }
        </script>
        <div class="cssload-container">
            <div class="cssload-whirlpool"></div>
        </div>
        <? } ?>
    <? } else { ?>      
    <div class="signinWrapper">
        <div class="centredWrapper">
            <div class="signinBlock" style="display:block;">
                <? $APPLICATION->IncludeComponent("bitrix:system.auth.authorize", "flat", Array(
                        "REGISTER_URL" => "/auth/",
                        "PROFILE_URL"  => "/personal/profile/",
                        "SHOW_ERRORS"  => "Y"
                        ),
                        false
                    ); ?>
            </div>
        </div>
    </div>
    <?
    }
?>
<script>
    function openForm() {
        $('.js-acc-edit').slideUp(300);
    }
    $(document).ready(function () {
        // selects
        $('.js-create-select').selectize({});

        // radio and labels
        $('.js-create-radio').prettyCheckable({
            customClass: 'common-radio-wrap'
        });
        $('.js-label-satellite').on('click', function () {
            $(this).siblings('.prettyradio').find('label').click();
        });

        // account form open-close
        var accForm = $('.js-acc-edit');
        $('.js-open-acc-edit').click(function () {
            accForm.slideToggle(300);
        });
        $('.js-close-acc-edit').click(function () {
            accForm.slideUp(300);
        });

        openForm();
    });
</script>         

<script>
    $(document).ready(function () {
        var AUTH_HASH = '<?= $hash ?>';
        var EMAIL = '<?= $user_mail ?>';
        startLoyaltyApp(AUTH_HASH);
    });
</script>  
       
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>