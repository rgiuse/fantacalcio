<H2><?=$squadra?></H2>
<form method="post" name="frm" action="../script/editsquadra.php"> 
        <table width="85%" border="0" cellpadding="1" cellspacing="2"> 
		<? 
		for ($i=0;$i<4;$i++){
		$rst3 = nomeTipo($i);
		$line3=mysql_fetch_array($rst3);
		if ($i==0) $max=3;
		if ($i==1) $max=8;
		if ($i==2) $max=8;
		if ($i==3) $max=6;
		?>
        <tr class="tabellabordosxdx"> 
          <td align="center" valign="top" class="cella"><span class="titoloCelleLat"><?=$line3[0]?></span></td> 
        </tr> 
        <tr class="tabellabordosxdx"> 
          <td align="center" valign="top" class="cella">
		  <table width="100%" border="0" cellspacing="0">
            <tr>
              <td width="40%" align="center" valign="middle">
                <select name="listaglobale<?=$i?>" size="10" style="width:180px" onDblClick="MoveToRight('listaglobale<?=$i?>','listascelti<?=$i?>',<?=$max?>);" >
				<?
				$rst = giocatoriTuttiSel_1($i,$campionato); 
				$rst2= giocatoriTuttiSel_2($i,$campionato);
				
				$line2=mysql_fetch_array($rst2);
				while($line=mysql_fetch_array($rst))
				{
					if (!($line2[ID]==$line[ID]))
					{
					
						echo "<option  value=".$line[ID].">".$line[cognome]." ".$line[nome]." (".$line[provenienza].")</option>\n";
					}
					else
						$line2=mysql_fetch_array($rst2);
				}
				?>
                </select>
              </td>
              <td width="20%" align="center">
			  <a href="#" onClick="MoveToLeft('listascelti<?=$i?>','listaglobale<?=$i?>'); return false"><img src="../immagini/frecciasx.gif" border="0" alt="Aggiungi il giocatore alla squadra" width="38" height="25"></a><a href="#" onClick="MoveToRight('listaglobale<?=$i?>','listascelti<?=$i?>',<?=$max?>); return false"><img src="../immagini/frecciadx.gif" border="0" alt="Togli il giocatore dalla squadra" width="38" height="25"></a></td>
              <td width="40%" align="center" valign="middle">
                <select name="listascelti<?=$i?>" size="6" style="width:180px" onDblClick="MoveToLeft('listascelti<?=$i?>','listaglobale<?=$i?>');">
					<? 
					$rst=giocatoriTuttiSel_Sq($i,$squadra,$campionato);
					while($line=mysql_fetch_array($rst))
					{
							echo "<option  value=".$line[ID].">".$line[cognome]." ".$line[nome]." (".$line[provenienza].")</option>\n";
					}
					?>
                </select>
                <input type="hidden" name="passa<?=$i?>">
              </td>
            </tr>
          </table>
		</td>
    </tr>
	<tr> 
    	<td class="cellavuota">&nbsp;</td> 
    </tr> 
	<? 
		}
	?>
            <tr align="center">
              <td colspan="3">
                <input type="submit" name="Submit2" value="Invia" onclick="passa_id();">
                <input type="button" name="Submit" value="Cancella Tutto" onClick="cancella_menu('listascelti');"></td>
            </tr>
          </table>
		</td>
    </tr>
  </table> 
      </form>