<?php
	$titulo = $_POST["titulo"];
	$descricao = $_POST["descricao"];
	$livro = $_POST["livro"];
	
	include_once("../include/connect.php");
	
	if (isset ($_POST['submit']))
	{
		$path = "../upload/atividades/" . $titulo;
		
		if (!is_dir($path)) {
			mkdir($path);
		}
		
		$data_hora = date('Y-m-d H:i:s');
				
		$query = "INSERT INTO activities (title, description, created_at, updated_at) 
		VALUES ('$titulo', '$descricao', '$data_hora', '$data_hora')";
		$result = mysqli_query($link, $query);
		$id_activity = mysqli_insert_id($link);
		
		$query = "INSERT INTO activity_book (id_activity, id_book) 
		VALUES ('$id_activity', '$livro')";
		$result = mysqli_query($link, $query);
		
		
		for ($i = 0; $i < count($_FILES['imagens']['name']); $i++) {
			$imagem = basename($_FILES['imagens']['name'][$i]);
			
			$target_file = "../upload/atividades/" . $titulo . '/' . $imagem;
			
			if (move_uploaded_file($_FILES["imagens"]["tmp_name"][$i], $target_file))
			{
				$query = "INSERT INTO activity_images (id_activity, title, image_url, created_at, updated_at) 
				VALUES ('$id_activity', '$imagem', '$imagem', '$data_hora', '$data_hora')";
				$result = mysqli_query($link, $query);
			}
		}
		
		if ($result)
		{
			header("Location: atividades_inserir.php?sucesso=1");
			exit;
		}
		else
		{
			header("Location: atividades_inserir.php?erro=1");
			exit;
		}
	}
?>