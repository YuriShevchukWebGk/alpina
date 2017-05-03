<? header('Access-Control-Allow-Origin: *'); ?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
$domain = "http://" . $_SERVER['HTTP_HOST'];
$result_books = array();
$authors_result = array();

// РїРѕР»СѓС‡Р°РµРј РІСЃeС… Р°РІС‚РѕСЂРѕРІ, С‡С‚РѕР±С‹ РїРѕ id РїРѕС‚РѕРј РїРѕР»СѓС‡РёС‚СЊ РёС… РёРјСЏ
$authors = CIBlockElement::GetList(
	array(),
	array(
		"IBLOCK_ID" => AUTHORS_IBLOCK_ID
	),
	false,
	false,
	array(
		"ID",
		"NAME"
	)
);
while ($author = $authors->Fetch()) {
	$authors_result[$author['ID']] = $author['NAME'];
}
// РїРѕР»СѓС‡Р°РµРј РЅСѓР¶РЅС‹Рµ РЅР°Рј РєРЅРёРіРё
$books = CIBlockElement::GetList(
	array(),
	array(
		"IBLOCK_ID"  => CATALOG_IBLOCK_ID,
		"SECTION_ID" => TRADING_FINANCE_SECTION_ID,
		"ACTIVE"     => "Y"
	),
	false,
	false,
	array(
		"ID",
		"NAME",
		"DETAIL_PICTURE",
		"PROPERTY_AUTHORS",
		"DETAIL_PAGE_URL",
		"CODE",
        "PROPERTY_STATE",
        "*"
	)
);
while ($book = $books->Fetch()) {
    //
    $ar_price = CPrice::GetBasePrice($book["ID"]);
	$picture = CFIle::ResizeImageGet($book['DETAIL_PICTURE'], array("width" => WIDGET_PREVIEW_WIDTH, "height" => WIDGET_PREVIEW_HEIGHT), BX_RESIZE_IMAGE_PROPORTIONAL);
	$detail_url = str_replace(
		array("#SECTION_CODE#", "#ELEMENT_ID#"),
		array($book["CODE"], $book["ID"]),
		$book["DETAIL_PAGE_URL"]
	);
	$result_books[$book["ID"]] = array(
        "quantity" => $book["PROPERTY_STATE_VALUE"],
        "price" => CurrencyFormat($ar_price["PRICE"], $ar_price["CURRENCY"]),
		"title" => $book['NAME'],
		"author" => $authors_result[$book['PROPERTY_AUTHORS_VALUE']],
		"detail_url" => $domain . $detail_url,
		"picture" => $domain . $picture['src']
	);
}
?>

<div id="alpina_widget_books_wrapper">
	<ul>
		<? foreach ($result_books as $book_id => $book) { ?>
			<li>
				<table>
					<tr>
						<td>
							<a class="alpina_widget_image" href="<?= $book["detail_url"] ?>" title="<?= $book["title"] ?>" alt="<?= $book["title"] ?>" target="_blank">
								<img src="<?= $book["picture"] ?>" alt="<?= $book["title"] ?>" />
							</a>
						</td>
						<td>
							<a href="<?= $book["detail_url"] ?>" class="alpina_widget_title" title="<?= $book["title"] ?>" alt="<?= $book["title"] ?>" target="_blank">
								<?= $book["title"] ?>
							</a>
                            <p><?if(!$book["quantity"]){
                                echo 'Цена: '. $book["price"];
                            }else {
                                echo $book["quantity"];
                            }?></p>
							<span>
								<?= $book["author"] ?>
							</span>
						</td>
					</tr>
				</table>
			</li>
		<? } ?>
	</ul>
</div>