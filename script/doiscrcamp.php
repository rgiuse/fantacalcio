<?
	$PATHNAME = "..";
	require("$PATHNAME/include/header.php");
	if (authent($site_login, $site_password)&&($campionato="Nessuno"))
	{ 
	$camp=sqlcheck(urldecode($selCamp));
	
	if (
	checkStringMulti($camp)
	) 
	{
	$query = "UPDATE utenti SET campionato =\"$camp\"";
	$query = $query." where userid=\"$site_login\"";
	if (mysql_query($query, $db))
	{
		$msg=urlencode("Sei stato iscritto con sucesso al campionato <b>$camp</b>");
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
