<?php 

require_once "../controllers/pdo_connect.php";

$my_benef_err = '';

//afficher les comptes bénéficiaires au compte sélectionner précédemment
$my_benef = $bdd->prepare("SELECT account_id, user_last_name, user_first_name, account_rib FROM accounts a INNER JOIN beneficiaries b on a.account_id = b.account_id_2 INNER JOIN users u on a.account_user_id = u.user_id WHERE b.account_id_1 = ? AND b.benef_status = 'valide'");
$my_benef->execute(array($_SESSION["my_account"]));

echo "<option value='0'> -- Aucune selection -- </option>";

while ($row_b = $my_benef->fetch()) {
    echo "<option value='". $row_b['account_id'] . "'>" . $row_b['user_last_name'] . " " . $row_b['user_first_name'] . " - " . $row_b['account_rib'] . "</option>";
}

//effacer l'erreur et créer une variable de session
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // si l'utilisateur n'a pas sélectionner "aucune selection"
    if ($_POST["my_benef"] == 0) {
        $my_benef_err = "Veuillez sélectionner un compte. Si votre bénéficiare n'apparait pas alors il n'a pas été déclaré et validé.";
    } else {
        $_SESSION["my_benef"] = intval($_POST['my_benef']);

        //redirection
        header("location:../pages/u_create_ope_3.php");
        exit();
    }

}

    