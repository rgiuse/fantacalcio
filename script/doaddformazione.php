<? 
	$PATHNAME = "..";
	require("$PATHNAME/include/header.php");
	if (authent($site_login, $site_password))
	{
	parse_str($argc);
				for ($i=0;$i<count($ck);$i++)
				{
					$s=$ck[$i];

					$check=addPlayer($s,0,$squadra,$campionato,$giornata);
					if ($check!=0) break;
					
				}
				if ($check!=0)
					header("Location: $PATHNAME/pagine/gestioneteam.php?setday=$giornata&error1=$check&ris=0");
				else
					header("Location: $PATHNAME/pagine/gestioneteam.php?setday=$giornata");
	}
?>