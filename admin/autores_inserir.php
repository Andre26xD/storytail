<?php
	include_once("include/head.html");
	include_once("include/header.php");
?>

		<h1>Add Author</h1>
		<div class="profile_edit">
			<form action="autores_inserir_aux.php" method="post" name="autores_editar" enctype="multipart/form-data">
				<div class="upload-container">
					<!-- Avatar -->
					<div class="avatar">
						<img id="avatar" width="200px" height="200px" style="border-radius: 100%;" src="../imgs/avatar.png">
					</div>
					<!-- Botão de upload -->
					<label for="foto" class="upload-button">
						<span class="icon">+</span> new picture
					</label>
					<input type="file" id="foto" name="foto" value="" accept="image/*">
				</div>
				<div class ="form-container">
					<label for="nome">First Name</label>
					<input type="text" id="nome" name="nome" value="" required>

					<label for="apelido">Last Name</label>
					<input type="text" id="apelido" name="apelido" value="" required>

					<label for="descricao">Description</label>
					<textarea id="descricao" name="descricao" rows="4" required></textarea>
					
					<label for="foto">Photo</label>
					<input type="file" id="foto" name="foto" value="" accept="image/*" required>
					
					<label for="nacionalidade">Nationality</label>
					<input type="text" id="nacionalidade" name="nacionalidade" value="" required>

					<input type="submit" id="submit" name="submit" class="submit-btn" value="Insert">
				</div>
			</form>
		</div>
		
		<?php
			if (isset($_GET['sucesso']))	
			{
		?>
		
		<script>
			alert("Author inserted sucessfully!!!");
		</script>
		
		<?php
			}

			include_once("../include/footer.php");
		?>
