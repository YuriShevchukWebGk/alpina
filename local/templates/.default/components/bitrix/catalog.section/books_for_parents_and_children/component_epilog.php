<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
use Bitrix\Main\Loader;
global $APPLICATION;
if (isset($templateData['TEMPLATE_THEME']))
{
	$APPLICATION->SetAdditionalCSS($templateData['TEMPLATE_THEME']);
}
if (isset($templateData['TEMPLATE_LIBRARY']) && !empty($templateData['TEMPLATE_LIBRARY']))
{
	$loadCurrency = false;
	if (!empty($templateData['CURRENCIES']))
		$loadCurrency = Loader::includeModule('currency');
	CJSCore::Init($templateData['TEMPLATE_LIBRARY']);
	if ($loadCurrency)
	{
	?>
	<script type="text/javascript">
		BX.Currency.setCurrencies(<? echo $templateData['CURRENCIES']; ?>);
	</script>
<?
	}
}
?>
<style>

.wrapperCategor.forChildrenWrapper {
    background-color: #fff6e5;
    overflow: hidden;
}

.wrapperCategor.forChildrenWrapper .categoryWrapper {
    background-color: #fff6e5;
}

.wrapperCategor.forChildrenWrapper .categoryWrapper h1 {
    color: #e7a41b;
    margin-bottom: -38px;
}

.wrapperCategor.forChildrenWrapper .categoryWrapper .alpinaChildrenLogo {
    width: 137px;
    height: 53px;
    object-fit: contain;
}

.wrapperCategor.forChildrenWrapper .categoryWrapper .alpinaChildrenLogo {
    width: 137px;
    height: 53px;
    object-fit: contain;
}

.wrapperCategor.forChildrenWrapper .doner_tags a, .wrapperCategor.forChildrenWrapper .doner_tags span {
    margin-bottom: 0px;
}

.wrapperCategor.forChildrenWrapper .categoryWrapper .sectionTextWrap {
    position: relative;
    margin-top: 30px;
}

.wrapperCategor.forChildrenWrapper .categoryWrapper .sectionTextWrap p{
    width: 556px;
    height: 120px;
    font-family: Walshein_regular;
    font-size: 16px;
    font-weight: normal;
    font-style: normal;
    font-stretch: normal;
    line-height: 1.5;
    letter-spacing: normal;
    text-align: left;
    color: #555e60;
    position: relative;
    z-index: 1;
}

.wrapperCategor.forChildrenWrapper .doner_tags a{
    position: relative;
    z-index: 3;
}

.wrapperCategor.forChildrenWrapper .categoryWrapper .sectionTextWrap img{
    position: absolute;
    bottom: -14px;
    right: -60px;
    z-index: 0;
}

.wrapperCategor.forChildrenWrapper .categoryWrapper .sectionTextWrap img{
    position: absolute;
    bottom: -14px;
    right: -60px;
    z-index: 0;
}

.wrapperCategor.forChildrenWrapper .categoryWrapper .childBannerBlocks{
    margin-top: 45px;
}

.wrapperCategor.forChildrenWrapper .categoryWrapper .childBannerBlocks .childBannerBlock{
    width: 285px;
    height: 268px;
    display: inline-block;
    margin: 0 5px;
}

.wrapperCategor.forChildrenWrapper .categoryWrapper .childBannerBlocks .childBannerBlock:first-child{
    margin: 0 5px 0 0;
}

.wrapperCategor.forChildrenWrapper .categoryWrapper .childBannerBlocks .childBannerBlock:last-child{
    margin: 0 0 0 5px;
}

.wrapperCategor.forChildrenWrapper .categoryWrapper .childBannerBlocks .childBannerBlock img{
    max-width:100%;
    max-height:100%;
    height: auto;
    border-radius: 5px;
}

.wrapperCategor.forChildrenWrapper .categoryWrapper .childrenBooks {
    margin-top: 60px;
    overflow: hidden;
}

.socServiceWrap {
    top: 231px;
    right: 60px;
    position: fixed;
    width: 120px;
    text-align: center;
    font-family: Walshein_regular;
    font-size: 16px;
    font-weight: normal;
    font-style: normal;
    font-stretch: normal;
    z-index: 9999;
}

.socServiceWrap .socServiceRound {
    display: block;
    border-radius: 32px;
    width: 64px;
    height: 64px;
    margin: 6px auto;
}

.socServiceWrap .socServiceRound.socServiceInstagram {
    background-color: #404040;
}
.socServiceWrap .socServiceRound.socServiceFacebook {
    background-color: #17b2c4
}
.socServiceWrap .socServiceRound.socServiceVK {
    background-color: #7f92b1;
}

