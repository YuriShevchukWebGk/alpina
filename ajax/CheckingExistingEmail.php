<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    CModule::IncludeModule("sale"); CModule::IncludeModule("catalog"); CModule::IncludeModule("iblock");
?>
<?
if ($_REQUEST["email"])
{
    $user_list = CUser::GetList (($by="ID"), ($order="desc"), array ("EMAIL" => $_REQUEST["email"]));
    while ($user_fetch = $user_list -> Fetch())
    {
        $arUsers[] = $user_fetch;    
    }
    
    if (count($arUsers) == 1)
    {
        $login = 'newuser_'.$_REQUEST["email"];
    }
    else if (count($arUsers)>1) 
    {
        $login = 'newuser_'.count($arUsers).'_'.$_REQUEST["email"];
    }
    echo $login;
}
?>