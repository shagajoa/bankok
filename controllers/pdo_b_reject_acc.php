<?php 
session_start();
require_once "../controllers/pdo_connect.php";
// récupéré l'id du compte à supprimer
$id = $_GET["acc_id"];
$reject_acc = $bdd->prepare(" UPDATE accounts set account_status = 'rejected' WHERE account_id = ?");
$reject_acc->execute(array($id));
echo "<script> window.open ('../pages/b_accounts.php', '_self'); </script> ";