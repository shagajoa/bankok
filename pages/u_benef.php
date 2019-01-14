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
                    <h2 class="pull-left">Mes bénéficiaires</h2>
                    <a href="u_create_benef.php" class="btn btn-success">Nouveau bénéficiaire</a>
                </div>

                <?php

                if (isset($_SESSION["user_id"])) {

                    $my_benef = $bdd->prepare('SELECT b.benef_id, u.user_last_name, u.user_first_name, a.account_name, a.account_rib, b.benef_status
                    FROM users u
                    INNER JOIN accounts a ON a.account_user_id = u.user_id
                    INNER JOIN beneficiaries b ON b.account_id_2 = a.account_id
                    where b.account_id_1 IN (SELECT account_id
                                             FROM accounts
                                             WHERE account_user_id = ?)');
                    
                    $my_benef->execute(array($_SESSION["user_id"]));
                    $count = $my_benef->rowCount();
                    

                    if($count > 0){
                        echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>Nom</th>";
                                    echo "<th>Prénom</th>";
                                    echo "<th>Nom du compte</th>";
                                    echo "<th>RIB</th>";
                                    echo "<th>Status</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = $my_benef->fetch()){
                                echo "<tr>";
                                    echo "<td>" . $row['user_last_name'] . "</td>";
                                    echo "<td>" . $row['user_first_name'] . "</td>";
                                    echo "<td>" . $row['account_name'] . "</td>";
                                    echo "<td>" . $row['account_rib'] . "</td>";
                                    echo "<td>" . $row['benef_status'] . "</td>";
                                    echo "<td>";
                                        echo "<div class='btn-group'>";
                                        if ($row['benef_status'] == 'valide') {
                                        $row_account_id = $row['benef_id'];
                                        echo "<a href='../controllers/pdo_u_delete_acc.php?acc_id=".$row_account_id."'><button type='button' class='btn btn-primary'>Supprimer </button></a></div>";
                                        }
                                    echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";                            
                        echo "</table>";

                    } else{
                        echo "<p class='lead'><em>Vous n'avez pas encore de compte bancaire. Veuillez en créer un. </em></p>";
                    }

                // Close connection
                $my_benef->closeCursor();

                } else {

                    echo "Your session has expired, please login again.";
                }
                ?>
            </div>
        </div>        
    </div>
</div>


<?php include '../modules/end.php';
} else {
    header('location:../pages/u_login.php');
}   