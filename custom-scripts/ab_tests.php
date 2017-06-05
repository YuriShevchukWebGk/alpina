<?## A/B-тестирование на сайте ##
global $USER;
$USER->LoginHitByHash();
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
<script src="/custom-scripts/progressbar/nprogress.js"></script>
<link href="/bitrix/css/main/font-awesome.css?146037394928798" type="text/css" rel="stylesheet" />

<!-- Тест Каталога и корзины у иконок ЗАВЕРШЕН -->
<?if (preg_match("/(.*)\/catalog\/([a-z]+)\/([0-9]+)\/(.*)/i", $_SERVER['REQUEST_URI'])) {?>

	
    <script type="text/javascript">
        $(document).ready(function() {
            $(".catalogIcon").html("<span>Каталог</span>");
            $(".basketIcon").html("<span>Корзина</span>");
        });
    </script>
<?}?>
<!-- //Тест Каталога и корзины у иконок ЗАВЕРШЕН -->

<!-- Тест Каталога и корзины у иконок ЗАВЕРШЕН -->
<?if (strpos($APPLICATION->GetCurPage(),"/catalog/") !== false) {
    if (!preg_match("/([0-9]+)/i",$APPLICATION->GetCurPage())) {?>
        <style>
            .catalogIcon span, .basketIcon span {
                color: #99ABB1;
            }
        </style>
    <?}?>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".catalogIcon").html("<span>Каталог</span>");
            $(".basketIcon").html("<span>Корзина</span>");
        });
    </script>
<?}?>
<!-- //Тест Каталога и корзины у иконок ЗАВЕРШЕН -->

<!-- Тест СмартБаннера ЗАВЕРШЕН -->
<meta name="apple-itunes-app" content="app-id=429622051">
<!-- //Тест СмартБаннера -->

<?//$APPLICATION->set_cookie("alpExps", serialize($alpExps));
## A/B-тестирование на сайте ##?>
