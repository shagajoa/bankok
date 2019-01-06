<?php 
session_start();
require_once "../controllers/pdo_connect.php";

// Define variables and initialize with empty values
$methode = $serie = $commande = $validation = "";
$methode_err = $serie_err = $commande_err = $validation_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate nom
    $input_methode = trim($_POST["methode"]);
    if(empty($input_methode)){
        $methode_err = "Entrer une methode.";
    } else{
        $methode = $input_methode;
    }
    
    // Validate prenom
    $input_serie = trim($_POST["serie"]);
    if(empty($input_serie)){
        $serie_err = "Entrer un numero de serie.";     
    } else{
        $serie = $input_serie;
    }
    
    // Validate mail
    $input_commande = trim($_POST["commande"]);
    if(empty($input_commande)){
        $commande_err = "Entrer une date de commande.";
    } else{
        $commande = $input_commande;
    }
     // Validate tel
     $input_validation = trim($_POST["validation"]);
     if(empty($input_validation)){
         $validation_err = "Entrer une date de validation.";
     } else{
         $validation = $input_validation;
     }
    
    
    // Check input errors before inserting in database
    if(empty($methode_err) && empty($serie_err) && empty($commande_err) && empty($validation_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO PAYMENT_METHODS (PAYMENT_METHOD, PAYMENT_SERIAL_NUMBER, PAYMENT_DATE_OF_ORDER, PAYMENT_DATE_OF_VALIDATION) VALUES (?, ?, ?, ?)";
   
        if($stmt = mysqli_prepare($link, $sql)){
            
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_methode, $param_serie, $param_commande, $param_validation);
            
            // Set parameters
            $param_methode = $methode;
            $param_serie = $serie;
            $param_commande = $commande;
            $param_validation = $validation;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: b_moyens.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>