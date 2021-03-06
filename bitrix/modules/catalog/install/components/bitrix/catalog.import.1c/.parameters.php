<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arIBlockType = array(
	"-" => GetMessage("CP_BCI1_CREATE"),
);
$rsIBlockType = CIBlockType::GetList(array("sort"=>"asc"), array("ACTIVE"=>"Y"));
while ($arr=$rsIBlockType->Fetch())
{
	if($ar=CIBlockType::GetByIDLang($arr["ID"], LANGUAGE_ID))
	{
		$arIBlockType[$arr["ID"]] = "[".$arr["ID"]."] ".$ar["NAME"];
	}
}

$arUGroupsEx = Array();
$dbUGroups = CGroup::GetList($by = "c_sort", $order = "asc");
while($arUGroups = $dbUGroups -> Fetch())
{
	$arUGroupsEx[$arUGroups["ID"]] = $arUGroups["NAME"];
}

$rsSite = CSite::GetList($by="sort", $order="asc", $arFilter=array("ACTIVE" => "Y"));
$arSites = array(
	"-" => GetMessage("CP_BCI1_CURRENT"),
);
while ($arSite = $rsSite->GetNext())
{
	$arSites[$arSite["LID"]] = $arSite["NAME"];
}

$arAction = array(
	"N" => GetMessage("CP_BCI1_NONE"),
	"A" => GetMessage("CP_BCI1_DEACTIVATE"),
	"D" => GetMessage("CP_BCI1_DELETE"),
);

$arComponentParameters = array(
	"GROUPS" => array(
		"PICTURE" => array(
			"NAME" => GetMessage("CP_BCI1_PICTURE"),
		),
	),
	"PARAMETERS" => array(
		"IBLOCK_TYPE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("CP_BCI1_IBLOCK_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlockType,
		),
		"SITE_LIST" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("CP_BCI1_SITE_LIST"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arSites,
		),
		"INTERVAL" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("CP_BCI1_INTERVAL"),
			"TYPE" => "STRING",
			"DEFAULT" => 30,
		),
		"GROUP_PERMISSIONS" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("CP_BCI1_GROUP_PERMISSIONS"),
			"TYPE" => "LIST",
			"VALUES" => $arUGroupsEx,
			"DEFAULT" => array(1),
			"MULTIPLE" => "Y",
		),
		"USE_OFFERS" => array(
			"PARENT" => "ADDITIONAL",
			"NAME" => GetMessage("CP_BCI1_USE_OFFERS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),
		"ELEMENT_ACTION" => array(
			"PARENT" => "ADDITIONAL",
			"NAME" => GetMessage("CP_BCI1_ELEMENT_ACTION"),
			"TYPE" => "LIST",
			"VALUES" => $arAction,
			"DEFAULT" => "D",
		),
		"SECTION_ACTION" => array(
			"PARENT" => "ADDITIONAL",
			"NAME" => GetMessage("CP_BCI1_SECTION_ACTION"),
			"TYPE" => "LIST",
			"VALUES" => $arAction,
			"DEFAULT" => "D",
		),
		"FILE_SIZE_LIMIT" => array(
			"PARENT" => "ADDITIONAL",
			"NAME" => GetMessage("CP_BCI1_FILE_SIZE_LIMIT"),
			"TYPE" => "STRING",
			"DEFAULT" => 200*1024,
		),
		"USE_CRC" => array(
			"PARENT" => "ADDITIONAL",
			"NAME" => GetMessage("CP_BCI1_USE_CRC"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"USE_ZIP" => array(
			"PARENT" => "ADDITIONAL",
			"NAME" => GetMessage("CP_BCI1_USE_ZIP"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"GENERATE_PREVIEW" => array(
			"PARENT" => "PICTURE",
			"NAME" => GetMessage("CP_BCI1_GENERATE_PREVIEW"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
			"REFRESH" => "Y",
		),
	),
);

if($arCurrentValues["GENERATE_PREVIEW"]!="N")
{
	$arComponentParameters["PARAMETERS"]["PREVIEW_WIDTH"] = array(
		"PARENT" => "PICTURE",
		"NAME" => GetMessage("CP_BCI1_PREVIEW_WIDTH"),
		"TYPE" => "STRING",
		"DEFAULT" => 100,
	);
	$arComponentParameters["PARAMETERS"]["PREVIEW_HEIGHT"] = array(
		"PARENT" => "PICTURE",
		"NAME" => GetMessage("CP_BCI1_PREVIEW_HEIGHT"),
		"TYPE" => "STRING",
		"DEFAULT" => 100,
	);
}

$arComponentParameters["PARAMETERS"]["DETAIL_RESIZE"] = array(
	"PARENT" => "PICTURE",
	"NAME" => GetMessage("CP_BCI1_DETAIL_RESIZE"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
	"REFRESH" => "Y",
);

if($arCurrentValues["DETAIL_RESIZE"]!="N")
{
	$arComponentParameters["PARAMETERS"]["DETAIL_WIDTH"] = array(
		"PARENT" => "PICTURE",
		"NAME" => GetMessage("CP_BCI1_DETAIL_WIDTH"),
		"TYPE" => "STRING",
		"DEFAULT" => 300,
	);
	$arComponentParameters["PARAMETERS"]["DETAIL_HEIGHT"] = array(
		"PARENT" => "PICTURE",
		"NAME" => GetMessage("CP_BCI1_DETAIL_HEIGHT"),
		"TYPE" => "STRING",
		"DEFAULT" => 300,
	);
}

?>
