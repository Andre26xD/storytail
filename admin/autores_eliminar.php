<?php
	include_once("../include/connect.php");

	if (isset($_GET['id_author']))
	{
		$id_author = $_GET['id_author'];
		
		$query = "SELECT author_photo_url FROM authors WHERE id_author = '$id_author'";
		$result = mysqli_query($link, $query);
		$row = mysqli_fetch_assoc($result);
		
		$path = "../upload/autores/" . $row['author_photo_url'];
		unlink ($path);
			
		$query = "DELETE FROM authors WHERE id_author = '$id_author'";
		mysqli_query($link, $query);
		
		mysqli_close($link);
		
		header("Location: autores.php");
	}
?>