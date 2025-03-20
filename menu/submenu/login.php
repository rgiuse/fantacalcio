<tr class="tabellabordosxdx"> 
	<td align="center" valign="top" class="cella"><span class="titoloCelleLat">Login</span></td> 
</tr> 
<tr class="tabellabordosxdx">
	<td align="center" valign="top" class="cella"> 
<!-- <form name="form1" method="post" action="<?=$pathmenu?>script/login.php"> -->
		<form name="form1" method="post" action="<?=$pathmenu?>phpBB2/login.php">
			<table width="75%" border="0" cellspacing="0" cellpadding="0"> 
				<tr> 
					<td colspan="2"><span class="MenuLogin">Nome utente:</span></td> 
				</tr> 
				<tr> 
					<td colspan="2"><input name="username" type="text" size="20"></td> 
				</tr> 
				<tr> 
					<td colspan="2"><span class="MenuLogin">Password: </span></td> 
				</tr> 
				<tr> 
					<td colspan="2"><input name="password" type="password" size="20"></td> 
				</tr> 
			</table> 
			<input type="submit" name="Submit" value="Login">
			<br>
			<HR width="80%" size="2">
			<span class="piccolo">Se non sei ancora iscritto clicca <a href="<?=$pathmenu?>pagine/iscrizione.php">qui</a>! </span>
		</form>
	</td>
</tr>
