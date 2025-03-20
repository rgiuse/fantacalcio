<?
	require("database.php");
	require("sqlcheck.php");

	function authent($username, $password)
	{
		global $squadra;
		global $campionato;
		global $db;
		global $nome;
		global $cognome;
		global $ccarattere;
		global $csfondo;
		if($username=="" or $password=="") return 0;
		else
		{
			$query = "SELECT * FROM utenti WHERE userid = '$username' AND password = '$password'";
			$rst = mysql_query($query, $db);
	
			if(mysql_num_rows($rst)!=1)
				return 0;
			else
			{
				$linea = mysql_fetch_array($rst);
				$campionato = $linea[campionato];
				$squadra = $linea[squadra];
				$nome=$linea[nome];
				$cognome=$linea[cognome];
				$ccarattere=$linea[colorecarattere];
				$csfondo=$linea[coloresfondo];
				return 1;
			}
		}
	}

	function isadmin($username)
	{
		global $db;
		$query = "SELECT isadmin FROM utenti WHERE userid = '$username'";
		$rst = mysql_query($query, $db);

		if(mysql_num_rows($rst)!=1)
			return 0;
		else
		{
			$linea = mysql_fetch_array($rst);
			return $linea[isadmin];
		}
	}


	function register($username, $password, $isadmin, $name, $fname, $address, $telephone)
	{
		global $db;
		
		$username = sqlcheck($username);
		$password = sqlcheck($password);
		$name = sqlcheck($name);
		$fname = sqlcheck($fname);
		$address = sqlcheck($address);
		$telephone = sqlcheck($telephone);
		$query = "INSERT INTO user VALUES('$username', '$password', '$isadmin', '$name', '$fname', '$address', '$telephone')";

		if($username!="") mysql_query($query, $db);
		//	return mysql_affected_rows();
		return mysql_errno();

	}

?>
