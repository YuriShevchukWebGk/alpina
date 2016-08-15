<?  
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("История заказов");  
?>
<?if (!$USER->IsAuthorized()) {
    header("location: profile/"); 
} else {?>
    <?$APPLICATION->IncludeComponent(
            "bitrix:sale.personal.order", 
            "orders", 
            array(
                "SEF_MODE" => "N",
                "ORDERS_PER_PAGE" => "20",
                "PATH_TO_PAYMENT" => "/personal/order/payment/",
                "PATH_TO_BASKET" => "/personal/cart/",
                "SET_TITLE" => "N",
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
        );?><?}?> 
<script>
    $(document).ready(function(){
        $(".historyBodywrap > div").addClass("centerWrapper");
    });
</script> 

       
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
