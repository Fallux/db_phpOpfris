<?php 

session_start();
include_once ('../include/db_connect.php');

if(isset($_SESSION['logged_in'])) {
    //display index
}else {
    //display login 
    if (isset($_POST['email'], $_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        if (empty($email) or empty($password)) {
            $error = 'je moet ALLE velden invullen';
        }else{
            $query = $pdo->prepare("SELECT * FROM bibliotheek_leden WHERE email = ? AND password = ?");

            $query->bindValue(1, $email);
            $query->bindValue(2, $password);

            $query->execute();

            $num = $query->rowCount();
            
            if ($num == 1) {
                // user entered correct details
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
                <input type="mail" name="email" placeholder="email" />
                <input type="password" name="password" placeholder="password" />
                <input type="submit" value="Login" />
            </form>
        </div>
    </body>
    </html>

    <?php
}

?>

