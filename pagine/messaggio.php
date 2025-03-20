<?	
	$pathmenu="../";
	$PATHNAME= "..";
	require("$PATHNAME/include/header.php");
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Fantacalcio Messaggio</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<link href="../css/main.css" rel="stylesheet" type="text/css">
</head>
<body> 
<div align="center"> 
  <?require("$PATHNAME/topbottom/top.php");?> 
  <table width="760" border="1" cellpadding="1" cellspacing="2" class="tabellabordosxdx"> 
    <tr> 
      <td width="166" align="center" valign="top" class="cellavuota"> <?require("$PATHNAME/menu/menulogin.php");?> </td> 
      <td align="center" valign="top" class="cellasx"> <br><?=urldecode($msg)?>
      </td>
	  
    </tr> 
  </table> 
  <?require("$PATHNAME/topbottom/bottom.php");?> 
</div> 
</body>
</html>
