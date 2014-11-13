<?
// ���� ��������� ���������, ���������� ������� GET � ������ � ������ PAYMENT
if($mode == "PAYMENT")
{
	if(IntVal($issuer_id)>0)
	{
		$bCorrectPayment = True;

		if (!($arOrder = CSaleOrder::GetByID(IntVal($issuer_id))))
			$bCorrectPayment = False;

		if ($bCorrectPayment)
			CSalePaySystemAction::InitParamArrays($arOrder, $arOrder["ID"]);

		$PASS = CSalePaySystemAction::GetParamValue("PASS");

		$strCheck = md5($PASS."PAYMENT".$invoice.$issuer_id.$payment_id.$payer.$currency.$value.$date.$confirmed);
		if ($bCorrectPayment && $CHECKSUM != $strCheck)
			$bCorrectPayment = False;

		
		if($bCorrectPayment)
		{
			$strPS_STATUS_DESCRIPTION = "";
			$strPS_STATUS_DESCRIPTION .= "����� ����� - ".$invoice."; ";
			$strPS_STATUS_DESCRIPTION .= "����� ������� - ".$payment_id."; ";
			$strPS_STATUS_DESCRIPTION .= "���� ������� - ".$date."";
			$strPS_STATUS_DESCRIPTION .= "��� ������������� ������� - ".$confirmed."";
			

			$strPS_STATUS_MESSAGE = "";
			if (isset($payer) && strlen($payer)>0)
				$strPS_STATUS_MESSAGE .= "e-mail ���������� - ".$payer."; ";

			$arFields = array(
					"PS_STATUS" => "Y",
					"PS_STATUS_CODE" => "-",
					"PS_STATUS_DESCRIPTION" => $strPS_STATUS_DESCRIPTION,
					"PS_STATUS_MESSAGE" => $strPS_STATUS_MESSAGE,
					"PS_SUM" => $value,
					"PS_CURRENCY" => $currency,
					"PS_RESPONSE_DATE" => Date(CDatabase::DateFormatToPHP(CLang::GetDateFormat("FULL", LANG))),
					"USER_ID" => $arOrder["USER_ID"]
				);

			// You can comment this code if you want PAYED flag not to be set automatically
			if ($arOrder["PRICE"] == $value 
				&& IntVal($confirmed) == 1)
			{
				$arFields["PAYED"] = "Y";
				$arFields["DATE_PAYED"] = Date(CDatabase::DateFormatToPHP(CLang::GetDateFormat("FULL", LANG)));
				$arFields["EMP_PAYED_ID"] = false;
			}

			if(CSaleOrder::Update($arOrder["ID"], $arFields))
				echo "OK";
		
		}
	}
	else 
		echo "��� ������ �� �����";
}
else
	echo "��� �������� �� PAYMENT";
?>
