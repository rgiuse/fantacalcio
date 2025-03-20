<?
$pathmenu="";
require("include/header.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>Fantacalcio</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="css/main.css" rel="stylesheet" type="text/css">
	</head>
	<body> 
		<div align="center"> 
		  <?require("topbottom/top.php");?>
		  <table width="760" border="1" cellpadding="1" cellspacing="2" class="tabellabordosxdx">
			<tr> 
			  <td width="166" align="center" class="cellavuota">
			  <?
			  if (authent($site_login, $site_password))
			  {
			  if (isadmin($site_login))
				{
				include("menu/menuadmin.php");
				}
				else
				include("menu/menuSTD.php");
			  }
			  else
			  {
			  include("menu/menulogin.php");
			  }

			?>
			  </td>
			  <td align="center" valign="top" class="cellasx">
			  <?
			  if (isadmin($site_login)){
			  include("pagine/subpagine/indexadmin.php");
			  }
			  else
			  {
			  ?>
			 <p>
				<br>
                <strong>BENVENUTO!</strong>
			 </p>
             <p>
				<em>Questo sito è stato prodotto per permettere una agevole
                    gestione delle formazioni di un campionato di fantacalcio
                    casalingo con regole non ufficiali.<br>
                In seguito è stato ampliato per permettere la gestione di più campionati
                  e la visualizzazione di parte dello stesso attraverso device
              wap compatibili.
				</em>
			  </p>
			  <?
			  }
			  ?>
			  </td>
			</tr> 
		  </table>
		 <?require("topbottom/bottom.php");?>&nbsp; 
		</div> 
	</body>
</html>
