<?
$PATHNAME = "..";
	require_once("$PATHNAME/include/header.php");
	if (authent($site_login, $site_password))
	{
$rst = giocatoriSel_1($squadra,$campionato); 
$rst2= giocatoriSel_2($giornata,$squadra,$campionato);

?>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function risSelezionate()
		{
		if ( ((document.formRiserve.elements[1].value!=document.formRiserve.elements[2].value)|| document.formRiserve.elements[1].value==-1) &&   ((document.formRiserve.elements[3].value!=document.formRiserve.elements[4].value)|| document.formRiserve.elements[3].value==-1)  && ((document.formRiserve.elements[5].value!=document.formRiserve.elements[6].value)|| document.formRiserve.elements[5].value==-1) ) 
			return true;
		else
			{
			window.alert(" Attenzione stai cercando di inserire due giocatori uguali");
			return false;
			}
		}

//-->
</SCRIPT>
<h3>Inserisci le riserve</h3>
				<FORM METHOD=POST ACTION="<?echo $PATHNAME;?>/script/doaddriserve.php" name="formRiserve">
				<table width="85%" border="1" cellpadding="1" cellspacing="2" class="tabellabianca">
				<tr class="tabellabordosxdx"> 
					<td class="cella"><span class="titoloCelleLat">&nbsp;Nome Giocatore</span></td>
					<td class="cella"><span class="titoloCelleLat">&nbsp;Ruolo</span></td>
				</tr>
				<tr class="tabellabordosxdx"> 
                <td class="cella">
				<select name="risid[]">
				<option value='-1'><strong>----------------------</strong></option>

	<?
	$line2=mysql_fetch_array($rst2);
	$r=0;
	$option="";
	while($line=mysql_fetch_array($rst))
	{
		if (!($line2[ID]==$line[ID]))
		{ 
			
				if ($line[4]>$r) 
					{
						$r++;
						if ($c!=0)
						{
							$c=0;

							?>
										
									</select>
								</td>
								<td class="cella"><em><?=$lastRuolo; ?></em></td>
							</tr>
							
							<tr class="tabellabordosxdx">
								<td class="cella">
								<select name="risid[]">
								<option value='-1'><strong>----------------------</strong></option>
							<?
							if ($r!=1)
							{
								echo $option;
								?>
									
								</select>
									</td>
									<td class="cella"><em><?=$lastRuolo; ?></em></td>
								</tr>
								<tr class="tabellabordosxdx">
									<td class="cella">
									<select name="risid[]">	
									<option value='-1'><strong>----------------------</strong></option>

								<?
							}
								$option="";
						}
							else
						{		$rst3 = nomeTipo($r-1);
								$line3=mysql_fetch_array($rst3);
							?>
										<option value='-1'><strong>----------------------</strong></option>
									</select>
								</td>
								<td class="cella"><em><?=$line3[0]; ?></em></td>
								</tr>
								<tr class="tabellabordosxdx">
									<td class="cella">
									<select name="risid[]">
									<option value='-1'><strong>----------------------</strong></option>
									</select>
								</td>
								<td class="cella"><em><?=$line3[0]; ?></em></td>
								</tr>
								<tr class="tabellabordosxdx">
									<td class="cella">
									<select name="risid[]">
							<?
						}

					}
						$lastRuolo=$line[ruolo];
						
					echo "<option value='$line[ID]'><strong>$line[cognome] $line[nome]</strong></option>";
					$option=$option."<option value='$line[ID]'><strong>$line[cognome] $line[nome]</strong></option>";
					$c++;
		}
		else
			$line2=mysql_fetch_array($rst2);
	}
		?>
			</select>
		</td>
		<td class="cella"><em><?=$lastRuolo; ?></em></td>
	</tr>
	<tr class="tabellabordosxdx">
		<td class="cella">
			<select name="risid[]">	
			<option value='-1'><strong>----------------------</strong></option>
			<?
				echo $option;
			?>
			</select>
		</td>
		<td class="cella"><em><?=$lastRuolo; ?></em></td>
	</tr>
</table>
<INPUT TYPE="submit" value="Inserisci Riserve" onClick="return risSelezionate();">
</FORM>
<?
	}
?>