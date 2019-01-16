<?php

#------------------------------------------------------------
# INIIALISATION
#------------------------------------------------------------

session_start();
require_once "../controllers/pdo_connect.php";
$agency_id = '';
$agency_password = '';
$id_err = '';
$password_err = '';

#------------------------------------------------------------
# LANCEMENT DU FORMULAIRE
#------------------------------------------------------------

if($_SERVER["REQUEST_METHOD"] == "POST"){

#------------------------------------------------------------
# VERIFICATION DES INPUT
#------------------------------------------------------------

if(empty($_POST["agency_id"])) {
    $id_err = "Please enter your id.";
    
} else{
    $agency_id = $_POST["agency_id"];
}
if(empty($_POST["agency_password"])) {
    $password_err = "Please enter a password.";
} elseif(strlen($_POST["agency_password"]) < 8) {
    $password_err = "At least 8 characters required.";
} else {
    $agency_password = $_POST["agency_password"];
}
    if( empty($id_err) &&
    empty($password_err)) {

#------------------------------------------------------------
# REQUETE
#------------------------------------------------------------

        $req_agency = $bdd->prepare('SELECT * FROM agencies WHERE agency_id = ?');
        $req_agency->execute(array($_POST['agency_id']));
        $admin = $req_agency->fetch();

            if ($admin && ($_POST['agency_password'] == $admin['agency_password'])) {

            // remplacer l'id de session courant par un nouveau automatique
            session_regenerate_id();
            $_SESSION["authorized"] = true;
            $_SESSION["agency_id"] = $admin["agency_id"];
            $_SESSION["agency_password"] = $admin["agency_password"];

            //fermeture de ssions pour libérer les données pour d'autres scripts
            session_write_close();

            //redirection
            header("location:../pages/b_home.php");
           
            exit();

        }
    }
}