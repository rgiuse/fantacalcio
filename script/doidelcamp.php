<?
	$PATHNAME = "..";
	require("$PATHNAME/include/header.php");
	if (authent($site_login, $site_password))
	{ 
	$camp=sqlcheck(urldecode($nomec));
	
	if (
	checkStringMulti($camp)
	) 
	{
	$query = "delete from campionati where nome_camp=\"$camp\"";
	if (mysql_query($query, $db))
	{
		$msg=urlencode("Il campionato e stato eliminato con successo <b>$camp</b>");
		header("Location: $PATHNAME/pagine/messaggio.php?msg=$msg");
	}
	}
	else
	{
	$msg=urlencode("Mi spiace ma alcuni campi da te inseriti contengono caratteri non validi. Nelle stringhe sono supportati solo i seguenti caretteri peciali:<br>?! ,@.\s");
	header("Location: $PATHNAME/pagine/messaggio.php?msg=$msg");
	}
}
else
{
	$msg=urlencode("&Egrave; necessario essere autenticati<BR>per poter accedere a questa sezione!");
	header("Location: $PATHNAME/pagine/messaggio.php?msg=$msg");
}
 ?>
