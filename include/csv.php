<?
	function inserisciVoti($filename,$ID_gior)
	{
		global $db;
		$row = 1;
		$fd = fopen ("../update/$filename","r");
		while ($data = fgetcsv ($fd, filesize("../update/$filename"), "|")) 
			{
				$row++;
				$query = "INSERT INTO voti(ID,ID_giornata,N_giornata,voto,voto_base) VALUES('$data[0]', '$ID_gior' ,'$data[1]','$data[7]','$data[10]')";
				mysql_query($query, $db);

			}
		fclose ($fd);
	}

	function inserisciGiocatori($filename,$id_anno)
	{
		global $db;
		$row = 1;
		$fd = fopen ("../update/$filename","r");
		while ($data = fgetcsv ($fd, filesize("../update/$filename"), "|")) 
			{
				$row++;
				$datalw=addslashes(ucwords(strtolower($data[2])));
				$nomi=explode(" ",$datalw);
				$cognome=$nomi[0];
				$nome=substr($datalw, strlen($cognome)+1);
				$query = "INSERT INTO datiGiocatori(ID,id_anno,cognome,nome,provenienza,ruolo) VALUES('$data[0]','$id_anno','$cognome','$nome','$data[3]','$data[5]')";
				mysql_query($query, $db);
			}
		fclose ($fd);
	}

?>