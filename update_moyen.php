<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$methode = $serie = $commande = $validation = "";
$methode_err = $serie_err = $commande_err = $validation_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
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
        // Prepare an update statement
        $sql = "UPDATE PAYMENT_METHODS SET PAYMENT_METHOD=?, PAYMENT_SERIAL_NUMBER=?, PAYMENT_DATE_OF_ORDER=?, PAYMENT_DATE_OF_VALIDATION=? WHERE PAYMENT_ID=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_methode, $param_serie, $param_commande, $param_validation);
            
            // Set parameters
            $param_methode = $methode;
            $param_serie = $serie;
            $param_commande = $commande;
            $param_validation = $validation;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: utilisateurs.php");
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
        $sql = "SELECT * FROM PAYMENT_METHODS WHERE PAYMENT_ID = ?";
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
                    $methode = $row["PAYMENT_METHOD"];
                    $serie = $row["PAYMENT_SERIAL_NUMBER"];
                    $commande = $row["PAYMENT_DATE_OF_ORDER"];
                    $validation = $row["PAYMENT_DATE_OF_VALIDATION"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
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
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mettre à jour moyen de paiement</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Mettre à jour</h2>
                    </div>
                    <label>Moyen de paiement</label>
                            <input type="text" name="methode" class="form-control" value="<?php echo $methode; ?>">
                            <span class="help-block"><?php echo $methode_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($serie_err)) ? 'has-error' : ''; ?>">
                            <label>Numéro de série</label>
                            <textarea name="serie" class="form-control"><?php echo $serie; ?></textarea>
                            <span class="help-block"><?php echo $serie_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($commande_err)) ? 'has-error' : ''; ?>">
                            <label>Date de commande</label>
                            <input type="text" name="commande" class="form-control" value="<?php echo $commande; ?>">
                            <span class="help-block"><?php echo $commande_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($validation_err)) ? 'has-error' : ''; ?>">
                            <label>Date de validation</label>
                            <textarea name="validation" class="form-control"><?php echo $validation; ?></textarea>
                            <span class="help-block"><?php echo $validation_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Soumettre">
                        <a href="moyens.php" class="btn btn-default">Annuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>