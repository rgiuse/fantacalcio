<xsl:stylesheet version="1.0" 
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
	<wml>
		<xsl:apply-templates select="formazioni"/>
	</wml>
</xsl:template>

<xsl:template match="formazioni">
	<card id="squadre" title="Squadre">
	<p align="center">
	<xsl:for-each select="squadra">
	<anchor><xsl:value-of select="@nome"/><go href="#card{position()}"/>
	</anchor>
		<br/>
         </xsl:for-each>
	 </p>
	 <do type="accept" label="Indietro">
	 <prev/>
	 </do>
	</card>

 <xsl:apply-templates select="squadra"/>

</xsl:template>

<xsl:template match="squadra">
	<card id="card{position()}">
	<xsl:attribute name="title">
	<xsl:apply-templates select="@nome"/>
	</xsl:attribute>
	<p align="center"><big><b><xsl:apply-templates select="@nome"/></b></big>
	<xsl:apply-templates select="titolari"/>
	<xsl:apply-templates select="riserve"/>
	<do type="accept" label="Squadre">
	 <prev/>
	</do>
	<do type="accept" label="Menu">
	<go href="../index.php#menu"/>
	</do>
	</p>
	</card>
</xsl:template>

 <xsl:template match="titolari">
	<table columns="3" align="center">
	<tr><td colspan="3" align="center">Titolari</td></tr>
	<xsl:apply-templates select="giocatore"/>
	</table>
</xsl:template>

<xsl:template match="riserve">
	<table columns="3" align="center">
	<tr><td colspan="3" align="center">Riserve</td></tr>
	<xsl:apply-templates select="giocatore"/>
	</table>
</xsl:template>

<xsl:template match="giocatore">
	<tr><td><xsl:value-of select="cognome"/><xsl:value-of select="nome"/></td><td><small><xsl:value-of select="ruolo"/></small></td><td><small><xsl:value-of select="voto"/></small></td></tr>
</xsl:template>

</xsl:stylesheet>