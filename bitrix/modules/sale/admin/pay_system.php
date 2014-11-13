<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/sale/include.php");

$saleModulePermissions = $APPLICATION->GetGroupRight("sale");
if ($saleModulePermissions == "D")
	$APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));

IncludeModuleLangFile(__FILE__);
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/sale/prolog.php");

$sTableID = "tbl_sale_pay_system";

$oSort = new CAdminSorting($sTableID, "ID", "asc");
$lAdmin = new CAdminList($sTableID, $oSort);

$arFilterFields = array(
	"filter_lang",
	"filter_currency",
	"filter_active"
);

$lAdmin->InitFilter($arFilterFields);

$arFilter = array();

if (strlen($filter_lang)>0 && $filter_lang!="NOT_REF") $arFilter["LID"] = Trim($filter_lang);
if (strlen($filter_currency)>0) $arFilter["CURRENCY"] = Trim($filter_currency);
if (strlen($filter_active)>0) $arFilter["ACTIVE"] = Trim($filter_active);

if (($arID = $lAdmin->GroupAction()) && $saleModulePermissions >= "W")
{
	if ($_REQUEST['action_target']=='selected')
	{
		$arID = Array();
		$dbResultList = CSalePaySystem::GetList(
			array($by => $order),
			$arFilter,
			false,
			false,
			array("ID")
		);
		while ($arResult = $dbResultList->Fetch())
			$arID[] = $arResult['ID'];
	}

	foreach ($arID as $ID)
	{
		if (strlen($ID) <= 0)
			continue;

		switch ($_REQUEST['action'])
		{
			case "delete":
				@set_time_limit(0);

				$DB->StartTransaction();

				if (!CSalePaySystem::Delete($ID))
				{
					$DB->Rollback();

					if ($ex = $APPLICATION->GetException())
						$lAdmin->AddGroupError($ex->GetString(), $ID);
					else
						$lAdmin->AddGroupError(GetMessage("SPSAN_ERROR_DELETE"), $ID);
				}

				$DB->Commit();

				break;

			case "activate":
			case "deactivate":

				$arFields = array(
					"ACTIVE" => (($_REQUEST['action']=="activate") ? "Y" : "N")
				);

				if (!CSalePaySystem::Update($ID, $arFields))
				{
					if ($ex = $APPLICATION->GetException())
						$lAdmin->AddGroupError($ex->GetString(), $ID);
					else
						$lAdmin->AddGroupError(GetMessage("SPSAN_ERROR_UPDATE"), $ID);
				}

				break;
		}
	}
}

$dbResultList = CSalePaySystem::GetList(
	array($by => $order),
	$arFilter,
	false,
	false,
	array("ID", "LID", "CURRENCY", "NAME", "ACTIVE", "SORT", "DESCRIPTION")
);

$dbResultList = new CAdminResult($dbResultList, $sTableID);
$dbResultList->NavStart();

$lAdmin->NavText($dbResultList->GetNavPrint(GetMessage("SALE_PRLIST")));

$lAdmin->AddHeaders(array(
	array("id"=>"ID", "content"=>"ID", 	"sort"=>"id", "default"=>true),
	array("id"=>"NAME","content"=>GetMessage("SALE_NAME"), "sort"=>"NAME", "default"=>true),
	array("id"=>"LID", "content"=>GetMessage('SALE_LID'),	"sort"=>"LID", "default"=>true),
	array("id"=>"CURRENCY", "content"=>GetMessage("SALE_H_CURRENCY"),  "sort"=>"CURRENCY", "default"=>true),
	array("id"=>"ACTIVE", "content"=>GetMessage("SALE_ACTIVE"),  "sort"=>"ACTIVE", "default"=>true),
	array("id"=>"SORT", "content"=>GetMessage("SALE_SORT"),  "sort"=>"SORT", "default"=>true),
));

$arVisibleColumns = $lAdmin->GetVisibleHeaderColumns();

