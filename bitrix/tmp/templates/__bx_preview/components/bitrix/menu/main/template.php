<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<ul id="first">
<?foreach($arResult as $arItem):?>
	<?$i++;?>
	<?if($i % 3 == 1 OR $i==1):?>
		<li>
	<?endif?>
	<?if ($arItem["PERMISSION"] > "D"):?>		
		<a href="<?=$arItem["LINK"]?>"><nobr><?=$arItem["TEXT"]?></nobr><br /></a>
		<?if($i % 3 == 0):?>
			</li>
		<?endif?>
	<?endif?>
<?endforeach?>

	</ul>
<?endif?>