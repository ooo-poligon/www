<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$saleModulePermissions = $APPLICATION->GetGroupRight("sale");
if ($saleModulePermissions == "D")
	$APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
</head>
<body>
<?
IncludeModuleLangFile(__FILE__);

$divInd = IntVal($divInd);

$file = str_replace("\\", "/", $file);
while (strpos($file, "//") !== false)
	$file = str_replace("//", "/", $file);
while (substr($file, strlen($file) - 1, 1) == "/")
	$file = substr($file, 0, strlen($file) - 1);


function LocalGetPSActionParams($fileName)
{
	$arPSCorrespondence = array();

	if (file_exists($fileName) && is_file($fileName))
		include($fileName);

	return $arPSCorrespondence;
}


$res = "";
$fields = "";

$path2SystemPSFiles = "/bitrix/modules/sale/payment/";
$path2UserPSFiles = COption::GetOptionString("sale", "path2user_ps_files", BX_PERSONAL_ROOT."/php_interface/include/sale_payment/");
if (substr($path2UserPSFiles, strlen($path2UserPSFiles) - 1, 1) != "/")
	$path2UserPSFiles .= "/";

$bUserPSFile = (substr($file, 0, strlen($path2UserPSFiles)) == $path2UserPSFiles);
$bSystemPSFile = (substr($file, 0, strlen($path2SystemPSFiles)) == $path2SystemPSFiles);

if ($bUserPSFile || $bSystemPSFile)
{
	if ($bUserPSFile)
		$fileName = substr($file, strlen($path2UserPSFiles));
	else
		$fileName = substr($file, strlen($path2SystemPSFiles));

	$fileName = preg_replace("#[^A-Za-z0-9_.-]#i", "", $fileName);

	$arPSCorrespondence = LocalGetPSActionParams($_SERVER["DOCUMENT_ROOT"].(($bUserPSFile) ? $path2UserPSFiles : $path2SystemPSFiles).$fileName."/.description.php");

	if (is_array($arPSCorrespondence) && count($arPSCorrespondence) > 0)
	{
		$res  = '<table border="0" cellspacing="0" cellpadding="0" class="internal" width="100%">';
		$res .= '<tr class="heading"><td align="center" colspan="2">'.GetMessage("SPSG_ACT_PROP").'</td></tr>';

		foreach ($arPSCorrespondence as $key => $value)
		{
			if (strlen($fields) > 0)
				$fields .= ",";
			$fields .= $key;

			$res .= '<tr><td width="40%">';
			$res .= $value["NAME"];
			if (strlen($value["DESCR"]) > 0)
				$res .= "<br><small>".$value["DESCR"]."</small>";
			$res .= '</td>';
			$res .= '<td width="60%">';

			$res .= '<table border="0" cellspacing="2" cellpadding="0"><tr>';
			$res .= '<td>'.GetMessage("SPSG_TYPE").'</td>';

			$res .= '<td><select name="TYPE_'.$key.'_'.$divInd.'" OnChange="PropertyTypeChange(\''.$key.'\', '.$divInd.')">';
			$res .= '<option value="">'.GetMessage("SPSG_OTHER").'</option>';
			$res .= '<option value="USER">'.GetMessage("SPSG_FROM_USER").'</option>';
			$res .= '<option value="ORDER">'.GetMessage("SPSG_FROM_ORDER").'</option>';
			$res .= '<option value="PROPERTY">'.GetMessage("SPSG_FROM_PROPS").'</option>';
			$res .= '</select></td></tr>';

			$res .= '<tr><td>'.GetMessage("SPSG_VALUE").'</td>';
			$res .= '<td><select name="VALUE1_'.$key.'_'.$divInd.'" style="display: none;">';
			$res .= '</select>';

			$res .= '<input type="text" name="VALUE2_'.$key.'_'.$divInd.'" size="40">';

			$res .= '</td></tr></table>';
			
			$res .= '</td></tr>';
		}

		$res .= '</table>';

		$res = str_replace("'", "\'", $res);
	}
}
?>
<script language="JavaScript">
<!--
window.parent.document.forms["pay_sys_form"].elements["PS_ACTION_FIELDS_LIST_<?= $divInd ?>"].value = "<?= $fields ?>";

window.parent.document.getElementById("pay_sys_act_<?= $divInd ?>").style["backgroundColor"] = "#E4EDF3";
window.parent.document.getElementById("pay_sys_act_<?= $divInd ?>").innerHTML = '<?= $res ?>';

<?
if (is_array($arPSCorrespondence) && count($arPSCorrespondence) > 0)
{
	foreach ($arPSCorrespondence as $key => $value)
	{
		?>
		window.parent.InitActionProps('<?= $key ?>', <?= $divInd ?>);
		<?
	}
}

if (strlen($res) <= 0)
{
	?>
	window.parent.document.getElementById("pay_sys_switch_<?= $divInd ?>").innerHTML = "";
	window.parent.document.getElementById("pay_sys_act_<?= $divInd ?>").style["backgroundColor"] = "#F1F1F1";
	<?
}
else
{
	?>
	window.parent.SetActLinkText(<?= $divInd ?>, window.parent.paySysActVisible_<?= $divInd ?>);
	<?
}
?>
//-->
</script>
</body>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>