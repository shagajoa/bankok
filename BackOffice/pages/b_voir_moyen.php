<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "pdo_connect.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM PAYMENT_METHODS WHERE PAYMENT_ID = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
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
                // URL doesn't contain valid id parameter. Redirect to error page
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
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: b_error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Voir Moyen</title>
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
                        <h1>Voir données</h1>
                    </div>
                    <div class="form-group">
                        <label>Methode</label>
                        <p class="form-control-static"><?php echo $row["PAYMENT_METHOD"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Numéro de série</label>
                        <p class="form-control-static"><?php echo $row["PAYMENT_SERIAL_NUMBER"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Date de commande</label>
                        <p class="form-control-static"><?php echo $row["PAYMENT_DATE_OF_ORDER"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Date de validation</label>
                        <p class="form-control-static"><?php echo $row["PAYMENT_DATE_OF_VALIDATION"]; ?></p>
                    </div>   
                    <p><a href="b_moyens.php" class="btn btn-primary">Retour</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>