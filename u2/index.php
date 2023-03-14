<?php define('ENTER', true); 
session_start();
$_SESSION['msg'] = ['type' => 'default', 'txt' => 'Sveiki atvykę'];
$menu_home = 0;
$menu_login = 1;
$menu_new_acc = 0;
$menu_acc_list = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
<title>Main</title>
</head>
<body>
    <?php require(__DIR__ . '/logo.php') ?>
</body>
</html>