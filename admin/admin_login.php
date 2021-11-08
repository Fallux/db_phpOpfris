<?php 

session_start();
include_once ('../include/db_connect.php');
include_once('../include/books.php');
if(isset($_SESSION['logged_in'])) {
    //display index
    $book = new Book;
    $books = $book->fetch_all();
    // if (isset($_GET['id'])) {
    //     $id = $_GET ['id'];
    //     $data = $book->fetch_data($id);

    // header('Refresh: 2; index_opfris.php');
    ?>


<html lang="en">
    <head>
        <title>Beheerder login</title>
        <link rel="stylesheet" href="../style_opfris.css"/>
        <link rel="shortcut icon" href="#"/>
    </head>
    <body>
        <header>
                <h3 id="note">Admin Panel</h3>
                <a href="../index_opfris.php" class="headerLink">home</a>
                <a href="add.php" class="headerLink">boek toevoegen</a>
                <a href="logout.php" class="headerLink">logout</a>
        </header>
        <div class="container">
            <!-- <a href="index_opfris.php" id="logo">CMS</a> -->
            <ol>
            <?php foreach ($books as $book) {?>
                <li>
                    <a class="bookData" href="../book_pagina.php?id=<?php echo $book['book_id']?>">
                     <?php echo $book['title']?></a>
                     <button><a href="update.php?book_id=<?php echo $book['book_id']?>" class="upDateBut">update boek</a></button>
                    
                    
                </li>
            <?php }?>
             </ol>
            
        </div>
    </body>
    </html>





<?php

}else {
    //display login 
    if (isset($_POST['admin_username'], $_POST['password'])) {
        $admin_username = $_POST['admin_username'];
        $password = md5 ($_POST['password']);
        // echo md5('1234');
        if (empty($admin_username) or empty($password)) {
            $error = 'Je moet ALLE velden invullen';
        }else{
            //logt alleen in als je de ? symbolen vervangt met de gegevens van de database
            $query = $pdo->prepare("SELECT * FROM `bibliotheekbeheerder` WHERE admin_username = ? AND password = ?");

            $query->bindValue(1, $admin_username);
            $query->bindValue(2, $password);

            $query->execute();

            $num = $query->rowCount();
            
            if ($num == 1) {
                // user entered correct details
                $_SESSION['logged_in'] = true;
                header('Location: admin_login.php');
                // pagin verlaat niet wat ik wil
                // echo "jfdvibafpbdpgbargbpidfbgvfbgkpsbjlbdkjbkldfkbKJFbdjfbjbfIbsdjfksdfkb";
                exit();
            }else {
                // user entered false details
                $error = 'Je gebruiksnaam of wachtwoord is verkeerd ingetikt.';
            }
        }
    }
    ?>

    <html lang="en">
    <head>
        <title>Beheerder login</title>
        <link rel="stylesheet" href="../style_opfris.css"/>
        <link rel="shortcut icon" href="#"/>
    </head>
    <body>
        <div class="containerAdminLog">
            <!-- <a href="index_opfris.php" id="logo">CMS</a> -->

            <p><a href="../index_opfris.php" id="homeAdmin">home</a></p>
        <?php if (isset($error)) { ?>
            <small style="color:#aa0000;"><?php echo $error; ?></small>
            <br>
            <?php } ?>

            <form action="admin_login.php" method="post" autocomplete="off"/>
                <input type="text" name="admin_username" placeholder="admin_username"  class="loginForm" />
                <input type="password" name="password" placeholder="password"  class="loginForm" />
                <br>
                <input type="submit" value="Login" class="submit" />
            </form>
        </div>
      
    </body>
    </html>

    <?php
}

?>

