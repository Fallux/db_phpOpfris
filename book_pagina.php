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
        <a href="index_opfris.php">home</a>
    <a href="admin/admin_login.php" class="">admin login</a>
    <?php if(isset($_SESSION['logged_in'])){
    ?>
    <button><a href="admin/update.php?book_id=<?php echo $data['book_id']?>">update</a></button>
    <?php } else { ?>
        <a href="admin/update.php?book_id=<?php echo $data['book_id']?>">update blip blop</a>  
    <?php } ?>
    </header>
    <div class="container">
    <h2 class="dataText">Boek ID: <?php echo $data ['book_id']; ?></h2>
    <h2 class="dataText">Titel: <?php echo $data ['title'] ;?></h2>
    <h2 class="dataText">Auteur: <?php echo $data ['author'];?></h2>
    <h2 class="dataText">Isbn: <?php echo $data ['isbn13'];?></h2>
    <h2 class="dataText">Format: <?php echo $data ['format'];?></h2>
    <h2 class="dataText">Uitgeverij: <?php echo $data ['publisher'];?></h2>
    <h2 class="dataText">Aantal pagina's: <?php echo $data ['pages'];?></h2>
    <h2 class="dataText">Afmeting: <?php echo $data ['dimensions'];?></h2>
    <h2 class="dataText">Beschrijving: <?php echo $data ['overview'];?></h2>
    </div>
</body>
</html>

<?php
} else {
    header('Location: index_opfris.php');
    exit();
}
?>