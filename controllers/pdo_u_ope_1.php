<?php 

require_once "../controllers/pdo_connect.php";

$my_account_err = '';

//afficher comptes qui possèdent un bénéficiaire
$my_acc = $bdd->prepare("SELECT DISTINCT a.account_id, a.account_name, a.account_rib FROM accounts a INNER JOIN beneficiaries b ON a.account_id = b.account_id_1 WHERE a.account_user_id = ?");
$my_acc->execute(array($_SESSION["user_id"]));

echo "<option value='0'> -- Aucune selection -- </option>";

while ($row_acc = $my_acc->fetch()) {
    echo "<option value='". $row_acc['account_id'] . "'>" . $row_acc['account_name'] . " - " . $row_acc['account_rib'] . "</option>";
}

//effacer l'erreur et créer une variable de session
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // si l'utilisateur n'a pas sélectionner "aucune selection"
    if ($_POST["my_account"] == 0) {
        $my_account_err = "Veuillez sélectionner un compte. Si votre compte n'apparait pas alors il n'a pas été déclaré et validé comme compte émetteur vers un compte bénéficiaire.";
    } else {
        $_SESSION["my_account"] = intval($_POST['my_account']);
    
        //redirection
        header("location:../pages/u_create_ope_2.php");
        exit();
    }

}
    