<?php
session_start();
// METODAS GET
if(!isset($_GET['sask_nr'])) {
    $_SESSION['msg'] = ['type' => 'error', 'txt' => 'Sąskaitos pašalinti nepavyko: neteisingas sąskaitos nr.'];
    header('Location: http://localhost/phpbootstrap/u2/bin/sarasas.php');
    die;
};
$id = $_GET['sask_nr'];

$bankas = unserialize(file_get_contents(__DIR__ . '/../db/users.ser'));

$bankas = array_filter($bankas, fn($acc) => $acc['sask_nr'] != $id);
$bankas = serialize($bankas);
file_put_contents(__DIR__ . '/../db/users.ser', $bankas);

$_SESSION['msg'] = ['type' => 'ok', 'txt' => 'Sąskaita '.$id.' sėkmingai pašalinta'];
header('Location: http://localhost/phpbootstrap/u2/bin/sarasas.php');
