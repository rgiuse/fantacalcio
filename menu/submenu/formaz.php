<!-- Chat -->
<tr class="tabellabordosxdx"> 
	<td align="center" class="cella"><span class="titoloCelleLat">Formazione</span></td> 
</tr> 
<tr class="tabellabordosxdx"> 
	<td align="center" valign="top" class="cella">
		<table width="75%" border="0" cellspacing="0" cellpadding="0"> 
		  <tr> 
			<td colspan="2" align="center" valign="top">
			<applet codebase="/fantacalcio/java/" code="formazione.class" width=200 height=254>
				<?
					$fSq=formazioneSq($squadra,$campionato,$giornata,0);
					$fSq2=formazioneSq(avversariaGiornSquadra($squadra,$nome_camp,$giornata),$campionato,$giornata,0);
				?>
				<param name=n_attSq1 value="<?=substr($fSq, 3,1)?>">
				<param name=n_centSq1 value="<?=substr($fSq, 2,1)?>">
				<param name=n_difSq1 value="<?=substr($fSq, 1,1)?>">
				<param name=n_attSq2 value="<?=substr($fSq2, 3,1)?>">
				<param name=n_centSq2 value="<?=substr($fSq2, 2,1)?>">
				<param name=n_difSq2 value="<?=substr($fSq2, 1,1)?>">
				<?
				$cc=0;
				$rst=giocatoriSq($giornata,$squadra,$campionato,0);
				while($line=mysql_fetch_array($rst))
				{
					$cc++
				?>
				<param name=giocSq0<?=$cc?> value="<?=$line[cognome]?>">
                <?
				}
				?>
				<?
				$cc=0;
				$rst=giocatoriSq($giornata,avversariaGiornSquadra($squadra,$nome_camp,$giornata),$campionato,0);
				while($line=mysql_fetch_array($rst))
				{
					$cc++
				?>
				<param name=giocSq1<?=$cc?> value="<?=$line[cognome]?>">
                <?
				}
				?>
			  </applet>
			</td> 
		  </tr> 
		</table> 
	</td> 
</tr> 
