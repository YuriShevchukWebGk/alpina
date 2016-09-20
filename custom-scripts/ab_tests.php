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
<<<<<<< HEAD
//$alpExps['discountBlock']		= (!$alpExps['discountBlock'] ? rand(1,2) : $alpExps['discountBlock']);

if (strpos($APPLICATION->GetCurPage(),"/catalog/") !== false) {
	$alpExps['expertReviews']	= (!$alpExps['expertReviews'] ? rand(1,2) : $alpExps['expertReviews']);
}
if (strpos($APPLICATION->GetCurPage(),"/catalog/") !== false) {
	$alpExps['iconsWithText']	= (!$alpExps['iconsWithText'] ? rand(1,2) : $alpExps['iconsWithText']);
}
=======
>>>>>>> upstream/master
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
<<<<<<< HEAD
		<script type="text/javascript">
			$(document).ready(function() {
				dataLayer.push({
					event: 'ab-test-gtm',
					action: 'iconsWithText',
					label: 'withTextDown'
				});
				$(".catalogIcon").html("<span>Каталог</span>");
				$(".basketIcon").html("<span>Корзина</span>");
				console.log('iconsWithText withTextDown');
			});
		</script>
	<?}
}?>
<!-- //Тест Каталога и корзины у иконок -->

<!-- Тест Скидок на главной ЗАВЕРШЕН -->
<?/*if ($APPLICATION->GetCurDir() == '/') {
	if ($alpExps['discountBlock'] == 1) {?>
		<style>
			.blockBestsHide, .blockDiscountHide {display:none;}
			.blockBestsShow, .blockDiscountShow {display:inline;}
		</style>
		<script type="text/javascript">
			$(document).ready(function() {
				dataLayer.push({
					event: 'ab-test-gtm',
					action: 'discountBlock',
					label: 'moveUpwards'
				});
				console.log('discountBlock moveUpwards');
			});
		</script>
	<?} elseif ($alpExps['discountBlock'] == 2) {?>
		<style>
			.blockBestsShow, .blockDiscountShow {display:none;}
			.saleWrapp {overflow: visible;}
		</style>
		<script type="text/javascript">
			$(document).ready(function() {
				dataLayer.push({
					event: 'ab-test-gtm',
					action: 'discountBlock',
					label: 'doNothing'
				});
				console.log('discountBlock doNothing');
			});
		</script>
	<?}
}*/?>
<!-- //Тест Скидок на главной ЗАВЕРШЕН -->
=======
	<?}?>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".catalogIcon").html("<span>Каталог</span>");
			$(".basketIcon").html("<span>Корзина</span>");
		});
	</script>
<?}?>
<!-- //Тест Каталога и корзины у иконок ЗАВЕРШЕН -->
>>>>>>> upstream/master

<!-- Тест СмартБаннера ЗАВЕРШЕН -->
<meta name="apple-itunes-app" content="app-id=429622051">
<!-- //Тест СмартБаннера -->

<?$APPLICATION->set_cookie("alpExps", serialize($alpExps));
## A/B-тестирование на сайте ##?>