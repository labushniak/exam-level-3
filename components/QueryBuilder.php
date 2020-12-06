<?php
class QueryBuilder
{
    public static function getAll ($table){
        $pdo = new PDO ('mysql:host=127.0.0.1;dbname=level_3_1', 'root', 'root');
        $sql = "SELECT * FROM {$table}";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }

}
