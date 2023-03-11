<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(!isset($_POST['go'])) {
        $dice = rand(1,6);
        header('Location: http://localhost/phpbootstrap/711/zaidimas.php?go='.$dice);
        die;
    } else {
        $game = unserialize(file_get_contents(__DIR__ . '/game.ser'));
        if($game['rid2'] < $game['rid1']) {
            $game['rid2']++;
            $game['taskai2'] += (int) $_GET['go'];
        } else {
            $game['rid1']++;
            $game['taskai1'] += (int) $_GET['go'];
        }
        $did = max($game['taskai1'],$game['taskai2']);
        $game = serialize($game);
        file_put_contents(__DIR__ . '/game.ser', $game);
        if($did >= 30) {
            header('Location: http://localhost/phpbootstrap/711/pabaiga.php');
            die;
        } else {
            header('Location: http://localhost/phpbootstrap/711/zaidimas.php');
            die;
        }
        die;
    }
}
    $game = unserialize(file_get_contents(__DIR__ . '/game.ser'));
    if($game['rid2'] < $game['rid1']) {
        $meta = $game['zaid2'];
    } else {
        $meta = $game['zaid1'];
    };
    if(isset($_GET['go'])) {
        $dice = $_GET['go'];
    } else {
        $dice = 0;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/startas.css">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <div class="d-flex justify-content-center mt-5">
        <h2> Vyksta žaidimas </h2>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-4">
            <label class="float-end"> <?= $game['zaid1'] ?> </label>
        </div>
        <div class="col-4">
            <label> <?= $game['zaid2'] ?> </label>
        </div>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-4">
            <div class="float-end"> <?= $game['taskai1'] ?> </div>
        </div>
        <div class="col-4">
            <div> <?= $game['taskai2'] ?> </div>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-5">
        <h3> Žaidejas <span style="color: red"><?= $meta ?></span>  meta kauliuka </h3>
    </div>
    <div class="d-flex justify-content-center mt-5">
        <form action="?" method="POST">
            <button type="submit" class="btn btn-primary" 
            <?php 
                if($dice > 0)  echo 'disabled' 
            ?> >Ridenti kauliuka</button>
        </form>
    </div>
    <?php if($dice > 0) : ?>
        <div class="d-flex justify-content-center mt-5">
            <img style="width: 30px" src="../image/dice-<?= $dice ?>.svg">
        </div>
        <div class="d-flex justify-content-center mt-5">
        <form action="?go=<?= $dice ?>" method="POST">
            <button type="submit" class="btn btn-primary">Testi</button>
        </form>
        </div>
     <?php endif ?>   
</body>
</html>