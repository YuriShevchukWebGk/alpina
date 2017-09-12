<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$latestBooks = "";
$NewItems = CIBlockElement::GetList(array("PROPERTY_shows_a_day" => "DESC"), array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "PROPERTY_STATE" => NEW_BOOK_STATE_XML_ID, "ACTIVE" => "Y", ">DETAIL_PICTURE" => 0), false, Array("nPageSize"=>3), array());
while ($NewItemsList = $NewItems -> Fetch()){
	$pict = CFile::ResizeImageGet($NewItemsList["DETAIL_PICTURE"], array("width" => 140, "height" => 200), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	$curr_sect = CIBlockSection::GetByID($NewItemsList["IBLOCK_SECTION_ID"]) -> Fetch();
	$latestBooks .= '
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
arshow($latestBooks);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>