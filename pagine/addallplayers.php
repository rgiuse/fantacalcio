<?
	$PATHNAME = ".";
	require("$PATHNAME/include/pass.php");
	require("header.php");
	
	

	if (isadmin($site_login) && authent($site_login, $site_password))
	{
	 $query = "select squadra from utenti group by squadra";
	 $rst = mysql_query($query, $db);
 ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Documento senza titolo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<form name="form1" method="post" action="doaddallplayer.php">
  <p> nome giocatore 
    <input type="text" name="nomeg">
  </p>
  <p>cognome giocatore. 
    <input type="text" name="cognomeg">
  </p>
  <p>squadra 
    <select name="squadrag">
	<? 	while($line=mysql_fetch_array($rst))
			echo "<option value='$line[squadra]'>$line[squadra]</option>";
	?>   
    </select>

  </p>
  <p>ruolo 
  <select name="ruolog">
	<option value='0'>portiere</option>
	<option value='1'>difensore</option>
	<option value='2'>centrocampista</option>
	<option value='3'>attaccante</option>
	</select>
   <!-- input type="text" name="ruolog"
    -->
  </p>
  ruolo = 0 portiere, 1 difensore, 2 centrocampista, 3 attaccante
  <p>
    <input type="submit" name="Submit" value="Invia">
  </p>
</form>
<A HREF="admin.php">back</A>
</body>
</html>

<?
	}

?>
