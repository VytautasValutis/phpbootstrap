<?php
$vard = ["Berlynn","Erin","Byron","Jasper","Murphy",
        "Abraham","Lane","Jax","Julian","Kate",
        "Dustin","Dante","Will","Viola","Blair"];
$pav = ["Miles","Lamb","Cox","Lindsey","Blackwell",
        "Hogan","Pace","Mcmahon","Hensley","Ramos",
        "Golden","Hale","Branch","Skinner","Mclaughlin"];   
        
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
        $ak[] = rand(3, 4);
    } else {
        $ak[] = rand(5, 6);
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

$kk = akgen();
echo "<br>$kk";

foreach(range(0,14) as $i) {
$user = [
    'vardas' => $vard[$i],
    'pavarde' => $pav[$i],
    'ak' => 0,
    'sask_nr' => 0,
    'id' => 0,
    'lesos' => 0,
];
}