	<?php
		include_once("include/head.html");

		session_start();
	
		if (isset($_SESSION['ID']))
		{
			include_once("include/head_login.php");
		}
		else
		{
			include_once("include/head_normal.html");
		}
		
		include_once("include/connect.php");
	?>

		<div>
			<img style="width:100%;" src="imgs/Floresta.jpg">
		</div>
		<h1>Books</h1>
		<div class="book-list">
			<!-- Book Card -->
				<?php
					$query = "SELECT * FROM books WHERE access_level='Normal' ORDER BY title";
					$result = mysqli_query($link, $query);
				
					while ($row = mysqli_fetch_assoc($result)) {
				?>
				<div class="book-card">
					<img src="upload/livros/<?php echo $row['title'] . '/' . $row['cover_url']; ?>" width="300" height="auto" alt="<?php echo $row['title']; ?>">
					<h3><?php echo $row['title']; ?></h3>
					<a href="livro.php?id_book=<?php echo $row['id_book']; ?>" class="read-btn">READ</a>
				</div>
				
				<?php
					}
					
					$query = "SELECT * FROM books WHERE access_level='Premium' ORDER BY title";
					$result = mysqli_query($link, $query);
				
					while($row = mysqli_fetch_assoc($result)) {
						
				?>
				<!-- Repeat similar structure for other books -->
				<div class="book-card premium">
					<img src="upload/livros/<?php echo $row['title'] . '/' . $row['cover_url']; ?>" width="300" height="auto" alt="<?php echo $row['title']; ?>">
					<h3><?php echo $row['title']; ?></h3>
					<?php
						if (isset($_SESSION['ID']) && $_SESSION['ACCESS'] == 7) {
							echo $_SESSION['ACCESS'];
					?>
					<a href="livro.php?id_book=<?php echo $row['id_book']; ?>" class="read-btn">READ</a>
					<?php
						}

						else
						{
					?>
					<a href="livro.php?id_book=<?php echo $row['id_book']; ?>" class="read-btn">PREVIEW</a>
				</div>
				<?php
					}
				}
				?>
			<!-- Add more cards as needed -->
		</div>

		<?php
			include_once("include/footer.php");
		?>