<?php 
require_once "../controllers/pdo_connect.php";
// creation des variables
$account_id_1 = '';
$account_id_2 = '';
$account_rib_1_err = '';
$account_rib_2_err = '';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if ($_POST["account_rib_1"] == $_POST["account_rib_2"]) {
        $account_rib_1_err = 'Veuillez indiquer deux RIB différents.';
        $account_rib_2_err = 'Veuillez indiquer deux RIB différents.';
    } else {
        //requête pour le RIB du compte du users connecté --> vérifier que RIB existent et que champs sont remplis
        $select_rib_1 = $bdd->prepare("SELECT * FROM accounts WHERE account_user_id = ? AND account_rib = ? AND account_status = 'valide'");
        $select_rib_1->execute(array($_SESSION["user_id"],$_POST["account_rib_1"]));
        $found_acc_1 = $select_rib_1->fetch();
        $count_1 = $select_rib_1->rowCount();
        if(empty($_POST["account_rib_1"])) {
            $account_rib_1_err = "Veuillez entrer un RIB.";
        } elseif ($count_1 == 1) {
            $account_id_1 = $found_acc_1["account_id"];
        } elseif($count_1 == 0) {
            $account_rib_1_err = "Ce RIB n'est pas validé ou ne vous appartient pas.";
        }
        //vérifier que le premier compte sélectionné est un compte courant ou épargne ?
        $type = $bdd->prepare("SELECT account_type FROM accounts WHERE account_rib = ? AND account_status = 'valide'");
        $type->execute(array($_POST["account_rib_1"]));
        $found_type = $type->fetch();
            if ($found_type["account_type"] == 'Courant') {
                //requête pour que le RIB du benef = comptes du user connecté ou compte courant d'un autre user
                $select_rib_2 = $bdd->prepare("SELECT * FROM accounts a WHERE (a.account_user_id = ? AND a.account_rib = ? AND a.account_status = 'valide') OR (a.account_user_id != ? AND a.account_rib = ? AND a.account_status = 'valide' AND a.account_type = 'Courant')");
                $select_rib_2->execute(array(intval($_SESSION["user_id"]), $_POST["account_rib_2"], intval($_SESSION["user_id"]), $_POST["account_rib_2"]));
                $found_acc_2 = $select_rib_2->fetch();
                $count_2 = $select_rib_2->rowCount();
                if(empty($_POST["account_rib_2"])) {
                    $account_rib_2_err = "Veuillez entrer un RIB.";
                } elseif($count_2 == 1) {
                    $account_id_2 =$found_acc_2["account_id"];
                } elseif($count_2 == 0) {
                    $account_rib_2_err = "Vous ne pouvez pas faire un virement sur le compte épargne d'un autre client.";
                } 
            } elseif ($found_type["account_type"] == 'Epargne') {
                //requete pour le RIB du compte bénéficiaire = que des comptes de la personne qui est connectée
                $select_rib_1->execute(array($_SESSION["user_id"],$_POST["account_rib_2"]));
                $found_acc_3 = $select_rib_1->fetch();
                $count_4 = $select_rib_1->rowCount();
                if(empty($_POST["account_rib_2"])) {
                    $account_rib_2_err = "Veuillez entrer un RIB.";
                } elseif ($count_4 == 1) {
                    $account_id_2 = $found_acc_3["account_id"];
                } elseif ($count_4 == 0) {
                    $account_rib_2_err = "Ce RIB n'est pas validé ou ne vous appartient pas. Aussi, votre compte épargne ne peut pas avoir comme bénéficiaire le compte d'un autre client.";
                }
        }
        //vérifier que la combinaison des deux comptes n'existent pas déjà
        $combi = $bdd->prepare('SELECT * FROM beneficiaries WHERE account_id_1 = ? AND account_id_2 = ?');
        $combi->execute(array($account_id_1,$account_id_2));
        $count_5 = $combi->rowCount();
        if($count_5 > 0) {
            $account_rib_2_err = "Ce compte est déjà bénéficiaire du votre.";
        }
        //verifier s'il y a des erreurs de saisie
        if(empty($account_rib_1_err) && empty($account_rib_2_err)) {
            //Status en attente avant validation ou non par le backoffice
            $benef_status = 'pending';
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
            header("location:../pages/u_benef.php");
            exit();
        }
    }
}