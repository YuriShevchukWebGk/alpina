<?

define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS",true);
define('BX_NO_ACCELERATOR_RESET', true);
//echo 111;
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");



CModule::IncludeModule('iblock');

$rs = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 4));
$res = array();
while($book = $rs->GetNextElement()) {
  if(empty($book->GetProperties()["BOOK_CLUB"]["VALUE"])) continue;
  if(empty(CFile::GetPath($book->fields["DETAIL_PICTURE"]))) continue;
  if(empty(CPrice::GetList(array(), array("PRODUCT_ID" => $book->fields["ID"]))->Fetch()["PRICE"])) continue;

  $p = CIBlockElement::GetProperty(4, $book->fields["ID"], array("sort" => "asc"), Array("CODE"=>"AUTHORS"));
  $authors = array();

  while($pp = $p->GetNext()) {
    array_push($authors, CIBlockElement::GetList(array(), array("IBLOCK_ID" => 29,"ID" => $pp["VALUE"]))->Fetch()["NAME"]);
  }

  array_push($res, array(
    "bitrix_id" => $book->fields["ID"],
    "name" => $book->fields["NAME"],
    "picture" => CFile::GetPath($book->fields["DETAIL_PICTURE"]),
    "price" => CPrice::GetList(array(), array("PRODUCT_ID" => $book->fields["ID"]))->Fetch()["PRICE"],
    "author" => implode($authors, ", "),
    "publisher" => $book->GetProperties()["PUBLISHER"]["VALUE"],
    "description" => $book->GetProperties()["DESCRIPTION"]["VALUE"],
    "cover" => $book->GetProperties()["COVER_TYPE"]["VALUE"],
    "pages" => $book->GetProperties()["PAGES"]["VALUE"],
    "year" => $book->GetProperties()["YEAR"]["VALUE"],
    "isbn" => $book->GetProperties()["ISBN"]["VALUE"],
	  "discount" => CCatalogDiscount::GetDiscountByProduct($book->fields["ID"], array("10"), "N", array("11"), SITE_ID),
 ));
}

echo json_encode($res, JSON_PRETTY_PRINT);


/*$db_res = CCatalogProduct::GetList(
        array("QUANTITY" => "DESC"),
        array("QUANTITY_TRACE" => "Y"),
        false,
        array("nTopCount" => 10)
    );
$ar_res = $db_res->Fetch();
var_dump($ar_res["IBLOCK_ID"]);
 $ipropValues = new Iblock\InheritedProperty\ElementValues($ar_res["IBLOCK_ID"], $ar_res["ID"]);
var_dump($ipropValues->getValues());*/