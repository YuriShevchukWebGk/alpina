<?## A/B-тестирование на сайте ##
global $USER;
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
<script type="text/javascript" src="/js/countdown.js?20170721"></script>
<link href="/bitrix/css/main/font-awesome.css?146037394928798" type="text/css" rel="stylesheet" />
<script>function getsubbook(){$.post("/ajax/request_add.php",{email:$("#subpop input[type=email]").val()},function(data){$(".errorinfo").html(data);})}$(document).ready(function(){$(".stopProp").click(function(e){e.stopPropagation();});});function closeX(){$('.hideInfo').hide();}</script>
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
<?if ($USER->isAdmin()) {?>
<style>
@media screen and (max-width: 1200px){
    .mainWrapp .ibooks {
		font-size:40px
	}
	.ibooks img {
		width:90px;
		height:auto;
		top:28px;
		padding:0 16px;
	}
	.baskHeadMenu a, .menu li a {
		font-size:14px!important;
	}
	.basketIcon, .catalogIcon {
		top:-250px;
	}
	.mainWrapp .interShop {
		padding-top:30px;
	}
	.mainWrapp input[type=text]::-webkit-input-placeholder,.mainWrapp input[type=text]::-moz-placeholder,.mainSearchField::-webkit-input-placeholder,.mainSearchField::-moz-placeholder,.takePartWrap .text {
		font-size:15px;
	}
	.books .active, .books>ul>li {
		font-size:21px;
	}
	.mainWrapp {
		height:860px
	}
	.mainWrapp:before {
		height:680px;
	}
	.catalogWrapper, .hintWrapp .catalogWrapper,.reviewsWrapp .bigSlider {
		max-width:1140px;
		width:100%!important;
	}
	.firstWrapp {
		display:none!important;
	}
	.mainWrapp .books,.mainWrapp .book{
		max-width:900px;
		width:auto;
	}
	.hintWrapp .titleText {
		width:400px;
	}
	.hintWrapp .titleText img {
		width:160px;
	}
	.hintWrapp .nameOfGroup {
		height:100px;
		font-size:24px;
		padding-top:20px;
	}
	.hintWrapp .subNameOfGroup {
		width:180px;
	}
	.smallContainer,.colorCorrect,.smallContainer img {
		width:200px!important;
	}
	.hintWrapp .smallContainer p {
		font-size:16px;
		padding-left:16px;
	}
	.hintWrapp .smallContainer {
		height:310px;
	}
	.hintWrapp .titleBlock {
		margin-bottom:120px;
	}
	.secondSection div:nth-child(1) {
		margin-bottom:-24px;
	}
	.hintWrapp .recomendation, .bestonmain, .EditorChoiceWrapp, .saleWrapp,.reviewsWrapp .bigSlider,.centerWrapper,.authorBooksWrapp {
		max-width:930px;
	}
	.saleWrapp .giftWrap {
		margin-top:0;
	}
	.giftWrap .title {
		font-size:20px;
	}
	.giftWrap p,.giftWrap .pii {
		font-size:14px;
	}
	.giftWrap input[type=text] {
		margin-right:-65px;
		float:none;
	}
	.giftWrap .pii {
		float:left;
	}
	.giftWrap input[type=button] {
		right:auto;
	}
	.giftWrap:before {
		right:2%;
	}
	.allBooksWrapp .allBooks {
		margin-left:33%;
	}
	.allBooksWrapp .bookWrapp {
		display:inline-block;
		float:none;
	}
	
	.element_item_img img {
		width:300px;
		height:auto;
	}
	.bookPreviewButton {
		top:30%;
		left:40px;
	}
	.element_item_img {
		width:320px;
		height:450px!important;
	}
	.elementDescriptWrap .centerColumn {
		margin:0 240px 0 270px
	}
	.elementDescriptWrap .leftColumn {
		width:320px;
	}
	.centerColumn .productName .mainPart {
		font-size:28px;
	}
	.productElementWrapp::before {
		height:260px;
	}
	.dopSaleWrap {
		display:none;
	}
	#digitalversion, #paperversion {
		width:80px;
		font-size:14px;
		padding:6px 12px 0;
	}
	.elementDescriptWrap .priceBasketWrap,.elementDescriptWrap .rightColumn {
		width:240px;
	}
	.elementDescriptWrap .inBasket {
		padding: 13px 46px;
		font-size:18px;
	}
	.elementDescriptWrap .newPrice {
		font-size:36px;
	}
	.elementDescriptWrap .oldPrice {
		font-size:20px;
	}
	.item_buttons_counter_block {
		padding-left:16px;
	}
	.centerColumn .engBookName {
		font-size:16px;
	}
	.centerColumn .productAutor {
		font-size:12px;
	}
	.elementDescriptWrap .citate, .elementDescriptWrap i,.takePartWrap .title {
		font-size:18px;
	}
	.elementDescriptWrap .annotation span, .elementDescriptWrap .annotation ul {
		font-size:16px;
	}
	.elementDescriptWrap .productSelectTitle, .elementDescriptWrap h3 {
		font-size:22px;
	}
	.aboutAutor .author_info {
		max-width:315px;
	}
	.authorBooksWrapp {
		overflow:hidden;
	}
	.searchWrap input[type=text] {
		width:90%;
	}
	.weRecomWrap {
		height:440px;
		overflow:hidden;
	}
	.characteris .text {
		font-size:14px;
	}
	.transparent_input {
		height:36px;
		font-size:16px;
		width:70px;
		border:1px solid #cab796;;
	}
	.item_buttons_counter_block .plus,.item_buttons_counter_block .minus {
		height:38px;
		border:1px solid #cab796;;
		width:40px;
		font-size:26px;
		line-height:40px
	}
}

