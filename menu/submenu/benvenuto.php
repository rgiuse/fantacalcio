<?
if (authent($site_login, $site_password))
{
	?>
<!-- Benvenuto -->
<tr class="tabellabordosxdx"> 
	<td align="center" class="cella"><span class="titoloCelleLat">BENVENUTO</span></td> 
</tr> 
<tr class="tabellabordosxdx"> 
	<td align="center" valign="top" class="cella"> 
		
			<table width="75%" border="0" cellspacing="0" cellpadding="0"> 
			<tr> 
				<td height="27" colspan="2" align="center" valign="bottom">
					<span class="MenuLogin"><?echo "$nome $cognome"?></span>
				</td> 
			</tr> 
			<tr> 
				<td height="41" colspan="2" align="center" valign="bottom">
					<p class="MenuMessaggi">Manager<br> della: </p>
				</td> 
			</tr> 
			<tr> 
				<td colspan="2" align="center" class="BenvenutoBold">
				<?
				if (isadmin($site_login) && authent($site_login, $site_password))
				{
				?>
				<form action="<?=$pathmenu?>pagine/admmanageteam.php" method="post" name="squadraa">
					<select name="admsquadra" onChange="window.document.squadraa.submit();">
					<?
						$query1= "select squadra from utenti where isadmin=0 and campionato='$campionato' order by userid ";
						$rst1=mysql_query($query1,$db);
						while($line1=mysql_fetch_array($rst1))
						{
							if ($line1[squadra]==$squadra) echo "<option selected>".$line1[squadra]."</option>";
							else
							echo "<option>".$line1[squadra]."</option>";
						}
						?>
					</select>
				  	<select name="admcampionato" onChange="window.document.squadraa.submit();">
					<?
						$query2= "select distinct(campionato) from utenti where isadmin=0 and campionato is not null order by campionato";
						$rst2=mysql_query($query2,$db);
						while($line2=mysql_fetch_array($rst2))
						{
							if ($line2[campionato]==$campionato)
								echo "<option selected>".$line2[campionato]."</option>";
							else
							echo "<option>".$line2[campionato]."</option>";
						}
						?>
				  </select>
				</form>
				<?} 
					else
					echo $squadra
							?>
				<form name="form1" method="post" action="<?=$pathmenu?>script/login.php?logout=1">
				</td> 
			  </tr> 
			</table> 
			<input type="submit" name="Submit" value="Logout">
			
		    <HR width="80%" size="2">
	      <span class="MenuLink">Clicca <a href="<?=$pathmenu?>pagine/moddati.php">qui</a> per
	       modificare i tuoi dati</span>        
	</td> 
</tr> 
</form>
<?
}
else
{
?>
<!-- Login -->
<tr class="tabellabordosxdx"> 
	<td align="center" valign="top" class="cella"><span class="titoloCelleLat">Login</span></td> 
</tr> 
<tr class="tabellabordosxdx">
	<td align="center" valign="top" class="cella"> 
<!--		<form name="form1" method="post" action="<?=$pathmenu?>script/login.php">-->
		<form  method="post" action="<?=$pathmenu?>phpBB2/login.php">
			<table width="75%" border="0" cellspacing="0" cellpadding="0"> 
				<tr> 
					<td colspan="2"><span class="MenuLogin">Nome utente:</span></td> 
				</tr> 
				<tr> 
					<td colspan="2"><input name="username" type="text" size="20"></td> 
				</tr> 
				<tr> 
			<td colspan="2"><span class="MenuLogin">Password: </span><input name="redirect" value="../script/login.php" type="hidden"></td> 
				</tr> 
				<tr> 
					<td colspan="2"><input name="password" type="password" size="20"></td> 
				</tr> 
			</table> 
			<input type="submit" name="login" value="Login">
			<br>
			<HR width="80%" size="2">
			<span class="piccolo">Se non sei ancora iscritto clicca <a href="<?=$pathmenu?>pagine/iscrizione.php">qui</a>! </span>
		</form>
	</td>
</tr>
<?
}
?>
