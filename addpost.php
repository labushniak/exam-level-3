<?php
session_start();
include_once 'components/QueryBuilder.php';
include_once 'components/Debug.php';
include_once 'components/Validate.php';
include_once 'components/Flash.php';

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
        Flash::set ('danger', 'Пост не добавлен');
        } else { //если валидация пройдена

        $result = QueryBuilder::getInstance()->insert('posts', [    
        'title' => $_POST['title'],
        ]);
        Flash::set ('success', 'Пост добавлен');
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
    <title>Add post</title>
</head>
<body>

<?php 
echo Flash::message('danger');
echo $errors;
?>
    <h1>Add post</h1>
    <form action="" method="post">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Post title:</span>
            </div>
            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="title" value="<?php echo $post['title']; ?>">
        </div>
        <button type="submit" class="btn btn-danger btn-lg" name="submit" value="submit">Add post</button> 
    </form>
</body>
</html>