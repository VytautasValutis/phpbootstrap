<?php
// GET METODAS
// var_dump($_SERVER['REQUEST_METHOD']);
// var_dump($_GET['fin']);
// var_dump($_COOKIE['sask_nr']);
// die;
$msg = unserialize(file_get_contents(__DIR__ . '/message.ser'));
if(!isset($_GET['fin'])) {
    $nr = 999;
    $sask_nr = '';
} else {
    $nr = (int) $_GET['fin'];
    if(!isset($_COOKIE['sask_nr'])) {
        $sask_nr = '';
        $nr = 901;
    } else {
        $sask_nr = $_COOKIE['sask_nr'];
    };
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>Sarasas</title>
</head>
<body>
    <?php require __DIR__ . '/logo.php' ?>
    <div class="mt-4"style="margin-left: 100px">
        <a type="button" class="btn btn-outline-warning" href="http://localhost/phpbootstrap/u2/sarasas.php">Eiti i sąskaitu sąrašą</a>
        <a type="button" class="btn btn-outline-warning" href="http://localhost/phpbootstrap/u2/naujas.php">Sukurti naują sąskaitą</a>
        <a type="button" class="btn btn-outline-warning" href="http://localhost/phpbootstrap/u2/pridėti.php">Pridėti lėšų</a>
        <a type="button" class="btn btn-outline-warning" href="http://localhost/phpbootstrap/u2/nuskaiciuoti.php">Nuskaičiuoti lėšas</a>
    </div>
    <div class="d-flex justify-content-center mt-5">
    <div class="alert alert-<?= $msg[$nr]['color'] ?>" role="alert">
        <p><?= $msg[$nr]['txt'] ?>  <?= $sask_nr ?></p>
        <p><?= $msg[$nr]['txt2'] ?></p>
    </div>
</div>
</body>
</html>



