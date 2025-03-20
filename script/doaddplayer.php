<?
	$PATHNAME = "..";
	require("$PATHNAME/include/header.php");
	if (authent($site_login, $site_password))
	{
		$ck=addPlayer($id,$ris,$squadra,$campionato,$giornata);
		if ($ck!=0) header("Location: $PATHNAME/pagine/gestioneteam.php?setday=$giornata&error1=$ck&ris=$ris");
		else
		header("Location: $PATHNAME/pagine/gestioneteam.php?setday=$giornata&ris=$ris");
	}
 ?>
