<?php
class QueryBuilder
{
    private static $instance = NULL;
    private $pdo;

    public function __construct()
    {
       $this->pdo = new PDO ('mysql:host=127.0.0.1;dbname=level_3_1', 'root', 'root'); 
    }

    public static function getInstance()
    {
        if(!self::$instance){
            self::$instance = new QueryBuilder();
        }
        return self::$instance;
    }

    public function getAll ($table){
        $sql = "SELECT * FROM {$table}";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }

    public function getOne ($table, $id){
        $sql = "SELECT * FROM {$table} WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $post = $statement->fetch(PDO::FETCH_ASSOC);
        return $post;
    }    

}
