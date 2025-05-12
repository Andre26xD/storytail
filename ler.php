<?php
	session_start();
	
	include_once("include/head.html");

	if (isset($_SESSION['ID']))
	{
		include_once("include/head_login.php");
	}
	else
	{
		include_once("include/head_normal.html");
	}
	
	include_once("include/connect.php");
	
	$id_book = $_GET['id_book'];
?>
	
		<div class="gallery-container">
			<div class="close">
				<a href="livro.php?id_book=<?php echo $id_book; ?>" class="close-button"><img src="imgs/icons/close_black.png"></a>
			</div>
			<div class="slider-content">
				<?php
					$imagens = "";
				
					$query = "SELECT * FROM books, pages WHERE books.id_book = pages.id_book AND books.id_book='$id_book'";
					$result = mysqli_query($link, $query);
							
					while ($row = mysqli_fetch_assoc($result)) {
						$imagens = $imagens . '<img src="upload/livros/' . $row['title'] . '/' . $row['page_image_url'] . '" width="300" height="390" alt="' . $row['title'] . '">';
					}

					$query = "SELECT * FROM books WHERE id_book='$id_book'";
					$result = mysqli_query($link, $query);
					$row = mysqli_fetch_assoc($result);
					
					echo '<img src="upload/livros/' . $row['title'] . '/' . $row['cover_url'] . '" width="300" height="390" alt="' . $row['title'] . '" class="active">';
					echo $imagens;
				?>
			</div>
			<div class="controls">
				<button class="first"><img src="imgs/icons/first.png"></button>
				<button class="prev"><img src="imgs/icons/prev.png"></button>
				<button class="next"><img src="imgs/icons/next.png"></button>
				<button class="last"><img src="imgs/icons/last.png"></button>

			</div>

			
			<div style="display: flex;flex-direction: column;align-items: center;">
				
			<audio controls>
					<?php echo '<source src="upload/livros/' . $row['title'] . '/' . $row['audio_url'] . '"  type="audio/mpeg" style="display: none;">'; ?>
				</audio>

				<video width="320" height="240" controls>
					<?php echo '<source src="upload/livros/' . $row['title'] . '/' . $row['title'] . '.mp4"  type="video/mp4">'; ?>
				</video>
			</div>
			

		</div>
		<script type="text/javascript">
			document.addEventListener("DOMContentLoaded", () => {
			const sliderContent = document.querySelector(".slider-content");
			const images = sliderContent.querySelectorAll("img");
			const prevButton = document.querySelector(".prev");
			const nextButton = document.querySelector(".next");
			const firstButton = document.querySelector(".first");
			const lastButton = document.querySelector(".last");
			let currentIndex = 0;
			
			const updateSlider = () => {
				prevButton.disabled = (currentIndex === 0);
				firstButton.disabled = (currentIndex === 0);
				nextButton.disabled = (currentIndex === images.length - 1);
				lastButton.disabled = (currentIndex === images.length - 1);

				images.forEach((img, index) => {
					img.classList.toggle("active", index === currentIndex);
				});
			};
			
			firstButton.addEventListener("click", () => {	
				currentIndex = 0;
				updateSlider();
			});

			lastButton.addEventListener("click", () => {	
				currentIndex = images.length - 1;
				updateSlider();
			});

			prevButton.addEventListener("click", () => {	
				if (currentIndex > 0) {
					currentIndex--;
					updateSlider();
				}
			});
			
			nextButton.addEventListener("click", () => {
				if (currentIndex < images.length - 1) {
					currentIndex++;
					
					<?php
						if (isset($_SESSION['ID']))
						{
					?>
					
					const id_book = <?php echo $id_book; ?>;
					const id_user = <?php echo $_SESSION['ID']; ?>;
					
					// AJAX para atualizar a ultima pagina lida
					fetch("book_progress.php", {
						method: "POST",
						headers: {
							"Content-Type": "application/json"
						},
						body: JSON.stringify({
							id_user: id_user, // Substitua pelo ID real do usuário logado
							id_book: id_book, // Substitua pelo ID real do livro
							page_number: currentIndex + 1 // Página atual (1-based)
						})
					})
					.then(response => response.json())
					.then(data => {
						if (data.success) {
							console.log("Página salva com sucesso!");
						} else {
							console.error("Erro ao salvar a página:", data.error);
						}
					})
					
					<?php
						}
					?>
					
					updateSlider();
				}
			});

			updateSlider(); // Initialize
			});
		</script>
	
	<?php
		include_once("include/footer.php");
	?>