<?php 
session_start();
require_once "../controllers/pdo_connect.php";
require "../controllers/functions.php";

// creation des variables
$account_rib_1 = '';
$account_rib_2 = '';

$user_id_2 = '';

$account_rib_1_err = '';
$account_rib_2_err = '';

if($_SERVER["REQUEST_METHOD"] == "POST"){
  
    //requête pour le RIB du compte du users connecté --> vérifier que RIB existent et que champs sont remplis
    $select_rib_1 = $bdd->prepare('SELECT * FROM accounts WHERE account_user_id = ? AND account_rib = ?');
    $select_rib_1->execute(array($_SESSION["user_id"],$_POST["account_rib_1"]));
    $count_1 = $select_rib_1->rowCount();

    if(empty($_POST["account_rib_1"])) {
        $account_rib_1_err = "Veuillez entrer un RIB.";
    } elseif ($count = 1) {
        $account_rib_1 = $_POST["account_rib_1"];
    } elseif($count = 0) {
        $account_rib_1_err = "Le RIB n'existe pas.";
    }

    //requête pour le RIB du compte du beneficiaire
    $select_rib_2 = $bdd->prepare('SELECT * FROM accounts WHERE account_user_id != ? AND account_rib = ?');
    $select_rib_2->execute(array($_SESSION["user_id"],$_POST["account_rib_2"]));
    $count_2 = $select_rib_2->rowCount();

    if(empty($_POST["account_rib_2"])) {
        $account_rib_2_err = "Veuillez entrer un RIB.";
    } elseif ($count = 1) {
        $account_rib_2 = $_POST["account_rib_2"];
    } elseif($count = 0) {
        $account_rib_2_err = "Le RIB n'existe pas.";
    }

    //verifier s'il y a des erreurs de saisie
    if(empty($account_rib_1_err) && empty($account_rib_2_err)) {

        //chercher l'id du compte

        //Status en attente avant validation ou non par le backoffice
        $account_status = 'pending';

        //Requete d'insertion
        $insert_acc = $bdd->prepare('INSERT INTO beneficiaries(account_id_1, account_id_2, benef_status)
        VALUES (:account_id_1, :account_id_2, :benef_status)');
        $insert_acc->execute(array(
            ':account_id_1' => $account_id_1,
            ':account_id_2' => $account_id_2,
            ':benef_status' => $benef_status));

        //fermeture
        $insert_acc->closeCursor();

        //redirection
        header("location:../pages/u_accounts.php");
        exit();
    }

}
