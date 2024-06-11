<?php

function check_login($con)
{

	if (isset($_SESSION['id'])) {

		$id = $_SESSION['id'];
		$query = "select * from userss where id = '$id' limit 1 ";

		$result = mysqli_query($con, $query);
		if ($result && mysqli_num_rows($result) > 0) {

			$user_data = mysqli_fetch_assoc($result); //assoc=assouate array
			return $user_data;
		}
	}

	//redirect to login
	header("Location: login.php");
	die;
}


function login($con)
{
	$log_info = "SELECT * FROM userss";
	$query = $con->query($log_info);
	$log_data = mysqli_fetch_assoc($query); //assoc=assouate array
	return $log_data;
}
