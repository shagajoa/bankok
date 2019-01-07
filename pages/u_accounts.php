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
                    <a href="u_create_account.php" class="btn btn-success">Nouveau compte</a>
                </div>

                <?php

                if (isset($_SESSION["user_id"])) {

                $accounts = $bdd->prepare('SELECT * FROM accounts WHERE account_user_id = ?');
                $accounts->execute(array($_SESSION["user_id"]));
                $count = $accounts->rowCount();
                
                    if($count > 0){
                        echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>Clé</th>";
                                    echo "<th>Nom</th>";
                                    echo "<th>RIB</th>";
                                    echo "<th>Solde</th>";
                                    echo "<th>Découvert autorisé</th>";
                                    echo "<th>Status</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = $accounts->fetch()){
                                echo "<tr>";
                                    echo "<td>" . $row['account_id'] . "</td>";
                                    echo "<td>" . $row['account_name'] . "</td>";
                                    echo "<td>" . $row['account_rib'] . "</td>";
                                    echo "<td>" . $row['account_balance'] . "</td>";
                                    echo "<td>" . $row['account_overdraft'] . "</td>";
                                    echo "<td>" . $row['account_status'] . "</td>";
                                    echo "<td>";
                                    if ($row['account_status'] == 'valide') {
                                        echo "<div class='btn-group'>";
                                        $row_account_id = $row['account_id'];
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
                $accounts->closeCursor();

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