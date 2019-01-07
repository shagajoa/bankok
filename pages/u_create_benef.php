<?php

if(isset($_SESSION["user_id"])) {
    
require_once '../controllers/pdo_b_create_benef.php';
include '../modules/head.php';
include '../modules/b_nav_bar.php';

?>

<h2> Faire une demande de nouveau beneficiaire </h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <p> RIB de votre compte</p> <input type="text" name="account_rib_1">
        <span class="help-block"><?php echo $account_rib_1_err;?></span>
        <p> RIB du compte bénéficiaire</p> <input type="text" name="account_rib_2">
        <span class="help-block"><?php echo $account_rib_1_err;?></span>
        <input type="submit" value="Submit">
    </form>

<?php include '../modules/end.php';
} else {
    header('location:../pages/u_login.php');
}