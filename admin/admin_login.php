<?php 

session_start();

include_once ('../include/db_connect.php');

if(isset($_SESSION['logged_in'])) {
//display index
echo"testetst";
} else {
    if (isset($_POST['email'], $_POST['password'])) {
        $admin_username  =  $_POST['email'];
        $password  =  $_POST['password'];
        
        if (empty($admin_username) or empty ($password)) {
            $error = 'Alle velden moet verplicht ingevuld zijn!';
        }else{
            $query = $pdo->prepare("SELECT * FROM `bibliotheek_leden` WHERE email = ? password = ?");
            $query->bindValue(1, $mail);
            $query->bindValue(2, $password);

            $query->execute();

            $num = $query->rowCount();

            if ($num ==1) {
                # user entered correct details
            }else{
                #user entered false details
                $error = 'Incorrect Details';
            }
        }
    }
}

?>
<html lang="en">
<head>
    <title>Beheerder login</title>
    <link rel="stylesheet" href="../style_opfris.css">
</head>
<body>
    <div class="container">
    <br>
        <?php if (isset($error)) { ?>
            <h3 id="errorKleur"><?php echo $error; ?>hello world</h3>
            <?php } ?>
            <br>
    <form action="admin_login.php" method="post"></form>
    <input type="mail" name="e-mail" placeholder="e-mail">
    <input type="password" name="wachtwoord" placeholder="Wachtwoord">
    <input type="submit" value="login" />
    </div>
</body>
</html>