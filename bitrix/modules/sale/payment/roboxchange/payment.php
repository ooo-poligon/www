<?
include(GetLangFileName(dirname(__FILE__)."/", "/payment.php"));
$mrh_login = CSalePaySystemAction::GetParamValue("ShopLogin");
$mrh_pass1 =  CSalePaySystemAction::GetParamValue("ShopPassword");
$inv_id = IntVal($GLOBALS["SALE_INPUT_PARAMS"]["ORDER"]["ID"]); 
$inv_desc =  CSalePaySystemAction::GetParamValue("OrderDescr");
$out_summ = number_format(CSalePaySystemAction::GetParamValue("SHOULD_PAY"), 2, ".", ""); 
$crc = md5($mrh_login.":".$out_summ.":".$inv_id.":".$mrh_pass1);
$ORDER_ID = IntVal($GLOBALS["SALE_INPUT_PARAMS"]["ORDER"]["ID"]); 

?>
<form action="https://www.roboxchange.com/ssl/calc.asp" method="post" target="_blank">
<font class="tablebodytext">
<?=GetMessage("PYM_TITLE")?><br>
<?=GetMessage("PYM_ORDER")?> <?echo $ORDER_ID." (".CSalePaySystemAction::GetParamValue("DATE_INSERT")?>)<br>
<?=GetMessage("PYM_TO_PAY")?> <b><?echo SaleFormatCurrency(CSalePaySystemAction::GetParamValue("SHOULD_PAY"), CSalePaySystemAction::GetParamValue("CURRENCY"))?></b>
<p>
<input type="hidden" name="FinalStep" value="1">
<input type=hidden name=mrh	value="<?=$mrh_login?>">
<input type=hidden name=out_summ value="<?=$out_summ?>">
<input type=hidden name=inv_id value="<?=$inv_id?>">
<input type=hidden name=inv_desc value="<?=$inv_desc?>">
<input type=hidden name=crc value="<?=$crc?>">
<input type=submit name="Submit" value="<?=GetMessage("PYM_BUTTON")?>">
</p>
</font>
</form>
<p align=\"justify\"><font class=\"tablebodytext\"><?=GetMessage("PYM_WARN")?></p>