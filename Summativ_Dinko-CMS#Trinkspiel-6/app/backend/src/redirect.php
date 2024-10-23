<?php
#Class Redirect, Umleitung zu gewünschten Hompage
 class Redirect 
{
 static $site = [];

    #to:  Übergabe URL ROOT (Core.php) & Path (Controller.php)
	public static function to($root, $array = null)
	{
		// Als Statistic Methode nur Static Params
		self::$site = array('home', 'user', 'login', 'benutzer', '404');
		foreach(self::$site as $key => $value)
		if($root === $value)
		// Gehe zu Url wenn Value Passt
		header('Location:' . URLROOT . '/'.$root);
		exit();
	}
}
?>