<?php
session_start();
// METODAS POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(!isset($_GET['sask_nr'])) {
    $_SESSION['msg'] = ['type' => 'error', 'txt' => 'Sąskaitos pašalinti nepavyko: neteisingas sąskaitos nr.'];
    header('Location: ./sarasas.php');
    die;
};
$sask_nr = $_GET['sask_nr'];
$bankas = unserialize(file_get_contents(__DIR__ . '/../db/users.ser'));
foreach($bankas as $acc) {
    if($acc['sask_nr'] == $sask_nr) {
        if($acc['lesos'] > 0) {
            $_SESSION['msg'] = ['type' => 'error', 'txt' => 'Saskaita '.$sask_nr.' negali būti pašalinta. Likutis: '.$acc['lesos']];
            header('Location: ./sarasas.php');
            die;
        } else {
            break;
        }
    }
}

$bankas = array_filter($bankas, fn($acc) => $acc['sask_nr'] != $sask_nr);
$bankas = serialize($bankas);
file_put_contents(__DIR__ . '/../db/users.ser', $bankas);

$_SESSION['msg'] = ['type' => 'ok', 'txt' => 'Sąskaita '.$sask_nr.' sėkmingai pašalinta'];
header('Location: ./sarasas.php');
die;
}