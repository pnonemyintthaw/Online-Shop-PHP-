<?php 
	require('db_connect.php');

	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
	$address = $_POST['address'];

	$profile = 'images/brands/saisai_logo.png';
	// var_dump($name);
	// die();

	// if($name=null&&$phone=null&&$email=null&&$password=null&&$cpassword=null&&$address=null){
	// 	header('location:register.php');
	// }


	$roleid = 2;

	$status = 0;

	if($password!=$cpassword){
		header('location:register.php');
		
	}

	$sql = "INSERT INTO users (name,profile,email,password,phone,address,status) VALUES(:v1,:v2,:v3,:v4,:v5,:v6,:v7)";
	
	
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':v1',$name);
	$stmt->bindParam(':v2',$profile);
	$stmt->bindParam(':v3',$email);
	$stmt->bindParam(':v4',$password);
	$stmt->bindParam(':v5',$phone);
	$stmt->bindParam(':v6',$address);
	$stmt->bindParam(':v7',$status);
	$stmt->execute();

	$last_id = $conn->lastInsertId();

	$sql = "INSERT INTO model(user_id,role_id) VALUES (:v1, :v2)";
	$stmt= $conn->prepare($sql);
	$stmt->bindParam(':v1',$last_id);
	$stmt->bindParam(':v2',$roleid);
	$stmt->execute();

	session_start();
	$_SESSION['reg_success'] = 'Yes, it is not easy, but you did it! Please Sigin Again.';



	header('location:login.php');





	?>