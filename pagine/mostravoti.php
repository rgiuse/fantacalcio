<?
	$pag="mostravoti";

	
	$pathmenu="../";
	$PATHNAME= "..";
	require_once("$PATHNAME/include/header.php");
	if (authent($site_login, $site_password))
	{ 
	$rst=pagina($pag);
	$line=mysql_fetch_array($rst);
	$menu=$line["menu"];
	$pagina=$line["pagina"];
	if ($campionato=="Nessuno")
	{
		header("Location: $PATHNAME/pagine/selezcamp.php");
		//interrompe il caricamento delle seguenti istruzioni (evita un lungo if)
		return 0;
	}
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Fantacalcio Punteggio Giornata</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<link href="../css/main.css" rel="stylesheet" type="text/css">
<script language="JavaScript1.2" src="../include/script.js" type="text/javascript"></script>
</head>
<body> 
<div align="center"> 
  <?require("$PATHNAME/topbottom/top.php");?> 
  <table width="760" border="1" cellpadding="1" cellspacing="2" class="tabellabordosxdx"> 
    <tr> 
      <td width="166" align="center" valign="top" class="cellavuota"><?include("$PATHNAME/menu/$menu");?> </td>
      <td align="center" valign="top" class="cellasx"><?include("subpagine/$pagina");?></td> 
  </tr> 
  </table> 
  <?require("$PATHNAME/topbottom/bottom.php");?> 
</div> 
</body>
</html>
<?
	}
	else
	{
		$msg=urlencode("&Egrave; necessario essere autenticati<BR>per poter accedere a questa sezione!");
		header("Location: $PATHNAME/pagine/messaggio.php?msg=$msg");
	}
?>
