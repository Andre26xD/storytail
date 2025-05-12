<?php
	include_once("../include/connect.php");

	if (isset($_GET['id_activity']))
	{
		$id_activity = $_GET['id_activity'];
		
		$query = "SELECT title FROM activities WHERE id_activity = '$id_activity'";
		$result = mysqli_query($link, $query);
		$row = mysqli_fetch_assoc($result);
		
		$path = "../upload/atividades/" . $row['title'];
		
		// Abre o diretório
		$itens = array_diff(scandir($path), ['.', '..']);

		foreach ($itens as $item) {
			$complete_path = $path . DIRECTORY_SEPARATOR . $item;

			unlink ($complete_path);
		}

		// Remove o diretório vazio
		rmdir($path);
		
		$query = "DELETE FROM activities WHERE id_activity = '$id_activity'";
		mysqli_query($link, $query);

		mysqli_close($link);
		
		header("Location: atividades.php");
	}
?>