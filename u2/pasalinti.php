<?php

if($_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_GET['sask_nr'])) {
    http_response_code(400);
}
$id = $_GET['sask_nr'];

$bankas = unserialize(file_get_contents(__DIR__ . '/users.ser'));

$bankas = array_filter($bankas, fn($acc) => $acc['sask_nr'] != $id);
$bankas = serialize($bankas);
file_put_contents(__DIR__ . '/users.ser', $bankas);

header('Location: http://localhost/phpbootstrap/u2/sarasas.php');
