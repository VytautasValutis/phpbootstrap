<?php
$msg[101]['txt'] = 'Sąskaita'; 
$msg[101]['txt2'] = 'sėkmingai sukurta'; 
$msg[101]['color'] = 'success'; 
$msg[102]['txt'] = 'Sąskaita'; 
$msg[102]['txt2'] = 'sėkmingai pašalinta'; 
$msg[102]['color'] = 'success'; 
$msg[901]['txt'] = 'Klaida: nenurodytas sąskaitos numeris'; 
$msg[901]['txt2'] = ''; 
$msg[901]['color'] = 'danger'; 
$msg[999]['txt'] = 'Klaida: nenustatytas klaidos kodas'; 
$msg[999]['txt2'] = '999'; 
$msg[999]['color'] = 'danger'; 
    
$msg = serialize($msg);
file_put_contents(__DIR__ . '/message.ser', $msg);
