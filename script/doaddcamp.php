<?
	$PATHNAME = "..";
	require("$PATHNAME/include/header.php");
	if (isadmin($site_login) && authent($site_login, $site_password))
	{ 
		$Camp=sqlcheck(urldecode($camp));
	
		if (
		checkStringMulti($Camp)
		) 
		{
	
		$query = "INSERT INTO campionati (nome_camp,iniziato) VALUES(\"$Camp\",\"0\")";
		if (mysql_query($query, $db))
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
		$msg=urlencode("Mi spiace ma alcuni campi da te inseriti contengono caratteri non validi. Nelle stringhe sono supportati solo i seguenti caretteri peciali:<br>?!,@.\s");
		header("Location: $PATHNAME/pagine/messaggio.php?msg=$msg");
		}
	}
	else
	{
		$msg=urlencode("&Egrave; necessario essere autenticati<BR>per poter accedere a questa sezione!");
		header("Location: $PATHNAME/pagine/messaggio.php?msg=$msg");
	}
 ?>