.socServiceWrap .socServiceRound.socServiceInstagram img{
    margin-top: 16px;
    width: 32px;
}
.socServiceWrap .socServiceRound.socServiceFacebook img{
    margin-top: 12px;
    width: 32px;
    margin-left: -7px;
}
.socServiceWrap .socServiceRound.socServiceVK img{
    margin-top: 8px;
    width: 50px;
}

.wrapperCategor.forChildrenWrapper .childrenBooksSubscribe {
    width: 875px;
    height: 409px;
    border-radius: 5px;
    background-color: #e7a65f;
    position: relative;
}

.wrapperCategor.forChildrenWrapper .childrenBooksSubscribe .giftWrap {
    overflow: hidden;
}

.wrapperCategor.forChildrenWrapper .childrenBooksSubscribe .title {
    margin: 40px 0 0 50px;
    width: 391px;
    height: 51px;
    font-size: 36px;
    font-weight: 900;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    text-align: left;
    color: #ffffff;
    overflow: hidden;
}

.wrapperCategor.forChildrenWrapper .childrenBooksSubscribe .description {
    margin: 10px 0 0 50px;
    width: 336px;
    height: 48px;
    font-size: 16px;
    font-weight: normal;
    font-style: normal;
    font-stretch: normal;
    line-height: 1.5;
    letter-spacing: normal;
    text-align: left;
    color: #3f4a4d;
    overflow: hidden;
}

.wrapperCategor.forChildrenWrapper .childrenBooksSubscribe .giftWrap:before {
    content: "";
}

.wrapperCategor.forChildrenWrapper .childrenBooksSubscribe .pii.no-mobile {
    margin: 40px 0 0 50px;
    float: none;
    width: 391px;
    height: 72px;
    font-size: 16px;
    font-weight: normal;
    font-style: normal;
    font-stretch: normal;
    line-height: 1.5;
    letter-spacing: normal;
    text-align: left;
    color: #ffffff;
}

.wrapperCategor.forChildrenWrapper .demarcation {
    width: 875px;
    height: 2px;
    border: solid 1px rgba(151, 151, 151, 0.3);
    position: relative;
}

.wrapperCategor.forChildrenWrapper .demarcation img.bookWithBall {
    position: absolute;
    right: -58px;
    bottom: -70px;
}

.wrapperCategor.forChildrenWrapper .demarcation img.baloons {
    position: absolute;
    left: -190px;
    bottom: -484px;
}

.wrapperCategor.forChildrenWrapper .childrenBooksSubscribe .pii.no-mobile a {
  color: #3f4a4d;
}

.wrapperCategor.forChildrenWrapper .childrenBooksSubscribe form {
    margin: 40px 0 0 50px;
    width: 418px;
    height: 58px;
    position: relative;
}

.wrapperCategor.forChildrenWrapper .childrenBooksSubscribe input[type="text"] {
    background-color: #ffffff;
    box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.14);
    float: none;
    height: 100%;
    margin: 0;
}

.wrapperCategor.forChildrenWrapper .childrenBooksSubscribe input[type="text"]::placeholder {
    opacity: 0.5;
    font-size: 16px;
    font-weight: normal;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    text-align: left;
    color: #637477;
}

.wrapperCategor.forChildrenWrapper input[type="button"] {
    position: absolute;
    right: 22px;
    top: 0px;
    border: none;
    width: 60px;
    height: 58px;
    background: url(/img/giftInpBack.png) no-repeat #fff;
    background-position-y: center;
    cursor: pointer;
}

.wrapperCategor.forChildrenWrapper .giftRound {
    position: absolute;
    width: 80px;
    height: 80px;
    right: 21px;
    top: -10px;
    border-radius: 40px;
    background: url(/img/for_children/gift-2.png) no-repeat #486796;
    background-position: center;
    z-index: 2;
}

.wrapperCategor.forChildrenWrapper .bookCover {
    width: 313px;
    height: 369px;
    box-shadow: 0 10px 15px 0 rgba(147, 109, 63, 0.5);
    right: 40px;
    top: 40px;
    position: absolute;
}

.wrapperCategor.forChildrenWrapper .giftWrap {
    margin: 0px;
    padding: 0px;
    height: 100%;
}

.wrapperCategor.forChildrenWrapper .bookCover img {
    width: 313px;
    position: inherit;
    left: 0;
    top: 0;
    z-index: 1;
}

.wrapperCategor.forChildrenWrapper .childrenCooperation {
    width: 875px;
    height: 243px;
    border-radius: 5px;
    background-color: #ffffff;
    position: relative;
}

.wrapperCategor.forChildrenWrapper .childrenClew {
    position: absolute;
    left: -150px;
}

.wrapperCategor.forChildrenWrapper .childrenCooperation .title {
    margin: 40px 0 0 50px;
    width: 557px;
    height: 51px;
    font-size: 36px;
    font-weight: 900;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    text-align: left;
    color: #486796;
}

