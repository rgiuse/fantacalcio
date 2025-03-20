<?
	$PATHNAME = "..";
	require_once("$PATHNAME/include/header.php");
	if (authent($site_login, $site_password))
	{
		
		if (isset($_POST["setday"])) $giornata=$_POST["setday"];
		?>
			<table width="95%" border="1" cellpadding="1" cellspacing="2" class="tabellabianca">
					<tr class="tabellabordosxdx"> 
						<td align="center" class="cella"><span class="titoloCelleLat">Classifica Lega</span></td> 
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
									<span class="titoloCelleLat">Vinte</span>
								</td> 
								<td align="center" class="cella">
									<span class="titoloCelleLat">Pari</span>
								</td> 
								<td align="center" class="cella">
									<span class="titoloCelleLat">Perse</span>
								</td> 
								<td align="center" class="cella">
									<span class="titoloCelleLat">Gol Fatti</span>
								</td> 
								<td align="center" class="cella">
									<span class="titoloCelleLat">Gol Subiti</span>
								</td> 
							</tr>
			<?
			flush();
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
						<td width= "80" align="center" class="cella" bgcolor='<?=$line4[coloresfondo]?>' class="cella" style="{color:<?=$line4[colorecarattere]?>; font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 12; font-weight: bold;}"><?=sfideVinteSquadra($line1[squadra],$campionato)*3+sfidePariSquadra($line1[squadra],$campionato);?></td>
						<td width= "80" align="center" class="cella" bgcolor='<?=$line4[coloresfondo]?>' class="cella" style="{color:<?=$line4[colorecarattere]?>; font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 12; font-weight: bold;}"><?=sfideVinteSquadra($line1[squadra],$campionato);?></td>
						<td width= "80" align="center" class="cella" bgcolor='<?=$line4[coloresfondo]?>' class="cella" style="{color:<?=$line4[colorecarattere]?>; font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 12; font-weight: bold;}"><?=sfidePariSquadra($line1[squadra],$campionato);?></td>
						<td width= "80" align="center" class="cella" bgcolor='<?=$line4[coloresfondo]?>' class="cella" style="{color:<?=$line4[colorecarattere]?>; font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 12; font-weight: bold;}"><?=sfidePerseSquadra($line1[squadra],$campionato);?></td>
						<td width= "80" align="center" class="cella" bgcolor='<?=$line4[coloresfondo]?>' class="cella" style="{color:<?=$line4[colorecarattere]?>; font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 12; font-weight: bold;}"><?=golFattiTotali($line1[squadra],$campionato);?></td>
						<td width= "80" align="center" class="cella" bgcolor='<?=$line4[coloresfondo]?>' class="cella" style="{color:<?=$line4[colorecarattere]?>; font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 12; font-weight: bold;}"><?=golSubitiTotali($line1[squadra],$campionato);?></td>
					</tr>
					<?
					flush();
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
?>