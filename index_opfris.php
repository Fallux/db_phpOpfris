<?php
 include_once('include/db_connect.php');
 include_once('include/books.php');

 $book = new Book;
 $books = $book->fetch_all();

//  print_r($books);
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
    <title>Biblio Roemer</title>
</head>
<body>
    <header>
    <a href="index_opfris.php" class="headerLink">home</a>
    <a href="admin/admin_login.php" class="headerLink">admin login</a>
    <a href="include/db_connect.php" class="headerLink">connection test</a>
    </header>
    <div class="container">
    <ol>
        <?php foreach ($books as $book) {?>
        <li>
            <a href="book_pagina.php?id=<?php echo $book['book_id']?>">
            <?php echo $book['title']?>
            </a>
        </li>
        <?php }?>
    </ol>


    </div>
</body>
</html>