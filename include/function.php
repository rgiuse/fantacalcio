<?

function postMessage($messaggio, $dest, $from)
{
	global $db;
	global $campionato;
	if($dest!="-all-")
	{
		$query0 = "INSERT INTO chatboard (id_utente, campionato, time, msg, id_dest, letto) VALUES('$from', '$campionato', NOW(), '$messaggio', '$dest', 0)";
		mysql_query($query0,$db);
	}
	else
	{
		$query0 = "SELECT userid from utenti where campionato='$campionato'";
		$rst0 = mysql_query($query0, $db);
		//echo $query0;
		while($line0 = mysql_fetch_array($rst0))
		{
			$query0 = "INSERT INTO chatboard (id_utente, campionato, time, msg, id_dest, letto) VALUES('$from', '$campionato', NOW(), '$messaggio', '$line0[userid]', 0)";
			//echo $query0;
	                mysql_query($query0,$db);
		}
	}
}

function formazioneSq($squadra,$nome_camp,$giornata,$ris)
{
	global $db;
	$formazione="";
	for ($i=0;$i<4;$i++)
	{
	$query = "select count(*) from formazioni, datiGiocatori, campionati where datiGiocatori.ruolo='$i' and formazioni.squadra = '$squadra' and formazioni.ID=datiGiocatori.ID and campionati.nome_camp='$nome_camp' and datiGiocatori.id_anno=campionati.id_anno and formazioni.data_gior='$giornata' and riserva='$ris'and formazioni.nome_camp='$nome_camp'";

	$line=mysql_fetch_array(mysql_query($query,$db));
	$formazione=$formazione.$line[0];
	}
	return $formazione;
}

function ckFormazione($squadra,$nome_camp,$giornata)
{
	if ((formazioneSq($squadra,$nome_camp,$giornata,0)!="1442")&&
		(formazioneSq($squadra,$nome_camp,$giornata,0)!="1433")&&
		(formazioneSq($squadra,$nome_camp,$giornata,0)!="1451")&&
		(formazioneSq($squadra,$nome_camp,$giornata,0)!="1532")&&
		(formazioneSq($squadra,$nome_camp,$giornata,0)!="1541")&&
		(formazioneSq($squadra,$nome_camp,$giornata,0)!="1343")&&
		(formazioneSq($squadra,$nome_camp,$giornata,0)!="1352")) return false;
	return true;
}

function modificatoreDifesa($squadra,$nome_camp,$giornata)
{
	global $db;
	$query = "select ID from giornate where data='$giornata' order by data asc";
	$rst=mysql_query($query, $db);
	$line=mysql_fetch_array($rst);
	$rst1=giocatoriSqRuolo($giornata,$squadra,$nome_camp,'Difensore',0);
	$ndif=mysql_num_rows($rst1);
	$tot=0;
	
	if($ndif>=4)
	{
		while($line1=mysql_fetch_array($rst1))
		{
		$line3=mysql_fetch_array(votoBaseGiorn($line1[ID],$line[0]));
		if ($line3[0]==0)
			{
			$rst2=giocatoriSqRuolo($giornata,$squadra,$nome_camp,$line1[ruolo],1);
			while ($line2=mysql_fetch_array($rst2))
				{
					if ($line2!=0)
					{
						$line5=mysql_fetch_array(votoBaseGiorn($line2[ID],$line[0]));
						if (!isset($usati[$line2[ID]]))
						{
						$dif[$line2[ID]]=$line5[0];
						$usati[$line2[ID]]=1;
						if ($line5[0]!=0)break;
						}
					}
				}
			}
			else
			{
			$dif[$line1[ID]]=$line3[0];
			}
		}
		//if ($dif!=null) 
			arsort($dif);
		$tot=array_shift($dif)+array_shift($dif)+array_shift($dif);
		//echo $tot;
		$rst6=giocatoriSqRuolo($giornata,$squadra,$nome_camp,'Portiere',0);
		$line6=mysql_fetch_array($rst6);
		$line7=mysql_fetch_array(votoBaseGiorn($line6[ID],$line[0]));
		if ($line7[0]==0)
		{
			$rst8=giocatoriSqRuolo($giornata,$squadra,$nome_camp,'Portiere',1);
			$line8=mysql_fetch_array($rst8);
			$line9=mysql_fetch_array(votoBaseGiorn($line8[ID],$line[0]));
			$tot+=$line9[0];
		}
		else
		{
			$tot+=$line7[0];
		}
		//echo $tot;
		if (($tot/4)>=7) return 6;
		if ((($tot/4)>=6.5) && (($tot/4)<7)) return 3;
		if ((($tot/4)>=6) && (($tot/4)<6.5)) return 1;
		return 0;


	}
}

