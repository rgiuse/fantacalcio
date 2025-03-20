<?
	$PATHNAME = "..";
	require("$PATHNAME/include/header.php");

	if (authent($site_login, $site_password))
	{
		postMessage($messaggio, $dest, $site_login);
		$msg=urlencode("Messaggio inviato con successo");
		header("Location: $PATHNAME/pagine/messaggio.php?msg=$msg");
	}
	else
	{

		$msg=urlencode("&Egrave; necessario essere autenticati<BR>per poter accedere a questa sezione!");
		header("Location: $PATHNAME/pagine/messaggio.php?msg=$msg");
	}
?>
