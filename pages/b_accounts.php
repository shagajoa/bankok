<?php

session_start();
include '../modules/head.php';
include '../modules/b_nav_bar.php';

?>

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h2 class="pull-left">Detail des comptes</h2>
                    <a href="b_create_account.php" class="btn btn-success">Créer un nouveau compte</a>
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
                                    echo "<td>";
                                        echo "  <div class='btn-group'>
                                        <a href=b_modify_account.php> <button type='button' class='btn btn-primary'>Modifier </button>
                                        </div>";
                                        echo "  <div class='btn-group'>
                                                <a href=b_delete_account.php> <button type='button' class='btn btn-primary'>Supprimer </button>
                                                </div>";
                                    echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";                            
                        echo "</table>";

                    } else{
                        echo "<p class='lead'><em>Cet utilisateur ne possède pas de compte bancaire.</em></p>";
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

<?php include '../modules/end.php'; ?>  