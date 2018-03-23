<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

?>
<div class="books">
	<div class="firstSection">
		<?/*<div class="titleBlock">
			<div class="titleText">
				<?
				$tops = array(
				'<a href="/catalog/editors-choice/" title="Выбор редактора">
					<img src="/img/redPhoto.png">
					<p class="nameOfGroup">Editor\'s Choice</p>
					<p class="subNameOfGroup">Сергей турко</p>
					<p class="description">Главный редактор</p>
					<p class="description">"Альпина паблишер"</p>
				</a>',
				'<a href="/catalog/ceo-choice/" title="Выбор генерального директора">
					<img src="/img/ai.jpg">
					<p class="nameOfGroup">Важные книги<br />о бизнесе</p>
					<p class="subNameOfGroup">Алексей Ильин</p>
					<p class="description">Генеральный директор</p>
					<p class="description">"Альпина паблишер"</p>
				</a>'
				);
				
				shuffle($tops);
				print $tops[0];
				?>
			</div>
		</div>*/?>
		<div>
			<?if ($arResult["COUNT"][6] > 0)
			{?>
			<a class="smallContainer" href="<?=$arResult["SECT_URLS"][6]?>" onclick="dataLayer.push({'event' : 'collectionsOnMain', 'action' : 'collectionClick', 'label' : '<?=$arResult["SECT_NAMES"][2]?>'});" style="    margin-bottom: 36px">
						<p><?=$arResult["SECT_NAMES"][6]?></p>
						<p class="count"><?=$arResult["COUNT"][6].' '.format_by_count($arResult["COUNT"][6], 'книга', 'книги', 'книг');?></p>
						<div class="colorCorrect"></div> 
						<img src="<?if($arResult["IMAGES_PATHS_ARRAY"][6]){echo $arResult["IMAGES_PATHS_ARRAY"][6];}else{?>/img/book111.png<?}?>">
			</a>
			<?}?>
			<?if ($arResult["COUNT"][7] > 0)
			{?>
			<a class="smallContainer" href="<?=$arResult["SECT_URLS"][7]?>" onclick="dataLayer.push({'event' : 'collectionsOnMain', 'action' : 'collectionClick', 'label' : '<?=$arResult["SECT_NAMES"][7]?>'});">
					<p><?=$arResult["SECT_NAMES"][7]?></p>
					<p class="count"><?=$arResult["COUNT"][7].' '.format_by_count($arResult["COUNT"][7], 'книга', 'книги', 'книг');?></p>
					<div class="colorCorrect"></div>
					<img src="<?if($arResult["IMAGES_PATHS_ARRAY"][7]){echo $arResult["IMAGES_PATHS_ARRAY"][7];}else{?>/img/book121.png<?}?>">
			</a>
			<?}?>
		</div>
		<div>
			<?if ($arResult["COUNT"][2] > 0)
			{?>
			<a class="smallContainer" href="<?=$arResult["SECT_URLS"][2]?>" onclick="dataLayer.push({'event' : 'collectionsOnMain', 'action' : 'collectionClick', 'label' : '<?=$arResult["SECT_NAMES"][2]?>'});">
						<p><?=$arResult["SECT_NAMES"][2]?></p>
						<p class="count"><?=$arResult["COUNT"][2].' '.format_by_count($arResult["COUNT"][2], 'книга', 'книги', 'книг');?></p>
						<div class="colorCorrect"></div> 
						<img src="<?if($arResult["IMAGES_PATHS_ARRAY"][2]){echo $arResult["IMAGES_PATHS_ARRAY"][2];}else{?>/img/book111.png<?}?>">
			</a>
			<?}?>
			<?if ($arResult["COUNT"][3] > 0)
			{?>
			<a class="smallContainer" href="<?=$arResult["SECT_URLS"][3]?>" onclick="dataLayer.push({'event' : 'collectionsOnMain', 'action' : 'collectionClick', 'label' : '<?=$arResult["SECT_NAMES"][3]?>'});">
					<p><?=$arResult["SECT_NAMES"][3]?></p>
					<p class="count"><?=$arResult["COUNT"][3].' '.format_by_count($arResult["COUNT"][3], 'книга', 'книги', 'книг');?></p>
					<div class="colorCorrect"></div>
					<img src="<?if($arResult["IMAGES_PATHS_ARRAY"][3]){echo $arResult["IMAGES_PATHS_ARRAY"][3];}else{?>/img/book121.png<?}?>">
			</a>
			<?}?>
		</div>
	</div>
	<div class="secondSection">
		<div>
			<?if ($arResult["COUNT"][0] > 0)
			{?>
			<a class="smallContainer" href="<?=$arResult["SECT_URLS"][0]?>" onclick="dataLayer.push({'event' : 'collectionsOnMain', 'action' : 'collectionClick', 'label' : '<?=$arResult["SECT_NAMES"][0]?>'});">
					<p><?=$arResult["SECT_NAMES"][0]?></p> 
					<p class="count"><?=$arResult["COUNT"][0].' '.format_by_count($arResult["COUNT"][0], 'книга', 'книги', 'книг');?></p>
					<div class="colorCorrect"></div>
					<img src="<?if($arResult["IMAGES_PATHS_ARRAY"][0]){echo $arResult["IMAGES_PATHS_ARRAY"][0];}else{?>/img/book131.png<?}?>">
			</a>
			<?}?>
			<?if ($arResult["COUNT"][1] > 0)
			{?>
			<a class="smallContainer" href="<?=$arResult["SECT_URLS"][1]?>" onclick="dataLayer.push({'event' : 'collectionsOnMain', 'action' : 'collectionClick', 'label' : '<?=$arResult["SECT_NAMES"][1]?>'});">
					<p><?=$arResult["SECT_NAMES"][1]?></p> 
					<p class="count"><?=$arResult["COUNT"][1].' '.format_by_count($arResult["COUNT"][1], 'книга', 'книги', 'книг');?></p>
					<div class="colorCorrect"></div>
					<img src="<?if($arResult["IMAGES_PATHS_ARRAY"][1]){echo $arResult["IMAGES_PATHS_ARRAY"][1];}else{?>/img/book141.png<?}?>">
			</a>
			<?}?>    
		</div>
		<div>
			<?if ($arResult["COUNT"][4] > 0)
			{?>
			<a class="smallContainer" href="<?=$arResult["SECT_URLS"][4]?>" onclick="dataLayer.push({'event' : 'collectionsOnMain', 'action' : 'collectionClick', 'label' : '<?=$arResult["SECT_NAMES"][4]?>'});">
					<p><?=$arResult["SECT_NAMES"][4]?></p>
					<p class="count"><?=$arResult["COUNT"][4].' '.format_by_count($arResult["COUNT"][4], 'книга', 'книги', 'книг');?></p>
					<div class="colorCorrect"></div>
					<img src="<?if($arResult["IMAGES_PATHS_ARRAY"][4]){echo $arResult["IMAGES_PATHS_ARRAY"][4];}else{?>/img/book151.png<?}?>">
			</a>
			<?}?>
			<?if ($arResult["COUNT"][5] > 0)
			{?>
			<a class="smallContainer" href="<?=$arResult["SECT_URLS"][5]?>" onclick="dataLayer.push({'event' : 'collectionsOnMain', 'action' : 'collectionClick', 'label' : '<?=$arResult["SECT_NAMES"][5]?>'});">
					<p><?=$arResult["SECT_NAMES"][5]?></p> 
					<p class="count"><?=$arResult["COUNT"][5].' '.format_by_count($arResult["COUNT"][5], 'книга', 'книги', 'книг');?></p>
					<div class="colorCorrect"></div>
					<img src="<?if($arResult["IMAGES_PATHS_ARRAY"][5]){echo $arResult["IMAGES_PATHS_ARRAY"][5];}else{?>/img/book161.png<?}?>">
			</a>
			<?}?>    
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
    if ($(".books .smallContainer").size() < 3)
    {
        $(".books").css("height", "400px");
        $(".books .secondSection").css("height", "400px");
        $(".hintWrapp").css("height", "1100px");        
    }

	<!-- //dataLayer GTM -->
		dataLayer.push({'event' : 'collectionsOnMain', 'action' : 'collectionShow', 'label' : '<?=$arResult["SECT_NAMES"][0]?>'});
		dataLayer.push({'event' : 'collectionsOnMain', 'action' : 'collectionShow', 'label' : '<?=$arResult["SECT_NAMES"][1]?>'});
		dataLayer.push({'event' : 'collectionsOnMain', 'action' : 'collectionShow', 'label' : '<?=$arResult["SECT_NAMES"][2]?>'});
		dataLayer.push({'event' : 'collectionsOnMain', 'action' : 'collectionShow', 'label' : '<?=$arResult["SECT_NAMES"][3]?>'});
		dataLayer.push({'event' : 'collectionsOnMain', 'action' : 'collectionShow', 'label' : '<?=$arResult["SECT_NAMES"][4]?>'});
		dataLayer.push({'event' : 'collectionsOnMain', 'action' : 'collectionShow', 'label' : '<?=$arResult["SECT_NAMES"][5]?>'});
	<!-- // dataLayer GTM -->			
});
</script>