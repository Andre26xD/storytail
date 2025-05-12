<?php
    include_once("include/head.html");

    session_start();

    include_once("include/head_login.php");

    $query = "SELECT * FROM book_user_read, books WHERE book_user_read.id_book = books.id_book AND id_user='$id_user'";
    $result = mysqli_query($link, $query);
?>

    <h1>MY BOOKS</h1>
    <table class="books-table" cellspacing="0">
      <tr>
        <th><b>Cover</b></th>
        <th><b>Title</b></th>
        <th><b>Completion</b></th>
        <th><b>Options</b></th>
      </tr>

      <?php
        while ($row = mysqli_fetch_assoc($result)) {
      ?>

      <tr>
        <td class="book-cover"><img src="upload/livros/<?php echo $row['title'] . '/' . $row['cover_url']; ?>"></td>
        <td><span style="font-size: 18px;"><?php echo $row['title']; ?></span></td>
        <td class="book-progress">
            <div class="progress-bar">
                <div class="progress" style="width: <?php echo $row['progress']; ?>%;">
                  <span style="color: white;"><?php echo $row['progress']; ?>%</span>
                </div>
            </div>
            
        </td>
        <td class="book-options">
            <a href="livro.php?id_book=<?php echo $row['id_book']; ?>" class="read-btn">Read now</a>
        </td>
      </tr>

      <?php
        }
      ?>
   
    </table>

    <?php
      include_once("include/footer.php");
    ?>