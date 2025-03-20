<?
	$PATHNAME = "..";
	require_once("$PATHNAME/include/header.php");
	$query0 = "select data_inizio,data_fine from campionati where nome_camp='$campionato'";
	$rst0=mysql_query($query0, $db);
	$line0=mysql_fetch_array($rst0);

	$query = "select * from giornate where data BETWEEN '$line0[0]' and '$line0[1]' order by data asc";
	//$query = "SELECT * FROM giornate order by Data";
	$rst=mysql_query($query, $db);
?>
<h2>Gestione Giornate</h2>
<? if (isadmin($site_login) && authent($site_login, $site_password)) 
	{ ?>
<form name="form1" method="post" action="<?=$PATHNAME?>/script/doinsertgiornata.php">
  <table border="0" cellspacing="2" class="cellavuota">
    <tr>
      <td colspan="2" align="center" class="cella"><span class="titoloCelleLat"><strong>Inserisci giornata</strong></span></td>
    </tr>
    <tr>
      <td width="142" class="cella"><font size="2" face="Arial, Helvetica, sans-serif">Data: </font></td>
      <td width="171" class="cella"> <font size="2" face="Arial, Helvetica, sans-serif">
        <select name="day">
          <? 	$g=0;
		while($g<31)
		{
			$g++;
			echo "<option value='$g'>$g</option>";
		}
	?>
        </select>
        <select name="month">
          <? 	$g=0;
		while($g<12)
		{
			$g++;
			echo "<option value='$g'>$g</option>";
		}
	?>
        </select>
        <select name="year">
          <? 	$g=2003;
		while($g<2020)
		{
			$g++;
			echo "<option value='$g'>$g</option>";
		}
	?>
        </select>
      </font></td>
    </tr>
    <tr>
      <td class="cella"><font size="2" face="Arial, Helvetica, sans-serif">Ora
          Inizio:</font></td>
      <td class="cella"><font size="2" face="Arial, Helvetica, sans-serif">
	   <select name="orapart1">
          <? 	$g=0;
		while($g<24)
		{
			$g++;
			echo "<option value='$g'>$g</option>";
		}
	?>
        </select>
        <!-- <input name="orapart1" type="text" value="00" size="2" maxlength="2"> -->
        <font size="5">:</font>
		<select name="orapart2">
			<option value='00'>00</option>
			<option value='30'>30</option>
        </select>
        <!-- <input name="orapart2" type="text" value="00" size="2" maxlength="2"> -->
      </font></td>
    </tr>
    <tr align="center">
      <td colspan="2" class="cella">
        <input type="submit" name="Submit" value="Inserisci">      </td>
    </tr>
  </table>
  <p align="center">&nbsp; </p>
</form>

<? }
?> 
	<table width="85%" border="0" cellspacing="2" class="cellavuota">
      <tr>
		<td class="cella"><span class="titoloCelleLat">N.</span></td>
        <td class="cella"><span class="titoloCelleLat">Data</span></td>
		<td class="cella"><span class="titoloCelleLat">Ora Inizio</span></td>
		<td class="cella"><span class="titoloCelleLat">&nbsp;</span></td>
      <?
	if (isadmin($site_login)) echo "<td class=\"cella\" ><span class=\"titoloCelleLat\">&nbsp;</span></td>";
	echo "</tr>";
	$n=0;
	while($line=mysql_fetch_array($rst))
		{
			$n++;
		?>
      <tr>
		 <td bgcolor="EEEEEE" class="cella" style="color: rgb(0, 0, 0); font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 11px;">
			<div align='right'>
				<b><?=$n?>.</b>
			</div>
		</td>
        <td class="cella">
			<font face='Verdana, Arial, Helvetica, sans-serif' size=2><?=date("d-m-Y",strtotime($line[data]))?></font>
		</td>
        <td class="cella">
			<font face='Verdana, Arial, Helvetica, sans-serif' size=2><?=$line[inizio]?>&nbsp;</font>
		</td>
		<td class="cella">
			<font face='Verdana, Arial, Helvetica, sans-serif' size=2><A HREF=<?echo "$PATHNAME/pagine/gestionesfide.php?data=$line[data]&ora=$line[inizio]";?>>Gestisci sfide</A></font>
		</td>
		<?
		if (isadmin($site_login))
		echo"<td class=\"cella\"><font face='Verdana, Arial, Helvetica, sans-serif' size=2><A HREF=$PATHNAME/script/removegiornata.php?data=".$line[data]."&ora=".$line[inizio]." onClick=\" return confirm('Sei sicuro di voler eliminare questa giornata? Con essa verranno cancellate tutte le formazioni a lei riferite!');\">Elimina</A></font></td>";
		?>
      </tr>
	  <?
		}
	?>
    </table>