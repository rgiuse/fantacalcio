<?
	$PATHNAME = "..";
	require_once("$PATHNAME/include/header.php");
	if (authent($site_login, $site_password)&&($campionato="Nessuno"))
	{ 
	$query = "SELECT * FROM campionati where nome_camp!='Nessuno' and iniziato!='1' order by nome_camp";
	$rst=mysql_query($query, $db);
?>
<h2>Iscrizione al Campionato:</h2>
E' necessario iscriversi ad un capionato per poter gestire la propria squadra, attualmente sono disponibili i seguenti campionati non ancora iniziati:
<?
if (mysql_num_rows($rst) != 0)
		{
		?>
		<FORM name="formCamp" action="<?=$PATHNAME?>/script/doiscrcamp.php">
		<select name="selCamp" onchange="window.document.formCamp.submit();">
				<?
				while($line=mysql_fetch_array($rst))
				{
						echo "<option value='$line[nome_camp]'>".$line[nome_camp]."</option>";
				}
				?>
		</select>
		<input type="Submit" value="Iscriviti">
		</FORM>
		<?
		}
		else
		{
			echo "<br><b>Non è disponibile nessun Campionato a cui potersi iscrivere</b>"; 
		}
	}
?>