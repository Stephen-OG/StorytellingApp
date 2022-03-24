<?php

// try{
// 	$dsn = "mysql: dbname=id18622325_storytellingdb; host=127.0.0.1";
// 	$user = "id18622325_root";
// 	$pass = "|sT9p])|9zfbjvNb";
// 	$con = new PDO($dsn,$user,$pass);
// 	$con->query("USE id18622325_storytellingdb");
// 	}
// 	catch(PDOException $e){
// 		die("Error Connecting: ".$e->getMessage());
// 	}

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname ="storytellingdb";
if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
	die("failed to connect!");
}

// $dbhost = "ec2-3-229-161-70.compute-1.amazonaws.com";
// $dbuser = "ybcjbbpiblesnb";
// $dbpass = "2b1cadff8ddc6cd7f60dfc0f6cdae776514f12b36037fbc11dfdbb4326f784d7";
// $dbname ="d7lbfths0sm7un";
// if(!$con = pg_connect("dbname=d7lbfths0sm7un user=ybcjbbpiblesnb password=2b1cadff8ddc6cd7f60dfc0f6cdae776514f12b36037fbc11dfdbb4326f784d7"));
// {

// 	die("failed to connect!" . pg_last_error());
// }

// $dbhost = "ec2-3-229-161-70.compute-1.amazonaws.com";
// $dbuser = "ybcjbbpiblesnb";
// $dbpass = "2b1cadff8ddc6cd7f60dfc0f6cdae776514f12b36037fbc11dfdbb4326f784d7";
// $dbname ="d7lbfths0sm7un";
// $port = "5432";

// try {
// 	//$dsn = "pgsql:host=" . $dbhost .";port=" . $port. ";dbname=" . $dbname .";";
// 	$dsn = "pgsql:host='$dbhost';port='$port';dbname='$dbname'";
// 	$con = new PDO($dsn, $dbuser, $dbpass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
// 	 if ($con) {
// 	 	echo "Connected to the database successfully!";
// 	 }
// }
// catch (PDOException $e) {
// 	die($e->getMessage());
// } finally {
// 	if ($con) {
// 		$con = null;
// 	}
// }