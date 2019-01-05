<?php
// Include config file
require_once "pdo_connect.php";
 
// Define variables and initialize with empty values
$nom = $prenom = $mail = $tel = $datenaissance = "";
$nom_err = $prenom_err = $mail_err = $tel_err = $datenaissance_err = "";
 
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
        // Prepare an insert statement
        $sql = "INSERT INTO USERS (USER_LAST_NAME, USER_FIRST_NAME, USER_EMAIL, USER_PHONE, USER_DATE_OF_BIRTH) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_nom, $param_prenom, $param_mail, $param_tel, $param_datenaissance);
            
            // Set parameters
            $param_nom = $Nom;
            $param_prenom = $Prénom;
            $param_mail = $email;
            $param_tel = $Tél;
            $param_datenaissance = $Date_de_naissance;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: b_utilisateurs.php");
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
    <title>Créer utilisateur</title>
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
                    <p>Ajouter utilisateur.</p>
                    <form fon="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($nom_err)) ? 'has-error' : ''; ?>">
                            <label>Nom</label>
                            <input type="text" name="nom" class="form-control" value="<?php echo $nom; ?>">
                            <span class="help-block"><?php echo $nom_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($prenom_err)) ? 'has-error' : ''; ?>">
                            <label>Prénom</label>
                            <textarea name="prenom" class="form-control"><?php echo $prenom; ?></textarea>
                            <span class="help-block"><?php echo $prenom_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($mail_err)) ? 'has-error' : ''; ?>">
                            <label>Mail</label>
                            <input type="text" name="mail" class="form-control" value="<?php echo $mail; ?>">
                            <span class="help-block"><?php echo $mail_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($tel_err)) ? 'has-error' : ''; ?>">
                            <label>Numéro de Téléphone</label>
                            <textarea name="tel" class="form-control"><?php echo $tel; ?></textarea>
                            <span class="help-block"><?php echo $tel_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                            <label>Date de naissance</label>
                            <textarea name="datenaissance" class="form-control"><?php echo $datenaissance; ?></textarea>
                            <span class="help-block"><?php echo $datenaissance_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Soumettre">
                        <a href="b_utilisateurs.php" class="btn btn-default">Annuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>