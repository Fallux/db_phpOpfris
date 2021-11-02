<?php
session_start();
include_once ('../include/db_connect.php');
include_once ('../include/books.php');
if(isset($_SESSION['logged_in'])) {
    //display page
    if (isset($_POST['submit']) && $_POST['submit'] != '') {
        $title      = $_POST['title'];
        $author     = $_POST['author'];
        $isbn13     = $_POST['isbn13'];
        $format     = $_POST['format'];
        $publisher  = $_POST['publisher'];
        $pages      = $_POST['pages'];
        $dimensions = $_POST['dimensions'];
        $overview   = $_POST['overview'];
        $query1 = prepare("UPDATE books SET `title` = ?, `author`= ?, `format` = ?, `publisher` = ?, `pages` = ?, `dimensions` = ?, `overview` = ? WHERE isbn13 = ? LIMIT 1;");
        if ($query1 === false) {
            echo mysqli_error($pdo);
        }
        $query1->bind_param('sssssssi',$title,$author,$format,$publisher,$pages,$dimensions,$overview,$isbn);
        if ($query1->execute() === false) {
            echo mysqli_error($pdo);
        } else {
            echo '<div style="border: 2px solid red">Edited product</div>';
            header('Refresh: 2; index.php');
        }
        $query1->close();
    }
?>

<html lang="en">
    <head>
        <title>Boek toevoegen</title>
        <link rel="stylesheet" href="../style_opfris.css"/>
        <link rel="shortcut icon" href="#"/>
    </head>
    <form action="" method="POST">
        <?php
        if (isset($_GET['isbn']) && $_GET['isbn'] != '') {
            $isbn = $pdo->real_escape_string($_GET['isbn']);

            $liqry = $pdo->prepare("SELECT `title`, `author`, `isbn13`, `format`, `publisher`, `pages`, `dimensions`, `overview` FROM books WHERE isbn13 = ? LIMIT 1;");
            if($liqry === false) {
                echo mysqli_error($pdo);
            } else{
                $liqry->bind_param('i',$isbn);
                $liqry->bind_result($title, $author, $isbn, $format, $publisher, $pages, $dimensions, $overview);
                if($liqry->execute()){
                    $liqry->store_result();
                    $liqry->fetch();
                    if($liqry->num_rows == '1'){
                        $columns = array('title', 'author', 'isbn', 'format', 'publisher', 'pages', 'dimensions', 'overview');
                        foreach ($columns as $key) {
                            $typeInput = "input";
                            $read = "";
                            $txtOrNum = "text";
                            if ($key == 'isbn') {
                                $read = "readonly";
                            }
                            if ($key == 'overview'){
                                $typeInput = "textarea";
                            }
                            if ($key == 'pages') {
                                $txtOrNum = "number";
                            }
                            echo '<b>' . $key .'</b> :<'.$typeInput.' type="' . $txtOrNum . '" name="'.$key.'" value="' . $$key . '" '.$read.'>';
                            if ($typeInput == "textarea") {
                                echo $$key.'</textarea><br>';
                            } else{
                                echo '<br>';
                            }
                        }


                    }
                }
            }
            $liqry->close();

        }
        ?>
        <br>
        <input type="submit" name="submit" value="Save">
        <a href="../index_opfris.php">Go back</a>
    </form>
<?php
}else{
    header('Location: ../index_opfris.php');
}
    ?>