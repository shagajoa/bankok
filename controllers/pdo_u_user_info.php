<?php 

require_once "../controllers/pdo_connect.php";

//initilisation
$add_number= '';
$add_street = '';
$add_postal_code = '';
$add_city = '';

//requete pour chercher l'adresse du user connecté

$add = $bdd->prepare('SELECT * FROM adresses a INNER JOIN users u ON u.add_id = a.add_id WHERE u.user_id = ?');
$add->execute(array($_SESSION['user_id']));
$found_add = $add->fetch();

$add_number= $found_add["add_number"];
$add_street = $found_add["add_street"];
$add_postal_code = $found_add["add_postal_code"];
$add_city = $found_add["add_city"];