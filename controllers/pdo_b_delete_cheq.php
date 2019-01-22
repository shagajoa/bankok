<?php 
session_start();
require_once "../controllers/pdo_connect.php";
// récupéré l'id du compte à supprimer
$id = $_GET["acc_id"];
$delete_benef = $bdd->prepare("DELETE FROM cheq WHERE cheq_id = ?");
$delete_benef->execute(array($id));

echo "<script> window.open ('../pages/b_payments.php', '_self'); </script> ";

