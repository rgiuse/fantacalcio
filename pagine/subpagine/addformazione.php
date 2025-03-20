<?
	$PATHNAME = "..";
	require_once("$PATHNAME/include/header.php");

	if (authent($site_login, $site_password))
	{
		$rst = giocatoriSel_1($squadra,$campionato); 
		$rst2= giocatoriSel_2($giornata,$squadra,$campionato); 
 ?>
 <center>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function selezionati()
		{
		n=0;
		for (i=0;i<document.formFormazione.length;i++) if (document.formFormazione.elements[i].checked) n++;
		if ((n+<?
			$query = "SELECT count(*) FROM formazioni where data_gior='$giornata' and squadra='$squadra' and riserva=0";
			$rst1=mysql_query($query, $db);
			$n=mysql_fetch_array($rst1);echo $n[0];?>)*1>11) 
			{
			window.alert(" Attenzione stai cercando di inserire più di 11 giocatori ");
			return false;
			}
			return true;
		}

//-->
</SCRIPT>
<h2>Seleziona formazione</h2>
<FORM METHOD=POST ACTION="<?echo $PATHNAME;?>/script/doaddformazione.php" name="formFormazione">
<table width="95%" border="1" cellpadding="1" cellspacing="2" class="tabellabianca">
		<tr class="tabellabordosxdx"> 
			<td class="cella"><span class="titoloCelleLat">&nbsp;Nome Giocatore</span></td>
			<td class="cella"><span class="titoloCelleLat">&nbsp;Ruolo</span></td>
		</tr>	
	<?
	$line2=mysql_fetch_array($rst2);
	while($line=mysql_fetch_array($rst))
	{
		if (!($line2[ID]==$line[ID]))
		{
			?>
			<tr class="tabellabordosxdx"> 
                <td class="cella"><INPUT TYPE='checkbox' value='<?=$line[ID]?>' name='ck[]'onClick='return selezionati();'> <? echo $line[cognome]." ".$line[nome]; ?></td> 
				<td class="cella"> <b><em><?=$line[ruolo]; ?></em></b></td>
            </tr> 
			<?
		}
		else
			$line2=mysql_fetch_array($rst2);
	}
	?>
</table>
<INPUT TYPE="submit" value="Inserisci Giocatori" onClick="return selezionati();">
</FORM>

</center>
<? 
	}
	else
	{

		$msg=urlencode("&Egrave; necessario essere autenticati<BR>per poter accedere a questa sezione!");
		header("Location: $PATHNAME/pagine/messaggio.php?msg=$msg");
	}

?>