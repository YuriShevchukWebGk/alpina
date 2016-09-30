<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

    $file_path = $_SERVER["DOCUMENT_ROOT"]."/onix/onix.xml";

    $fp = @fopen($file_path, "wb");

    fwrite($fp, '<?xml version="1.0" encoding="utf-8"?>'."\n");   
    fwrite($fp, '<!DOCTYPE ONIXMessage SYSTEM "http://intranet/​onix/​ONIX_BookProduct_3.0_reference.dtd">'."\n");   
    fwrite($fp, '<ONIXMessage release="3.0" xmlns="http://ns.editeur.org/onix/3.0/reference">'."\n");     


    $itemsList = CIBlockElement::GetList(array("NAME" => "ASC"), array("IBLOCK_ID" => CATALOG_IBLOCK_ID), false, false, array("NAME", "ID", "PREVIEW_TEXT", "PROPERTY_ENG_NAME", "PROPERTY_ISBN", "PROPERTY_PAGES", "PROPERTY_AUTHORS", "CATALOG_WEIGHT", "PROPERTY_YEAR", "PROPERTY_CIRCULATION", "PROPERTY_PUBLISHER", "PROPERTY_MORE_PHOTO", "PROPERTY_TRANSLATORS", "DETAIL_PICTURE", "PROPERTY_STATE", "PROPERTY_ARTNUMBER", "PROPERTY_video_about"));    
    while ($arItem = $itemsList->Fetch()) {
        $authors_name = array();
        $authors_IDs = array();
        if (!empty($arItem["PROPERTY_AUTHORS_VALUE"])) {
            foreach ($arItem["PROPERTY_AUTHORS_VALUE"] as $author_ID) {
                $authors_IDs[] = $author_ID;    
            }    
        }
        $translators_name = array();
        $translators_IDs = array();
        if (!empty($arItem["PROPERTY_TRANSLATORS_VALUE"])) {
            foreach ($arItem["PROPERTY_TRANSLATORS_VALUE"] as $translator_ID) {
                $translators_IDs[] = $translator_ID;    
            }    
        }
        $is_illustrated = "01";
        if (!empty($arItem["PROPERTY_MORE_PHOTO_VALUE"])) {
            $is_illustrated = "02";
        }
        if (!empty($translators_IDs)) {
            $translators_info = CIBlockElement::GetList (array(), array("ID" => $translators_IDs), false, false, array());
            while ($translators = $translators_info -> Fetch()) {
                $translators_name[]["FIRST_NAME"] = $translators["FIRST_NAME"];
                $translators_name[]["LAST_NAME"] = $translators["LAST_NAME"];
                $translators_name[]["NAME"] = $translators["NAME"];
                $translators_name[]["INVERTED_NAME"] = $translators["LAST_NAME"] . ", " . $translators["FIRST_NAME"];
            }
        }
        if (!empty($authors_IDs)) {
            $authors_info = CIBlockElement::GetList (array(), array("IBLOCK_ID" => AUTHORS_IBLOCK_ID, "ID" => $authors_IDs), false, false, array());
            while ($authors = $authors_info -> Fetch()) {
                $authors_name[]["FIRST_NAME"] = $authors["FIRST_NAME"];
                $authors_name[]["LAST_NAME"] = $authors["LAST_NAME"];
                $authors_name[]["NAME"] = $authors["NAME"];
                $authors_name[]["INVERTED_NAME"] = $authors["LAST_NAME"] . ", " . $authors["FIRST_NAME"];
            }
        }
        $binding_ID = "";
        $type_ID = "";
        switch ($arItem["PROPERTY_COVER_TYPE_ENUM_ID"]) {
            case 168:
                $binding_ID = "B214";
                break;
            case 169:
                $binding_ID = "B315";
                break;
            case 170:
                $binding_ID = "B501";
                break;
            case 171:
                break;
            case 172:
                break;
            case 173:
                $binding_ID = "B113";
                break;
            case 174:
                $binding_ID = "B504";
                break;
            case 341:
                $binding_ID = "A103";
                break;
            case 349:
                $binding_ID = "B403";
                break;
        }
        switch ($arItem["PROPERTY_TYPE_ENUM_ID"]) {
            case 17:
                $type_ID = "BA";
                break;
            case 18:
                $type_ID = "AA";
                break;
            case 19:
                $type_ID = "VA";
                break;
            case 20:
                $type_ID = "SA";
                break;
            default:
                $type_ID = "BA";
        }
        $front_cover = CFile::GetFileArray($arItem["DETAIL_PICTURE"]);
        $publishing_status = "";
        $product_availability = "";
        switch ($arItem["PROPERTY_STATE_ENUM_ID"]) {
            case 21:
                $publishing_status = "04";
                $product_availability = "21";
                break;
            case 22:
                $publishing_status = "02";
                $product_availability = "10";
                break;
            case 23:
                $publishing_status = "06";
                $product_availability = "31";
                break;
            default:
                $publishing_status = "04";
                $product_availability = "21";
        }
        fwrite($fp, '<Product>'."\n");
        fwrite($fp, '<RecordReference>' . $arItem["ID"] . '</RecordReference>'."\n");
        fwrite($fp, '<NotificationType>03</NotificationType>'."\n");
       
        fwrite($fp, '<ProductIdentifier>'."\n");
        fwrite($fp, '<ProductIDType>01</ProductIDType>'."\n");
        fwrite($fp, '<IDValue>' . $arItem['PROPERTY_ARTNUMBER_VALUE'] . '</IDValue>'."\n");
        fwrite($fp, '</ProductIdentifier>'."\n");
        
        fwrite($fp, '<ProductIdentifier>'."\n");
        fwrite($fp, '<ProductIDType>15</ProductIDType>'."\n");
        fwrite($fp, '<IDValue>' . $arItem['PROPERTY_ISBN_VALUE'] . '</IDValue>'."\n");
        fwrite($fp, '</ProductIdentifier>'."\n");
        
        fwrite($fp, '<DescriptiveDetail>'."\n");
        
        fwrite($fp, '<ProductComposition>00</ProductComposition>'."\n");
        fwrite($fp, '<ProductForm>' . $type_ID . '</ProductForm>'."\n");
       
        fwrite($fp, '<Measure>'."\n");
        fwrite($fp, '<MeasureType>08</MeasureType>'."\n");
        fwrite($fp, '<Measurement>' . $arItem["CATALOG_WEIGHT"] . '</Measurement>'."\n");
        fwrite($fp, '<MeasureUnitCode>gr</MeasureUnitCode>'."\n");
        fwrite($fp, '</Measure>'."\n");
                
        fwrite($fp, '<ProductPart>'."\n");
        
        fwrite($fp, '<PrimaryPart/>'."\n");
        
        fwrite($fp, '<ProductIdentifier>'."\n");
        fwrite($fp, '<ProductIDType>15</ProductIDType>'."\n");
        fwrite($fp, '<IDValue>' . $arItem['PROPERTY_ISBN_VALUE'] . '</IDValue>'."\n");
        fwrite($fp, '</ProductIdentifier>'."\n");
        fwrite($fp, "<NumberOfCopies>" . $arItem["PROPERTY_CIRCULATION_VALUE"] . "</NumberOfCopies>"."\n");
        
        fwrite($fp, '</ProductPart>'."\n");
        
        fwrite($fp, '<NoCollection />'."\n");
        fwrite($fp, '<TitleDetail>'."\n");
        fwrite($fp, '<TitleType>01</TitleType>'."\n");
      
        fwrite($fp, '<TitleElement>'."\n");
        fwrite($fp, '<TitleElementLevel>01</TitleElementLevel>'."\n");
        fwrite($fp, '<TitleText>'.$arItem["NAME"].'</TitleText>'."\n");
        fwrite($fp, '<YearOfAnnual>' . $arItem["PROPERTY_YEAR_VALUE"] . '</YearOfAnnual>'."\n");
        fwrite($fp, '</TitleElement>'."\n");
        
        if (strlen($arItem["PROPERTY_ENG_NAME_VALUE"]) > 0) {
            fwrite($fp, '<TitleElement>'."\n");
            fwrite($fp, '<TitleElementLevel>01</TitleElementLevel>'."\n");
            fwrite($fp, '<TitleText language="eng">'.$arItem["PROPERTY_ENG_NAME_VALUE"].'</TitleText>'."\n");
            fwrite($fp, '</TitleElement>'."\n");
        }
       
        fwrite($fp, '</TitleDetail>'."\n");
        
        fwrite($fp, '<Contributor>'."\n");
        fwrite($fp, '<SequenceNumber>1</SequenceNumber>'."\n");
        fwrite($fp, '<ContributorRole>A01</ContributorRole>'."\n");
        
        foreach ($authors_name as $key => $curr_author) {
            fwrite($fp, '<PersonName>' . $curr_author["NAME"] . '</PersonName>'."\n");
            fwrite($fp, '<PersonNameInverted>' . $curr_author["INVERTED_NAME"] . '</PersonNameInverted>'."\n");
            fwrite($fp, '<NamesBeforeKey>' . $curr_author["FIRST_NAME"] . '</NamesBeforeKey>'."\n");
            fwrite($fp, '<KeyNames>' . $curr_author["LAST_NAME"] . '</KeyNames>'."\n");   
        }
        fwrite($fp, '</Contributor>'."\n"); 
        
        fwrite($fp, '<Contributor>'."\n");
        fwrite($fp, '<SequenceNumber>1</SequenceNumber>'."\n");
        fwrite($fp, '<ContributorRole>B06</ContributorRole>'."\n");
        
        foreach ($translators_name as $key => $curr_translator) {
            fwrite($fp, '<PersonName>' . $curr_translator["NAME"] . '</PersonName>'."\n");
            fwrite($fp, '<PersonNameInverted>' . $curr_translator["INVERTED_NAME"] . '</PersonNameInverted>'."\n");
            fwrite($fp, '<NamesBeforeKey>' . $curr_translator["FIRST_NAME"] . '</NamesBeforeKey>'."\n");
            fwrite($fp, '<KeyNames>' . $curr_translator["LAST_NAME"] . '</KeyNames>'."\n");   
        }
        fwrite($fp, '</Contributor>'."\n");
        fwrite($fp, '<NoEdition />'."\n");
     
        fwrite($fp, '<Language>'."\n");
        fwrite($fp, '<LanguageRole>01</LanguageRole>'."\n");
        fwrite($fp, '<LanguageCode>rus</LanguageCode>'."\n");
        fwrite($fp, '</Language>'."\n");
     
        fwrite($fp, '<Extent>'."\n");
        fwrite($fp, '<ExtentType>00</ExtentType>'."\n");
        fwrite($fp, '<ExtentValue>' . $arItem["PROPERTY_PAGES_VALUE"] . '</ExtentValue>'."\n");
        fwrite($fp, '<ExtentUnit>03</ExtentUnit>'."\n");
        fwrite($fp, '</Extent>'."\n");
       
        fwrite($fp, '<Illustrated>' . $is_illustrated . '</Illustrated>'."\n");
        
        fwrite($fp, '</DescriptiveDetail>'."\n");
        
        fwrite($fp, '<CollateralDetail>'."\n");
        fwrite($fp, '<TextContent>'."\n");
        fwrite($fp, '<TextType>02</TextType>'."\n");
        fwrite($fp, '<ContentAudience>00</ContentAudience>'."\n");
        fwrite($fp, '<Text>' . $arItem["PREVIEW_TEXT"] . '</Text>'."\n");
        foreach ($authors_name as $key => $curr_author) {
            fwrite($fp, '<TextAuthor>' . $curr_author["NAME"] . '</TextAuthor>'."\n");
        }
        fwrite($fp, '<ContentDate>'."\n");
        fwrite($fp, '<ContentDateRole>01</ContentDateRole>'."\n");
        fwrite($fp, '<Date dateformat="05">' . $arItem["PROPERTY_YEAR_VALUE"] . '</Date>'."\n");
        fwrite($fp, '</ContentDate>'."\n");
        fwrite($fp, '</TextContent>'."\n");
        
        if ($front_cover["SRC"]) {
            fwrite($fp, '<SupportingResource>'."\n");
            fwrite($fp, '<ResourceContentType>01</ResourceContentType>'."\n");
            fwrite($fp, '<ContentAudience>00</ContentAudience>'."\n");
            fwrite($fp, '<ResourceMode>03</ResourceMode>'."\n");
            fwrite($fp, '<ResourceVersion>'."\n");
            fwrite($fp, '<ResourceForm>02</ResourceForm>'."\n");
            fwrite($fp, '<ResourceLink>' . $_SERVER["DOCUMENT_ROOT"] . $front_cover["SRC"] . '</ResourceLink>'."\n");
            fwrite($fp, '</ResourceVersion>'."\n");
            fwrite($fp, '</SupportingResource>'."\n");
        }
        
        if ($arItem["PROPERTY_video_about_VALUE"]) {
            fwrite($fp, '<SupportingResource>'."\n");
            fwrite($fp, '<ResourceContentType>26</ResourceContentType>'."\n");
            fwrite($fp, '<ContentAudience>00</ContentAudience>'."\n");
            fwrite($fp, '<ResourceMode>05</ResourceMode>'."\n");
            fwrite($fp, '<ResourceVersion>'."\n");
            fwrite($fp, '<ResourceForm>01</ResourceForm>'."\n");
            fwrite($fp, '<ResourceLink>' . $arItem["PROPERTY_video_about_VALUE"] . '</ResourceLink>'."\n");
            fwrite($fp, '</ResourceVersion>'."\n");
            fwrite($fp, '</SupportingResource>'."\n");
        }
        
        fwrite($fp, '</CollateralDetail>'."\n");
        
        fwrite($fp, '<PublishingDetail>'."\n");
       
        fwrite($fp, '<Publisher>'."\n");
        
        fwrite($fp, '<PublishingRole>01</PublishingRole>'."\n");
        fwrite($fp, '<PublisherIdentifier>'."\n");
        fwrite($fp, '<PublisherIDType>01</PublisherIDType>'."\n");
        fwrite($fp, '<IDValue>' . $arItem["PROPERTY_PUBLISHER_ENUM_ID"] . '</IDValue>'."\n");
        fwrite($fp, '</PublisherIdentifier>'."\n");
        fwrite($fp, '<PublisherName>' . $arItem["PROPERTY_PUBLISHER_VALUE"] . '</PublisherName>'."\n");
        fwrite($fp, '</Publisher>'."\n");
        
        fwrite($fp, '<PublishingStatus>' . $publishing_status . '</PublishingStatus>'."\n");
        fwrite($fp, '<PublishingDate>'."\n");
        fwrite($fp, '<PublishingDateRole>01</PublishingDateRole>'."\n");
        fwrite($fp, '<Date dateformat="05">' . $arItem["PROPERTY_YEAR_VALUE"] . '</Date>'."\n");
        fwrite($fp, '</PublishingDate>'."\n");
        
        fwrite($fp, '</PublishingDetail>'."\n");
        
        fwrite($fp, '<ProductSupply>'."\n");
        
        fwrite($fp, '<Market>'."\n");
        fwrite($fp, '<Territory>'."\n");
        fwrite($fp, '<CountriesIncluded>KZ US CA AL AD AT BE BG HR DK FI FR DE GR HU IS IT LI LU MK MT MC NL NO PL PT RO SK SI IE ES SE CH GB VA YU BA CZ MX IL AU AO NZ AZ EE GE LV LT MD TM AM TJ UZ KG RU UA BY</CountriesIncluded>'."\n");
        fwrite($fp, '</Territory>'."\n");
        fwrite($fp, '</Market>'."\n");
        
        fwrite($fp, '<SupplyDetail>'."\n");
        fwrite($fp, '<Supplier>'."\n");
        fwrite($fp, '<SupplierRole>00</SupplierRole>'."\n");
        fwrite($fp, '</Supplier>'."\n");  
        
        fwrite($fp, '<ProductAvailability>' . $product_availability . '</ProductAvailability>'."\n");  
        
        fwrite($fp, '</SupplyDetail>'."\n");
        fwrite($fp, '</ProductSupply>'."\n");
        fwrite($fp, '</Product>'."\n");
    }



    fwrite($fp, '</ONIXMessage>'."\n");

    fclose($fp);