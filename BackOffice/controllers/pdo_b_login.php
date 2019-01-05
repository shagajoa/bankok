
<?php
#------------------------------------------------------------
# INIIALISATION
#------------------------------------------------------------
session_start();
require_once "../modules/pdo_connect.php";
$admin_id = '';
$admin_password = '';
$id_err = '';
$password_err = '';
#------------------------------------------------------------
# LANCEMENT DU FORMULAIRE
#------------------------------------------------------------
if($_SERVER["REQUEST_METHOD"] == "POST"){
#------------------------------------------------------------
# VERIFICATION DES INPUT
#------------------------------------------------------------
if(empty($_POST["admin_id"])) {
    $id_err = "Please enter your id.";
    
} else{
    $admin_id = $_POST["admin_id"];
}
if(empty($_POST["admin_password"])) {
    $password_err = "Please enter a password.";
} elseif(strlen($_POST["admin_password"]) < 8) {
    $password_err = "At least 8 characters required.";
} else {
    $admin_password = $_POST["admin_password"];
}
    if( empty($id_err) &&
    empty($password_err)) {
#------------------------------------------------------------
# REQUETE
#------------------------------------------------------------
        $req_agency = $bdd->prepare('SELECT * FROM AGENCIES WHERE AGENCY_ID = ?');
        $req_agency->execute(array($_POST['admin_id']));
        $admin = $req_agency->fetch();
#------------------------------------------------------------
# VERIFICATION
#------------------------------------------------------------
            if ($admin && ($_POST['admin_password'] == $admin['AGENCY_PASSWORD'])) {
            // remplacer l'id de session courant par un nouveau automatique
            session_regenerate_id();
            $_SESSION["authorized"] = true;
            $_SESSION["admin_id"] = $admin["AGENCY_ID"];
            $_SESSION["admin_password"] = $admin["AGENCY_PASSWORD"];
            //fermeture de ssions pour libérer les données pour d'autres scripts
            session_write_close();
            //redirection
            header("location:../home_backoffice.php");
            exit();
        }
    }
}

