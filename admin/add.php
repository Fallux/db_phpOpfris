<?php 

session_start();
include_once ('../include/db_connect.php');
include_once ('../include/books.php');

if(isset($_SESSION['logged_in'])) {
    //display page
    if (isset($_POST['title'], $_POST['author'], $_POST['isbn13'], $_POST['format'], $_POST['publisher'], $_POST['pages'], $_POST['dimensions'], $_POST['overview'])) {
        $title      = $_POST['title'];
        $author     = $_POST['author'];
        $isbn13     = $_POST['isbn13'];
        $format     = $_POST['format'];
        $publisher  = $_POST['publisher'];
        $pages      = $_POST['pages'];
        $dimensions = $_POST['dimensions'];
        $overview   = nl2br($_POST['overview']);

        if (empty($title) OR empty($author) OR empty($isbn13) OR empty($format)OR empty($publisher)OR empty($pages)OR empty($dimensions)OR empty($overview)) {
            $error = "<u>het is leeg</u>";
        } else {
            $query = $pdo->prepare("INSERT INTO books (title, author, isbn13, format, publisher, pages, dimensions, overview) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $query->bindValue(1, $title);
            $query->bindValue(2, $author);
            $query->bindValue(3, $isbn13);
            $query->bindValue(4, $format);
            $query->bindValue(5, $publisher);
            $query->bindValue(6, $pages);
            $query->bindValue(7, $dimensions);
            $query->bindValue(8, $overview);

            
            $result = $query->execute();
            if ($result) {
                header('Location: ../index_opfris.php');
            }
           
        }
    }
    ?>

<html lang="en">
    <head>
        <title>Boek toevoegen</title>
        <link rel="stylesheet" href="../style_opfris.css"/>
        <link rel="shortcut icon" href="#"/>
    </head>
    <body>
        <header>
            <h3>boek <span id="toevoegen">toevoegen</span> page</h3>
            <a href="../index_opfris.php" class="headerLink">home</a>   
            <a href="admin_login.php" class="headerLink">admin menu</a> 
        </header>   
        <div class="container">
            <!-- <a href="index_opfris.php" id="logo">CMS</a> -->
            <?php if (isset($error)) { ?>
            <small style="color:#aa0000;"><?php echo $error; ?></small>
            <br>
            <?php } ?>
            <form action="add.php" method="post" autocomplete="off">
                <input type="text" name="title" placeholder="Titel">
                <br>
                <input type="text" name="author" placeholder="Schrijver"><br>
                <input type="text" name="isbn13" placeholder="isbn13"><br>
                <input type="text" name="format" placeholder="format"><br>
                <input type="text" name="publisher" placeholder="publisher"><br>
                <input type="text" name="pages" placeholder="pages"><br>
                <input type="text" name="dimensions" placeholder="dimensions"><br>
                <textarea name="overview" id="" cols="30" rows="10" placeholder = "overview"></textarea>
                <br>
                <input name="submit" type="submit" value="Boek Toevoegen" class="submit" >
                
            </form>
        </div>
    </body>
    </html>




<?php
}else{
    header('Location: ../index_opfris.php');
}
    ?>