<?php
 include_once('include/db_connect.php');
 include_once('include/books.php');

$book = new Book;


if (isset($_GET['id'])) {
    $id = $_GET ['id'];
    $data = $book->fetch_data($id);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_opfris.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Courier+Prime&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300&display=swap" rel="stylesheet">
    <title><?php echo $data ['title'] . " ";?>lenen</title>
</head>
<body>
    <header>
        <a href="index_opfris.php" class="headerLink">home</a>
        <a href="admin/admin_login.php" class="headerLink">admin login</a>

    
        <a href="admin/update.php?book_id=<?php echo $data['book_id']?>" class="headerLink">update boek</a>  
    </header>
    <div class="container">
    <h2 class="dataTitle">Boek ID: <?php echo "<span class='dataText'>" . $data ['book_id'] . "</span>";?></h2>
    <h2 class="dataTitle">Titel: <?php echo "<span class='dataText'>" . $data ['title'] . "</span>";?></h2>
    <h2 class="dataTitle">Auteur: <?php echo "<span class='dataText'>" . $data ['author'] . "</span>";?></h2>
    <h2 class="dataTitle">Isbn: <?php echo "<span class='dataText'>" . $data ['isbn13'] . "</span>";?></h2>
    <h2 class="dataTitle">Format: <?php echo "<span class='dataText'>" . $data ['format'] . "</span>";?></h2>
    <h2 class="dataTitle">Uitgeverij: <?php echo "<span class='dataText'>" . $data ['publisher'] . "</span>";?></h2>
    <h2 class="dataTitle">Aantal pagina's: <?php echo "<span class='dataText'>" . $data ['pages'] . "</span>";?></h2>
    <h2 class="dataTitle">Afmeting: <?php echo "<span class='dataText'>" . $data ['dimensions'] . "</span>";?></h2>
    <h2 class="dataTitle">Beschrijving: <?php echo "<span class='dataText'>" . $data ['overview'] . "</span>";?></h2>
    </div>
</body>
</html>

<?php
} else {
    header('Location: index_opfris.php');
    exit();
}
?>