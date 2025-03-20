<tr class="tabellabordosxdx">
	<td align="center" class="cella"><span class="titoloCelleLat">Menu</span></td> 
</tr> 
<tr class="tabellabordosxdx"> 
	<td align="center" class="cella">
		<table width="75%" border="0" cellspacing="0" cellpadding="2" lang="it" title="Menu Navigazione" summary="Questo é il menu necessario per navigare nel sito">
			<tbody>
				<tr> 
				  <td><a href="<?=$pathmenu?>index.php" class="MenuLink">Home</a></td>
				</tr>
				<?
				if (authent($site_login, $site_password))
				{
				?>
				<tr>
				  <td><a href="<?=$pathmenu?>pagine/gestioneteam.php" class="MenuLink">Gestione Formazione</a></td>
				</tr>
				<tr>
				  <td><a href="<?=$pathmenu?>pagine/showformaz.php" class="MenuLink">Mostra Formazioni</a></td>
				</tr>
				<tr>
				  <td><a href="<?=$pathmenu?>pagine/showrose.php" class="MenuLink">Mostra Rose</a></td>
				</tr>
				<tr>
				  <td><a href="<?=$pathmenu?>pagine/mostravoti.php" class="MenuLink">Visualizza Punti Giornata</a></td>
				</tr>
				<tr>
				  <td><a href="<?=$pathmenu?>pagine/showclassifica.php" class="MenuLink">Visualizza Classifica Punti</a></td>
				</tr>
				<tr>
				  <td><a href="<?=$pathmenu?>pagine/showclassificalega.php" class="MenuLink">Visualizza Classifica Lega</a></td>
				</tr>
				<tr>
				  <td><a href="<?=$pathmenu?>pagine/showcalendario.php" class="MenuLink">Visualizza Calendario Lega</a></td>
				</tr>
				<tr>
				  <td><a href="<?=$pathmenu?>phpBB2/index.php" class="MenuLink"><B><I>Forum</I></B></a></td>
				</tr>
				<?
				if (!isadmin($site_login))
				{
				?>
				<tr>
				  <td><a href="<?=$pathmenu?>pagine/showgiornate.php" class="MenuLink">Visualizza Giornate</a></td>
				</tr>
				<?
				}
				}
				?>
				
				<tr>
				  <td><a href="<?=$pathmenu?>pagine/regolamento.php" class="MenuLink">Regolamento</a></td>
				</tr>
				<tr>
				  <td><a href="<?=$pathmenu?>pagine/contatti.php" class="MenuLink">Contatti</a></td> 
				</tr>
			</tbody>
		</table>
	</td> 
</tr>