function votoFormazione($squadra,$nome_camp,$giornata)
{
	global $db;
	$query = "select ID from giornate where data='$giornata' order by data asc";
	$rst=mysql_query($query, $db);
	$line=mysql_fetch_array($rst);
	$rst1=giocatoriSq($giornata,$squadra,$nome_camp,0);
	$tot=0;
	while($line1=mysql_fetch_array($rst1))
	{
	$line3=mysql_fetch_array(votoGiorn($line1[ID],$line[0]));
	if ($line3[0]==0)
		{
		$rst2=giocatoriSqRuolo($giornata,$squadra,$nome_camp,$line1[ruolo],1);
		while ($line2=mysql_fetch_array($rst2))
			{
				if ($line2!=0)
				{
					$line5=mysql_fetch_array(votoGiorn($line2[ID],$line[0]));
					if (!isset($usati[$line2[ID]]))
					{
					$tot+=$line5[0];
					$usati[$line2[ID]]=1;
					if ($line5[0]!=0)break;
					}
				}

			}

		}
		else
		{
		$tot+=$line3[0];
		}

	}
	return $tot+modificatoreDifesa($squadra,$nome_camp,$giornata);
}

function golFattiGiornSquadra($squadra,$nome_camp,$giornata)
{
	$voto=votoFormazione($squadra,$nome_camp,$giornata);
	if (!camponeutroGiornSquadra($squadra,$nome_camp,$giornata))
		$voto+=casaGiornSquadra($squadra,$nome_camp,$giornata);
	if ($voto==0) return -1;
	if ($voto<=65.5) return 0;// + casaGiornSquadra($squadra,$nome_camp,$giornata);
	if ($voto<=71.5) return 1;// + casaGiornSquadra($squadra,$nome_camp,$giornata);
	if ($voto<=77.5) return 2;// + casaGiornSquadra($squadra,$nome_camp,$giornata);
	if ($voto<=83.5) return 3;// + casaGiornSquadra($squadra,$nome_camp,$giornata);
	if ($voto<=89.5) return 4;// + casaGiornSquadra($squadra,$nome_camp,$giornata);
	if ($voto<=95.5) return 5;// + casaGiornSquadra($squadra,$nome_camp,$giornata);
	if ($voto<=101.5) return 6;// + casaGiornSquadra($squadra,$nome_camp,$giornata);
	if ($voto<=107.5) return 7;// + casaGiornSquadra($squadra,$nome_camp,$giornata);
}

function casaGiornSquadra($squadra,$nome_camp,$giornata)
{
	global $db;
	$query = "select ID from giornate where data='$giornata' order by data asc";
	$rst=mysql_query($query, $db);
	$line=mysql_fetch_array($rst);
	$query1 = "select count(*) from sfidelega where squadra_casa='$squadra' and id_giorn='$line[0]'";
	$rst1=mysql_query($query1, $db);
	$line1=mysql_fetch_array($rst1);
	return $line1[0];
}

function avversariaGiornSquadra($squadra,$nome_camp,$giornata)
{
	global $db;
	$query = "select ID from giornate where data='$giornata' order by data asc";
	$rst=mysql_query($query, $db);
	$line=mysql_fetch_array($rst);
	if (casaGiornSquadra($squadra,$nome_camp,$giornata)==1)
	{
		$query1 = "select squadra_fuori from sfidelega where squadra_casa='$squadra' and id_giorn='$line[0]'";
		$rst1=mysql_query($query1, $db);
		$line1=mysql_fetch_array($rst1);
		return $line1[0];
	}
	else
	{
		$query1 = "select squadra_casa from sfidelega where squadra_fuori='$squadra' and id_giorn='$line[0]'";
		$rst1=mysql_query($query1, $db);
		$line1=mysql_fetch_array($rst1);
		return $line1[0];
	}
}

function camponeutroGiornSquadra($squadra,$nome_camp,$giornata)
{
	global $db;
	$query = "select ID from giornate where data='$giornata' order by data asc";
	$rst=mysql_query($query, $db);
	$line=mysql_fetch_array($rst);
	if (casaGiornSquadra($squadra,$nome_camp,$giornata)==1)
	{
		$query1 = "select campo_neutro from sfidelega where squadra_casa='$squadra' and id_giorn='$line[0]'";
		$rst1=mysql_query($query1, $db);
		$line1=mysql_fetch_array($rst1);
		return $line1[0];
	}
	else
	{
		$query1 = "select campo_neutro from sfidelega where squadra_fuori='$squadra' and id_giorn='$line[0]'";
		$rst1=mysql_query($query1, $db);
		$line1=mysql_fetch_array($rst1);
		return $line1[0];
	}
}

