<?php
// Include config file
require_once "pdo_connect.php";
 
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
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Créer méthode</title>
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
                        <h2>Création</h2>
                    </div>
                    <p>Ajouter méthode.</p>
                    <form fon="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($methode_err)) ? 'has-error' : ''; ?>">
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
                        <a href="b_moyens.php" class="btn btn-default">Annuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>