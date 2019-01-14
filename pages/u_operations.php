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
                    <h2 class="pull-left">Mes opérations</h2>
                    <a href="u_create_ope_1.php" class="btn btn-success">Nouveau virement</a>
                </div>

                <?php

                $accounts = $bdd->prepare("SELECT DISTINCT ope_id, ope_method, ope_amount, ope_date, ope_acc_id_1, ope_acc_id_2 FROM operations o
                INNER JOIN accounts a ON a.account_id = o.ope_acc_id_1 OR a.account_id = o.ope_acc_id_2
                WHERE a.account_user_id = ?");
                $accounts->execute(array($_SESSION["user_id"]));
                $count = $accounts->rowCount();
                
                    if($count > 0){
                        echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>Clé</th>";
                                    echo "<th>Méthode</th>";
                                    echo "<th>Bénéficiaire</th>";
                                    echo "<th>Date</th>";
                                    echo "<th>Montant</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = $accounts->fetch()){
                                echo "<tr>";
                                    echo "<td>" . $row['ope_id'] . "</td>";
                                    echo "<td>" . $row['ope_method'] . "</td>";
                                    include "../controllers/pdo_u_ope_benef.php";
                                    echo "<td>" . $row['ope_date'] . "</td>";
                                    include "../controllers/pdo_u_ope_amount.php";
                                    
                                echo "</tr>";
                            }
                            echo "</tbody>";                            
                        echo "</table>";

                    } else{
                        echo "<p class='lead'><em>Vous n'avez pas d'opérations. </em></p>";
                    }

                // Close connection
                $accounts->closeCursor();

                
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