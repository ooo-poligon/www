<? // include ��� �� Bitrix
/**
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "����� �������� �����");
?>
<style type="text/css">
.goFormsInputAndTextarea {
.goTitles {
.goAttensionError {
.goButtonSend {border:solid 1px;}
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
	$goInput = 'input'; // ������ HTML ���� input
//***************************************** ����� ������ � ������ ��������� ������� (������) *****************************************//		
	$goSend[To]='web-site-mailbox@poligon.info'; // ���������� ������ � ��������� ����

	$goTitle [1]='�.�.�.:';		$goTypeHTML [1]=$goInput; $goName[1]='name'; 	$goReqParam[1]=true; 
//***************************************** ����� ������ � ������ ��������� ������� (�����) *****************************************//
//***************************************** ���, ��� ���� ������ �� ������������� *****************************************//
	$goKolichestvoElementov = count($goTitle); // �� �������, � ������������. ��� ������� ������ ���� �����.
	for ($i = 1; $i <= $goKolichestvoElementov; $i++) 
				case ($goInput):
						if (($_POST [($goCheck[email])]) == '') // ��������� E-MAIL �� ������������ ����������
						$tempContentFormErro[$goIdOfEmail] = true;
						}else{
							if (validEmail($_POST [($goCheck[email])]) == true)
								$tempCheckedEmail='';
							}else{
						if (($_POST [($goCheck[phone])]) == '') // ��������� ������� �� ������������ ����������
						$tempContentFormErro[$goIdOfPhone] = true;
						}else{
							if (isPhoneNumber($_POST [($goCheck[phone])]) == true)
				break;
				case (false): //���� ���� �� �������� ������������, �� ��������� ��������.
if (isset ($_POST [($tempMyNameIs)] ) )
	$goMailBody = $goMailBody."\n\n����: [".getFullDate(time()).", ".getQuestionTime(time())."]\n--------------------\n\n";
	@mail($goSend[To], $goSend[Subject], $goMailBody, $tempSendMeFrom);
	#writeDataInFile ($tempSendMe);
	//��������, ��� ��� ����������
//�������� ��������� � ������				
echo $tempAttensionStart;
//�������� ������ ����� � ������
if ($boolenMessageWasSend == false)
		echo '    <br/><br/>
if ($boolenMessageWasSend == true)
			echo '<font class="goTitles">'.$goTitle[$i].' &#8212; '.$tempContentForm.'</font><br>';
</form>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>