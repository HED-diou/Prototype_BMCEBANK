<?php

try
	$bdd = new PDO('mysql:host=localhost;dbname=startupss','root','');
catch(Exeption $e)
	die('Ereur' . $e ->getMessage());


?>
