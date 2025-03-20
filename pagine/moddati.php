<?
$pathmenu="../";
$PATHNAME= "..";
require("$PATHNAME/include/header.php");
if (authent($site_login, $site_password))
	{
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Fantacalcio Modifica Iscrizone</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<link href="../css/main.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript">
var ns4 = document.layers;
var ns6 = document.getElementById && !document.all;
var ie4 = document.all;
offsetX = 0;
offsetY = 20;
x=0;
y=0;
var toolTipSTYLE="";
function ControllaCampi()
{
var str;
var ck=true;
function isEmailAddr(email)
{
  var result = false;
  var theStr = new String(email);
  var index = theStr.indexOf("@");
  if (index > 0)
  {
    var pindex = theStr.indexOf(".",index);
    if ((pindex > index+1) && (theStr.length > pindex+1))
	result = true;
  }
  return result;
}
str="E' necessario inserire i seguenti campi obbligatori";

if (document.formIscr.Email.value=="") {
str=str+"\n--> E-mail";
ck=false;
}

if (document.formIscr.ColoreSF.value=="") {
str=str+"\n--> Colore Sfondo";
ck=false;
}
if (document.formIscr.ColoreC.value=="") {
str=str+"\n--> Colore caretteri";
ck=false;
}

if (document.formIscr.Pwd.value=="") {
str=str+"\n--> Password";
ck=false;
}

if (document.formIscr.Pwd.value.length<5) {
str=str+"\n\n La password deve essere almeno 5 caratteri";
ck=false;
}
if (!isEmailAddr(document.formIscr.Email.value)){
str=str+"\n\n La mail deve essere valida del tipo bruttocane@fanta.it";
ck=false;
}
if (document.formIscr.Pwd.value!=document.formIscr.PwdCK.value) {
str=str+"\n\nIn oltre i campi password non coincidono: verificale!";
ck=false;
}
str1="\nI seguenti campi contengono caratteri non validi:";
if (!controllaReg(document.formIscr.ColoreSF.value,"^([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})+$")) { 
str1=str1+"\n--> Colore sfondo";
ck1=false;
}
if (!controllaReg(document.formIscr.ColoreC.value,"^([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})+$")) { 
str1=str1+"\n--> Colore caretteri";
ck1=false;
}
if (!controllaReg(document.formIscr.Pwd.value,"^[A-Za-z0-9À-ÖØ-öø-ÿ'?!,@£$=^.\\s]+$")&&document.formIscr.Pwd.value!="") { 
str1=str1+"\n--> Password";
ck1=false;
}
if (!ck1) str=str+str1;
if (!ck||!ck1){
alert(str);
return false;
}
else
return true;
}

function initToolTips(id)
{

  if(ns4||ns6||ie4)
  {
    if(ns4) toolTipSTYLE = document.id;
    else if(ns6) toolTipSTYLE = document.getElementById(id).style;
    else if(ie4) toolTipSTYLE = eval("document.all."+id+".style");
    if(ns4) document.captureEvents(Event.MOUSEMOVE);
    else
    {
      toolTipSTYLE.visibility = "visible";
      toolTipSTYLE.display = "none";
    }

	document.onmousemove = moveToMouseLoc
  }
}
function toolTip(show)
{
	
  toolTipSTYLE.left = x + offsetX;
  toolTipSTYLE.top = y + offsetY;
  if(toolTip.arguments.length < 1) // hide
  {
    if(ns4) toolTipSTYLE.visibility = "hidden";
    else toolTipSTYLE.display = "none";
  }
  else
  {
	
    if(ns4)
    {
      toolTipSTYLE.visibility = "visible";
    }
    if(ns6)
    {
      toolTipSTYLE.display='block'
    }
    if(ie4)
    {
      toolTipSTYLE.display='block'
    }
  }
}
function moveToMouseLoc(e)
{
  if(ns4||ns6)
  {
    x = e.pageX;
    y = e.pageY;
  }
  else
  {
    x = event.x + document.body.scrollLeft;
    y = event.y + document.body.scrollTop;
  }
  
  return true;
}

</SCRIPT>
</head>
<body>
<div align="center">
  <?require("$PATHNAME/topbottom/top.php");?>
  <table width="760" border="1" cellpadding="1" cellspacing="2" class="tabellabordosxdx">
    <tr>
      <td width="166" align="center" valign="top" class="cellavuota"> <?require("$PATHNAME/menu/menuiscrizione.php");?> </td>
      <td align="center" valign="top" class="cellasx">
	  <br>
	  <table width="399" border="0" cellpadding="1" cellspacing="2" class="tabellabianca">
          <form name="formIscr" method="post" action="<?=$PATHNAME?>/script/domoddati.php" onSubmit="return ControllaCampi();">
            <tr class="tabellabordosxdx">
              <td height="28" class="cella"><span class="TitoloTab"> Modifica
                  Dati <span class="SottoTitoloTab">(I
                    campi con * non possono essere vuoti):</span></span></td>
            </tr>
            <tr>
			<? $line=mysql_fetch_array(utenti($site_login));?>
              <td align="center" class="cella"> <TABLE border="0" cellspacing="0">
                  <TR>
                    <TD width="87" class="TestoTabelle">Nome</TD>
                    <TD > <?php echo $nome ?></TD>
                  </TR>
                  <TR>
                    <TD class="TestoTabelle"> Cognome</TD>
                    <TD><?php echo $cognome?></TD>
                  </TR>
                  <TR>
                    <TD class="TestoTabelle"><label for="EmailU">E-mail</label></TD>
                    <TD> <INPUT name=Email size=30 maxlength="30" class="CampiTabelle" value="<?=$line[email]?>" id="EmailU">
                      * </TD>
                  </TR>
                  <TR>
                    <TD class="TestoTabelle">Nome Squadra</TD>
                    <TD><?php echo $squadra?> </TD>
                  </TR>
                  <TR>
                    <TD class="TestoTabelle"><label for="ColoreCU">Col. Caratteri</label></TD>
                    <TD>
                      <input name=ColoreC value="<?=substr($line[colorecarattere],1,strlen($line[colorecarattere]))?>" size=8 maxlength="6" class="CampiTabelle" STYLE="{color:<?=$line[colorecarattere]?>; background-color:<?=$line[coloresfondo]?>;}"><INPUT TYPE="button" onClick="toolTip();initToolTips('toolTipLayer0');toolTip('show');" VALUE="Colore" id="ColoreCU">
					  </TD>
                  </TR>
                  <TR>
                    <TD class="TestoTabelle"><label for="ColoreSFU">Colore sfondo</label></TD> 
                    <TD class="CampiTabelle"><input name="ColoreSF" value="<?=substr($line[coloresfondo],1,strlen($line[coloresfondo]))?>" size=8 maxlength="6" class="CampiTabelle" STYLE="{color:<?=$line[colorecarattere]?>; background-color:<?=$line[coloresfondo]?>;}"><INPUT TYPE="button" onClick="toolTip();initToolTips('toolTipLayer1');toolTip('show');" VALUE="Colore" id="ColoreSFU">
					</TD>
                  </TR>
				  <TR>
                    <TD class="TestoTabelle">Username</TD> 
                    <TD><?php echo $site_login ?></TD>
                  </TR>
                  <TR>
                    <TD class="TestoTabelle"><label for="PasswordU">Password</label></TD>
                    <TD><INPUT name=Pwd type="password" size=30 class="CampiTabelle" value="fintafinta" id="PasswordU"> 
                      * </TD>
                  </TR>
                  <TR >
                    <TD class="TestoTabelle"><label for="PasswordRU">Riscrivi Password</label></TD>
                    <TD><INPUT name=PwdCK type="password" size=30 class="CampiTabelle" value="fintafinta" id="PasswordRU"> 
                      *</TD>
                  </TR>
                  <TR>
                    <TD colSpan=4><div align="center">
                        <input name="Submit" type="submit" id="Submit" value="Invia Dati" > 
                        <input name="Reset" type="reset" id="Reset" value="Cancella tutto">
                        <input type="button" name="Submit2" value="Annulla" onClick="javascript:history.back();">
                    </div></TD>
                  </TR>
              </TABLE>
			  </td>
            </tr>
          </form>
      </table>
	  <div id="toolTipLayer0" style="position:absolute; visibility: hidden">
	  <A HREF="javascript:toolTip();" align="left">Chiudi</A>
		<table border="1" cellspacing="0" cellpadding="0">
		<?
		 $hex = array("00", "33", "66", "99", "CC", "FF");
				for($i=0;$i<6;$i++)
				{
		?>
		  <tr>
				<?
				echo "<td width=\"18\" bgcolor=\"#000000\" onClick=\"document.formIscr.ColoreC.value='000000';toolTip();document.formIscr.ColoreC.style.color='#000000';document.formIscr.ColoreSF.style.color='#000000';\">&nbsp;</td>\n";
				$col = $hex[$i%6].$hex[$i%6].$hex[$i%6];
				echo "<td width=\"18\" bgcolor=\"#$col\" onClick=\"document.formIscr.ColoreC.value='$col';toolTip();document.formIscr.ColoreC.style.color='#$col';document.formIscr.ColoreSF.style.color='#$col';\">&nbsp;</td>\n";
				echo "<td width=\"18\" bgcolor=\"#000000\" onClick=\"document.formIscr.ColoreC.value='000000';toolTip();document.formIscr.ColoreC.style.color='#000000';document.formIscr.ColoreSF.style.color='#000000';\">&nbsp;</td>\n";
				for($k=0;$k<18;$k++)
				{
				$col = $hex[$k/6].$hex[$k%6].$hex[$i%6];
				echo "<td width=\"18\" bgcolor=\"#$col\" onClick=\"document.formIscr.ColoreC.value='$col';toolTip();document.formIscr.ColoreC.style.color='#$col';document.formIscr.ColoreSF.style.color='#$col';\">&nbsp;</td>\n";
				}
				?>
		  </tr>
		<?
		}
				for($i=0;$i<6;$i++)
				{
		?>
		  <tr>
				<?
				echo "<td width=\"18\" bgcolor=\"#000000\" onClick=\"document.formIscr.ColoreC.value='000000';toolTip();document.formIscr.ColoreC.style.color='#000000';document.formIscr.ColoreSF.style.color='#000000';\">&nbsp;</td>\n";
				if ($i==0) $col = $hex[5].$hex[0].$hex[0];
				if ($i==1) $col = $hex[0].$hex[5].$hex[0];
				if ($i==2) $col = $hex[0].$hex[0].$hex[5];
				if ($i==3) $col = $hex[5].$hex[5].$hex[0];
				if ($i==4) $col = $hex[0].$hex[5].$hex[5];
				if ($i==5) $col = $hex[5].$hex[0].$hex[5];
				echo "<td width=\"18\" bgcolor=\"#$col\" onClick=\"document.formIscr.ColoreC.value='$col';toolTip();document.formIscr.ColoreC.style.color='#$col';document.formIscr.ColoreSF.style.color='#$col';\">&nbsp;</td>\n";
				echo "<td width=\"18\" bgcolor=\"#000000\" onClick=\"document.formIscr.ColoreC.value='000000';toolTip();document.formIscr.ColoreC.style.color='#000000';document.formIscr.ColoreSF.style.color='#000000';\">&nbsp;</td>\n";
				for($k=0;$k<18;$k++)
				{
				$col = $hex[$k/6+3].$hex[$k%6].$hex[$i%6];
				echo "<td width=\"18\" bgcolor=\"#$col\" onClick=\"document.formIscr.ColoreC.value='$col';toolTip();document.formIscr.ColoreC.style.color='#$col';document.formIscr.ColoreSF.style.color='#$col';\">&nbsp;</td>\n";
				}
				?>
		  </tr>
		<?
		}
		?>
		</table>
		</div>
		<div id="toolTipLayer1" style="position:absolute; visibility: hidden">
		<A HREF="javascript:toolTip();" align="left">Chiudi</A>
		<table border="1" cellspacing="0" cellpadding="0">
		<?
		 $hex = array("00", "33", "66", "99", "CC", "FF");
				for($i=0;$i<6;$i++)
				{
		?>
		  <tr>
				<?
				echo "<td width=\"18\" bgcolor=\"#000000\" onClick=\"document.formIscr.ColoreSF.value='000000';toolTip();document.formIscr.ColoreC.style.backgroundColor='#000000';document.formIscr.ColoreSF.style.backgroundColor='#000000';\">&nbsp;</td>\n";
				$col = $hex[$i%6].$hex[$i%6].$hex[$i%6];
				echo "<td width=\"18\" bgcolor=\"#$col\" onClick=\"document.formIscr.ColoreSF.value='$col';toolTip();document.formIscr.ColoreC.style.backgroundColor='#$col';document.formIscr.ColoreSF.style.backgroundColor='#$col';\">&nbsp;</td>\n";
				echo "<td width=\"18\" bgcolor=\"#000000\" onClick=\"document.formIscr.ColoreSF.value='000000';toolTip();document.formIscr.ColoreC.style.backgroundColor='#000000';document.formIscr.ColoreSF.style.backgroundColor='#000000';\">&nbsp;</td>\n";
				for($k=0;$k<18;$k++)
				{
				$col = $hex[$k/6].$hex[$k%6].$hex[$i%6];
				echo "<td width=\"18\" bgcolor=\"#$col\" onClick=\"document.formIscr.ColoreSF.value='$col';toolTip();document.formIscr.ColoreC.style.backgroundColor='#$col';document.formIscr.ColoreSF.style.backgroundColor='#$col';\">&nbsp;</td>\n";
				}
				?>
		  </tr>
		<?
		}
				for($i=0;$i<6;$i++)
				{
		?>
		  <tr>
				<?
				echo "<td width=\"18\" bgcolor=\"#000000\" onClick=\"document.formIscr.ColoreSF.value='000000';toolTip();document.formIscr.ColoreC.style.backgroundColor='#000000';document.formIscr.ColoreSF.style.backgroundColor='#000000';\">&nbsp;</td>\n";
				if ($i==0) $col = $hex[5].$hex[0].$hex[0];
				if ($i==1) $col = $hex[0].$hex[5].$hex[0];
				if ($i==2) $col = $hex[0].$hex[0].$hex[5];
				if ($i==3) $col = $hex[5].$hex[5].$hex[0];
				if ($i==4) $col = $hex[0].$hex[5].$hex[5];
				if ($i==5) $col = $hex[5].$hex[0].$hex[5];
				echo "<td width=\"18\" bgcolor=\"#$col\" onClick=\"document.formIscr.ColoreSF.value='$col';toolTip();document.formIscr.ColoreC.style.backgroundColor='#$col';document.formIscr.ColoreSF.style.backgroundColor='#$col';\">&nbsp;</td>\n";
				echo "<td width=\"18\" bgcolor=\"#000000\" onClick=\"document.formIscr.ColoreSF.value='000000';toolTip();document.formIscr.ColoreC.style.backgroundColor='#000000';document.formIscr.ColoreSF.style.backgroundColor='#000000';\">&nbsp;</td>\n";
				for($k=0;$k<18;$k++)
				{
				$col = $hex[$k/6+3].$hex[$k%6].$hex[$i%6];
				echo "<td width=\"18\" bgcolor=\"#$col\" onClick=\"document.formIscr.ColoreSF.value='$col';toolTip();document.formIscr.ColoreC.style.backgroundColor='#$col';document.formIscr.ColoreSF.style.backgroundColor='#$col';\">&nbsp;</td>\n";
				}
				?>
		  </tr>
		<?
		}
		?>
		</table>
		</div>
		<script language="JavaScript">
		<!--
		initToolTips("toolTipLayer0");
		initToolTips("toolTipLayer1");
		//-->
		</script>
      </td>
    </tr> 
  </table> 
  <?require("$PATHNAME/topbottom/bottom.php");?> 
</div> 
</body>
</html>
<?
	}
	else
	header("Location: $PATHNAME/pagine/messaggio.php?msg=E' necessario essere autenticati<BR>per poter accedere a questa sezione! ");
?>

