<?php
	require("db_connect.php");
	session_start();

	$email = $_POST['email'];
	$password = $_POST['password'];

	$sql = "SELECT users.*, roles.name as rname FROM users 
			INNER JOIN model 
			ON users.id = model.user_id
			INNER JOIN roles
			ON model.role_id = roles.id
			WHERE email = :v1 AND password = :v2";

	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':v1', $email);
	$stmt->bindParam(':v2', $password);
	$stmt->execute();

	$user = $stmt->fetch(PDO::FETCH_ASSOC);


	if ($stmt->rowCount() <= 0) {
		# Invalid Email or Password


		if(!isset($_COOKIE['logincount'])){
			$loginCount = 1;
		}
		else{
			$loginCount= $_COOKIE['logincount'];
			$loginCount++;
		}

		setcookie("logincount", $loginCount, time()+10);

		if ($loginCount >= 3) {
			
			

			

			setcookie('logincount','',time()-10);

			echo "<script type=\"text/javascript\">
				(function(){
					setTimeout(function(){
						location.href='login.php';
					},10000);
				})(); 
				</script>";

		}
		else{
			$_SESSION['login_fail'] = 'Your current email and password is invalid';

			header('location:login.php');

		}

	}
	else{
		# success

		$_SESSION['login_user'] = $user;

		$role = $user['rname'];

		if ($role == "Customer") {
			if (isset($_SESSION['shopping_cartURL'])) {
				header("location:".$_SESSION['shopping_cartURL']);
			} else{
				header('location:index.php');
			}
		}
		else{
			header('location:item_list.php');
		}

	}

?>