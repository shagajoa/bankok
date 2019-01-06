<?php require_once '../controllers/pdo_b_login.php'; ?>

<html>

<head>
    <title>Bankok Admin Login</title>
    <link rel="stylesheet" type="text/css" href="../css/login_style.css">
</head>

<body>

    <div class="loginbox">
    <img src="../images/logov0.jpg" class="logo">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h1>Connexion</h1>
            <p>Identifiant</p> 
            <input type="text" name="agency_id" />
            <span class="help-block"><?php echo $id_err;?></span>
            <p>Mot de passe</p> 
            <input type="password" name="agency_password" />
            <span class="help-block"><?php echo $password_err;?></span>
            <input type="submit" name="login_button" value="Connexion" />
        </form>
    </div>

</body>
</html> 