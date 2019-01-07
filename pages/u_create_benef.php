<?php

session_start();

if(isset($_SESSION["user_id"])) {

require_once '../controllers/pdo_u_create_benef.php';
include '../modules/head.php';
include '../modules/b_nav_bar.php';

?>

<div class="container" style = "padding-top: 68px;">
    <h2> Faire une demande de nouveau beneficiaire </h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <div class="form-group row">
            <label for="account_name" class="col-sm-3 col-form-label">RIB de votre compte</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="account_rib_1">
                <small class="form-text text-muted"><?php echo $account_rib_1_err;?></small>
            </div>
        </div>
        
        <div class="form-group row">
            <label for="amount" class="col-sm-3 col-form-label">RIB du compte bénéficiaire</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="account_rib_2">
                <small class="form-text text-muted"><?php echo $account_rib_2_err;?></small>
            </div>
            
        </div>
            <input type="submit" value="Valider" class='btn btn-primary'>
            <input type="button" value="Annuler" class='btn btn-primary' onClick="document.location.href='../pages/u_benef.php'" />
    </form>
</div>

<?php include '../modules/end.php'; 
} else {
    header('location:../pages/u_login.php');
}