function golFattiTotali($squadra,$nome_camp)
{
	global $db;
	$query = "select data_inizio,data_fine from campionati where nome_camp='$nome_camp'";
	$rst=mysql_query($query, $db);
	$line=mysql_fetch_array($rst);
	
	$query1 = "select data from giornate where (data BETWEEN '$line[0]' and '$line[1]') and data<=now() order by data asc";
	$rst1=mysql_query($query1, $db);
	$gsq1=0;
	$tot=0;

	while($line1=mysql_fetch_array($rst1))
	{
		$gsq1=golFattiGiornSquadra($squadra,$nome_camp,$line1[0]);
		if ($gsq1!=-1)
		{
			$tot+=$gsq1;
		}
	}
	return $tot;
}

function golSubitiTotali($squadra,$nome_camp)
{
	global $db;
	$query = "select data_inizio,data_fine from campionati where nome_camp='$nome_camp'";
	$rst=mysql_query($query, $db);
	$line=mysql_fetch_array($rst);
	
	$query1 = "select data from giornate where (data BETWEEN '$line[0]' and '$line[1]') and data<=now() order by data asc";
	$rst1=mysql_query($query1, $db);
	$gsq2=0;
	$tot=0;
	$squadra2="";
	while($line1=mysql_fetch_array($rst1))
	{
		$squadra2=avversariaGiornSquadra($squadra,$nome_camp,$line1[0]);
		$gsq2=golFattiGiornSquadra($squadra2,$nome_camp,$line1[0]);
		if ($gsq2!=-1)
		{
			$tot+=$gsq2;
		}
	}
	return $tot;
}

function sfideVinteSquadra($squadra,$nome_camp)
{
	global $db;
	$query = "select data_inizio,data_fine from campionati where nome_camp='$nome_camp'";
	$rst=mysql_query($query, $db);
	$line=mysql_fetch_array($rst);
	
	$query1 = "select data from giornate where (data BETWEEN '$line[0]' and '$line[1]') and data<=now() order by data asc";
	$rst1=mysql_query($query1, $db);
	$tot=0;
	$gsq1=0;
	$gsq2=0;
	$squadra2="";
	while($line1=mysql_fetch_array($rst1))
	{
		$gsq1=golFattiGiornSquadra($squadra,$nome_camp,$line1[0]);
		if ($gsq1!=-1)
		{
			$squadra2=avversariaGiornSquadra($squadra,$nome_camp,$line1[0]);
			$gsq2=golFattiGiornSquadra($squadra2,$nome_camp,$line1[0]);
			if ($gsq2!=-1)
			{
				if ($gsq1>$gsq2) $tot+=1;
			}
		}

	}
	
	return $tot;
}

function sfidePerseSquadra($squadra,$nome_camp)
{
	global $db;
	$query = "select data_inizio,data_fine from campionati where nome_camp='$nome_camp'";
	$rst=mysql_query($query, $db);
	$line=mysql_fetch_array($rst);
	
	$query1 = "select data from giornate where (data BETWEEN '$line[0]' and '$line[1]') and data<=now() order by data asc";
	$rst1=mysql_query($query1, $db);
	$tot=0;
	$gsq1=0;
	$gsq2=0;
	$squadra2="";
	while($line1=mysql_fetch_array($rst1))
	{
		$gsq1=golFattiGiornSquadra($squadra,$nome_camp,$line1[0]);
		if ($gsq1!=-1)
		{
			$squadra2=avversariaGiornSquadra($squadra,$nome_camp,$line1[0]);
			$gsq2=golFattiGiornSquadra($squadra2,$nome_camp,$line1[0]);
			if ($gsq2!=-1)
			{
				if ($gsq1<$gsq2) $tot+=1;
			}
		}

	}
	return $tot;
}

