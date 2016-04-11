<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    CModule::IncludeModule("sale"); CModule::IncludeModule("catalog"); CModule::IncludeModule("iblock");
?>
<?
if ($_REQUEST["login"])
{
    /*$user = CUser::GetByLogin($_REQUEST["login"]);
    if ($user_fetch = $user -> Fetch())
    {
        arshow($user_fetch);
    } */
     $remember = "Y";
     $arAuthResult = $USER->Login($_REQUEST["login"], $_REQUEST["password"], $remember);
    //$APPLICATION->arAuthResult = $arAuthResult;
     if ($arAuthResult !== true)
     {
         echo "Авторизоваться не удалось. Неверно указан логин и/или пароль.";
     }
     else
     {
         echo "SUCCESS";
     }
}
?>