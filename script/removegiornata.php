<?
	$PATHNAME = "..";
	require_once("../include/header.php");

	if (isadmin($site_login) && authent($site_login, $site_password))
	{
		$query="delete from giornate where Data='$data' and Inizio='$ora'";
		mysql_query($query,$db);
	}
	if ($HTTP_REFERER)
			header("Location: $HTTP_REFERER");
	else
	{
		$msg=urlencode("&Egrave; possibile che abbiate un Firewall abilitato<BR>o che abbiate disabilitato i REFERRER in tal caso per una ottimale navigazione del sito si consiglia di riabilitarli!");
		header("Location: $PATHNAME/pagine/messaggio.php?msg=$msg");
	}

 ?>