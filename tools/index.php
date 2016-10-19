<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Инструменты");
?><br>
<a href="/tools/loadToXls.php">Выгрузить подарочные купоны в .csv</a><br>
<a href="/tools/updateCertificate.php">Обновить подарочные купоны</a>
<br><br>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>