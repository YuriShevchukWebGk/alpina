<?
    require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/.config.php");

    CModule::IncludeModule("blog");
    CModule::IncludeModule("iblock");
    CModule::IncludeModule("sale");
    CModule::IncludeModule("catalog");
    CModule::IncludeModule("main");
    use Bitrix\Main;
    use Bitrix\Main\Loader;
    use Bitrix\Main\Localization\Loc;
    use Bitrix\Sale\Internals;

    // ID раздела подборок на главной - из каталога книг
    define ("MAIN_PAGE_SELECTIONS_SECTION_ID", 209);
    define ("CATALOG_IBLOCK_ID", 4);
    define ("AUTHORS_IBLOCK_ID", 29);
    define ("REVIEWS_IBLOCK_ID", 24);
    define ("SPONSORS_IBLOCK_ID", 47);
    define ("WISHLIST_IBLOCK_ID", 17);
    define ("EXPERTS_IBLOCK_ID", 23);
    define ("SERIES_BANNERS_IBLOCK_ID", 54); // 53 - для тестовой копии
    define ("INFO_MESSAGES_IBLOCK_ID", 53); // 52 - для тестовой копии
    define ("NEW_BOOK_STATE_XML_ID", 21);
    define ("BESTSELLER_BOOK_XML_ID", 285);
    define ("COVER_TYPE_SOFTCOVER_XML_ID", 168);
    define ("COVER_TYPE_HARDCOVER_XML_ID", 169);
    define ("RFI_PAYSYSTEM_ID", 13);

    /***************
    *
    * получение ID значения свойства "Состояние" из символьного кода этого значения
    *
    * @param int $iblockId - инфоблок, содержащий свойство
    * @param string $propCode - символьный код свойства
    * @param string $propXmlId - символьный код значения свойства
    *
    ***************/

    function getXMLIDByCode ($iblockId, $propCode, $propXmlId) {
        $iblockProps = CIBlockPropertyEnum::GetList (array(), array("IBLOCK_ID" => $iblockId, "CODE" => $propCode, "XML_ID" => $propXmlId));
        while ($iblockStateProp = $iblockProps -> Fetch()) {
            return $iblockStateProp["ID"];
        }
    }

    function arshow($array, $adminCheck = false){
        global $USER;
        $USER = new Cuser;
        if ($adminCheck) {
            if (!$USER->IsAdmin()) {
                return false;
            }
        }
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }
    function morph($n, $f1, $f2, $f5) {
        $n = abs(intval($n)) % 100;
        if ($n>10 && $n<20) return $f5;
        $n = $n % 10;
        if ($n>1 && $n<5) return $f2;
        if ($n==1) return $f1;
        return $f5;
    }
    function searchNum2Str($num) {
        $nul='ноль';
        $ten=array(
            array('','одна','две','три','четыре','пять','шесть','семь', 'восемь','девять'),
            array('','один','два','три','четыре','пять','шесть','семь', 'восемь','девять')
        );
        $a20=array('десять','одиннадцать','двенадцать','тринадцать','четырнадцать' ,'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать');
        $tens=array(2=>'двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят' ,'восемьдесят','девяносто');
        $hundred=array('','сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот','восемьсот','девятьсот');
        $unit=array( // Units
            //array('копейка' ,'копейки' ,'копеек',     1),
            //array('рубль'   ,'рубля'   ,'рублей'    ,0),
            array('тысяча'  ,'тысячи'  ,'тысяч'     ,-1),
            array('миллион' ,'миллиона','миллионов' ,0),
            array('миллиард','милиарда','миллиардов',0),
        );
        //
        $number = sprintf("%012u", floatval($num));
        $out = array();
        if (intval($number)>0) {
            foreach(str_split($number,3) as $uk=>$v) { // by 3 symbols
                if (!intval($v)) continue;
                $uk = sizeof($unit)-$uk-1; // unit key
                $gender = $unit[$uk][3];
                list($i1,$i2,$i3) = array_map('intval',str_split($v,1));
                // mega-logic
                $out[] = $hundred[$i1]; # 1xx-9xx
                if ($i2>1) $out[]= $tens[$i2].' '.$ten[$gender+1][$i3]; # 20-99
                else $out[]= $i2>0 ? $a20[$i3] : $ten[$gender+1][$i3]; # 10-19 | 1-9
                // units without rub & kop
                if ($uk>-2) $out[]= morph($v,$unit[$uk][0],$unit[$uk][1],$unit[$uk][2]);
            } //foreach
        }
        else $out[] = $nul;
        return trim(preg_replace('/ {2,}/', ' ', join(' ',$out)));
    }
    //Create gift coupon after buy certificate
    AddEventHandler("sale", "OnOrderAdd", Array("Certificate", "GenerateGiftCoupon"));
    class Certificate {
        function GenerateGiftCoupon($ID, $arFields)
        {
            GLOBAL $APPLICATION;
            //Get gift certificate
            $db_res = CIBlockElement::GetList(Array("ID" => "ASC"),  Array("SECTION_ID" => "143"), false);
            while ($ar_res = $db_res->Fetch()) {
                $arDiscounts[$ar_res["ID"]]=$ar_res;
            }
            //Get items from order
            $dbItemsInOrder = CSaleBasket::GetList(array("ID" => "ASC"), array("FUSER_ID" => CSaleBasket::GetBasketUserID(),"DELAY"=>'N', 'CAN_BUY'=>'Y', "ORDER_ID" => NULL));

            while ($arItemsInOrder = $dbItemsInOrder->Fetch()) {
                $arItems[$arItemsInOrder["PRODUCT_ID"]]=$arItemsInOrder;
                for ($x=0; $x<$arItemsInOrder["QUANTITY"]; $x++) {
                    if (in_array($arItemsInOrder["PRODUCT_ID"], array_keys($arDiscounts))) {

                        $dID=preg_replace("/[^0-9]/", '', $arDiscounts[$arItemsInOrder["PRODUCT_ID"]]["EXTERNAL_ID"]);
                        //Create coupon
                        Loader::includeModule('sale');
                        $couponTypeList = Internals\DiscountCouponTable::getCouponTypes(true);
                        $fields['DISCOUNT_ID'] = $dID;
                        $fields['COUPON'] = CatalogGenerateCoupon();
                        $fields['ACTIVE'] = "Y";
                        $fields['TYPE'] = 2;
                        $fields['MAX_USE'] = 1;
                        $result = Internals\DiscountCouponTable::add($fields);
                        $array =  (array) $result;

                        //Write in infoblock
                        $arFields = array(
                            "ACTIVE" => "Y",
                            "IBLOCK_ID" => 20,
                            "NAME" => $arDiscounts[$arItemsInOrder["PRODUCT_ID"]]["NAME"],
                            "PROPERTY_VALUES" => array(
                                "ORDER" => $ID,
                                "COUPON" => current($array),
                                "CODE" => $fields['COUPON'],
                                "SEND" => "N"
                            )
                        );
                        $oElement = new CIBlockElement();
                        $idElement = $oElement->Add($arFields, false, false, true);
                    }
                }
            }
        }
    }

    //обработка статусов заказа при получении оплаты
    AddEventHandler('sale', 'OnSalePayOrder', "UpdOrderStatus");
    function UpdOrderStatus ($ID, $val) {
        $arStatus = array("D", "K", "F"); //статусы заказа "оплачен", "отправлен на почту" РФ и "выполнен"
        //при получении оплаты
        if ($val == "Y") {
            $order = CSaleOrder::GetById($ID);
            //если текущий статус закана - не один из трех вышеперечисленных, ставим статус "оплачен"
            if (!in_array($order["STATUS_ID"],$arStatus)) {
                CSaleOrder::StatusOrder($ID, "D");
            }
        }
    }

    //обработка флага оплаты, при изменении статусов заказа
    AddEventHandler('sale', 'OnSaleStatusOrder', "UpdPaymentFlag");
    function UpdPaymentFlag ($ID, $val) {
        $arStatus = array("D", "K", "F"); //статусы заказа "оплачен", "отправлен на почту" РФ и "выполнен"
        //если установлен один из вышеуказанных статусов
        if (in_array($val,$arStatus)) {
            $order = CSaleOrder::GetById($ID);
            //если флаг оплаты не стоит - ставим
            if ($order["PAYED"] != "Y") {
                CSaleOrder::PayOrder($ID, "Y", false, false, 0);
            }
        }
    }


    //Create gift coupon after buy certificate
    AddEventHandler("sale", "OnSalePayOrder", "SendCouponAfterPay");
    function SendCouponAfterPay($ID, $val)
    {
        $IBLOCK_ID=20;
        if ($val=='Y') {
            GLOBAL $APPLICATION;
            //Get gift certificate
            $db_res = CIBlockElement::GetList(Array("ID" => "ASC"),  Array("SECTION_ID" => "143", "ACTIVE" => 'Y'), false);
            while ($ar_res = $db_res->Fetch()) {
                $arDiscounts[$ar_res["ID"]]=$ar_res;
            }

            //Get items from order
            $dbItemsInOrder = CSaleBasket::GetList(array("ID" => "ASC"), array("ORDER_ID" => $ID));
            while ($arItemsInOrder = $dbItemsInOrder->Fetch()) {
                $arItems[$arItemsInOrder["PRODUCT_ID"]]=$arItemsInOrder;
                if (in_array($arItemsInOrder["PRODUCT_ID"], array_keys($arDiscounts))) {
                    $dbDis = CIBlockElement::GetList(Array("ID" => "ASC"),  Array("IBLOCK_ID" => $IBLOCK_ID, "ORDER" => $ID), false);
                    while ($arDis = $dbDis->Fetch()) {
                        $db_props = CIBlockElement::GetProperty($IBLOCK_ID, $arDis["ID"], array("sort" => "asc"), Array("CODE"=>"ORDER"));
                        if($ar_props = $db_props->Fetch()){
                            if($ar_props["VALUE"]==$ID){
                                $db_prop = CIBlockElement::GetProperty($IBLOCK_ID, $arDis["ID"], array("sort" => "asc"), Array("CODE"=>"SEND"));
                                if($ar_prop = $db_prop->Fetch()){
                                    if($ar_prop["VALUE"]=='N') {
                                        $dbprop = CIBlockElement::GetProperty($IBLOCK_ID, $arDis["ID"], array("sort" => "asc"), Array("CODE"=>"COUPON"));
                                        if($arprop = $dbprop->Fetch()){

                                            $filter=array('=ID' => $arprop["VALUE"]);

                                            $discountIterator = Internals\DiscountCouponTable::getList(array(
                                                'select' => array('ID', 'COUPON'),
                                                'filter' => $filter
                                            ));
                                            $arCoupon = $discountIterator->fetch();
                                            $dbpr = CSaleOrderPropsValue::GetOrderProps($ID);

                                            $EMAIL = "";
                                            while ($arProps = $dbpr->Fetch())        {
                                                if($arProps["CODE"] == "EMAIL")   {
                                                    $EMAIL = $arProps["VALUE"];
                                                }
                                            }
                                            //form date of activity certificate
                                            $couponTypeList = Internals\DiscountCouponTable::getCouponTypes(true);
                                            $active_from= date('d.m.Y G:i:s');
                                            $active_to=date('d.m.Y G:i:s', strtotime(date('d.m.Y G:i:s').'+6 month'));

                                            $arEventFields = array(
                                                "EMAIL_TO" => $EMAIL,
                                                "CODE_CERTIFICATE" => $arCoupon["COUPON"],
                                                "ACTIVE_FROM" => $active_from,
                                                "ACTIVE_TO" => $active_to
                                            );
                                            $arrSITE =  CAdvContract::GetSiteArray($CONTRACT_ID);
                                            CEvent::Send("SEND_GIFT_CERTIFICATE", "s1", $arEventFields, 'Y', "164");

                                            //when send mail coupon active six months
                                            $fields['ACTIVE_FROM'] = \Bitrix\Main\Type\DateTime::createFromUserTime($active_from);
                                            $fields['ACTIVE_TO'] = \Bitrix\Main\Type\DateTime::createFromUserTime($active_to);
                                            $result = Internals\DiscountCouponTable::update($arCoupon["ID"], $fields);

                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    //Work of custom coupon
    AddEventHandler("sale", "OnOrderAdd", Array("changeOrderPrice", "OnOrderCustomCouponHandler"));
    class changeOrderPrice
    {
        function OnOrderCustomCouponHandler($arFields)
        {
            $arOrder = CSaleOrder::GetByID($arFields);
            if ($_SESSION["CUSTOM_COUPON"]["DEFAULT_COUPON"]=="N")  {
                $newPrice = $arOrder["PRICE"] - $arOrder["DISCOUNT_VALUE"] - (float)$_SESSION["CUSTOM_COUPON"]["COUPON_VALUE"];

                if ($newPrice<0) {
                    $newPrice=0;
                }
                $newPrice = $newPrice + $arOrder["PRICE_DELIVERY"];
                $newFields = array(
                    "PRICE" => $newPrice
                );
                CSaleOrder::Update($arFields, $newFields);
                //Update coupon
                Loader::includeModule('sale');
                $couponTypeList = Internals\DiscountCouponTable::getCouponTypes(true);
                $fields['ACTIVE'] = "N";
                $result = Internals\DiscountCouponTable::update($_SESSION["CUSTOM_COUPON"]["COUPON_ID"], $fields);
                unset ($_SESSION["CUSTOM_COUPON"]);
            }
        }
    }

    // склонение существительных после чисел (например - товар, товара, товаров)

    function format_by_count($count, $form1, $form2, $form3)
    {
        $count = abs($count) % 100;
        $lcount = $count % 10;
        if ($count >= 11 && $count <= 19) return($form3);
        if ($lcount >= 2 && $lcount <= 4) return($form2);
        if ($lcount == 1) return($form1);
        return $form3;
    }

    AddEventHandler('iblock', 'OnAfterIBlockElementAdd', "my_OnAfterIBlockElementAdd");

    function my_OnAfterIBlockElementAdd(&$arFields)
    {
        if ($arFields["IBLOCK_ID"] == 12)
        {
            $elem = CIBlockElement::GetList(array(), array("IBLOCK_ID" => $arFields["IBLOCK_ID"], "ID" => $arFields["ID"]), false, false, array("NAME", "PROPERTY_email", "PROPERTY_phone", "PROPERTY_message"));
            while ($elem_info = $elem -> Fetch())
            {
                $mailFields = array(
                    "EMAIL_TO" => "shop@alpina.ru",
                    "AUTHOR" => $elem_info["NAME"],
                    "AUTHOR_EMAIL" => $elem_info["PROPERTY_EMAIL_VALUE"],
                    "AUTHOR_PHONE" => $elem_info["PROPERTY_PHONE_VALUE"],
                    "TEXT" => $elem_info["PROPERTY_MESSAGE_VALUE"]
                );
            }
            CEvent::Send("FEEDBACK_FORM", "s1", $mailFields, "N");
        }
        //РїРѕР»СѓС‡РёРј СЃРѕРѕР±С‰РµРЅРёРµ

    }      
    //подмена логина на EMAIL
    AddEventHandler("main", "OnBeforeUserRegister", Array("OnBeforeUserRegisterHandler", "OnBeforeUserRegister"));
    class OnBeforeUserRegisterHandler
    {
        function OnBeforeUserRegister(&$arFields)
        {
            $arFields['LOGIN'] = $arFields['EMAIL'];

            //Check if email already registred
            $filter = Array("EMAIL" => $arFields['EMAIL']);
            $obUsers = CUser::GetList(($by="id"), ($order="desc"), $filter); // РІС‹Р±РёСЂР°РµРј РїРѕР»СЊР·РѕРІР°С‚РµР»РµР№
            while($arUser = $obUsers->Fetch()){
                $arUsers[]=$arUser;
            }

            if (count($arUsers)==1){
                $login = 'newuser_'.$arFields["EMAIL"];
            } else if (count($arUsers)>1) {
                $login = 'newuser_'.count($arUsers).'_'.$arFields["EMAIL"];
            } else {
                $login = $arFields['EMAIL'];
            }
            $arFields['LOGIN'] = $login;

            return $arFields;
        }
    }

    //Handler switch on iml delivery service for cities
    AddEventHandler('ipol.iml', 'onCompabilityBefore', 'onCompabilityBeforeIML');

    //Switch on iml delivery service for cities
    function onCompabilityBeforeIML($order, $conf, $keys) {
        //Check is current location switched-on for  IML delivery
        $obImlCity = CIBlockElement::GetList(Array("ID" => "ASC"),  Array("IBLOCK_ID" => "37", "ACTIVE" => 'Y', "PROPERTY_ID_CITY"=>$order["LOCATION_TO"]), false, false, array("ID", "IBLOCK_ID", "NAME",  "PROPERTY_ID_CITY", "PROPERTY_SWITCH_PICKUP", "PROPERTY_SWITCH_COURIER"));
        $arImlCity = $obImlCity->Fetch();
        if(!empty($arImlCity["ID"])){
            //Forming switched-on delivery type's
            if (!empty($arImlCity["PROPERTY_SWITCH_COURIER_VALUE"])) {
                $profilesName[]="courier";
            }
            if (!empty($arImlCity["PROPERTY_SWITCH_PICKUP_VALUE"])) {
                $profilesName[]="pickup";
            }
            //Check is delivery type is enable
            foreach ($profilesName as $profile) {
                if(in_array($profile,$keys)) {
                    $profileResult[]=$profile;
                }
            }
            //Return result
            if (!empty($profileResult)) {
                return $profileResult;
            }  else {
                return false;
            }
        }
        return false;
    }

    AddEventHandler("main", "OnAfterUserRegister", Array("OnAfterUserRegisterHandler", "OnAfterUserRegister"));
    class OnAfterUserRegisterHandler
    {
        function OnAfterUserRegister(&$arFields)
        {
            CModule::IncludeModule('subscribe');

            if ($_POST['USER_SUBSCRIBE'] == 'on')
            {
                $SubscriberList = CSubscription::GetList(Array(), Array('EMAIL' => $arFields["EMAIL"]), false);
                if (!($Subscriber = $SubscriberList->Fetch()))
                {
                    $NewSubscriber = new CSubscription;
                    $subFields = array(
                        "EMAIL" => $arFields["EMAIL"],
                        "USER_ID" => $arFields["USER_ID"],
                        "ACTIVE" => "Y",
                        "RUB_ID" => array("1")
                    );
                    $NewSubscriber->Add($subFields);
                }
            }
            //        $arFields['LOGIN'] = $arFields['EMAIL'];
            return $arFields;
        }
    }

    AddEventHandler("catalog", "OnDiscountUpdate", Array("MyClass", "OnDiscountUpdateHandler"));

    class MyClass
    {
        // СЃРѕР·РґР°РµРј РѕР±СЂР°Р±РѕС‚С‡РёРє СЃРѕР±С‹С‚РёСЏ "OnAfterIBlockElementUpdate"
        function OnDiscountUpdateHandler($ID, $arFields)
        {
            if ($arFields["ACTIVE"] == "Y")
            {
                $discount = CCatalogDiscount::GetByID($ID);

                $discount_prods = CCatalogDiscount::GetDiscountProductsList (array(), array("DISCOUNT_ID" => $ID), false, false, array());
                while ($discount_fetch = $discount_prods -> Fetch())
                {
                    switch (round($discount['VALUE']))
                    {
                        case 10:
                            CIBlockElement::SetPropertyValues($discount_fetch["PRODUCT_ID"], 4, array("VALUE"=>219), "spec_price");
                            break;
                        case 15:
                            CIBlockElement::SetPropertyValues($discount_fetch["PRODUCT_ID"], 4,array("VALUE"=>271), "spec_price");
                            break;
                        case 20:
                            CIBlockElement::SetPropertyValues($discount_fetch["PRODUCT_ID"], 4,array("VALUE"=>220), "spec_price");
                            break;
                        case 30:
                            CIBlockElement::SetPropertyValues($discount_fetch["PRODUCT_ID"], 4,array("VALUE"=>221), "spec_price");
                            break;
                        case 40:
                            CIBlockElement::SetPropertyValues($discount_fetch["PRODUCT_ID"], 4,array("VALUE"=>272), "spec_price");
                            break;
                        default:
                            CIBlockElement::SetPropertyValues($discount_fetch["PRODUCT_ID"], 4,array("VALUE"=>""), "spec_price");
                    }
                }
            }

        }
    }


    function getCourierByID($cID){
        $return = Array();
        $filter = Array("GROUPS_ID" => Array(9),"ID"=>$cID,"ACTIVE" => "Y");
        $rsUsers = CUser::GetList(($by=""), ($order=""), $filter,array("FIELDS"=>array("ID","NAME","LAST_NAME","PERSONAL_MOBILE"))); // выбираем пользователей
        while($test_cur = $rsUsers->NavNext(true, "f_")){
            if(!preg_match('/[0-9]/',$test_cur['LAST_NAME'])){
                $return["CUR"] = Array("NAME"=>$test_cur['NAME']." ".$test_cur['LAST_NAME'],"PHONE"=>$test_cur['PERSONAL_MOBILE']);
            } else {
                $return["CUR"] = Array("NAME"=>$test_cur['NAME'],"PHONE"=>$test_cur['LAST_NAME']);
            }
        }
        return $return;
    }



    // --- класс для отправки смс при изменении статусов заказа
    class Message {

        /***************
        *
        * Статусы заказа,при которых отправляется сообщение
        *
        * @var array $messages
        *
        *************/
        public static $messages = Array(
            "N" => "Ваш заказ №order принят. Если будут вопросы – звоните +7(495)9808077",
            "A" => "clientName, Ваш заказ №order в интернет-магазине Альпина Паблишер отменен. Если заказ аннулирован по ошибке, звоните +7(495)9808077",
            "K" => "clientName, Ваш заказ №order отправлен почтой РФ. Номер отправления будет выслан Вам в течение 5 рабочих дней.Если будут вопросы – звоните +7(495)9808077",
            "C" => "clientName, Ваш заказ №order собран. Вы можете получить его по адресу 4-ая Магистральная ул., д.5, 2 под., 2 этаж по будням с 8 до 18 часов. Если будут вопросы – звоните +7(495)9808077",
            "D10" => "Истекает срок хранения Вашего заказа №order. Вы можете получить его по адресу 4-ая Магистральная ул., д.5, 2 под., 2 этаж по будням с 8 до 18 часов. Если будут вопросы – звоните +7(495)9808077",
            "D12" => "Осталось 2 дня до аннулирования Вашего заказа №order. Вы можете получить его по адресу 4-ая Магистральная ул., д.5, 2 под., 2 этаж по будням с 8 до 18 часов. Если будут вопросы – звоните +7(495)9808077",
            "CA" => "Ваш заказ order передан курьеру. Курьер cur_name cur_phone"
            //"I" => "Ваш заказ №order в пути. Если будут вопросы – звоните +7(495)9808077"
        );

        /***************
        *
        * Получаем способ доставки для заказа
        *
        * @param int $id
        * @return string $order['DELIVERY_ID']
        *
        *************/

        public static function getOrderDeliveryType($id){
            $order = CSaleOrder::GetByID($id);
            return $order['DELIVERY_ID'];
        }

        /***************
        *
        * Логин/пароль для доступа к смс сервису
        *
        *************/

        function __construct(){
            $this->user = 33767;
            $this->password = 'Alpinagamma';
        }

        /***************
        *
        * Получаем телефон из заказа
        *
        * @param int $id
        * @return string $clearedPhone
        *
        *************/

        private function getPhone($id){
            $db_props = CSaleOrderPropsValue::GetOrderProps($id);
            while ($arProps = $db_props->Fetch()){
                if($arProps['CODE']=='PHONE'){
                    $clearedPhone = preg_replace('/[^0-9+]/','',$arProps['VALUE']);
                    return $clearedPhone;
                }
            }
        }

        /***************
        *
        * Получаем имя клиента из заказа
        *
        * @param int $id
        * @return string $arProps['VALUE']
        *
        *************/

        private function getClientName($id){
            $db_props = CSaleOrderPropsValue::GetOrderProps($id);
            while ($arProps = $db_props->Fetch()){
                if($arProps['CODE']=='F_CONTACT_PERSON'){
                    return $arProps['VALUE'];
                }
            }
        }

        /***************
        *
        * Отправляем сообщение
        *
        * @param int $id
        * @param string $val
        * @param array $curArr - optional
        * @return string $result
        *
        *************/

        public function sendMessage($ID,$val,$curArr){

            $phone = $this->getPhone($ID);
            $name = $this->getClientName($ID);
            $message = preg_replace('/order/',$ID,self::$messages[$val]); // ---- вставляем номер заказа
            $message = preg_replace('/clientName/',$name,$message); // ---- вставляем имя клиента
            if($curArr){
                $message = preg_replace('/cur_name/',$curArr['CUR']['NAME'],$message); // ---- вставляем имя курьера
                $message = preg_replace('/cur_phone/',$curArr['CUR']['PHONE'],$message); // ---- вставляем телефон курьера
            }

            $postdata = http_build_query(
                array(
                    'user' => $this->user,
                    'pass' => $this->password,
                    'action' => 'post_sms ',
                    'message' => $message,
                    'target' => $phone,
                )
            );

            $opts = array('http' =>
                array(
                    'method'  => 'POST',
                    'header'  => 'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',
                    'content' => $postdata
                )
            );

            $context  = stream_context_create($opts);
            $result = file_get_contents('http://admin.gammasms.ru/public/http/', false, $context);
            return $result;
        }

    }

    //----- Отправка смс при новом заказе
    AddEventHandler("sale", "OnOrderNewSendEmail", "sendSMSOnNewOrder");


    function sendSMSOnNewOrder($orderID, &$eventName, &$arFields){
        $message = new Message();
        $result = $message->sendMessage($orderID,"N");
    }

    //----- Отправка смс при изменении статуса заказа

    AddEventHandler("sale", "OnSaleStatusOrder","sendSMS");

    function sendSMS($ID,$val){
        if (array_key_exists($val,Message::$messages)){
            if($val=="C"){ // ---- статус собран может быть только для заказов с самовывозом
                if(Message::getOrderDeliveryType($ID)==2){ //2 - ID службы доставки "самовывоз"
                    $message = new Message();
                    $result = $message->sendMessage($ID,$val);
                }
            } else {
                $message = new Message();
                $result = $message->sendMessage($ID,$val);
            }
        }
    }


    //подмена логина на EMAIL
    AddEventHandler("main", "OnBeforeUserAdd", Array("OnBeforeUserAddHandler", "OnBeforeUserAdd"));
    class OnBeforeUserAddHandler    {
        function OnBeforeUserAdd(&$arFields)
        {
            $arFields['LOGIN'] = $arFields['EMAIL'];

            //Check if email already registred
            $filter = Array("EMAIL" => $arFields['EMAIL']);
            $obUsers = CUser::GetList(($by="id"), ($order="desc"), $filter); // выбираем пользователей
            while($arUser = $obUsers->Fetch()){
                $arUsers[]=$arUser;
            }

            if (count($arUsers)==1){
                $login = 'newuser_'.$arFields["EMAIL"];
            } else if (count($arUsers)>1) {
                $login = 'newuser_'.count($arUsers).'_'.$arFields["EMAIL"];
            } else {
                $login = $arFields['EMAIL'];
            }
            $arFields['LOGIN'] = $login;

            return $arFields;

        }
    }
    //подмена логина на EMAIL
    AddEventHandler("main", "OnBeforeUserUpdate", Array("UserUpdateClass", "OnBeforeUserUpdateHandler"));
    class UserUpdateClass     {
        // создаем обработчик события "OnBeforeUserUpdate"
        function OnBeforeUserUpdateHandler(&$arFields)
        {
            if (strlen($arFields['EMAIL']) && !strlen($arFields['LOGIN']))
                $arFields['LOGIN'] = $arFields['EMAIL'];
            return $arFields;
        }
    }


    // --- books subscribe
    AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", "sendMailToBookSubs");

    function sendMailToBookSubs(&$arParams){
        if($arParams['IBLOCK_ID']==4){
            $arSelect = Array("NAME","DETAIL_PAGE_URL","PREVIEW_PICTURE","PROPERTY_STATE");
            $arFilter = Array("IBLOCK_ID"=>4,"ID"=>$arParams['ID'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
            while($ob = $res->GetNextElement()){
                $arFields = $ob->GetFields();
                $oldElStatus = $arFields['PROPERTY_STATE_ENUM_ID'];
                $bookName = $arFields['NAME'];
                $bookHref = "http://www.alpinabook.ru".$arFields['DETAIL_PAGE_URL'];
                $bookImg = CFile::GetPath($arFields['PREVIEW_PICTURE']);
            }

            $newElStatus = $arParams['PROPERTY_VALUES'][56][0]["VALUE"];

            if($newElStatus!=$oldElStatus && ($oldElStatus==22 || $oldElStatus==23)){

                $el = new CIBlockElement;
                $arLoadProductArray = Array("ACTIVE" => "N");
                // --- status changed from "coming soon" to "new"
                if($oldElStatus==22 && $newElStatus==21){

                    $arSelect = Array("ID","PROPERTY_SUB_EMAIL");
                    $arFilter = Array("IBLOCK_ID"=>41,"PROPERTY_SUB_TYPE_ID"=>1,"PROPERTY_BOOK_ID"=>$arParams['ID'],"ACTIVE"=>"Y");
                    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>9999), $arSelect);
                    while($ob = $res->GetNextElement()){
                        $arFields = $ob->GetFields();
                        // --- email sending here
                        $arEventFields = array(
                            "EMAIL"=> $arFields['PROPERTY_SUB_EMAIL_VALUE'],
                            "BOOK_HREF" => $bookHref,
                            "BOOK_NAME" => $bookName,
                            "BOOK_IMG" => $bookImg
                        );
                        CEvent::Send("BOOK_SUB_MAILING", "s1", $arEventFields,"N");
                        // --- email sending here
                        $el->Update($arFields['ID'], $arLoadProductArray);
                    }

                } else if($oldElStatus==23 && !$newElStatus){ // --- status changed from "not availible" to "in stock"
                    $arSelect = Array("ID","PROPERTY_SUB_EMAIL");
                    $arFilter = Array("IBLOCK_ID"=>41,"PROPERTY_SUB_TYPE_ID"=>2,"PROPERTY_BOOK_ID"=>$arParams['ID'],"ACTIVE"=>"Y");
                    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>9999), $arSelect);
                    while($ob = $res->GetNextElement()){
                        $arFields = $ob->GetFields();
                        // --- email sending here $arFields['PROPERTY_SUB_EMAIL_VALUE']

                        $arEventFields = array(
                            "EMAIL"=> $arFields['PROPERTY_SUB_EMAIL_VALUE'],
                            "BOOK_HREF" => $bookHref,
                            "BOOK_NAME" => $bookName,
                            "BOOK_IMG" => $bookImg
                        );
                        CEvent::Send("BOOK_SUB_MAILING", "s1", $arEventFields,"N");

                        // --- email sending here
                        $el->Update($arFields['ID'], $arLoadProductArray);
                    }
                }

            }
        }
    }



    //Функция перевода числа в текстовую форму
    function num2str($num) {
        $nul='ноль';
        $ten=array(
            array('','один','два','три','четыре','пять','шесть','семь', 'восемь','девять'),
            array('','одна','две','три','четыре','пять','шесть','семь', 'восемь','девять'),
        );
        $a20=array('десять','одиннадцать','двенадцать','тринадцать','четырнадцать' ,'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать');
        $tens=array(2=>'двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят' ,'восемьдесят','девяносто');
        $hundred=array('','сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот','восемьсот','девятьсот');
        $unit=array( // Units
            array('копейка' ,'копейки' ,'копеек',     1),
            array('рубль'   ,'рубля'   ,'рублей'    ,0),
            array('тысяча'  ,'тысячи'  ,'тысяч'     ,1),
            array('миллион' ,'миллиона','миллионов' ,0),
            array('миллиард','милиарда','миллиардов',0),
        );
        //
        list($rub,$kop) = explode('.',sprintf("%015.2f", floatval($num)));
        $out = array();
        arshow(str_split($rub, 3));
        if (intval($rub)>0) {
            foreach(str_split($rub,3) as $uk=>$v) { // by 3 symbols
                if (!intval($v)) continue;
                $uk = sizeof($unit)-$uk-1; // unit key
                $gender = $unit[$uk][3];
                list($i1,$i2,$i3) = array_map('intval',str_split($v,1));
                // mega-logic
                $out[] = $hundred[$i1]; # 1xx-9xx
                if ($i2>1) $out[]= $tens[$i2].' '.$ten[$gender][$i3]; # 20-99
                else $out[]= $i2>0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
                // units without rub & kop
                if ($uk>1) $out[]= morph($v,$unit[$uk][0],$unit[$uk][1],$unit[$uk][2]);
            } //foreach
        }
        else $out[] = $nul;
        $out[] = morph(intval($rub), $unit[1][0],$unit[1][1],$unit[1][2]); // rub
        $out[] = $kop.' '.morph($kop,$unit[0][0],$unit[0][1],$unit[0][2]); // kop
        return trim(preg_replace('/ {2,}/', ' ', join(' ',$out)));
    }

    /**
    * Склоняем словоформу
    */

    //----- Fix for flippost cost
    AddEventHandler("sale", "OnOrderNewSendEmail", "customizeNewOrderMail");

    function customizeNewOrderMail($orderID, &$eventName, &$arFields){
        $orderArr = CSaleOrder::GetByID($orderID);
        $arFields['EMAIL_DISCOUNT_PERCENT_TOTAL'] = $_SESSION['EMAIL_DISCOUNT_PERCENT_TOTAL'];
        $arFields['EMAIL_DISCOUNT_SUM_TOTAL'] = $_SESSION['EMAIL_DISCOUNT_SUM_TOTAL'];
        $arFields['EMAIL_CURRENT_DISCOUNT_SAVE_PERCENT'] = $_SESSION['EMAIL_CURRENT_DISCOUNT_SAVE_PERCENT'];
        $arFields['EMAIL_NEXT_DISCOUNT_SAVE_SUM'] = $_SESSION['EMAIL_NEXT_DISCOUNT_SAVE_SUM'];
        $arFields['EMAIL_ORDER_WEIGHT'] = $_SESSION['EMAIL_ORDER_WEIGHT'];
        $arFields['EMAIL_ORDER_ITEMS'] = getOrderItemsForMail($orderID);
        $phone_prop = CSaleOrderPropsValue::GetList (array("SORT" => "ASC"), array("ORDER_ID" => $orderID, "CODE" => "PHONE"));
        while ($phone = $phone_prop -> Fetch())
        {
            $arFields["CUSTOMER_PHONE"] = $phone["VALUE"];
        }
        $arFields['PROMO_PARTNER'] = '';
        if ($orderArr['PAY_SYSTEM_ID'] == 12) { //если оплата по безналу юриком
            $arFields['EMAIL_PAY_SYSTEM'] = getOrderPaySystemName($orderArr['PAY_SYSTEM_ID']);
            $arFields['PAYMENT_LINK'] = "Менеджер отправит счет на оплату в рабочее время.";
        } else {
            $arFields['EMAIL_PAY_SYSTEM'] = getOrderPaySystemName($orderArr['PAY_SYSTEM_ID']);
        }

        if ($orderArr["PAY_SYSTEM_ID"] == 13 || $orderArr["PAY_SYSTEM_ID"] == 14) {
            //получаем путь до обработчика
            $arFields["PAYMENT_LINK"] = "Для оплаты заказа перейдите по <a href='http://alpinabook.ru/personal/order/payment/?ORDER_ID=".$orderArr["ID"]."'>ссылке</a>";
        }

        $arFields['DELIVERY_NAME'] = getOrderDeliverySystemName($orderArr['DELIVERY_ID']);

        if(in_array(trim($orderArr['DELIVERY_ID']), array(18,17,20,21, "pickpoint:postamat"))){
            $arFields['EMAIL_DELIVERY_TERM'] = "<br />Сроки доставки (дней): <b>".$_SESSION['EMAIL_DELIVERY_TERM']."</b><br>";
            $arFields['EMAIL_DELIVERY_ADDR'] = "Адрес доставки: <b>".getDeliveryAddress(trim($orderArr['DELIVERY_ID']),$orderID)."</b><br>";
        } else if($orderArr['DELIVERY_ID']==9 || $orderArr['DELIVERY_ID']==12 || $orderArr['DELIVERY_ID']==13 || $orderArr['DELIVERY_ID']==14 || $orderArr['DELIVERY_ID']==15){
            $db_vals = CSaleOrderPropsValue::GetList(array("SORT" => "ASC"), array("ORDER_ID" => $orderID, "CODE" => array("DELIVERY_DATE","ADDRESS")));
            while ($arVals = $db_vals -> Fetch()) {
                $arVals['CODE'] == "ADDRESS" ? $arFields['EMAIL_DELIVERY_ADDR'] = "Адрес доставки: <b>".$arVals['VALUE']."</b><br>" : $arFields['EMAIL_DELIVERY_TERM'] = "<br />".$arVals['NAME']." : <b>".$arVals['VALUE']."</b><br>";
            }
            $arFields['EMAIL_ADDITIONAL_INFO'] = "<tr><td align=\"left\" style=\"border-collapse: collapse;color:#393939;font-family: 'Open Sans','Segoe UI',Roboto,Tahoma,sans-serif;font-size: 16px;font-weight: 400;line-height: 160%;font-style: normal;letter-spacing: normal;padding-top:10px;\" valign=\"top\" colspan=\"2\">";
            $arFields['EMAIL_ADDITIONAL_INFO'] .= "Курьер свяжется с вами в выбранный день доставки, чтобы согласовать удобное время и другие детали.";
            $arFields['EMAIL_ADDITIONAL_INFO'] .= "</td></tr>";
        }
        if ($orderArr['DELIVERY_ID'] == 2){
            $arFields['EMAIL_ADDITIONAL_INFO'] = "<tr><td align=\"left\" style=\"border-collapse: collapse;color:#393939;font-family: 'Open Sans','Segoe UI',Roboto,Tahoma,sans-serif;font-size: 16px;font-weight: 400;line-height: 160%;font-style: normal;letter-spacing: normal;padding-top:10px;\" valign=\"top\" colspan=\"2\">";
            $arFields['EMAIL_ADDITIONAL_INFO'] .= "Заказ будет собран в течение двух рабочих часов. Забрать заказ можно по адресу <em>м.Полежаевская, ул.4-ая Магистральная, д.5, 2 подъезд, 2 этаж.</em><br />Офис работает по будням с 8 до 18 часов.";
            $arFields['EMAIL_ADDITIONAL_INFO'] .= "</td></tr>";
        }

        if ($arFields['PRICE'] > 2000) {
            if ($orderArr['DELIVERY_ID']==9 || $orderArr['DELIVERY_ID']==12 || $orderArr['DELIVERY_ID']==13 || $orderArr['DELIVERY_ID']==14 || $orderArr['DELIVERY_ID']==15 || $orderArr['DELIVERY_ID']==2){
                $arFields['PROMO_PARTNER'] = '
                <tr>
                <td align="center" style="background:#FCFFD4;padding-top:0px; padding-bottom:0;color: #393939;font-family: \'Open Sans\',\'Segoe UI\',Roboto,Tahoma,sans-serif;font-size: 16px;line-height: 160%;text-align: left;padding:0;" valign="top">

                <table align="center" style="width:100%;">
                <tbody>
                <tr>
                <td style="border-collapse: collapse;padding:10px 40px 20px 40px; border-collapse: collapse;border-style: solid;border-color: #808080;-moz-border-top-colors: none;-moz-border-right-colors: none;-moz-border-bottom-colors: none;-moz-border-left-colors: none;border-image: none;border-width: 1px 0px 1px;">
                <table align="left" width="100%">
                <tbody>
                <!-- Коллектив имага -->
                <tr>
                <td align="left" style="border-collapse: collapse;color:#393939;font-family: \'Open Sans\',\'Segoe UI\',Roboto,Tahoma,sans-serif;font-size: 16px;font-weight: 400;line-height: 160%;font-style: normal;letter-spacing: normal;padding-top:10px;" width="100" valign="top">
                <a href="http://www.netology.ru/?utm_source=infopartners&utm_medium=667&utm_campaign=md-aplina" target="_blank">
                <img src="/images/subscr/netology.png" align="left" />
                </a>
                <b>Скидка на обучение от Альпина Паблишер и Нетологии</b>
                <br />
                Также рады предложить вам обучение со скидкой от наших партнеров, университета интернет-профессий «Нетология».<br />
                Программа обучения <a href="http://netology.ru/marketing-director?utm_source=infopartners&utm_medium=667&utm_campaign=md-aplina" target="_blank">«Директор по онлайн-маркетингу»</a> со скидкой 30 000 рублей!
                <br /><br />
                Главные особенности программы:
                <ul>
                <li>Очная программа обучения по подготовке управленцев в сфере современного маркетинга (занятия проходят в Москве);</li>
                <li>Более 20 преподавателей-практиков из Google Россия, «Яндекс», «ВКонтакте», Mail.ru Group, Ozon, ABBYY, Wikimart;</li>
                <li>Программа включает основные темы, которые должен знать современный специалист в сфере управления маркетингом;</li>
                <li>По итогам обучения выдается диплом о профессиональной переподготовке по специальности «Директор по онлайн-маркетингу»;</li>
                <li>По завершению программы Нетология будет оказывать помощь в организации персональных консультаций с HR-специалистами, возможна организация собеседований на конкретные вакансии.</li>
                </ul>

                Промокод на скидку «Альпина» (после оформления заявки на обучение сообщите о вашей скидке менеджеру и назовите промокод). Скидка действует до 11.02.2016.
                <br />
                Количество мест на участие в программе ограничено.
                <br /><br />
                Подробнее об учебной программе «Директор по онлайн-маркетингу» вы можете узнать на официальной странице <a href="http://netology.ru/marketing-director?utm_source=infopartners&utm_medium=667&utm_campaign=md-aplina" target="_blank">«Нетологии»</a>
                <br /><br />

                </td>
                </tr>
                </tbody>
                </table>
                </td>
                </tr>
                </tbody>
                </table>
                </td>
                </tr>';
            } else {
                $arFields['PROMO_PARTNER'] = '
                <tr>
                <td align="center" style="background:#FCFFD4;padding-top:0px; padding-bottom:0;color: #393939;font-family: \'Open Sans\',\'Segoe UI\',Roboto,Tahoma,sans-serif;font-size: 16px;line-height: 160%;text-align: left;padding:0;" valign="top">

                <table align="center" style="width:100%;">
                <tbody>
                <tr>
                <td style="border-collapse: collapse;padding:10px 40px 20px 40px; border-collapse: collapse;border-style: solid;border-color: #808080;-moz-border-top-colors: none;-moz-border-right-colors: none;-moz-border-bottom-colors: none;-moz-border-left-colors: none;border-image: none;border-width: 1px 0px 1px;">
                <table align="left" width="100%">
                <tbody>
                <!-- Коллектив имага -->
                <tr>
                <td align="left" style="border-collapse: collapse;color:#393939;font-family: \'Open Sans\',\'Segoe UI\',Roboto,Tahoma,sans-serif;font-size: 16px;font-weight: 400;line-height: 160%;font-style: normal;letter-spacing: normal;padding-top:10px;" width="100" valign="top">
                <a href="http://www.netology.ru/?utm_source=infopartners&utm_medium=667&utm_campaign=md-aplina" target="_blank"><img src="/images/subscr/netology.png" align="left" /></a><b>Скидка на обучение от Альпина Паблишер и Нетологии</b>
                <br />
                Также рады предложить вам обучение со скидкой от наших партнеров: получите востребованную интернет-профессию или повысьте свои навыки в университете «Нетология» со скидкой 3000 рублей! Введите в форме заказа (на странице
                интересующей вас профессии) промокод <b>HSMD4-AXL6PM</b>. Промокод действителен до 29.02.2016
                <br />
                Скидка распространяется на все онлайн программы обучения.
                <br />
                Полный список программ обучения доступ на сайте университета <a href="http://netology.ru/?utm_source=infopartners&utm_medium=667&utm_campaign=onlinecourses" target="_blank">«Нетология»</a>.
                <br /><br />

                </td>
                </tr>
                </tbody>
                </table>
                </td>
                </tr>
                </tbody>
                </table>
                </td>
                </tr>';
            }
        }
    }


    function getOrderItemsForMail($orderID){
        $bookDescString = "";
        $dbItemsInOrder = CSaleBasket::GetList(array("ID" => "ASC"), array("ORDER_ID" => $orderID));
        while ($arItems = $dbItemsInOrder->Fetch()){
            $bookDescString .= "<tr>";
            $bookDescString .= "<td align=\"left\" style=\"border-collapse: collapse;color:#393939;font-family: 'Open Sans','Segoe UI',Roboto,Tahoma,sans-serif;font-size: 16px;font-weight: 400;line-height: 100%;font-style: normal;letter-spacing: normal;padding-top:10px;\" valign=\"top\">";
            $bookDescString .= "<a href='http://www.alpinabook.ru".$arItems["DETAIL_PAGE_URL"]."?utm_source=autotrigger&utm_medium=email&utm_term=bookordered&utm_campaign=newordermail' target='_blank'>".$arItems['NAME']."</a>";
            $bookDescString .= "</td><td align=\"center\" style=\"border-collapse: collapse;color:#393939;font-family: 'Open Sans','Segoe UI',Roboto,Tahoma,sans-serif;font-size: 16px;font-weight: 400;line-height: 100%;font-style: normal;letter-spacing: normal;padding-top:10px;\" width=\"80\">";
            $bookDescString .= $arItems['QUANTITY'];
            $bookDescString .= "</td><td align=\"center\" style=\"border-collapse: collapse;color:#393939;font-family: 'Open Sans','Segoe UI',Roboto,Tahoma,sans-serif;font-size: 16px;font-weight: 400;line-height: 100%;font-style: normal;letter-spacing: normal;padding-top:10px;\" width=\"100\">";
            $bookDescString .= $arItems['PRICE']*$arItems['QUANTITY'];
            $bookDescString .= "</td>";

            //$bookDescString .= $arItems['NAME']." - ".$arItems['QUANTITY']." шт. ".$arItems['PRICE']*$arItems['QUANTITY']." руб. ";
            $arSelect = Array('ID',"IBLOCK_ID","PROPERTY_TYPE","PROPERTY_COVER_TYPE");
            $arFilter = Array("IBLOCK_ID"=>4, "ID"=>$arItems['PRODUCT_ID']);
            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
            while($ob = $res->GetNextElement()){
                $arFields = $ob->GetFields();
                $bookDescString .= "<tr><td colspan=\"3\" align=\"left\" style=\"border-collapse: collapse;color:#393939;font-family: 'Open Sans','Segoe UI',Roboto,Tahoma,sans-serif;font-size: 12px; font-weight: 400;line-height: 100%;font-style: normal;letter-spacing: normal;padding-top:10px;padding-bottom: 10px;\">".$arFields['PROPERTY_TYPE_VALUE'].". ".$arFields['PROPERTY_COVER_TYPE_VALUE']."</td></tr>";
            }
        }
        return $bookDescString;
    }


    function getOrderPaySystemName($psi){
        $psn = "";
        $psArr = CSalePaySystem::GetByID($psi);
        $psn = $psArr['NAME'];
        return $psn;
    }

    function getOrderDeliverySystemName($psi) {
        $psn = "";
        $psArr = CSaleDelivery::GetByID($psi);
        $psn = $psArr['NAME'];
        return $psn;
    }

    function getDeliveryAddress($deliveryServ,$orderId){
        $address = "";
        switch($deliveryServ){
            case 18:
                $ordArr = CSaleOrder::GetByID($orderId);
                $address = $ordArr['USER_DESCRIPTION'];
                break;
            case 15:
                $db_vals = CSaleOrderPropsValue::GetList(array("SORT" => "ASC"), array("ORDER_ID" => $orderId, "CODE" => "ADDRESS"));
                if ($arVals = $db_vals -> Fetch()) {
                    $address = $arVals["VALUE"];
                }
                break;
            case 21:
                $db_vals = CSaleOrderPropsValue::GetList(array("SORT" => "ASC"), array("ORDER_ID" => $orderId, "CODE" => "IML_ADDRESS"));
                if ($arVals = $db_vals -> Fetch()) {
                    $address = $arVals["VALUE"];
                }
                break;
            case 20:
                $db_vals = CSaleOrderPropsValue::GetList(array("SORT" => "ASC"), array("ORDER_ID" => $orderId, "CODE" => "ADDRESS"));
                if ($arVals = $db_vals -> Fetch()) {
                    $address = $arVals["VALUE"];
                }
                break;
        }
        return $address;
    }

    function getDiffToNextDiscountSave($ui,$np){
        $diff = 0.0;
        // --- сумма всех оплаченных заказов = сумме накопительной скидки
        $totalPayedSum = 0.0;

        $arFilter = Array(
            "USER_ID" => $ui,
            "PAYED" => "Y"
        );

        $db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
        while ($ar_sales = $db_sales->Fetch()){
            $totalPayedSum +=$ar_sales['PRICE'];
        }

        // ---- сколько осталось до следующей скидки
        $res = CCatalogDiscountSave::GetRangeByDiscount(array(),array("VALUE"=>$np),false);
        if($ob = $res->fetch()){
            $diff = (float)$ob['RANGE_FROM'] - $totalPayedSum;
        }

        return $diff;

    }


    AddEventHandler('sale', 'OnOrderStatusSendEmail', Array("mail_change", "change_data"));


    class mail_change
    {
        function change_data($ID, &$eventName, &$arFields, $val)
        {
            if ($eventName=="SALE_STATUS_CHANGED_P") {
                $salelist=CSaleOrderPropsValue::GetList(array(),array("ORDER_ID"=>$ID, "ORDER_PROPS_ID"=>24),false,false,array("VALUE"));
                if ($sale_prop=$salelist->Fetch())
                    $arFields["PERSONAL_PHONE"]=$sale_prop["VALUE"];
                $userslist=CSaleOrderPropsValue::GetList(array(),array("ORDER_ID"=>$ID, "ORDER_PROPS_ID"=>7),false,false,array("VALUE"));
                if ($usersarray=$userslist->Fetch())
                    $arFields["ORDER_USER"]=$usersarray["VALUE"];
            }

        }
    }

    AddEventHandler('main', 'OnBeforeEventSend', 'RegisterNoneEmail');   // вызывается перед отправкой шаблона письма

    function RegisterNoneEmail (&$arFields, &$arTemplate) {     // при создании пользователя с одинаковым генерируемым email не отправляет письмо
        if(stristr($arFields["LOGIN"], 'newuser_') == true && $arTemplate["EVENT_NAME"] == 'NEW_USER'){
            return false;
        }
        /*
        $arFields["LOGIN"] = логин нового пользователя
        $arTemplate["EVENT_NAME"] = событие при котором происходит отправка письма
        */

    }

    AddEventHandler('main', 'OnBeforeEventSend', 'PayButtonForOnlinePayment');

    function PayButtonForOnlinePayment (&$arFields, &$arTemplate)
    {
        if ($arTemplate["ID"] == 16)
        {
            $order = CSaleOrder::GetByID($arFields["ORDER_ID"]);
            if ($order["PAY_SYSTEM_ID"] == 13)
            {
                $pay_button = '<div class="payment_button" style="white-space: normal; font-size: 18px; text-align: center; vertical-align: middle; background-color: #00abb8; height: 50px; width: 146px; margin-left: 60%; border-radius: 35px; margin-top: 15px;">
                <a href="http://www.alpinabook.ru/personal/order/payment/?ORDER_ID='.$arFields["ORDER_ID"].'" style="color: #fff; text-decoration: none;"><span style="line-height: 45px">Оплатить</span></a>
                </div>';
            }
            else
            {
                $pay_button = "";
            }
            $arFields["PAYMENT_BUTTON"] = $pay_button;
        }
    }

    AddEventHandler('main', 'OnBeforeEventSend', "SubConfirmFunc");

    function SubConfirmFunc (&$arFields, &$arTemplate)
    {
        if ($arTemplate["ID"] == 168 || $arTemplate["ID"] == 16)
        {
            $NewItemsBlock = "";
            $i = 0;
            $NewItems = CIBlockElement::GetList (array("timestamp_x" => "DESC"), array("IBLOCK_ID" => 4, "PROPERTY_STATE" => 21, "ACTIVE" => "Y", ">DETAIL_PICTURE" => 0), false, false, array());
            while (($NewItemsList = $NewItems -> Fetch()) && ($i < 3))
            {
                $pict = CFile::ResizeImageGet($NewItemsList["DETAIL_PICTURE"], array("width" => 146, "height" => 188), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                $curr_sect = CIBlockSection::GetByID($NewItemsList["IBLOCK_SECTION_ID"]) -> Fetch();
                $NewItemsBlock .= '
                <table align="left" border="0" cellpadding="8" cellspacing="0" class="tile" width="32%">
                <tbody>
                <tr>
                <td height="200" style="border-collapse: collapse;text-align:center;" valign="top" width="100%">
                <a href="http://www.alpinabook.ru/catalog/'.$curr_sect["CODE"].'/'.$NewItemsList["ID"].'/?utm_source=autotrigger&amp;utm_medium=email&amp;utm_term=newbooks&amp;utm_campaign=newordermail" target="_blank">
                <img alt="'.$NewItemsList["NAME"].'" src="'.$pict["src"].'" style="width: 146px; height: 188px;" />
                </a>
                </td>
                </tr>
                <tr>
                <td align="center" height="18" style="color: #336699;font-weight: normal; border-collapse: collapse;font-family: Roboto,Tahoma,sans-serif;font-size: 16px;line-height: 150%;" valign="top" width="126">
                <a href="http://www.alpinabook.ru/catalog/'.$curr_sect["CODE"].'/'.$NewItemsList["ID"].'/?utm_source=autotrigger&amp;utm_medium=email&amp;utm_term=newbooks&amp;utm_campaign=newordermail" target="_blank">Подробнее о книге</a>
                </td>
                </tr>
                <tr>
                <td align="center" height="18" style="color: #336699;font-weight: normal; border-collapse: collapse;font-family: Roboto,Tahoma,sans-serif;font-size: 16px;line-height: 150%;padding-top:0;" valign="top" width="126">
                <a href="http://www.alpinabook.ru/catalog/'.$curr_sect["CODE"].'/'.$NewItemsList["ID"].'/?utm_source=autotrigger&amp;utm_medium=email&amp;utm_term=newbooks&amp;utm_campaign=newordermail" target="_blank">Купить</a>
                </td>
                </tr>
                </tbody>
                </table>';
                $i++;
            }
            $arFields["NEW_ITEMS_BLOCK"] = $NewItemsBlock;
        }
    }


    // --- couriers popup in admin
    AddEventHandler("main", "OnAdminListDisplay", "curInit");

    function curInit(){
        if($GLOBALS["APPLICATION"] -> GetCurPage() == "/bitrix/admin/sale_order_detail.php" || $GLOBALS["APPLICATION"] -> GetCurPage() == "/bitrix/admin/sale_order.php"){
            $GLOBALS['APPLICATION'] -> AddHeadScript("/admin_modules/couriers/js/couriersListeners.js");
            $GLOBALS['APPLICATION'] -> AddHeadScript("/admin_modules/couriers/js/orderAdmin.class.js");
            $GLOBALS['APPLICATION'] -> AddHeadScript("/admin_modules/couriers/js/popup.class.js");
            $GLOBALS['APPLICATION'] -> AddHeadScript("/admin_modules/couriers/js/index.js");
            $GLOBALS['APPLICATION'] -> SetAdditionalCSS("/admin_modules/couriers/css/style.css");
        }
    }


    //Получение этикетки для бланков заказов, сделанных через PickPoint

    function MakeLabelPickPoint($orderId){
        //Авторизация на сервере PickPoint для получения ключа сессии (Необходим для дальнейшей работы с API)
        $dataLogin = array('Login' => alpina, 'Password' => 12588521);  //Необходимо указать доступы к API выданные клиенту
        $ikn = "9990252912"; //Номер контракта клиента
        $urlLogin = "http://e-solution.pickpoint.ru/api/login";
        $content = json_encode($dataLogin);
        $curl = curl_init($urlLogin);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        $json_response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $response = json_decode($json_response, true);  //Получили ключ сессии(Далее работа будет производится на основе его)
        //Получаем номер отправления в PickPoint по Id заказа
        $obItem = CPickpoint::SelectOrderPostamat($orderId);
        $item = $obItem->Fetch();
        //        arshow($item);
        //Отправляем запрос для получения этикетки в формате pdf
        $dataSend = array('SessionId' => $response["SessionId"], 'Invoices' => array($item["PP_INVOICE_ID"]));
        $urlLabel = "http://e-solution.pickpoint.ru/api/makelabel";
        $content = json_encode($dataSend);
        //        arshow($content);
        $curl = curl_init($urlLabel);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        $json_response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $response = json_decode($json_response, true);  //Получили ключ сессии(Далее работа будет производится на основе его)
        //         arshow($json_response);
        //Преобразуем массив байтов в и
        $imagick = new Imagick();
        $imagick->readImageBlob($json_response);
        $imagick->cropImage(300, 200, 50, 0);
        $imagick->writeImages(getcwd().'/pickpoint_label/'.$orderId.'.jpg', false);
    }




    AddEventHandler("main", "OnBeforeProlog", "checkUser");
    function checkUser() {
        global $USER, $APPLICATION;
        if(!$USER->IsAdmin())
            $APPLICATION->SetAdditionalCSS("/css/temp.css");
    }

    //Add coupon list item in admin menu
    AddEventHandler("main", "OnBuildGlobalMenu", "extraMenu");
    function extraMenu(&$adminMenu, &$moduleMenu){
        $moduleMenu[] = array(
            "parent_menu" => "global_menu_marketing",
            "section" => "webgk.coupons",
            "sort"        => 500,
            "url"         => "coupon-list.php?lang=".LANG,
            "text"        => 'Список купонов правил работы с корзиной',
            "title"       => 'Фильтруемый список купонов правил работы с корзиной',
            "icon"        => "form_menu_icon",
            "page_icon"   => "form_page_icon",
            "items_id"    => "menu_webgk.coupons",
            "items"       => array()
        );
    }

    //Handlers for PickPoint improvements
    AddEventHandler("sale", "OnOrderSave", Array("CustomPickPoint", "RewriteOrderDescription"));

    //Class for PickPoint improvements
    class CustomPickPoint {

        //Rewriting user description in ordres with PickPoint delivery
        function RewriteOrderDescription($id, $arFields) {
            GLOBAL $arParams;
            if($arFields["DELIVERY_ID"] == $arParams["PICKPOINT"]["DELIVERY_ID"]) {
                if(COption::GetOptionString($arParams["PICKPOINT"]["MODULE_ID"], $arParams["PICKPOINT"]["ADD_INFO_NAME"], "")) {
                    $arPropFields = array("ORDER_ID" => $id, "NAME" => $arParams["PICKPOINT"]["ADDRESS_TITLE_PROP"], "VALUE" => $_SESSION["PICKPOINT_ADDRESS"]);
                    if($arFields["PERSON_TYPE_ID"] == $arParams["PICKPOINT"]["LEGAL_PERSON_ID"]) {
                        $arPropFields["ORDER_PROPS_ID"] = $arParams["PICKPOINT"]["LEGAL_ADDRESS_ID"];
                        $arPropFields["CODE"] = $arParams["PICKPOINT"]["LEGAL_ADDRESS_CODE"];
                    } else if($arFields["PERSON_TYPE_ID"] == $arParams["PICKPOINT"]["NATURAL_PERSON_ID"]) {
                        $arPropFields["ORDER_PROPS_ID"] = $arParams["PICKPOINT"]["NATURAL_ADDRESS_ID"];
                        $arPropFields["CODE"] = $arParams["PICKPOINT"]["NATURAL_ADDRESS_CODE"];
                    }
                    CSaleOrderPropsValue::Add($arPropFields);
                    unset($_SESSION["PICKPOINT_ADDRESS"]);
                }
            }
        }   
    }


?>