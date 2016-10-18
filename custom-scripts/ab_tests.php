<?## A/B-тестирование на сайте ##
global $USER;
$alpExps = unserialize($APPLICATION->get_cookie("alpExps"));
$alpExps  = (!$alpExps ? array() : $alpExps);

if ($alpExps['updateExp'] != "050916") {
    $alpExps = array();
    $alpExps['updateExp'] = "050916";
}

if (preg_match("/(.*)\/catalog\/([a-z]+)\/([0-9]+)\/(.*)/i", $_SERVER['REQUEST_URI']) || preg_match("/(.*)\/authors\/([0-9]+)\/(.*)/i", $_SERVER['REQUEST_URI'])) {
	$alpExps['autoHyphens']	= (!$alpExps['autoHyphens'] ? rand(1,2) : $alpExps['autoHyphens']);
}

$alpExps['bigFontMenu']	= (!$alpExps['bigFontMenu'] ? rand(1,2) : $alpExps['bigFontMenu']);

?>
<!-- Тест Автоматического переноса слов -->
<?
if ($alpExps['autoHyphens'] == 1) {?>
	<script type="text/javascript">
		$(document).ready(function() {
			dataLayer.push({
				event: 'ab-test-gtm',
				action: 'autoHyphens',
				label: 'withoutHyphens'
			});
			console.log('autoHyphens withoutHyphens');
		});
	</script>
<?} elseif ($alpExps['autoHyphens'] == 2) {?>
	<style>
		.content .textWrap, #prodBlock1 {
			-webkit-hyphens: auto;
			-ms-hyphens: auto;
			hyphens: auto;
		}
	</style>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".content .textWrap, #prodBlock1").attr('lang','ru');
			dataLayer.push({
				event: 'ab-test-gtm',
				action: 'autoHyphens',
				label: 'autoHyphens'
			});
			console.log('autoHyphens autoHyphens');
		});
	</script>
<?
}?>
<!-- //Тест Автоматического переноса слов -->

<!-- Тест Увеличенного шрифта в меню сверху -->
<?
if ($alpExps['bigFontMenu'] == 1) {?>
	<script type="text/javascript">
		$(document).ready(function() {
			dataLayer.push({
				event: 'ab-test-gtm',
				action: 'bigFontMenu',
				label: 'regularFontSize'
			});
			console.log('bigFontMenu regularFontSize');
		});
	</script>
<?} elseif ($alpExps['bigFontMenu'] == 2) {?>
	<style>
		.menu li a {
			font-size: 16px;
		}
	</style>
	<script type="text/javascript">
		$(document).ready(function() {
			dataLayer.push({
				event: 'ab-test-gtm',
				action: 'bigFontMenu',
				label: 'bigFontSize'
			});
			console.log('bigFontMenu bigFontSize');
		});
	</script>
<?
}?>
<!-- //Тест Увеличенного шрифта в меню сверху -->

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