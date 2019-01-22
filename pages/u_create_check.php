<?php

session_start();

if(isset($_SESSION["user_id"])) {

require_once '../controllers/pdo_u_create_check.php';
include '../modules/head.php';
include '../modules/u_nav_bar.php';

?>

<div class="container" style = "padding-top: 68px;">
    <h2> Faire une demande de chéquier</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">


        <div class="form-group row">
            <label for="amount" class="col-sm-5 col-form-label">Sur quel compte souhaitez-vous un chéquier ?</label>

            <select name='my_account' class="form-control">
            <?php require_once '../controllers/pdo_u_card_acc.php';?>
            </select>

            <small class="form-text text-muted"><?php echo $my_account_err;?></small>
            
        </div>
            <input type="submit" value="Valider" class='btn btn-primary'>
            <input type="button" value="Annuler" class='btn btn-primary' onClick="document.location.href='../pages/u_credit_card.php'" />
    </form>
</div>

<?php include '../modules/end.php'; 
} else {
    header('location:../pages/u_login.php');
}