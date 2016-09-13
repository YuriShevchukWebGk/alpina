<?## A/B-тестирование на сайте ##
global $USER;
$alpExps = unserialize($APPLICATION->get_cookie("alpExps"));
$alpExps  = (!$alpExps ? array() : $alpExps);

if ($alpExps['updateExp'] != "050916") {
    $alpExps = array();
    $alpExps['updateExp'] = "050916";
}

/*if (strpos($APPLICATION->GetCurPage(),"/catalog/") !== false) {
	$alpExps['lightFont']	= (!$alpExps['lightFont'] ? rand(1,2) : $alpExps['lightFont']);
}*/
?>

<!-- Тест Шрифта -->
<?/*if (strpos($APPLICATION->GetCurPage(),"/catalog/") !== false) {
	if ($alpExps['lightFont'] == 1) {?>
		<script type="text/javascript">
			$(document).ready(function() {
				dataLayer.push({
					event: 'ab-test-gtm',
					action: 'lightFont',
					label: 'regularFont'
				});
				console.log('lightFont regularFont');
			});
		</script>
	<?} elseif ($alpExps['lightFont'] == 2) {?>
		<style>
			.elementDescriptWrap .annotation span, .elementDescriptWrap .annotation ul, .elementDescriptWrap .annotation {
				font-family: "Walshein_light";
				font-size: 18px;
				color: #2e3c3f;
			}
		</style>
		<script type="text/javascript">
			$(document).ready(function() {
				dataLayer.push({
					event: 'ab-test-gtm',
					action: 'lightFont',
					label: 'lightFont'
				});
				console.log('lightFont lightFont');
			});
		</script>
	<?}
}*/?>
<!-- //Тест Шрифта -->

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