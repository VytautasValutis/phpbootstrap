<?php
// METODAS POST
// var_dump($_SERVER['REQUEST_METHOD']);
// var_dump($_GET['sask_nr']);
// die;
if(!isset($_GET['sask_nr'])) {
    $nr = 901;
    header('Location: http://localhost/phpbootstrap/u2/pranesimas.php?fin=901');
    die;
};
$id = $_GET['sask_nr'];
setcookie('sask_nr', $id, time() + 300, "/");

$bankas = unserialize(file_get_contents(__DIR__ . '/users.ser'));

$bankas = array_filter($bankas, fn($acc) => $acc['sask_nr'] != $id);
$bankas = serialize($bankas);
file_put_contents(__DIR__ . '/users.ser', $bankas);

header('Location: http://localhost/phpbootstrap/u2/pranesimas.php?fin=102');
