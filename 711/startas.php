<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $game = [ 
        'zaid1' => $_POST['zaid1'],
        'zaid2' => $_POST['zaid2'],
        'taskai1' => 0,
        'taskai2' => 0,
        'rid1' => 0,
        'rid2' => 0,
    ];
    $game = serialize($game);
    file_put_contents(__DIR__ . '/game.ser', $game);

    header('Location: http://localhost/phpbootstrap/711/zaidimas.php');
    die;
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
        <h2> Zaidimo pradzia </h2>
    </div>
    <form action="" method="post">
        <div class="row justify-content-center mt-5">
            <div class="col-4 float-end">
                <label> Vardas 1 </label>
                <input type="text" class="form-control" name="zaid1">
            </div>
            <div class="col-4">
                <label> Vardas 2 </label>
                <input type="text" class="form-control" name="zaid2">
            </div>
        </div>
        <div class="d-flex justify-content-center mt-5">
            <button type="submit" class="btn btn-success">pradeti</button>
        </div>
    </form>
</body>
</html>