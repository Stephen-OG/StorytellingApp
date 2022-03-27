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
//mysql://b37a73a55c7d50:73c5aa93@us-cdbr-east-05.cleardb.net/heroku_20c389206e5f6d4?reconnect=true
session_start();

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname ="storytellingdb";
if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
	die("failed to connect!");
}

// $dbhost = "us-cdbr-east-05.cleardb.net";
// $dbuser = "b37a73a55c7d50";
// $dbpass = "73c5aa93";
// $dbname ="heroku_20c389206e5f6d4";
// if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
// {
// 	die("failed to connect!");
// }

//r+=5G)B0pk=sxi++
// $dbhost = "ec2-3-229-161-70.compute-1.amazonaws.com";
// $dbuser = "ybcjbbpiblesnb";
// $dbpass = "2b1cadff8ddc6cd7f60dfc0f6cdae776514f12b36037fbc11dfdbb4326f784d7";
// $dbname ="d7lbfths0sm7un";
// if(!$con = pg_connect("dbname=d7lbfths0sm7un user=ybcjbbpiblesnb password=2b1cadff8ddc6cd7f60dfc0f6cdae776514f12b36037fbc11dfdbb4326f784d7"));
// {

// 	die("failed to connect!" . pg_last_error());
// }
