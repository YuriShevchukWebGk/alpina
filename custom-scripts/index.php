<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if ($USER->isAdmin()) {?>
	<a target="_blank" href="/custom-scripts/alpinadigital/checkbooks.php">Добавить рекомендации к книгам AD</a><br /><br />
	<a target="_blank" href="/custom-scripts/alpinadigital/emag-ad.php">Тест одной книги AD</a><br /><br />
	<a target="_blank" href="/custom-scripts/checkdelivery/send_mails_on_time.php">Обновить статусы отправлений</a><br /><br />
	<a target="_blank" href="/custom-scripts/checkdelivery/send_mails_on_time_singleorder.php">Тест одного заказа</a><br /><br />
	<a target="_blank" href="/custom-scripts/misc/update_state.php">Обновить статусы книг</a><br /><br />
<?} else {
	echo 'error';
}
print_r(CCatalogDiscountSave::GetDiscount(array('USER_ID' => $USER->GetID())));?>