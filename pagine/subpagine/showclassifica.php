<?
        $PATHNAME = "..";
        require_once("$PATHNAME/include/header.php");
        if (authent($site_login, $site_password))
        {

                if (isset($_POST["setday"])) $giornata=$_POST["setday"];
                ?>
                        <table width="95%" border="1" cellpadding="1" cellspacing="2" class="tabellabianca">
                                        <tr class="tabellabordosxdx">
                                                <td align="center" class="cella"><span class="titoloCelleLat">Qualifica Campionato</span></td>
                                        </tr>
                                        <tr class="tabellabordosxdx">
                                                <td align="center" valign="top" class="cella">
                                                <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                                         <tr class="tabellabordosxdx" >
							 									<td align="center" class="cella" colspan="2">
                                                                        <span class="titoloCelleLat">Squadra</span>
                                                                </td>
                                                                <td align="center" class="cella">
                                                                        <span class="titoloCelleLat">Punti</span>
                                                                </td>
                                                        </tr>
                        <?
                        $query1= "select DISTINCT(squadra) from utenti where isadmin=0 and campionato='$campionato' order by squadra";
                        $rst1=mysql_query($query1,$db);
                        while($line1=mysql_fetch_array($rst1))
                        {
                                $query4="select coloresfondo,colorecarattere from utenti where squadra='$line1[squadra]'and campionato='$campionato' and isadmin=0";
                                $rst4=mysql_query($query4,$db);
                                $line4=mysql_fetch_array($rst4);
                                $results[$line1[squadra]]=votoSquadra($line1[squadra],$campionato);
								$colorisfondo[$line1[squadra]]=$line4[coloresfondo];
								$coloricarattere[$line1[squadra]]=$line4[colorecarattere];
                        }
			arsort($results);
			$n=0;
			while (list($key, $val) = each($results)) {
				$n+=1
			 ?>
			 	<tr class="tabellabordosxdx">
					<td bgcolor="EEEEEE" class="cella" style="color: rgb(0, 0, 0); font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 11px;">
						<div align='right'>
							<b><?=$n?>.</b>
						</div>
					</td>
					<td align="center" class="cella" class="cella" bgcolor='<?=$colorisfondo[$key]?>'  style="{color:<?=$coloricarattere[$key]?>; font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 14;}"><?=$key?></td>
					<td width= "80" align="center" class="cella" bgcolor='<?=$colorisfondo[$key]?>'  class="cella" style="{color:<?=$coloricarattere[$key]?>; font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 12; font-weight: bold;}"><?=$val;?></td>
				</tr>
			<?
			}
                        ?>
                                </TABLE>
                                </td>
                                </tr>
                                </TABLE>

                        <?
                        if ( mysql_num_rows($rst)==0)
                        {
                        ?>
                        Mi spiace questa formazione non è attualmente disponibile.
                        <?
                        }
                        ?>
                        </td>
                        </tr>
                        </TABLE>

                        <?
                        }//----------------------------fine se ci sono giornate
?>
