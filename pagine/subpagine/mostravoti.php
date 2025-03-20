<?
	$PATHNAME = "..";
	require_once("$PATHNAME/include/header.php");
	if (authent($site_login, $site_password))
	{
		
		if (isset($_POST["setday"])) $giornata=$_POST["setday"];
		?>
		<B><H3>
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
			<form method=post name="fgiornata" action="mostravoti.php">
				Giornata del <select name="setday" style="font-size: 16; font-family: verdana; height: 24px" onchange="window.document.fgiornata.submit();">
			<?
			
			$ck=0;
			while($line=mysql_fetch_array($rst))
			{
				if (!isset($setday)&&!isset($giornata)) 
				{
					if (date(ymd,strtotime($line[data]))>=date(ymd))$setday=$giornata=$line[data];
					
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
			</H3></B>
			<table width="95%" border="1" cellpadding="1" cellspacing="2" class="tabellabianca">
					<tr class="tabellabordosxdx"> 
						<td align="center" class="cella"><span class="titoloCelleLat">Qualifica Giornata</span></td> 
					</tr>
					<tr class="tabellabordosxdx"> 
						<td align="center" valign="top" class="cella">
						<table width="100%" border="0" cellspacing="1" cellpadding="1"> 
							 <tr class="tabellabordosxdx" > 
								<td align="center" class="cella">
									<span class="titoloCelleLat">Squadra</span>
								</td> 
								<td align="center" class="cella">
									<span class="titoloCelleLat">Punti</span>
								</td>
								<td align="center" class="cella">
									<span class="titoloCelleLat">Mod. Dif.</span>
								</td> 
								<td align="center" class="cella">
									<span class="titoloCelleLat">Punti Tot.</span>
								</td> 
							</tr>
			<?
			$query1= "select DISTINCT(squadra) from utenti where isadmin=0 and campionato='$campionato' order by squadra";
			$rst1=mysql_query($query1,$db);
			while($line1=mysql_fetch_array($rst1))
			{		  
				$query4="select coloresfondo,colorecarattere from utenti where squadra='$line1[squadra]'and campionato='$campionato' and isadmin=0";
				$rst4=mysql_query($query4,$db);
				$line4=mysql_fetch_array($rst4);
					?>
					<tr class="tabellabordosxdx"> 
						<td align="center" class="cella" bgcolor='<?=$line4[coloresfondo]?>' class="cella" style="{color:<?=$line4[colorecarattere]?>; font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 14;}"><?=$line1[squadra]?></td> 
						<td width= "80" align="center" class="cella" bgcolor='<?=$line4[coloresfondo]?>' class="cella" style="{color:<?=$line4[colorecarattere]?>; font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 12; font-weight: bold;}"><?=votoFormazione($line1[squadra],$campionato,$giornata)-modificatoreDifesa($line1[squadra],$campionato,$giornata);?></td>
						<td width= "80" align="center" class="cella" bgcolor='<?=$line4[coloresfondo]?>' class="cella" style="{color:<?=$line4[colorecarattere]?>; font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 12; font-weight: bold;}"><?=modificatoreDifesa($line1[squadra],$campionato,$giornata)+0;?></td>
						<td width= "80" align="center" class="cella" bgcolor='<?=$line4[coloresfondo]?>' class="cella" style="{color:<?=$line4[colorecarattere]?>; font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 12; font-weight: bold;}"><?=votoFormazione($line1[squadra],$campionato,$giornata);?></td>
					</tr>
					<?
			}
			?>
				</TABLE>
				</td>
				</tr>
				</TABLE>

			<?
			if ( mysql_num_rows($rst)==0)
			{
			?>
			Mi spiace questa formazione non è attualmente disponibile.
			<?
			}
			?>
			</td>
			</tr>
			</TABLE>

			<?
			}//----------------------------fine se ci sono giornate
		}
?>
