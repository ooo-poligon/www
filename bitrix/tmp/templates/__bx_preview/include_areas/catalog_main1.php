<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!--				<ul>
					<li><b>������������ �������������</b></li>
					<li><a href="#">WatchDog pro</a></li>
					<li><a href="#">���������� ����������</a></li>
					<li><a href="#">���������� ����������</a></li>
					<li><a href="#">���������� �����������</a></li>
				</ul>	
				<ul>
					<li><b>���� �������������</b></li>
					<li><a href="#">������ ����������</a></li>
					<li><a href="#">� ������������ ����������</a></li>
					<li><a href="#">������ � ������������ ����������</a></li>
					<li><a href="#">���� � ����������� ����������</a></li>
					<li><a href="#">���� �������� ��������</a></li>
					<li><a href="#">���� � ��������������� ��������</a></li>
					<li><a href="#">���� � �������������� ��������</a></li>
				</ul>
-->
<?
$SECTIONS = Array(142,77);
$QUANTITY = Array(4,4);

if(CModule::IncludeModule("iblock"))
{
	foreach ($SECTIONS as $p=>$sec)
	{
		echo '<ul>';
		$res = CIBlockSection::GetByID($sec);
		if($ar_res = $res->GetNext())
			echo '<li><b>'.$ar_res["NAME"].'</b></a></li>';
			$db_list = CIBlockSection::GetList(Array("sort"=>"asc"), Array("SECTION_ID"=>$ar_res["ID"]), false);
			$db_list->NavStart($QUANTITY[$p]);
			$i=0;
	  	    while($ar_result = $db_list->GetNext())
			{
				$i++;
				echo '<li><a href="/catalog/index.php?SECTION_ID='.$ar_result["ID"].'">'.$ar_result['NAME'].'</a>';
				if ($i==$QUANTITY[$p]) echo ' <a href="/catalog/index.php?SECTION_ID='.$ar_res["ID"].'">...</a>';
				echo '</li>';
			}
		echo '</ul><br>';
	}
}
?>
