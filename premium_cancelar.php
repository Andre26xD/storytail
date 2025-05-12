<?php
	session_start();
	
	include_once("include/connect.php");

	$id_user = $_SESSION['ID'];

	$query = "DELETE FROM subscriptions WHERE id_user='$id_user'";
	$result = mysqli_query($link, $query);

	$query = "UPDATE users SET id_user_type=6 WHERE id_user='$id_user'";
	$result = mysqli_query($link, $query);

	$_SESSION['ACCESS'] = 6;
		
	if ($result)
	{
		header("Location: perfil.php?sucesso3=1&id_user=".$id_user);
		exit;
	}
?>