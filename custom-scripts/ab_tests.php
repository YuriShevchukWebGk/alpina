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
<link href="/bitrix/css/main/font-awesome.css?152240597931000123123" type="text/css" rel="stylesheet" />
<style>
	.productElementWrapp .dopSaleWrap{display:none}
	<?if (strpos($APPLICATION->GetCurPage(),"/catalog/") !== false) {
		if (!preg_match("/([0-9]+)/i",$APPLICATION->GetCurPage())) {?>
				.catalogIcon span, .basketIcon span {
					color: #99ABB1;
				}
		<?}?>
	<?}?>
</style>

<script type="text/javascript">
    $(document).ready(function() {
        <?if (empty($_COOKIE["subscribePopup"]) && empty($APPLICATION->get_cookie("subscribePopup")) && empty($_COOKIE["subscribePopupChildren"]) && empty($APPLICATION->get_cookie("subscribePopupChildren"))) {
			if (strpos($APPLICATION->GetCurPage(),"/BooksForParentsAndChildren/") === false && strpos($APPLICATION->GetCurPage(),"/KnigiDlyaDetei/") === false && strpos($APPLICATION->GetCurPage(),"/BooksForParents/") === false) {?>
				if (readCookie("subscribePopup") == null) {
					setTimeout(subscribePopup, 2000);
				}
			<?} else {?>
				if (readCookie("subscribePopupChildren") == null) {
					setTimeout(subscribePopupChildren, 2000);
				}
			<?}?>
        <?}?>
		
		<?#Настраиваю свои брошенные корзины?>
		<?if (!empty($_COOKIE["userId"]) || $USER->GetID()) {?>
			setAbandonedInfo(<?=$_COOKIE["userId"]?>,<?=CSaleBasket::GetBasketUserID()?>);
			setInterval(function() {
				setAbandonedInfo(<?=$_COOKIE["userId"]?>,<?=CSaleBasket::GetBasketUserID()?>);
			}, 1000 * 60 * 10);
		<?}?>
    });
	
    document.addEventListener('visibilitychange', function(e) {
        console.log('hidden:' + document.hidden,
        'state:' + document.visibilityState)
    }, false);
</script>
<meta name="apple-itunes-app" content="app-id=429622051">

<?//$APPLICATION->set_cookie("alpExps", serialize($alpExps));
## A/B-тестирование на сайте ##?>
<?if (strpos($APPLICATION->GetCurPage(),"/catalog/") !== false || $APPLICATION->GetCurDir() == "/") {?>
    <!--amp.eski.mobi--><link href="https://amp.alpinabook.ru/mobile/alpinabook-ru/amp/?p=<?php echo "https://www.alpinabook.ru".$APPLICATION->GetCurPage();?>" rel="amphtml" /><!--/amp.eski.mobi-->
<?}?>


<script>
// uid от admitad в cookie при передаче в запросе
function handleadmitadUid(lifeTime) {
	var aid = (/admitad_uid=([^&]+)/.exec(location.search) || [])[1];
	if (!aid) {
		return;
	}

	var expiresDate = new Date((lifeTime || 90 * 60 * 60 * 24 * 1000) + +new Date);
	var cookieString = '_aid=' + aid + '; path=/; expires=' + expiresDate + ';';
	document.cookie = cookieString;
	document.cookie = cookieString + '; domain=.' + location.host;
}

handleadmitadUid(90 * 60 * 60 * 24 * 1000);

function getadmitadUid() {
	return (document.cookie.match(/_aid=([^;]+)/) || [])[1];
}
</script>