<?
	$PATHNAME = "..";
	require_once("$PATHNAME/include/header.php");
	$query0 = "select data_inizio,data_fine from campionati where nome_camp='$campionato'";
	$rst0=mysql_query($query0, $db);
	$line0=mysql_fetch_array($rst0);

	$query = "select * from giornate where data BETWEEN '$line0[0]' and '$line0[1]' order by data asc";
	$rst=mysql_query($query, $db);
?>
<h2>Elenco Giornate</h2>
	<table width="85%" border="0" cellspacing="2" class="cellavuota">
      <tr>
        <td class="cella"><span class="titoloCelleLat">Data</span></td>
		<td class="cella"><span class="titoloCelleLat">Ora Inizio</span></td>
      <?
	if (isadmin($site_login)) echo "<td class=\"cella\" ><span class=\"titoloCelleLat\">&nbsp;</span></td>";
	echo "</tr>";
	while($line=mysql_fetch_array($rst))
		{
		?>
      <tr>
        <td class="cella"><font face='Verdana, Arial, Helvetica, sans-serif' size=2>
          <?=$line[data]?>
        </font></td>
        <td class="cella"><font face='Verdana, Arial, Helvetica, sans-serif' size=2>
          <?=$line[inizio]?>
        </font><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;
        </font></td>
		<?
		if (isadmin($site_login))
		echo"<td class=\"cella\"><A HREF=$PATHNAME/script/removegiornata.php?data=".$line[data]."&ora=".$line[inizio]." onClick=\" return confirm('Sei sicuro di voler eliminare questa giornata? Con essa verranno cancellate tutte le formazioni a lei riferite!');\">Elimina</A></td>";
		?>
      </tr>
	  <?
		}
	?>
    </table>