<?
	$PATHNAME = "..";
	require("$PATHNAME/include/pass.php");
	session_register("site_login");
	session_register("site_password");

	if (isadmin($site_login) && authent($site_login, $site_password))
	{
		if ($squadra=$admsquadra and $campionato!=$admcampionato)
		{
			$query1= "select squadra from utenti where isadmin=0 and campionato='$admcampionato' order by userid ";
			$rst1=mysql_query($query1,$db);
			$line1=mysql_fetch_array($rst1);
			$query = "UPDATE `utenti` SET `squadra`='$line1[0]',`campionato`='$admcampionato' WHERE `userid`='$site_login' AND `password`='$site_password' AND `isadmin`=1";

		}
		else
		$query = "UPDATE `utenti` SET `squadra`='$admsquadra',`campionato`='$admcampionato' WHERE `userid`='$site_login' AND `password`='$site_password' AND `isadmin`=1";
	mysql_query($query, $db);
	if ($HTTP_REFERER)
		header("Location: $HTTP_REFERER");
	else
		{
		$msg=urlencode("&Egrave; possibile che abbiate un Firewall abilitato<BR>o che abbiate disabilitato i REFERRER in tal caso per una ottimale navigazione del sito si consiglia di riabilitarli!");
		header("Location: $PATHNAME/pagine/messaggio.php?msg=$msg");
		}
	}
	else
	{
		$msg=urlencode("&Egrave; necessario essere autenticati<BR>per poter accedere a questa sezione!");
		header("Location: $PATHNAME/pagine/messaggio.php?msg=$msg");
	}
?>