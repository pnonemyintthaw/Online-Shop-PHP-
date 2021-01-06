<?php 
$servername="localhost";
$dbname="bath18_pos";
$user="root";
$password="";




$dsn="mysql:host=$servername; dbname=$dbname";
$pdo=new PDO($dsn, $user, $password);
try{
	$conn=$pdo;
	//ser pdo error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// echo "CONNECTED";
}
catch(PDOException $e){
	echo "connection failed".$e->getMessage();

}