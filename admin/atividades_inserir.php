<?php
	include_once("../include/connect.php");
	include_once("include/head.html");
	include_once("include/header.php");
?>

		<h1>Add Activity</h1>
		<div class="profile_edit">
			<form action="atividades_inserir_aux.php" method="post" name="atividades_inserir" enctype="multipart/form-data">
				<label for="titulo">Title</label>
				<input type="text" id="titulo" name="titulo" value="" required>

				<label for="descricao">Description</label>
				<textarea id="descricao" name="descricao" rows="4" required></textarea>

				<label for="imagens">Pictures</label>
				<input type="file" id="imagens" name="imagens[]" value="" accept="image/*" multiple required>
				
				<label for="livro">Book</label>
				<select id="livro" name="livro" required>
					<option value="" selected>Book</option>
					<?php
						$query = "SELECT * FROM books";
						$result = mysqli_query($link, $query);
						
						while ($row = mysqli_fetch_assoc($result)) {
							echo '<option value="' . $row['id_book'] . '">' . $row['title'] . '</option>';
						}
					?>
				</select>
				
				<input type="submit" id="submit" name="submit" class="submit-btn" value="Insert">
			</form>
		</div>
		
		<?php
			if (isset($_GET['erro']))
			{
				echo "<br><span>Erro ao adicionar atividade</span>";
			}
			
			if (isset($_GET['sucesso']))	
			{
		?>
		
		<script>
			alert("Atividade adicionada com sucesso!!!");
		</script>
		
		<?php
			}

			include_once("../include/footer.php");
		?>