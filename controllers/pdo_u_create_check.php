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
        
        //numéro de série
        $cheq_serial = serial();

        //numéro de compte auquel elle est rattachée
        $cheq_account_id = intval($_POST['my_account']) ;

        //chéquier de 50 pages
        $cheq_pages = 50;

        //cheq_status en validé automatiquement
        $cheq_status = 'valide';
        

        //requete
        $new_check = $bdd->prepare("INSERT INTO cheq(cheq_serial, cheq_account_id, cheq_pages, cheq_status) VALUES (:cheq_serial, :cheq_account_id, :cheq_pages, :cheq_status)");
        $new_check->execute(array(
            ':cheq_serial' => $cheq_serial,
            ':cheq_account_id' => $cheq_account_id,
            ':cheq_pages' => $cheq_pages,
            ':cheq_status' => $cheq_status));
    
        //fermeture
        $new_check->closeCursor();

        //redirection
        echo '<script type="text/javascript">alert("Bravo ! Vous avez un nouveau chéquier !");window.location.href="../pages/u_check.php";</script>';
        exit();
    }

}