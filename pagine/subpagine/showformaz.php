<? 
	$PATHNAME= "..";

	function genera_pagina($documento)
	{
		global $HTTP_ACCEPT;

		if(eregi("text/vnd.wap.wml", $_SERVER["HTTP_ACCEPT"]))
			{		
				$xslt_file="../xslt/wapxslt.xsl";
			}
			else
			{
				$xslt_file="../xslt/xslt.xsl";
			}
		$arguments=Array('/_xml'=>$documento);

		/* avvia la trasformazione */
		$xh=xslt_create();
		$output=xslt_process($xh, 'arg:/_xml', $xslt_file, NULL, $arguments);
		if(!$output)echo xslt_error($xh);

		xslt_free($xh);

		/* restituisce al browser il documento trasformato */
		echo $output;

		return;
	}
	require("../include/header.php");
	if (authent($site_login, $site_password)) 
	{ 
	global $HTTP_ACCEPT;
	if (isset($_POST["setday"])) $giornata=$_POST["setday"];
		if(!eregi("text/vnd.wap.wml", $_SERVER["HTTP_ACCEPT"]))
		{
		?>
		<B>
		<H3>
		<?
		$query0 = "select data_inizio,data_fine from campionati where nome_camp='$campionato'";
		$rst0=mysql_query($query0, $db);
		$line0=mysql_fetch_array($rst0);
	
		$query = "select * from giornate where data BETWEEN '$line0[0]' and '$line0[1]' order by data asc";
		$rst=mysql_query($query, $db);
		if (mysql_num_rows($rst)==0) 
			echo("Mi spiace ma attualmente non esiste nessuna giornata valida");	
		else
		{
			//----------------------------inizio se ci sono
		?>
		<form method=post name="fgiornata" action="showformaz.php">
			Giornata del <select name="setday" style="font-size: 16; font-family: verdana; height: 24px" onchange="window.document.fgiornata.submit();">
		<?
		
		$ck=0;
		while($line=mysql_fetch_array($rst))
		{
			if (!isset($setday)&&!isset($giornata)) 
			{
				if (date(ymd,strtotime($line[data]))>=date(ymd))
				{
					$setday=$giornata=$line[data];
					$IDgiorn=$line[ID];
				}
			}
			if (isset($giornata)&& $line[data]==$giornata) 
			{
				$IDgiorn=$line[ID];
				echo "<option selected value='$line[data]'>".date("d-m-Y",strtotime($line[data]))."</option>";
			}
			else
				echo "<option value='$line[data]'>".date("d-m-Y",strtotime($line[data]))."</option>";
		}
		?>
		</select>
		<noscript>
			<INPUT name="Invia" type="submit" value="Seleziona"> 
		</noscript>
		</form>
		</H3>
		</B>
		<?
		}
		}
		else
		{
			$query0 = "select data_inizio,data_fine from campionati where nome_camp='$campionato'";
			$rst0=mysql_query($query0, $db);
			$line0=mysql_fetch_array($rst0);
	
			$query = "select * from giornate where data BETWEEN '$line0[0]' and '$line0[1]' order by data asc";
			$rst=mysql_query($query, $db);
			while($line=mysql_fetch_array($rst))
			{
				
				if (!isset($setday)&&!isset($giornata)&&isset($old)) 
				{
					if (date(ymd,strtotime($line[data]))>=date(ymd))
					{
						$setday=$giornata=$old;
						$IDgiorn=$line[ID];
					}
				}
				$old=$line[data];
			}
		}
		$query = "select * from giornate where data='$giornata' order by data asc";
		$rst=mysql_query($query, $db);
		$line=mysql_fetch_array($rst);
		$IDgiorn=$line[ID];
		$_xml ="<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n";
		$_xml .="<formazioni>\r\n";
		$query1= "select DISTINCT (squadra) from utenti where campionato='$campionato' and isadmin=0 ";
		$rst1=mysql_query($query1,$db);
		while($line1=mysql_fetch_array($rst1))
		{
		$query4="select coloresfondo,colorecarattere from utenti where squadra='$line1[squadra]'and campionato='$campionato' and isadmin=0";
		$rst4=mysql_query($query4,$db);
		$line4=mysql_fetch_array($rst4);
		$rst=giocatoriSq($giornata,$line1[squadra],$campionato,0);
		$_xml .="\t<squadra nome=\"$line1[squadra]\" cchar=\"$line4[colorecarattere]\" csfondo=\"$line4[coloresfondo]\">\r\n";
		$_xml .="\t<titolari>\r\n";
		$n=0;
		$k=0;
		while ($line = mysql_fetch_array($rst)) 
			{	
				$n++;
				$_xml .="\t\t<giocatore>\r\n";
				$_xml .="\t\t\t<num>".$n."</num>\r\n";
				$_xml .="\t\t\t<ruolo>".$line[ruolo]."</ruolo>\r\n";
				$_xml .="\t\t\t<nome>".$line[nome]."</nome>\r\n";
				$_xml .="\t\t\t<cognome>".$line[cognome]."</cognome>\r\n";
				$line3=mysql_fetch_array(votoGiorn($line[ID],$IDgiorn));
					if ($line3[0]!=0)
						$voto=$line3[0];
					 else
						$voto="n/a";
				$_xml .="\t\t\t<voto>".$voto."</voto>\r\n";
				$line4=mysql_fetch_array(votoBaseGiorn($line[ID],$IDgiorn));
					if ($line4[0]!=0)
						$voto=$line4[0];
					 else
						$voto="n/a";
				$_xml .="\t\t\t<votobase>".$voto."</votobase>\r\n";
				$_xml .="\t\t</giocatore>\r\n";
			}
		$_xml .="\t</titolari>\r\n";
		$rst=giocatoriSq($giornata,$line1[squadra],$campionato,1);
		$_xml .="\t<riserve>\r\n";
		$k=0;
		while ($line = mysql_fetch_array($rst)) 
			{	

				$k++;
				$_xml .="\t\t<giocatore>\r\n";
				$_xml .="\t\t\t<num>".$k."</num>\r\n";
				$_xml .="\t\t\t<ruolo>".$line[ruolo]."</ruolo>\r\n";
				$_xml .="\t\t\t<nome>".$line[nome]."</nome>\r\n";
				$_xml .="\t\t\t<cognome>".$line[cognome]."</cognome>\r\n";
				$line3=mysql_fetch_array(votoGiorn($line[ID],$IDgiorn));
					if ($line3[0]!=0)
						$voto=$line3[0];
					 else
						$voto="n/a";
				$_xml .="\t\t\t<voto>".$voto."</voto>\r\n";
				$line4=mysql_fetch_array(votoBaseGiorn($line[ID],$IDgiorn));
					if ($line4[0]!=0)
						$voto=$line4[0];
					 else
						$voto="n/a";
				$_xml .="\t\t\t<votobase>".$voto."</votobase>\r\n";
				$_xml .="\t\t</giocatore>\r\n";
			}
			$_xml .="\t</riserve>\r\n";
			$_xml .="\t</squadra>\r\n";
		}
		$_xml .="</formazioni>";
		//echo $_xml;
		genera_pagina($_xml);
		
	}
	else
	{
		$msg=urlencode("&Egrave; necessario essere autenticati<BR>per poter accedere a questa sezione!");
		header("Location: $PATHNAME/pagine/messaggio.php?msg=$msg");
	}
?>
