<?php
	session_start();

	include_once("include/head.html");

	if (isset($_SESSION['ID']))
	{
		include_once("include/head_login.php");
		$id_user = $_SESSION['ID'];
	}
	else
	{
		include_once("include/head_normal.html");
	}
	
	include_once("include/connect.php");
	
	$id_book = $_GET['id_book'];
	
	$query = "SELECT books.*, authors.*, COUNT(id_page) AS paginas FROM authors, books, author_book, pages WHERE authors.id_author = author_book.id_author AND books.id_book = author_book.id_book AND books.id_book = pages.id_book AND books.id_book='$id_book'";
	$result = mysqli_query($link, $query);
	$row = mysqli_fetch_assoc($result);
?>
		<h1 style="font-family: Arial; color: black; font-size: 36px;"><?php echo $row['title']; ?></h1>
		<div class="book-links">
			<a href="#" class="menu-item active" data-section="section-about"><h2>About this book</h2></a>
			<a href="#" class="menu-item" data-section="section-activities"><h2>Tail it Yourself</h2></a>
		</div>
		
		<div class="container">
			<h1 id="titulo">ABOUT</h1>
			<div class="section-about section-active" id="section-about">
				<img src="upload/livros/<?php echo $row['title'] . '/' . $row['cover_url']; ?>" width="auto" height="260" alt="<?php echo $row['title']; ?>">	
				<div class="book-info">
					<h2><?php echo $row['title']; ?></h2>
					<p><b>From: <span style="color: #E95A0C;"><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></span></b></p>
					<p><img src="imgs/icons/book.png"><?php echo ' ' . $row['paginas'] + 1 . ' pages '; ?>
					<img src="imgs/icons/clock.png"><?php echo ' ' . $row['read_time'] .  ' minutes'; ?>
					
					<?php
						if (isset($_SESSION['ID']))
						{
							if (($row['access_level'] == "Premium" && $_SESSION['ACCESS'] == 7) ||  ($row['access_level'] == "Normal" && ($_SESSION['ACCESS'] == 6 || $_SESSION['ACCESS'] == 7))) {
								$query = "SELECT * FROM book_user_favorite WHERE id_book='$id_book' AND id_user='$id_user'";
								$result = mysqli_query($link, $query);

								if (mysqli_num_rows($result) == 0)
								{
									echo '<a href="favorite.php?id_book=' . $id_book . '"><img src="imgs/icons/empty_heart.png" class="full-heart"></a> Favorites</p>';
								}
								else
								{
									echo '<a href="favorite_remove.php?id_book=' . $id_book . '"><img src="imgs/icons/full_heart.jpg" class="empty-heart"></a> Favorites</p>';
								}

								$query = "SELECT rating FROM book_user_read WHERE id_book='$id_book' AND id_user='$id_user'";
								$result = mysqli_query($link, $query);
								$row4 = mysqli_fetch_assoc($result);

								for($i = 1; $i <= 5; $i++)
								{
									if ($row4['rating'] >= $i) {
										echo '<a href="rating.php?id_book=' . $id_book . '&estrela=' . $i . '"><img src="imgs/icons/star.png" id="estrela' . $i .'"></a>';
									}
									else
									{
										echo '<a href="rating.php?id_book=' . $id_book . '&estrela=' . $i . '"><img src="imgs/icons/star_empty.png" id="estrela' . $i .'"></a>';
									}
								}
							}
						}
					?>
					
					<p><?php echo $row['description']; ?></p><br>

					<?php
						if ($row['access_level'] == "Premium") {
							if (isset($_SESSION['ID']) && $_SESSION['ACCESS'] == 7) {
					?>

					<a href="ler.php?id_book=<?php echo $row['id_book']; ?>" class="read-btn">Read now</a>

					<?php
							}

							else
							{
					?>

					<a href="ler.php?id_book=<?php echo $row['id_book']; ?>" class="read-btn disabled-link">Read now</a>

					<?php
							}
						}
						else
						{
					?>

					<a href="ler.php?id_book=<?php echo $row['id_book']; ?>" class="read-btn">Read now</a>

					<?php
						}
					?>
				</div>
			</div>
		
			<?php
				$query = "SELECT * FROM activities, activity_book WHERE activities.id_activity = activity_book.id_activity AND id_book='$id_book'";
				$result = mysqli_query($link, $query);
						
				while ($row2 = mysqli_fetch_assoc($result)) {
					$id_activity_book = $row2['id_activity_book'];
			?>

			<div class="section-activities" id="section-activities">
				<div class="activity">
					<div class="activity-header">
						<div class="status">
							<?php
								if (isset($_SESSION['ID']))
								{
									if (($row['access_level'] == "Premium" && $_SESSION['ACCESS'] == 7) ||  ($row['access_level'] == "Normal")) {
										$query = "SELECT * FROM activity_book_user WHERE id_activity_book = '$id_activity_book' AND id_user='$id_user'";
										$result = mysqli_query($link, $query);

										if (mysqli_num_rows($result) == 0)
										{
											echo '<a href="activity_completed.php?id_activity_book=' . $id_activity_book . '&id_book=' . $id_book . '"><img src="imgs/icons/grey_check.png" class="hover-image"></a>';
										}
										else
										{
											echo '<img src="imgs/icons/green_check.png">';
										}
									}
								}
							?>
						</div>
						<h3><?php echo $row2['title']; ?></h3>
						<button class="toggle-btn"><img src="imgs/icons/plus.png" alt="Plus" class="toggle-icon"></button>
					</div>
					<div class="activity-content" style="display: none;">
						<p style="font-size: 14px;"><?php echo $row2['description']; ?></p>
					</div>
				</div>
				
				<?php
					}
				?>
			</div>
		</div>
		
		<script type="text/javascript">
			// Seleciona todos os botões de alternância
			const toggleButtons = document.querySelectorAll('.toggle-btn');

			toggleButtons.forEach((button) => {
				button.addEventListener('click', () => {
				// Encontra o conteúdo associado
				const activityContent = button.parentElement.nextElementSibling;
				
				const icon = button.querySelector('.toggle-icon');

				// Alterna a exibição do conteúdo
				if (activityContent.style.display === 'none' || activityContent.style.display === '') {
					activityContent.style.display = 'block';
					icon.src = 'imgs/icons/minus.png'; // Caminho para a imagem do ícone de menos
					icon.alt = 'Minus';
				} else {
					activityContent.style.display = 'none';
					icon.src = 'imgs/icons/plus.png'; // Caminho para a imagem do ícone de menos
					icon.alt = 'Plus';
				}
				});
			});

			const menuItems = document.querySelectorAll('.menu-item');

			// Adiciona um evento de clique a cada item
			menuItems.forEach(item => {
				item.addEventListener('click', () => {

					// Remove a classe 'active' de todos os itens
					menuItems.forEach(i => i.classList.remove('active'));
					// Adiciona a classe 'active' ao item clicado
					item.classList.add('active');
					
					const activeMenuItem = document.querySelector('.menu-item.active');

					if (activeMenuItem.textContent == "About this book") {
						document.getElementById('titulo').innerText = "ABOUT";
					}
					else if (activeMenuItem.textContent == "Tail it Yourself") {
						document.getElementById('titulo').innerText = "ACTIVITIES";
					}

					// Esconde todas as seções
					const allSections = document.querySelectorAll('[class^="section-"]'); // Seleciona todas as seções com prefixo "section-"
					allSections.forEach(section => section.classList.remove('section-active'));

					// Mostra a seção correspondente ao item clicado
					const sectionClass = item.getAttribute('data-section');
					const targetSection = document.querySelector(`.${sectionClass}`);
					if (targetSection) {
						targetSection.classList.add('section-active');
					}
				});
			});
		</script>
		
		<?php
			if (isset($_GET['erro']))
			{
				echo "<br><span>Erro ao completar atividade</span>";
			}
			
			if (isset($_GET['sucesso']))	
			{
		?>
		
		<script>
			alert("Parabens completou esta atividade!!");
		</script>
		
		<?php
			}

			include_once("include/footer.php");
		?>