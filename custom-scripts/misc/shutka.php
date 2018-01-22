<?
echo 2;
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    file_exists('/home/bitrix/vendor/autoload.php') ? require '/home/bitrix/vendor/autoload.php' : "";
    use Mailgun\Mailgun;
$subject = "Проверка кулера";
$from = "Разумовская Татьяна <t.razumovskaya@alpinabook.ru>";

$to = 'Тенцер Наталья <n.tentser@alpinabook.ru>';
$cc = 'Александр Марченков <a.marchenkov@alpinabook.ru>';

$message = 'Наташа, нам похоже нужно кулер почистить';

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