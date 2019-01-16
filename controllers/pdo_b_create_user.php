<?php

#------------------------------------------------------------
# INIIALISATION
#------------------------------------------------------------



// connexion a MySql avec PDO
require_once "../controllers/pdo_connect.php";

$user_last_name = '';
$user_first_name = '';
$user_email = '';
$user_password = '';
$user_phone = '';
$user_date_of_birth = '';
$add_number = '';
$add_street = '';
$add_postal_code = '';
$add_city = '';

$last_name_err = '';
$first_name_err = '';
$email_err = '';
$password_err = '';
$phone_err = '';
$date_of_birth_err = '';
$number_err = '';
$street_err = '';
$postal_code_err = '';
$city_err = '';

#------------------------------------------------------------
# LANCEMENT DU FORMULAIRE
#------------------------------------------------------------

if($_SERVER["REQUEST_METHOD"] == "POST"){

#------------------------------------------------------------
# VERIFICATION DES INPUT
#------------------------------------------------------------

if(empty($_POST["user_last_name"])) {
    $last_name_err = "Please enter your last name.";
} else{
    $user_last_name = $_POST["user_last_name"];
}

if(empty($_POST["user_first_name"])) {
    $first_name_err = "Please enter your first name.";
} else{
    $user_first_name = $_POST["user_first_name"];
}

// l'email ne peut pas être déjà existant dans la bdd
// et doit avoir une nomenclature d'email "x@xxx.xx"
$select_email = $bdd->prepare('SELECT * FROM users WHERE user_email = ?');
$select_email->execute(array($_POST["user_email"]));
$count = $select_email->rowCount();
                
if($count > 0){
    $email_err = "This email already exists.";
} elseif(empty($_POST["user_email"])){
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

if(empty($_POST["user_phone"])) {
    $phone_err = "Please enter your phone number.";
} else{
    $user_phone = $_POST["user_phone"];
}

if(empty($_POST["user_date_of_birth"])) {
    $date_of_birth_err = "Please enter your date of birth.";
} else{
    $user_date_of_birth = $_POST["user_date_of_birth"];
}

if(empty($_POST["add_number"])) {
    $number_err = "Please enter your street number.";
} elseif(!ctype_digit($_POST["add_number"])){
        $number_err = "Please enter a positive integer.";
} else{
    $add_number = $_POST["add_number"];
}

if(empty($_POST["add_street"])) {
    $street_err = "Please enter your street name.";
} else{
    $add_street = $_POST["add_street"];
}

if(empty($_POST["add_postal_code"])) {
    $postal_code_err = "Please enter your postal code.";
} elseif(strlen($_POST["add_postal_code"]) != 5) {
    $postal_code_err = "Postal code has 5 digits.";
} else {
    $add_postal_code = $_POST["add_postal_code"];

}

if(empty($_POST["add_city"])) {
    $city_err = "Please enter your city name.";
} else{
    $add_city = $_POST["add_city"];
}

// verifier qu'il n'y ait pas d'erreur
if( empty($last_name_err) &&
    empty($first_name_err) &&
    empty($email_err) &&
    empty($password_err) &&
    empty($phone_err) &&
    empty($date_of_birth_err) &&
    empty($number_err) &&
    empty($street_err) &&
    empty($postal_code_err) &&
    empty($city_err)) {

#------------------------------------------------------------
# PREPARATION DES REQUETES
#------------------------------------------------------------

    $insert_add = $bdd->prepare('INSERT INTO adresses(add_number, add_street, add_postal_code, add_city) VALUES(:add_number, :add_street, :add_postal_code, :add_city)');
    $select_ag = $bdd->prepare('SELECT DISTINCT agency_id FROM agencies INNER JOIN adresses WHERE (agencies.add_id = adresses.add_id) and (LEFT(adresses.add_postal_code,2) = ?)');
    $insert_user = $bdd->prepare('INSERT INTO users (user_last_name, user_first_name, user_email, user_password, user_phone, user_date_of_birth, user_active, agency_id, add_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $select_user = $bdd->prepare('SELECT * FROM users WHERE user_id = ?');

#------------------------------------------------------------
# EXECUTION
#------------------------------------------------------------

    // creer une nouvelle adresse
    $insert_add->execute(array(
        ':add_number' => $add_number,
        ':add_street' => $add_street,
        ':add_postal_code' => $add_postal_code,
        ':add_city' => $add_city));

    // recuperer l'id de cette nouvelle adresse
    $new_add_id_string = $bdd->lastInsertId();
    
    // convertir l'id en integer
    $new_add_id = intval($new_add_id_string);

    // requete pour trouver l'agence associee a l'utilisateur grace au 2 premiers chiffres du code postal
    $add_postal_code_2 = substr($_POST["add_postal_code"],0,2);
    $select_ag->execute(array($add_postal_code_2));
    
    
    // chercher l'id de cette agence
    $found_agency = $select_ag->fetch();
    
    $select_ag_id = $found_agency['agency_id'];

    // creer un nouvel utilisateur
    $insert_user->execute(array($user_last_name,$user_first_name,$user_email,password_hash($user_password, PASSWORD_DEFAULT),$user_phone,$user_date_of_birth,true,$select_ag_id,$new_add_id));

#------------------------------------------------------------
# AFFECTATION VALEUR DE SESSION
#------------------------------------------------------------
    
    session_regenerate_id();
    
    $new_user_id_string = $bdd->lastInsertId();
    $new_user_id = intval($new_user_id_string);

    $select_user->execute(array($new_user_id));
    $found_user = $select_user->fetch();

    $_SESSION["authorized"] = true;
    $_SESSION["user_id"] = $new_user_id;
    $_SESSION["user_last_name"] = $found_user["user_last_name"];
    $_SESSION["user_first_name"] = $found_user["user_first_name"];
    $_SESSION["user_email"] = $found_user["user_email"];
    $_SESSION["user_password"] = $found_user["user_password"];
    $_SESSION["user_phone"] = $found_user["user_phone"];
    $_SESSION["user_date_of_birth"] = $found_user["user_date_of_birth"];

    session_write_close();

#------------------------------------------------------------
# FERMETURE DES REQUETES
#------------------------------------------------------------

    $insert_add->closeCursor();
    $select_ag->closeCursor();
    $insert_user->closeCursor();

#------------------------------------------------------------
# REDIRECTION
#------------------------------------------------------------
    
    header("location:../pages/b_home.php");
    exit();

}

}
?>