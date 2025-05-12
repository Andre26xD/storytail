<?php
	include_once("../include/connect.php");

	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$query = "SELECT * FROM users WHERE id_user_type = 5";
	$result = mysqli_query($link, $query);
	echo(mysqli_error($link));
	
	while ($row = mysqli_fetch_assoc($result))
	{
		if ($row['user_name'] == $username && $row['password'] == $password) {
			session_start();
			
			$_SESSION['ID_ADMIN'] = $row['id_user'];
			$_SESSION['USER_NOME_ADMIN'] = $row['user_name'];			
			$_SESSION['EMAIL_ADMIN'] = $row['email'];
			
			header("Location: index.php");
			exit;
		}
	}

	header("Location: login.php?erro=1");
	exit;
?>