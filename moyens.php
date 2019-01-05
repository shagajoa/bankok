<?php include '../modules/head.php'; ?>

<?php include '../modules/navbar_backoffice.php'; ?>

    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Detail des moyens de paiement</h2>
                        <a href="create_moyen.php" class="btn btn-success pull-right">Créer un nouveau moyen de paiement </a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM PAYMENT_METHODS";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Methode</th>";
                                        echo "<th>Numéro de série</th>";
                                        echo "<th>Date de commande</th>";
                                        echo "<th>Date de validation</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                    echo "<td>" . $row['PAYMENT_ID'] . "</td>";
                                        echo "<td>" . $row['PAYMENT_METHOD'] . "</td>";
                                        echo "<td>" . $row['PAYMENT_SERIAL_NUMBER'] . "</td>";
                                        echo "<td>" . $row['PAYMENT_DATE_OF_ORDER'] . "</td>";
                                        echo "<td>" . $row['PAYMENT_DATE_OF_VALIDATION'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='voir_moyen.php?id=". $row['PAYMENT_ID'] ."' title='Voir' data-toggle='tooltip'><span class='btn btn-primary'>View</span></a>";
                                            echo "<a href='update_moyen.php?id=". $row['PAYMENT_ID'] ."' title='Modifier' data-toggle='tooltip'><span class='btn btn-primary'>Update</span></a>";
                                            echo "<a href='delete_moyen.php?id=". $row['PAYMENT_ID'] ."' title='Supprimer' data-toggle='tooltip'><span class='btn btn-primary'>Delete</span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>Aucune donnée.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>

<?php include '../modules/end.php'; ?>  