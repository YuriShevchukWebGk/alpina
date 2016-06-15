<?## A/B-тестирование на сайте ##
global $USER;
$alpExps = unserialize($APPLICATION->get_cookie("alpExps"));
$alpExps  = (!$alpExps ? array() : $alpExps);

if ($alpExps['updateExp'] != "160516") {
    $alpExps = array();
    $alpExps['updateExp'] = "160516";
}

$alpExps['smartBannerApple']    = (!$alpExps['smartBannerApple'] ? rand(1,2) : $alpExps['smartBannerApple']);
if ($APPLICATION->GetCurDir() == '/personal/cart/') {
    $alpExps['recsInCart']        = (!$alpExps['recsInCart'] ? rand(1,2) : $alpExps['recsInCart']);
}
?>


<!-- Тест Рекомендаций в корзине -->
<?if ($APPLICATION->GetCurDir() == '/personal/cart/') {
    if ($alpExps['recsInCart'] == 1) {?>
        <script type="text/javascript">
            $(document).ready(function() {
                dataLayer.push({
                    event: 'ab-test-gtm',
                    action: 'recsInCart',
                    label: 'withRecs'
                });
                console.log('recsInCart withRecs');
            });
        </script>
    <?} elseif ($alpExps['recsInCart'] == 2) {?>
        <style>
            .recomendation {display:none;}
        </style>    
        <script type="text/javascript">
            $(document).ready(function() {
                dataLayer.push({
                    event: 'ab-test-gtm',
                    action: 'recsInCart',
                    label: 'withoutRecs'
                });
                console.log('recsInCart withoutRecs');
            });
        </script>
    <?}
}?>
<!-- //Тест Рекомендаций в корзине -->

<!-- Тест СмартБаннера -->
<?if ($alpExps['smartBannerApple'] == 1) {?>
    <meta name="apple-itunes-app" content="app-id=429622051">
    <script type="text/javascript">
        $(document).ready(function() {
            dataLayer.push({
                event: 'ab-test-gtm',
                action: 'smartBannerApple',
                label: 'showBanner'
            });
            console.log('smartBannerApple showBanner');
        });
    </script>
<?} elseif ($alpExps['smartBannerApple'] == 2) {?>
    <script type="text/javascript">
        $(document).ready(function() {
            dataLayer.push({
                event: 'ab-test-gtm',
                action: 'smartBannerApple',
                label: 'noBanner'
            });
            console.log('smartBannerApple noBanner');
        });
    </script>    
<?}?>
<!-- //Тест СмартБаннера -->

<?$APPLICATION->set_cookie("alpExps", serialize($alpExps));
## A/B-тестирование на сайте ##?>