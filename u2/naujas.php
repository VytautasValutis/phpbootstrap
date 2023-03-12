<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = json_decode(file_get_contents(__DIR__ . '/id.json'));
    $user = [
        'vardas' => $_POST['name'],
        'pavarde' => $_POST['surname'],
        'ak' => $_POST['ak'],
        'sask_nr' => 'LT3306660'.sprintf('%1$011d', $id),
        'id' => 0,
        'lesos' => 0,
    ];

    $bankas = unserialize(file_get_contents(__DIR__ . '/users.ser'));
    $bankas[] = $user;
    $bankas = serialize($bankas);
    file_put_contents(__DIR__ . '/users.ser', $bankas);


    header('Location: http://localhost/phpbootstrap/u2/sarasas.php');
    die;
}



    $id = json_decode(file_get_contents(__DIR__ . '/id.json'));
    $id++;
    file_put_contents(__DIR__ . '/id.json', json_encode($id));
    $sask_nr = 'LT3306660'.sprintf('%1$011d', $id);
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

        <form action ="" method="post">
        <fieldset>
            <legend>Sukurti nauja saskaita</legend>
            <label>Saskaita :</label>
            <input type="text" name="sask_nr" value="<?= $sask_nr ?>" disabled><br><br>
            <label>vardas :</label>
            <input type="text" name="name"><br><br>
            <label>pavarde:</label>
            <input type="text" name="surname"><br><br>
            <label>Asm.kodas:</label>
            <input type="number" name="ak"><br><br>
            <button class="btn btn-secondary" type="submit">Patvirtinti</button>
        </fieldset>
    </form>
</div>
</body>
</html>

