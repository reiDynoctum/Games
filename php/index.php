<?php

declare(strict_types=1);

const PRACOVNI_POZICE = "programátor";

$jmeno = "Radek Rybár";

//echo $jmeno . " - " . PRACOVNI_POZICE;

function umocni(int $cislo, int $mocnina) : int {
    if($mocnina === 0) {
        return 1;
    }

    if ($mocnina < 0) {
        return 0;
    }

    $vysledek = $cislo;

    for ($i = 1; $i < $mocnina; $i++) {
        // $vysledek = $vysledek * cislo;
        $vysledek *= $cislo;
    }
    
    return $vysledek;
    
    
}

//echo "<br>";
//echo umocni(5, 3);

$array = [];

var_dump(count($array) === 0);

$prispevek = ['name' => 'Název'];

if (!$prispevek) {
    echo 'Nic nebylo nalezeno';
}


