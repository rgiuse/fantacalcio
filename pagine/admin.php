<?
	$PATHNAME= "..";
	require("$PATHNAME/include/header.php");
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Fantacalcio</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<?
	if($error1 == "1") echo "<script language='javascript'> alert('non è più possibile modificare la formazione per questa giornata'); </script> ";
	if($error1 == "2") echo "<script language='javascript'> alert('non è più possibile inserire più di 11 giocatori'); </script> ";
?>
<link href="../css/main.css" rel="stylesheet" type="text/css">
</head>
<?
	$c=0;
	$d=0;
	if (authent($site_login, $site_password))
	
	{ 
		$giornata=$setday;
	?>
<body> 
<div align="center"> 
	<?require("$PATHNAME/topbottom/top.php");?>
  <table width="760" border="1" cellpadding="1" cellspacing="2" class="tabellabordosxdx"> 
    <tr> 
      <td width="166" align="center" valign="top" class="cellavuota"> 
	  <?require("$PATHNAME/menu/menuadmin.php");?>

		</td> 
      <td valign="top" class="cellasx"><table border="0" cellspacing="4" cellpadding="4"> 
          <tr> 
            <td><h2>Gestione Formazione - <? echo $squadra?></h2> 
        <?
		$query = "select * from giornate order by data asc";
		$rst=mysql_query($query, $db);
		echo  "<form method=post name='fgiornata' action='gestioneteam.php'>";
		echo  "Giornata del <select name='setday' style='font-size: 12; font-family: verdana; height: 21px' onchange='window.document.forms[1].submit();'>";
		$ck=0;
	 	while($line=mysql_fetch_array($rst))
		{
			if (!isset($setday)) 
			{
				if (date(ymd,strtotime($line[data]))>=date(ymd))$setday=$giornata=$line[data];
				
			}
			if (isset($giornata)&& $line[data]==$giornata) 
				echo "<option selected value='$line[data]'>".date("d-m-y",strtotime($line[data]))."</option>";
			else
				echo "<option value='$line[data]'>".date("d-m-y",strtotime($line[data]))."</option>";
			}
			$query1 = "select inizio from giornate where data='$giornata' order by data asc";
			$rst1=mysql_query($query1, $db);
			$line1=mysql_fetch_array($rst1);
			echo "</select><!-- <input type='submit' value='seleziona giornata'>--> in scadenza alle ore ".date("h:i",strtotime($line1[inizio])-strtotime("3:00:00"))."</form>";
				?> 
              <form name="form2" method="post" action="<?echo $PATHNAME;?>/script/doaddplayer.php">Inserisci 
              <select name="id"> 
            <?
			$rst = giocatoriSel_1($squadra,$campionato); 
			$rst2= giocatoriSel_2($giornata,$squadra,$campionato);
			$line2=mysql_fetch_array($rst2);
			while($line=mysql_fetch_array($rst))
			{
				if (!($line2[ID]==$line[ID]))
				{
					echo "<option value='$line[ID]'><strong>$line[cognome] $line[nome]</strong></option>";
				}
				else
					$line2=mysql_fetch_array($rst2);
			}
			?> 
                </select> 
                in
                <select name="ris"> 
                  <option <? if (isset($ris) && $ris!=1) echo " selected";?> value="0" >ufficiali</option> 
                  <option <? if (isset($ris) && $ris==1) echo " selected";?> value="1">riserve</option> 
                </select> 
                <input type="submit" value="inserisci"> 
              </form> 
              <p><font face="verdana, arial, helvetica, sans-serif">Formazione
                  attuale per <b><? echo $squadra; ?></b> per la giornata del <b><? echo date("d-m-y",strtotime($giornata));?></b>:</font></p> 
              <table width="500" border="1" cellspacing="0" cellpadding="3"> 
                <tr> 
                  <td><b><font face='verdana, arial, helvetica, sans-serif' size=3>Nome Giocatore</font></b></td> 
                  <td><b><font face='verdana, arial, helvetica, sans-serif' size=3>Ruolo</font></b></td> 
                  <td><b><font face='verdana, arial, helvetica, sans-serif' size=3>Rimuovi</font></b></td> 
                </tr>
                <?
				$rst=giocatoriSq($giornata,$campionato,$squadra,0);
				while($line=mysql_fetch_array($rst))
				{
					$c++
				?>
                <tr> 
                  <td class=tabellagiocatori> <? echo $line[cognome]." ".$line[nome]; ?></td> 
                  <td class=tabellagiocatori> <? echo $line[ruolo]; ?></td> 
                  <td class=tabellagiocatori> <a href="<?echo $PATHNAME;?>/script/removeplayer.php?id=<?echo $line[ID]; ?>">elimina</a></td> 
                </tr> 
                <?
					}
				?> 
              </table> 
              <br> 
              <table width="500" border="1" cellspacing="0" cellpadding="3"> 
                <tr> 
                  <td><b><font face='verdana, arial, helvetica, sans-serif' size=3>Nome
                        Giocatore</font></b></td> 
                  <td><b><font face='verdana, arial, helvetica, sans-serif' size=3>Ruolo</font></b></td> 
                  <td><b><font face='verdana, arial, helvetica, sans-serif' size=3>Rimuovi</font></b></td> 
                </tr> 
                <?
					$rst=giocatorisq($giornata,$campionato,$squadra,1);
					while($line=mysql_fetch_array($rst))
					{
					$d++
				?> 
                <tr> 
                  <td class=tabellagiocatori> <? echo $line[cognome]." ".$line[nome] ?></td> 
                  <td class=tabellagiocatori> <? echo $line[ruolo] ?></td> 
                  <td class=tabellagiocatori> <a href="<?echo $PATHNAME; ?>/script/removeplayer.php?id=<?echo $line[ID]; ?>">elimina</a> </td> 
                </tr> 
                <?
				}
				?> 
              </table> 
              <font face='verdana, arial, helvetica, sans-serif' size=2> <br> 
              <br> 
              Hai schierato <?echo $c?> giocatori<br> 
              Hai schierato <?echo $d?> riserve<br> 
              <br> 
              <a href="<?echo $PATHNAME;?>/pagine/showformaz.php">mostra le altre formazioni</a></font></td> 
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
	else echo "Non autorizzato";
	?>
</html>