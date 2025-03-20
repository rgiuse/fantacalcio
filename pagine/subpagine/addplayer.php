<?
$PATHNAME = "..";
	require_once("$PATHNAME/include/header.php");
	if (authent($site_login, $site_password))
	{
$rst = giocatoriSel_1($squadra,$campionato); 
$rst2= giocatoriSel_2($giornata,$squadra,$campionato); 
?>
<h3>Aggiungi giocatore</h3>
				
				<table width="95%" border="1" cellpadding="1" cellspacing="2" class="tabellabianca">
				<tr class="tabellabordosxdx"> 
					<td class="cella"><span class="titoloCelleLat">&nbsp;Nome Giocatore</span></td>
					<td class="cella"><span class="titoloCelleLat">&nbsp;Ruolo</span></td>
					<td align="center" class="cella"><span class="titoloCelleLat">Aggiungi</span></td>
				</tr>

	<?
	$line2=mysql_fetch_array($rst2);
	while($line=mysql_fetch_array($rst))
	{
		if (!($line2[ID]==$line[ID]))
		{
			?>
			<tr class="tabellabordosxdx"> 
                <td class="cella"> <? echo $line[cognome]." ".$line[nome]; ?></td> 
				<td class="cella"> <em><?=$line[ruolo]; ?></em></td>
				<td class="cella"> <a href="<?=$PATHNAME?>/script/doaddplayer.php?id=<?=$line[ID]?>&ris=<?=$ris?>">Aggiungi</a></td> 
            </tr>  
		<?
		}
		else
			$line2=mysql_fetch_array($rst2);
	}
	?>
</table>

<br>
<br>
<a href="../pagine/gestioneteam.php">Indietro</a>
<?
	}
?>