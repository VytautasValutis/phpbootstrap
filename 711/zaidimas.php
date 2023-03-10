<?php
    $game = unserialize(file_get_contents(__DIR__ . '/game.ser'));
    if($game['rid2'] < $game['rid1']) {
        $meta = $game['zaid1'];
    } else {
        $meta = $game['zaid1'];
    };
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
            <label class="col-4 float-end"> <?= $game['zaid1'] ?> </label>
        </div>
        <div class="col-4">
            <label class="col-4"> <?= $game['zaid2'] ?> </label>
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
  <button type="submit" class="btn btn-primary">Ridenti kauliuka</button>
</div>
</body>
</html>