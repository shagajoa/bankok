<?php require_once '../controllers/pdo_u_login.php'; ?>

<html>

<head>
    <title>Bankok Log In</title>
    <link rel="stylesheet" type="text/css" href="../css/login_style.css">
</head>

<body>

    <div class="loginbox">
        <img src="../images/logov0.jpg" class="logo">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h1> Connexion </h1>
            <p> Identifiant </p> 
            <input type="text" name="user_email" />
            <span class="help-block"><?php echo $email_err;?></span>
            <p> Mot de passe </p> 
            <input type="password" name="user_password" />
            <span class="help-block"><?php echo $password_err;?></span>
            <input type="submit" name="login_button" value="Connexion" />
            <a href="u_create_user.php"> Vous n'avez pas de compte ? </a>
        </form>
    </div>

</body>
</html> 