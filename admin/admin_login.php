<?php 

session_start();
include_once ('../include/db_connect.php');

if(isset($_SESSION['logged_in'])) {
    //display index
    ?>


<html lang="en">
    <head>
        <title>Beheerder login</title>
        <link rel="stylesheet" href="../style_opfris.css"/>
        <link rel="shortcut icon" href="#"/>
    </head>
    <body>
        <div class="container">
            <!-- <a href="index_opfris.php" id="logo">CMS</a> -->
            <br>

            <ol>
                <li><a href="add.php">boek toevoegen</a></li>
                <li><a href="update.php">boek wijzigen</a></li>
                <li><a href="logout.php">logout</a></li>
            </ol>
        </div>
    </body>
    </html>





<?php

}else {
    //display login 
    if (isset($_POST['admin_username'], $_POST['password'])) {
        $admin_username = $_POST['admin_username'];
        $password = md5($_POST['password']);
        if (empty($admin_username) or empty($password)) {
            $error = 'je moet ALLE velden invullen';
        }else{
            //logt alleen in als je de ? symbolen vervangt met de gegevens van de database
            $query = $pdo->prepare("SELECT * FROM `bibliotheekbeheerder` WHERE admin_username = 'gerald12' AND password = 1224");

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
        <div class="container">
            <!-- <a href="index_opfris.php" id="logo">CMS</a> -->

            <br>

        <?php if (isset($error)) { ?>
            <small style="color:#aa0000;"><?php echo $error; ?></small>
            <br>
            <?php } ?>

            <form action="admin_login.php" method="post" autocomplete="off">
                <input type="text" name="admin_username" placeholder="admin_username" />
                <input type="password" name="password" placeholder="password" />
                <input type="submit" value="Login" />
            </form>
        </div>
        <h4><a href="boek_toevoegen.php">boek_toevoegen.php</a></h4>
    </body>
    </html>

    <?php
}

?>

