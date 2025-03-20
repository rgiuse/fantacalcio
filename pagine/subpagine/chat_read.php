<p class='piccolo'>
<?
	 $passo=15;

	if($all!=1)
		echo "<a href='chat_read.php?all=1&npag=1'>Mostra tutti i messaggi</a>";
	else
		echo "<a href='chat_read.php?npag=1'>Mostra solo i messaggi da leggere</a>"
?>
</p>
<p class='piccolo'>
<? 
if ($all==1)
{
	$query2="SELECT count(*) FROM chatboard WHERE id_dest='$site_login'";
	$rst2=mysql_query($query2, $db);
	$line2=mysql_fetch_array($rst2);
	$totpagine=$line2[0];
	
	if ($npag>=2) echo "<A HREF='?all=$all&npag=".($npag-1)."'>&lt;</A>";
	for($i=1;$i<=($totpagine/$passo)+1;$i++)
	{
	?>
		<A HREF="?all=<?=$all?>&npag=<?=$i?>"><?=$i?></A>
	<?
	}
	if ($npag<$totpagine/$passo) echo "<A HREF='?all=$all&npag=".($npag+1)."'>&gt;</A>";
}
?>
</p>
  <table width="95%" border="1" cellpadding="1" cellspacing="2" class="tabellabianca">
	<tr class="tabellabordosxdx"> 
		<td  width="20%" align="center" class="cella">
			<span class="titoloCelleLat">Mittente</span>
		</td> 
		<td align="center" class="cella">
			<span class="titoloCelleLat">Messaggio</span>
		</td>
	</tr>
					
  <?
  $n_inizio=$npag*$passo-$passo;

  if ($all!=1)
 	$query0="SELECT msg, letto, id_utente, time FROM chatboard WHERE id_dest='$site_login' AND letto=0 order by time desc LIMIT $n_inizio,$passo";
  else
  	$query0="SELECT msg, letto, id_utente, time FROM chatboard WHERE id_dest='$site_login' order by time desc LIMIT $n_inizio,$passo";
  $rst0=mysql_query($query0, $db);
  //$totpagine=mysql_num_rows($rst0);
  while($line0=mysql_fetch_array($rst0))
  {
		$message=$line0[msg];
		$message = eregi_replace(":sad:", "<img src=../immagini/sad.gif alt=':sad:'>", $message);
		$message = eregi_replace(":\(", "<img src=../immagini/sad.gif alt=':('>", $message);
		$message = eregi_replace(":-\(", "<img src=../immagini/sad.gif alt=':-('>", $message);
		$message = eregi_replace("=\(", "<img src=../immagini/sad.gif alt='=('>", $message);

		$message = eregi_replace(":happy:", "<img src=../immagini/happy.gif alt=':happy:'>", $message);
		$message = eregi_replace(":-\)", "<img src=../immagini/happy.gif alt=':-)'>", $message);
		$message = eregi_replace(":\)", "<img src=../immagini/happy.gif alt=':)'>", $message);

		$message = eregi_replace(":grin:", "<img src=../immagini/grin.gif alt=':grin:'>", $message);
		$message = eregi_replace(":D", "<img src=../immagini/grin.gif alt=':D'>", $message);
		$message = eregi_replace(":-D", "<img src=../immagini/grin.gif alt=':-D'>", $message);

		$message = eregi_replace(":wink:", "<img src=../immagini/wink.gif alt=':wink:'>", $message);
		$message = eregi_replace(";-\)", "<img src=../immagini/wink.gif alt=';-)'>", $message);
		$message = eregi_replace(";\)", "<img src=../immagini/wink.gif alt=';)'>", $message);

		$message = eregi_replace(":lol:", "<img src=../immagini/lol.gif alt=':lol:'>", $message);
		$message = eregi_replace(":mad:", "<img src=../immagini/mad.gif alt=':mad:'>", $message);
		$message = eregi_replace(">:-\)", "<img src=../immagini/mad.gif alt='>:-)'>", $message);
		$message = eregi_replace(">:-\]", "<img src=../immagini/mad.gif alt='>:-]'>", $message);
		 
		
		$message = eregi_replace("\?\?\?", "<img src=../immagini/smile_question.gif alt='???'>", $message);	
	
		$message = eregi_replace(":tongue:", "<img src=../immagini/tongue.gif alt=':tongue:'>", $message);
		$message = eregi_replace(":P", "<img src=../immagini/tongue.gif alt=':P'>", $message);
		$message = eregi_replace(":-P", "<img src=../immagini/tongue.gif alt=':-P'>", $message);

		$message = eregi_replace(":laugh:", "<img src=../immagini/laugh.gif alt=':laugh:'>", $message);

		$message = eregi_replace(":surprise:", "<img src=../immagini/surprise.gif alt=':surprise:'>", $message);
		$message = eregi_replace(":-o", "<img src=../immagini/surprise.gif alt=':-o'>", $message);
		
		$message = eregi_replace(":scared:", "<img src=../immagini/scared.gif alt=':scared:'>", $message);
		$message = eregi_replace(":embarassed:", "<img src=../immagini/embarassed.gif alt=':embarassed:'>", $message);	


		$query1 = "SELECT email FROM utenti WHERE userid = '$line0[id_utente]'";
		$rst1 = mysql_query($query1, $db);
		$line1=mysql_fetch_array($rst1)

?>
	<tr class="tabellabordosxdx"> 
		<td align="left" class="cella" bgcolor="EEEEEE" style="{ font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 14; vertical-align: top; <?if($line0[letto]==0 && $all==1) echo "font-weight: bold;"?>}">
			<?
				echo "Mittente: <I>".$line0[id_utente]."</I>";
				echo "<p class='piccolo'>".date("d/m/Y - H:i:s", strtotime($line0[time]))."</p>" ;
				//echo "<p class='piccolo'><A HREF='help.php' target='popup'>smile <img src='../immagini/happy.gif' border='none'></A></p>"; 
				if ($line1[email])
				{
					echo "<br><a href='mailto:".$line1[email]."'><img src='../immagini/smail.gif' border='none'></a>";
				}
			?>
		</td> 
		<td align="left" class="cella" style="{ font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 12; vertical-align: top; <?if($line0[letto]==0 && $all==1) echo "font-weight: bold;"?>}">
			<?
				echo $message."&nbsp"; 
			?>
		</td>
	</tr>
<?
  
  }
	if ($all!=1)
	{
		$query0="UPDATE chatboard SET letto=1 WHERE id_dest='$site_login'";
		mysql_query($query0, $db);
	}
  
  ?>
  
</table>
<p class='piccolo'>
<? 
if ($all==1)
{
	$query2="SELECT count(*) FROM chatboard WHERE id_dest='$site_login'";
	if ($npag>=2) echo "<A HREF='?all=$all&npag=".($npag-1)."'>&lt;</A>";
	for($n=1;$n<=($totpagine/$passo)+1;$n++)
	{
	?>
		<A HREF="?all=<?=$all?>&npag=<?=$n?>"><?=$n?></A>
	<?
	}
	if ($npag<$totpagine/$passo) echo "<A HREF='?all=$all&npag=".($npag+1)."'>&gt;</A>";
}
?>
</p>