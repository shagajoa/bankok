<?php 
require_once "../controllers/pdo_connect.php";
require "../controllers/functions.php";

// creation des variables
$account_name = '';
$account_rib = '';
$account_balance = '';
$account_overdraft = '';
$user_id = '';
$account_status = '';
$account_name_err = '';
$account_balance_err = '';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // gestion des erreurs
    if(empty($_POST["account_name"])) {
        $account_name_err = "Veuillez entrer un nom de compte.";
    } else{
        $account_name = $_POST["account_name"];
    }
    
    if(empty($_POST["account_balance"])) {
        $account_balance_err = "Combien souhaitez-vous verser ?";
    } elseif(!ctype_digit($_POST["account_balance"])){
        $account_balance_err = "Veuillez entrer un nombre positif.";
    } else{
        $account_balance = $_POST["account_balance"];
    }

    //verifier s'il y a des erreurs de saisie
    if(empty($account_name_err) && empty($account_balance_err)) {

        //RIB cree par une fonction piocher des caractères au hasard pour former un varchar de 23 caractères
        $account_rib = RIB();
        
        //Overdraft est initilisé à 500 à l'ouverture
        $account_overdraft = 500;

        //User_id est la personne qui est connectée
        $user_id=$_SESSION["user_id"];
        var_dump($user_id);

        //Status en attente avant validation ou non par le backoffice
        $account_status = 'pending';

        //Requete d'insertion
        $insert_acc = $bdd->prepare('INSERT INTO accounts(account_name, account_rib, account_balance, account_overdraft, account_user_id, account_status) 
        VALUES (:acc_name, :acc_rib, :acc_balance, :acc_overdraft, :acc_user_id, :acc_status)');
        $insert_acc->execute(array(
            ':acc_name' => $account_name,
            ':acc_rib' => $account_rib,
            ':acc_balance' => $account_balance,
            ':acc_overdraft' => $account_overdraft,
            ':acc_user_id' => $user_id,
            ':acc_status' => $account_status));

        //fermeture
        $insert_acc->closeCursor();

        //redirection
        header("location:../pages/u_accounts.php");
        exit();
    }

}