function sfidePariSquadra($squadra,$nome_camp)
{
	global $db;
	$query = "select data_inizio,data_fine from campionati where nome_camp='$nome_camp'";
	$rst=mysql_query($query, $db);
	$line=mysql_fetch_array($rst);
	
	$query1 = "select data from giornate where (data BETWEEN '$line[0]' and '$line[1]') and data<=now() order by data asc";
	$rst1=mysql_query($query1, $db);
	$tot=0;
	$gsq1=0;
	$gsq2=0;
	$squadra2="";
	while($line1=mysql_fetch_array($rst1))
	{
		$gsq1=golFattiGiornSquadra($squadra,$nome_camp,$line1[0]);
		if ($gsq1!=-1)
		{
			$squadra2=avversariaGiornSquadra($squadra,$nome_camp,$line1[0]);
			$gsq2=golFattiGiornSquadra($squadra2,$nome_camp,$line1[0]);
			if ($gsq2!=-1)
			{
				if ($gsq1==$gsq2) $tot+=1;
			}
		}

	}
	return $tot;
}


function votoSquadra($squadra,$nome_camp)
{
	global $db;
	$query = "select data_inizio,data_fine from campionati where nome_camp='$nome_camp'";
	$rst=mysql_query($query, $db);
	$line=mysql_fetch_array($rst);
	$query1 = "select data from giornate where (data BETWEEN '$line[0]' and '$line[1]') and data<=now() order by data asc";
	$rst1=mysql_query($query1, $db);
	$tot=0;
	while($line1=mysql_fetch_array($rst1))
	{
		$tot=(votoFormazione($squadra,$nome_camp,$line1[0])*1)+($tot*1);
	}
	return $tot;
}

function idRuolo($IdGiocatore,$id_anno)
{
	global $db;
	$query = "select datiGiocatori.ruolo from datiGiocatori where datiGiocatori.ID='$IdGiocatore' and id_anno='$id_anno'";
	$rst=mysql_query($query,$db);
	$line=mysql_fetch_array($rst);
	return $line[0];
}
function idAnno($nome_camp)
{
	global $db;
	$query1 = "select id_anno from campionati where nome_camp='$nome_camp'";
	$rst1=mysql_query($query1, $db);
	$line=mysql_fetch_array($rst1);
	return $line[0];
}

function addPlayer($id,$ris,$squadra,$nome_camp,$giornata)
{
	global $db;
	$fSq=formazioneSq($squadra,$nome_camp,$giornata,$ris);
	$query1 = "SELECT inizio FROM giornate where data='$giornata'";
	$rst=mysql_query($query1, $db);
	$line=mysql_fetch_array($rst);
	if  (date("YmdHis", strtotime($giornata." ".$line[inizio]))-date("YmdHis")>=20000)
	{
		$query3 = "SELECT count(*) FROM giocatori where ID='$id' and squadra='$squadra' and nome_camp='$nome_camp'";
		$rst1=mysql_query($query3, $db);
		$n1=mysql_fetch_array($rst1);
		if ($id==-1) return 0;
		if ($n1[0]!=1) return 4;
		$query2 = "SELECT count(*) FROM formazioni where data_gior='$giornata' and squadra='$squadra' and nome_camp='$nome_camp' and riserva='$ris'";
		$rst=mysql_query($query2, $db);
		$n=mysql_fetch_array($rst);
		if (($n[0]<11)&&$ris==0)
		{
				$query = "INSERT INTO formazioni VALUES(NULL,'$squadra','$nome_camp','$id',CURDATE(),CURTIME(),'$giornata','$line[inizio]','0','$ris')";
				//da fare multi campionato
				if ($id!=-1)
				mysql_query($query, $db);
				return 0;
		}
		else
			if ($ris==0) return 2;

		if  (($n[0]<7) && $ris==1 && 
				(idRuolo($id,idAnno($nome_camp))==0 && substr($fSq, 0,1)<1) || 
				(idRuolo($id,idAnno($nome_camp))==1 && substr($fSq, 1,1)<2) || 
				(idRuolo($id,idAnno($nome_camp))==2 && substr($fSq, 2,1)<2) || 
				(idRuolo($id,idAnno($nome_camp))==3 && substr($fSq, 3,1)<2))
			{
				$query = "INSERT INTO formazioni VALUES(NULL,'$squadra','$nome_camp','$id',CURDATE(),CURTIME(),'$giornata','$line[inizio]','0','$ris')";
				//da fare multi campionato
				if ($id!=-1)
				mysql_query($query, $db);
				return 0;
			}
			else
				return 3;
	}
	else
		return 1;
}

function mesgGen($dove,$messaggio)
{
	$msg=urlencode($messaggio);
	header("Location: $dove/pagine/messaggio.php?msg=$msg");
}
?>
