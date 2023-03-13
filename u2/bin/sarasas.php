<?php
session_start();
$menu_home = '';
$menu_login = 'invisible';
$menu_new_acc = '';
$menu_acc_list = 'invisible';
$bankas = unserialize(file_get_contents(__DIR__ . '../../db/users.ser'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>Sarasas</title>
</head>
<body>
    <?php require __DIR__ . '../../logo.php' ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">A.k.</th>
                <th scope="col">Vardas</th>
                <th scope="col">Pavardė</th>
                <th scope="col">Lėšos</th>
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
                <td>
                    <a type="button" class="btn btn-outline-success" href="http://localhost/phpbootstrap/u2/bin/prideti.php?sask_nr=<?= $v['sask_nr'] ?>">Prideti lėšų</a>
                </td>
                <td>
                    <form action="http://localhost/phpbootstrap/u2/nuskaiciuoti.php?sask_nr=<?= $v['sask_nr'] ?>" method="post">
                    <button type="submit" class="btn btn-outline-primary" >Nuskaičiuoti lėšas</button>
                    </form>
                </td>
                <td>
                    <a type="button" class="btn btn-outline-danger" href="http://localhost/phpbootstrap/u2/bin/pasalinti.php?sask_nr=<?= $v['sask_nr'] ?>">Pašalinti sąskaitą</a>
                </td>
            </tr>
<?php endforeach ?>            
        </tbody>
    </table>
</body>
</html>