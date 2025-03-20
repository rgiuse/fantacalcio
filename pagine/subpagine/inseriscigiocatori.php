<?
	$PATHNAME = "..";
	require_once("$PATHNAME/include/header.php");
	if (isadmin($site_login) && authent($site_login, $site_password))
	{
		?>
			<H2>Inserimento Dati Giocatori</H2>

		<?
		echo "<form action='../script/doinserigiocatori.php' method='post'>\nFile Dati : <select name='file'>";
		if ($handle = opendir('../update/')) {
		while (false !== ($file = readdir($handle))) { 
			if ($file != "." && $file != "..") { 
				echo "<option value='$file'>$file</option>\n"; 
			} 
		}
		echo "</select><INPUT TYPE='submit' value=\"Inserisci Dati\">\n</form>";
		closedir($handle); 
		}

	}
	else
	{
		$msg=urlencode("&Egrave; necessario essere autenticati<BR>per poter accedere a questa sezione!");
		header("Location: $PATHNAME/pagine/messaggio.php?msg=$msg");
	}
?>