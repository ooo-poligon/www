<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<ul id="tabs">
<?$i=0;?>
<?foreach($arResult as $arItem):?>
	<?if ($arItem["SELECTED"] ):?>
		<?$i=1;?>
	<?endif?>
<?endforeach?>
<?foreach($arResult as $arItem):?>
	<?if ($arItem["PERMISSION"] > "D"):?>
		<?if ($arItem["SELECTED"]):?>
			<li class="selected"><a href="<?=$arItem["LINK"]?>" style="white-space: nowrap;"><?=$arItem["TEXT"]?></a></li>
		<?elseif ($i==0 AND $arItem["ITEM_INDEX"]==0):?>
			<li class="selected"><a href="<?=$arItem["LINK"]?>" style="white-space: nowrap;"><?=$arItem["TEXT"]?></a></li>
		<?else:?>
			<li><a href="<?=$arItem["LINK"]?>" style="white-space: nowrap;"><?=$arItem["TEXT"]?></a></li>	
		<?endif?>
	<?endif?>

<?endforeach?>

	</ul>
<?endif?>