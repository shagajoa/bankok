<?php

session_start();

if(isset($_SESSION["user_id"])) {

require_once '../controllers/pdo_u_create_acc.php';
include '../modules/head.php';
include '../modules/u_nav_bar.php';

?>

<div class="container" style = "padding-top: 68px;">
    <h2> Créer un nouveau compte bancaire </h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <div class="form-group row">
            <label for="account_name" class="col-sm-3 col-form-label">Nom du compte</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="account_name">
                <small class="form-text text-muted"><?php echo $account_name_err;?></small>
            </div>
        </div>
        
        <div class="form-group row">
            <label for="amount" class="col-sm-3 col-form-label">Solde intial</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="account_balance">
                <small class="form-text text-muted"><?php echo $account_balance_err;?></small>
            </div>
            
        </div>
            <input type="submit" value="Valider" class='btn btn-primary'>
            <input type="button" value="Annuler" class='btn btn-primary' onClick="document.location.href='../pages/u_accounts.php'" />
    </form>
</div>

<?php include '../modules/end.php'; 
} else {
    header('location:../pages/u_login.php');
}