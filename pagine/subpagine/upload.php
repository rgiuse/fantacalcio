<?
	$PATHNAME = "..";
	require_once("$PATHNAME/include/header.php");
	if (isadmin($site_login) && authent($site_login, $site_password))
	{
		?>
		<H2>Upload Dati Giocatori</H2>
        <form enctype="multipart/form-data" action="<?=$PATHNAME?>/script/douploaddati.php" method="POST">
<input type="hidden" name="MAX_FILE_SIZE" value="3000000">
File Dati Giocatori: 
 <input name="userfile" type="file">
<input type="submit" value="Upload File">
</form>
<?
	}
	else
	{
	$msg=urlencode("&Egrave; necessario essere autenticati<BR>per poter accedere a questa sezione!");
	header("Location: $PATHNAME/pagine/messaggio.php?msg=$msg");
	}
	?>