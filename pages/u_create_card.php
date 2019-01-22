<?php

session_start();

if(isset($_SESSION["user_id"])) {

require_once '../controllers/pdo_u_create_card.php';
include '../modules/head.php';
include '../modules/u_nav_bar.php';

?>

<div class="container" style = "padding-top: 68px;">
    <h2> Faire une demande de nouvelle carte </h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <div class="form-group row">
        <label for="amount" class="col-sm-2 col-form-label">Type de carte</label>
            <div class="card-group">
            
                <div class="card-body">
                    
                    <h5 class="radio-inline">
                    <input type="radio" name="card" value="Electron"> Electron
                    <img src="../images/card_electron.jpg" width=100px>
                    </h5>

                </div>
                
                <div class="card-body">

                    <h5 class="radio-inline">
                    <input type="radio" name="card" value="Classic"> Classic
                    <img src="../images/card_classic.jpg" width=100px>
                    </h5>

                </div>

                
                <div class="card-body">

                    <h5 class="radio-inline">
                    <input type="radio" name="card" value="Premier"> Premier
                    <img src="../images/card_premier.jpg" width=100px>
                    </h5>

                </div>
                
            </div>
            </div>


        <div class="form-group row">
            <label for="amount" class="col-sm-2 col-form-label">Mon compte</label>

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