<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<div class="contactsFormWrap bx_mfeedback bx_<?=$arResult["THEME"]?>">
    <?if(!empty($arResult["ERROR_MESSAGE"]))
    {
        foreach($arResult["ERROR_MESSAGE"] as $v)
            ShowError($v);
    }
    if(strlen($arResult["OK_MESSAGE"]) > 0)
    {
        ?><div class="mf-ok-text"><?=$arResult["OK_MESSAGE"]?></div><?
    }
    ?>
    <p>Обратная связь</p>
    <form action="<?=POST_FORM_ACTION_URI?>" method="POST">
        <?=bitrix_sessid_post()?>
        <input type="text" name="user_name" placeholder="Ваше имя" /><br/>

        <input type="text" name="user_email" placeholder="Ваш e-mail" /><br/>

        <input type="text" name="user_phone" placeholder="Ваш телефон" /><br/>
        
        <textarea name="MESSAGE" placeholder="Ваш вопрос" class="questInput"><?=$arResult["MESSAGE"]?></textarea><br/>

        <?if($arParams["USE_CAPTCHA"] == "Y"):?>
            <strong><?=GetMessage("MFT_CAPTCHA")?></strong><br/>
            <input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
            <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA"><br/>
            <strong><?=GetMessage("MFT_CAPTCHA_CODE")?><span class="mf-req">*</span></strong><br/>
            <input type="text" name="captcha_word" size="30" maxlength="50" value=""/><br/>
        <?endif;?>

        <input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
        <input type="submit" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>" class="bx_bt_button bx_big shadow">
    </form>
</div>