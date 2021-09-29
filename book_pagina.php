<?php
 include_once('include/db_connect.php');
 include_once('include/books.php');

if (isset($_GET['id'])) {
    $id = $GET ['id'];
} else {
    header('Location: index_opfris.php');
    exit();
}
?>