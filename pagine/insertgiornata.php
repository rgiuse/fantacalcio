<?
	$PATHNAME = "..";
	require("$PATHNAME/include/header.php");
?> <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"> <html> 
<head> 
<title>Inserimento giornate</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
</head>

<? if (isadmin($site_login) && authent($site_login, $site_password)) 
	{ ?>
<form name="form1" method="post" action="<?=$PATHNAME?>/script/doinsertgiornata.php">
  <table width="323" height="126" border="1" cellspacing="0" bordercolor="#CCCCCC">
    <tr> 
      <td colspan="2"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Inserisci 
        giornata</strong> </font></td>
    </tr>
    <tr> 
      <td width="142"><font size="2" face="Arial, Helvetica, sans-serif">Data: </font></td>
      <td width="171"> <font size="2" face="Arial, Helvetica, sans-serif"> 
	  <select name="day">
	<? 	$g=0;
		while($g<31)
		{
			$g++;
			echo "<option value='$g'>$g</option>";
		}
	?>   
    </select>
	<select name="month">
	<? 	$g=0;
		while($g<12)
		{
			$g++;
			echo "<option value='$g'>$g</option>";
		}
	?> 
	</select>
	<select name="year">
	<? 	$g=2003;
		while($g<2020)
		{
			$g++;
			echo "<option value='$g'>$g</option>";
		}
	?>   
    </select>
        </font></td>
    </tr>
    <tr> 
      <td><font size="2" face="Arial, Helvetica, sans-serif">Ora Inizio:</font></td>
      <td><font size="2" face="Arial, Helvetica, sans-serif"> 
        <input name="orapart1" type="text" value="00" size="4" maxlength="4">
        <font size="5">:</font> 
        <input name="orapart2" type="text" value="00" size="4" maxlength="2">
        </font></td>
    </tr>
    <tr align="right"> 
      <td colspan="2"> 
        <input type="submit" name="Submit" value="Invia">
      </td>
    </tr>
  </table>
  <p align="center">&nbsp; </p>
  </form>

<? } else echo "Non autorizzato"; ?> 
</html>