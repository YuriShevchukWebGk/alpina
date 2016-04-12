<script type="text/javascript" src="//yandex.st/share/share.js"    charset="utf-8"></script>
<div class="yashare-auto-init" data-yashareLink="http://<?=$_SERVER["SERVER_NAME"]?>/personal/cart/?list=<?=$USER -> GetID()?>" data-yashareL10n="ru" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,gplus,Instagram,whatsapp" data-yashareTheme="counter" data-yashareTitle="Мой список желаний"></div>
    <?
    $uID = $USER -> GetID();
    $fb_meta = '<meta property="og:title" content="Мой список желаний" />';
    $fb_meta .= '<meta property="og:type" content="book" />';
    $fb_meta .= '<meta property="og:url" content="'.'http://'.SITE_SERVER_NAME.'/personal/cart/?list='.$uID.'" />';
    $fb_meta .= '<meta property="og:site_name" content="'.SITE_SERVER_NAME.'" />';
    $fb_meta .= '<meta property="fb:admins" content="1425804193" />';
    $fb_meta .= '<meta property="fb:app_id" content="138738742872757" />';
    $APPLICATION->SetPageProperty('FACEBOOK_META', $fb_meta);
    arshow($fb_meta);?>
<??>