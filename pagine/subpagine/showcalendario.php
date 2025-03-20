<?
	$PATHNAME = "..";
	require_once("$PATHNAME/include/header.php");
	if (authent($site_login, $site_password))
	{
		echo "<CENTER><B><H2>Lega ".$campionato."</H2></B>";
		$query0 = "select data_inizio,data_fine from campionati where nome_camp='$campionato'";
		$rst0=mysql_query($query0, $db);
		$line0=mysql_fetch_array($rst0);
	
		$query = "select ID, data from giornate where data BETWEEN '$line0[0]' and '$line0[1]' order by data asc";
		$rst1=mysql_query($query, $db);
		if (mysql_num_rows($rst1)==0) 
			echo("Mi spiace ma attualmente non esiste nessuna giornata valida");
		else
		{
			$n=0;
			while($line1=mysql_fetch_array($rst1))
			{
				$n++;
				$query2= "select * from sfidelega where id_giorn='$line1[0]'";
				$rst2=mysql_query($query2,$db);
				if (mysql_num_rows($rst2)>0)
				{
				?>

				<table width="95%" border="1" cellpadding="1" cellspacing="2" class="tabellabianca">
						<tr class="tabellabordosxdx"> 
							<td align="center" class="cella">
								<span class="titoloCelleLat"><?=$n?>° Giornata (<?=date("d-m-Y",strtotime($line1[data]))?>)</span>
							</td> 
						</tr>
						<tr class="tabellabordosxdx"> 
							<td align="center" valign="top" class="cella">
							<table width="100%" border="0" cellspacing="1" cellpadding="1"> 
								 <tr class="tabellabordosxdx" > 
									<td align="center" class="cella" width="40%">
										<span class="titoloCelleLat">Squadra 1</span>
									</td>
									<td align="center" class="cella" width="40%">
										<span class="titoloCelleLat">Squadra 2</span>
									</td> 
									<td align="center" class="cella" colspan="2">
										<span class="titoloCelleLat">Gol 1vs2 </span>
									</td>
								</tr>
				<?
				$query2= "select * from sfidelega where id_giorn='$line1[0]'";
				$rst2=mysql_query($query2,$db);

				while($line2=mysql_fetch_array($rst2))
				{	
				$query4="select coloresfondo,colorecarattere from utenti where squadra='$line2[squadra_casa]'and campionato='$campionato' and isadmin=0";
				$rst4=mysql_query($query4,$db);
				$line4=mysql_fetch_array($rst4);
				$query5="select coloresfondo,colorecarattere from utenti where squadra='$line2[squadra_fuori]'and campionato='$campionato' and isadmin=0";
				$rst5=mysql_query($query5,$db);
				$line5=mysql_fetch_array($rst5);
				?>
						<tr class="tabellabordosxdx"> 
							<td align="center" class="cella" bgcolor='<?=$line4[coloresfondo]?>' style="{color:<?=$line4[colorecarattere]?>; font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 14;}"><?echo $line2[squadra_casa]; if ($line2[campo_neutro]) echo " <I>(Fuori)</I>"; else echo " <I>(Casa)</I>";?></td> 
							<td align="center" class="cella" bgcolor='<?=$line5[coloresfondo]?>' style="{color:<?=$line5[colorecarattere]?>; font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 14;}"><?=$line2[squadra_fuori]?> <I>(Fuori)</I></td> 
							<td align="center" class="cella" style="{font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 12; font-weight: bold;}"><?=golFattiGiornSquadra($line2[squadra_casa],$campionato,$line1[data])?></td> 
							<td align="center" class="cella" style="{font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 12; font-weight: bold;}"><?if (golFattiGiornSquadra($line2[squadra_fuori],$campionato,$line1[data])==-1) echo 0; else echo golFattiGiornSquadra($line2[squadra_fuori],$campionato,$line1[data]); ?></td> 
							
						</tr>
						<?
				}
				?>
					</TABLE>
					</td>
					</tr>
					</TABLE>
					<p>
						<hr width='350' size='1'>
					</p>
				<?
				}
			}
		}
		echo "</CENTER>";	
	}
?>