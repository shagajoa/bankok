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

// Validate last name
$input_last_name = trim($_POST["user_last_name"]);
if(empty($input_last_name)){
    $last_name_err = "Please enter your last name.";
} else{
    $user_last_name = $input_last_name;
}

// Validate first name
$input_first_name = trim($_POST["user_first_name"]);
if(empty($input_first_name)){
    $first_name_err = "Please enter your first name.";
} else{
    $user_first_name = $input_first_name;
}

// Validate email
$input_email = trim($_POST["user_email"]);
if(empty($input_email)){
    $email_err = "Please enter an email.";     
} elseif (filter_var($input_email, FILTER_VALIDATE_EMAIL)) {
    $user_email = $input_email;
} else {
    $email_err = "Your please rewrite your email correctly";
}

// Validate password
$input_password = $_POST["user_password"];
if(empty($input_password)){
    $password_err = "Please enter a password.";     
} elseif (strlen($input_password) < 8) {
    $password_err = "At least 8 characters required.";
} else {
    $user_password = $input_password;
}

// Validate phone
$input_phone = trim($_POST["user_phone"]);
if(empty($input_phone)){
    $phone_err = "Please enter your phone number.";     
} else{
    $user_phone = $input_phone;
}

// Validate date of birth
$input_date_of_birth = $_POST["user_date_of_birth"];
if(empty($input_date_of_birth)){
    $date_of_birth_err = "Please enter your date of birth.";     
} else{
    $user_date_of_birth = $input_date_of_birth;
}

// Validate street number
$input_number = trim($_POST["add_number"]);
if(empty($input_number)){
    $number_err = "Please enter your street number.";     
} elseif(!ctype_digit($input_number)){
    $number_err = "Please enter a positive integer.";
} else{
    $add_number = $input_number;
}

// Validate street name
$input_street = trim($_POST["add_street"]);
if(empty($input_street)){
    $street_err = "Please enter your street name.";     
} else{
    $add_street = $input_street;
}

// Validate postal code
$input_postal_code = trim($_POST["add_postal_code"]);
if(empty($input_postal_code)){
    $postal_code_err = "Please enter your postal code.";     
} elseif(strlen($input_postal_code) != 5){
    $postal_code_err = "Valide postal code with 5 digits.";
} else {
    $add_postal_code = $input_postal_code;
}

// Validate city
$input_city = trim($_POST["add_city"]);
if(empty($input_city)){
    $city_err = "Please enter your city";     
} else{
    $add_city = $input_city;
}   

// Check input errors before inserting in database
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

    $insert_add = $bdd->prepare('INSERT INTO addresses(add_number, add_street, add_postal_code, add_city) VALUES(:add_number, :add_street, :add_postal_code, :add_city)');
    $select_ag = $bdd->prepare('SELECT DISTINCT agency_id FROM agencies INNER JOIN addresses WHERE LEFT(addresses.ADD_POSTAL_CODE,2) = LEFT(?,2)');
    $insert_user = $bdd->prepare('INSERT INTO users (user_last_name, user_first_name, user_email, user_password, user_phone, user_date_of_birth, user_active, id_agency, id_adress) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');

#------------------------------------------------------------
# EXECUTION
#------------------------------------------------------------

    // creer une nouvelle adresse
    $insert_add->execute(array(
        ':add_number' => $add_number,
        ':add_street' => $add_street,
        ':add_postal_code' => $add_postal_code,
        ':add_city' => $add_city)) or die(print_r($insert_add->errorInfo()));

    // recuperer l'id de cette nouvelle adresse
    $new_add_id_string = $bdd->lastInsertId();
    // convertir l'id en integer
    $new_add_id = intval($new_add_id_string);

    // requete pour trouver l'agence associee a l'ustilisateur grace au 2 premiers chiffres du code postal
    $select_ag->execute(array($input_postal_code)) or die(print_r($select_ag->errorInfo()));
    // chercher l'id de cette agence
    $found_agency = $select_ag->fetch();
    $select_ag_id = $found_agency['agency_id'];
    
    // creer un nouvel utilisateur
    $insert_user->execute(array($input_last_name,$input_first_name,$input_email,$input_password,$input_phone,$input_date_of_birth,true,$select_ag_id,$new_add_id)) or die(print_r($insert_user->errorInfo()));
    
#------------------------------------------------------------
# FERMETURE DES REQUETES
#------------------------------------------------------------

    //Fermer les requetes
    $insert_add->closeCursor();
    $select_ag->closeCursor();
    $insert_user->closeCursor();

    }
}
?>