<?## A/B-тестирование на сайте ##
global $USER;
global $APPLICATION;
/*
$alpExps = unserialize($APPLICATION->get_cookie("alpExps"));
$alpExps  = (!$alpExps ? array() : $alpExps);

if ($alpExps['updateExp'] != "130217") {
    $alpExps = array();
    $alpExps['updateExp'] = "130217";
}

if (preg_match("/(.*)\/catalog\/([a-z]+)\/([0-9]+)\/(.*)/i", $_SERVER['REQUEST_URI'])) {
    $alpExps['bgAdjustment']    = (!$alpExps['bgAdjustment'] ? rand(1,2) : $alpExps['bgAdjustment']);

}*/
?>
<script type="text/javascript">(window.Image ? (new Image()) : document.createElement('img')).src = 'https://vk.com/rtrg?p=VK-RTRG-172981-6JKYS';</script>
<link rel="search" href="/opensearch.xml" title="Alpina.ru" type="application/opensearchdescription+xml" />

<link href="/bitrix/css/main/font-awesome.css?146037394928798" type="text/css" rel="stylesheet" />
<script>function getsubbook(){$.post("/ajax/request_add.php",{email:$("#subpop input[type=email]").val()},function(data){$(".errorinfo").html(data);})}$(document).ready(function(){$(".stopProp").click(function(e){e.stopPropagation();});});function closeX(){$('.hideInfo').hide();}</script>

<?if (strpos($APPLICATION->GetCurPage(),"/catalog/") !== false) {
    if (!preg_match("/([0-9]+)/i",$APPLICATION->GetCurPage())) {?>
        <style>
            .catalogIcon span, .basketIcon span {
                color: #99ABB1;
            }
        </style>
    <?}?>
<?}?>
<style>
.productElementWrapp .dopSaleWrap{display:none}
</style>
<script type="text/javascript">
    function readCookie(name) {
        var nameEQ = encodeURIComponent(name) + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return decodeURIComponent(c.substring(nameEQ.length, c.length));
        }
        return null;
    }

    function subscribePopup() {
        $.post("/ajax/subscribe_pop.php", {id: 1}, function(data){
            $(data).appendTo("body").fadeIn();
        });
    }

    $(document).ready(function() {
        $(".catalogIcon").html("<span>Каталог</span>");
        $(".basketIcon").html("<span>Корзина</span>");

        <?if (empty($_COOKIE["subscribePopup"]) && empty($APPLICATION->get_cookie("subscribePopup"))) {
            if (strpos($APPLICATION->GetCurPage(),"/personal/") === false) {?>
                if (readCookie("subscribePopup") == null) {
                    setTimeout(subscribePopup, 2000);
                }
            <?}?>
        <?}?>
    });
    document.addEventListener('visibilitychange', function(e) {
        console.log('hidden:' + document.hidden,
        'state:' + document.visibilityState)
    }, false);
</script>
<meta name="apple-itunes-app" content="app-id=429622051">


<?#Настраиваю свои брошенные корзины?>
<?if (!empty($_COOKIE["userId"]) || $USER->GetID()) {?>
    <script>
        function setAbandonedInfo(userId,basketid) {
            $.ajax({
                type: "POST",
                url: "/ajax/abandoned_carts.php",
                data: {
                    userid: userId,
                    basketid: basketid
                }
            }).done(function(strResult) {
                if (strResult == 'ok') {
                    console.log("userid:"+userId);
                    console.log("basketid:"+basketid);
                }
            });
        }
        $(document).ready(function() {
            setAbandonedInfo(<?=$_COOKIE["userId"]?>,<?=CSaleBasket::GetBasketUserID()?>);
            setInterval(function() {
                setAbandonedInfo(<?=$_COOKIE["userId"]?>,<?=CSaleBasket::GetBasketUserID()?>);
            }, 1000 * 60 * 10);
        });
    </script>
<?}?>


<?//$APPLICATION->set_cookie("alpExps", serialize($alpExps));
## A/B-тестирование на сайте ##?>
<?if (strpos($APPLICATION->GetCurPage(),"/catalog/") !== false || $APPLICATION->GetCurDir() == "/") {?>
    <!--amp.eski.mobi--><link href="https://amp.alpinabook.ru/mobile/alpinabook-ru/amp/?p=<?php echo "https://www.alpinabook.ru".$APPLICATION->GetCurPage();?>" rel="amphtml" /><!--/amp.eski.mobi-->
<?}?>