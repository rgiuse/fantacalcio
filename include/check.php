<?
	function checkString($string)
	{	
	if (ereg("^([A-Za-z0-9Р-жи-іј-џ'?!_,@.\s]{1,255})$", $string))
			return true;
		else return false;
	}
	
	function checkStringMulti($string)
	{	
	if (ereg("^([ A-Za-z0-9Р-жи-іј-џ'?!_,@.\s]{1,255})$", $string))
			return true;
		else return false;
	}
	
	function checkNum($string)
	{	
	if (ereg("^([0-9]{1,255})$", $string))
			return true;
		else return false;
	}

	function checkMail($mail)
	{
		if (ereg("^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$", $mail))
			return true;
		else return false;

	}
	function checkColor($color)
	{
	if (ereg("^#?([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?$", $color))
			return true;
		else return false;
	}
	function checkPassword($pass)
	{
	if (ereg("^([A-Za-z0-9Р-жи-іј-џ'?!_,@Ѓ$=^.\s]{5,255})$", $pass))
			return true;
		else return false;
	}

?>