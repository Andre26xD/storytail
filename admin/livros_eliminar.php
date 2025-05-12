<?php
	include_once("../include/connect.php");

	if (isset($_GET['id_book']))
	{
		$id_book = $_GET['id_book'];
		
		$query = "SELECT title FROM books WHERE id_book = '$id_book'";
		$result = mysqli_query($link, $query);
		$row = mysqli_fetch_assoc($result);
		
		$path = "../upload/livros/" . $row['title'];
		
		// Abre o diretório
		$itens = array_diff(scandir($path), ['.', '..']);

		foreach ($itens as $item) {
			$complete_path = $path . DIRECTORY_SEPARATOR . $item;

			unlink ($complete_path);
		}

		// Remove o diretório vazio
		rmdir($path);*/
		
		$query = "DELETE FROM books WHERE id_book = '$id_book'";
		mysqli_query($link, $query);
		
		mysqli_close($link);
		
		header("Location: livros.php");
	}
?>