<?
	$pathmenu="../";
	$PATHNAME= "..";
	require("$PATHNAME/include/header.php");
	if (authent($site_login, $site_password))
{
	if ($campionato=="Nessuno")
	{
		header("Location: $PATHNAME/pagine/selezcamp.php");
		//interrompe il caricamento delle seguenti istruzioni (evita un lungo if)
		return 0;
	}
	$query4="select coloresfondo,colorecarattere from utenti where squadra='$squadra' and userid='$site_login'";
	$rst4=mysql_query($query4,$db);
	$line4=mysql_fetch_array($rst4);
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Fantacalcio Gestione Formazione</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<?
	if($error1 == "1") 
	echo "<script language='javascript'> alert('Non è più possibile modificare la formazione per questa giornata');</script>";
	if($error1 == "2")
	echo "<script language='javascript'> alert('Non è più possibile inserire più di 11 giocatori');</script>";
	if($error1 == "3")
	echo "<script language='javascript'> alert('Non è possibile inserire più di 7 riserve e più di un portiere o più di  2 (difensori, centrocampisti ,attacanti) come riserve!) ');</script>";
?>
<link href="<?=$PATHNAME?>/css/main.css" rel="stylesheet" type="text/css">
</head>
<?
	$c=0;
	$d=0;
	if (isset($_POST["setday"])) $giornata=$_POST["setday"];
	?>
<body> 
<div align="center"> 
<?require("$PATHNAME/topbottom/top.php");?>
  <table width="760" border="1" cellpadding="1" cellspacing="2" class="tabellabordosxdx"> 
    <tr> 
      <td width="166" align="center" valign="top" class="cellavuota"> 
	  <?  
		if (isadmin($site_login))	 
		include("$PATHNAME/menu/menuadmingestione.php");
			else
		include("$PATHNAME/menu/menugestione.php");
			?>

		</td> 
		<td valign="top" class="cellasx">
		<table border="0" cellspacing="4" cellpadding="4"> 
          <tr> 
             <td><h2>Gestione Formazione - <? echo $squadra;?></h2>
			 <?
			$query0 = "select data_inizio,data_fine from campionati where nome_camp='$campionato'";
			$rst0=mysql_query($query0, $db);
			$line0=mysql_fetch_array($rst0);

			$query = "select * from giornate where data BETWEEN '$line0[0]' and '$line0[1]' order by data asc";
			$rst=mysql_query($query, $db);
			if (mysql_num_rows($rst)==0) 
			echo("Mi spiace ma attualmente non esiste nessuna giornata valida, Riprova pi&ugrave; tardi. Grazie");	
				else
			 {
			//----------------------------inizio se ci sono giornate
			$rst0 = giocatoriSel_1($squadra,$campionato); 
			if (mysql_num_rows($rst0)>0)
			 {
			//----------------------------inizio se ce una squadra
			?>
			<form method=post name="fgiornata" action="gestioneteam.php">
			Giornata del <select name="setday" style="font-size: 12; font-family: verdana; height: 21px" onchange="window.document.fgiornata.submit();">
			<?
			$ck=0;
			while($line=mysql_fetch_array($rst))
			{
			if (!isset($setday)&&!isset($giornata)) 
				{
					if (date(ymd,strtotime($line[data]))>=date(ymd))$setday=$giornata=$line[data];
				}
			if (isset($giornata)&& $line[data]==$giornata) 
				echo "<option selected value='$line[data]'>".date("d-m-Y",strtotime($line[data]))."</option>";
			else
				echo "<option value='$line[data]'>".date("d-m-Y",strtotime($line[data]))."</option>";
			}
			$query1 = "select inizio from giornate where data='$giornata' order by data asc";
			$rst1=mysql_query($query1, $db);
			$line1=mysql_fetch_array($rst1);
			echo "</select> in scadenza alle ore ".date("H:i a",strtotime($line1[inizio])-strtotime("3:00:00"));
			?> 
				<noscript>
					<INPUT name="Invia" type="submit" value="Seleziona"> 
				</noscript>
				</form>

				<form name="form2" method="post" action="<?=$PATHNAME;?>/script/doaddplayer.php">Inserisci 
				<select name="id">
            <?
			$rst2= giocatoriSel_2($giornata,$squadra,$campionato);
			$line2=mysql_fetch_array($rst2);
			$r=0;
			while($line=mysql_fetch_array($rst0))
			{
				if (!($line2[ID]==$line[ID]))
				{
					if ($line[4]>$r) 
					{
						$r++;
						echo "<option value='-1'><strong>-------------------</strong></option>";
					}
					echo "<option value='$line[ID]'><strong>$line[cognome] $line[nome]</strong></option>";
				}
				else
					$line2=mysql_fetch_array($rst2);
			}
			?> 
                </select> 
                in
                <select name="ris"> 
                  <option <? if (isset($ris) && $ris!=1) echo " selected";?> value="0" >Titolari</option> 
                  <option <? if (isset($ris) && $ris==1) echo " selected";?> value="1">Riserve</option> 
                </select> 
                <INPUT name="Invia" type="submit" value="Inserisci"> 
              </form> 
				<p>
				<font face="verdana, arial, helvetica, sans-serif">Formazione
                  <b>
				  <?
					$fSq=formazioneSq($squadra,$campionato,$giornata,0);
					if (ckFormazione($squadra,$campionato,$giornata))
					echo substr($fSq, 1,1)."-".substr($fSq, 2,1)."-".substr($fSq, 3,1);
					else 
						echo "non valida";
				  ?>
				  </b>per la <b><? echo $squadra; ?></b> nella giornata del <b><? echo date("d-m-Y",strtotime($giornata));?></b>:</font></p> 
				  <table width="85%" border="0" cellspacing="2" class="cellavuota">
					  <tr>
						<td class="cella"><span class="titoloCelleLat">Cognome</span></td>
						<td class="cella"><span class="titoloCelleLat">Nome</span></td>
						<td class="cella"><span class="titoloCelleLat">Ruolo</span></td>
						<td class="cella"><span class="titoloCelleLat">Rimuovi</span></td>
					  </tr>
                <?
				$rst=giocatoriSq($giornata,$squadra,$campionato,0);
				while($line=mysql_fetch_array($rst))
				{
					$c++
				?>
				<tr class="tabellabordosxdx">
						
						<td width='250' bgcolor='<?=$line4[coloresfondo]?>' class="cella" style="{color:<?=$line4[colorecarattere]?>; font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 14;}">
						<div>
							<B><?=$line[cognome]?></B>
						</div>
						</td>
						<td width='250' bgcolor='<?=$line4[coloresfondo]?>' class="cella" style="{color:<?=$line4[colorecarattere]?>; font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 14;}">
						<?=$line[nome]?>
						</td>
						<td bgcolor='<?=$line4[coloresfondo]?>' class="cella" style="{color:<?=$line4[colorecarattere]?>; font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 11;}">
							<em>
							<?=$line[ruolo]?>
							</em>
						</td>
						<td width='250' bgcolor='<?=$line4[coloresfondo]?>' class="cella" style="{color:<?=$line4[colorecarattere]?>; font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 11;}"><a href="<?=$PATHNAME?>/script/removeplayer.php?id=<?=$line[ID]?>">Elimina</a>
						</td>
					</tr> 
                <?
				}
				?>
              </table> 
              <br>
			 <table width="85%" border="0" cellspacing="2" class="cellavuota">
			  <tr>
				<td class="cella"><span class="titoloCelleLat">Cognome</span></td>
				<td class="cella"><span class="titoloCelleLat">Nome</span></td>
				<td class="cella"><span class="titoloCelleLat">Ruolo</span></td>
				<td class="cella"><span class="titoloCelleLat">Rimuovi</span></td>
			  </tr>
                <?
					$rst=giocatoriSq($giornata,$squadra,$campionato,1);
					while($line=mysql_fetch_array($rst))
					{
					$d++
				?>
				<tr class="tabellabordosxdx">
						
						<td width='250' bgcolor='<?=$line4[coloresfondo]?>' class="cella" style="{color:<?=$line4[colorecarattere]?>; font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 14;}">
						<div>
							<B><?=$line[cognome]?></B>
						</div>
						</td>
						<td width='250' bgcolor='<?=$line4[coloresfondo]?>' class="cella" style="{color:<?=$line4[colorecarattere]?>; font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 14;}">
						<?=$line[nome]?>
						</td>
						<td bgcolor='<?=$line4[coloresfondo]?>' class="cella" style="{color:<?=$line4[colorecarattere]?>; font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 11;}">
							<em>
							<?=$line[ruolo]?>
							</em>
						</td>
						<td width='250' bgcolor='<?=$line4[coloresfondo]?>' class="cella" style="{color:<?=$line4[colorecarattere]?>; font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 11;}"><a href="<?=$PATHNAME?>/script/removeplayer.php?id=<?=$line[ID]?>">Elimina</a>
						</td>
                <?
				}
				?>
              </table> 
              <font face='verdana, arial, helvetica, sans-serif' size=2> <br> 
              <br> 
              Hai schierato <?echo $c?> giocatori<br> 
              Hai schierato <?echo $d?> riserve<br> 
              <br> 
              <a href="<?=$PATHNAME;?>/pagine/showformaz.php">Mostra le altre formazioni</a></font>
			  <?}else
				 {
					//Qui la squadra non e definita!
					echo "Sono spiacente ma la tua squadra non e' stata ancora definita: contatta l'amministratore al piu' presto per farti assegnare una rosa di giocatori.<br><br>Grazie!";
				}
				?>
			  </td> 
          </tr> 
        </table> 
      </td> 
    </tr> 
  </table> 
  <?require("$PATHNAME/topbottom/bottom.php");?> 
</div> 
</body>
<?
		 }
		//------------------fine se esistono giornate
	}
	else
	{
	$msg=urlencode("&Egrave; necessario essere autenticati<BR>per poter accedere a questa sezione!");
	header("Location: $PATHNAME/pagine/messaggio.php?msg=$msg");
	}
	?>
</html>
