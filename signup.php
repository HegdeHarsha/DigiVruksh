<?php 
session_start();//exease the globel varlabe

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		
		$user_name = $_POST['user_name'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name)&& !empty($email))
		{

			//save to database
			
			$query = "insert into userss (user_name,email,password) values ('$user_name','$email','$password')";

			mysqli_query($con, $query);

			header("Location: login.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
	<link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>


	<div id="box">
		
		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white;">Signup</div>

			<input id="text" type="text" name="user_name"placeholder="full name"><br><br>
			<input id="text" type="text" name="email"placeholder="email"><br><br>
			<input id="text" type="password" name="password"placeholder="password"><br><br>
			<input id="button" type="submit" value="Signup"><br><br>

			<a href="login.php">Click to Login</a><br><br>
		</form>
	</div>
</body>
</html>