<?php

session_start();

if(isset($_SESSION["user_id"])) {

require_once '../controllers/pdo_u_create_benef.php';
include '../modules/head.php';
include '../modules/u_nav_bar.php';

?>

<div class="container" style = "padding-top: 68px;">
    <h2> Faire une demande de nouvelle carte </h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <div class="form-group row">
            <label for="amount" class="col-sm-3 col-form-label">Type de carte</label>
            <div class="col-sm-10">
                <label class="radio-inline"><input type="radio" name="card" value="Electron">Electron
                <img src="../images/card_electron.jpg" width=100px></label>
                <label class="radio-inline"><input type="radio" name="card" value="Classic">Classic
                <img src="../images/card_classic.jpg" width=100px></label>
                <label class="radio-inline" ><input type="radio" name="card" value="Premier">Premier
                <img src="../images/card_premier.jpg" width=100px></label> 
                </div>
        </div>
        
        <div class="form-group row">
            <label for="amount" class="col-sm-3 col-form-label">Type de carte</label>
            <div class="col-sm-5">

            <!-- <select class="image-picker show-html">
                <option value="0"> -- Aucune sélection --</option>
                <option data-img-src="../images/card_electron.jpg" value="Electron">Electron</option>
                <option data-img-src="../images/card_classic.jpg" value="Classic">Classic</option>
                <option data-img-src="../images/card_premium.jpg" value="Premium">Premium</option>
                </select>
            </div> -->
            
        </div>
            <input type="submit" value="Valider" class='btn btn-primary'>
            <input type="button" value="Annuler" class='btn btn-primary' onClick="document.location.href='../pages/u_benef.php'" />
    </form>
</div>

<?php include '../modules/end.php'; 
} else {
    header('location:../pages/u_login.php');
}