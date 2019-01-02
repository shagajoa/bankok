<?php
// Include config file
require_once "../controllers/x_config.php";
 
// Define variables and initialize with empty values
$user_last_name = $user_first_name = $user_email = $user_password = $user_phone = $user_date_of_birth = '';
$add_number = $add_street = $add_postal_code = $add_city = '';

$last_name_err = $first_name_err = $email_err = $password_err = $phone_err = $date_of_birth_err = '';
$number_err = $street_err = $postal_code_err = $city_err = '';

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
// Validate last name
$input_last_name = trim($_POST["user_last_name"]);
if(empty($input_last_name)){
    $last_name_err = "Please enter your last name.";
} elseif(!filter_var($input_last_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
    $last_name_err = "Please enter a valid name.";
} else{
    $user_last_name = $input_last_name;
}

// Validate first name
$input_first_name = trim($_POST["user_first_name"]);
if(empty($input_first_name)){
    $first_name_err = "Please enter your first name.";
} elseif(!filter_var($input_first_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
    $first_name_err = "Please enter a valid name.";
} else{
    $user_first_name = $input_first_name;
}

// Validate email
$input_email = trim($_POST["user_email"]);
if(empty($input_email)){
    $email_err = "Please enter an email.";     
} else{
    $user_email = $input_email;
}

// Validate password
$input_password = $_POST["user_password"];
if(empty($input_password)){
    $password_err = "Please enter a password.";     
} else{
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
    $number_err = "Please enter a positive value.";
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
    $postal_code_err = "Please enter your postal code";     
} else{
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

    // Prepare an insert statement
    $sql_add = "INSERT INTO addresses (add_number, add_street, add_postal_code, add_city) VALUES (?, ?, ?, ?)";
    $sql_user = "INSERT INTO users (user_last_name, user_first_name, user_email, user_password, user_phone)
                VALUES (?, ?, ?, ?, ?)";

    // $stmt_1 = mysqli_prepare($link, $sql_add);
    $stmt_2 = mysqli_prepare($link, $sql_user);
     
    // Bind variables to the prepared statement as parameters
    // mysqli_stmt_bind_param($stmt_1, "ssss", $param_add_number, $param_add_street, $param_add_postal_code, $param_add_city);
    mysqli_stmt_bind_param($stmt_2, "sssss", $param_last_name, $param_first_name, $param_email, $param_password, $param_phone);
    
    // Set parameters
    $param_add_number = $add_number;
    $param_add_street = $add_street;
    $param_add_postal_code = $add_postal_code;
    $param_add_city = $add_city;

    $param_last_name = $user_last_name;
    $param_first_name = $user_first_name;
    $param_email = $user_email;
    $param_password = $user_password;
    $param_phone = $user_phone;
    
    // Attempt to execute the prepared statement


    // var_dump($stmt_1);
    // var_dump($stmt_2); die;


    try {
        // mysqli_stmt_execute($stmt_1);
        mysqli_stmt_execute($stmt_2);
    }
    catch (Exception $e) {
        var_dump($e->getMessage()); die;
    }

    // if(){
    //     // Records created successfully. Redirect to landing page
    //     header("location: ../login.php");
    //     exit();
    // } else{
    //     echo "Something went wrong. Please try again later.";
    // }
     
    // Close statement
    // mysqli_stmt_close($stmt_1);
    mysqli_stmt_close($stmt_2);
}

// Close connection
mysqli_close($link);
}

?>