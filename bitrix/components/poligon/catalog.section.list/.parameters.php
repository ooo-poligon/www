<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$rsIBlockType = CIBlockType::GetList(array("sort"=>"asc"), array("ACTIVE"=>"Y"));
while ($arr=$rsIBlockType->Fetch())
{
	if($ar=CIBlockType::GetByIDLang($arr["ID"], LANGUAGE_ID))
		$arIBlockType[$arr["ID"]] = "[".$arr["ID"]."] ".$ar["NAME"];
}

$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));
while($arr=$rsIBlock->Fetch())
	$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];

$arComponentParameters = array(
	"GROUPS" => array(
	),
	"PARAMETERS" => array(
		"IBLOCK_TYPE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("CP_BCSL_IBLOCK_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlockType,
			"REFRESH" => "Y",
		),
		"IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("CP_BCSL_IBLOCK_ID"),
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),
		"SECTION_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("CP_BCSL_SECTION_ID"),
			"TYPE" => "STRING",
			"DEFAULT" => '={$_REQUEST["SECTION_ID"]}',
		),
		"SECTION_URL" => array(
			"PARENT" => "URL_TEMPLATES",
			"NAME" => GetMessage("CP_BCSL_SECTION_URL"),
			"TYPE" => "STRING",
			"DEFAULT" => "section.php?IBLOCK_ID=#IBLOCK_ID#&SECTION_ID=#SECTION_ID#",
		),
		"COUNT_ELEMENTS" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("CP_BCSL_COUNT_ELEMENTS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => 'Y',
		),
		"TOP_DEPTH" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("CP_BCSL_TOP_DEPTH"),
			"TYPE" => "STRING",
			"DEFAULT" => '2',
		),
		"DISPLAY_PANEL" => Array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("CP_BCSL_DISPLAY_PANEL"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),
		"ADD_SECTIONS_CHAIN" => Array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("CP_BCSL_ADD_SECTIONS_CHAIN"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"CACHE_TIME"  =>  Array("DEFAULT"=>3600),
	),
);
?>
