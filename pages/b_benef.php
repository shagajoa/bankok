<?php
session_start();
if(isset($_SESSION["user_id"])) {
require_once "../controllers/pdo_connect.php";
include '../modules/head.php';
include '../modules/b_nav_bar.php';
?>


<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h2 class="pull-left">Bénéficiaires</h2>
                </div>
                <?php

include '../modules/b_select_user.php';

?>

<?php

                if (isset($_POST['selected_user'])) {


                    $benef = $bdd->prepare('SELECT b.benef_id, u.user_last_name, u.user_first_name, a.account_name, a.account_type, a.account_rib, b.benef_status
                    FROM users u
                    INNER JOIN accounts a ON a.account_user_id = u.user_id
                    INNER JOIN beneficiaries b ON b.account_id_2 = a.account_id
                    where b.account_id_1 IN (SELECT account_id
                                             FROM accounts
                                             WHERE account_user_id = ?)');
                    
                    $benef->execute(array($_POST["selected_user"]));
                    $count = $benef->rowCount();
                    
                    if($count > 0){
                        echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>Bénéficiaire</th>";
                                    echo "<th>Compte bénéficiaire</th>";
                                    echo "<th>Type du compte</th>";
                                    echo "<th>RIB bénéficiaire</th>";
                                    echo "<th>Status</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = $benef->fetch()){
                                echo "<tr>";
                                    echo "<td>" . $row['user_last_name'] . " " . $row['user_first_name'] . "</td>";
                                    echo "<td>" . $row['account_name'] . "</td>";
                                    echo "<td>" . $row['account_type'] . "</td>";
                                    echo "<td>" . $row['account_rib'] . "</td>";
                                    echo "<td>" . $row['benef_status'] . "</td>";
                                    echo "<td>";
                                        if ($row['benef_status'] == 'valide') {
                                        echo "<div class='btn-group'>";
                                        $row_benef_id = $row['benef_id'];
                                        echo "<a href='../controllers/pdo_u_delete_benef.php?benef_id=".$row_benef_id."'><button type='button' class='btn btn-primary'>Supprimer </button></a></div>";
                                        }
                                    echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";                            
                        echo "</table>";
                    } else {
                        echo "<p class='lead'><em>Ce client n'a aucun bénéficiaire. </em></p>";
                    }
                // Close connection
                $benef->closeCursor();
                } else
                ?>
            </div>
        </div>        
    </div>
</div>


<?php include '../modules/end.php';
} else {
    header('location:../pages/b_login.php');
}   