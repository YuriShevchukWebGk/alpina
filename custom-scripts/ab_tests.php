<?## A/B-тестирование на сайте ##
global $USER;
$alpExps = unserialize($APPLICATION->get_cookie("alpExps"));
$alpExps  = (!$alpExps ? array() : $alpExps);

if ($alpExps['updateExp'] != "040816") {
    $alpExps = array();
    $alpExps['updateExp'] = "040816";
}

//$alpExps['smartBannerApple']	= (!$alpExps['smartBannerApple'] ? rand(1,2) : $alpExps['smartBannerApple']);
/*if ($APPLICATION->GetCurDir() == '/personal/cart/') {
    $alpExps['recsInCart']        = (!$alpExps['recsInCart'] ? rand(1,2) : $alpExps['recsInCart']);
}*/

$alpExps['discountBlock']		= (!$alpExps['discountBlock'] ? rand(1,2) : $alpExps['discountBlock']);

if (strpos($APPLICATION->GetCurPage(),"/catalog/") !== false) {
	$alpExps['expertReviews']	= (!$alpExps['expertReviews'] ? rand(1,2) : $alpExps['expertReviews']);
}
if (strpos($APPLICATION->GetCurPage(),"/catalog/") !== false) {
	$alpExps['iconsWithText']	= (!$alpExps['iconsWithText'] ? rand(1,2) : $alpExps['iconsWithText']);
}
?>


<!-- Тест Рекомендаций в корзине ЗАВЕРШЕН -->
<?/*if ($APPLICATION->GetCurDir() == '/personal/cart/') {
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
}*/?>
<!-- //Тест Рекомендаций в корзине -->

<!-- Тест Вкладки эксперты -->
<?if (strpos($APPLICATION->GetCurPage(),"/catalog/") !== false) {
	if ($alpExps['expertReviews'] == 1) {?>
		<style>
			#prodBlock1 .reviewsBlockDetail {display:none!important;}
		</style>
		<script type="text/javascript">
			$(document).ready(function() {
				dataLayer.push({
					event: 'ab-test-gtm',
					action: 'expertReviews',
					label: 'newTab'
				});
				console.log('expertReviews newTab');
			});
		</script>
	<?} elseif ($alpExps['expertReviews'] == 2) {?>
		<style>
			.abHide {display:none!important;}
		</style>
		<script type="text/javascript">
			$(document).ready(function() {
				dataLayer.push({
					event: 'ab-test-gtm',
					action: 'expertReviews',
					label: 'doNothing'
				});
				console.log('expertReviews doNothing');
			});
		</script>
	<?}
}?>
<!-- //Тест Вкладки эксперты -->

<!-- Тест Каталога и корзины у иконок -->
<?if (strpos($APPLICATION->GetCurPage(),"/catalog/") !== false) {
	if ($alpExps['iconsWithText'] == 1) {?>
		<script type="text/javascript">
			$(document).ready(function() {
				dataLayer.push({
					event: 'ab-test-gtm',
					action: 'iconsWithText',
					label: 'withText'
				});
				$(".catalogIcon").html("<span>Каталог</span>");
				$(".basketIcon").html("<span>Корзина</span>");
				console.log('iconsWithText withText');
			});
		</script>
	<?} elseif ($alpExps['iconsWithText'] == 2) {?>
		<style>
			.catalogIcon span, .basketIcon span {
				margin-left: 0px;
				margin-top: 68px;
				text-align: center;
			}
		</style>
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

<!-- Тест Скидок на главной -->
<?if ($APPLICATION->GetCurDir() == '/') {
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
}?>
<!-- //Тест Скидок на главной -->

<!-- Тест СмартБаннера ЗАВЕРШЕН -->
<meta name="apple-itunes-app" content="app-id=429622051">
<!-- //Тест СмартБаннера -->

<?$APPLICATION->set_cookie("alpExps", serialize($alpExps));
## A/B-тестирование на сайте ##?>