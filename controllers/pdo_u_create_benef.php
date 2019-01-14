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
        $select_rib_1 = $bdd->prepare('SELECT * FROM accounts WHERE account_user_id = ? AND account_rib = ?');
        $select_rib_1->execute(array($_SESSION["user_id"],$_POST["account_rib_1"]));
        $found_acc_1 = $select_rib_1->fetch();
        $count_1 = $select_rib_1->rowCount();

        if(empty($_POST["account_rib_1"])) {
            $account_rib_1_err = "Veuillez entrer un RIB.";
        } elseif ($count_1 == 1) {
            $account_id_1 = $found_acc_1["account_id"];
        } elseif($count_1 == 0) {
            $account_rib_1_err = "Ce RIB n'est pas le votre.";
        }

        //requête pour le RIB du compte du beneficiaire
        //$select_rib_2 = $bdd->prepare('SELECT * FROM accounts WHERE account_user_id != ? AND account_rib = ?');
        //$select_rib_2->execute(array($_SESSION["user_id"],$_POST["account_rib_2"]));
        $select_rib_1->execute(array($_SESSION["user_id"],$_POST["account_rib_2"]));
        $found_acc_2 = $select_rib_1->fetch();
        $count_2 = $select_rib_1->rowCount();

        if(empty($_POST["account_rib_2"])) {
            $account_rib_2_err = "Veuillez entrer un RIB.";
        } elseif ($count_2 == 1) {
            $account_id_2 = $found_acc_2["account_id"];
        //} elseif($count_2 == 0) {
            //$account_rib_2_err = "Vous ne pouvez pas déclarer ce bénéficiaire.";
        }

        //vérifier que la combinaison des deux comptes n'existent pas déjà

        $combi = $bdd->prepare('SELECT * FROM beneficiaries WHERE account_id_1 = ? AND account_id_2 = ?');
        $combi->execute(array($account_id_1,$account_id_2));
        $count_3 = $combi->rowCount();

        if($count_3 > 0) {
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
