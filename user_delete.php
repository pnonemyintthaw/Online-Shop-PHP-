<?php
    require 'db_connect.php';

    $id = $_GET['id'];

    $status = 1;

	$sql = 'DELETE FROM users WHERE id=:v1';
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':v1',$id);
	$stmt->execute();

	$sql = 'DELETE FROM model WHERE user_id=:v1';
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':v1',$id);
	$stmt->execute();


	header('location:user.php');

?>