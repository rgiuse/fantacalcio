<?
	$PATHNAME="..";
	require("$PATHNAME/include/pass.php");
	require("$PATHNAME/include/check.php");
	session_start();
	session_unset();
	session_destroy();
	
	if(!isset($logout))
	{	
		session_start();
		session_register("site_login");
		session_register("site_password");
		session_register("squadra");
		session_register("campionato");
		session_register("giornata");
		session_register("nome");
		session_register("cognome");
		session_register("ccaratte");
		session_register("csfondo");
		
	
		if (!(checkString($username) && checkPassword($password)))
		{
			$msg=urlencode("Attenzione i dati passati non sono validi:<br> O contengono caratteri non validi o la password è troppo corta infatti deve essere almeno 5 caratteri in caso fosse già stata validata chiedere cortesemente all'admin di cambiarla con una corretta!");
			header("Location: $PATHNAME/pagine/messaggio.php?msg=$msg");
			return 0;
		}
		$site_login = $username;
		$site_password = $password;
		if(authent($username, $password))
		{
				if (!isadmin($username))

					header("Location: $PATHNAME/pagine/gestioneteam.php");
				else 
					header("Location: $PATHNAME/pagine/admmanageteam.php");

		}
		else

			header("Location: $PHP_SELF?logout=0");
	}
	else // ALLORA STO FACENDO LOGOUT
	{	
		header("Location: $PATHNAME/phpBB2/login.php?logout=true&redirect=../index.php");
	}
?>
