<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<ul id="footer_list">
<?foreach($arResult as $arItem):?>

	<?if ($arItem["PERMISSION"] > "D"):?>
		<li><a href="<?=$arItem["LINK"]?>" style="white-space: nowrap;"><?=$arItem["TEXT"]?></a></li>
	<?endif?>

<?endforeach?>

	</ul>
<?endif?>