<?php
function ak_valid($ak) {
    $ak1 = (int) substr($ak,0,1);
    if($ak1 < 3 || $ak1 > 6) return false;
    if($ak1 == 3 || $ak1 == 4) $met = (int)'19'.substr($ak,1,2); 
    if($ak1 == 5 || $ak1 == 6) $met = (int)'20'.substr($ak,1,2); 
    if($met > 2007) return false;
    $men = (int) substr($ak,3,2);
    if($men > 12 || $men < 1) return false;
    $dien = (int) substr($ak,5,2);
    if($dien > 31 || $dien < 1) return false;
    if($dien == 31 && in_array($men,[4,6,9,11])) return false;
    if($dien == 30 && $men == 2) return false;
    if($dien == 29 && $men == 2 && $met % 4 != 0) return false;
    $sk = (int) substr($ak,7,3);
    if(ak_tst($ak1, (int) $met, $men, $dien, $sk) != $ak) return false;
    return true;
}

function ak_tst($ak1, $met, $men, $dien, $nr) {
    $ak[] = $ak1;
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
