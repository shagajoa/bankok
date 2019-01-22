<?php

session_start();
require_once "../controllers/pdo_connect.php";
include '../modules/head.php';
include '../modules/b_nav_bar.php';

?>

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h2 class="pull-left">Detail des clients</h2>
                    <a href="b_create_user.php" class="btn btn-success">Créer un nouveau client</a>
                </div>

                <?php


                $accounts = $bdd->prepare('SELECT * FROM users WHERE agency_id = ?');
                $accounts->execute(array($_SESSION["agency_id"]));
                $count = $accounts->rowCount();
                
                    if($count > 0){
                        echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>Nom de famille</th>";
                                    echo "<th>Prénom</th>";
                                    echo "<th>Email</th>";
                                    echo "<th>Téléphone</th>";
                                    echo "<th>Date de naissance</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = $accounts->fetch()){
                                echo "<tr>";
                                    echo "<td>" . $row['user_last_name'] . "</td>";
                                    echo "<td>" . $row['user_first_name'] . "</td>";
                                    echo "<td>" . $row['user_email'] . "</td>";
                                    echo "<td>" . $row['user_phone'] . "</td>";
                                    echo "<td>" . $row['user_date_of_birth'] . "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";                            
                        echo "</table>";

                    } else{
                        echo "<p class='lead'><em>Il n'y a pas de clients dans votre agence.</em></p>";
                    }

                // Close connection
                $accounts->closeCursor();

                ?>
            </div>
        </div>        
    </div>
</div>

</body>

<?php include '../modules/end.php'; ?>  