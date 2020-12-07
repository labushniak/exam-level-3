<?php
include_once 'components/QueryBuilder.php';
include_once 'components/Debug.php';

if(isset($_GET['id'])){
    $post = QueryBuilder::getInstance()->delete('posts', $_GET['id']);

    if($post){
        header('Location: index.php');
    }
}