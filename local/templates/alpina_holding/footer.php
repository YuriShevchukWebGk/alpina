<footer>
    <div class="catalogWrapper">
        <div class="footerOverLine">
            <?$APPLICATION->IncludeComponent(
                "bitrix:menu",
                "footer_menu",
                Array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "left",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "1",
                    "MENU_CACHE_GET_VARS" => array(""),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "left",
                    "USE_EXT" => "N"
                )
            );?>
            <div class="footerInlineInfo">
            <?$APPLICATION->IncludeComponent(
	"bitrix:main.include", 
	".default", 
	array(
		"AREA_FILE_RECURSIVE" => "Y",
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => "/include/footer_text.php",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
            </div>
        </div>
        <div class="footerUnderLine">
            <div class ="footerImageLinks">
                <div class ="footerImage">
                    <a href="/">
                        <img src="/img/footerLogo.png">
                    </a>
                </div>
                <div class="footerImage">
                    <a href="http://blog.alpinabook.ru/" target="_blank">
                        <img src="/img/footerBlogLogo.png">
                    </a>                
                </div>
                <div class="yaMarket">
                    <a target="_blank" href="https://clck.yandex.ru/redir/dtype=stred/pid=47/cid=2508/*https://market.yandex.ru/shop/28038/reviews?sort_by=grade">
                        <img src="/img/yaImg.png">
                        <p>Оценка</p>
                        <p class="stars"><span><img src="/img/star.png"></span><span><img src="/img/star.png"></span><span><img src="/img/star.png"></span><span><img src="/img/star.png"></span><span><img src="/img/star.png"></span></p>        
                    </a>
                </div>
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
    </body>
</html>