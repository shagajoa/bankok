<?php

//creation de RIB avec un varchar de 23 caractères formé au hasard
function RIB() {
    //liste des caractères autorisés
    $characters = '0123456789';
    $rib = 'FR';
    $max = strlen($characters) - 1;
    for ($i = 0; $i < 22; $i++) {
        $rib .= $characters[mt_rand(0, $max)];
    }
    return $rib;
}

//creation de d'un numéro de carte de crédit
function serial() {
    //liste des caractères autorisés
    $characters = '0123456789';
    $nb = '';
    $max = strlen($characters) - 1;
    for ($i = 0; $i < 17; $i++) {
        $nb .= $characters[mt_rand(0, $max)];
    }
    return $nb;
}