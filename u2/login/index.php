<?php
define('ENTER', true);
//POST metodas
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $users = json_decode(file_get_contents(__DIR__ .'/../db/users.json'),1);
    // var_dump($_POST);
    // var_dump($users);
    // die;
    foreach($users as $user) {
        if($user['name'] == $_POST['name'] && $user['psw'] == md5($_POST['psw'])) {
            $_SESSION['logged'] = 1;
            $_SESSION['name'] = $user['name'];
            header('Location: http://localhost/phpProject/015/forest/');
            die;
        }
    }
    $_SESSION['msg'] = ['type' => 'error', 'text' => 'Login failed'];
    header('Location: http://localhost/phpProject/015/login/');
    die;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>Login</title>
    <style>
        form {
            margin: 50px;
            padding: 20px;
            border: 1px solid black;
            width: 300px;
        }
        label {
            width: 100px;
            display: inline-block;
        }
        div {
            margin-bottom: 10px;
        }
    </style>    
</head>
<body>
    <?php
        if(isset($_SESSION['msg'])) {
            $msg = $_SESSION['msg'];
            unset($_SESSION['msg']);
            $color = match($msg['type']) {
                'error' => 'red',
                'ok' => 'blue', 
                'default' => 'gray'
            };
        };
    ?>
    <?php if(isset($msg)) : ?>
        <h2 style="color: red">
            viskas blogai
        </h2>
    <?php endif ?>    
    <?php require(__DIR__ . '/../logo.php') ?>
    <form action="" method="post">
        <div>
            <label>Name:</label>
            <input type="text" name="name">
        </div>
        <div>
            <label>Password:</label>
            <input type="password" name="psw">
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
</body>
</html>