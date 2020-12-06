<?php
include_once 'components/QueryBuilder.php';
include_once 'components/Debug.php';

$post = QueryBuilder::getOne('posts', 1);
dd($post);