<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

/**
 * @var array $arParams
 */

CUtil::InitJSCore(array("popup"));

$arAuthServices = $arPost = array();
if(is_array($arParams["~AUTH_SERVICES"]))
{
	$arAuthServices = $arParams["~AUTH_SERVICES"];
}
if(is_array($arParams["~POST"]))
{
	$arPost = $arParams["~POST"];
}

$hiddens = "";
foreach($arPost as $key => $value)
{
	if(!preg_match("|OPENID_IDENTITY|", $key))
	{
		$hiddens .= '<input type="hidden" name="'.$key.'" value="'.$value.'" />'."\n";
	}
}
?>
<script type="text/javascript">
function BxSocServPopup(id)
{
	var content = BX("bx_socserv_form_"+id);
	if(content)
	{
		var popup = BX.PopupWindowManager.create("socServPopup"+id, BX("bx_socserv_icon_"+id), {
			autoHide: true,
			closeByEsc: true,
			angle: {offset: 24},
			content: content,
			offsetTop: 3
		});

		popup.show();

		var input = BX.findChild(content, {'tag':'input', 'attribute':{'type':'text'}}, true);
		if(input)
		{
			input.focus();
		}

		var button = BX.findChild(content, {'tag':'input', 'attribute':{'type':'submit'}}, true);
		if(button)
		{
			button.className = 'btn btn-primary';
		}
	}
}
</script>

<div class="bx-authform-social">
	<ul>
<?
foreach($arAuthServices as $service):
	$onclick = ($service["ONCLICK"] <> ''? $service["ONCLICK"] : "BxSocServPopup('".$service["ID"]."')");
?>
        <li style="width:100%;">
            <a id="bx_socserv_icon_<?=$service["ID"]?>" style="margin:0 auto;" class="<?=$service["ICON"]?> bx-authform-social-icon" href="javascript:void(0)" onclick="<?=htmlspecialcharsbx($onclick)?>" title="<?=htmlspecialcharsbx($service["NAME"])?>"><?= GetMessage("LOG_IN") ?></a>
    <?if($service["ONCLICK"] == '' && $service["FORM_HTML"] <> ''):?>
            <div id="bx_socserv_form_<?=$service["ID"]?>" class="bx-authform-social-popup">
                <form action="<?=$arParams["AUTH_URL"]?>" method="post">
                    <?=$service["FORM_HTML"]?>
                    <?=$hiddens?>
                    <input type="hidden" name="auth_service_id" value="<?=$service["ID"]?>" />
                </form>
            </div>
    <?endif?>
        </li>
		<li style="width:100%;">
            <?
            $client_id = '826413122112-3083kfgkelgpn9ejqi7fcrmj1r3oml7c.apps.googleusercontent.com'; // Client ID
            $client_secret = 'X248g0y3al_3Tpa29Z74KyHf'; // Client secret
            $redirect_uri = 'https://www.alpinabook.ru/custom-scripts/ga/oauth2callback.php'; // Redirect URI

            $url = 'https://accounts.google.com/o/oauth2/auth';

            $params = array(
                'redirect_uri'  => $redirect_uri,
                'response_type' => 'code',
                'client_id'     => $client_id,
                'scope'         => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile'
            );
            // echo $link = '<p><a href="javascript:void(0)" onclick="BX.util.popup(\''. $url . '?' . urldecode(http_build_query($params)) . '\', 680, 600)">Аутентификация через Google</a></p>';

             echo $link = '<p><a class="google_auth" href="' . $url . '?' . urldecode(http_build_query($params)) . '">Войти</a></p>';

            ?>
		</li>
<?
endforeach;
?>
	</ul>
</div>
