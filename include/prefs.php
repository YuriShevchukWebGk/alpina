<div id="prefsWrap" class="no-mobile">
	<div id="prefs">
		<?$prefs = array(
			array("1w.png","Удобно","Бесплатные электронные версии к&nbsp;бумажным"),
			array("2w.png","Быстро","Доставка по&nbsp;всему миру, бесплатно от&nbsp;2&nbsp;000 рублей"),
			array("3w.png","Выгодно","Накопительные скидки от&nbsp;10% и&nbsp;выше"),
			array("4w.png","Приятно","Бонусы с&nbsp;каждой покупкой"),
			array("5w.png","Хочется еще","Мы любим своих клиентов и&nbsp;книги, и&nbsp;это очень заметно")
		);
		?>
		<?foreach($prefs as $pref) {?>
			<div class="pref">
				<img src="/img/icons/<?=$pref[0]?>" />
				<span class="title"><?=$pref[1]?></span>
				<span class="descr"><?=$pref[2]?></span>
			</div>
		<?}?>
	</div>
</div>