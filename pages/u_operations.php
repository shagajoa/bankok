<?php

session_start();

if(isset($_SESSION["user_id"])) {

require_once "../controllers/pdo_connect.php";
include '../modules/head.php';
include '../modules/u_nav_bar.php';

?>


<div class="container" style = "padding-top: 68px;
    padding-bottom: 50px;">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="card-title mb-4">
                            <div class="d-flex justify-content-start">
                                <div class="userData ml-3">
                                    <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold">
                                    Les opérations de
                                    <?php echo $_SESSION["user_last_name"]. " " . $_SESSION["user_first_name"]; ?></h2>
                                </div>
                            </div>
                        </div>

                    <a href="u_create_ope_1.php" class="btn btn-success">Nouvelle opération</a>
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
                                    echo "<th>Date</th>";
                                    echo "<th>Méthode</th>";
                                    echo "<th>Emetteur</th>";
                                    echo "<th>Bénéficiaire</th>";
                                    echo "<th>Montant</th>";
                                    
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = $accounts->fetch()){
                                echo "<tr>";
                                    echo "<td>" . $row['ope_date'] . "</td>";
                                    echo "<td>" . $row['ope_method'] . "</td>";
                                    include "../controllers/pdo_u_ope_benef.php";                                    
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