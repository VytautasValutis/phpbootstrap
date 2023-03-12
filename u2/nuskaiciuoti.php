<?php
if($_SERVER['REQUEST_METHOD'] == 'GET') {
    if(!isset($_GET['suma'])) {
        die;
    };

    $suma = (int) $_GET['suma'];
    $sask_nr = $_COOKIE['sask_nr'];
    $bankas = unserialize(file_get_contents(__DIR__ . '/users.ser'));
    $acc_key = array_search($sask_nr, array_column($bankas,'sask_nr'));
    $acc_key++;
    $bankas[$acc_key]['lesos'] -= $suma;
    $bankas = serialize($bankas);
    file_put_contents(__DIR__ . '/users.ser', $bankas);
    header('Location: http://localhost/phpbootstrap/u2/sarasas.php');
    die;
}
if(!isset($_GET['sask_nr'])) {
    die;
};
$sask_nr = $_GET['sask_nr'];
$bankas = unserialize(file_get_contents(__DIR__ . '/users.ser'));
$acc_key = array_search($sask_nr, array_column($bankas,'sask_nr'));
$acc_key++;
setcookie('sask_nr', $sask_nr, time() + 300, "/");

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
        <div class="ml-4"style="margin-left: 100px">
        <a type="button" class="btn btn-outline-warning" href="http://localhost/phpbootstrap/u2/sarasas.php">Eiti i saskaitu sarasa</a>
        </div>
        <div class="d-flex justify-content-center mt-5">

        <form action ="" method="get">
        <fieldset>
            <legend>Nuskaičiuoti lėšas nuo sąskaitos</legend>
            <label>Sąskaita :</label>
            <input type="text" name="sask_nr" value="<?= $sask_nr ?>" disabled><br><br>
            <label>Vardas :</label>
            <input type="text" name="name" value="<?= $bankas[$acc_key]['vardas'] ?>" disabled><br><br>
            <label>Pavarde:</label>
            <input type="text" name="surname" value="<?= $bankas[$acc_key]['pavarde'] ?>" disabled><br><br>
            <label>Asm.kodas:</label>
            <input type="text" name="ak" value="<?= $bankas[$acc_key]['ak'] ?>" disabled><br><br>
            <label>Sąskaitos likutis:</label>
            <input type="number" name="likutis" value="<?= $bankas[$acc_key]['lesos'] ?>" disabled><br><br>
            <label>Nuskaičiuojama suma:</label>
            <input type="number" name="suma" ><br><br>
            <button class="btn btn-secondary" type="submit">Patvirtinti</button>
        </fieldset>
    </form>
</div>
</body>
</html>


