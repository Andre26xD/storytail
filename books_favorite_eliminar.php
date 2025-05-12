<?php
	include_once("include/connect.php");

	if (isset($_GET['id_book']))
	{
		$id_book = $_GET['id_book'];
		
		$query = "DELETE FROM book_user_favorite WHERE id_book = '$id_book'";
		mysqli_query($link, $query);

		mysqli_close($link);
		
		header("Location: books_favorite.php");
	}
?>