<?
include(GetLangFileName(dirname(__FILE__)."/", "/payment.php"));

$psTitle = GetMessage("SPCP_DTITLE");
$psDescription = GetMessage("SPCP_DDESCR");

$arPSCorrespondence = array(
		"SHOP_ID" => array(
				"NAME" => GetMessage("SHOP_ID"),
				"DESCR" => GetMessage("SHOP_ID_DESCR"),
				"VALUE" => "",
				"TYPE" => ""
			),
		"SHOP_KEY" => array(
				"NAME" => GetMessage("SHOP_KEY"),
				"DESCR" => GetMessage("SHOP_KEY_DESCR"),
				"VALUE" => "",
				"TYPE" => ""
			),
		"ORDER_ID" => array(
				"NAME" => GetMessage("ORDER_ID"),
				"DESCR" => GetMessage("ORDER_ID_DESCR"),
				"VALUE" => "",
				"TYPE" => ""
			),
		"USER_ID" => array(
				"NAME" => GetMessage("USER_ID"),
				"DESCR" => GetMessage("USER_ID_DESCR"),
				"VALUE" => "",
				"TYPE" => ""
			),
		"ORDER_DATE" => array(
				"NAME" => GetMessage("ORDER_DATE"),
				"DESCR" => GetMessage("ORDER_DATE_DESCR"),
				"VALUE" => "",
				"TYPE" => ""
			),
		"SHOULD_PAY" => array(
				"NAME" => GetMessage("SHOULD_PAY"),
				"DESCR" => GetMessage("SHOULD_PAY_DESCR"),
				"VALUE" => "",
				"TYPE" => ""
			),
		"IS_TEST" => array(
				"NAME" => GetMessage("IS_TEST"),
				"DESCR" => GetMessage("IS_TEST_DESCR"),
				"VALUE" => "Y",
				"TYPE" => ""
			),

	);                                     
?>