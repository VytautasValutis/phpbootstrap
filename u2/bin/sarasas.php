<?php
session_start();
$menu_home = 1;
$menu_login = 0;
$menu_new_acc = 1;
$menu_acc_list = 0;
$_SESSION['w_name'] = '';
$_SESSION['w_surname'] = '';
$_SESSION['w_ak'] = '';
$_SESSION['w_sask_nr'] = '';
$msg = 'ok';
$msg = 'Banko sąskaitų sąrašas';
$bankas = unserialize(file_get_contents(__DIR__ . '../../db/users.ser'));
if(isset($_GET['sort'])){
    $sort = $_GET['sort'];
    if($sort == 'A') { 
        if($_SESSION['sort'] == 'A1') {
            $_SESSION['sort'] = 'A2';
            $a_sort = mb_chr(0x21D1);
            usort($bankas, fn($a, $b) => $b['sask_nr'] <=> $a['sask_nr']);
        } else {
            $_SESSION['sort'] = 'A1';
            $a_sort = mb_chr(0x21D3);
            usort($bankas, fn($a, $b) => $a['sask_nr'] <=> $b['sask_nr']);
        }
    } else {
        $a_sort = '';
    }
    if($sort == 'D') {
        if($_SESSION['sort'] == 'D1') {
            $_SESSION['sort'] = 'D2';
            $d_sort = mb_chr(0x21D3);
            usort($bankas, fn($a, $b) => $b['pavarde'] <=> $a['pavarde']);
        } else {
            $_SESSION['sort'] = 'D1';
            $d_sort = mb_chr(0x21D1);
            usort($bankas, fn($a, $b) => $a['pavarde'] <=> $b['pavarde']);
        }
    } else {
        $d_sort = '';
    }
    if($sort == 'E') {
        if($_SESSION['sort'] == 'E1') {
            $_SESSION['sort'] = 'E2';
            $e_sort = mb_chr(0x21D3);
            usort($bankas, fn($a, $b) => $b['lesos'] <=> $a['lesos']);
        } else {
            $_SESSION['sort'] = 'E1';
            $e_sort = mb_chr(0x21D1);
            usort($bankas, fn($a, $b) => $a['lesos'] <=> $b['lesos']);
        }
    } else {
        $e_sort = '';
    }
} else {
    if(isset($_SESSION['sort'])) {
        $a_sort = '';
        $d_sort = '';
        $e_sort = '';
        if($_SESSION['sort'] == 'A1') {
            $a_sort = mb_chr(0x21D3);
            usort($bankas, fn($a, $b) => $a['sask_nr'] <=> $b['sask_nr']);
        }
        if($_SESSION['sort'] == 'A2') {
            $a_sort = mb_chr(0x21D1);
            usort($bankas, fn($a, $b) => $b['sask_nr'] <=> $a['sask_nr']);
        }
        if($_SESSION['sort'] == 'D1') {
            $d_sort = mb_chr(0x21D3);
            usort($bankas, fn($a, $b) => $a['pavarde'] <=> $b['pavarde']);
        }
        if($_SESSION['sort'] == 'D2') {
            $d_sort = mb_chr(0x21D1);
            usort($bankas, fn($a, $b) => $b['pavarde'] <=> $a['pavarde']);
        }
        if($_SESSION['sort'] == 'E1') {
            $e_sort = mb_chr(0x21D1);
            usort($bankas, fn($a, $b) => $a['lesos'] <=> $b['lesos']);
        }
        if($_SESSION['sort'] == 'E2') {
            $e_sort = mb_chr(0x21D3);
            usort($bankas, fn($a, $b) => $b['lesos'] <=> $a['lesos']);
        }
    } else {
        $a_sort = '';
        $e_sort = '';
        $d_sort = mb_chr(0x21D1);
        $_SESSION['sort'] = 'D1';
        usort($bankas, fn($a, $b) => $a['pavarde'] <=> $b['pavarde']);
    }
}

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
                <th scope="col">
                    <a href="./sarasas.php?sort=A" style="text-decoration: none;">
                    # <span style="color: red;"><?= $a_sort ?></span></a></th>
                <th scope="col">A.k.</th>
                <th scope="col">Vardas</th>
                <th scope="col">
                    <a href="./sarasas.php?sort=D" style="text-decoration: none;">
                    Pavardė <span style="color: red;"><?= $d_sort ?></span></a></th>
                <th scope="col">
                    <a href="./sarasas.php?sort=E" style="text-decoration: none;">
                    Lėšos <span style="color: red;"><?= $e_sort ?></span></a></th>
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
                    <a type="button" class="btn btn-outline-success" href="./prideti.php?id=<?= $v['id'] ?>">Prideti lėšų</a>
                </td>
                <td>
                    <a type="button" class="btn btn-outline-primary" href="./nuskaiciuoti.php?id=<?= $v['id'] ?>">Nuskaičiuoti lėšas</a>
                </td>
                <td>
                    <form action="./pasalinti.php?id=<?= $v['id'] ?>" method="post">
                    <button type="submit" class="btn btn-outline-danger">Pašalinti sąskaitą</button>
                    </form>
                </td>
            </tr>
<?php endforeach ?>            
        </tbody>
    </table>
</body>
</html>