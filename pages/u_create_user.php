<?php require_once '../controllers/pdo_u_create_user.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="../css/create_user.css">
</head>

<body>
<div class="logo">
    <img src="../images/logov0.jpg" alt="Logo Bankok">
</div>

<div class="loginbox">
    <h1>Création d'un compte</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div <?php echo (!empty($last_name_err)) ? 'has-error' : ''; ?>>
            <p>Nom de famille</p>
            <input type="text" name="user_last_name" value="<?php echo $user_last_name; ?>">
            <span class="help-block"><?php echo $last_name_err;?></span>
        </div>
        <div <?php echo (!empty($first_name_err)) ? 'has-error' : ''; ?>>
            <p>Prénom</p>
            <input type="text" name="user_first_name" value="<?php echo $user_first_name; ?>">
            <span class="help-block"><?php echo $first_name_err;?></span>
        </div>
        <div <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>>
            <p>Email</p>
            <input type="text" name="user_email" value="<?php echo $user_email; ?>">
            <span class="help-block"><?php echo $email_err;?></span>
        </div>
        <div <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>>
            <p>Mot de passe</p>
            <input type="password" name="user_password" value="<?php echo $user_password; ?>">
            <span class="help-block"><?php echo $password_err;?></span>
        </div>
        <div <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>>
            <p>Numéro de téléphone</p>
            <input type="text" name="user_phone" value="<?php echo $user_phone; ?>">
            <span class="help-block"><?php echo $phone_err;?></span>
        </div>
        <div <?php echo (!empty($date_of_birth_err)) ? 'has-error' : ''; ?>>
            <p>Date de naissance</p>
            <input type="date" name="user_date_of_birth" value="<?php echo $user_date_of_birth; ?>" min='1900-01-01' max='2000-01-01'>
            <span class="help-block"><?php echo $date_of_birth_err;?></span>
        </div>
        <div <?php echo (!empty($number_err)) ? 'has-error' : ''; ?>>
            <p>Numéro de rue </p>
            <input type="text" name="add_number" value="<?php echo $add_number; ?>">
            <span class="help-block"><?php echo $number_err;?></span>
        </div>
        <div <?php echo (!empty($street_err)) ? 'has-error' : ''; ?>>
            <p>Nom de rue </p>
            <input type="text" name="add_street" value="<?php echo $add_street; ?>">
            <span class="help-block"><?php echo $street_err;?></span>
        </div>
        <div <?php echo (!empty($postal_code_err)) ? 'has-error' : ''; ?>>
            <p>Code postal</p>
            <input type="text" name="add_postal_code" value="<?php echo $add_postal_code; ?>">
            <span class="help-block"><?php echo $postal_code_err;?></span>
        </div>
        <div <?php echo (!empty($city_err)) ? 'has-error' : ''; ?>>
            <p>Ville</p>
            <input type="text" name="add_city" value="<?php echo $add_city; ?>">
            <span class="help-block"><?php echo $city_err;?></span>
        </div>
        <input type="submit" value="Création">
        <a href="u_login.php">Déjà membre?</a>
    </form>
</div>
</body>
</html>