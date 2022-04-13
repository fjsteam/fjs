<?php
    date_default_timezone_set('Asia/Bangkok');
    $host = "127.0.0.1";
    $user = "dev";
    $pwd = "1234";
    $dbname="kushop";

    $dsn = "mysql:host=$host;dbname=$dbname";
	try {
		$db = new PDO($dsn,$user,$pwd);
		$db->query("SET NAMES UTF8");
	}
	catch (PDOException $e)
	{
		echo "Error".$e->getMessage();		
	}
?>