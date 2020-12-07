<?php
include_once 'components/QueryBuilder.php';
include_once 'components/Debug.php';

$post = QueryBuilder::getInstance()->getOne('posts', $_GET['id']);



if ($_POST['title']){
    $result = QueryBuilder::getInstance()->update('posts', $_GET['id'], [    
    'title' => $_POST['title']
    ]);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <h1>Edit post</h1>
    <form action="" method="post">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Post title:</span>
            </div>
            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="title" value="<?php echo $post['title']; ?>">
        </div>
        <button type="submit" class="btn btn-danger btn-lg">Edit title</button> 
    </form>
</body>
</html>