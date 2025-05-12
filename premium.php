<?php
	session_start();
	
	include_once("include/connect.php");

	$id_user = $_SESSION['ID'];
	$data_hora = date('Y-m-d');

	$query = "INSERT INTO subscriptions (id_user, start_date) VALUES ('$id_user','$data_hora')";
	$result = mysqli_query($link, $query);

	$query = "UPDATE users SET id_user_type=7 WHERE id_user='$id_user'";
	$result = mysqli_query($link, $query);

	$_SESSION['ACCESS'] = 7;
		
	if ($result)
	{
		header("Location: perfil.php?sucesso2=1&id_user=".$id_user);
		exit;
	}
?>