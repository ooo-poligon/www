<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("������� �������");?><?$APPLICATION->IncludeComponent("poligon:catalog.section_spec", ".default", Array(
	"IBLOCK_TYPE"	=>	"catalog",
	"IBLOCK_ID"	=>	"4",
	"SECTION_ID"	=>	0,
	"ELEMENT_SORT_FIELD"	=>	"sort",
	"ELEMENT_SORT_ORDER"	=>	"asc",
	"FILTER_NAME"	=>	"arrFilter",
	"INCLUDE_SUBSECTIONS"	=>	"Y",
	"PAGE_ELEMENT_COUNT"	=>	"30",
	"LINE_ELEMENT_COUNT"	=>	"3",
	"PROPERTY_CODE"	=>	array(
		0	=>	"article",
		1	=>	"val",
		2	=>	"preview_text",
		3	=>	"number",
		4	=>	"pack",
		5	=>	"VIEW",
		6	=>	"producer_full",
		7	=>	"producer_abbr",
		8	=>	"detail_text",
		9	=>	"SPEC",
		10	=>	"srok",
		11	=>	"pdf",
		12	=>	"link",
		13	=>	"name",
		14	=>	"",
	),
	"SECTION_URL"	=>	"section.php?IBLOCK_ID=#IBLOCK_ID#&SECTION_ID=#SECTION_ID#",
	"DETAIL_URL"	=>	"element.php?IBLOCK_ID=#IBLOCK_ID#&SECTION_ID=#SECTION_ID#&ELEMENT_ID=#ELEMENT_ID#",
	"BASKET_URL"	=>	"/personal/basket.php",
	"ACTION_VARIABLE"	=>	"action",
	"PRODUCT_ID_VARIABLE"	=>	"id",
	"SECTION_ID_VARIABLE"	=>	"SECTION_ID",
	"AJAX_MODE"	=>	"N",
	"AJAX_OPTION_SHADOW"	=>	"Y",
	"AJAX_OPTION_JUMP"	=>	"N",
	"AJAX_OPTION_STYLE"	=>	"Y",
	"AJAX_OPTION_HISTORY"	=>	"N",
	"CACHE_TYPE"	=>	"A",
	"CACHE_TIME"	=>	"3600",
	"META_KEYWORDS"	=>	"-",
	"META_DESCRIPTION"	=>	"-",
	"DISPLAY_PANEL"	=>	"N",
	"DISPLAY_COMPARE"	=>	"N",
	"SET_TITLE"	=>	"Y",
	"CACHE_FILTER"	=>	"N",
	"PRICE_CODE"	=>	array(
		0	=>	"BASE",
		1	=>	"",
	),
	"USE_PRICE_COUNT"	=>	"Y",
	"SHOW_PRICE_COUNT"	=>	"1",
	"PRICE_VAT_INCLUDE"	=>	"Y",
	"DISPLAY_TOP_PAGER"	=>	"N",
	"DISPLAY_BOTTOM_PAGER"	=>	"Y",
	"PAGER_TITLE"	=>	"������",
	"PAGER_SHOW_ALWAYS"	=>	"Y",
	"PAGER_TEMPLATE"	=>	"",
	"PAGER_DESC_NUMBERING"	=>	"N",
	"PAGER_DESC_NUMBERING_CACHE_TIME"	=>	"36000"
	)
);?> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
