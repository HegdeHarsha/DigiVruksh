<?php 

session_start();  //it 

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$email = $_POST['email'];
		$password = $_POST['password'];

		if(!empty($email) && !empty($password) && !is_numeric($email))
		{

			//read from database
			$query = "select * from userss where email = '$email' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					
					if($user_data['password'] === $password)
					{

						
						  $_SESSION['id'] = $user_data['id'];
						  header("Location:index1.php");
						  die;
						
						
					}
				}
			}
			
			echo "<script>alert('wrong username or password!')</script>";
		}else
		{
			echo "<script>alert('wrong username or password!')</script>";
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>

	<div id="box" >
		
		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white;">Login</div>

			<input id="text" type="text" name="email"placeholder="email"><br><br>
			<input id="text" type="password" name="password"placeholder="password"><br><br>

			<input id="button" type="submit" value="Login"><br><br>

			<a href="signup.php">Click to Signup</a><br><br>
		</form>
	</div>
</body>
</html>