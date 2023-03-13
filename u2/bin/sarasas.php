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
                <td>
                    <form action="http://localhost/phpbootstrap/u2/prideti.php?sask_nr=<?= $v['sask_nr'] ?>" method="post">
                    <button type="submit" class="btn btn-outline-success" >Prideti lėšų</button>
                    </form>
                </td>
                <td>
                    <form action="http://localhost/phpbootstrap/u2/nuskaiciuoti.php?sask_nr=<?= $v['sask_nr'] ?>" method="post">
                    <button type="submit" class="btn btn-outline-primary" >Nuskaičiuoti lėšas</button>
                    </form>
                </td>
                <td>
                    <form action="http://localhost/phpbootstrap/u2/pasalinti.php?sask_nr=<?= $v['sask_nr'] ?>" method="post">
                    <button type="submit" class="btn btn-outline-danger">Pašalinti sąskaitą</button> 
                    </form>
                </td>
            </tr>
<?php endforeach ?>            
        </tbody>
    </table>
</body>
</html>