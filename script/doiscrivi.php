<?
	$PATHNAME = "..";
	require("$PATHNAME/include/header.php");
	$uid=sqlcheck(urldecode($Username));
	$nome=sqlcheck(urldecode($Nome));
	$cognome=sqlcheck(urldecode($Cognome));
	$email=sqlcheck(urldecode($Email));
	$nomesq=sqlcheck(urldecode($NomeSq));
	$colorec=sqlcheck(urldecode($ColoreC));
	$coloresf=sqlcheck(urldecode($ColoreSF));
	$pass=sqlcheck(urldecode($Pwd));

	if (
	checkColor("#".$colorec)&&
	checkColor("#".$coloresf)&&
	checkString($uid)&&
	checkStringMulti($nome)&&
	checkStringMulti($cognome)&&
	checkMail($email)&&
	checkStringMulti($nomesq)&&
	checkPassword($pass)
	) 
	{
		$query= "SELECT * from utenti where squadra='$nomesq'";

		$qry=mysql_query($query, $db);
		if (mysql_num_rows($qry) == 0)
		{
			$query = "INSERT INTO utenti (userid,password,nome,cognome,email,squadra,campionato,colorecarattere,coloresfondo) VALUES(\"$uid\",\"$pass\",\"$nome\",\"$cognome\",\"$email\",\"$nomesq\",'Nessuno',\"#$colorec\",\"#$coloresf\")";
			if (mysql_query($query, $db))
			{
				$msg=urlencode("La tua iscrizione &egrave; avvenuta con successo! <BR> Grazie per esserti iscritto.");
				header("Location: $PATHNAME/pagine/messaggio.php?msg=$msg");
			}
			else
			{
				$msg=urlencode("Attenzione il tuo user id è gia stato utilizzato! <BR> Per favore scegline un altro.");
				header("Location: $PATHNAME/pagine/messaggio.php?msg=$msg");
				//echo $query;
			}
		}
		else
		{
		$msg=urlencode("Attenzione il nome della squadra è già stato utilizzato! <BR> Per favore scegline uno differente.");
		header("Location: $PATHNAME/pagine/messaggio.php?msg=$msg");
		}
	}
	else
	{
		$msg=urlencode("Mi spiace ma alcuni campi da te inseriti contengono caratteri non validi. Nelle stringhe sono supportati solo i seguenti caretteri peciali:<br>?!,@.\s");
		header("Location: $PATHNAME/pagine/messaggio.php?msg=$msg");
	}
 ?>
