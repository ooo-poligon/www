<?
$strPAYEE_PURSE = CSalePaySystemAction::GetParamValue("ACC_NUMBER");

$SERVER_NAME_tmp = "";
if (defined("SITE_SERVER_NAME"))
	$SERVER_NAME_tmp = SITE_SERVER_NAME;
if (strlen($SERVER_NAME_tmp)<=0)
	$SERVER_NAME_tmp = COption::GetOptionString("main", "server_name", "");

$strPayPath  = "";
$strPayPath .= "url=http://".$SERVER_NAME_tmp.(CSalePaySystemAction::GetParamValue("PATH_TO_RESULT"))."?ORDER_ID=".IntVal(CSalePaySystemAction::GetParamValue("ORDER_ID"))."";
$strPayPath .= "&purse=".$strPAYEE_PURSE;
$strPayPath .= "&amount=".round(CSalePaySystemAction::GetParamValue("SHOULD_PAY"), 2);
$strPayPath .= "&method=POST";
$strPayPath .= "&desc=Order_".IntVal(CSalePaySystemAction::GetParamValue("ORDER_ID"));
$strPayPath .= "&mode=".CSalePaySystemAction::GetParamValue("TEST_MODE");
?>

<table>
<tr>
	<td align="left">���� �� ����������� <b>WMKeeper Classic</b>, ��������� ��� ������ ������ �� ��������� ������:</td>
	<td align="center"><a href="wmk:paylink?<?= $strPayPath ?>"><b>�������� �����</b></a><br><br></td>
	<td align="left">���� �� ����������� <b>WMKeeper Light</b>, ��������� ��� ������ ������ �� ��������� ������:</td>
	<td align="center"><a href="https://light.webmoney.ru/pci.aspx?<?= $strPayPath ?>"><b>�������� �����</b></a><br><br></td>
</tr>
</table>
