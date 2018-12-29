<?php

/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) 
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'bankok');
 
/* Attempt to connect to MySQL database */
//$link = mysqli_connect(DB_SERVER, DB_NAME, DB_USERNAME, DB_PASSWORD);

$c = new mysqli('localhost', 'root', '', 'bankok');

// Check connection
if($c->connect_errno){
    die("ERROR: Could not connect. (" .$c->connect_errno. "(: ".$c->conect_errno);
}

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

if (isset($_POST['register_button'])) {
    //$user_last_name = $_POST['user_last_name'];
    //$user_first_name = $_POST['user_first_name'];
    //$user_email = $_POST['user_email'];
    //$user_password = $_POST['user_password'];
    //$user_phone = $_POST['user_phone'];
    //$user_date_of_birth = $_POST['user_date_of_birth'];
    $add_number = $_POST['add_number'];
    $add_street = $_POST['add_street'];
    $add_postal_code = $_POST['add_postal_code'];
    $add_city = $_POST['add_city'];


    $sql = $c->query("INSERT INTO addresses (add_number, add_street, add_postal_code, add_city) 
        VALUES ($add_number, $add_street, $add_postal_code, $add_city);");

    if (!$sql) {
        $c->close();
        die("Erreur d'execution de la requete");
    }
}
?>
