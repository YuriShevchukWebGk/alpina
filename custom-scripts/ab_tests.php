<?## A/B-тестирование на сайте ##
global $USER;
$alpExps = unserialize($APPLICATION->get_cookie("alpExps"));
$alpExps  = (!$alpExps ? array() : $alpExps);

if ($alpExps['updateExp'] != "261016") {
    $alpExps = array();
    $alpExps['updateExp'] = "261016";
}

/*if (preg_match("/(.*)\/catalog\/([a-z]+)\/([0-9]+)\/(.*)/i", $_SERVER['REQUEST_URI']) || preg_match("/(.*)\/authors\/([0-9]+)\/(.*)/i", $_SERVER['REQUEST_URI'])) {
	$alpExps['autoHyphens']	= (!$alpExps['autoHyphens'] ? rand(1,2) : $alpExps['autoHyphens']);
}*/

if (preg_match("/\/personal\/cart\/(.*)/i", $_SERVER['REQUEST_URI'])) {
	$alpExps['addLinkInCart']	= (!$alpExps['addLinkInCart'] ? rand(1,3) : $alpExps['addLinkInCart']);
}
?>

<!-- Тест Ссылки на Добавьте в корзину -->
<?if (preg_match("/\/personal\/cart\/(.*)/i", $_SERVER['REQUEST_URI'])) {
	if ($alpExps['addLinkInCart'] == 1) {?>
		<script type="text/javascript">
			$(document).ready(function() {
				dataLayer.push({
					'event' : 'ab-test-gtm',
					'action' : 'addLinkInCart',
					'label' : 'noLink'
				});
				console.log('addLinkInCart noLink');
			});
		</script>
	<?} elseif ($alpExps['addLinkInCart'] == 2) {?>
		<script type="text/javascript">
			$(document).ready(function() {
				$(".sale_price span").html("<a href='/catalog/crossbooks/' onclick='dataLayer.push({\"event\" : \"ab-test-gtm\",\"action\" : \"addLinkInCart\",\"label\" : \"linkClick\"});' style='text-decoration:underline;'>Добавьте товаров</a>");
				dataLayer.push({
					'event' : 'ab-test-gtm',
					'action' : 'addLinkInCart',
					'label' : 'withLink'
				});
				console.log('addLinkInCart withLink');
			});
		</script>
	<?} else {?>
		<script type="text/javascript">
			$(document).ready(function() {
				$(".sale_price span").html("<a href='/catalog/crossbooks/' target='_blank' onclick='dataLayer.push({\"event\" : \"ab-test-gtm\",\"action\" : \"addLinkInCart\",\"label\" : \"linkClick\"});' style='text-decoration:underline;'>Добавьте товаров</a>");
				dataLayer.push({
					'event' : 'ab-test-gtm',
					'action' : 'addLinkInCart',
					'label' : 'tabLink'
				});
				console.log('addLinkInCart tabLink');
			});
		</script>	
	<?}?>
<?}?>
<!-- Тест Ссылки на Добавьте в корзину -->

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

<?$APPLICATION->set_cookie("alpExps", serialize($alpExps));
## A/B-тестирование на сайте ##?>