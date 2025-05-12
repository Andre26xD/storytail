<?php
	include_once("../include/connect.php");
	include_once("include/head.html");
	include_once("include/header.php");
?>

		<h1>Add Book</h1>
		<div class="profile_edit">
			<form action="livros_inserir_aux.php" method="post" name="livros_inserir" enctype="multipart/form-data">
				<label for="titulo">Title</label>
				<input type="text" id="titulo" name="titulo" value="" required>

				<label for="descricao">Description</label>
				<textarea id="descricao" name="descricao" rows="4" required></textarea>

				<label for="capa">Cover</label>
				<input type="file" id="capa" name="capa" value="" accept="image/*" required>
				
				<label for="tempo">Read Time</label>
				<input type="number" id="tempo" name="tempo" value="" required>
				
				<label for="idade">Age Group</label>
				<select id="idade" name="idade" required>
					<option value="" selected>Age Group</option>
					<option value="1">3-5 years</option>
					<option value="2">6-7 years</option>
					<option value="3">8-9 years</option>
					<option value="4">10-12 years</option>
				</select>
				
				<label for="nivel">Access Level</label>
				<select id="nivel" name="nivel" required>
					<option value="" selected>Access Level</option>
					<option value="Normal">Normal</option>
					<option value="Premium">Premium</option>
				</select>
				
				<label for="autor">Author</label>
				<select id="autor" name="autor" required>
					<option value="" selected>Author</option>
					<?php
						$query = "SELECT * FROM authors";
						$result = mysqli_query($link, $query);
						
						while ($row = mysqli_fetch_assoc($result)) {
							echo '<option value="' . $row['id_author'] . '">' . $row['first_name'] . ' ' . $row['last_name'] . '</option>';
						}
					?>
				</select>
				
				<label for="paginas">Pages</label>
				<input type="file" id="paginas" name="paginas[]" value="" accept="image/*" multiple required>
				
				<label for="video">Video</label>
				<input type="file" id="video" name="video" value="" accept="video/*" required>
					
				<label for="audio">Audio</label>
				<input type="file" id="audio" name="audio" value="" accept="audio/*" required>
				
				<input type="submit" id="submit" name="submit" class="submit-btn" value="Submit">
			</form>
		</div>
		
		<?php
			if (isset($_GET['erro']))
			{
				echo "<br><span>Erro ao adicionar livro</span>";
			}
			
			if (isset($_GET['sucesso']))	
			{
		?>
		
		<script>
			alert("Livro adicionado com sucesso!!!");
		</script>
		
		<?php
			}

			include_once("../include/footer.php");
		?>