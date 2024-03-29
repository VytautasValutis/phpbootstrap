<?php
$vard = ['Berlynn','Erin','Byron','Jasper','Murphy',
        'Abraham','Lane','Jax','Julian','Kate',
        'Dustin','Dante','Will','Viola','Blair'];
$pav = ['Miles','Lamb','Cox','Lindsey','Blackwell',
        'Hogan','Pace','Mcmahon','Hensley','Ramos',
        'Golden','Hale','Branch','Skinner','Mclaughlin'];   
        
function akgen() {
    $met = rand(1901,2007);
    $men = rand(1, 12);
    $nr = rand(1, 999);
    if(in_array($men,[1,3,5,7,8,10,12])) {
        $dien = rand(1, 31);
    };
    if(in_array($men,[4,6,9,11])) {
        $dien = rand(1, 30);
    };
    if($men == 2) {
        if($met % 4 === 0) {
            $dien = rand(1, 29);
        } else {
            $dien = rand(1, 28);
        }
    }

    if($met > 1999) {
        $ak[] = rand(5, 6);
    } else {
        $ak[] = rand(3, 4);
    }
    $ak[] = floor(($met % 100) / 10);
    $ak[] = $met % 10;
    $ak[] = floor($men / 10);
    $ak[] = $men % 10;
    $ak[] = floor($dien / 10);
    $ak[] = $dien % 10;
    $ak[] = floor($nr / 100);
    $ak[] = floor(($nr % 100) / 10);
    $ak[] = $nr % 10;
    $ks = $ak[0] + $ak[1] * 2 + $ak[2] * 3 +
        $ak[3] * 4 + $ak[4] * 5 + $ak[5] * 6 +
        $ak[6] * 7 + $ak[7] * 8 + $ak[8] * 9 + 
        $ak[9];
    $kss = $ks % 11;    
    if($kss === 10) {
        $ks = $ak[0] * 3 + $ak[1] * 4 + $ak[2] * 5 +
            $ak[3] * 6 + $ak[4] * 7 + $ak[5] * 8 +
            $ak[6] * 9 + $ak[7] + $ak[8] + $ak[9];
        $kss = $ks % 11;
        if($kss === 10) $kss = 0;
    }        
    $ak[] = $kss;

    return implode('', $ak);
}        

foreach(range(0,14) as $i) {
    $id = json_decode(file_get_contents(__DIR__ . '/id.json'));
    $id++;
    file_put_contents(__DIR__ . '/id.json', json_encode($id));
    $sask_nr = 'LT3306660'.sprintf('%1$011d', $id);
    $user = [
        'vardas' => $vard[$i],
        'pavarde' => $pav[$i],
        'ak' => akgen(),
        'sask_nr' => $sask_nr,
        'id' => md5($sask_nr),
        'lesos' => rand(275, 3566),
    ];
    $bankas[] = $user;
}
$bankas = serialize($bankas);
file_put_contents(__DIR__ . '/users.ser', $bankas);

echo 'All Ok';
