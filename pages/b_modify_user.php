<?php

session_start();
require_once '../controllers/pdo_b_modify_user.php';
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
                    <p>Modifier données client.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group <?php echo (!empty($nom_err)) ? 'has-error' : ''; ?>">
                            <label>Nom</label>
                            <input type="text" name="nom" class="form-control" value="<?php echo $nom; ?>">
                            <span class="help-block"><?php echo $nom_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($prenom_err)) ? 'has-error' : ''; ?>">
                            <label>Prénom</label>
                            <textarea name="prenom" class="form-control"><?php echo $prenom; ?></textarea>
                            <span class="help-block"><?php echo $prenom_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($mail_err)) ? 'has-error' : ''; ?>">
                            <label>Mail</label>
                            <input type="text" name="mail" class="form-control" value="<?php echo $mail; ?>">
                            <span class="help-block"><?php echo $mail_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($tel_err)) ? 'has-error' : ''; ?>">
                            <label>Numéro de Téléphone</label>
                            <textarea name="tel" class="form-control"><?php echo $tel; ?></textarea>
                            <span class="help-block"><?php echo $tel_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                            <label>Date de naissance</label>
                            <textarea name="datenaissance" class="form-control"><?php echo $datenaissance; ?></textarea>
                            <span class="help-block"><?php echo $datenaissance_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Soumettre">
                        <a href="b_users.php" class="btn btn-default">Annuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>

<?php include '../modules/end.php'; ?>  