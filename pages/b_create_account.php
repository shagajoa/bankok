<?php

require_once '../controllers/pdo_b_create_acc.php';
include '../modules/head.php';
include '../modules/b_nav_bar.php';

?>

<h2> Créer un nouveau compte bancaire </h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <p> Identifiant du client </p> <input type="text" name="user_id">
        <span class="help-block"><?php echo $user_id_err;?></span>
        <p> Nom du compte </p> <input type="text" name="account_name">
        <span class="help-block"><?php echo $account_name_err;?></span>
        <p> Solde intial </p> <input type="text" name="account_balance">
        <span class="help-block"><?php echo $account_balance_err;?></span>
        <p> Découvert autorisé </p> <input type="text" name="account_overdraft">
        <span class="help-block"><?php echo $account_overdraft_err;?></span>
        <input type="submit" value="Submit">
    </form>

<?php include '../modules/end.php'; ?>  