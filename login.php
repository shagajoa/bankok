<html>

<head>
    <title>Bankok Log In</title>
    <link rel="stylesheet" type="text/css" href="css/login_style.css">
</head>

<body>

    <div class="loginbox">
        <img src="images/logov0.jpg" class="logo">
        <form method="post" action="home.php">
            <h1> Login here </h1>
            <p> Identifiant </p> <input type="text" name="client_id" placeholder ="Enter your email" />
            <p> Password </p> <input type="password" name="client_password" placeholder="Enter your password" />
            <input type="submit" name="login_button" value="Login" />
            <a href="pages/create_account.php"> Don't have an account ? </a>
        </form>
    </div>

</body>
</html> 