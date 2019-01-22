<?php 
require_once "../controllers/pdo_connect.php";
require "../controllers/functions.php";

$my_account_err = '';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // si l'utilisateur n'a pas sélectionner "aucune selection"
    if ($_POST["my_account"] == 0) {
            $my_account_err = "Veuillez sélectionner un compte. Si votre compte n'apparait pas alors il n'a pas été déclaré et validé comme compte émetteur vers un compte bénéficiaire.";
    }  
    
    if(empty($my_account_err)) {

        //récupérer le type sélectionné
        $card_type = $_POST["card"];
        
        //numéro de série
        $card_serial = serial();

        //numéro de compte auquel elle est rattachée
        $card_account_id = intval($_POST['my_account']) ;

        //détenteur de la carte
        $card_user_id = $_SESSION["user_id"];

        //card_status en validé automatiquement
        $card_status = 'valide';
        
        //date d'exp = current + 3 years
        $card_exp_date = date('Y-m-d', strtotime('+3 years'));


        //requete
        $new_card = $bdd->prepare("INSERT INTO ccard(card_type, card_serial, card_account_id, card_status, card_exp_date) VALUES (:card_type, :card_serial, :card_account_id, :card_status, :card_exp_date)");
        $new_card->execute(array(
            ':card_type' => $card_type,
            ':card_serial' => $card_serial,
            ':card_account_id' => $card_account_id,
            ':card_status' => $card_status,
            ':card_exp_date' => $card_exp_date));
    
        //fermeture
        $new_card->closeCursor();

        //redirection
        echo '<script type="text/javascript">alert("Bravo ! Vous avez une nouvelle carte !");window.location.href="../pages/u_credit_card.php";</script>';
        exit();
    }

}