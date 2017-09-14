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
<link rel="search" href="/opensearch.xml" title="Alpina.ru" type="application/opensearchdescription+xml" />
<script src="/custom-scripts/progressbar/nprogress.js"></script>
<script type="text/javascript" src="/js/countdown.js?20170721"></script>
<link href="/bitrix/css/main/font-awesome.css?146037394928798" type="text/css" rel="stylesheet" />
<script>function getsubbook(){$.post("/ajax/request_add.php",{email:$("#subpop input[type=email]").val()},function(data){$(".errorinfo").html(data);})}$(document).ready(function(){$(".stopProp").click(function(e){e.stopPropagation();});});function closeX(){$('.hideInfo').hide();}</script>

<!-- Тест Каталога и корзины у иконок ЗАВЕРШЕН -->
<?if (strpos($APPLICATION->GetCurPage(),"/catalog/") !== false) {
    if (!preg_match("/([0-9]+)/i",$APPLICATION->GetCurPage())) {?>
        <style>
            .catalogIcon span, .basketIcon span {
                color: #99ABB1;
            }
        </style>
    <?}?>
<?}?>
<!-- //Тест Каталога и корзины у иконок ЗАВЕРШЕН -->

<script type="text/javascript">
	$(document).ready(function() {
		$(".catalogIcon").html("<span>Каталог</span>");
		$(".basketIcon").html("<span>Корзина</span>");
	});
document.addEventListener('visibilitychange', function(e) {
console.log('hidden:' + document.hidden,
'state:' + document.visibilityState)
}, false);
</script>


<!-- Тест СмартБаннера ЗАВЕРШЕН -->
<meta name="apple-itunes-app" content="app-id=429622051">
<!-- //Тест СмартБаннера -->

<?//$APPLICATION->set_cookie("alpExps", serialize($alpExps));
## A/B-тестирование на сайте ##?>
<?if (strpos($APPLICATION->GetCurPage(),"/catalog/") !== false || $APPLICATION->GetCurDir() == "/") {?>
	<!--amp.eski.mobi--><link href="https://amp.alpinabook.ru/mobile/alpinabook-ru/amp/?p=<?php echo "https://www.alpinabook.ru".$APPLICATION->GetCurPage();?>" rel="amphtml" /><!--/amp.eski.mobi-->
<?}?>