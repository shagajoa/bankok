<?php

session_start();
require_once '../controllers/pdo_b_create_payment.php';
include '../modules/head.php';
include '../modules/b_nav_bar.php';

?>

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h2>Création</h2>
                </div>
                <p>Ajouter méthode.</p>
                <form fon="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($methode_err)) ? 'has-error' : ''; ?>">
                        <label>Moyen de paiement</label>
                        <input type="text" name="methode" class="form-control" value="<?php echo $methode; ?>">
                        <span class="help-block"><?php echo $methode_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($serie_err)) ? 'has-error' : ''; ?>">
                        <label>Numéro de série</label>
                        <textarea name="serie" class="form-control"><?php echo $serie; ?></textarea>
                        <span class="help-block"><?php echo $serie_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($commande_err)) ? 'has-error' : ''; ?>">
                        <label>Date de commande</label>
                        <input type="text" name="commande" class="form-control" value="<?php echo $commande; ?>">
                        <span class="help-block"><?php echo $commande_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($validation_err)) ? 'has-error' : ''; ?>">
                        <label>Date de validation</label>
                        <textarea name="validation" class="form-control"><?php echo $validation; ?></textarea>
                        <span class="help-block"><?php echo $validation_err;?></span>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Soumettre">
                    <a href="b_moyens.php" class="btn btn-default">Annuler</a>
                </form>
            </div>
        </div>        
    </div>
</div>

<?php include '../modules/end.php'; ?>  