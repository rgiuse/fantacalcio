<?
	$PATHNAME = "..";
	require("$PATHNAME/include/header.php");

	if (authent($site_login, $site_password))
	{   
		$query1 = "SELECT inizio FROM giornate where data='$giornata'";
		$rst=mysql_query($query1, $db);
		$line=mysql_fetch_array($rst);
		if  (date("YmdHis", strtotime($giornata." ".$line[inizio]))-date("YmdHis")>=20000)
		{
			$query="delete from formazioni where data_gior='$giornata' and squadra='$squadra'";
			mysql_query($query,$db);
			header("Location: $PATHNAME/pagine/gestioneteam.php?setday=$giornata");
		}
		else header("Location: $PATHNAME/pagine/gestioneteam.php?setday=$giornata&error1=1");
	}

 ?>