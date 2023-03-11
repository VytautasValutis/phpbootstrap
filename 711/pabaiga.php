<?php
    $game = unserialize(file_get_contents(__DIR__ . '/game.ser'));
    $k = ((int)$game['taskai1'] <=> (int)$game['taskai2']);
    $vardas = ($k == 1) ? $game['zaid1'] : $game['zaid2'];
    $task_w = max($game['taskai1'], $game['taskai2']);
    $task_l = min($game['taskai1'], $game['taskai2']);
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
        <h2> Žaidimas baigtas: </h2>
    </div>
    <div class="d-flex justify-content-center mt-5">
        <?php if($k == 0) : ?>
            <h3> Lygiosios </h3>
        <?php else : ?>
            <h3> Laimėjo <?= $vardas ?> <?=$task_w?> : <?= $task_l ?> </h3>
        <?php endif ?>
    </div>
    <div class="d-flex justify-content-center mt-5">
    <form action="http://localhost/phpbootstrap/711/startas.php" method="get">
            <button type="submit" class="btn btn-secondary">Pradėti iš naujo</button>
        </form>

</div>
</body>
</html>