<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Страница не найдена");?>

	<div class="noResultBodyWrap">
		<div class="centerWrapper noResWrapp">
			<p class="noResultTitle">Неправильно набран адрес, <br>или такой страницы на сайте больше не существует.</p>
			<p class="noResText">Вернитесь на <a href="<?=SITE_DIR?>">главную</a> или воспользуйтесь картой сайта.</p>
		</div>
	</div>

	
    <div class="col-sm-offset-2 col-sm-4">
        <div class="bx-map-title"><i class="fa fa-leanpub"></i> Каталог</div>
        <?$APPLICATION->IncludeComponent(
            "bitrix:catalog.section.list",
            "tree",
            array(
                "COMPONENT_TEMPLATE" => "tree",
                "IBLOCK_TYPE" => "catalog",
                "IBLOCK_ID" => "2",
                "SECTION_ID" => $_REQUEST["SECTION_ID"],
                "SECTION_CODE" => "",
                "COUNT_ELEMENTS" => "Y",
                "TOP_DEPTH" => "2",
                "SECTION_FIELDS" => array(
                    0 => "",
                    1 => "",
                ),
                "SECTION_USER_FIELDS" => array(
                    0 => "",
                    1 => "",
                ),
                "SECTION_URL" => "",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "36000000",
                "CACHE_GROUPS" => "Y",
                "ADD_SECTIONS_CHAIN" => "Y"
            ),
            false
        );
        ?>
    </div>

    <div class="col-sm-offset-1 col-sm-4">
        <div class="bx-map-title"><i class="fa fa-info-circle"></i> О магазине</div>
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:main.map",
            ".default",
            array(
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "36000000",
                "SET_TITLE" => "N",
                "LEVEL" => "3",
                "COL_NUM" => "2",
                "SHOW_DESCRIPTION" => "Y",
                "COMPONENT_TEMPLATE" => ".default"
            ),
            false
        );?>
    </div>
	<script>
		$(document).ready(function(){
			dataLayer.push({'event' : 'otherEvents', 'action' : '404 error', 'label' : '<?=$_SERVER['REQUEST_URI']?>'});
		});
	</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>