<?
	$PATHNAME = "..";
	require_once("$PATHNAME/include/header.php");
	if (authent($site_login, $site_password))
	{
		echo "<CENTER><B><H2>".$campionato."</H2></B>";
		$query1= "select DISTINCT (squadra) from utenti where isadmin=0 and campionato='$campionato'";
		
		$rst1=mysql_query($query1,$db);
		while($line1=mysql_fetch_array($rst1))
		{	
			$query4="select coloresfondo,colorecarattere from utenti where squadra='$line1[squadra]'and isadmin=0";
			$rst4=mysql_query($query4,$db);
			$line4=mysql_fetch_array($rst4);
			?>
			<table width="95%" border="1" cellpadding="1" cellspacing="2" class="tabellabianca">
				<tr class="tabellabordosxdx"> 
					<td align="center" class="cella">
						<span class="titoloCelleLat"><?=$line1[squadra]?></span>
					</td> 
				</tr>
				<tr class="tabellabordosxdx"> 
				<td align="center" valign="top" class="cella">
				<?
				$rst=giocatoriSel_1($line1[squadra],$campionato);
				if (mysql_num_rows($rst)!=0)
				{
				?>
				<table width="100%" border="0" cellspacing="1" cellpadding="1">
					<?
					}
					$n=0;
					while($line=mysql_fetch_array($rst))
					{
					$n=$n+1;
					?>
						<tr class="tabellabordosxdx">
							<td bgcolor="#EEEEEE" class="cella" style="{color:#000000; font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 10;}">
							<div align='right'>
								<b><?=$n?>.</b>
							</div>
							</td>
							<td bgcolor='<?=$line4[coloresfondo]?>' class="cella" style="{color:<?=$line4[colorecarattere]?>; font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 11;}">
								<em>
								<?=$line[ruolo]?>
								</em>
							</td>
							<td width='250' bgcolor='<?=$line4[coloresfondo]?>' class="cella" style="{color:<?=$line4[colorecarattere]?>; font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 14;}">
							<div>
								<b><?=$line[cognome]?></b>
							</div>
							</td>
							<td width='250' bgcolor='<?=$line4[coloresfondo]?>' class="cella" style="{color:<?=$line4[colorecarattere]?>; font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 14;}">
							<?=$line[nome]?>
							</td>
							<td width='250' bgcolor='<?=$line4[coloresfondo]?>' class="cella" style="{color:<?=$line4[colorecarattere]?>; font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 14;}">
							<?=$line[provenienza]?>
							</td>
						</tr>
					
					<?
					}
				?>
			</table> 
			<?
				if (mysql_num_rows($rst)==0)
				{
				?>
				Mi spiace questa formazione non è attualmente disponibile.
				<?
				}
				?>
				</td>
				</tr> 
				</table>
				<p>
					<hr width='350' size='1'>
				</p>
			<?
			}
			echo "</CENTER>";
			
	}
?>