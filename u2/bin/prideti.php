<?php
session_start();
$menu_home = 1;
$menu_login = 0;
$menu_new_acc = 1;
$menu_acc_list = 1;
$msg = 'Pridėti lėšų prie sąskaitos';
$msg_col = 'black';
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(!isset($_GET['suma'])) {
        die;
    };

    $suma = (int) $_GET['suma'];
    $sask_nr = $_COOKIE['sask_nr'];
    $bankas = unserialize(file_get_contents(__DIR__ . '/../db/users.ser'));
    $acc_key = array_search($sask_nr, array_column($bankas,'sask_nr'));
    $acc_key++;
    $bankas[$acc_key]['lesos'] += $suma;
    $bankas = serialize($bankas);
    file_put_contents(__DIR__ . '/../db/users.ser', $bankas);
    header('Location: http://localhost/phpbootstrap/u2/sarasas.php');
    die;
}
if(!isset($_GET['sask_nr'])) {
    die;
};
$sask_nr = $_GET['sask_nr'];
$bankas = unserialize(file_get_contents(__DIR__ . '/../db/users.ser'));
$acc_key = array_search($sask_nr, array_column($bankas,'sask_nr'));
$acc_key++;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>Prideti</title>
    <style>
        form {
            margin-left: 250px;
            margin-top: 30px;
            padding: 20px;
            border: 1px solid black;
            width: 450px;
        }
        label {
            width: 150px;
            display: inline-block;
        }
        div {
            margin-bottom: -10px;
        }
    </style>
</head>
<body>
    <?php require __DIR__ . '../../logo.php' ?>
        <form action ="" method="post">
        <fieldset>
            <legend>Pridėti lėšų į sąskaitą</legend>
            <div>
                <label>Sąskaita :</label>
                <input type="text" name="sask_nr" value="<?= $sask_nr ?>" disabled><br><br>
            </div>
            <div>
                <label>Vardas :</label>
                <input type="text" name="name" value="<?= $bankas[$acc_key]['vardas'] ?>" disabled><br><br>
            </div>
            <div>
                <label>Pavardė:</label>
                <input type="text" name="surname" value="<?= $bankas[$acc_key]['pavarde'] ?>" disabled><br><br>
            </div>
            <div>
                <label>Asm.kodas:</label>
                <input type="text" name="ak" value="<?= $bankas[$acc_key]['ak'] ?>" disabled><br><br>
            </div>
            <div>
                <label>Sąskaitos likutis:</label>
                <input type="number" name="likutis" value="<?= $bankas[$acc_key]['lesos'] ?>" disabled><br><br>
            </div>
            <div>
                <label>Įnešama suma:</label>
                <input type="number" name="suma" ><br><br>
            </div>
            <button class="btn btn-secondary" type="submit">Patvirtinti</button>
        </fieldset>
    </form>
</body>
</html>

