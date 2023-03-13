<?php
session_start();
define('ENTER', true);
$msg = 'Kuriama nauja sąskaita';
$msg_col = 'black';
$menu_home = '';
$menu_login = '';
$menu_new_acc = 'invisible';
$menu_acc_list = '';
$wrong_n = '';
// POST METODAS
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sask_nr = $_SESSION['account'];
    $user = [
        'vardas' => $_POST['name'],
        'pavarde' => $_POST['surname'],
        'ak' => $_POST['ak'],
        'sask_nr' => $sask_nr,
        'id' => 0,
        'lesos' => 0,
    ];

    $bankas = unserialize(file_get_contents(__DIR__ . '/../db/users.ser'));
    $bankas[] = $user;
    $bankas = serialize($bankas);
    file_put_contents(__DIR__ . '/../db/users.ser', $bankas);
    $_SESSION['msg'] = ['type' => 'ok', 'txt' => 'Sukurta nauja sąskaita Nr.'.$sask_nr];
    header('Location: http://localhost/phpbootstrap/u2/bin/sarasas.php');
    die;
}
// GET METODAS
    $id = json_decode(file_get_contents(__DIR__ . '/../db/id.json'),1);
    $id++;
    file_put_contents(__DIR__ . '/../db/id.json', json_encode($id));
    $sask_nr = 'LT3306660'.sprintf('%1$011d', $id);
    $_SESSION['account'] = $sask_nr;
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
            width: 300px;
        }
        label {
            width: 100px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <?php require __DIR__ . '../../logo.php' ?>
        <form action ="" method="post">
        <fieldset>
            <legend>Sukurti nauja sąskaita</legend>
            <label>Saskaita :</label>
            <input type="text" name="sask_nr" value="<?= $sask_nr ?>" disabled><br><br>
            <label>Vardas :</label>
            <input type="text" name="name"><br><br>
            <label>Pavarde:</label>
            <input type="text" name="surname"><br><br>
            <label>Asm.kodas:</label>
            <input type="number" name="ak"><br><br>
            <button class="btn btn-secondary" type="submit">Patvirtinti</button>
        </fieldset>
    </form>
</div>
</body>
</html>

