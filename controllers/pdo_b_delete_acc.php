<?php 
session_start();
require_once "../controllers/pdo_connect.php";
// récupéré l'id du compte à supprimer
$id = $_GET["acc_id"];
//verifier que le compte est vidé de son solde d'abord
$select_acc = $bdd->prepare('SELECT * FROM accounts WHERE account_id = ?');
$select_acc->execute(array($id));
$found_acc = $select_acc->fetch();
if ($found_acc['account_balance'] == 0) {
    $delete_acc = $bdd->prepare("DELETE FROM accounts WHERE account_id = ?");
    $delete_acc->execute(array($id));
    echo "<script type='text/javascript'>alert('Ce compte a bien été supprimé.');window.open ('../pages/b_accounts.php', '_self');</script>";
} elseif($found_acc['account_balance'] < 0) {
   
    echo "<script type='text/javascript'>alert('Ce compte est à découvert. Veuillez indiquer au client de rembourser ce crédit avant de supprimer le compte.');window.open ('../pages/b_accounts.php', '_self') </script>";
} else {
    echo "<script type='text/javascript'>alert('Veuillez indiquer au client de vider ce compte avant de le supprimer');window.open ('../pages/b_accounts.php', '_self');</script>";
}
