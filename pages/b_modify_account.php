<?php

session_start();
require_once "../controllers/pdo_connect.php";
include '../modules/head.php';
include '../modules/b_nav_bar.php';

?>

<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Mettre à jour</h2>
                    </div>
                    <label>Modifier nom du compte</label>
                    <form fon="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($nom_err)) ? 'has-error' : ''; ?>">
                            <label>Nom</label>
                            <input type="text" name="nom" class="form-control" value="<?php echo $nom; ?>">
                            <span class="help-block"><?php echo $nom_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($rib)) ? 'has-error' : ''; ?>">
                            <label>RIB</label>
                            <textarea name="rib" class="form-control"><?php echo $rib; ?></textarea>
                            <span class="help-block"><?php echo $rib;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($solde_err)) ? 'has-error' : ''; ?>">
                            <label>Solde</label>
                            <input type="text" name="solde" class="form-control" value="<?php echo $solde; ?>">
                            <span class="help-block"><?php echo $solde_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($decouvert_err)) ? 'has-error' : ''; ?>">
                            <label>Découvert</label>
                            <textarea name="decouvert" class="form-control"><?php echo $decouvert; ?></textarea>
                            <span class="help-block"><?php echo $decouvert_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Soumettre">
                        <a href="b_account.php" class="btn btn-default">Annuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>

<?php include '../modules/end.php'; ?>  