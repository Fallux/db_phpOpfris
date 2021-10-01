<?php


if(isset($_SESSION['logged_in'])) {
     // display add page
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

            <h4>Boek toevoegen</h4>

            <form action="book_toevoegen.php" method="post" autocomplete="off">
                <input type="text" name="titel" placeholder="titel" id="">
                <textarea id="" cols="30" rows="30" placeholder="beschrijving" name="beschrijving"></textarea>

            </form>
        </div>
    </body>
    </html>
    <?php
} else {
    header('Location: admin_login.php');
}
    



?>