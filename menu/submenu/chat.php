<!-- Chat -->
<tr class="tabellabordosxdx"> 
	<td align="center" class="cella"><span class="titoloCelleLat">Messaggi</span></td> 
</tr> 
<tr class="tabellabordosxdx"> 
	<td align="center" valign="top" class="cella">
		<table width="75%" border="0" cellspacing="0" cellpadding="0"> 
		  <tr> 
			<td colspan="2" align="center" valign="top">
				<p class="MenuMessaggi">
				 Hai<b> 
				 <?
					$query0 = "SELECT count(id_utente) as num FROM chatboard WHERE id_dest='$site_login' AND letto=0";
					$rst0=mysql_query($query0,$db);
					$line0=mysql_fetch_array($rst0);
					echo $line0[num];
				 ?></b>
				 messaggi non letti. Clicca <a href='<?=$pathmenu?>pagine/chat_read.php?npag=1'>qui</a> per leggerli
					<form name="form1" method="post" action="<?=$pathmenu?>script/chat_send.php">
				 		<p>
				      			<textarea name="messaggio" cols="18" rows="4"></textarea>
				        	</p>
					  	<p> 
					      		<select name="dest">
							<option selected value="-all-">Tutti i manager</option>
		
					        <?
						     $query1= "select userid, nome, cognome from utenti where isadmin=0 and campionato='$campionato' order by cognome ";
						     $rst1=mysql_query($query1,$db);
						     while($line1=mysql_fetch_array($rst1))
						     {
						     if ($line1[userid]==$site_login) echo "";//<option selected>".$line1[squadra]."</option>";
						       else
						      echo "<option value='$line1[userid]'>".$line1[nome]." ".$line1[cognome]."</option>";
						     }
						 ?>
						        </select>
						</p>
						<input type="submit" name="Submit" value="invia">
					</form>
				</p>
			</td> 
		  </tr> 
		</table> 
	</td> 
</tr> 
