<?php
	$titulo = $_POST["titulo"];
	$descricao = $_POST["descricao"];
	$livro = $_POST["livro"];
	
	include_once("../include/connect.php");
	
	if (isset ($_POST['submit']))
	{
		$id_activity = $_GET['id_activity'];
		
		$data_hora = date('Y-m-d H:i:s');
						
		$query = "UPDATE activities SET title='$titulo', description='$descricao', updated_at = '$data_hora' WHERE id_activity='$id_activity'";
		$result = mysqli_query($link, $query);
		
		$query = "UPDATE activity_book SET id_book='$livro' WHERE id_activity='$id_activity'";
		$result = mysqli_query($link, $query);
		
		if ($result)
		{
			header("Location: atividades_editar.php?sucesso=1&id_activity=".$id_activity);
			exit;
		}
		else
		{
			header("Location: atividades_editar.php?erro=1&id_activity=".$id_activity);
			exit;
		}
	}
?>