while ($arCCard = $dbResultList->NavNext(true, "f_"))
{
	$row =& $lAdmin->AddRow($f_ID, $arCCard, "sale_pay_system_edit.php?ID=".$f_ID."&lang=".LANG."&".GetFilterParams("filter_"), GetMessage("SALE_EDIT_DESCR"));

	$row->AddField("ID", $f_ID);
	$row->AddField("NAME", $f_NAME);
	$row->AddField("LID", $f_LID);
	$row->AddField("CURRENCY", $f_CURRENCY);
	$row->AddField("ACTIVE", (($f_ACTIVE=="Y") ? GetMessage("SPS_YES") : GetMessage("SPS_NO")));
	$row->AddField("SORT", $f_SORT);

	$arActions = Array();
	$arActions[] = array("ICON"=>"edit", "TEXT"=>GetMessage("SALE_EDIT"), "TITLE"=>GetMessage("SALE_EDIT_DESCR"),"ACTION"=>$lAdmin->ActionRedirect("sale_pay_system_edit.php?ID=".$f_ID."&lang=".LANG."&".GetFilterParams("filter_").""), "DEFAULT"=>true);
	if ($saleModulePermissions >= "W")
	{
		$arActions[] = array("SEPARATOR" => true);
		$arActions[] = array("ICON"=>"delete", "TEXT"=>GetMessage("SALE_DELETE"), "TITLE"=>GetMessage("SALE_DELETE_DESCR"), "ACTION"=>"if(confirm('".GetMessage('SALE_CONFIRM_DEL_MESSAGE')."')) ".$lAdmin->ActionDoGroup($f_ID, "delete"));
	}

	$row->AddActions($arActions);
}

$lAdmin->AddFooter(
	array(
		array(
			"title" => GetMessage("MAIN_ADMIN_LIST_SELECTED"),
			"value" => $dbResultList->SelectedRowsCount()
		),
		array(
			"counter" => true,
			"title" => GetMessage("MAIN_ADMIN_LIST_CHECKED"),
			"value" => "0"
		),
	)
);

$lAdmin->AddGroupActionTable(
	array(
		"delete" => GetMessage("MAIN_ADMIN_LIST_DELETE"),
		"activate" => GetMessage("MAIN_ADMIN_LIST_ACTIVATE"),
		"deactivate" => GetMessage("MAIN_ADMIN_LIST_DEACTIVATE"),
	)
);

if ($saleModulePermissions == "W")
{
	$arDDMenu = array();

	/*
	$arDDMenu[] = array(
		"TEXT" => "<b>".GetMessage("SOPAN_4NEW_PROMT")."</b>",
		"ACTION" => false
	);
	*/

	$dbRes = CLang::GetList(($by1="sort"), ($order1="asc"));
	while(($arRes = $dbRes->Fetch()))
	{
		$arDDMenu[] = array(
			"TEXT" => "[".$arRes["LID"]."] ".$arRes["NAME"],
			"ACTION" => "window.location = 'sale_pay_system_edit.php?lang=".LANG."&LID=".$arRes["LID"]."';"
		);
	}

	$aContext = array(
		array(
			"TEXT" => GetMessage("SPSAN_ADD_NEW"),
			"TITLE" => GetMessage("SPSAN_ADD_NEW_ALT"),
			"ICON" => "btn_new",
			"MENU" => $arDDMenu
		),
	);
	$lAdmin->AddAdminContextMenu($aContext);
}

$lAdmin->CheckListMode();


/****************************************************************************/
/***********  MAIN PAGE  ****************************************************/
/****************************************************************************/
$APPLICATION->SetTitle(GetMessage("SALE_SECTION_TITLE"));

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
?>

<form name="find_form" method="GET" action="<?echo $APPLICATION->GetCurPage()?>?">
<?
$oFilter = new CAdminFilter(
	$sTableID."_filter",
	array(
		GetMessage("SALE_F_CURRENCY"),
		GetMessage("SALE_F_ACTIVE"),
	)
);

$oFilter->Begin();
?>
	<tr>
		<td><?echo GetMessage("SALE_F_LANG");?>:</td>
		<td>
			<?echo CLang::SelectBox("filter_lang", $filter_lang, "(".GetMessage("SALE_ALL").")") ?>
		</td>
	</tr>
	<tr>
		<td><?echo GetMessage("SALE_F_CURRENCY")?>:</td>
		<td>
			<?echo CCurrency::SelectBox("filter_currency", $filter_currency, "(".GetMessage("SALE_ALL").")", True, "", "")?>
		</td>
	</tr>
	<tr>
		<td><?echo GetMessage("SALE_F_ACTIVE")?>:</td>
		<td>
			<select name="filter_active">
				<option value="">(<?echo GetMessage("SALE_ALL")?>)</option>
				<option value="Y"<?if ($filter_active=="Y") echo " selected"?>><?echo GetMessage("SALE_YES")?></option>
				<option value="N"<?if ($filter_active=="N") echo " selected"?>><?echo GetMessage("SALE_NO")?></option>
			</select>
		</td>
	</tr>
<?
$oFilter->Buttons(
	array(
		"table_id" => $sTableID,
		"url" => $APPLICATION->GetCurPage(),
		"form" => "find_form"
	)
);
$oFilter->End();
?>
</form>

<?
$lAdmin->DisplayList();

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");
?>