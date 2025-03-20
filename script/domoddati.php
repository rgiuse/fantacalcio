<?
	$PATHNAME = "..";
	require("$PATHNAME/include/header.php");
	$email=sqlcheck(urldecode($Email));
	$colorec=sqlcheck(urldecode($ColoreC));
	$coloresf=sqlcheck(urldecode($ColoreSF));
	$pass=sqlcheck(urldecode($Pwd));
	
	if (
	checkColor("#".$colorec)&&
	checkColor("#".$coloresf)&&
	checkMail($email)&&
	checkPassword($pass)
	) 
	{
	$query = "UPDATE utenti SET email =\"$email\",colorecarattere =\"#$colorec\",coloresfondo=\"#$coloresf\"";
	if ($pass!="fintafinta") $query = $query.",password =\"$pass\"";
	$query = $query." where userid=\"$site_login\"";
	if (mysql_query($query, $db))
	{
		$msg=urlencode("I tuoi dati sono stati aggiornati con sucesso!");
		header("Location: $PATHNAME/pagine/messaggio.php?msg=$msg");
	}
	}
	else
	{
	$msg=urlencode("Mi spiace ma alcuni campi da te inseriti contengono caratteri non validi. Nelle stringhe sono supportati solo i seguenti caretteri peciali:<br>?!,@.\s");
	header("Location: $PATHNAME/pagine/messaggio.php?msg=$msg");
	}
 ?>
