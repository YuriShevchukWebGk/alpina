<?
// РіСЂСѓР·РёРј СЃРѕС…СЂР°РЅРµРЅРЅС‹Рµ Р±Р°РЅРєРѕРІСЃРєРёРµ РєР°СЂС‚С‹ РїРѕР»СЊР·РѕРІР°С‚РµР»СЏ, РµСЃР»Рё РѕРЅРё РµСЃС‚СЊ
global $USER;
if ($USER->GetID() && $USER->IsAuthorized()) {
    $users = CUser::GetList(
        ($by=""),
        ($order=""),
        Array(
            "ID" => $USER->GetID()
        ),
        Array(
            "SELECT" => Array("UF_RECURRENT_ID", "UF_RECURRENT_CARD_ID")
        )
    ); 
    if ($user = $users->NavNext(true, "f_")) {
        $arResult["UF_RECURRENT_CARD_ID"] = $user["UF_RECURRENT_CARD_ID"];
    }
}
?>