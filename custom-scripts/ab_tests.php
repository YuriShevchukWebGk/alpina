<?## A/B-тестирование на сайте ##
global $USER;
$alpExps = unserialize($APPLICATION->get_cookie("alpExps"));
$alpExps  = (!$alpExps ? array() : $alpExps);

if ($alpExps['updateExp'] != "261016") {
    $alpExps = array();
    $alpExps['updateExp'] = "261016";
}

/*if (preg_match("/(.*)\/catalog\/([a-z]+)\/([0-9]+)\/(.*)/i", $_SERVER['REQUEST_URI']) || preg_match("/(.*)\/authors\/([0-9]+)\/(.*)/i", $_SERVER['REQUEST_URI'])) {
    $alpExps['autoHyphens']    = (!$alpExps['autoHyphens'] ? rand(1,2) : $alpExps['autoHyphens']);
    
}*/

if (preg_match("/\/personal\/cart\/(.*)/i", $_SERVER['REQUEST_URI'])) {
    $alpExps['addLinkInCart']    = (!$alpExps['addLinkInCart'] ? rand(1,3) : $alpExps['addLinkInCart']);
}
?>

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

<script type="text/javascript">
$(function() {
	$('body').append('<div style="width:64px;background:#85959a; height:64px; border-radius:80px;text-align:center; position:fixed; bottom:10px; right:10px; cursor:pointer; display:none; color:#fff; font-family:\'Walshein_black\'; font-size:40px;" id="toTop" class="no-mobile">↑</div>');
	$(window).scroll(function() {
		if($(this).scrollTop() != 0) {
			$('#toTop').fadeIn();
		} else {
			$('#toTop').fadeOut();
		}
	});
	$('#toTop').click(function() {
		$('body,html').animate({scrollTop:0},800);
	});
});
</script>

<?$APPLICATION->set_cookie("alpExps", serialize($alpExps));
## A/B-тестирование на сайте ##?>