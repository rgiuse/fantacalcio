<?
if(eregi("text/vnd.wap.wml", $_SERVER["HTTP_ACCEPT"])){
	if (isset ($username)&& isset ($password)) {
session_start();
session_unset();
session_destroy();
session_start();
session_register("site_login");
session_register("site_password");
session_register("giornata");
	}
require_once("include/header.php");
header("Content-type: text/vnd.wap.wml"); 
echo("xml version=\"1.0\" encoding=\"ISO-8859-1\"");
//require_once("include/header.php");
?>
<!DOCTYPE wml PUBLIC "-//WAPFORUM//DTD WML 1.1//EN"
	"http://www.wapforum.org/DTD/wml_1.1.xml">
<wml>
   <card id="main" title="Login" newcontext="true"> 
      <p align="center">
			User: <input type="text" name="username" emptyok="false" title="User"/><br/>
			Password: <input type="password" name="password" emptyok="false" title="Password"/><br/>

		<anchor>
			Login
			<go href="index.php#menu" method="post">
			<postfield name="username" value="$(username)"/>
			<postfield name="password" value="$(password)"/>
			</go>
		</anchor>
 
      </p> 
   </card>
	<?
		if (isset ($username)) $site_login = $username;
		if (isset ($password)) $site_password = $password;
		if(authent($site_login, $site_password))
		{
			if(eregi("text/vnd.wap.wml", $_SERVER["HTTP_ACCEPT"]))
			{
			?>	
			<card id="menu" title="Seleziona opzioni">
				<p align="center">
					<a href="pagine/showformaz.php">Formazioni</a><br/>
					<a href="#voti">Voti</a>
				</p>
			</card>

			<card id="voti" title="Voti">
			<p align="center">
				<table columns="2">
					<tr><td>Squadra</td><td>Voto</td></tr>
					<tr><td>FantaMarco Lion</td><td>33</td></tr>
				</table>
				<do type="prev" label="Back"><prev/></do>
			</p>
			</card>
			<?
			}
		}
	?>	
</wml>
<?
}
else
{
require("index_n.php");
}
?>
