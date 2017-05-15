<?
    require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/.config.php");
    require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/sailplay.php");
    file_exists('/home/bitrix/vendor/autoload.php') ? require '/home/bitrix/vendor/autoload.php' : "";
    use Mailgun\Mailgun;

    CModule::IncludeModule("blog");
    CModule::IncludeModule("iblock");
    CModule::IncludeModule("sale");
    CModule::IncludeModule("catalog");
    CModule::IncludeModule("main");
    CModule::IncludeModule('highloadblock');
    use Bitrix\Main;
    use Bitrix\Main\Loader;
    use Bitrix\Main\Localization\Loc;
    use Bitrix\Sale\Internals;
    use Bitrix\Highloadblock as HL;
    use Bitrix\Main\Entity;

    // ID раздела подборок на главной - из каталога книг
    define ("MAIN_PAGE_SELECTIONS_SECTION_ID", 209);
    define ("CATALOG_IBLOCK_ID", 4);
    define ("AUTHORS_IBLOCK_ID", 29);
    define ("REVIEWS_IBLOCK_ID", 24);
    define ("SERIES_IBLOCK_ID", 45);
    define ("SPONSORS_IBLOCK_ID", 47);
    define ("WISHLIST_IBLOCK_ID", 17);
    define ("EXPERTS_IBLOCK_ID", 23);
    define ("LECTIONS_ANNOUNCES_IBLOCK_ID", 60);
    define ("EXPERTS_REVIEWS_IBLOCK_ID", 31);
    define ("SERIES_BANNERS_IBLOCK_ID", 54); // 53 - для тестовой копии
    define ("INFO_MESSAGES_IBLOCK_ID", 53); // 52 - для тестовой копии
    define ("SUSPENDED_BOOKS_BUYERS_IBLOCK", 55); // 54 - для тестовой копии
    define ("NEW_BOOK_STATE_XML_ID", 21);
    define ("BESTSELLER_BOOK_XML_ID", 285);
    define ("COVER_TYPE_SOFTCOVER_XML_ID", 168);
    define ("COVER_TYPE_HARDCOVER_XML_ID", 169);
    define ("RFI_PAYSYSTEM_ID", 13);
    define ("PAYPAL_PAYSYSTEM_ID", 16);
    define ("SBERBANK_PAYSYSTEM_ID", 14);
    define ("CASHLESS_PAYSYSTEM_ID", 12);
    define ("FLIPPOST_ID", 30);
    define ("BOXBERY_ID", 50);
    define ("GURU_DELIVERY_ID", 43);
    define ("EXPORTED_TO_GURU_PROPERTY_ID_NATURAL", 90); // физ. лицо
    define ("EXPORTED_TO_GURU_PROPERTY_ID_LEGAL", 91); // юр. лицо
    define ("PICKPOINT_DELIVERY_ID", 18);
    define ("CITY_INDIVIDUAL_ORDER_PROP_ID", 2);
    define ("CITY_ENTITY_ORDER_PROP_ID", 3);
    define ("ADDRESS_INDIVIDUAL_ORDER_PROP_ID", 5);
    define ("ADDRESS_ENTITY_ORDER_PROP_ID", 14);
    define ("SUSPENDED_BOOKS_PRICE_ID", 12);
    define ("PICKUP_DELIVERY_ID", 2);
    define ("GIFT_BOOK_PROPERTY_ID", 427); // 419 - для тестовой копии
    define ("GIFT_BOOK_QUANTITY_PROPERTY_ID", 428); // 420 - для тестовой копии
    define ("GIFT_BOOK_BUYER_EMAIL_PROPERTY_ID", 429);
    define ("GIFT_COUNPON_IBLOCK_ID", 51); //инфоблок, в котором хранится информация о подарочных сертификатах
    define ("RECURRENT_URL", "https://www.alpinabook.ru");
    define ("DELIVERY_MAIL", 10);
    define ("DELIVERY_MAIL_2", 11);
    define ("DELIVERY_PICK_POINT", 18);
    define ("DELIVERY_FLIPOST", 30);
    define ("LEGAL_ENTITY_PERSON_TYPE_ID", 2);
    define ("BIK_FOR_EXPENSE_OFFER", "044525716");
    define ("PROPERTY_SHOWING_DISCOUNT_ICON_VARIANT_ID", 350); // 354 - для тестовой копии
    define ("GURU_LEGAL_ENTITY_MAX_WEIGHT", 10000); // максимальный допустимый вес для юр. лиц у доставки гуру
    define("TRADING_FINANCE_SECTION_ID", 111);

	define("WIDGET_PREVIEW_WIDTH", 70);
	define("WIDGET_PREVIEW_HEIGHT", 90);
    define("FREE_SHIPING", 2000); //стоимость заказа для бесплатной доставки
    define("BOXBERRY_DELIVERY_SUCCES", 'Выдано'); //Название статуса выдачи посылки в ответе API boxberry
    define("BOXBERRY_DELIVERED", 'Поступило в пункт выдачи'); //Название статуса поступления в ПВЗ в ответе API boxberry
    define("CERTIFICATE_SECTION_ID", 143); //Инфоблок с подарочными сертификатами
    define("MAIL_FROM_DEFAULT", 'shop@alpinabook.ru'); //Инфоблок с подарочными сертификатами

    define("CERTIFICATE_IBLOCK_ID", 68); //Инфоблок с заказами сертификатов/ для копии 67
    define("NEW_LEGAL_PERSON_CERTIFICATE_ORDER_EVENT", "LEGAL_NEW_CERTIFICATE"); // тип почтового события при покупке нового серификата юр лицом

    define("CERTIFICATE_NATURAL_PERSON_PROPERTY_ID", 910); //Тип покупателя физ.лицо для флага "Тип покупателя" в инфоблоке сертификатов, на копии 906
	define("CERTIFICATE_LEGAL_PERSON_PROPERTY_ID", 911); //Тип покупателя юр.лицо для флага "Тип покупателя" в инфоблоке сертификатов, на копии 907

	define("CERTIFICATE_ORDERS_COUPONS_ID_FIELD", 783); // Поле с идентификаторами купонов, на копии 766
	define("CERTIFICATE_ORDERS_COUPONS_CODE_FIELD", 784); // Поле с кодами купонов, на копии 767

    define("SEND_CERTIFICATE_TO_USER_EVENT", 'SEND_CERTIFICATE_TO_USER'); // Шаблон письма с отправкой сертификата пользователям

    define("SEARCH_INDEX_HL_ID", 3); //ID HL блока для поиска
    define("PREORDER_BASKET_HL_ID", 4); //ID HL блока хранения корзины до предзаказа
    define("CERTIFICATE_SECTION_ID", 143); //Инфоблок с подарочными сертификатами

    define ("DELIVERY_DATE_LEGAL_ORDER_PROP_ID", 45);
    define ("DELIVERY_DATE_NATURAL_ORDER_PROP_ID", 44);

    /**
    *
    * Отдельная функция для писем с вложениями, т.к. разобрать то, что шлет битрикс нереально
    * @param array $arFields,
    * @param array $arTemplate
    * @return bool
    *
    * */


    /**
    *
    * Кастомная функция отправки почты через Mailgun
    * @link https://documentation.mailgun.com/user_manual.html#sending-via-api
    *
    * @param string $to
    * @param string $subject
    * @param string $message
    * @param string $additional_headers
    * @param string $additional_parameters
    *
    **/
    function custom_mail($to, $subject, $message, $attachments, $additional_headers = '', $additional_parameters = '') {

        GLOBAL $arParams;

        // т.к. доп заголовки битрикс передает строкой, то придется их вырезать
        $from_pattern = "/(?<=From:)(.*)(?=)/";
        $bcc_pattern = "/(?<=BCC:)(.*)(?=)/";
        $from_matches = array();
        $bcc_matches = array();
        preg_match($from_pattern, $additional_headers, $from_matches);
        preg_match($bcc_pattern, $additional_headers, $bcc_matches);

        $mailgun = new Mailgun($arParams['MAILGUN']['KEY']);
        $params = array(
            'from'    => ($from_matches[0])?$from_matches[0]:MAIL_FROM_DEFAULT,
            'to'      => $to,
            'subject' => $subject,
            'html'    => $message
        );



        if (trim($bcc_matches[0])) {
            $params['bcc'] = $bcc_matches[0];
        }
        //$attachments = 'https://www.alpinabook.ru/img/twi.png';
        $domain = $arParams['MAILGUN']['DOMAIN'];
        # Make the call to the client.
        $result = $mailgun->sendMessage($domain, $params, array('attachment' => $attachments));
    }


    AddEventHandler('main', 'OnBeforeEventSend', "messagesWithAttachments");

    function messagesWithAttachments($arFields, $arTemplate) {
        GLOBAL $arParams;

        if (is_array($arTemplate['FILE']) && !empty($arTemplate['FILE'])) {

            $mailgun = new Mailgun($arParams['MAILGUN']['KEY']);
            $email_from = trim($arTemplate['EMAIL_FROM'], "#") == "DEFAULT_EMAIL_FROM" ? COption::GetOptionString('main', 'email_from') : $arFields[trim($arTemplate['EMAIL_FROM'], "#")];

            // заменяем все максросы в письме на значения из $arFields
            // Все поля обязательно должны присутсвовать, иначе в письме придет макрос !!
            $message_body = $arTemplate['MESSAGE'];
            foreach ($arFields as $field_name => $field_value) {
                $message_body = str_replace("#" . $field_name . "#", $field_value, $message_body);
            }
            // подставляем email шаблона который передается от определенного события в переменных либо email либо email_to
            if($arFields[trim($arTemplate['EMAIL'], "#")]){
                $email_to = $arFields[trim($arTemplate['EMAIL'], "#")];
            } else {
                $email_to = $arFields[trim($arTemplate['EMAIL_TO'], "#")];
            }

            $attachments = array();
            foreach ($arTemplate['FILE'] as $file) {
                if ($file_path = CFile::GetPath($file)) {
                    $attachments = "@".$file_path;
                    /*array_push(
                        $attach,
                        $_SERVER["DOCUMENT_ROOT"] . str_replace('http://files.alpinabook.ru', '', $file_path)
                    );  */
                }
            }

            $params = array(
                'from'    => ($email_from)?$email_from:MAIL_FROM_DEFAULT,
                'to'      => $email_to,//$arFields["EMAIL"],
                'subject' => $arTemplate['SUBJECT'],
                'html'    => $message_body,
            );

            if ($arFields['BCC']) {
                $params['bcc'] = $arFields['BCC'];
            }

            if ($arFields['SALE_EMAIL']) {
                $params['cc'] = $arFields['SALE_EMAIL'];
            }


          //  custom_mail('st@webgk.ru',$arTemplate['SUBJECT'], $message_body.'<a align="center" href="'.$attachments.'">Ссылка на подарок</a>', $attachments);
           // custom_mail('st@webgk.ru',$arTemplate['SUBJECT'], $attach, $attachments);

            $domain = $arParams['MAILGUN']['DOMAIN'];

          //  # Make the call to the client.
            $result = $mailgun->sendMessage($domain, $params, array('attachment' => $attachments));

            return false;
        }
    }



    /**
     * Дефолтные значения для флиппост на случай, если что-то пошло не так и цена доставки 0
     *
     * @return array
     * */
    function getDefaultFlippostValues() {
        return $flippost_default_values = array(
            array(
                "PRICE" => 1500.00,
                "WEIGHT" => array(0, 5000)
            ),
            array(
                "PRICE" => 3000.00,
                "WEIGHT" => 5000
            ),
        );
    }

    /**
     * Дефолтные значения для доставки гуру на случай, если что-то пошло не так и цена доставки 0
     *
     * @return array
     * */
    function getDefaultGuruValues() {
        return $guru_default_values = array(
            "PRICE" => 269,
            "TIME"  => 0
        );
    }

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

    function arshow($array, $adminCheck = false, $dieAfterArshow = false){
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
        if ($dieAfterArshow) {
            die();
        }
    }
    function morph($n, $f1, $f2, $f5) {
        $n = abs(intval($n)) % 100;
        if ($n>10 && $n<20) return $f5;
        $n = $n % 10;
        if ($n>1 && $n<5) return $f2;
        if ($n==1) return $f1;
        return $f5;
    }
    /**
     * Проверка на мобильное устройство
     * */
    function checkMobile() {
        $useragent = $_SERVER['HTTP_USER_AGENT'];
        if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
            return true;
        else
            return false;
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

    AddEventHandler("sale", "OnBeforeOrderAdd", "flippostHandlerBefore"); // меняем цену для flippost
    AddEventHandler("sale", "OnOrderSave", "flippostHandlerAfter"); // меняем адрес для flippost

    /**
     * Handler для доставки flippost. Плюсуем стоимость доставки
     *
     * @param array $arFields
     * @return void
     *
     * */
    function flippostHandlerBefore(&$arFields) {
        if ($arFields['DELIVERY_ID'] == FLIPPOST_ID) {
            $delivery_price = 0;
            $flippost_default_values = getDefaultFlippostValues();
            if ($_REQUEST['flippost_cost']) {
                $delivery_price = $_REQUEST['flippost_cost'];
            } else {
                foreach ($flippost_default_values as $default_variant) {
                    if (is_array($default_variant['WEIGHT'])) {
                        if ((int)$arFields['ORDER_WEIGHT'] > $default_variant['WEIGHT'][0] && (int)$arFields['ORDER_WEIGHT'] <= $default_variant['WEIGHT'][1]) {
                            $delivery_price = $default_variant['PRICE'];
                            break;
                        }
                    } else {
                        if ($arFields['ORDER_WEIGHT'] > $default_variant['WEIGHT']) {
                            $delivery_price = $default_variant['PRICE'];
                            break;
                        }
                    }
                }
            }
            $arFields['PRICE'] += floatval($delivery_price);
            $arFields['PRICE_DELIVERY'] = floatval($delivery_price);
        }
    }

    AddEventHandler("sale", "OnBeforeOrderAdd", "boxberyHandlerBefore"); // меняем цену для boxbery
    AddEventHandler("sale", "OnOrderSave", "boxberyHandlerAfter"); // меняем адрес для boxbery



    /**
     * Handler для доставки boxbery. Плюсуем стоимость доставки
     *
     * @param array $arFields
     * @return void
     *
     * */
    function boxberyHandlerBefore(&$arFields) {
        if ($arFields['DELIVERY_ID'] == BOXBERY_ID) {
            $delivery_price = 0;

            $boxbery_default_values = getDefaultFlippostValues();

            if ($_REQUEST['boxbery_cost']) {
                $delivery_price = $_REQUEST['boxbery_cost'];
            } else {
                foreach ($boxbery_default_values as $default_variant) {
                    if (is_array($default_variant['WEIGHT'])) {
                        if ((int)$arFields['ORDER_WEIGHT'] > $default_variant['WEIGHT'][0] && (int)$arFields['ORDER_WEIGHT'] <= $default_variant['WEIGHT'][1]) {
                            $delivery_price = $default_variant['PRICE'];
                            break;
                        }
                    } else {
                        if ($arFields['ORDER_WEIGHT'] > $default_variant['WEIGHT']) {
                            $delivery_price = $default_variant['PRICE'];
                            break;
                        }
                    }
                }
            }
            $arFields['PRICE'] += floatval($delivery_price);
            $arFields['PRICE_DELIVERY'] = floatval($delivery_price);
        }
    }

    /**
     * Handler для доставки boxbery. Изменяем адрес
     *
     * @param array $arFields
     * @return void
     *
     * */
    function boxberyHandlerAfter($ID, $arFields) {
        GLOBAL $arParams;
        if ($arFields['DELIVERY_ID'] == BOXBERY_ID) {

            $arPropFields = array(
                "ORDER_ID" => $ID,
                "NAME" => $arParams["PICKPOINT"]["ADDRESS_TITLE_PROP"],
                "VALUE" => $_REQUEST['boxbery_address']
            );

            $arPropFields["ORDER_PROPS_ID"] = $arParams["PICKPOINT"]["NATURAL_ADDRESS_ID"];
            $arPropFields["CODE"] = $arParams["PICKPOINT"]["NATURAL_ADDRESS_CODE"];

            CSaleOrderPropsValue::Add($arPropFields);

            // Добавляем полную стоимость заказа в оплату
            $order_instance = Bitrix\Sale\Order::load($ID);
            $payment_collection = $order_instance->getPaymentCollection();
            foreach ($payment_collection as $payment) {
                $payment->setField('SUM', $arFields['PRICE']);
                $payment->save();
            }
        }
    }

    /**
     * Handler для доставки flippost. Изменяем адрес
     *
     * @param array $arFields
     * @return void
     *
     * */
    function flippostHandlerAfter($ID, $arFields) {
        GLOBAL $arParams;
        if ($arFields['DELIVERY_ID'] == FLIPPOST_ID) {
            $arPropFields = array(
                "ORDER_ID" => $ID,
                "NAME" => $arParams["PICKPOINT"]["ADDRESS_TITLE_PROP"],
                "VALUE" => $_REQUEST['flippost_address']
            );

            $arPropFields["ORDER_PROPS_ID"] = $arParams["PICKPOINT"]["NATURAL_ADDRESS_ID"];
            $arPropFields["CODE"] = $arParams["PICKPOINT"]["NATURAL_ADDRESS_CODE"];

            CSaleOrderPropsValue::Add($arPropFields);

            // Добавляем полную стоимость заказа в оплату
            $order_instance = Bitrix\Sale\Order::load($ID);
            $payment_collection = $order_instance->getPaymentCollection();
            foreach ($payment_collection as $payment) {
                $payment->setField('SUM', $arFields['PRICE']);
                $payment->save();
            }
        }
    }

    AddEventHandler("sale", "OnBeforeOrderAdd", "guruHandlerBefore"); // меняем цену для guru
    AddEventHandler("sale", "OnOrderSave", "guruHandlerAfter"); // меняем адрес для guru

    /**
     * Handler для доставки guru. Плюсуем стоимость доставки
     *
     * @param array $arFields
     * @return void
     *
     * */
    function guruHandlerBefore(&$arFields) {
        if ($arFields['DELIVERY_ID'] == GURU_DELIVERY_ID) {
            $delivery_price = $_REQUEST['guru_cost'];
            $arFields['PRICE'] += floatval($delivery_price);
            $arFields['PRICE_DELIVERY'] = floatval($delivery_price);
        }
    }

    /**
     * Handler для доставки guru. Изменяем адрес
     *
     * @param array $arFields
     * @return void
     *
     * */
    function guruHandlerAfter($ID, $arFields) {
        GLOBAL $arParams;
        if ($arFields['DELIVERY_ID'] == GURU_DELIVERY_ID) {
            // Добавляем полную стоимость заказа в оплату
            $order_instance = Bitrix\Sale\Order::load($ID);
            $payment_collection = $order_instance->getPaymentCollection();
            foreach ($payment_collection as $payment) {
                $payment->setField('SUM', $arFields['PRICE']);
                $payment->save();
            }

            // записываем тех данные в поле адреса id пункта самовывоза|дата доставки
            $property_collection = $order_instance->getPropertyCollection();
            if ($arFields['PERSON_TYPE_ID'] == LEGAL_ENTITY_PERSON_TYPE_ID) {
                $address_property_instance = $property_collection->getItemByOrderPropertyId(ADDRESS_ENTITY_ORDER_PROP_ID);
                $exported_to_dg_property_instance = $property_collection->getItemByOrderPropertyId(EXPORTED_TO_GURU_PROPERTY_ID_LEGAL);
            } else {
                $address_property_instance = $property_collection->getItemByOrderPropertyId(ADDRESS_INDIVIDUAL_ORDER_PROP_ID);
                $exported_to_dg_property_instance = $property_collection->getItemByOrderPropertyId(EXPORTED_TO_GURU_PROPERTY_ID_NATURAL);
            }
            $address_property_instance->setValue($_REQUEST['guru_delivery_data']);
            $exported_to_dg_property_instance->setValue("N");

            $order_instance->save();
        }
    }

    //Обновление заказа для доставки Boxberry
    AddEventHandler("sale", "OnBeforeOrderAdd", "boxberryHandlerBefore"); // меняем цену для boxberry
    AddEventHandler("sale", "OnOrderSave", "boxberryHandlerAfter"); // меняем адрес для boxberry

    /**
     * Handler для доставки boxberry. Плюсуем стоимость доставки
     *
     * @param array $arFields
     * @return void
     *
     * */
    function boxberryHandlerBefore(&$arFields) {
        if ($arFields['DELIVERY_ID'] == BOXBERRY_PICKUP_DELIVERY_ID) {
            $delivery_price = $_REQUEST['boxberry_cost'];
            $arFields['PRICE'] += floatval($delivery_price);
            $arFields['PRICE_DELIVERY'] = floatval($delivery_price);
        }
    }

    /**
     * Handler для доставки boxberry. Изменяем адрес
     *
     * @param array $arFields
     * @return void
     *
     * */
    function boxberryHandlerAfter($ID, $arFields) {
        GLOBAL $arParams;
        if ($arFields['DELIVERY_ID'] == BOXBERRY_PICKUP_DELIVERY_ID) {
            // Добавляем полную стоимость заказа в оплату
            $order_instance = Bitrix\Sale\Order::load($ID);
            $payment_collection = $order_instance->getPaymentCollection();
            foreach ($payment_collection as $payment) {
                $payment->setField('SUM', $arFields['PRICE']);
                $payment->save();
            }

            // записываем тех данные в поле адреса id пункта самовывоза
            $property_collection = $order_instance->getPropertyCollection();
            if ($arFields['PERSON_TYPE_ID'] == LEGAL_ENTITY_PERSON_TYPE_ID) {
                $exported_to_dg_property_instance = $property_collection->getItemByOrderPropertyId(EXPORTED_TO_BOXBERRY_PROPERTY_ID_LEGAL);
            } else {
                $exported_to_dg_property_instance = $property_collection->getItemByOrderPropertyId(EXPORTED_TO_BOXBERRY_PROPERTY_ID_NATURAL);
            }
            $exported_to_dg_property_instance_value = $exported_to_dg_property_instance->GetValue();
            if (empty($exported_to_dg_property_instance_value)) {
                $exported_to_dg_property_instance->setValue("N");
            }
            $order_instance->save();
        }
    }

    //Create gift coupon after buy certificate
    AddEventHandler("sale", "OnOrderAdd", Array("Certificate", "GenerateGiftCoupon"));
    class Certificate {
        function GenerateGiftCoupon($ID, $arFields)
        {
            GLOBAL $APPLICATION;
            //Get gift certificate
            $db_res = CIBlockElement::GetList(Array("ID" => "ASC"),  Array("SECTION_ID" => 143), false);
            while ($ar_res = $db_res->Fetch()) {
                $arDiscounts[$ar_res["ID"]]=$ar_res;
            }
            //Get items from order
            $dbItemsInOrder = CSaleBasket::GetList(array("ID" => "ASC"), array("FUSER_ID" => CSaleBasket::GetBasketUserID(),"DELAY"=>'N', 'CAN_BUY'=>'Y', "ORDER_ID" => NULL));

            while ($arItemsInOrder = $dbItemsInOrder->Fetch()) {
                $arItems[$arItemsInOrder["PRODUCT_ID"]] = $arItemsInOrder;
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
                            "IBLOCK_ID" => GIFT_COUNPON_IBLOCK_ID,
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

                $products = getUrlForFreeDigitalBook(substr($ids,0,-1));

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
                    $userGend->Update($order_list['USER_ID'], $fieldsGend);

                    $freeurl = $products['url'];

                    $useremail = Message::getClientEmail($ID);
                } else {
                    $freeurl = 'К сожалению, произошла ошибка. В ближайшее время специалист свяжется с вами и поможет получить бесплатные книги.';
                    $useremail = 'a.marchenkov@alpinabook.ru';
                }
                $mailFields = array(
                    //"EMAIL" => "a-marchenkov@yandex.ru, a.limansky@alpina.ru, t.razumovskaya@alpinabook.ru, karenshain@gmail.com, sarmat2012@yandex.ru",
                    "EMAIL"=> $useremail,
                    "TEXT" => $sendinfo,
                    "URL" => $freeurl,
                    "ORDER_ID" => $ID,
                    "ORDER_USER"=> Message::getClientName($ID)
                );
                if ($order_list[PERSON_TYPE_ID] == 1) {
                    CEvent::Send("FREE_DIGITAL_BOOKS", "s1", $mailFields, "N");
                }

                CSaleOrder::StatusOrder($ID, "D");
            }
        }

        //Create gift coupon after buy certificate
        $IBLOCK_ID = GIFT_COUNPON_IBLOCK_ID;
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
                                                if($arProps["CODE"] == "EMAIL" || $arProps["CODE"] == "F_EMAIL")   {
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


    //обработка флага оплаты, при изменении статусов заказа
    AddEventHandler('sale', 'OnSaleStatusOrder', "triggerLogic");

    function triggerLogic ($ID, $val) {
        $arStatus = array("D", "K", "F"); //статусы заказа "оплачен", "отправлен на почту" РФ и "выполнен"
        //если установлен один из вышеуказанных статусов
        if (in_array($val, $arStatus)) {
            $order = CSaleOrder::GetById($ID);
            //если флаг оплаты не стоит - ставим
            if ($order["PAYED"] != "Y") {
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

                $products = getUrlForFreeDigitalBook(substr($ids,0,-1));

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
                    $userGend->Update($order_list['USER_ID'], $fieldsGend);

                    $freeurl = $products['url'];

                    $useremail = Message::getClientEmail($ID);
                } else {
                    $freeurl = 'К сожалению, произошла ошибка. В ближайшее время специалист свяжется с вами и поможет получить бесплатные книги.';
                    $useremail = 'a.marchenkov@alpinabook.ru';
                }
                $mailFields = array(
                    //"EMAIL" => "a-marchenkov@yandex.ru, a.limansky@alpina.ru, t.razumovskaya@alpinabook.ru, karenshain@gmail.com, sarmat2012@yandex.ru",
                    "EMAIL"=> $useremail,
                    "TEXT" => $sendinfo,
                    "URL" => $freeurl,
                    "ORDER_ID" => $ID,
                    "ORDER_USER"=> Message::getClientName($ID)
                );
                if ($order_list[PERSON_TYPE_ID] == 1) {
                    CEvent::Send("FREE_DIGITAL_BOOKS", "s1", $mailFields, "N");
                }

                // при смене статуса и последующего автоматического CSaleOrder::PayOrder
                // не срабатывает хендлер OnSalePayOrder, поэтому применяем выполнение функции здесь после оплаты

                if (CSaleOrder::PayOrder($ID, "Y", false, false, 0)) {
                    UpdOrderStatus($ID, "Y");
                }
            }
        }


        //----- Отправка смс при изменении статуса заказа
        if (array_key_exists($val,Message::$messages)){
            if ($val=="C") { // ---- статус собран может быть только для заказов с самовывозом
                if (Message::getOrderDeliveryType($ID)==2) {
                    $message = new Message();
                    $order = CSaleOrder::GetById($ID);
                    $result = $message->sendMessage($ID,$val,'',$order['PRICE']);
                }
            } else {
                $message = new Message();
                $result = $message->sendMessage($ID,$val);
            }
        }

        //----- Триггерные письма при изменении статуса заказа
        if ($val=="C") { // Статус собран
            if (Message::getOrderDeliveryType($ID)==2) { //2 - ID службы доставки "самовывоз"
                $arEventFields = array(
                    "EMAIL"=> Message::getClientEmail($ID),
                    "ORDER_USER"=> Message::getClientName($ID),
                    "ORDER_ID"=> $ID

                );
                CEvent::Send("SALE_STATUS_CHANGED_C_NEW", "s1", $arEventFields,"N");
            }
        } elseif ($val=="D") { // Статус оплачен
            if (Message::getOrderDeliveryType($ID) == 2) { // самовывоз
                $orderPayInfo = 'По Вашему заказу поступила оплата. Он будет собран в течение двух рабочих часов.';
            } elseif (Message::getOrderDeliveryType($ID) == 17) { // PickPoint
                $orderPayInfo = 'По Вашему заказу поступила оплата. Он будет собран и передан в службу доставки <a href="http://pickpoint.ru/" target="_blank">PickPoint</a>.';
            } elseif (in_array(Message::getOrderDeliveryType($ID), array(12,13,14,15))) { // Курьерская доставка
                $orderPayInfo = 'По Вашему заказу поступила оплата. Он будет собран и передан курьеру. Ожидайте звонок представителя курьерской службы в день доставки.';
            } elseif (in_array(Message::getOrderDeliveryType($ID), array(49))) { // Boxberry
                $orderPayInfo = 'По Вашему заказу поступила оплата. Он будет собран и передан в службу доставки <a href="http://boxberry.ru/" target="_blank">Boxberry</a>.';
            } else {
                $orderPayInfo = 'По Вашему заказу поступила оплата. Он будет собран и передан в службу доставки.';
            }

            $arEventFields = array(
                "EMAIL" => Message::getClientEmail($ID),
                "ORDER_USER" => Message::getClientName($ID),
                "ORDER_ID" => $ID,
                "ORDER_PAY_INFO" => $orderPayInfo

            );
            CEvent::Send("ORDER_PAYED_MANUAL", "s1", $arEventFields,"N");
        }
    }

    //Получаем ссылку на бесплатную книгу в приложении Бизнес книги
    function getUrlForFreeDigitalBook($productID) {
        $ids = explode(',', $productID);
        $forurl = array();
        $products = array();

        foreach ($ids as $checkbook) {

            $name = CIBlockElement::GetByID($checkbook)->Fetch();
            $name = $name['NAME'];
            $existinstore = CIBlockElement::GetProperty(4, $checkbook, array("sort" => "asc"), Array("CODE"=>"appstore"))->Fetch();

            if ($existinstore[VALUE] == 231) {
                $products[] = array('id' => $checkbook, 'status' => 'ok', 'name' => $name, 'rec' => '', 'recname' => '');
                $forurl[] = $checkbook;
            }/* else {
            $recid = CIBlockElement::GetProperty(4, $checkbook, array("sort" => "asc"), Array("CODE"=>"rec_for_ad"))->Fetch();
            if ($recid[VALUE]) {
            $recname = CIBlockElement::GetByID($recid[VALUE])->Fetch();
            $recname = $recname['NAME'];
            $products[] = array('id' => $checkbook, 'status' => 'rec', 'name' => $name, 'rec' => $recid[VALUE], 'recname' => $recname);
            $forurl[] = $recid[VALUE];
            }
            }*/
        }

        $prepareurl = '';
        foreach ($forurl as $m => $urlid) {
            if ($m == 0) {
                $prepareurl .= '?emag_id[]='.$urlid;
            } else {
                $prepareurl .= '&emag_id[]='.$urlid;
            }
        }
        $freeBookUrl = array();

        $url = "https://api5.alpinadigital.ru/api/v1/gift/emag/".$prepareurl;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array(
                "Content-type: application/json",
                "X-AD-Offer: 1",
                "X-AD-Token: a893c81321e1693e0caad8a6a1a6077c"
            )
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        $outputRes = json_decode(preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
            return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
            }, $output));
        $output = get_object_vars($outputRes[0]);

        if (isset($output["url"])) {
            $freeBookUrl = array('url' => $output["url"], 'products' => $products);
        } else {
            $freeBookUrl = array('url' => 'error', 'products' => $products);
        }

        return $freeBookUrl;
    }

    //Work of custom coupon
    AddEventHandler("sale", "OnBeforeOrderAdd", Array("changeOrderPrice", "changingOrderPriceOnCustomCoupon"));

    AddEventHandler("sale", "OnOrderAdd", Array("changeOrderPrice", "OnOrderCustomCouponHandler"));

    class changeOrderPrice {
        function changingOrderPriceOnCustomCoupon(&$arFields) {
            if ($_SESSION["CUSTOM_COUPON"]["DEFAULT_COUPON"] == "N")  {
                $newPrice = $arFields["PRICE"] - $arFields["DISCOUNT_VALUE"] - (float)$_SESSION["CUSTOM_COUPON"]["COUPON_VALUE"];

                if ($newPrice < 0) {
                    $newPrice = 0;
                    $newPrice = $newPrice + $arFields["PRICE_DELIVERY"];
                }
                $arFields["PRICE"] = $newPrice;
            }
        }

        function OnOrderCustomCouponHandler($ID, $arFields) {
            if ($_SESSION["CUSTOM_COUPON"]["DEFAULT_COUPON"] == "N")  {
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

    AddEventHandler("main", "OnAfterUserRegister", Array("AlpinaBK", "sendUserToBK"));
    AddEventHandler("main", "OnAfterUserUpdate",  Array("AlpinaBK", "updateUserPassword"));
    AddEventHandler("main", "OnBeforeUserLogin", Array("AlpinaBK", "checkUserBeforeLogin"));

    // общий класс для методов, связанных с бизнес книгами
    class AlpinaBK {

        /**
         *
         * Регистрируем нового пользователя в БК после регистрации на сайте
         *
         * */
        public static function sendUserToBK($arFields) {
            $postdata = http_build_query(
                array(
                   'method' => 'sendUserToBK',
                   'token' => BK_TOKEN,
                   'email' => $arFields['EMAIL'],
                   'password' => $arFields['PASSWORD'],
                   'name' => $arFields['NAME'] . " " . $arFields['LAST_NAME']
               )
            );

            $opts = array('http' =>
               array(
                   'method'  => 'POST',
                   'header'  => 'Content-type: application/x-www-form-urlencoded',
                   'content' => $postdata
              )
            );

            $context  = stream_context_create($opts);
            $result = file_get_contents('https://www.alpinabook.ru/api/user/', false, $context);
        }

        /**
         *
         * При сбросе пароля ищем пользователя в БК, если он там есть, то меняем ему пароль на такой же,
         * если нет, то регистрируем нового пользователя в БК
         *
         * @param array $fields
         *
         * */
        public static function updateUserPassword(&$fields) {
            // проверяем, что сбрасывают именно пароль
            if ($fields['PASSWORD'] && $fields['CONFIRM_PASSWORD'] && $fields['RESULT']) {
                // получение данных пользователя
                $user = CUser::GetByID($fields['ID']);
                $user = $user->Fetch();
                // --- запрос на существование пользователя в БК ---
                $data = array(
                    'email' => $user['EMAIL']
                );
                ksort($data);

                $string_to_hash = http_build_query($data);
                $sig = md5($string_to_hash . BK_API_SECRET_KEY);

                $data['sig'] = $sig;

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, BK_REQUESTS_URL . 'b2b/users?' . http_build_query($data));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'X-Auth-Token: ' . BK_API_TOKEN,
                ));
                $data = curl_exec($ch);
                curl_close($ch);
                // --- запрос на существование пользователя в БК ---
                $user = json_decode($data, true);
                if ($user[0]['id']) {
                    // если пользователь есть, то сбросим пароль
                    $data = array(
                        'password' => $fields['CONFIRM_PASSWORD']
                    );
                    ksort($data);

                    $string_to_hash = http_build_query($data);
                    $sig = md5($string_to_hash . BK_API_SECRET_KEY);

                    $data['sig'] = $sig;

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, BK_REQUESTS_URL . 'b2b/users/' . $user[0]['id']);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'X-Auth-Token: ' . BK_API_TOKEN,
                    ));
                    $data = curl_exec($ch);
                    curl_close($ch);
                    // --- запрос сброс пароля в БК ---
                } else {
                    // если нет, то создадим
                    self::sendUserToBK(array(
                        "EMAIL"     => $user['EMAIL'],
                        "PASSWORD"  => $fields['CONFIRM_PASSWORD'],
                        "NAME"      => $user['NAME'],
                        "LAST_NAME" => $user['LAST_NAME']
                    ));
                }
            }
        }

        /**
         *
         * Реализация единого алгоритма авторизации
         *
         * @param array $fields
         *
         * */
        public static function checkUserBeforeLogin(&$fields) {
            // пробуем найти юзера в битрикс
            $users = CUser::GetList(
                ($by = "id"),
                ($order = "asc"),
                array(
                    "=EMAIL" => $fields['LOGIN']
                ),
                array(
                    "FIELDS" => array("ID", "EMAIL", "PASSWORD")
                )
            );
            // если пользователь найден, то дальше работает с ним
            if ($user = $users->Fetch()) {
                $current_hash = $user['PASSWORD'];
                $password = $fields['PASSWORD'];
                $salt = substr($current_hash, 0, (strlen($current_hash) - 32));

                $current_password = substr($current_hash, -32);
                $password = md5($salt . $password);
                // если пароли совпадают, то все ок, просто авторизуем, если нет, то проверим его на БК
                if ($current_password != $password) {
                    $data = array(
                        'email'    => $fields['LOGIN'],
                        'password' => $fields['PASSWORD']
                    );

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, BK_REQUESTS_URL . 'users/login');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'X-AD-Offer: 1'
                    ));
                    $data = curl_exec($ch);
                    curl_close($ch);
                    $bk_response = json_decode($data, true);
                    // если пользователь смог авторизоваться, то меняем его пароль в битриксе на этот
                    if ($bk_response[0]["id"]) {
                        $user_update = new CUser;
                        $user_update->Update(
                            $user["ID"],
                            array(
                              "PASSWORD"         => $fields['PASSWORD'],
                              "CONFIRM_PASSWORD" => $fields['PASSWORD']
                            )
                        );
                        global $USER;
                        if (!is_object($USER)) $USER = new CUser;
                        $auth_result = $USER->Login($fields['LOGIN'], $fields['PASSWORD'], "Y", "Y");
                    }
                }
            } else {
                // если нет, то проверяем, есть ли он в БК
                $data = array(
                    'email'    => $fields['LOGIN'],
                    'password' => $fields['PASSWORD']
                );

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, BK_REQUESTS_URL . 'users/login');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'X-AD-Offer: 1'
                ));
                $data = curl_exec($ch);
                curl_close($ch);
                $bk_response = json_decode($data, true);
                // если пользователь смог авторизоваться, то регистрируем его в альпине
                if ($bk_response[0]["id"]) {
                    $user = new CUser;
                    $user_fields = Array(
                        "EMAIL"             => $fields['LOGIN'],
                        "LOGIN"             => $fields['LOGIN'],
                        "ACTIVE"            => "Y",
                        "GROUP_ID"          => array(3, 4, 5),
                        "PASSWORD"          => $fields['PASSWORD'],
                        "CONFIRM_PASSWORD"  => $fields['PASSWORD']
                    );

                    $ID = $user->Add($user_fields);
                    global $USER;
                    if (!is_object($USER)) $USER = new CUser;
                    $auth_result = $USER->Login($fields['LOGIN'], $fields['PASSWORD'], "Y", "Y");
                }
            }
        }
    }

    AddEventHandler("main", "OnAfterUserRegister", Array("OnAfterUserRegisterHandler", "OnAfterUserRegister"));
    class OnAfterUserRegisterHandler
    {
        function OnAfterUserRegister(&$arFields, &$arTemplate)
        {
            if ($arTemplate["ID"] == 2) {
                $arFields["PASS"] = $arFields["PASSWORD"];
                $arFields["C_PASS"] = $arFields["CONFIRM_PASSWORD"];
            }

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

    AddEventHandler("main", "OnAfterUserAuthorize", "checkSailplayUserExistance");

    /**
    *
    * Проверяем, существует ли пользователь в системе Sailplay,
    * если нет, то добавляем его.
    *
    * @param array
    * @return void
    * */
    function checkSailplayUserExistance($user) {
        if ($token = SailplayHelper::getAuth() && $user['user_fields']['EMAIL']) {
            $result = SailplayHelper::isUserExist($token, $user['user_fields']['EMAIL']);
            if ($result['status'] == 'fail') {
                // если такого пользователя нет, то добавим его
                SailplayHelper::addNewUser($token, $user['user_fields']['EMAIL'], $user['user_fields']['NAME'], $user['user_fields']['LAST_NAME']);
            }
        }
    }

    AddEventHandler("catalog", "OnDiscountUpdate", "updatingSpecPriceProperty");

    /******
    *
    *
    *  обновление значение свойства "Спеццена" в зависимости от скидки на товар
    *
    * @param int $ID - ID скидки на товар
    * @var int $discount_value - значение скидки на товар
    * @var int $prop_value_ID - ID товара в инфоблоке товаров
    *
    *
    ******/
    function updatingSpecPriceProperty($ID, $arFields) {
        if ($arFields["ACTIVE"] == "Y") {
            $discount = CCatalogDiscount::GetByID($ID);
            $discount_value = round($discount["VALUE"]);
            $product = CIBlockProperty::GetPropertyEnum("spec_price", array(), array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "VALUE" => $discount_value));
            while ($product_info = $product -> Fetch()) {
                $prop_value_ID = $product_info["ID"];
            }
            $discount_prods = CCatalogDiscount::GetDiscountProductsList (array(), array("DISCOUNT_ID" => $ID), false, false, array());
            while ($discount = $discount_prods -> Fetch()) {
                CIBlockElement::SetPropertyValues($discount["PRODUCT_ID"], CATALOG_IBLOCK_ID, array("VALUE"=>$prop_value_ID), "spec_price");
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
            "C" => "clientName, Ваш заказ №order собран. Вы можете получить его по адресу 4-ая Магистральная ул., д.5, под. 2, этаж 2 по будням с 8 до 18 часов. Если будут вопросы – звоните +7(495)9808077. Стоимость ordsum руб.",
            "D10" => "Истекает срок хранения Вашего заказа №order. Вы можете получить его по адресу 4-ая Магистральная ул., д.5, 2 под., 2 этаж по будням с 8 до 18 часов. Если будут вопросы – звоните +7(495)9808077",
            "D12" => "Осталось 2 дня до аннулирования Вашего заказа №order. Вы можете получить его по адресу 4-ая Магистральная ул., д.5, 2 под., 2 этаж по будням с 8 до 18 часов. Если будут вопросы – звоните +7(495)9808077",
            "CA" => "Ваш заказ order уже в пути. Курьер cur_name cur_phone",
            "PS" => "Здравствуйте, clientName! Ваш заказ №order из интернет-магазина «Альпина Паблишер» принят Почтой России к отправке. В течение 1-2 недель посылка прибудет в Ваше почтовое отделение! Мы будем держать Вас в курсе событий!",
            "PD" => "Здравствуйте, clientName! Ваш заказ №order из интернет-магазина «Альпина Паблишер» доставлен в Ваше почтовое отделение! Пожалуйста, получите Вашу посылку! Для этого придите в Ваше отделение и назовите оператору трекинг-код. С собой необходимо иметь паспорт. Спасибо за выбор нашего магазина!",
            "P10" => "Здравствуйте, clientName! Пожалуйста, заберите Ваш заказ из магазина «Альпина Паблишер» в Вашем почтовом отделении.",
            "PA" => "Здравствуйте, clientName! Срок хранения Вашего заказ №order из интернет-магазина «Альпина Паблишер» истекает. Пожалуйста, заберите Ваш заказ в почтовом отделении. Спасибо!"
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
            global $arParams;
            $this->user = $arParams["SMS"]["LOGIN"];
            $this->password = $arParams["SMS"]["PASSWORD"];
        }

        /***************
        *
        * Получаем телефон из заказа
        *
        * @param int $id
        * @return string $clearedPhone
        *
        *************/

        function getPhone($id){
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

        function getClientName($id){
            $db_props = CSaleOrderPropsValue::GetOrderProps($id);
            while ($arProps = $db_props->Fetch()){
                if($arProps['CODE']=='F_CONTACT_PERSON'){
                    return $arProps['VALUE'];
                }
            }
        }

        /***************
        *
        * Получаем email клиента из заказа
        *
        * @param int $id
        * @return string $arProps['VALUE']
        *
        *************/

        function getClientEmail($id){
            $db_props = CSaleOrderPropsValue::GetOrderProps($id);
            while ($arProps = $db_props->Fetch()){
                if($arProps['CODE']=='EMAIL'){
                    return $arProps["VALUE"];
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

        public function sendMessage($ID,$val,$curArr,$ordsum){

            $phone = $this->getPhone($ID);
            $name = $this->getClientName($ID);
            $message = preg_replace('/order/',$ID,self::$messages[$val]); // ---- вставляем номер заказа
            $message = preg_replace('/ordsum/',$ordsum,$message); // ---- вставляем сумму заказа
            $message = preg_replace('/clientName/',$name,$message); // ---- вставляем имя клиента
            if($curArr != ''){
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

    /*//----- Отправка смс при новом заказе
    AddEventHandler("sale", "OnOrderNewSendEmail", "sendSMSOnNewOrder");


    function sendSMSOnNewOrder($orderID, &$eventName, &$arFields){
    $message = new Message();
    $result = $message->sendMessage($orderID,"N");
    }*/


    //подмена логина на EMAIL
    AddEventHandler("main", "OnBeforeUserAdd", Array("OnBeforeUserAddHandler", "OnBeforeUserAdd"));
    class OnBeforeUserAddHandler    {
        function OnBeforeUserAdd(&$arFields)
        {
            $arFields['LOGIN'] = $arFields['EMAIL'];

            return $arFields;

        }
    }
    //подмена логина на EMAIL
    AddEventHandler("main", "OnBeforeUserUpdate", Array("UserUpdateClass", "OnBeforeUserUpdateHandler"));
    class UserUpdateClass     {
        // создаем обработчик события "OnBeforeUserUpdate"
        function OnBeforeUserUpdateHandler(&$arFields) {
            if (strlen($arFields['EMAIL']) && !strlen($arFields['LOGIN'])) {
                $arFields['LOGIN'] = $arFields['EMAIL'];
            }
            return $arFields;
        }
    }


    // --- books subscribe
    AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", "sendMailToBookSubs");

    function sendMailToBookSubs(&$arParams){
        if($arParams['IBLOCK_ID']==4){
            $arSelect = Array("NAME","DETAIL_PAGE_URL","DETAIL_PICTURE","PROPERTY_STATE");
            $arFilter = Array("IBLOCK_ID"=>4,"ID"=>$arParams['ID'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
            while($ob = $res->GetNextElement()){
                $arFields = $ob->GetFields();
                $oldElStatus = $arFields['PROPERTY_STATE_ENUM_ID'];
                $bookName = $arFields['NAME'];
                $bookHref = "https://www.alpinabook.ru".$arFields['DETAIL_PAGE_URL'];
                $bookImg = CFile::ResizeImageGet($arFields['DETAIL_PICTURE'], array("width" => 200, "height" => 270), BX_RESIZE_IMAGE_PROPORTIONAL, true);
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
                            "BOOK_IMG" => $bookImg['src']
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
                            "BOOK_IMG" => $bookImg['src']
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
        //arshow(str_split($rub, 3));
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

    function typo($str){
        $pattern = '/\s+(в|без|до|из|к|на|по|о|от|перед|при|через|с|у|и|нет|за|над|для|об|под|про|но|что|не|или)\s+/';
        return preg_replace($pattern, ' \1&nbsp;', $str);
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
            $arFields["PAYMENT_LINK"] = "Для оплаты заказа перейдите по <a href='https://www.alpinabook.ru/personal/order/payment/?ORDER_ID=".$orderArr["ID"]."'>ссылке</a>.";
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
            $arFields['EMAIL_ADDITIONAL_INFO'] .= "Заказ будет собран в&nbsp;течение двух рабочих часов. Забрать заказ можно по&nbsp;адресу <em>м.Полежаевская, ул.4-ая&nbsp;Магистральная, д.5, 2&nbsp;подъезд, 2&nbsp;этаж.</em> <br />Офис работает по&nbsp;будням с&nbsp;8&nbsp;до&nbsp;18&nbsp;часов.";
            $arFields['EMAIL_ADDITIONAL_INFO'] .= "<br /><br /><b>Как к нам пройти</b><br /><br />Метро «Полежаевская», первый вагон из центра (в связи с реконструкцией станции выход из последнего вагона закрыт), из вестибюля налево. После выхода на улицу огибаете метро справа и двигаетесь вдоль Хорошевского шоссе. Далее проходите мимо ресторана «Макдоналдс», банков «Альфа-Банк» и «Промсвязь Банк». Переходите на противоположную сторону к ТЦ «Хорошо», поворачиваете направо и двигаетесь по 4-ой Магистральной улице. Проходите магазин «Ларес» и доходите до дома 5 строения 1. Вам нужен «БЦ на Магистральной», второй подъезд, второй этаж.";
            $arFields['EMAIL_ADDITIONAL_INFO'] .= "</td></tr>";

            $arFields['YANDEX_MAP'] = "<tr><td style=\"border-collapse: collapse;padding-bottom:20px;\"><table align=\"left\" width=\"100%\"><tbody><tr><td align=\"left\" style=\"border-collapse: collapse;color:#393939;font-family: 'Open Sans','Segoe UI',Roboto,Tahoma,sans-serif;font-size: 16px;font-weight: 400;line-height: 100%;font-style: normal;letter-spacing: normal;padding-top:10px;\" colspan=\"2\" valign=\"top\"><img src=\"https://www.alpinabook.ru/img/ymap.png\" /></td></tr></tbody></table></td></tr>";
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
            $bookDescString .= "<a href='https://www.alpinabook.ru".$arItems["DETAIL_PAGE_URL"]."?utm_source=autotrigger&amp;rr_setemail=#EMAIL#&utm_medium=email&utm_term=bookordered&utm_campaign=newordermail' target='_blank'>".$arItems['NAME']."</a>";
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
        if(stristr($arFields["LOGIN"], 'newuser_') == true && in_array($arTemplate["EVENT_NAME"], array('NEW_USER', 'USER_INFO'))) {
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
                <a href="https://www.alpinabook.ru/personal/order/payment/?ORDER_ID='.$arFields["ORDER_ID"].'" style="color: #fff; text-decoration: none;"><span style="line-height: 45px">Оплатить</span></a>
                </div>';
            }
            else
            {
                $pay_button = "";
            }
            $arFields["PAYMENT_BUTTON"] = $pay_button;
        }
    }

    AddEventHandler('main', 'OnBeforeEventSend', 'AddCustomerInfo');

    function AddCustomerInfo (&$arFields, &$arTemplate)
    {
        if ($arTemplate["ID"] == 177)
        {
            $arFields["ORDER_USER"] = Message::getClientName($arFields["ORDER_ID"]);
        }
    }

    AddEventHandler('main', 'OnBeforeEventSend', "SubConfirmFunc");

    function SubConfirmFunc (&$arFields, &$arTemplate)
    {
        if ($arTemplate["ID"] == 168 || $arTemplate["ID"] == 16 || $arTemplate["ID"] == 160)
        {
            $NewItemsBlock = "";
            $i = 0;
            $NewItems = CIBlockElement::GetList (array("timestamp_x" => "DESC"), array("IBLOCK_ID" => 4, "PROPERTY_STATE" => 21, "ACTIVE" => "Y", ">DETAIL_PICTURE" => 0), false, false, array());
            while (($NewItemsList = $NewItems -> Fetch()) && ($i < 3))
            {
                $pict = CFile::ResizeImageGet($NewItemsList["DETAIL_PICTURE"], array("width" => 140, "height" => 200), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                $curr_sect = CIBlockSection::GetByID($NewItemsList["IBLOCK_SECTION_ID"]) -> Fetch();
                $NewItemsBlock .= '
                <table align="left" border="0" cellpadding="8" cellspacing="0" class="tile" width="32%">
                <tbody>
                <tr>
                <td height="200" style="border-collapse: collapse;text-align:center;" valign="top" width="100%">
                <a href="https://www.alpinabook.ru/catalog/'.$curr_sect["CODE"].'/'.$NewItemsList["ID"].'/?utm_source=autotrigger&amp;rr_setemail=#EMAIL#&amp;utm_medium=email&amp;utm_term=newbooks&amp;utm_campaign=newordermail" target="_blank">
                <img alt="'.$NewItemsList["NAME"].'" src="'.$pict["src"].'" style="width: 140px; height: auto;" />
                </a>
                </td>
                </tr>
                <tr>
                <td align="center" height="18" style="color: #336699;font-weight: normal; border-collapse: collapse;font-family: Roboto,Tahoma,sans-serif;font-size: 16px;line-height: 150%;" valign="top" width="126">
                <a href="https://www.alpinabook.ru/catalog/'.$curr_sect["CODE"].'/'.$NewItemsList["ID"].'/?utm_source=autotrigger&amp;rr_setemail=#EMAIL#&amp;utm_medium=email&amp;utm_term=newbooks&amp;utm_campaign=newordermail" target="_blank">Подробнее о книге</a>
                </td>
                </tr>
                <tr>
                <td align="center" height="18" style="color: #336699;font-weight: normal; border-collapse: collapse;font-family: Roboto,Tahoma,sans-serif;font-size: 16px;line-height: 150%;padding-top:0;" valign="top" width="126">
                <a href="https://www.alpinabook.ru/catalog/'.$curr_sect["CODE"].'/'.$NewItemsList["ID"].'/?utm_source=autotrigger&amp;rr_setemail=#EMAIL#&amp;utm_medium=email&amp;utm_term=newbooks&amp;utm_campaign=newordermail" target="_blank">Купить</a>
                </td>
                </tr>
                </tbody>
                </table>';
                $i++;
            }
            $arFields["NEW_ITEMS_BLOCK"] = $NewItemsBlock;
            $arFields["PROMO_PARTNER"] = "";
        }
    }

    AddEventHandler('main', 'OnBeforeEventSend', "DeliveryServiceName");

    function DeliveryServiceName (&$arFields, &$arTemplate)
    {
        if ($arTemplate["ID"] == 131)
        {
            $order_list=CSaleOrder::GetByID($arFields['ORDER_ID']);
            $arFields['HREF']='<a href="https://pochta.ru/tracking#'.$arFields['ORDER_TRACKING_NUMBER'].'" target="_blank">на сайте Почты России</a>.';
            if ($order_list['DELIVERY_ID']==17) {
                $arFields['HREF']='<a href="http://pickpoint.ru/" target="_blank">на сайте PickPoint</a>.';
            } elseif ($order_list['DELIVERY_ID']==30) {
                $arFields['HREF']='<a href="http://flippost.com/instruments/online/" target="_blank">Flipost</a>.';
            } elseif ($order_list['DELIVERY_ID']==49) {
                $arFields['HREF']='<a href="http://boxberry.ru/tracking/" target="_blank">на сайте Boxberry</a>.';
            }
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
        $dataLogin = array('Login' => $arParams["PICKPOINT"]["DATA_ACCESS"]["Login"], 'Password' => $arParams["PICKPOINT"]["DATA_ACCESS"]["Password"]);  //Необходимо указать доступы к API выданные клиенту
        $ikn = $arParams["PICKPOINT"]["IKN"]; //Номер контракта клиента
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
        //страница со списком купонов в админке
        $moduleMenu[] = array(
            "parent_menu" => "global_menu_marketing",
            "section"     => "webgk.coupons",
            "sort"        => 500,
            "url"         => "coupon-list.php?lang=".LANG,
            "text"        => 'Список купонов правил работы с корзиной',
            "title"       => 'Фильтруемый список купонов правил работы с корзиной',
            "icon"        => "form_menu_icon",
            "page_icon"   => "form_page_icon",
            "items_id"    => "menu_webgk.coupons",
            "items"       => array()
        );

        //страница экспорта заказов в "доставка guru"
        $moduleMenu[] = array(
            "parent_menu" => "global_menu_store",
            "section"     => "webgk.guru_export",
            "sort"        => 150,
            "url"         => "guru_export.php?lang=".LANG,
            "text"        => 'Dostavka guru экспорт',
            "title"       => 'Экспорт заказов Dostavka guru',
            "icon"        => "form_menu_icon",
            "page_icon"   => "form_page_icon",
            "items_id"    => "menu_webgk.guru_export",
            "items"       => array()
        );

        //страница экспорта заказов в "boxberry"
        $moduleMenu[] = array(
            "parent_menu" => "global_menu_store",
            "section"     => "webgk.boxberry_export",
            "sort"        => 150,
            "url"         => "boxberry_export.php?lang=".LANG,
            "text"        => 'Boxberry экспорт',
            "title"       => 'Экспорт заказов Boxberry',
            "icon"        => "form_menu_icon",
            "page_icon"   => "form_page_icon",
            "items_id"    => "menu_webgk.boxberry_export",
            "items"       => array()
        );
    }

    AddEventHandler("sale", "OnSaleCancelOrder", "changingOrderStatusAfterCancelling");
    function changingOrderStatusAfterCancelling($ID, $val) {
        if ($val == "Y") {
            CSaleOrder::StatusOrder($ID, "A");
        }
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

        function getDeliveryDate($orderID){
            GLOBAL $arParams;
            //Авторизация на сервере PickPoint для получения ключая сессии (Необходим для дальнейшей работы с API)
            $dataLogin = array('Login' => $arParams["PICKPOINT"]["DATA_ACCESS"]["Login"], 'Password' => $arParams["PICKPOINT"]["DATA_ACCESS"]["Password"]);  //Необходимо указать доступы к API выданные клиенту
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
            //Значения переменный для получения ID постамата данного заказа
            $fromCity = "Москва";
            $obData = CPickpoint::SelectOrderPostamat($orderID);
            while ($postamatData = $obData -> Fetch()) {
                $PTnumber = $postamatData["POSTAMAT_ID"];
            }

            //Данные для получения ориентировочных сроков доставки
            $dataTarifCalc = array('SessionId'=>$response["SessionId"], 'FromCity' => $fromCity , 'ToPT' => $PTnumber);


            $content = json_encode($dataTarifCalc);
            $urlTarif =  "http://e-solution.pickpoint.ru/api/getzone";
            $curlTarif = curl_init($urlTarif);
            curl_setopt($curlTarif, CURLOPT_HEADER, false);
            curl_setopt($curlTarif, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curlTarif, CURLOPT_HTTPHEADER,
                array("Content-type: application/json"));
            curl_setopt($curlTarif, CURLOPT_POST, true);
            curl_setopt($curlTarif, CURLOPT_POSTFIELDS, $content);
            $json_response = curl_exec($curlTarif);
            $status = curl_getinfo($curlTarif, CURLINFO_HTTP_CODE);
            curl_close($curlTarif);
            $responseCalcTarif = json_decode($json_response, true);
            $order_info = CSaleOrder::GetByID($orderID);
            $delivery_min_time = strtotime ($order_info["DATE_INSERT"]) + $responseCalcTarif["Zones"][0]["DeliveryMin"] * 86400 + 2 * 86400;
            $delivery_min_date = strtolower(FormatDate("j F", MakeTimeStamp(date("d.m.Y", $delivery_min_time), "DD.MM.YYYY HH:MI:SS")));
            $delivery_max_time = $delivery_min_time + 5 * 86400;
            $delivery_max_date = strtolower(FormatDate("j F", MakeTimeStamp(date("d.m.Y", $delivery_max_time), "DD.MM.YYYY HH:MI:SS")));
            $date = $delivery_min_date. " - " . $delivery_max_date;
            return $date;
        }
    }

    /*AddEventHandler('main', 'OnEpilog', '_Check404Error', 1);
    function _Check404Error(){
    if(defined('ERROR_404') && ERROR_404=='Y' || CHTTP::GetLastStatus() == "404 Not Found"){
    GLOBAL $APPLICATION;
    $APPLICATION->RestartBuffer();
    require $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/header.php';
    require $_SERVER['DOCUMENT_ROOT'].'/404.php';
    require $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/footer.php';
    }
    } */


    AddEventHandler('sale', 'OnSalePayOrder', 'AddNewGiftIBlockElement');

    /***************
    *
    * добавление нового элемент в инфоблок книг в дар после оплаты соответствующего заказа с подвешенной книги
    *
    * @param int $ID - ID заказа, к которому применена оплата
    * @var array $arProps - массив свойств для создаваемого элемента инфоблока
    * @var array $basket_items - информация о подвешенном товаре, содержащемся в данном заказе
    *
    ***************/

    function AddNewGiftIBlockElement ($ID, $val) {
        if ($val == "Y") {
            $curr_order = CSaleOrder::GetByID ($ID);
            if (!empty($curr_order["USER_DESCRIPTION"]) && $curr_order["DELIVERY_ID"] == PICKUP_DELIVERY_ID) {
                $new_gift_book = new CIBlockElement;
                $ar_props = array();
                $basket_items = CSaleBasket::GetList(
                    array(),
                    array(
                        "ORDER_ID" => $ID
                    ),
                    false,
                    false,
                    array()
                ) -> Fetch();
                $dash_pos = intval(strpos($curr_order["USER_DESCRIPTION"], " "));
                $ar_props[GIFT_BOOK_PROPERTY_ID] = $basket_items["PRODUCT_ID"];
                $ar_props[GIFT_BOOK_QUANTITY_PROPERTY_ID] = intval($basket_items["QUANTITY"]);
                $ar_props[GIFT_BOOK_BUYER_EMAIL_PROPERTY_ID] = substr($curr_order["USER_DESCRIPTION"], $dash_pos + 1);
                $ar_fields = array(
                    "IBLOCK_ID" => SUSPENDED_BOOKS_BUYERS_IBLOCK,
                    "NAME" => substr($curr_order["USER_DESCRIPTION"], 0, $dash_pos),
                    "PROPERTY_VALUES" => $ar_props
                );

                $new_gift_book -> Add ($ar_fields);
                $mail_fields = array("EMAIL" => $ar_props[GIFT_BOOK_BUYER_EMAIL_PROPERTY_ID]);
                CEvent::Send ("BOUGHT_SUSPENDED_BOOK", "s1", $mail_fields, "N");
            }
        }
    }

    function UserOrdersCount($user_id) {
        CModule::IncludeModule("sale");
        $order_list = CSaleOrder::GetList(array(), array("USER_ID" => $user_id), false, false, array());
        $count = $order_list -> SelectedRowsCount();
        return $count;
    }


    /**
    *
    * Проверяет, есть ли у пользователя рекуррентные карты
    *
    * @param $user_id int
    * @return string|bool
    *
    * */
    function isUserHaveRecurrentCard($user_id) {
        $users = CUser::GetList(
            ($by = ""),
            ($order = ""),
            Array(
                "ID" => $user_id
            ),
            Array(
                "SELECT" => Array("UF_RECURRENT_CARD_ID")
            )
        );
        if ($user = $users->NavNext(true, "f_")) {
            return $user["UF_RECURRENT_CARD_ID"];
        } else {
            return false;
        }
    }

    /**
    *
    * @param mixed $data
    * @param string $file
    * @return void
    *
    * */

    function logger($data, $file) {
        file_put_contents(
            $file,
            var_export($data, 1)."\n",
            FILE_APPEND
        );
    }

    /**
     *
     * Выполнить запрос
     *
     * @param array $data
     * @param string $method
     * @param string $request
     * @param string $headers
     * @return mixed $result
     *
     * */

    function performQuery($data, $method = "GET", $request, $headers) {
        $postdata = http_build_query(
            $data
        );

        $opts = array(
            'http' => array(
                'method'  => $method,
                'header'  => 'Content-Type: application/x-www-form-urlencoded' . PHP_EOL . $headers,
                'content' => $postdata
            ),
            'ssl' => array(
                'verify_peer' => false
            )
        );

        $context  = stream_context_create($opts);
        $result = file_get_contents($request, false, $context);

        return $result;
    }

    /***********
    *
    * при добавлении/изменении скидки на товар проставлять свойство "Показывать иконку скидки" у данного товара
    * если активность скидки "Да"
    *
    * @var array $products_ids - ID привязанных к скидке товаров
    *
    */
    AddEventHandler("catalog", "OnDiscountUpdate", "activateShowingDiscountIcon");
    AddEventHandler("catalog", "OnDiscountAdd", "activateShowingDiscountIcon");

    function activateShowingDiscountIcon ($ID, $arFields) {
        $products_ids = array();
        foreach ($arFields["PRODUCT_IDS"] as $product_id) {
            $products_ids[] = $product_id;
        }
        if (!empty($products_ids)) {
            if ($arFields["ACTIVE"] == "Y") {
                foreach ($products_ids as $product_id) {
                    CIBlockElement::SetPropertyValuesEx($product_id, false, array("show_discount_icon" => PROPERTY_SHOWING_DISCOUNT_ICON_VARIANT_ID));
                }
            } else {
                foreach ($products_ids as $product_id) {
                    CIBlockElement::SetPropertyValuesEx($product_id, false, array("show_discount_icon" => "N"));
                }
            }
        } else {
            $discount_info = CCatalogDiscount::GetList (array(), array("ID" => $ID), false, false, array());
            while ($discount = $discount_info -> Fetch()) {
                if (!in_array($discount["PRODUCT_ID"], $products_ids)) {
                    $products_ids[] = $discount["PRODUCT_ID"];
                }
            }
            if (!empty($products_ids)) {
                if ($arFields["ACTIVE"] == "Y") {
                    foreach ($products_ids as $product_id) {
                        CIBlockElement::SetPropertyValuesEx($product_id, false, array("show_discount_icon" => PROPERTY_SHOWING_DISCOUNT_ICON_VARIANT_ID));
                    }
                } else {
                    foreach ($products_ids as $product_id) {
                        CIBlockElement::SetPropertyValuesEx($product_id, false, array("show_discount_icon" => "N"));
                    }
                }
            }
        }
    }

    //агент для выгрузки статусов заказов из личного кабинета Boxberry
    function BoxberryListStatuses() {
        $arFilter = Array(
           "!TRACKING_NUMBER" => null,
           "DELIVERY_ID" => BOXBERRY_PICKUP_DELIVERY_ID,
           "!STATUS_ID" => 'F'
        );
        if ($db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter)) {
            while ($ar_sales = $db_sales->Fetch()) {
                $orders_tracking_number[$ar_sales['ID']] = $ar_sales['TRACKING_NUMBER'];
            }
        };
        foreach($orders_tracking_number as $order_id => $order_tracking_number) {
            $url='http://api.boxberry.de/json.php?token='.BOXBERRY_TOKEN.'&method=ListStatusesFull&ImId='.$order_tracking_number;
            // XXXXXX - код отслеживания заказа
            $handle = fopen($url, "rb");
            $contents = stream_get_contents($handle);
            fclose($handle);
            $data=json_decode($contents,true);
            if ($data['err']) {
                // если произошла ошибка и ответ не был получен:
                echo $data['err'];
            } else {
                foreach($data[statuses] as $status) {
                    $last_status = $status;
                }
                //ждем данных от боксберри
                if($last_status['Name'] == BOXBERRY_DELIVERY_SUCCES) {
                    CSaleOrder::StatusOrder($order_id, "F");
                }
            }
        }
        return 'BoxberryListStatuses();';
    }

    //Логирование изменение статусов заказа, нужно удалить когда проблема исчезнет
    Main\EventManager::getInstance()->addEventHandler('sale', 'OnSaleOrderBeforeSaved', 'OnBeforeOrderUpdateLogger');
    function OnBeforeOrderUpdateLogger(Main\Event $event) {
        $order = $event->getParameter("ENTITY");
        $status_id = $order->GetField("STATUS_ID");
        $order_id = $order->GetField("ID");
        $date = date('Y-m-d, H:i:s');
        global $APPLICATION, $USER;
        $userID = $USER->GetID();
        $curPage = $APPLICATION->GetCurPage();
        $order_log = 'Date: '.$date.'; CurPage: '.$curPage.'; IP: '.$_SERVER['REMOTE_ADDR'].'; UserID: '.$userID.'; OrderStatus: '.$status_id.'; OrderID: '.$order_id.';';
        $file = $_SERVER['DOCUMENT_ROOT'].'/local/php_interface/include/order_log.log';
        logger($order_log, $file);
    }

	/**
	 *
	 * Создаем купоны для заказа сертификатов
	 *
	 * @param int $order_id - номер заказа, хотя это просто номер элемента инфоблока
	 * @param int $quantity
	 * @param int $basket_rule_id
	 *
	 * */

	function generateCouponsForOrder($order_id, $quantity, $basket_rule_id) {
		for ($i = 1; $i <= $quantity; $i++) {

	        //Битриксовая недокументированная функция, генерирует просто ключ в виде строки
	        $arFields['COUPON'] = CatalogGenerateCoupon();
	        $arFields['DISCOUNT_ID'] = $basket_rule_id;
	        $arFields['ACTIVE'] = "Y";
	        $arFields['TYPE'] = 2;
	        $arFields['MAX_USE'] = 1;

	        //Фукнкция из ядра, создаем новый купон в правилах корзины
	        $obCoupon = \Bitrix\Sale\Internals\DiscountCouponTable::add($arFields);

	        //Получаем ID сгенерированного купона
	        $discountIterator = \Bitrix\Sale\Internals\DiscountCouponTable::getList(array(
	            'select' => array('ID'),
	            'filter' => array('COUPON' => $arFields['COUPON'])
	        ));

	        //Собираем массив с ID купонов
	        if($arDiscountIterator = $discountIterator -> fetch()) {
	            $arCertificateID[] = $arDiscountIterator['ID'];
	        }
	        //Собираем массив с кодами купонов
	        $arCouponCode[] = $arFields['COUPON'];
	    }

	    $props = array(
	        'COUPON_ID'   => $arCertificateID,
	        'COUPON_CODE' => $arCouponCode,
	    );

	    // Установим новое значение для данного свойства данного элемента
	    CIBlockElement::SetPropertyValuesEx($order_id, false, $props);

        //Возвращаем новые купоны
        return $arCouponCode;
	}

	AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "certificatePayed");

	/**
	 *
	 * Проверяем, оплачен ли заказ сертификата
	 * За свойство оплачен выдается свойство активность
	 *
	 * */

	function certificatePayed(&$arParams) {
		if ($arParams['IBLOCK_ID'] == CERTIFICATE_IBLOCK_ID) {
			$current_object = CIBlockElement::GetList(
				Array(),
				Array("ID" => $arParams['ID']),
				false,
				Array("nPageSize" => 1),
				Array("ID", "NAME", "ACTIVE", "XML_ID", "PROPERTY_CERT_QUANTITY", "PROPERTY_NATURAL_EMAIL", "PROPERTY_NATURAL_NAME", "PROPERTY_LEGAL_EMAIL", "PROPERTY_LEGAL_NAME", "PROPERTY_CERT_PRICE")
			);
			if ($current_values = $current_object->Fetch()) {
				$order_id = $current_values['ID'];
				$quantity = $current_values['PROPERTY_CERT_QUANTITY_VALUE'];
				$basket_rule_id = $current_values['XML_ID'];
                $cert_name = $current_values['NAME'];
                $cert_price = $current_values['PROPERTY_CERT_PRICE_VALUE'];
                $user_email = '';
                $user_name = '';
                if(!empty($current_values['PROPERTY_NATURAL_EMAIL_VALUE']) && !empty($current_values['PROPERTY_NATURAL_NAME_VALUE'])) {
                    $user_name = $current_values['PROPERTY_NATURAL_NAME_VALUE'];
                    $user_email = $current_values['PROPERTY_NATURAL_EMAIL_VALUE'];
                } elseif(!empty($current_values['PROPERTY_LEGAL_EMAIL_VALUE']) && !empty($current_values['PROPERTY_LEGAL_NAME_VALUE'])) {
                    $user_name = $current_values['PROPERTY_LEGAL_NAME_VALUE'];
                    $user_email = $current_values['PROPERTY_LEGAL_EMAIL_VALUE'];
                }
            }
            $first_coupon_array_key = key($arParams['PROPERTY_VALUES'][CERTIFICATE_ORDERS_COUPONS_CODE_FIELD]);
            //Сохраним все купоны после генерации
            $arCoupons = array();

            if (!$arParams['PROPERTY_VALUES'][CERTIFICATE_ORDERS_COUPONS_CODE_FIELD][$first_coupon_array_key]['VALUE'] && $arParams['ACTIVE'] == "Y") {
                $arCoupons = generateCouponsForOrder($order_id, $quantity, $basket_rule_id);
            }
            $couponListHTML = '';
            foreach($arCoupons as $couponItem) {
                if (!empty($couponItem)) {
                     $couponListHTML .=  '<tr><td align="right" style="border-collapse: collapse;color:#393939;font-family: "Open Sans","Segoe UI",Roboto,Tahoma,sans-serif;font-size: 16px;font-weight: 400;line-height: 100%;font-style: normal;letter-spacing: normal;padding-top:10px;" valign="top">';
                     $couponListHTML .=  $couponItem;
                     $couponListHTML .=  '</td></tr>';
                }
            }
            $arMailFields = array(
                "COUPON_LIST"   => $couponListHTML,
                "ORDER_ID"      => 'CERT_'.$order_id,
                "EMAIL" => trim($user_email),
                "NAME"          => $user_name,
                "CERT_NAME"     => $cert_name,
                "CERT_QUANTITY" => $quantity,
                "CERT_PRICE"    => $cert_price,
                "TOTAL_SUM"     => $quantity * $cert_price
            );
            //Допилить письмо и шаблон
            if (!empty($arCoupons) && !empty($user_email)) {
                CEvent::Send(SEND_CERTIFICATE_TO_USER_EVENT, "s1", $arMailFields, "N");
            }
		}
	}

	// класс для отправки сообщений о новых заказах сертификатов
	class CertificateMail {
		public static function newLegalPersonOrder($order_id) {
			$view_link = sprintf("https://www.alpinabook.ru/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=%d&type=service&ID=%d", CERTIFICATE_IBLOCK_ID, $order_id);
			CEvent::Send(NEW_LEGAL_PERSON_CERTIFICATE_ORDER_EVENT, "s1", array("VIEW_LINK" => $view_link),"N");
		}
	}

    //Обновление HL блока с поисковыми индексами
     \Bitrix\Main\EventManager::getInstance()->addEventHandler(
        'iblock',
        'OnAfterIBlockElementUpdate',
        'HLBlockElementUpdate'
    );
    \Bitrix\Main\EventManager::getInstance()->addEventHandler(
        'iblock',
        'OnAfterIBlockElementAdd',
        'HLBlockElementUpdate'
    );
    function HLBlockElementUpdate(Bitrix\Main\Event $arElement){
        if($arElement['IBLOCK_ID'] == CATALOG_IBLOCK_ID || $arElement['IBLOCK_ID'] == AUTHORS_IBLOCK_ID) {
            $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_SEARCH_WORDS", "PROPERTY_AUTHORS", "PROPERTY_COVER_TYPE", "DETAIL_PAGE_URL");
            $arFilter = Array("ID"=>$arElement['WF_PARENT_ELEMENT_ID'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
            while($arFields = $res->GetNext())
            {
                if (!empty($arFields['NAME'])) {
                    $arHLData['UF_TITLE'] = preg_replace("/([^a-zA-Z\sа-яёА-ЯЁ0-9])/u","",$arFields['NAME']);
                }
                if (!empty($arFields['NAME'])) {
                    $arHLData['UF_TITLE_REAL'] = $arFields['NAME'];
                }
                if (!empty($arFields['DETAIL_PAGE_URL'])) {
                    $arHLData['UF_DETAIL_PAGE_URL'] = $arFields['DETAIL_PAGE_URL'];
                }
                if (!empty($arFields['PROPERTY_SEARCH_WORDS_VALUE'])) {
                    $arHLData['UF_SEARCH_WORDS'] = implode(' ', array($arFields['PROPERTY_SEARCH_WORDS_VALUE'], $arHLData['UF_SEARCH_WORDS']));
                }
                if(!empty($arFields['PROPERTY_AUTHORS_VALUE'])) {
                    if (empty($arHLData['UF_AUTHOR'])) {
                        $autorsOb = CIBlockElement::GetByID($arFields['PROPERTY_AUTHORS_VALUE']);
                        if ($autorsAr = $autorsOb -> fetch()) {
                            $arHLData['UF_AUTHOR'] = $autorsAr['NAME'];
                        }
                    }
                }
                if(!empty($arFields['PROPERTY_COVER_TYPE_VALUE'])) {
                    if (empty($arHLData['UF_COVER_TYPE'])) {
                        $arHLData['UF_COVER_TYPE'] = $arFields['PROPERTY_COVER_TYPE_VALUE'];
                    }
                }
                $arHLData['UF_IBLOCK_ID'] = $arFields['ID'];
            }
            if($arHLData){
                $hlblock = HL\HighloadBlockTable::getById(SEARCH_INDEX_HL_ID)->fetch();
                $entity = HL\HighloadBlockTable::compileEntity($hlblock);
                $entity_data_class = $entity->getDataClass();
                $rsElementID = $entity_data_class::getList(array(
                   "select" => array("ID"),
                   "order"  => array("ID" => "ASC"),
                   "filter" => array('UF_IBLOCK_ID' => $arHLData['UF_IBLOCK_ID'])
                ));
                if($arElementID = $rsElementID->Fetch()){
                    $result = $entity_data_class::update($arElementID['ID'], $arHLData);
                } else {
                    $result = $entity_data_class::add($arHLData);
                }
            }
        }
    }

    //Обновляем корзину, требуется для корректного отображения страницы с заказами, при переходе со страницы офорлмения заказа
    \Bitrix\Main\EventManager::getInstance()->addEventHandler(
        'main',
        'OnProlog',
        'UpdateBasket'
    );
    function UpdateBasket(){
        global $APPLICATION;
        $url = $APPLICATION->GetCurPage();
        if (preg_match("/personal\/cart/i", $url)) {
            require_once($_SERVER["DOCUMENT_ROOT"]."/ajax/ajax_add2basket.php");
        }
    }

    //Удаляем предзаказанный товар из HL блока и меняем статус заказа на предзаказ, перед созданием заказа
    \Bitrix\Main\EventManager::getInstance()->addEventHandler(
        'sale',
        'OnBeforeOrderAdd',
        'DeleteBasketElementFromHL'
    );
    function DeleteBasketElementFromHL(&$arFields){
        $arBasketItems = array();
        foreach($arFields['BASKET_ITEMS'] as $basketItem){
            $arBasketItems[] = $basketItem;
            $arBasketID[] = $basketItem['ID'];
        }

        $hl_block = HL\HighloadBlockTable::getById(PREORDER_BASKET_HL_ID)->fetch();
        $entity = HL\HighloadBlockTable::compileEntity($hl_block);
        $entity_data_class = $entity->getDataClass();

        $table_id = 'tbl_' . $entity_table_name;

        $basket_item_filter = array(
            'UF_BASKET_ID' => $arBasketID
        );

        $result = $entity_data_class::getList(array(
            "select" => array('*'),
            "filter" => $basket_item_filter,
            "order"  => array("ID" => "ASC")
        ));

        $result = new CDBResult($result, $table_id);
        while ($basket_item = $result->Fetch()) {
            if  ($basket_item['UF_DELAY_BEFORE'] == 'Y') {
                $arFields['STATUS_ID'] = 'PR';
            }
            $entity_data_class::Delete($basket_item['ID']);
        }
    }
?>