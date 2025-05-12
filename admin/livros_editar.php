<?php
	include_once("../include/connect.php");
	include_once("include/head.html");
	include_once("include/header.php");

	if (isset($_GET['id_book']))
	{
		$id_book = $_GET['id_book'];		
		
		$query = "SELECT books.*, age_group, authors.id_author, authors.first_name, authors.last_name FROM books, age_groups, author_book, authors WHERE books.id_age_group = age_groups.id_age_group AND author_book.id_book = books.id_book AND author_book.id_author = authors.id_author AND books.id_book = '$id_book'";
		$result = mysqli_query($link, $query);
		$row = mysqli_fetch_assoc($result);
	}
?>

		<h1>Edit Book</h1>
		<div class="profile_edit">
			<form action="livros_editar_aux.php?<?php echo "id_book=" . $_GET['id_book']; ?>" method="post" name="livros_inserir" enctype="multipart/form-data">
				<label for="titulo">Title</label>
				<input type="text" id="titulo" name="titulo" value="<?php echo($row['title']); ?>" required>

				<label for="descricao">Description</label>
				<textarea id="descricao" name="descricao" rows="4" required><?php echo($row['description']); ?></textarea>
				
				<label for="tempo">Read Time</label>
				<input type="number" id="tempo" name="tempo" value="<?php echo($row['read_time']); ?>" required>
				
				<label for="idade">Age Group</label>
				<select id="idade" name="idade" required>
					<option value="">Faixa etária</option>
					<option value="1" <?php if ($row['id_age_group'] == 1) echo "selected"; ?>>3-5 years</option>
					<option value="2" <?php if ($row['id_age_group'] == 2) echo "selected"; ?>>6-7 years</option>
					<option value="3" <?php if ($row['id_age_group'] == 3) echo "selected"; ?>>8-9 years</option>
					<option value="4" <?php if ($row['id_age_group'] == 4) echo "selected"; ?>>10-12 years</option>
				</select>
				
				<label for="nivel">Access Level</label>
				<select id="nivel" name="nivel" required>
					<option value="">Access Level</option>
					<option value="Normal" <?php if ($row['access_level'] == "Normal") echo "selected"; ?>>Normal</option>
					<option value="Premium" <?php if ($row['access_level'] == "Premium" ) echo "selected"; ?>>Premium</option>
				</select>
				
				<label for="autor">Author</label>
				<select id="autor" name="autor" required>
					<option value="">Author</option>
					<?php
						$query = "SELECT * FROM authors";
						$result = mysqli_query($link, $query);
						
						while ($row2 = mysqli_fetch_assoc($result)) {
							if ($row['first_name'] == $row2['first_name'] && $row['last_name'] == $row2['last_name']) {
								echo '<option value="' . $row2['id_author'] . '" selected>' . $row2['first_name'] . ' ' . $row2['last_name'] . '</option>';
							}
							else {
								echo '<option value="' . $row2['id_author'] . '">' . $row2['first_name'] . ' ' . $row2['last_name'] . '</option>';
							}
						}
					?>
				</select>
				
				<input type="submit" id="submit" name="submit" class="submit-btn" value="Edit">
			</form>
		</div>
		
		<?php
			if (isset($_GET['erro']))
			{
				echo "<br><span>Erro ao editar livro</span>";
			}
			
			if (isset($_GET['sucesso']))	
			{
		?>
		
		<script>
			alert("Livro editado com sucesso!!!");
		</script>
		
		<?php
			}

			include_once("../include/footer.php");
		?>