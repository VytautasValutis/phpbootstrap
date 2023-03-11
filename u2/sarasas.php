<?php
$bankas = unserialize(file_get_contents(__DIR__ . '/users.ser'));



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

        <div class="ml-4" style="margin-left: 100px">
        <a type="button" class="btn btn-outline-warning" href="http://localhost/phpbootstrap/u2/naujas.php">sukurti nauja saskaita</a>
        </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">A.k.</th>
                <th scope="col">vardas</th>
                <th scope="col">pavarde</th>
                <th scope="col">lesos</th>
            </tr>
        </thead>
        <tbody>
<?php foreach($bankas as $v) : ?>            
            <tr>
                <th scope="row"><?= $v['sask_nr'] ?></th>
                <td><?= $v['ak'] ?></td>
                <td><?= $v['vardas'] ?></td>
                <td><?= $v['pavarde'] ?></td>
                <td><b><?= $v['lesos'] ?></b></td>
                <td><button type="button" class="btn btn-outline-success" >Prideti lesu</button></td>
                <td><button type="button" class="btn btn-outline-primary" >Nuskaiciuoti lesas</button></td>
                <td>
                    <form action="http://localhost/phpProject/u2/pasalinti.php?id=<?= $v['sask_nr'] ?>" method="post">
                    <button class="btn btn-outline-danger" type="submit">Pasalinti irasa</button> 
            </form>
</td>
            </tr>
<?php endforeach ?>            
        </tbody>
    </table>
</body>
</html>