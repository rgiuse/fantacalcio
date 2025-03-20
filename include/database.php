<?
	/*
	 * parametri del database
	 */

	$db_host = "server"; 

	$db_user = "xxxxxx";        
	$db_password = "xxxxxxxxxxxx";
	$db_name = "FantaCalcioNew";

	$db = mysql_connect($db_host, $db_user, $db_password)
	or die ("Errore nella connessione al database. Verificare i parametri. Errore: ".mysql_error());
 
	mysql_select_db($db_name, $db)
	or die ("<h1>Errore nella selezione del database.</h1><h2> Verificare i parametri.</h2><br><br> <h3>Errore: ".mysql_error())."</h3>";
?>
