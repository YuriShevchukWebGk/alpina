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

.childrenBooksBlock {

}
.childrenBooksBlock .seriesBlock {
    width: 100%;
    height: 51px;
}

.childrenBooksBlock .seriesTitle{
    display: inline-block;
}

.childrenBooksBlock .seriesTitle h2{
    font-size: 36px;
    font-weight: normal;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    text-align: left;
    color: #3f4a4d;
    margin: 0;
}

.childrenBooksBlock .allBooksButton {
    width: 117px;
    height: 34px;
    border-radius: 25px;
    border: solid 1px #17b2c4;
    text-align: center;
    line-height: 33px;
    display: inline-block;
    float: none;
    margin-top: 10px;
    margin-left: 30px;
    vertical-align: 6px;
}

.categoryWrapper .childrenBooksBlock .categoryBooks:hover {
    height: auto;
}

.categoryWrapper .childrenBooksBlock .otherBooks {
    margin-top: 47px;
}

.forChildrenWrapper .categoryWrapper .otherBooks li {
    display: inline-block;
    height: 470px;
    width: 216px;
    float: left;
    margin-bottom: 10px;
}

.forChildrenWrapper .categoryWrapper .otherBooks li.bigItem {
    display: inline-block;
    height: 900px;
    width: 360px;
    margin-right: 84px;
}

.forChildrenWrapper .categoryWrapper .otherBooks li.bigItem .section_item_img {
    height: 528px;
    width: 360px;
    text-align: center;
    vertical-align: middle;
}

.forChildrenWrapper .categoryWrapper .otherBooks li.bigItem .section_item_img img {
    width: 360px;
    max-height: 500px;
}

.forChildrenWrapper .categoryWrapper .otherBooks li.bigItem .detailText{
    display: inline-block;
    padding-left: 4px;
    padding-top: 24px;
}

.bx-section-desc-post{
    font-size: 12px;
    padding: 0 0 0 15px;
    margin: 15px 0;
}
.bx-section-desc{
    border-left: 3px solid #d3d3d3;
}
.bx_catalog_list_home{
    margin-bottom:20px;
    border-bottom:1px solid #e5e5e5;
}
.doner_tags{
	overflow: hidden;
	margin: 40px 0px 0px;
}
.doner_tags a, .doner_tags span{
	float: left;
	display: block;
	margin-right: 40px;
	color: #627478;
	text-decoration: none;
	margin-bottom: 8px;
}
.doner_tags a{
	padding: 2px 20px;
	border: 1px solid #627478;
	border-radius: 20px;
}
.doner_tags a:hover{
	border: 1px solid #627478;
	text-decoration: underline;
}
.doner_tags span{
	padding: 3px 0px;
}
</style>