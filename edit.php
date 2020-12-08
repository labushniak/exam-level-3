<?php
include_once 'init.php';

$post = QueryBuilder::getInstance()->getOne('posts', $_GET['id']);

if ($_POST['submit']){
    $validate = new Validate;
    $validate->check($_POST, [
        'title' =>[
            'requiered' => true,
            'min' => 2,
            'max' => 100
        ]
    ]);
    
    if(!$validate->result()){ //true - если валидация не пройдена
        //печать массива с ошибками
        foreach ($validate->errors() as $error){
            $errors .= $error . "<br>";
        }
        Flash::set ('danger', 'Ошибка при редактировании');
    } else {
        $result = QueryBuilder::getInstance()->update('posts', $_GET['id'], [    
        'title' => $_POST['title']
        ]);

        Flash::set ('success', 'Пост отредактирован');
        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Edit post</title>
</head>
<body>
    <h1>Edit post</h1>
<?php 
echo Flash::message('success');
echo Flash::message('danger');
echo $errors ?>

    <form action="" method="post">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Post title:</span>
            </div>
            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="title" value="<?php echo $post['title']; ?>">
        </div>
        <button type="submit" class="btn btn-danger btn-lg" name="submit" value="submit">Edit post</button> 
    </form>
</body>
</html>