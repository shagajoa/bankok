<?php

session_start();
require_once '../controllers/pdo_b_delete_payment.php';
include '../modules/head.php';
include '../modules/b_nav_bar.php';

?>

<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Supprimer moyen de paiement</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Si on lui enleve le moyen de nous faire du pognon...</p><br>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="b_moyens.php" class="btn btn-default">Non</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>

<?php include '../modules/end.php'; ?>  