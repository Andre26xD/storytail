<?php
	$titulo = $_POST["titulo"];
	$descricao = $_POST["descricao"];
	$tempo = $_POST["tempo"];
	$idade = $_POST["idade"];
	$nivel = $_POST["nivel"];
	$autor = $_POST["autor"];
	
	include_once("../include/connect.php");
	
	if (isset ($_POST['submit']))
	{
		$id_book = $_GET['id_book'];
		
		$data_hora = date('Y-m-d H:i:s');
						
		$query = "UPDATE books SET title='$titulo', description='$descricao', read_time='$tempo', id_age_group='$idade', is_active=1, access_level='$nivel', updated_at = '$data_hora' WHERE id_book='$id_book'";
		$result = mysqli_query($link, $query);
		
		$query = "UPDATE author_book SET id_author='$autor' WHERE id_book='$id_book'";
		$result = mysqli_query($link, $query);
		
		if ($result)
		{
			header("Location: livros_editar.php?sucesso=1&id_book=".$id_book);
			exit;
		}
		else
		{
			header("Location: livros_editar.php?erro=1&id_book=".$id_book);
			exit;
		}
	}
?>