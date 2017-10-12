<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<div class="ContentcatalogIcon"></div>
<div class="ContentbasketIcon"></div>

<?

function getChildSections($SECTION_ID){
	$resultArr = array();
	
	$db_list = CIBlockSection::GetList(
		$arOrder = Array("SORT"=>"ASC"),
		$arFilter = Array("ACTIVE"=>"Y", "IBLOCK_ID"=> 4, "SECTION_ID"=>$SECTION_ID),
		$bIncCnt = false,
		$Select = Array("ID", "NAME", "CODE"),
		$NavStartParams = false
	);

	while($ar_result = $db_list->GetNext())
	{
		$resultArr[]=array('NAME' => $ar_result["NAME"], 'CODE' => $ar_result['CODE'], 'ID' => $ar_result["ID"]);
	}
	
return $resultArr;
}

$code = explode('/',$_SERVER['REQUEST_URI']);

$arrSections = array();
$db_list = CIBlockSection::GetList(
	$arOrder = Array("SORT"=>"ASC"),
	$arFilter = Array("ACTIVE"=>"Y", "IBLOCK_ID"=> 4,"DEPTH_LEVEL"=>"1", 'CODE' => $code[2]),
	$bIncCnt = false,
	$Select = Array("ID", "NAME", "CODE"),
	$NavStartParams = false
);
?>


<?while($ar_result = $db_list->GetNext()):
	//$arrSections[] = array($ar_result["NAME"] => getChildSections($ar_result["ID"]));
	$section = getChildSections($ar_result["ID"]);
	$APPLICATION->SetTitle("Карта раздела ". strtolower($ar_result["NAME"]) ." - Альпина");
?>

<div class="deliveryPageTitleWrap">
	<div class="centerWrapper" style="padding-top: 30px;">
		<h1>Карта раздела <?=strtolower($ar_result["NAME"])?></h1>
	</div>
</div>
<div class="deliveryBodyWrap" style="padding: 50px 0;">
	<div class="centerWrapper">
	
<div class="sitemap">
	<ul class="level_0">
		<li><a href="/catalog/<?=$ar_result["CODE"]?>/"><?=$ar_result["NAME"]?></a></li>
		<ul class="level_1">
		<?foreach($section as $s):?>
			<li><a href="/catalog/<?=$s["CODE"]?>/"><?=$s["NAME"]?></a></li>
			<ul class="level_2">
			<?
				$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "DETAIL_PAGE_URL");
				$arFilter = Array("IBLOCK_ID" => 4, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "SECTION_ID" => $s["ID"]);
				$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
				while($ob = $res->GetNextElement())
				{
					$arFields = $ob->GetFields();
					echo '<li><a href="'.$arFields['DETAIL_PAGE_URL'].'">' . $arFields['NAME'] . '</a></li>';
				}
			?> 
			</ul>
		<?endforeach;?>
		</ul>
	</ul>
</div>	
<?endwhile;?>	
	</div>
</div>




<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>