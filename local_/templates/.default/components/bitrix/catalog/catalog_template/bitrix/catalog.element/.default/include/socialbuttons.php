<script type="text/javascript" src="//yandex.st/share/share.js"    charset="utf-8"></script>
<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,gplus,Instagram" data-yashareTheme="counter"></div>
    <?
    $fb_meta = '<meta property="og:title" content="'.$arResult['NAME'].'" />';
    $fb_meta .= '<meta property="og:type" content="book" />';
    $fb_meta .= '<meta property="og:url" content="'.'http://'.SITE_SERVER_NAME.$APPLICATION->GetCurPage().'" />';
    $fb_meta .= '<meta property="og:image" content="http://'.SITE_SERVER_NAME.$arResult["DETAIL_PICTURE"]["SRC"].'" />';
    $fb_meta .= '<meta property="og:site_name" content="'.SITE_SERVER_NAME.'" />';
    $fb_meta .= '<meta property="fb:admins" content="1425804193" />';
    $fb_meta .= '<meta property="fb:app_id" content="138738742872757" />';
    $APPLICATION->SetPageProperty('FACEBOOK_META', $fb_meta);
    ?>
<??>