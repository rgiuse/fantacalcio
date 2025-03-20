<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
  <html>
	<head>
	<link rel="stylesheet" type="text/css" href="css/main.css"/>
	</head>
	<xsl:apply-templates select="formazioni"/>
  </html>
</xsl:template>

<xsl:template match="formazioni">
 <body>
 <center>
 <xsl:apply-templates select="squadra"/>
 </center>
</body>
</xsl:template>

<xsl:template match="squadra">
<table width="95%" border="1" cellpadding="1" cellspacing="2" class="tabellabianca">
<tr class="tabellabordosxdx"> 
	<td align="center" class="cella"><span class="titoloCelleLat"><xsl:apply-templates select="@nome"/></span></td> 
</tr>
<tr class="tabellabordosxdx"> 
	<td align="center" valign="top" class="cella">
		<table width="100%" border="0" cellspacing="1" cellpadding="1"> 
		<xsl:if test="count(titolari/giocatore)!=0">
			<xsl:apply-templates select="titolari"/>	
			<xsl:apply-templates select="riserve"/>
		</xsl:if>
		<xsl:if test="count(titolari/giocatore)=0"> 
		    <td align="center">Attualmente non e stata inserita alcuna formazione</td>
		</xsl:if>
		</table>
	</td>
</tr>
</table>
</xsl:template>
 <xsl:template match="titolari">
	<tr class="tabellabordosxdx" > 
		<td align="center" class="cella" colspan="6">
			<span class="titoloCelleLat">Titolari</span>
		</td> 
	</tr>
	<xsl:apply-templates select="giocatore"/>
</xsl:template>

<xsl:template match="riserve">
	<tr class="tabellabordosxdx" > 
		<td align="center" class="cella" colspan="6">
			<span class="titoloCelleLat">Riserve</span>
		</td> 
	</tr>
	<xsl:apply-templates select="giocatore"/>
</xsl:template>

<xsl:template match="giocatore">
	<tr class="tabellabordosxdx">
		<td bgcolor="EEEEEE" class="cella" style="color: rgb(0, 0, 0); font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 11px;">
			<div align='right'>
				<b><xsl:value-of select="num"/>.</b>
			</div>
		</td>
		<td  class="cella">
		<xsl:attribute name="bgcolor">
			<xsl:apply-templates select="../../@csfondo"/>
		</xsl:attribute>
		<xsl:attribute name="style">
			color: <xsl:apply-templates select="../../@cchar"/>; font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 11px;
		</xsl:attribute>
		<em><xsl:value-of select="ruolo"/></em>
		</td>
				<td width="250"  class="cella">
			<xsl:attribute name="bgcolor">
			   <xsl:apply-templates select="../../@csfondo"/>
			</xsl:attribute>
			<xsl:attribute name="style">
			color: <xsl:apply-templates select="../../@cchar"/>; font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 14px;
			</xsl:attribute>
			<b><xsl:value-of select="cognome"/></b>
		</td>
		<td width="250" class="cella">
			<xsl:attribute name="bgcolor">
			   <xsl:apply-templates select="../../@csfondo"/>
			</xsl:attribute>
			<xsl:attribute name="style">
			color: <xsl:apply-templates select="../../@cchar"/>; font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 14px;
			</xsl:attribute>
			<div>
			<xsl:value-of select="nome"/>
			</div>
		</td>
		<td width="25" class="cella">
			<xsl:attribute name="bgcolor">
			   <xsl:apply-templates select="../../@csfondo"/>
			</xsl:attribute>
			<xsl:attribute name="style">
			color: <xsl:apply-templates select="../../@cchar"/>; font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 14px;
			</xsl:attribute>
			<xsl:value-of select="voto"/>
		</td>
		<td width="25" class="cella">
			<xsl:attribute name="bgcolor">
			   <xsl:apply-templates select="../../@csfondo"/>
			</xsl:attribute>
			<xsl:attribute name="style">
			color: <xsl:apply-templates select="../../@cchar"/>; font-family: 'Verdana, Arial, Helvetica, sans-serif'; font-size: 14px;
			</xsl:attribute>
			<xsl:value-of select="votobase"/>
		</td>
	</tr>
</xsl:template>

</xsl:stylesheet>