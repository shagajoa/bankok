<?php

#------------------------------------------------------------
# INIIALISATION
#------------------------------------------------------------
session_start();

require_once "../controllers/pdo_connect.php";

$user_email = '';
$user_password = '';
$email_err = '';
$password_err = '';

#------------------------------------------------------------
# LANCEMENT DU FORMULAIRE
#------------------------------------------------------------

if($_SERVER["REQUEST_METHOD"] == "POST"){

#------------------------------------------------------------
# VERIFICATION DES INPUT
#------------------------------------------------------------

if(empty($_POST["user_email"])) {
    $email_err = "Please enter your email.";
    
} else{
    $user_email = $_POST["user_email"];
}

if(empty($_POST["user_password"])) {
    $password_err = "Please enter a password.";
} elseif(strlen($_POST["user_password"]) < 8) {
    $password_err = "At least 8 characters required.";
} else {
    $user_password = $_POST["user_password"];
}
    if( empty($email_err) &&
    empty($password_err)) {

#------------------------------------------------------------
# REQUETE
#------------------------------------------------------------

        $req_email = $bdd->prepare('SELECT * FROM users WHERE user_email = ?');
        $req_email->execute(array($_POST['user_email']));
        $user = $req_email->fetch();

#------------------------------------------------------------
# VERIFICATION
#------------------------------------------------------------

        if ($user && password_verify($_POST['user_password'], $user['user_password'])) {

            // remplacer l'id de session courant par un nouveau automatique
            session_regenerate_id();

            $_SESSION["authorized"] = true;
            $_SESSION["user_email"] = $user["user_email"];
            $_SESSION["user_password"] = $user["user_password"];

            //fermeture de ssions pour libérer les données pour d'autres scripts
            session_write_close();

            //redirection
            header("location:../pages/home.php");
            exit();

        }
    }
}