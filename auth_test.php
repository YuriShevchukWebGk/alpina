<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?><?$APPLICATION->IncludeComponent(
                        "bitrix:system.auth.authorize",
                        "",
                        Array(
                            "REGISTER_URL" => "/",
                            "PROFILE_URL" => "",
                            "SHOW_ERRORS" => "Y"
                        ),
                        false
                    );?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>