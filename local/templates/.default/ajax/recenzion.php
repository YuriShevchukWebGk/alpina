<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

	$arResult["ID"] = $_POST['id'];
	
    $review = CIBlockElement::GetList (
        array(),
        array(
            "IBLOCK_ID" => REVIEWS_IBLOCK_ID,
            "PROPERTY_BOOK" => $arResult["ID"]
        ),
        false,
        false,
        array(
            "ID",
            "PROPERTY_AUTHOR",
            "NAME",
            "PROPERTY_BOOK",
            "PREVIEW_TEXT",
            "DETAIL_TEXT",
            "PROPERTY_SOURCE_LINK"
        )
    );
    $arResult["REVIEWS_COUNT"] = $review -> SelectedRowsCount();
    while ($reviewList = $review -> Fetch()) {
        $arResult["REVIEWS"][] = $reviewList;
    }	
	if ($arResult["REVIEWS_COUNT"] > 0) {
	?>	
		<?foreach ($arResult["REVIEWS"] as $reviewList) {?>
			<?if (!empty($reviewList["PREVIEW_TEXT"])) {?>
				<?if (!$checkMobile) {?>
					<a href="/content/reviews/<?=$reviewList['ID']?>/" onclick="getReview(<?=$reviewList['ID']?>);return false;">
						<span class="recenz_author_name"><?= $reviewList["NAME"] ?></span>
					</a>
					<div class="recenz_text">
						<?echo substr(strip_tags($reviewList["PREVIEW_TEXT"]),0,400).'... ';?>
						<a href="/content/reviews/<?=$reviewList['ID']?>/" onclick="getReview(<?=$reviewList['ID']?>);return false;" class="readFullReview">Читать полностью</a>
					</div>
					<?} else {?>
					<a href="/content/reviews/<?=$reviewList['ID']?>/" target="_blank">
						<span class="recenz_author_name"><?= $reviewList["NAME"] ?></span>
					</a>

					<div class="recenz_text">
						<?=$reviewList["PREVIEW_TEXT"]?>
						<? if ($reviewList["PREVIEW_TEXT"] == "") {
								echo $reviewList["DETAIL_TEXT"];
					}?>
					</div>
				<?}?>
			<?}?>
		<?}?>
	<?}?>