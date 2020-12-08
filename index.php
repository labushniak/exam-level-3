<?php
session_start();
include_once 'components/QueryBuilder.php';
include_once 'components/Debug.php';
include_once 'components/Flash.php';

$posts = QueryBuilder::getInstance()->getAll('posts');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">My Blog</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>     
    </ul>
  </div>
</nav>
<?php 

echo Flash::message('success'); 
?>
<div class="container">
  <div class="row">
      <a href="addpost.php" class="btn btn-success">Add post</a>
          
      </a>
            <table class="table">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post):?>
                <tr>
                <th scope="row"><?php echo $post['id']?></th>
                <td><?php echo $post['title']?></td>
                <td><a href="edit.php?id=<?php echo $post['id']?>" class="btn btn-info">edit</a>
                    <a href="deletepost.php?id=<?php echo $post['id']?>"class="btn btn-danger">delete</a></td>
                </tr>
                <? endforeach; ?>
            </tbody>
            </table>
  </div>
</div>
</body>
</html>