<?php
$subject = "По запросу Алисы";
$header = "From: \"Вакаускайте Алиса\" <a.vakauskayte@alpinabook.ru>\n";
$header .= "Content-type: text/html; charset=\"utf-8\"";
$to = 't.razumovskaya@alpinabook.ru';
$message = '{(,)}

 ';

mail($to,$subject,$message,$header);
?>