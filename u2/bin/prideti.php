<?php
session_start();
$menu_home = 1;
$menu_login = 0;
$menu_new_acc = 1;
$menu_acc_list = 1;
$msg = 'Pridėti lėšų prie sąskaitos';
$msg_col = 'black';
if(!isset($_GET['sask_nr'])) {
    $_SESSION['msg'] = ['type' => 'error', 'txt' => 'Nenurodytas sąskaitos Nr.'];
    header('Location: ./sarasas.php');
    die;
};
$sask_nr = $_GET['sask_nr'];
// POST Metodas
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(!isset($_POST['suma'])) {
        $_SESSION['msg'] = ['type' => 'error', 'txt' => 'Nenurodytos lėšos'];
        header('Location: ./prideti.php?sask_nr='.$sask_nr);
        die;
    };

    $suma = (int) $_POST['suma'];
    if($suma < 0) {
        $_SESSION['msg'] = ['type' => 'error', 'txt' => 'Suma negali būti neigiamas skaičius'];
        header('Location: ./prideti.php?sask_nr='.$sask_nr);
        die;
    }
    // toliau turi eiti sumos validacija
    $bankas = unserialize(file_get_contents(__DIR__ . '/../db/users.ser'));
    $find = false;
    foreach($bankas as $acc) {
        if($acc['sask_nr'] == $sask_nr) {
            $acc['lesos'] += $suma;
            $bankas = array_filter($bankas, fn($bnk) => $bnk['sask_nr'] != $sask_nr);
            $bankas[] = $acc;
            $bankas = serialize($bankas);
            file_put_contents(__DIR__ . '/../db/users.ser', $bankas);
            // $bankas[] = $acc;
            $_SESSION['msg'] = ['type' => 'ok', 'txt' => 'Saskaita '.$sask_nr.' papildyta '.$suma.' lėšų'];
            header('Location: ./sarasas.php');
            die;
        }
    }
    if(!$find) {
        $_SESSION['msg'] = ['type' => 'error', 'txt' => 'Neteisingai nurodyta sąskaita'];
        header('Location: ./sarasas.php');
        die;
    }
}
// GET Metodas
$bankas = unserialize(file_get_contents(__DIR__ . '/../db/users.ser'));
$find = false;
foreach($bankas as $acc) {
    if($acc['sask_nr'] == $sask_nr) {
        $find = true;
        break;
    }
}
if(!$find) {
    $_SESSION['msg'] = ['type' => 'error', 'txt' => 'Neteisingai nurodyta sąskaita'];
    header('Location: ./sarasas.php');
    die;
}
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
                <input type="text" name="name" value="<?= $acc['vardas'] ?>" disabled><br><br>
            </div>
            <div>
                <label>Pavardė:</label>
                <input type="text" name="surname" value="<?= $acc['pavarde'] ?>" disabled><br><br>
            </div>
            <div>
                <label>Asm.kodas:</label>
                <input type="text" name="ak" value="<?= $acc['ak'] ?>" disabled><br><br>
            </div>
            <div>
                <label>Sąskaitos likutis:</label>
                <input type="text" name="likutis" value="<?= $acc['lesos'] ?>" disabled><br><br>
            </div>
            <div>
                <label>Įnešama suma:</label>
                <input type="text" name="suma" ><br><br>
            </div>
            <button class="btn btn-secondary" type="submit">Patvirtinti</button>
        </fieldset>
    </form>
</body>
</html>

