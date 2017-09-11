<div id="prefsWrap" class="no-mobile">
	<div id="prefs">
		<?$prefs = array(
			array("1w.png","Удобство","Бесплатные электронные версии к&nbsp;бумажным"),
			array("2w.png","Доставка","По&nbsp;всему миру, бесплатно от&nbsp;2&nbsp;000 рублей"),
			array("3w.png","Скидки","Накопительные от&nbsp;10% и&nbsp;выше"),
			array("4w.png","Бонусы","С&nbsp;каждой покупкой"),
			array("5w.png","Сотрудники","Мы любим своих клиентов и&nbsp;книги, и&nbsp;это очень заметно")
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