<?php 
session_start();
require_once "../controllers/pdo_connect.php";
// récupéré l'id du compte à supprimer
$id = $_GET["acc_id"];
$reject_acc = $bdd->prepare(" UPDATE cheq set cheq_status = 'valide' WHERE cheq_id = ?");
$reject_acc->execute(array($id));

echo "<script> window.open ('../pages/b_payments.php', '_self'); </script> ";