<?php

session_start();

if (isset($_SESSION['agency_id'])) {

require_once "../controllers/pdo_connect.php";
include '../modules/head.php';
include '../modules/b_nav_bar.php';

?>


<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h2 class="pull-left">Détails des comptes</h2>
                </div>
                <?php

            include '../modules/b_select_user.php';
            
            

            if (isset($_POST['selected_user'])) {

            $accounts = $bdd->prepare('SELECT * FROM accounts WHERE account_user_id = ?');
            $accounts->execute(array($_POST['selected_user']));
            $count = $accounts->rowCount();
            
            if($count > 0){
                echo "<table class='table table-bordered table-striped'>";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>Clé</th>";
                            echo "<th>Nom</th>";
                            echo "<th>Type</th>";
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
                            echo "<td>" . $row['account_type'] . "</td>";
                            echo "<td>" . $row['account_rib'] . "</td>";
                            echo "<td>" . $row['account_balance'] . "</td>";
                            echo "<td>" . $row['account_overdraft'] . "</td>";
                            echo "<td>" . $row['account_status'] . "</td>";
                            echo "<td>";
                                    echo "<div class='btn-group'>";
                                    if ($row['account_status'] == 'valide') {
                                        echo "<div class='btn-group'>";
                                        $row_account_id = $row['account_id'];
                                        echo "<a href='../controllers/pdo_b_delete_acc.php?acc_id=".$row_account_id."'><button type='button' class='btn btn-primary'>Supprimer </button></a></div>";
                                    }
                                    else if ($row['account_status'] == 'pending') {
                                        echo "<div class='btn-group'>";
                                        $row_account_id = $row['account_id'];
                                        echo "<a href='../controllers/pdo_b_validate_acc.php?acc_id=".$row_account_id."'><button type='button' class='btn btn-primary'>Valider </button></a></div>";
                                        echo "<a href='../controllers/pdo_b_reject_acc.php?acc_id=".$row_account_id."'><button type='button' class='btn btn-primary'>Refuser </button></a></div>";
                                        

                                    }
                                    else if ($row['account_status'] == 'rejected') {
                                        echo "<p class='lead'><em>Cette demande de compte a été rejetée </em></p>";
                                        
                                    }
                                    echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";                            
                        echo "</table>";
                    } else{
                        echo "<p class='lead'><em>Ce client n'a pas de compte bancaire pour le moment </em></p>";
                    }

            // Close connection
            $accounts->closeCursor();

            } else {
                echo "<p class='lead'><em>Sélectionner un client.</em></p>";
            }
        
            ?>
        </div>
    </div>        
</div>
</div>

<?php include '../modules/end.php';

} else {
    header('location:../pages/b_login.php');
}
