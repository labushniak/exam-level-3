<?php
include_once '../init.php';

$file = Router::page ($_SERVER['REQUEST_URI']);
include_once $file; exit;

include_once '../index.view.php';
?>