<?php
define('ENTER', true);
$msg = 'Login puslapis';
$msg_col = 'black';
$menu_home = '';
$menu_login = 'invisible';
$menu_new_acc = 'invisible';
$menu_acc_list = 'invisible';
$wrong_n = '';

session_start();
//POST metodas
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $users = json_decode(file_get_contents(__DIR__ .'/../db/users.json'),1);
    // var_dump($_POST);
    // var_dump($users);
    // die;
    foreach($users as $user) {
        if($user['name'] == $_POST['name'] && $user['psw'] == md5($_POST['psw'])) {
            $_SESSION['logged'] = 1;
            $_SESSION['name'] = $user['name'];
            $_SESSION['msg'] = ['type' => 'ok', 'txt' => 'Prisijungta sėkmingai'];
            header('Location: http://localhost/phpbootstrap/u2/bin/sarasas.php');
            die;
        }
    }
    $_SESSION['msg'] = ['type' => 'error', 'txt' => 'Neteisingas prisijungimo vardas arba slaptažodis'];
    $_SESSION['wrong_n'] = $_POST['name'];
    header('Location: http://localhost/phpbootstrap/u2/login/');
    die;
}
// GET metodas
if(isset($_SESSION['wrong_n'])) {
    $wrong_n = $_SESSION['wrong_n'];
    unset($_SESSION['wrong_n']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>Login</title>
    <style>
        form {
            margin-left: 100px;
            margin-top: 50px;
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
    <?php require(__DIR__ . '/../logo.php') ?>
    <form action="" method="post">
        <div>
            <label>Vardas:</label>
            <input type="text" name="name" value="<?= $wrong_n ?>">
        </div>
        <div>
            <label>Slaptažodis:</label>
            <input type="password" name="psw">
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
</body>
</html>