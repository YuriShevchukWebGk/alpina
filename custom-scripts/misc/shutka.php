<?
echo 2;
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    file_exists('/home/bitrix/vendor/autoload.php') ? require '/home/bitrix/vendor/autoload.php' : "";
    use Mailgun\Mailgun;
$subject = "RE: В партнерский блок";
$from = "Непряхин Никита <nepriakhin@alpinabook.ru>";

$to = 'Чанкселиани Диана <d.chankseliani@alpinabook.ru>';
$cc = 'Александр Марченков <a.marchenkov@alpinabook.ru>';

$message = 'Диана, добрый день.
<br /><br />
Разберитесь с Сашей вдвоем, пожалуйста. У него сегодня роллы на ужин.
<br /><br />

---
<br />
<b>From:</b> Диана Чанкселиани [mailto:d.chankseliani@alpinabook.ru] 
<br />
<b>Sent:</b> Friday, March 16, 2018 3:31 PM
<br />
<b>To:</b> Марченков Александр
<br />
<b>Subject:</b> Re: В партнерский блок
<br /><br />

Респект от Непряхина

';

$mailgun = new Mailgun(MAILGUN_KEY);
echo 1;
$params = array(
    'from'    => $from,
    'to'      => $to,
    'bcc'      => $cc,
    'subject' => $subject,
    'html'    => $message
);
arshow($params);
$domain = MAILGUN_DOMAIN;
$result = $mailgun->sendMessage($domain, $params, array('attachment' => ''));

?>