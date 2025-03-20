<?
	// per splittare: $query  = "SELECT id, name FROM products ORDER BY name LIMIT 20 OFFSET $offset;";
	function sqlcheck($string)
	{
		$string = str_replace("'", "`", $string);
		return $string;
	}
?>