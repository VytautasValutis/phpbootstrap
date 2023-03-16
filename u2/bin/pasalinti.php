<?php
session_start();
// METODAS POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(!isset($_GET['id'])) {
    $_SESSION['msg'] = ['type' => 'error', 'txt' => 'Sąskaitos pašalinti nepavyko: neteisinga sąskaitos nr.'];
    header('Location: ./sarasas.php');
    die;
};
$id = $_GET['id'];
$bankas = unserialize(file_get_contents(__DIR__ . '/../db/users.ser'));
foreach($bankas as $acc) {
    if($acc['id'] === $id) {
        if($acc['lesos'] > 0) {
            $_SESSION['msg'] = ['type' => 'error', 'txt' => 'Saskaita '.$acc['sask_nr'].' negali būti pašalinta. Likutis: '.$acc['lesos']];
            header('Location: ./sarasas.php');
            die;
        } else {
            break;
        }
    }
}

$bankas = array_filter($bankas, fn($acc) => $acc['id'] !== $id);
$bankas = serialize($bankas);
file_put_contents(__DIR__ . '/../db/users.ser', $bankas);

$_SESSION['msg'] = ['type' => 'ok', 'txt' => 'Sąskaita '.$acc['sask_nr'].' sėkmingai pašalinta'];
header('Location: ./sarasas.php');
die;
}