<?
	$PATHNAME = "..";
	require_once("$PATHNAME/include/header.php");
	$query = "select * from giornate order by data asc";
	$rst=mysql_query($query, $db);
	if (mysql_num_rows($rst)==0) 
		echo("Mi spiace ma attualmente non esiste nessuna giornata valida");	
	else
	{
		//----------------------------inizio se ci sono
		?>
		<h2>Inserimento Voti</h2>
		<br>
		<form action='../script/doinseriscivoti.php' method='post'>
		Giornata : 
			<select name="num" style="font-size: 16; font-family: verdana; height: 24px">
				<?
				
				$ck=0;
				while($line=mysql_fetch_array($rst))
				{
					if (!isset($setday)) 
					{
						if (date(ymd,strtotime($line[data]))>=date(ymd))$setday=$giornata=$line[data];
						
					}
					if (isset($giornata)&& $line[data]==$giornata) 
						echo "<option selected value='$line[ID]'>".date("d-m-Y",strtotime($line[data]))."</option>";
					else
						echo "<option value='$line[ID]'>".date("d-m-Y",strtotime($line[data]))."</option>";
				}
				?>
				</select>
			<br>File Voti : <select name='file'>
			 <?

	if ($handle = opendir('../update/')) {
    while (false !== ($file = readdir($handle))) { 
        if ($file != "." && $file != "..") { 
            echo "<option value='$file'>$file</option>\n"; 
        } 
    }
	echo "</select><BR><INPUT TYPE='submit'>\n</form>";
    closedir($handle); 
    }
	// ---fine
}
?>