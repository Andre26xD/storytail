<?php
	$nome = $_POST["nome"];
	$apelido = $_POST["apelido"];
	$descricao = $_POST["descricao"];
	$nacionalidade = $_POST["nacionalidade"];
	
	include_once("../include/connect.php");
	
	if (isset ($_POST['submit']))
	{
		$id_author = $_GET['id_author'];
		
		$data_hora = date('Y-m-d H:i:s');
		$foto = basename($_FILES["foto"]["name"]);
		
		if ($foto != "")
		{
			$target_file = "../upload/autores/" . $foto;

			if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file))
			{	
				$query = "UPDATE authors SET first_name='$nome', last_name='$apelido', description='$descricao', author_photo_url='$foto', nationality='$nacionalidade', updated_at='$data_hora' WHERE id_author='$id_author'";
				$result = mysqli_query($link, $query);
			}
		}
		else
		{
			$query = "UPDATE authors SET first_name='$nome', last_name='$apelido', description='$descricao', nationality='$nacionalidade', updated_at='$data_hora' WHERE id_author='$id_author'";
			$result = mysqli_query($link, $query);
		}
		
		if ($result)
		{
			header("Location: autores_editar.php?sucesso=1&id_author=".$id_author);
			exit;
		}
		else
		{
			header("Location: autores_editar.php?erro=1&id_author=".$id_author);
			exit;
		}
	}
?>