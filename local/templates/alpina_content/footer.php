    <footer>
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
                    <!--<p>Об группе компаний</p>
                    <p>Алфавитный указатель авторов</p>
                    <p>Партнерская программа</p>-->
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
                                "MENU_CACHE_TYPE" => "N",
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
                    <!--<P>Доставка</P>
                    <P>Оплата</P>
                    <P>Как заказать</P>-->
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
                <div>
                    <!--<p>Где купить</p>
                    <p>В2В</p>
                    <p>E-learning</p>-->
                    <?$APPLICATION->IncludeComponent(
                            "bitrix:menu", 
                            "bottom_menu_1", 
                            array(
                                "ROOT_MENU_TYPE" => "bottom3",
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
                <div>
                    <!--<p>Мероприятия</p>
                    <p>Контакты</p>-->
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
                    <!--<p class="adres">Москва, 4-я Магистральная улица, д.5, 2 подъезд, 2 этаж</p>
                    <p class="adres">+7 (495) 980 80 77 shop@alpinabook.ru</p>-->
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
                    <div class="years"><!--© 2000-2015, ООО "Альпина Паблишер"-->
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
                        <img src="/img/googlePlay.png">
                    </a>
                </div>
                <div class="webServ">
                    <a href="http://vk.com/ideabooks" target="_blank" rel="nofollow"><img src="/img/vkImg.png"></a>
                    <a href="https://twitter.com/AlpinaBookRu" target="_blank" rel="nofollow"><img src="/img/twitterImg.png"></a>
                    <a href="https://www.facebook.com/alpinabook/" target="_blank" rel="nofollow"><img src="/img/fbImg.png"></a>
                    <a href="http://www.youtube.com/user/AlpinaPublishers" target="_blank" rel="nofollow"><img src="/img/youImg.png"></a>
                    <a href="https://plus.google.com/+alpinabook?prsrc=5" target="_blank" rel="nofollow"><img src="/img/googImg.png"></a>
                    <a href="http://instagram.com/alpinabook" target="_blank" rel="nofollow"><img src="/img/instImg.png"></a>
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
            <div class="BasketQuant">
            </div>
        </div>
        <a href="/personal/profile/">
            <div class="headLogin">
            </div>
        </a>
        <!--<div class="headFind">
        <input type="text" placeholder="Поиск">-->
        <?$APPLICATION->IncludeComponent("bitrix:search.title", "top_search_form", 
                Array(
                    "CATEGORY_0" => "",    // Ограничение области поиска
                    "CATEGORY_0_TITLE" => "",    // Название категории
                    "CHECK_DATES" => "N",    // Искать только в активных по дате документах
                    "COMPONENT_TEMPLATE" => ".default",
                    "CONTAINER_ID" => "title-search-top",    // ID контейнера, по ширине которого будут выводиться результаты
                    "INPUT_ID" => "title-search-input-top",    // ID строки ввода поискового запроса
                    "NUM_CATEGORIES" => "1",    // Количество категорий поиска
                    "ORDER" => "date",    // Сортировка результатов
                    "PAGE" => "#SITE_DIR#search/index.php",    // Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
                    "SHOW_INPUT" => "Y",    // Показывать форму ввода поискового запроса
                    "SHOW_OTHERS" => "N",    // Показывать категорию "прочее"
                    "TOP_COUNT" => "5",    // Количество результатов в каждой категории
                    "USE_LANGUAGE_GUESS" => "Y",    // Включить автоопределение раскладки клавиатуры
                ),
                false
            );?>
        <!--</div>-->    
    </div>    

    <div class="hidingCatalogLeft">
        <img src="/img/catalogLeftClose.png" class="windowClose">    
        <!--<ul class="categories">
        <li><p>Книги фонда династия</p></li>
        <li><p>Ежедневиники. Метод Глеба Архангельского</p></li>
        <li><p>Выход есть: антикризисные книги</p></li>
        <li><p>Бизнес</p></li>
        <li><p>Популярная психология</p></li>
        <li><p>Здоровье, йога, красота</p></li>
        <li><p>Путешествия</p></li>
        <li><p>Книги фонда династия</p></li>
        <li><p>Книги для родителей</p></li>
        <li><p>Путешествия</p></li>
        </ul>-->
        <?$APPLICATION->IncludeComponent(
                "bitrix:catalog.section.list", 
                "left.tree", 
                array(
                    "IBLOCK_TYPE" => "catalog",
                    "IBLOCK_ID" => "4",
                    "SECTION_ID" => "",
                    "SECTION_CODE" => "",
                    "COUNT_ELEMENTS" => "N",
                    "TOP_DEPTH" => "2",
                    "IBLOCK_HEADER_TITLE" => "Каталог книг",
                    "IBLOCK_HEADER_LINK" => "",
                    "SECTION_URL" => "#SITE_DIR#/catalog/#SECTION_CODE#/",
                    "CACHE_TYPE" => "N",
                    "CACHE_TIME" => "3600",
                    "DISPLAY_PANEL" => "N",
                    "ADD_SECTIONS_CHAIN" => "Y",
                    "COMPONENT_TEMPLATE" => "left.tree",
                    "SECTION_FIELDS" => array(
                        0 => "",
                        1 => "",
                    ),
                    "SECTION_USER_FIELDS" => array(
                        0 => "",
                        1 => "",
                    ),
                    "CACHE_GROUPS" => "N",
                    "VIEW_MODE" => "LIST",
                    "SHOW_PARENT_NAME" => "Y"
                ),
                false
            );?>
        <!--<ul class="menuCopy">
        <li>Оплата</li>
        <li>Доставка</li>
        <li>Скидки</li>
        <li>Где мой заказ?</li>
        <li>Контакты</li>
        </ul>-->
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
            <a href="http://vk.com/ideabooks" target="_blank" rel="nofollow"><img src="/img/vkGrayImg.png"></a>
            <a href="https://twitter.com/AlpinaBookRu" target="_blank" rel="nofollow"><img src="/img/twitter.png"></a>
            <a href="https://www.facebook.com/alpinabook/" target="_blank" rel="nofollow"><img src="/img/fbGrayImg.png"></a>
            <a href="http://www.youtube.com/user/AlpinaPublishers" target="_blank" rel="nofollow"><img src="/img/yoGrayImg.png"></a>
            <a href="https://plus.google.com/+alpinabook?prsrc=5" target="_blank" rel="nofollow"><img src="/img/goGrayImg.png"></a>
            <a href="http://instagram.com/alpinabook" target="_blank" rel="nofollow"><img src="/img/inGrayImg.png"></a>  
        </div>
    </div>

    <!--<div class="hidingBasketRight">
    <img src="/img/catalogLeftClose.png" class="windowClose">
    <p class="title">Корзина</p>
    <p class="bonus">Вам не хватает 770 руб. до получения скидки в 10%</p>
    <div class="basketBooks">
    <div class="basketBook">
    <div class="bookImage"><img src="/img/leftHideBook1.png"></div>
    <div>
    <p class="bookNameBask">Черная риторика: Власть и магия сл...</p>
    <p class="bookPrice">590 руб.</p>
    <div class="countMenu">
    <p class="countOfBook">1</p>
    <a href="#" class="plus"></a>
    <a href="#" class="minus"></a>        
    </div>

    </div>
    </div>    
    <div class="basketBook">
    <div class="bookImage"><img src="/img/leftHideBook1.png"></div>
    <div>
    <p class="bookNameBask">Черная риторика: Власть и магия сл...</p>
    <p class="bookPrice">590 руб.</p>
    <div class="countMenu">
    <p class="countOfBook">1</p>
    <a href="#" class="plus"></a>
    <a href="#" class="minus"></a>        
    </div>

    </div>
    </div>    
    <div class="basketBook">
    <div class="bookImage"><img src="/img/leftHideBook1.png"></div>
    <div>
    <p class="bookNameBask">Черная риторика: Власть и магия сл...</p>
    <p class="bookPrice">590 руб.</p>
    <div class="countMenu">
    <p class="countOfBook">1</p>
    <a href="#" class="plus"></a>
    <a href="#" class="minus"></a>        
    </div>

    </div>
    </div>    
    <div class="basketBook">
    <div class="bookImage"><img src="/img/leftHideBook1.png"></div>
    <div>
    <p class="bookNameBask">Черная риторика: Власть и магия сл...</p>
    <p class="bookPrice">590 руб.</p>
    <div class="countMenu">
    <p class="countOfBook">1</p>
    <a href="#" class="plus"></a>
    <a href="#" class="minus"></a>        
    </div>

    </div>
    </div>    
    <div class="basketBook">
    <div class="bookImage"><img src="/img/leftHideBook1.png"></div>
    <div>
    <p class="bookNameBask">Черная риторика: Власть и магия сл...</p>
    <p class="bookPrice">590 руб.</p>
    <div class="countMenu">
    <p class="countOfBook">1</p>
    <a href="#" class="plus"></a>
    <a href="#" class="minus"></a>        
    </div>

    </div>
    </div>    
    </div>

    <div class="bottomBlock">
    <div class="result">
    <p class="resultText">Итого</p>
    <p class="count">Кол-во:4</p>
    <p class='price'>2230 <span>руб.</span></p>
    </div>
    <div class="confirm">
    <p>Оформить заказ</p>
    </div>
    </div>
    </div> -->
    <div class="hidingBasketRight">
        <?
            $APPLICATION->IncludeComponent("bitrix:sale.basket.basket.small", "hiding_basket", Array(
                "PATH_TO_BASKET" => "/personal/basket.php",    // Страница корзины
                "PATH_TO_ORDER" => "/personal/order.php",    // Страница оформления заказа
                "SHOW_DELAY" => "Y",    // Показывать отложенные товары
                "SHOW_NOTAVAIL" => "Y",    // Показывать товары, недоступные для покупки
                "SHOW_SUBSCRIBE" => "Y",    // Показывать товары, на которые подписан покупатель
                ),
                false
            );
        ?>
    </div>
    <div class="layout"></div>
    <?if (!$USER->IsAuthorized())
        {?>
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