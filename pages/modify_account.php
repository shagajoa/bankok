<?php

require_once '../controllers/pdo_create_acc.php';
include '../modules/head.php';
include '../modules/nav_bar.php';

?>

<h2> Modifier compte </h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <p> ... </p> <input type="text" name="account_name">
        <span class="help-block"><?php echo $account_name_err;?></span>
        <p> ... </p> <input type="text" name="account_balance">
        <span class="help-block"><?php echo $account_balance_err;?></span>
        <input type="submit" value="Submit">
    </form>

<?php include '../modules/end.php'; ?>  