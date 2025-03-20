<?
	$PATHNAME = "..";
	require_once("$PATHNAME/include/header.php");
	if (isadmin($site_login) && authent($site_login, $site_password))
	{ 
	$uploaddir = '/home/httpd/html/fantacalcio/update/';
	$uploadfile = $uploaddir. $_FILES['userfile']['name'];
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) 
		{
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
			$msg=urlencode("&Egrave; necessario inserire nomi di file validi ed esistenti<BR>Grazie!");
			header("Location: $PATHNAME/pagine/messaggio.php?msg=$msg");
		}
	}
	else
	{
		$msg=urlencode("&Egrave; necessario essere autenticati<BR>per poter accedere a questa sezione!");
		header("Location: $PATHNAME/pagine/messaggio.php?msg=$msg");
	}
?>