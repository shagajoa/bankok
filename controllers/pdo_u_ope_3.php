<?php

require_once "../controllers/pdo_connect.php";
$amount_err = '';
if($_SERVER["REQUEST_METHOD"] == "POST"){

    
    //conversion de l'input string en entier
    $amount = intval($_POST["ope_amount"]);

    if (is_numeric($_POST["ope_amount"]) == false || $amount <= 0) {
        $amount_err = "Veuillez entrer un chiffre positif";
    } else {
        $amount_err = '';
    }

    if (empty($amount_err)) {

        //nouvelle operation
        $new_ope = $bdd->prepare("INSERT INTO operations (ope_method, ope_amount, ope_date, ope_acc_id_1, ope_acc_id_2) VALUES ('transfer', ?, CURRENT_DATE,?, ?)");
        $new_ope->execute(array($_POST["ope_amount"], $_SESSION["my_account"], $_SESSION['my_benef']));

        //débit de l'émetteur
        $debit = $bdd->prepare("UPDATE accounts a SET a.account_balance = a.account_balance - ? WHERE a.account_id = ?");
        $debit->execute(array($amount, $_SESSION["my_account"]));

        //crédit du bénéficiaire
        $credit = $bdd->prepare("UPDATE accounts a SET a.account_balance = a.account_balance + ? WHERE a.account_id = ?");
        $credit->execute(array($amount, $_SESSION["my_benef"]));

        //fermeture
        $new_ope->closeCursor();
        $debit->closeCursor();
        $credit->closeCursor();

        //redirection
        header("location:../pages/u_operations.php");
        exit();

    }

}