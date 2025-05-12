<?php
	include_once("../include/connect.php");
	include_once("include/head.html");
	include_once("include/header.php");

	if (isset($_GET['id_author']))
	{
		$id_author = $_GET['id_author'];		
	
		$query = "SELECT * FROM authors WHERE id_author = '$id_author'";
		$result = mysqli_query($link, $query);
		$row = mysqli_fetch_assoc($result);
	}	
?>
		<h1>Edit Author</h1>
		<div class="profile_edit">
			<form action="autores_editar_aux.php?<?php echo "id_author=" . $_GET['id_author']; ?>" method="post" name="autores_editar" enctype="multipart/form-data">
				<div class="upload-container">
					<!-- Avatar -->
					<div class="avatar">
						<img id="avatar" width="200px" height="200px" style="border-radius: 100%;" src="../upload/autores/<?php echo $row['author_photo_url']; ?>">
					</div>
					<!-- Botão de upload -->
					<label for="foto" class="upload-button">
						<span class="icon">+</span> new picture
					</label>
					<input type="file" id="foto" name="foto" value="" accept="image/*">
				</div>
				<div class ="form-container">
					<label for="nome">First Name</label>
					<input type="text" id="nome" name="nome" value="<?php echo $row['first_name']; ?>" required>

					<label for="apelido">Last Name</label>
					<input type="text" id="apelido" name="apelido" value="<?php echo $row['last_name']; ?>" required>

					<label for="descricao">Description</label>
					<textarea id="descricao" name="descricao" rows="4" required><?php echo $row['description']; ?></textarea>

					<label for="nacionalidade">Nationality</label>
					<input type="text" id="nacionalidade" name="nacionalidade" value="<?php echo $row['nationality']; ?>" required>

					<input type="submit" id="submit" name="submit" class="submit-btn" value="Edit">
				</div>
			</form>
		</div>

		<script>
			// Referência ao input de upload e ao avatar
			const foto = document.getElementById('foto');
			const avatar = document.getElementById('avatar');

			// Adiciona um listener para detectar mudanças no campo de upload
			foto.addEventListener('change', function(event) {
			const file = event.target.files[0]; // Obtém o arquivo selecionado

			if (file) {
				const reader = new FileReader(); // Cria um leitor de arquivos

				// Quando a leitura estiver concluída, altera a imagem do avatar
				reader.onload = function(e) {
					avatar.src = e.target.result; // Define o URL da imagem no avatar
				};

				reader.readAsDataURL(file); // Lê o arquivo como uma URL base64
			}
			});
		</script>
		
		<?php
			if (isset($_GET['erro']))
			{
				echo "<br><span>Erro ao editar autor</span>";
			}
			
			if (isset($_GET['sucesso']))	
			{
		?>
		
		<script>
			alert("Autor editado com sucesso!!!");
		</script>
		
		<?php
			}

			include_once("../include/footer.php");
		?>