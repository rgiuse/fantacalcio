<?
	$PATHNAME = "..";
	require_once("$PATHNAME/include/header.php");
	if (isadmin($site_login) && authent($site_login, $site_password))
	{ 
		$query = "INSERT INTO giornate VALUES(NULL,'$year/$month/$day', '$orapart1:$orapart2')";
		mysql_query($query, $db);
	}
	if ($HTTP_REFERER)
		header("Location: $HTTP_REFERER");
	else
	{
		$msg=urlencode("&Egrave; possibile che abbiate un Firewall abilitato<BR>o che abbiate disabilitato i REFERRER in tal caso per una ottimale navigazione del sito si consiglia di riabilitarli!");
		header("Location: $PATHNAME/pagine/messaggio.php?msg=$msg");
	}
	?>
