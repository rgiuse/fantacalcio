<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html dir="{S_CONTENT_DIRECTION}">
<head>
<meta http-equiv="Content-Type" content="text/html; charset={S_CONTENT_ENCODING}">
<meta http-equiv="Content-Style-Type" content="text/css">
{META}
{NAV_LINKS}
<title>{SITENAME} :: {PAGE_TITLE}</title>
<!-- link rel="stylesheet" href="templates/subSilver/{T_HEAD_STYLESHEET}" type="text/css" -->
<style type="text/css">
<!--

/* This is the border line & background colour round the entire page */
.bodyline	{ background-color: #FFFFFF; border: 1px #0066CC solid; border-width: 1px 1px 0px 1px; }

.forumline	{ background-color: #FFFFFF; border: 1px #0066CC solid; }


/* Header cells - the blue and silver gradient backgrounds */
th	{
	color: #FFFFFF; font-size: 11px; font-weight : bold;
	background-color: #0099CC; height: 25px;
}
td.cat,td.catHead,td.catSides,td.catLeft,td.catRight,td.catBottom {
			background-color:#66CC99; height: 28px;
}

/* Main table cell colours and backgrounds */
td.row1	{ background-color: {T_TR_COLOR1}; }
td.row2	{ background-color: {T_TR_COLOR2}; }
td.row3	{ background-color: {T_TR_COLOR3}; }

/*
  Setting additional nice inner borders for the main table cells.
  The names indicate which sides the border will be on.
  Don't worry if you don't understand this, just ignore it :-)
*/
th.thHead,th.thSides,th.thTop,th.thLeft,th.thRight,th.thBottom,th.thCornerL,th.thCornerR {
	font-weight: bold; height: 28px; 
	border: 1px solid #0066CC;
	}
td.row3Right,td.spaceRow {
	background-color: #D1D7DC; 
	/*border: 1px solid #0066CC;*/
	}

td.rowpic {
		background-color: #66CC99;
		background-image: url(templates/fantaClub/images/{T_TH_CLASS3});
		background-repeat: repeat-y;
}

th.thHead,td.catHead { font-size: 12px; border-width: 1px 1px 1px 1px; }
th.thSides,td.catSides,td.spaceRow	 { border-width: 1px 1px 1px 1px; }
th.thRight,td.catRight,td.row3Right	 { border-width: 1px 1px 1px 1px; }
th.thLeft,td.catLeft	  { border-width: 1px 1px 1px 1px; }
th.thBottom,td.catBottom  { border-width: 1px 1px 1px 1px; }
th.thTop	 { border-width: 1px 1px 1px 1px; }
th.thCornerL { border-width: 1px 1px 1px 1px; }
th.thCornerR { border-width: 1px 1px 1px 1px; }

/* The largest text used in the index page title and toptic title etc. */
.maintitle,h2	{
			font-weight: bold; font-size: 22px; font-family: Verdana, Arial, Helvetica, sans-serif;
			text-decoration: none; line-height : 120%; color : #000000;
}

/* General text */
.gen { font-size : 12px; }
.genmed { font-size : 11px; }
.gensmall { font-size : 10px; }
.gen,.genmed,.gensmall { color : #000000; }
a.gen,a.genmed,a.gensmall { color: #000000; text-decoration: none; }
a.gen:hover,a.genmed:hover,a.gensmall:hover	{ color: #DD6900; text-decoration: underline; }


/* The register, login, search etc links at the top of the page */
.mainmenu		{ font-size : 11px; color : #000000 }
a.mainmenu		{ text-decoration: none; color : #006699;  }
a.mainmenu:hover{ text-decoration: underline; color : #DD6900; }


/* Forum category titles */
.cattitle		{ font-size: 12px ; letter-spacing: 1px; color : #FFFFFF}
a.cattitle		{ text-decoration: none; color : #FFFFFF; }
a.cattitle:hover{ text-decoration: underline; }


/* Forum title: Text and link to the forums used in: index.php */
.forumlink		{ font-weight: bold; font-size: 12px; color : #006699; }
a.forumlink 	{ text-decoration: none; color : #006699; }
a.forumlink:hover{ text-decoration: underline; color : #DD6900; }


/* Used for the navigation text, (Page 1,2,3 etc) and the navigation bar when in a forum */
.nav			{ font-weight: bold; font-size: 11px; color : #000000;}
a.nav			{ text-decoration: none; color : #006699; }
a.nav:hover		{ text-decoration: underline; }


/* titles for the topics: could specify viewed link colour too */
.topictitle			{ font-weight: bold; font-size: 11px; color : #000000; }
a.topictitle:link   { text-decoration: none; color : #006699; }
a.topictitle:visited { text-decoration: none; color : #5493B4; }
a.topictitle:hover	{ text-decoration: underline; color : #DD6900; }


/* Name of poster in viewmsg.php and viewtopic.php and other places */
.name			{ font-size : 11px; color : #000000;}

/* Location, number of posts, post date etc */
.postdetails		{ font-size : 10px; color : #000000; }


/* The content of the posts (body of text) */
.postbody { font-size : 12px;}
a.postlink:link	{ text-decoration: none; color : #006699 }
a.postlink:visited { text-decoration: none; color : #5493B4; }
a.postlink:hover { text-decoration: underline; color : #DD6900}

/* Quote & Code blocks */
.code {
	font-family: Courier, 'Courier New', sans-serif; font-size: 11px; color: #006600;
	background-color: #FAFAFA; border: #D1D7DC; border-style: solid;
	border-left-width: 1px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px
}

.quote {
	font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #444444; line-height: 125%;
	background-color: #FAFAFA; border: #D1D7DC; border-style: solid;
	border-left-width: 1px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px
}


/* Copyright and bottom info */
.copyright		{ font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; color: #444444; letter-spacing: -1px;}
a.copyright		{ color: #444444; text-decoration: none;}
a.copyright:hover { color: #000000; text-decoration: underline;}


/* Form elements */
input,textarea, select {
	color : #000000;
	font: normal 11px Verdana, Arial, Helvetica, sans-serif;
	border-color : #000000;
}

/* The text input fields background colour */
input.post, textarea.post, select {
	background-color : #FFFFFF;
}

input { text-indent : 2px; }

/* The buttons used for bbCode styling in message post */
input.button {
	background-color : #EFEFEF;
	color : #000000;
	font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;
}

/* The main submit button option */
input.mainoption {
	background-color : #FAFAFA;
	font-weight : bold;
}

/* None-bold submit button */
input.liteoption {
	background-color : #FAFAFA;
	font-weight : normal;
}

.foother {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	line-height: 14px;
	color: #FFFFFF;
	border: 1px solid #FFFFFF;
}

.cella_titolo {
	font-family: "Courier New", Courier, mono;
	color: #FFFFFF;
	text-align: center;
	border: 1px solid #0066CC;
	background-color: #0099CC;
}

.titolo {
	font-family: "Courier New", Courier, mono;
	color: #FFFFFF;
	text-decoration: none;
}

.cella {
	border: 1px solid #0066CC;
}

.tabellabianca {
	border: none #FFFFFF;
}


/* This is the line in the posting page which shows the rollover
  help line. This is actually a text box, but if set to be the same
  colour as the background no one will know ;)
*/
.helpline { background-color: {T_TR_COLOR2}; border-style: none; }

/* Import the fancy styles for IE only (NS4.x doesn't use the @import function) */
@import url("templates/subSilver/formIE.css"); 
-->
</style>
<!-- BEGIN switch_enable_pm_popup --> 
<script language="Javascript" type="text/javascript"> 
<!-- 
   if ( {PRIVATE_MESSAGE_NEW_FLAG} ) 
document.write('<div id="TopLeftPM" style="position:absolute; top:0; left:0; width:180; height:30; background-color:646464"><font color=ffffff>You have a new <a class="mainmenu" href=/forum/privmsg.php?folder=inbox/><B>Private Message</B></a></font></div>') 

//--> 
</script> 

<!-- END switch_enable_pm_popup --> 
</head>
<body bgcolor="{T_BODY_BGCOLOR}" text="{T_BODY_TEXT}" link="{T_BODY_LINK}" vlink="{T_BODY_VLINK}">

<a name="top"></a>

<table width="770" border="1" cellpadding="1" cellspacing="4" class="tabellabianca" align="center"> 
    <tr> 
      <td height="19" colspan="2" bgcolor="#66CC99" class="cella">&nbsp;</td> 
      <td width="19" rowspan="2" bgcolor="#99FFCC" class="cella">&nbsp;</td> 
    </tr> 
    <tr> 
      <td width="19" rowspan="2" bgcolor="#99FFCC" class="cella">&nbsp;</td> 
      <td height="60" class="cella_titolo">
		<h1>
			<A HREF="../index.php" class="titolo">{SITENAME}</A>
		</h1>
	  </td> 
    </tr> 
    <tr> 
      <td height="19" colspan="2" bgcolor="#66CC99" class="cella">&nbsp;</td> 
    </tr> 
</table> 
<table width="760" cellspacing="0" cellpadding="10" border="0" align="center"> 
	<tr> 
		<td class="bodyline">
		<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
			<tr> 
				<td>
					<table cellspacing="0" cellpadding="2" border="0" align="center">
						<tr> 
							<td align="center" valign="top" nowrap="nowrap" >
							<span class="mainmenu" align="center">&nbsp;
							<a href="{U_FAQ}" class="mainmenu"><img src="templates/subSilver/images/icon_mini_faq.gif" width="12" height="13" border="0" alt="{L_FAQ}" hspace="3" />{L_FAQ}</a>
							&nbsp; &nbsp;
							<a href="{U_SEARCH}" class="mainmenu"><img src="templates/subSilver/images/icon_mini_search.gif" width="12" height="13" border="0" alt="{L_SEARCH}" hspace="3" />{L_SEARCH}</a>
							&nbsp; &nbsp;
							<a href="{U_MEMBERLIST}" class="mainmenu"><img src="templates/subSilver/images/icon_mini_members.gif" width="12" height="13" border="0" alt="{L_MEMBERLIST}" hspace="3" />{L_MEMBERLIST}</a>&nbsp; &nbsp;<a href="{U_GROUP_CP}" class="mainmenu"><img src="templates/subSilver/images/icon_mini_groups.gif" width="12" height="13" border="0" alt="{L_USERGROUPS}" hspace="3" />{L_USERGROUPS}</a>&nbsp; 
							&nbsp;<a href="statistics.php" class="mainmenu"><img src="templates/subSilver/images/icon_mini_statistics.png" width="12" height="13" border="0" alt="Statistiche" hspace="3" />Statistiche</a>&nbsp;
							<!-- BEGIN switch_user_logged_out -->
							&nbsp;
							<a href="{U_REGISTER}" class="mainmenu"><img src="templates/subSilver/images/icon_mini_register.gif" width="12" height="13" border="0" alt="{L_REGISTER}" hspace="3" />{L_REGISTER}</a></span>&nbsp;
							<!-- END switch_user_logged_out -->
							<span class="mainmenu">&nbsp;<a href="{U_PROFILE}" class="mainmenu"><img src="templates/subSilver/images/icon_mini_profile.gif" width="12" height="13" border="0" alt="{L_PROFILE}" hspace="3" />{L_PROFILE}</a>&nbsp;
							&nbsp;<a href="{U_PRIVATEMSGS}" class="mainmenu"><img src="templates/subSilver/images/icon_mini_message.gif" width="12" height="13" border="0" alt="{PRIVATE_MESSAGE_INFO}" hspace="3" />{PRIVATE_MESSAGE_INFO}</a>&nbsp; 
							&nbsp;<a href="{U_LOGIN_LOGOUT}&redirect=../index.php" class="mainmenu"><img src="templates/subSilver/images/icon_mini_login.gif" width="12" height="13" border="0" alt="{L_LOGIN_LOGOUT}" hspace="3" />{L_LOGIN_LOGOUT}</a>&nbsp;
							</span>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>

		<br />
