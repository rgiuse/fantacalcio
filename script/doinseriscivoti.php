<?
	$PATHNAME = "..";
	require("$PATHNAME/include/header.php");
	if (authent($site_login, $site_password))
	{
		inserisciVoti($file,$num);
		$msg=urlencode("I voti sono stati aggiornati con sucesso!");
		header("Location: $PATHNAME/pagine/messaggio.php?msg=$msg");
	}
	else
	{

		$msg=urlencode("&Egrave; necessario essere autenticati<BR>per poter accedere a questa sezione!");
		header("Location: $PATHNAME/pagine/messaggio.php?msg=$msg");
	}
?>