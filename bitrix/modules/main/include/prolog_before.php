<?
}
$db_events = GetModuleEvents("main", "OnProlog");
while($arEvent = $db_events->Fetch())
	ExecuteModuleEvent($arEvent);
?>