@media screen and (max-width: 940px){
	.book .secondWrapp,.secondWrapp img {
		width:270px;
	}
	.book .thirdWrapp {
		width:320px;
	}
	.firstWrapp img, .thirdWrapp img {
		width:140px;
	}
	.thirdWrapp .text {
		width:230px;
	}
	.thirdWrapp p {
		font-size:21px;
	}
	.mainWrapp .books,.mainWrapp .book{
		max-width:750px;
		width:auto;
	}
	.slidingTopMenu {
		display:block!important;
	}
	header,.find{
		display:none
	}
	.mainWrapp {
		padding-top:50px;
		height:830px
	}
	.mainWrapp .interShop {
		padding-top:90px;
	}
	.mainWrapp:before {
		height:610px;
	}
	.bestbook .cover img {
		width:240px;
	}
	.bestbook .button {
		width:180px;
		font-size:16px;
	}
	.bestbook .before {
		height:150px!important;
	}
	.bestbook .name, .reviewsSliderWrapp .sliderName,.weRecomWrap .tile,.authorBooksWrapp>p {
		font-size:26px;
	}
	.bestbook .name span {
		font-size:18px;
	}
	.bestbook .description {
		font-size:16px;
	}
	.secondSection,.dopSaleWrap {
		display:none;
	}
	.reviewsWrapp {
		height:650px;
	}
	.hintWrapp .titleText {
		width:524px;
	}
	.hintWrapp .titleText img {
		width:auto;
	}
	.hintWrapp .nameOfGroup {
		height:100px;
		font-size:24px;
		padding-top:20px;
	}
	.hintWrapp .subNameOfGroup {
		width:180px;
	}
	.smallContainer,.colorCorrect,.smallContainer img {
		width:259px!important;
	}
	.hintWrapp .smallContainer p {
		font-size:24px;
		padding-left:26px;
	}
	.hintWrapp .smallContainer {
		height:366px;
	}
	.hintWrapp .titleBlock {
		margin-bottom:36px;
	}
	.catalogWrapper, .hintWrapp .catalogWrapper,.reviewsWrapp .bigSlider,.authorBooksWrapp {
		max-width:910px;
	}
	.hintWrapp .recomendation, .bestonmain, .EditorChoiceWrapp, .saleWrapp,.reviewsWrapp .bigSlider {
		max-width:740px;
	}
	.item_img img, .section_item_img img,.item_img {
		width:120px;
	}
	.allBooksWrapp .bookWrapp,.allBooksWrapp .bookWrapp:nth-child(6n) {
		width:150px
	}
	.footerMenu {
		padding-bottom:0;
	}
	.yaMarket {
		margin-right:140px;
	}
	footer {
		height:740px;
	}
	.searchWrap {
		display:none;
	}
	.productElementWrapp {
		margin-top:21px;
	}
	.productElementWrapp .centerWrapper {
		max-width:800px;
	}
	.elementDescriptWrap .buyLater {
		font-size:13px;
		background: url(/img/buyLaterHeart.png) 27px 10px no-repeat rgba(0,0,0,0);
		width:140px;
		padding: 6px 0 6px 46px;
	}
	.elementDescriptWrap .productsMenu {
		font-size:12px;
	}
	.productsMenu .active {
		font-size:18px;
	}
	.productsMenu li {
		margin-right:18px;
	}
	.elementDescriptWrap .marks>div {
		font-size:10px;
		padding: 3px 8px;
	}
	.elementDescriptWrap .citate, .elementDescriptWrap i, .takePartWrap .title {
		font-size:16px;
	}
	.takePartWrap .text {
		font-size:15px;
	}
	.elementDescriptWrap .takePartWrap,.elementDescriptWrap .characteris {
		width:240px;
	}
	.takePartWrap button {
		left:190px;
	}
	.bookViews,.bookid,.elementDescriptWrap .shippings {
		font-size:13px;
	}
	.characteris .title {
		font-size:14px;
	}
	.priceBasketWrap>center>span {
		width:166px!important;
		font-size:13px!important;
	}
	.b-share-btn__wrap {
		margin: 0 9px!important;
	}
	
	.element_item_img img {
		width:240px;
		height:auto;
	}
	.centerColumn {
		margin-right:210px!important;
	}
	.bookPreviewButton {
		top:30%;
		left:40px;
	}
	.element_item_img {
		width:260px;
		height:350px!important;
	}
	.elementDescriptWrap .centerColumn {
		margin:0 210px 0 240px
	}
	.elementDescriptWrap .leftColumn {
		width:260px;
	}
	.centerColumn .productName .mainPart {
		font-size:24px;
	}
	.productElementWrapp::before {
		height:210px;
	}
	.dopSaleWrap {
		display:none;
	}
	#digitalversion, #paperversion {
		width:80px;
		font-size:14px;
	}
	.elementDescriptWrap .priceBasketWrap,.elementDescriptWrap .rightColumn {
		width:210px;
	}
	.elementDescriptWrap .inBasket {
		padding: 10px 37px;
		font-size:16px;
	}
	.elementDescriptWrap .newPrice {
		font-size:32px;
	}
	.elementDescriptWrap .oldPrice {
		font-size:18px;
	}
	.item_buttons_counter_block {
		padding-left:28px;
	}
	.centerColumn .engBookName,.wrap_prise_top {
		font-size:15px;
	}
	.wrap_prise_top {
		padding:18px 5px 0px;
	}
	.wrap_prise_bottom {
		padding-top:14px;
		padding-bottom:14px;
	}
	.centerColumn .productAutor {
		font-size:12px;
	}
	.elementDescriptWrap .citate, .elementDescriptWrap i,.takePartWrap .title {
		font-size:17px;
	}
	.elementDescriptWrap .annotation span, .elementDescriptWrap .annotation ul {
		font-size:15px;
	}
	.elementDescriptWrap .productSelectTitle, .elementDescriptWrap h3 {
		font-size:20px;
	}
	.aboutAutor .author_info {
		max-width:260px;
	}
	.authorBooksWrapp {
		overflow:hidden;
	}
	.searchWrap input[type=text] {
		width:90%;
	}
	.weRecomWrap {
		height:440px;
		overflow:hidden;
	}
	.characteris .text {
		font-size:14px;
	}
	
	
}
@media screen and (max-width: 800px){
	.book .secondWrapp,.secondWrapp img {
		width:360px;
	}
	.thirdWrapp {
		display:none!important;
	}
	.mainWrapp .books,.mainWrapp .book{
		max-width:520px;
		width:auto;
	}
	.catalogWrapper, .hintWrapp .catalogWrapper,.reviewsWrapp .bigSlider,.authorBooksWrapp {
		max-width:780px;
	}
	.hintWrapp .recomendation, .bestonmain, .EditorChoiceWrapp, .saleWrapp,.reviewsWrapp .bigSlider {
		max-width:610px;
	}
}

</style>
<?}?>