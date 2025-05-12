	<body>
		<header class="header">
			<div class="logo"><a href="index.php"><img src="imgs/logo.png" width="100" height="100"></a></div>
			<div class="search-bar">
				<input type="text" placeholder="eg. title, type...">
				<button><img src="imgs/icons/search.png"></button>
			</div>
			<nav class="links">
				<div class="home">
					<a href="index.php"><b>Home</b></a>
				</div>
				
				<div class="user-menu">
					<?php
						include_once("include/connect.php");

						$id_user = $_SESSION['ID'];

						$query = "SELECT user_photo_url FROM users WHERE id_user='$id_user'";
						$result = mysqli_query($link, $query);
						$row = mysqli_fetch_assoc($result);

						echo '<a class="profile" href=""><img src="upload/users/'
						. $row['user_photo_url'] . 
						'" width="50" height="50"></a>';
					?>

					<div class="dropdown">
						<a href="perfil.php?id_user=<?php echo $id_user; ?>">Edit Profile</a>
						<a href="books.php">Books Progess</a>
						<a href="books_favorite.php">My Favourites</a>
						<a href="logout.php">Logout</a>
					</div>
				</div>
			</nav>
		</header>