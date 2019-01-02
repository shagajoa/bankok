<?php require_once '../controllers/pdo_create_acc.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="../css/create_account.css">
</head>

<body>
<div class="loginbox">
    <img src="../images/logov0.jpg" class="logo">
    <h1> Register here </h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <p>Last name</p>
                <input type="text" name="user_last_name" value="<?php echo $user_last_name; ?>">
                <span class="help-block"><?php echo $last_name_err;?></span>
            </div>
            <div>
                <p>Last name</p>
                <input type="text" name="user_first_name" value="<?php echo $user_first_name; ?>">
                <span class="help-block"><?php echo $first_name_err;?></span>
            </div>
            <div>
                <p>Email</p>
                <input type="text" name="user_email" value="<?php echo $user_email; ?>">
                <span class="help-block"><?php echo $email_err;?></span>
            </div>
            <div>
                <p> Password </p>
                <input type="password" name="user_password" value="<?php echo $user_password; ?>">
                <span class="help-block"><?php echo $password_err;?></span>
            </div>
            <div>
                <p>Phone number</p>
                <input type="text" name="user_phone" value="<?php echo $user_phone; ?>">
                <span class="help-block"><?php echo $phone_err;?></span>
            </div>
            <div>
                <p>Date of birth</p>
                <input type="date" name="user_date_of_birth" value="<?php echo $user_date_of_birth; ?>" min='1900-01-01' max='2000-01-01'>
                <span class="help-block"><?php echo $date_of_birth_err;?></span>
            </div>
            <div>
                <p>Street number</p>
                <input type="text" name="add_number" value="<?php echo $add_number; ?>">
                <span class="help-block"><?php echo $number_err;?></span>
            </div>
            <div>
                <p>Street name</p>
                <input type="text" name="add_street" value="<?php echo $add_street; ?>">
                <span class="help-block"><?php echo $street_err;?></span>
            </div>
            <div>
                <p>Postal code</p>
                <input type="text" name="add_postal_code" value="<?php echo $add_postal_code; ?>">
                <span class="help-block"><?php echo $postal_code_err;?></span>
            </div>
            <div>
                <p>City</p>
                <input type="text" name="add_city" value="<?php echo $add_city; ?>">
                <span class="help-block"><?php echo $city_err;?></span>
            </div>
            <input type="submit" class="btn btn-primary" value="Submit">
            <a href="../login.php" class="btn btn-default">Already a member?</a>
        </form>
</div>
</body>
</html>