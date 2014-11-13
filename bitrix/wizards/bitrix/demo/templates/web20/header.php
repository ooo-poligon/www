<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<html>
<head>
<?$APPLICATION->ShowHead()?>
<title><?$APPLICATION->ShowTitle()?></title>
</head>

<body>


<?$APPLICATION->ShowPanel();?>

<div id="container">

<div id="header">
	<div id="header_text">
		<?$APPLICATION->IncludeFile(
			$APPLICATION->GetTemplatePath("include_areas/company_name.php"),
			Array(),
			Array("MODE"=>"html")
		);?>
	</div>

	<div id="company_logo"></div>

	<div id="search">
		&nbsp;����� �� �����
		<?$APPLICATION->IncludeComponent("bitrix:search.form", "flat", Array(
			"PAGE"	=>	"/search/"
			)
	);?>
	</div>

	<div id="login">
		<?$APPLICATION->IncludeComponent("bitrix:system.auth.form", "auth", Array(
			"REGISTER_URL"	=>	"/auth/",
			"PROFILE_URL"	=>	"/personal/profile/"
			)
		);?>
	</div>

	<div id="menu">
	<?$APPLICATION->IncludeComponent(
		"bitrix:menu", 
		"tabs", 
		Array(
			"ROOT_MENU_TYPE"	=>	"top",
			"MAX_LEVEL"	=>	"1",
			"USE_EXT"	=>	"N"
		)
	);?>
	</div>
</div>

<table id="content" cellpadding="0" cellspacing="0">
	<tr>
		<td rowspan="4" width="9" class="table-border-color"><div style="width:9px"></div></td>
		<td width="4"><img src="<?=SITE_TEMPLATE_PATH?>/images/left_top_corner.gif" width="4" height="4" border="0" alt="" /></td>
		<td align="right"><img src="<?=SITE_TEMPLATE_PATH?>/images/right_top_corner.gif" width="7" height="5" border="0" alt="" /></td>
		<td rowspan="4" width="7" class="table-border-color"><div style="width:7px"></div></td>
	</tr>
	<tr>
		<td class="left-column"><?$APPLICATION->IncludeComponent("bitrix:menu", "left", Array(
	"ROOT_MENU_TYPE"	=>	"left",
	"MAX_LEVEL"	=>	"1",
	"CHILD_MENU_TYPE"	=>	"left",
	"USE_EXT"	=>	"Y"
	)
);?><?$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				Array(
					"AREA_FILE_SHOW" => "sect", 
					"AREA_FILE_SUFFIX" => "inc", 
					"AREA_FILE_RECURSIVE" => "N", 
					"EDIT_MODE" => "html", 
					"EDIT_TEMPLATE" => "sect_inc.php" 
				)
			);?><?$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				Array(
					"AREA_FILE_SHOW" => "page", 
					"AREA_FILE_SUFFIX" => "inc", 
					"AREA_FILE_RECURSIVE" => "N", 
					"EDIT_MODE" => "html", 
					"EDIT_TEMPLATE" => "page_inc.php" 
					)
			);?>
			</td>
		<td class="main-column">

			<div id="printer"><a href="<?=htmlspecialchars($APPLICATION->GetCurUri("print=Y"));?>" title="������ ��� ������" rel="nofollow">������<br />��� ������</a></div>

			<div id="navigation"><?$APPLICATION->IncludeComponent(
				"bitrix:breadcrumb",
				".default",
				Array(
					"START_FROM" => "0", 
					"PATH" => "", 
					"SITE_ID" => "" 
				)
			);?></div>
			<h1><?$APPLICATION->ShowTitle(false)?></h1>