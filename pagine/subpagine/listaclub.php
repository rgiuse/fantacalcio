<?
	$PATHNAME = "..";
	require_once("$PATHNAME/include/header.php");
	$query = "SELECT * FROM campionati where nome_camp!='Nessuno' order by nome_camp";
	$rst=mysql_query($query, $db);
?>
<script language="JavaScript" type="text/javascript">
function checkCampionato()
{
var str;
var ck=true;
str="I seguenti campi non possono essere lasciati vuoti";
if (document.formCamp.camp.value=="") {
str=str+"\n--> Campionato";
ck=false;
}
if (!ck){
alert(str);
return false;
}
else
return true;
}
</script>

<h2>Elenco Campionati</h2>
<FORM name="formCamp" action="<?=$PATHNAME?>/script/doaddcamp.php" onSubmit="return checkCampionato();">
Campionato:<input size=30 name="camp">
<input type="Submit" value="Crea Campionato">
</FORM>
      <?
	while($line=mysql_fetch_array($rst))
		{
		?>
	<table width="75%" border="0" cellspacing="2" class="cellavuota">
      <tr>
        <td class="cella">
			<span class="titoloCelleLat">
			<table border="0" width="100%">
			<tr>
			<td>
			<span class="titoloCelleLat">
			<?
			echo $line[nome_camp];
			if ($line[iniziato]) echo "(Attivato)";
			?>
			</span>
			</td>
			<td align="right">
			<span class="titoloCelleLat">
			<a href="<?=$PATHNAME?>/script/dodelcamp.php?nomec=<?=$line[nome_camp]?>">Elimina</a>
			</span>
			</td>
			</tr>
			</table>
			
			</span>
		</td>
	  </tr>
      <?
	$query1 = "SELECT DISTINCT(squadra) FROM utenti where campionato='$line[nome_camp]' and campionato IS NOT NULL and isadmin=0";
	$rst1=mysql_query($query1, $db);
	while($line1=mysql_fetch_array($rst1))
		{
		?>
      <tr>
        <td class="cella"><font face='Verdana, Arial, Helvetica, sans-serif' size=2>
          <?=$line1[squadra]?>
        </font></td>
      </tr>
	  <?
		}
	?>
    </table>
	 <?
	}
?>