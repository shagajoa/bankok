<?php
session_start();

if(isset($_SESSION["user_id"])) {

include '../modules/head.php';
include '../modules/u_nav_bar.php';

?>

<div class="container" style = "padding-top: 68px;">
    <h2> Envoyer un virement </h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <div class="form-group">
            
            <label for="sel1">Veuillez sélectionner un de vos comptes bancaires:</label>

            <select name='my_account' class="form-control">
            <?php require_once '../controllers/pdo_u_ope_1.php';?>
            </select>

            <small class="form-text text-muted"><?php echo $my_account_err;?></small>

        </div>

        <input type="submit" value="Valider" class='btn btn-primary'>
        <input type="button" value="Annuler" class='btn btn-primary' onClick="document.location.href='../pages/u_operations.php'" />

    </form>
</div>

<?php include '../modules/end.php'; 
} else {
    header('location:../pages/u_login.php');
}