.wrapperCategor.forChildrenWrapper .childrenCooperation .textBlock {
    position: relative;
    overflow: hidden;
}

.wrapperCategor.forChildrenWrapper .childrenCooperation .text {
    margin: 10px 0 0 50px;
    width: 461px;
    font-size: 16px;
    font-weight: normal;
    font-style: normal;
    font-stretch: normal;
    line-height: 1.5;
    letter-spacing: normal;
    text-align: left;
    color: #3f4a4d;
}

.wrapperCategor.forChildrenWrapper .childrenCooperation .childrenCooperationImg {
    position: absolute;
    width: 228px;
    height: 282px;
    bottom: 0;
    right: 0;
}


.wrapperCategor.forChildrenWrapper .childrenCooperation .childrenCooperationImg img{
    width: 228px;
    object-fit: contain;
}

.wrapperCategor.forChildrenWrapper .childrenCooperation .childrenCooperationPillow {
    position: absolute;
    width: 119px;
    height: 88px;
    top: 181px;
    left: -59px;
}

.wrapperCategor.forChildrenWrapper .childrenCooperation .childrenCooperationPillow img{
    width: 119px;
    object-fit: contain;
}

.wrapperCategor.forChildrenWrapper .childrenGiftEdition {
    width: auto;
    height: auto;
    position: relative;
    margin-bottom: 80px;
    margin-top: 80px;
}


.wrapperCategor.forChildrenWrapper .childrenGiftEdition .textBlock {
    position: relative;
    overflow: hidden;
}

.wrapperCategor.forChildrenWrapper .childrenGiftEdition .title {
    margin: 0px;
    width: 365px;
    height: 84px;
    font-size: 36px;
    font-weight: 900;
    font-style: normal;
    font-stretch: normal;
    line-height: 1.17;
    letter-spacing: normal;
    text-align: left;
    color: #e23a43;
}

.wrapperCategor.forChildrenWrapper .childrenGiftEdition .text {
    margin: 20px 0 0 0;
    width: 560px;
    height: 136px;
    font-size: 16px;
    font-weight: normal;
    font-style: normal;
    font-stretch: normal;
    line-height: 1.5;
    letter-spacing: normal;
    text-align: left;
    color: #3f4a4d;
}

.wrapperCategor.forChildrenWrapper .childrenGiftEdition .phone {
    margin: 40px 0 0 0;
    width: 278px;
    height: 42px;
    font-size: 36px;
    font-weight: normal;
    font-style: normal;
    font-stretch: normal;
    line-height: 1.17;
    letter-spacing: normal;
    text-align: left;
    color: #414c4f;
}


.wrapperCategor.forChildrenWrapper .childrenGiftEdition .childrenCooperationImg {
    position: absolute;
    width: 228px;
    height: 282px;
    bottom: 0;
    right: 0;
}


.wrapperCategor.forChildrenWrapper .childrenGiftEdition .childrenCooperationImg img{
    width: 228px;
    object-fit: contain;
}

.wrapperCategor.forChildrenWrapper .childrenGiftEdition .childrenCooperationPillow {
    position: absolute;
    width: 119px;
    height: 88px;
    top: 181px;
    left: -59px;
}

.wrapperCategor.forChildrenWrapper .childrenGiftEdition .childrenCooperationPillow img{
    width: 119px;
    object-fit: contain;
}

.wrapperCategor.forChildrenWrapper .childrenGiftEdition .childrenGiftEditionImg {
    position:absolute;
    bottom: -60px;
    right: 0;
}

.wrapperCategor.forChildrenWrapper .childrenGiftEdition .childrenGiftEditionGift {
    position:absolute;
    left: 300px;
    bottom: -84px;
}

.wrapperCategor.forChildrenWrapper .childrenGiftEdition .childrenGiftEditionDog {
    position: absolute;
    left: -237px;
    bottom: -60px;
}

.wrapperCategor.forChildrenWrapper .giftWrap .some_info {
    z-index: 1100;
    position: absolute;
    display: none;
    top: 100px;
    left: 100px;
    width: 700px;
    background: #fff;
    border: 1px solid #00f;
    text-align: center;
    padding: 30px 0;
}

.wrapperCategor.forChildrenWrapper .doner_tags a {
    padding: 2px 20px;
    border: 1px solid #627478;
    border-radius: 20px;
}

.wrapperCategor.forChildrenWrapper .doner_tags a, .doner_tags span {
    float: left;
    display: block;
    margin-right: 40px;
    color: #627478;
    text-decoration: none;
    margin-bottom: 8px;
}

.wrapperCategor.forChildrenWrapper .doner_tags {
    overflow: hidden;
    margin: 40px 0px 0px;
}
</style>