<table width="100%" border="0" cellpadding="1" cellspacing="2">
            <!-- pagina in subpage -->
			<?require("submenu/benvenuto.php");?>
			<!-- fine pagina in subpage -->
          <tr class="tabellabordosxdx"> 
            <td align="center" class="cellavuota">&nbsp;</td> 
          </tr>
		  <?
			if (isadmin($site_login))
			{
				?>
				<!-- pagina in subpage -->
				<?require("submenu/menuadmin.php");?>
				<!-- fine pagina in subpage -->
				 <tr class="tabellabordosxdx">
					<td align="center" class="cellavuota">&nbsp;</td> 
				 </tr>
				<?
			}
				?>
				<!-- pagina in subpage -->
				<?require("submenu/menu.php");?>
				<!-- fine pagina in subpage -->
		  <tr class="tabellabordosxdx">
			<td align="center" class="cellavuota">&nbsp;</td>
		  </tr>
		  <?
			if (authent($site_login, $site_password))
			{
		  ?>
			<!-- pagina in subpage -->
			<?require("submenu/chat.php");?>
			<!-- fine pagina in subpage -->
		  <tr class="tabellabordosxdx">
            <td align="center" class="cellavuota">&nbsp;</td> 
          </tr>
		  <?
			}
		  ?>
            <!-- pagina in subpage -->
			<?require("submenu/news.php");?>
			<!-- fine pagina in subpage -->
		  <tr class="tabellabordosxdx">
			<td align="center" class="cellavuota">&nbsp;</td>
		  </tr>
		 <tr>
            <td valign="bottom" class="cellavuota">
			<p align=center>
				<a href="http://validator.w3.org/check/referer"><img border="0"
				  src="http://www.w3.org/Icons/valid-html401"
						  alt="Valid HTML 4.01!" height="31" width="88"></a>
				</p>
				<p align=center>
				 <a href="http://jigsaw.w3.org/css-validator/check/referer">
				  <img style="border:0;width:88px;height:31px"
					   src="http://jigsaw.w3.org/css-validator/images/vcss" 
					   alt="Valid CSS!">
				</a>
			</p>
			</td> 
          </tr> 
      </table>



