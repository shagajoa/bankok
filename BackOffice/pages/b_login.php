<?php require_once 'pdo_b_login.php'; ?>

<html>

<head>
    <title>Bankok admin login</title>
    <link rel="stylesheet" type="text/css" href="../modules/login_style.css">
</head>

<body>

    <div class="loginbox">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h1> Connexion </h1>
            <p> Identifiant </p> 
            <input type="text" name="admin_id" />
            <span class="help-block"><?php echo $id_err;?></span>
            <p> Mot de passe </p> 
            <input type="password" name="admin_password" />
            <span class="help-block"><?php echo $password_err;?></span>
            <input type="submit" name="login_button" value="Connexion" />
        </form>
    </div>

</body>
</html> 