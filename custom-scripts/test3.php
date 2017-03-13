<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if ($USER->isAdmin()) {
    CModule::IncludeModule("iblock");
    if ($_POST[ids] && $_POST[status]) {
        
        $ids = explode("\n", $_POST[ids]);
        $userid = $USER->GetID();
        $status = $_POST[status];
        
        foreach ($ids as $id) {

            $arFields = array(
                "EMP_STATUS_ID" => $userid,
                "STATUS_ID" => $status
            );
            
            if (CSaleOrder::StatusOrder($id, $status)) {
                echo $id."*ok<br />";
            } else {
                echo $id."*false<br />";
            }
        }?>
        <a href="">Начать заново</a>
    <?} else {?>
        <style>
            textarea {
                resize: none;
                overflow: hidden;
                font-size: 16px;
            } 
        </style>
        <form method="post" action="/custom-scripts/test3.php">
            <p><table><tbody><tr><td style="line-height:120%;" align="right">
                1.<br />
                2.<br />
                3.<br />
                4.<br />
                5.<br />
                6.<br />
                7.<br />
                8.<br />
                9.<br />
                10.<br />
                11.<br />
                12.<br />
                13.<br />
                14.<br />
                15.<br />
                16.<br />
                17.<br />
                18.<br />
                19.<br />
                20.<br />
            </td><td><textarea rows="200" cols="5" name="ids" required></textarea></td></tr></tbody></table></p>
            <p><select size="9" name="status" required>
                <option value='A'>Аннулирован</option>
                <option value='C'>Собран</option>
                <option value='D'>Оплачен</option>
                <option value='F'>Выполнен</option>
                <option value='I'>В пути</option>
                <option value='K'>Отправлен на почту РФ</option>
                <option value='N'>Новый</option>
                <option value='O'>Обработан</option>
                <option value='P'>Недозвон</option>
            </select></p>            
            <p><input type="submit" value="Отправить"></p>
        </form>
    <?}?>
<?} else {
    echo "ошибка";
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>