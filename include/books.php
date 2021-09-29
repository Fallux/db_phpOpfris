<?php
class Book {
    public function fetch_all(){
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM `books`"); //Alles selecteren van de database server
        $query->execute();

        return $query->fetchAll(); //het eruit halen van de data van de database
    }
    public function fetch_data($article_id){
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM `books` WHERE book_id = ?");
        $query->bindValue(1, $article_id);
        $query->execute();

        return $query->fetch();
    }
}
?>