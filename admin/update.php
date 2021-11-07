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
        $overview   = $_POST['overview'];
        $query1 = $pdo->prepare("UPDATE books SET `title` = :title, `author`= :author, `isbn13` = :isbn13, `format` = :format, `publisher` = :publisher, `pages` = :pages, `dimensions` = :dimensions, `overview` = :overview WHERE isbn13 = :isbn13 LIMIT 1;");
        if ($query1 === false) {
            // echo mysqli_error($pdo);
            echo "pdo error";
        }
        // ,$,$format,$publisher,$pages,$dimensions,$overview,$isbn
        $query1->bindParam(':title',$title);
        $query1->bindParam(':author',$author);
        $query1->bindParam(':isbn13',$isbn13);
        $query1->bindParam(':format',$format);
        $query1->bindParam(':publisher',$publisher);
        $query1->bindParam(':pages',$pages);
        $query1->bindParam(':dimensions',$dimensions);
        $query1->bindParam(':overview',$overview);
        
        if ($query1->execute() === false) {
            // echo mysqli_error($pdo);
            echo "pdo error";
        } else {
            echo '<div style="border: 2px solid red">Edited product</div>';
            // header('Refresh: 2; index_opfris.php');
        }
        $liqry = null;
    }
?>

<html lang="en">
    <head>
        <title>Boek updaten</title>
        <link rel="stylesheet" href="../style_opfris.css"/>
        <link rel="shortcut icon" href="#"/>
    </head>
    <form action="" method="POST">
        <?php
        if (isset($_GET['book_id']) && $_GET['book_id'] != '') {
            $book_id = $_GET['book_id'];

            $liqry = $pdo->prepare("SELECT `title`, `author`, `isbn13`, `format`, `publisher`, `pages`, `dimensions`, `overview` FROM books WHERE book_id = :book_id LIMIT 1;");
            if($liqry === false) {
                // echo mysqli_error($pdo);
                echo "pdo error";
            } else{
                $liqry->bindParam(':book_id',$book_id);
                // $liqry->bind_result($title, $author, $isbn13, $format, $publisher, $pages, $dimensions, $overview);
                if($liqry->execute()){
                    // $liqry->store_result();
                    $result = $liqry->fetchAll();
                    if($liqry->rowCount() == 1){
                        
                        //print_r(array_keys($result[0]));
                        
                        foreach ($result[0] as $key => $value) {
                            if (!is_int($key)) {
                                echo "<input type='text' name='" . $key . "'value ='" . $value . "'>" . "<br>"; 
                                // print_r("key: " . $key . "<br>");
                                // print_r("value: " . $value . "<br>");
                            }
                        }
                        $pdo = null;
                    }
                }
            }
            

        }
        ?>
        <br>
        <input type="submit" name="submit" value="Save">
        <a href="../index_opfris.php">Go back</a>
    </form>
<?php
}
else{
    echo "you must in as admin";
    header('Refresh: 2; ../index_opfris.php');

}
    ?>