<?php
// Include config file
require_once "../controllers/pdo_connect.php";
 
// Define variables and initialize with empty values
$nom = $prenom = $mail = $tel = $datenaissance = "";
$nom_err = $prenom_err = $mail_err = $tel_err = $datenaissance_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    $input_prenom = trim($_POST["prenom"]);
    if(empty($input_prenom)){
        $prenom_err = "Entrer un prénom.";     
    } else{
        $prenom = $input_prenom;
    }
    
    // Validate mail
    $input_mail = trim($_POST["mail"]);
    if(empty($input_mail)){
        $mail_err = "Entrer une adresse mail.";
    } else{
        $mail = $input_mail;
    }
     // Validate tel
     $input_tel = trim($_POST["tel"]);
     if(empty($input_tel)){
         $tel_err = "Entrer un numéro de téléphone.";
     } else{
         $tel = $input_tel;
     }
      // Validate date de naissance
    $input_datenaissance = trim($_POST["datenaissance"]);
    if(empty($input_datenaissance)){
        $datenaissance_err = "Entrer une date de naissance";
    } else{
        $datenaissance = $input_datenaissance;
    }
    
    // Check input errors before inserting in database
    if(empty($nom_err) && empty($prenom_err) && empty($mail_err) && empty($tel_err) && empty($datenaissance_err)){
        // Prepare an update statement
        $sql = "UPDATE USERS SET USER_LAST_NAME=?, USER_FIRST_NAME=?, USER_MAIL=?, USER_PHONE=?, USER_DATE_OF_BIRTH=? WHERE USER_ID=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_nom, $param_prenom, $param_mail, $param_tel, $param_datenaissance);
            
            // Set parameters
            $param_nom = $Nom;
            $param_prenom = $Prénom;
            $param_mail = $email;
            $param_tel = $Tél;
            $param_datenaissance = $Date_de_naissance;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: b_utilisateurs.php");
                exit();
            } else{
                echo "Erreur, recommencez plus tard svp. Sawatdee.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM USERS WHERE USER_ID = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                $nom = $row["USER_LAST_NAME"];
                $prenom = $row["USER_FIRST_NAME"];
                $mail = $row["USER_EMAIL"];
                $tel = $row["USER_PHONE"];
                $date_naissance = $row["USER_DATE_OF_BIRTH"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: b_error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: b_error.php");
        exit();
    }
}
?>