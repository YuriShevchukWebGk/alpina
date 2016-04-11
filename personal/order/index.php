<?  
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");
global $USER;
if (!$USER->IsAuthorized()) {header("location: /auth/");}
?>     
<div class="historyCoverWrap">
    <div class="centerWrapper">
        <p>Главная</p>    
        <h1>Личный кабинет</h1>
    </div>
</div>

<div class="historyBodywrap">
    <div class="centerWrapper">
        <div class="orderHistorWrap">

            <?$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.order", 
	"orders", 
	array(
		"SEF_MODE" => "N",
		"ORDERS_PER_PAGE" => "20",
		"PATH_TO_PAYMENT" => "/personal/order/payment/",
		"PATH_TO_BASKET" => "/personal/cart/",
		"SET_TITLE" => "Y",
		"PROP_3" => "",
		"PROP_1" => array(
		),
		"PROP_2" => array(
		),
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SEF_FOLDER" => "/personal/order/",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "3600",
		"CACHE_GROUPS" => "N",
		"SAVE_IN_SESSION" => "N",
		"NAV_TEMPLATE" => "",
		"CUSTOM_SELECT_PROPS" => array(
		),
		"HISTORIC_STATUSES" => array(
			0 => "z",
		),
		"STATUS_COLOR_N" => "green",
		"STATUS_COLOR_C" => "gray",
		"STATUS_COLOR_E" => "gray",
		"STATUS_COLOR_P" => "yellow",
		"STATUS_COLOR_W" => "gray",
		"STATUS_COLOR_A" => "gray",
		"STATUS_COLOR_I" => "gray",
		"STATUS_COLOR_F" => "gray",
		"STATUS_COLOR_B" => "gray",
		"STATUS_COLOR_R" => "gray",
		"STATUS_COLOR_O" => "gray",
		"STATUS_COLOR_z" => "gray",
		"STATUS_COLOR_D" => "gray",
		"STATUS_COLOR_PSEUDO_CANCELLED" => "red",
		"COMPONENT_TEMPLATE" => "orders",
		"STATUS_COLOR_K" => "gray"
	),
	false
);?> 
        </div>   
        <div class="historyMenuWrap">
            <ul>
                <li>
                    <a href="/personal/">персональные данные</a>
                </li>
                <li>
                    <a href="/personal/order" class="active">история заказов</a>
                </li>
                <li>
                    <a href="/personal/wishlist">список желаемых покупок</a>
                </li>
                <li>
                    <a href="/personal/change_pw">сменить пароль</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $("body").addClass("historyBodyWr");
});
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>