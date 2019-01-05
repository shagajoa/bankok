<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$nom = $rib = $solde = $decouvert = "";
$nom_err = $rib_err = $solde_err = $decouvert_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate nom
    $input_nom = trim($_POST["nom"]);
    if(empty($input_nom)){
        $nom_err = "Entrer un nom.";
    } else{
        $nom = $input_nom;
    }
    
    // Validate prenom
    $input_rib = trim($_POST["rib"]);
    if(empty($input_rib)){
        $rib_err = "Entrer le RIB.";     
    } else{
        $rib = $input_rib;
    }
    
    // Validate mail
    $input_solde = trim($_POST["solde"]);
    if(empty($input_solde)){
        $solde_err = "Entrer le solde";
    } else{
        $solde = $input_solde;
    }

     // Validate tel
     $input_decouvert = trim($_POST["decouvert"]);
     if(empty($input_decouvert)){
         $decouvert_err = "Entrer le découvert autorisé.";
     } else{
         $decouvert = $input_decouvert;
     }
    
    // Check input errors before inserting in database
    if(empty($nom_err) && empty($rib_err) && empty($solde_err) && empty($decouvert_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO ACCOUNTS (ACCOUNT_NAME, ACCOUNT_RIB, ACCOUNT_BALANCE, ACCOUNT_OVERDRAFT) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_nom, $param_rib, $param_solde, $param_decouvert);
            
            // Set parameters
            $param_nom = $nom;
            $param_rib = $rib;
            $param_solde = $solde;
            $param_decouvert = $decouvert;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: comptes.php");
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
    <title>Créer compte</title>
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
                    <p>Ajouter compte</p>
                    <form fon="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($nom_err)) ? 'has-error' : ''; ?>">
                            <label>Nom</label>
                            <input type="text" name="nom" class="form-control" value="<?php echo $nom; ?>">
                            <span class="help-block"><?php echo $nom_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($rib)) ? 'has-error' : ''; ?>">
                            <label>RIB</label>
                            <textarea name="rib" class="form-control"><?php echo $rib; ?></textarea>
                            <span class="help-block"><?php echo $rib;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($solde_err)) ? 'has-error' : ''; ?>">
                            <label>Solde</label>
                            <input type="text" name="solde" class="form-control" value="<?php echo $solde; ?>">
                            <span class="help-block"><?php echo $solde_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($decouvert_err)) ? 'has-error' : ''; ?>">
                            <label>Découvert</label>
                            <textarea name="decouvert" class="form-control"><?php echo $decouvert; ?></textarea>
                            <span class="help-block"><?php echo $decouvert_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Soumettre">
                        <a href="comptes.php" class="btn btn-default">Annuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>