<?php
	$nome = $_POST["nome"];
	$apelido = $_POST["apelido"];
	$descricao = $_POST["descricao"];
	$nacionalidade = $_POST["nacionalidade"];
	
	include_once("../include/connect.php");

	if (isset ($_POST['submit']))
	{
		$foto = basename($_FILES["foto"]["name"]);
		$data_hora = date('Y-m-d H:i:s');
		
		$target_file = "../upload/autores/" . $foto;
				
		if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file))
		{			
			$query = "INSERT INTO authors (first_name, last_name, description, author_photo_url, nationality, created_at, updated_at) 
			VALUES ('$nome', '$apelido', '$descricao', '$foto', '$nacionalidade', '$data_hora', '$data_hora')";
			$result = mysqli_query($link, $query);
		}

		if ($result)
		{
			header("Location: autores_inserir.php?sucesso=1");
			exit;
		}
	}
?>