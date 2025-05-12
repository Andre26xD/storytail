<?php
	$nome = $_POST["nome"];
	$apelido = $_POST["apelido"];
	$username = $_POST["username"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	
	include_once("include/connect.php");
	
	if (isset ($_POST['submit']))
	{
		$foto = basename($_FILES["foto"]["name"]);
		$data_hora = date('Y-m-d H:i:s');
		
		$target_file = "upload/users/" . $foto;
				
		if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file))
		{			
			$query = "INSERT INTO users (id_user_type, first_name, last_name, user_name, email, password, user_photo_url, created_at, updated_at)
			VALUES (6, '$nome', '$apelido', '$username', '$email', '$password', '$foto', '$data_hora', '$data_hora')";
			$result = mysqli_query($link, $query);
		}
		
		if ($result)
		{
			header("Location: registar.php?sucesso=1");
			exit;
		}
		else
		{
			header("Location: registar.php?erro=1");
			exit;
		}
	}
?>