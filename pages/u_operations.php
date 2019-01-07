<?php

session_start();

if(isset($_SESSION["user_id"])) {

require_once "../controllers/pdo_connect.php";
include '../modules/head.php';
include '../modules/u_nav_bar.php';

?>


<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h2 class="pull-left">Detail de mes comptes</h2>
                    <a href="u_create_ope.php" class="btn btn-success">Créer un nouveau compte</a>
                </div>

                <?php

                if (isset($_SESSION["user_id"])) {

                $accounts = $bdd->prepare('SELECT * FROM operations WHERE ope_acc_id_1 = ?');
                $accounts->execute(array($_SESSION["user_id"]));
                $count = $accounts->rowCount();
                
                    if($count > 0){
                        echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>Clé</th>";
                                    echo "<th>Méthode</th>";
                                    echo "<th>Montant</th>";
                                    echo "<th>Date</th>";
                                    echo "<th>Bénéficiaire</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = $accounts->fetch()){
                                echo "<tr>";
                                    echo "<td>" . $row['ope_id'] . "</td>";
                                    echo "<td>" . $row['ope_method'] . "</td>";
                                    echo "<td>" . $row['ope_amount'] . "</td>";
                                    echo "<td>" . $row['ope_date'] . "</td>";
                                    echo "<td>" . $row['ope_acc_id_2'] . "</td>";

                                echo "</tr>";
                            }
                            echo "</tbody>";                            
                        echo "</table>";

                    } else{
                        echo "<p class='lead'><em>Vous n'avez pas fait d'opérations. </em></p>";
                    }

                // Close connection
                $accounts->closeCursor();

                } else {

                    echo "Your session has expired, please login again.";
                }
                ?>
            </div>
        </div>        
    </div>
</div>

</body>

<?php include '../modules/end.php';
} else {
    header('location:../pages/u_login.php');
}  