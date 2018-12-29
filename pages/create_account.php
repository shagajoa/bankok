<?php include '../controllers/sql_create_account.php'; ?>
<html>

<head>
    <title>Create new account</title>
    <link rel="stylesheet" type="text/css" href="../css/create_account.css">
</head>

<body>

    <div class="loginbox">
        <img src="../images/logov0.jpg" class="logo">
        <form method="post" action="create_account.php">
            <h1> Register here </h1>
                    <p> Last name </p> <input type="text" name="user_last_name" />
                    <p> First name </p> <input type="text" name="user_first_name" />
                    <p> Email </p> <input type="text" name="user_email" />
                    <p> Password </p> <input type="password" name="user_password" />
                    <p> Phone number </p> <input type="text" name="user_phone" />
                    <p> Date of birth </p> <input type="date" name="user_date_of_birth" max="2001-12-31" />
                    <p> Street number </p> <input type="text" name="add_number" />
                    <p> Street name </p> <input type="text" name="add_street" />
                    <p> Postal code </p> <input type="text" name="add_postal_code" />
                    <p> City </p> <input type="text" name="add_city" />
            <input type="submit" name="register_button" value="Register" />
        </form>
    </div>

</body>
</html> 