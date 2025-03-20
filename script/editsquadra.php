<?

	$PATHNAME = "..";
	require("$PATHNAME/include/header.php");
	if (authent($site_login, $site_password))
	{
		$passa0 = explode("-", $_POST[passa0]);//array di 3 
		$passa1 = explode("-", $_POST[passa1]);//array di 8
		$passa2 = explode("-", $_POST[passa2]);//array di 8
		$passa3 = explode("-", $_POST[passa3]);//array di 6

		$query1 = "SELECT inizio FROM giornate where data='$giornata'";
		$rst=mysql_query($query1, $db);
		$line=mysql_fetch_array($rst);

		$query="delete from giocatori where squadra='$squadra' and nome_camp='$campionato'";
		mysql_query($query,$db);
		for($i=0; $i<3;$i++)
		{
			$query = "INSERT INTO giocatori VALUES('$passa0[$i]','0','$squadra','$campionato')";
			mysql_query($query, $db);
		}
		for($i=0; $i<8;$i++)
		{
			$query = "INSERT INTO giocatori VALUES('$passa1[$i]','0','$squadra','$campionato')";
			mysql_query($query, $db);
		}

		for($i=0; $i<8;$i++)
		{
			$query = "INSERT INTO giocatori VALUES('$passa2[$i]','0','$squadra','$campionato')";
			mysql_query($query, $db);
		}

		for($i=0; $i<6;$i++)
		{
			$query = "INSERT INTO giocatori VALUES('$passa3[$i]','0','$squadra','$campionato')";
			mysql_query($query, $db);
		}
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