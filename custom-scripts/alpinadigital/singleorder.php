<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$userGroup = CUser::GetUserGroup($USER->GetID());

if ($USER->isAdmin() || $USER->GetID() == 213217 || $USER->GetID() == 217950 || in_array(6,$userGroup)) { // Заболотников Евгений
if ($_GET['orderid'] || $_GET['emailbooks']) {

if ($_GET['orderid']) {
    $ID = $_GET['orderid'];
} else {
    $ID = $_GET['orderidbooks'];
}
CModule::IncludeModule("iblock");
CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");
CModule::IncludeModule("main");

$order_list = CSaleOrder::GetByID($ID);
$allBooksUrl = '';
$bookId = '';
$recId = '';
$sendinfo = '';

$orderUser = CUser::GetByID($order_list['USER_ID'])->Fetch();
if (!empty($orderUser["UF_TEST"])) {
    $allUrlsArray = unserialize($orderUser["UF_TEST"]);
} else {
    $allUrlsArray = array();
}
$dbBasketItems = CSaleBasket::GetList(array(), array("ORDER_ID" => $ID), false, false, array());

$ids = '';
while ($arItems = $dbBasketItems->Fetch()) {
    $ids .= $arItems["PRODUCT_ID"].',';
}
$ids = substr($ids,0,-1);

if ($_GET['booksid']) {
    $ids = $_GET['booksid'];
}

$products = getUrlForFreeDigitalBook($ids);

if ($products['url'] != 'error') {
    $allUrlsArray[] = array("orderid" => $ID, "products" => $products);
    
    $sendinfo .= '<ol>';
    
    foreach($products['products'] as $product) {
        if ($product['status'] == 'ok') {
            $sendinfo .= '<li style="padding-top:5px;">'.$product['name'].'</li>';
        } else {
            $sendinfo .= '<li style="padding-top:5px;">Вместо книги «'.$product['name'].'», которой нет в наличии, мы дарим вам книгу «'.$product['recname'].'»</li>';
        }
    }
    
    $sendinfo .= '</ol>';
    
    $links = serialize($allUrlsArray);

    $fieldsGend = Array(
        "UF_TEST"                        => $links
    );
    $userGend = new CUser;
  //  $userGend->Update($order_list['USER_ID'], $fieldsGend);
    
    $freeurl = $products['url'];
    if ($_GET['emailbooks']) {
        $useremail = $_GET['emailbooks'];
    } else {
        $useremail = Message::getClientEmail($ID);
        if (empty($useremail)) {
            function getClientEmail($id) {
                $db_props = CSaleOrderPropsValue::GetOrderProps($id);
                while ($arProps = $db_props->Fetch()) {
                    if ($arProps['CODE']=='F_EMAIL') {
                        return $arProps["VALUE"];
                    }
                }
            }
            $useremail = getClientEmail($ID);
        }
    }
    if (empty($useremail)) 
        $useremail = 'shop@alpinabook.ru';
    
} else {
    $freeurl = 'К сожалению, произошла ошибка. В ближайшее время специалист свяжется с вами и поможет получить бесплатные книги.';
    $useremail = 'shop@alpinabook.ru';
}
$mailFields = array(
    //"EMAIL" => "a-marchenkov@yandex.ru, a.limansky@alpina.ru, t.razumovskaya@alpinabook.ru, karenshain@gmail.com, sarmat2012@yandex.ru",
    "EMAIL"=> $useremail,
    "TEXT" => $sendinfo,
    "URL" => $freeurl,
    "ORDER_ID" => $ID,
    "ORDER_USER"=> Message::getClientName($ID)
);

if (CEvent::Send("FREE_DIGITAL_BOOKS", "s1", $mailFields, "N")) {?>
    <div style="font-size:40px;margin:200px auto 0;">
    <center>ok - <?=$_GET['orderid']?><br /><br />
    <form action="/custom-scripts/alpinadigital/singleorder.php">
    <input type="text" name="orderid" value="" placeholder="Номер заказа" style="font-size:40px;"><br /><br />
    <input type="submit" value="Отправить бесплатные книги" style="font-size:40px;">
    </form></center>
    </div>
    <?//arshow($products);
   // arshow($mailFields)?>
<?} else {
    echo 'error';
}

} else {?>
    <form action="/custom-scripts/alpinadigital/singleorder.php">
    <input type="text" name="orderid" value="" placeholder="Номер заказа">
    <input type="submit" value="Отправить бесплатные книги">
    </form>
    <br /><br />
    
    <form action="/custom-scripts/alpinadigital/singleorder.php">
    <input type="text" name="orderidbooks" value="" placeholder="Номер заказа" required><br />
    <input type="text" name="emailbooks" value="" placeholder="Email" required><br />
    <textarea type="text" name="booksid" value="" rows="20" cols="45" required placeholder="Id книг через запятую без пробелов"></textarea><br /><br />
    <input type="submit" value="Отправить книги">
    </form>        
<?
}
} else {
    echo "authorize";
}

?>