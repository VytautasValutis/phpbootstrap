<?php
session_start();
require(__DIR__ . '/ak_valid.php');
define('ENTER', true);
$msg = 'Kuriama nauja sąskaita';
$msg_col = 'black';
$menu_home = 1;
$menu_login = 1;
$menu_new_acc = 0;
$menu_acc_list = 1;
$w_name = '';
$w_surname = '';
$w_ak = '';
$w_sask_nr = '';
// POST METODAS
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sask_nr = $_SESSION['account'];
    $_SESSION['w_name'] = $_POST['name'];
    $_SESSION['w_surname'] = $_POST['surname'];
    $_SESSION['w_ak'] = $_POST['ak'];
    $_SESSION['w_sask_nr'] = $sask_nr;
// Validacija
    if(strlen($_POST['name']) < 3) {
        $_SESSION['msg'] = ['type' => 'error', 'txt' => 'Vartotojo vardas per trumpas'];
        header('Location: ./naujas.php');
        die;
    }
    if(strlen($_POST['surname']) < 3) {
        $_SESSION['msg'] = ['type' => 'error', 'txt' => 'Vartotojo pavardė per trumpa'];
        header('Location: ./naujas.php');
        die;
    }
    if(!ak_valid($_POST['ak'])) {
        $_SESSION['msg'] = ['type' => 'error', 'txt' => 'Asmens kodas neatitinka taisyklių'];
        header('Location: ./naujas.php');
        die;
    }
    $bankas = unserialize(file_get_contents(__DIR__ . '/../db/users.ser'));
    foreach($bankas as $acc) {
        if($acc['ak'] == $_POST['ak']) {
            $_SESSION['msg'] = ['type' => 'error', 'txt' => 'Dubliuojasi asmens kodas'];
            header('Location: ./naujas.php');
            die;
        }
    }
    $_SESSION['w_name'] = '';
    $_SESSION['w_surname'] = '';
    $_SESSION['w_ak'] = '';
    $_SESSION['w_sask_nr'] = '';
    $user = [
        'vardas' => ucfirst($_POST['name']),
        'pavarde' => ucfirst($_POST['surname']),
        'ak' => $_POST['ak'],
        'sask_nr' => $sask_nr,
        'id' => md5($sask_nr),
        'lesos' => 0,
    ];

    $bankas[] = $user;
    $bankas = serialize($bankas);
    file_put_contents(__DIR__ . '/../db/users.ser', $bankas);
    $_SESSION['msg'] = ['type' => 'ok', 'txt' => 'Sukurta nauja sąskaita Nr.'.$sask_nr];
    header('Location: http://localhost/phpbootstrap/u2/bin/sarasas.php');
    die;
}
// GET METODAS
if(!isset($_SESSION['w_sask_Nr'])) {
    $id = json_decode(file_get_contents(__DIR__ . '/../db/id.json'),1);
    $id++;
    file_put_contents(__DIR__ . '/../db/id.json', json_encode($id));
    $sask_nr = 'LT3306660'.sprintf('%1$011d', $id);
    $_SESSION['account'] = $sask_nr;
} else {
    $sask_nr = $_SESSION['w_sask_nr'];
}
if(isset($_SESSION['w_name'])) {
    $w_name = $_SESSION['w_name'];
}
if(isset($_SESSION['w_surname'])) {
    $w_surname = $_SESSION['w_surname'];
}
if(isset($_SESSION['w_ak'])) {
    $w_ak = $_SESSION['w_ak'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>Naujas</title>
    <style>
            form {
            margin-left: 250px;
            margin-top: 20px;
            padding: 20px;
            border: 1px solid black;
            width: 350px;
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
    <?php require __DIR__ . '../../logo.php' ?>
        <form action ="" method="post">
        <fieldset>
            <legend>Sukurti nauja sąskaita</legend>
            <div>
            <label>Saskaita :</label>
            <input type="text" name="sask_nr" value="<?= $sask_nr ?>" disabled><br><br>
    </div>
    <div>
            <label>Vardas :</label>
            <input type="text" name="name" value="<?= $w_name ?>"><br><br>
    </div>
    <div>
            <label>Pavarde:</label>
            <input type="text" name="surname" value="<?= $w_surname ?>"><br><br>
    </div>
    <div>
            <label>Asm.kodas:</label>
            <input type="text" name="ak" value="<?= $w_ak ?>"><br><br>
    </div>
            <button class="btn btn-secondary" type="submit">Patvirtinti</button>
        </fieldset>
    </form>
</div>
</body>
</html>

