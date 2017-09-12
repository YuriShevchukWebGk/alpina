		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			".default",
			array(
				"AREA_FILE_SHOW" => "file",
				"AREA_FILE_SUFFIX" => "inc",
				"AREA_FILE_RECURSIVE" => "Y",
				"EDIT_TEMPLATE" => "",
				"COMPONENT_TEMPLATE" => ".default",
				"PATH" => "/include/prefs.php"
			),
			false
		);?>
		<footer itemscope="" id="WPFooter" itemtype="https://schema.org/WPFooter">
			<div class="catalogWrapper">
				<div class="footerMenu">
					<div>
						<a href="/">
							<img src="/img/footerLogo.png">
						</a>
						<br />
						<br />
						<a href="http://blog.alpinabook.ru/" target="_blank">
							<img src="/img/footerBlogLogo.png">
						</a>
					</div>
					<div>
						<?$APPLICATION->IncludeComponent(
							"bitrix:menu",
							"bottom_menu_1",
							array(
								"ROOT_MENU_TYPE" => "bottom",
								"MAX_LEVEL" => "1",
								"CHILD_MENU_TYPE" => "top",
								"USE_EXT" => "Y",
								"DELAY" => "N",
								"ALLOW_MULTI_SELECT" => "Y",
								"MENU_CACHE_TYPE" => "Y",
								"MENU_CACHE_TIME" => "3600",
								"MENU_CACHE_USE_GROUPS" => "Y",
								"MENU_CACHE_GET_VARS" => array(
								),
								"COMPONENT_TEMPLATE" => "bottom_menu_1"
							),
							false
						);?>
						</div>
					<div>
						<?$APPLICATION->IncludeComponent(
							"bitrix:menu",
							"bottom_menu_1",
							array(
								"ROOT_MENU_TYPE" => "bottom2",
								"MAX_LEVEL" => "1",
								"CHILD_MENU_TYPE" => "top",
								"USE_EXT" => "Y",
								"DELAY" => "N",
								"ALLOW_MULTI_SELECT" => "Y",
								"MENU_CACHE_TYPE" => "Y",
								"MENU_CACHE_TIME" => "3600",
								"MENU_CACHE_USE_GROUPS" => "Y",
								"MENU_CACHE_GET_VARS" => array(
								),
								"COMPONENT_TEMPLATE" => "bottom_menu_1"
							),
							false
						);?>
						</div>
					<div>
						<?$APPLICATION->IncludeComponent(
							"bitrix:menu",
							"bottom_menu_2",
							array(
								"ROOT_MENU_TYPE" => "bottom3",
								"MAX_LEVEL" => "1",
								"CHILD_MENU_TYPE" => "top",
								"USE_EXT" => "Y",
								"DELAY" => "N",
								"ALLOW_MULTI_SELECT" => "Y",
								"MENU_CACHE_TYPE" => "Y",
								"MENU_CACHE_TIME" => "3600",
								"MENU_CACHE_USE_GROUPS" => "Y",
								"MENU_CACHE_GET_VARS" => array(
								),
								"COMPONENT_TEMPLATE" => "bottom_menu_2"
							),
							false
						);?>
					</div>
					<div>
						<?$APPLICATION->IncludeComponent(
							"bitrix:menu",
							"bottom_menu_1",
							array(
								"ROOT_MENU_TYPE" => "bottom4",
								"MAX_LEVEL" => "1",
								"CHILD_MENU_TYPE" => "top",
								"USE_EXT" => "Y",
								"DELAY" => "N",
								"ALLOW_MULTI_SELECT" => "Y",
								"MENU_CACHE_TYPE" => "N",
								"MENU_CACHE_TIME" => "3600",
								"MENU_CACHE_USE_GROUPS" => "Y",
								"MENU_CACHE_GET_VARS" => array(
								),
								"COMPONENT_TEMPLATE" => "bottom_menu"
							),
							false
						);?>
					</div>
				</div>
				<div class="footerContacts">
				<div class="yaMarket">
					<a target="_blank" href="https://clck.yandex.ru/redir/dtype=stred/pid=47/cid=2508/*https://market.yandex.ru/shop/28038/reviews?sort_by=grade">
						<img src="/img/yaImg.png">
						<p>Оценка</p>
						<p class="stars"><span><img src="/img/star.png"></span><span><img src="/img/star.png"></span><span><img src="/img/star.png"></span><span><img src="/img/star.png"></span><span><img src="/img/star.png"></span></p>
					</a>
				</div>
				<div class="adress">

					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						".default",
						array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"AREA_FILE_RECURSIVE" => "Y",
							"EDIT_TEMPLATE" => "",
							"COMPONENT_TEMPLATE" => ".default",
							"PATH" => "/include/address.php"
						),
						false
					);?>
					<div class="years">
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							".default",
							array(
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "inc",
								"AREA_FILE_RECURSIVE" => "Y",
								"EDIT_TEMPLATE" => "",
								"COMPONENT_TEMPLATE" => ".default",
								"PATH" => "/include/copyright.php"
							),
							false
						);?>
					</div>
					<a target="_blank" href="https://itunes.apple.com/app/id429622051?mt=8&&referrer=click%3Dc6b2bce4-1b6e-4b91-a143-410714207241">
						<img src="/img/appleStore.png" class="appStore">
					</a>
					<a target="_blank" href="https://play.google.com/store/apps/details?id=ru.alpina.alpina_retail&&referrer=utm_campaign%3D%2525D0%252598%2525D0%2525BC%2525D0%2525B0%2525D0%2525B3%252520%2525D0%2525BA%2525D0%2525BD%2525D0%2525BE%2525D0%2525BF%2525D0%2525BA%2525D0%2525B0%252520%2525D0%25259A%2525D1%252583%2525D0%2525BF%2525D0%2525B8%2525D1%252582%2525D1%25258C%252520%2525D0%2525B2%252520Google.Play%26utm_medium%3Dad-analytics%26utm_content%3Df89ad5b8-af21-405d-912a-178daec490c9%26utm_source%3Dflurry">
						<img src="/images/google_new_badge.png">
					</a>
				</div>
				<div class="webServ">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						".default",
						array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"AREA_FILE_RECURSIVE" => "Y",
							"EDIT_TEMPLATE" => "",
							"COMPONENT_TEMPLATE" => ".default",
							"PATH" => "/include/socnets.php"
						),
						false
					);?>
					<div id="development">
						Разработка сайта – <a href="http://www.webgk.ru/" target="_blank">WebGK</a>
					</div>
				</div>
				</div>
			</div>
		</footer>


		<div class="slidingTopMenu">
				<div class="headLogoAnchor">
				<a href="/">
					<img src="/img/alpinaLogoMini.png">
				</a>
			</div>
			<div class="headCatalog">
				<p>Каталог</p>
			</div>
			<div class="headBasket">
				<div class="BasketQuant"></div>
			</div>

			<?if(CUser::IsAuthorized()) {?>
				<a href="/personal/cart/?liked=yes">
					<div class="headLiked">
						<?
						$curr_user = CUser::GetByID($USER -> GetID()) -> Fetch();
						$user = $curr_user["NAME"]." ".$curr_user["LAST_NAME"];
						$wishItemList = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 17, "NAME" => $user), false, false, array("NAME", "ID", "PROPERTY_PRODUCTS"));
						?>
						<div class="likedQuant"><?echo($wishItemList->SelectedRowsCount());?></div>
					</div>
				</a>
			<?}?>

			<a href="/personal/profile/">
				<div class="headLogin"></div>
			</a>

			<?$APPLICATION->IncludeComponent(
	"bitrix:search.title",
	"top_search_form",
	array(
		"CATEGORY_0" => array(
			0 => "iblock_catalog",
		),
		"CATEGORY_0_TITLE" => "Результат",
		"CHECK_DATES" => "N",
		"COMPONENT_TEMPLATE" => "top_search_form",
		"CONTAINER_ID" => "title-search",
		"INPUT_ID" => "title-search-input",
		"NUM_CATEGORIES" => "1",
		"ORDER" => "rank",
		"PAGE" => "#SITE_DIR#search/index.php",
		"SHOW_INPUT" => "Y",
		"SHOW_OTHERS" => "N",
		"TOP_COUNT" => "5",
		"USE_LANGUAGE_GUESS" => "Y",
		"CATEGORY_0_iblock_catalog" => array(
			0 => "4",
		),
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
		</div>

		<div class="hidingCatalogLeft">
			<img src="/img/catalogLeftClose.png" class="windowClose">

            <a href="/personal/profile/">
                <div class="headLogin">
                </div>
            </a>

            <?$APPLICATION->IncludeComponent(
	"bitrix:search.title",
	"top_search_form",
	array(
		"CATEGORY_0" => array(
			0 => "iblock_catalog",
		),
		"CATEGORY_0_TITLE" => "Результат",
		"CHECK_DATES" => "N",
		"COMPONENT_TEMPLATE" => "top_search_form",
		"CONTAINER_ID" => "title-search",
		"INPUT_ID" => "title-search-input",
		"NUM_CATEGORIES" => "1",
		"ORDER" => "rank",
		"PAGE" => "#SITE_DIR#search/index.php",
		"SHOW_INPUT" => "Y",
		"SHOW_OTHERS" => "N",
		"TOP_COUNT" => "5",
		"USE_LANGUAGE_GUESS" => "Y",
		"CATEGORY_0_iblock_catalog" => array(
			0 => "4",
		),
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
        </div>


			<?$APPLICATION->IncludeComponent("bitrix:menu", "left_menu",
				Array(
					"ROOT_MENU_TYPE" => "left_block",    // Тип меню для первого уровня
					"MAX_LEVEL" => "1",    // Уровень вложенности меню
					"CHILD_MENU_TYPE" => "top",    // Тип меню для остальных уровней
					"USE_EXT" => "Y",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
					"DELAY" => "N",    // Откладывать выполнение шаблона меню
					"ALLOW_MULTI_SELECT" => "Y",    // Разрешить несколько активных пунктов одновременно
					"MENU_CACHE_TYPE" => "N",    // Тип кеширования
					"MENU_CACHE_TIME" => "3600",    // Время кеширования (сек.)
					"MENU_CACHE_USE_GROUPS" => "Y",    // Учитывать права доступа
					"MENU_CACHE_GET_VARS" => "",    // Значимые переменные запроса
					"COMPONENT_TEMPLATE" => "bottom_menu"
				),
				false
			);?>
			<div class="webServ">
				<a href="https://vk.com/ideabooks" target="_blank" rel="nofollow"><img src="/img/vkGrayImg.png"></a>
				<a href="https://twitter.com/AlpinaBookRu" target="_blank" rel="nofollow"><img src="/img/twitter.png"></a>
				<a href="https://www.facebook.com/alpinabook/" target="_blank" rel="nofollow"><img src="/img/fbGrayImg.png"></a>
				<a href="https://www.youtube.com/user/AlpinaPublishers" target="_blank" rel="nofollow"><img src="/img/yoGrayImg.png"></a>
				<a href="https://plus.google.com/+alpinabook?prsrc=5" target="_blank" rel="nofollow"><img src="/img/goGrayImg.png"></a>
				<a href="https://instagram.com/alpinabook" target="_blank" rel="nofollow"><img src="/img/inGrayImg.png"></a>
			</div>
		</div>


		<div class="hidingBasketRight">
		<?/*
		$APPLICATION->IncludeComponent("bitrix:sale.basket.basket", "hiding_basket", Array(
		"ACTION_VARIABLE" => "basketAction",    // Название переменной действия
		"AUTO_CALCULATION" => "Y",    // Автопересчет корзины
		"COLUMNS_LIST" => array(    // Выводимые колонки
		0 => "NAME",
		1 => "DISCOUNT",
		2 => "DELETE",
		3 => "DELAY",
		4 => "TYPE",
		5 => "PRICE",
		6 => "QUANTITY",
		),
		"CORRECT_RATIO" => "N",    // Автоматически рассчитывать количество товара кратное коэффициенту
		"GIFTS_BLOCK_TITLE" => "Выберите один из подарков",    // Текст заголовка "Подарки"
		"GIFTS_CONVERT_CURRENCY" => "N",    // Показывать цены в одной валюте
		"GIFTS_HIDE_BLOCK_TITLE" => "N",    // Скрыть заголовок "Подарки"
		"GIFTS_HIDE_NOT_AVAILABLE" => "N",    // Не отображать товары, которых нет на складах
		"GIFTS_MESS_BTN_BUY" => "Выбрать",    // Текст кнопки "Выбрать"
		"GIFTS_MESS_BTN_DETAIL" => "Подробнее",    // Текст кнопки "Подробнее"
		"GIFTS_PAGE_ELEMENT_COUNT" => "4",    // Количество элементов в строке
		"GIFTS_PLACE" => "BOTTOM",    // Вывод блока "Подарки"
		"GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",    // Название переменной, в которой передаются характеристики товара
		"GIFTS_PRODUCT_QUANTITY_VARIABLE" => "quantity",    // Название переменной, в которой передается количество товара
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",    // Показывать процент скидки
		"GIFTS_SHOW_IMAGE" => "Y",    // Показывать изображение
		"GIFTS_SHOW_NAME" => "Y",    // Показывать название
		"GIFTS_SHOW_OLD_PRICE" => "N",    // Показывать старую цену
		"GIFTS_TEXT_LABEL_GIFT" => "Подарок",    // Текст метки "Подарка"
		"HIDE_COUPON" => "N",    // Спрятать поле ввода купона
		"PATH_TO_ORDER" => "/personal/cart/",    // Страница оформления заказа
		"PRICE_VAT_SHOW_VALUE" => "N",    // Отображать значение НДС
		"QUANTITY_FLOAT" => "N",    // Использовать дробное значение количества
		"SET_TITLE" => "Y",    // Устанавливать заголовок страницы
		"TEMPLATE_THEME" => "blue",    // Цветовая тема
		"USE_ENHANCED_ECOMMERCE" => "N",    // Отправлять данные электронной торговли в Google и Яндекс
		"USE_GIFTS" => "Y",    // Показывать блок "Подарки"
		"USE_PREPAYMENT" => "N",    // Использовать предавторизацию для оформления заказа (PayPal Express Checkout)
		"COMPONENT_TEMPLATE" => ".default"
		),
		false
		);*/
		?>
		</div>
		<div class="layout"></div>
		<?if (!$USER->IsAuthorized()) {?>
		<div class="authorisationWrapper">

		<?$APPLICATION->IncludeComponent(
		"bitrix:system.auth.authorize",
		"auth_popup",
		Array(
		"REGISTER_URL" => "/",
		"PROFILE_URL" => "",
		"SHOW_ERRORS" => "Y"
		),
		false
		);?>
		</div>
		<?}?>
	</body>
</html>