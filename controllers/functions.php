<?php

//creation de RIB avec un varchar de 23 caractères formé au hasard
function RIB() {
    //liste des caractères autorisés
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $rib = '';
    $max = strlen($characters) - 1;
    for ($i = 0; $i < 22; $i++) {
        $rib .= $characters[mt_rand(0, $max)];
    }
    return $rib;
}