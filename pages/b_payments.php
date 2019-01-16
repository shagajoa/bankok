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
                    <h2 class="pull-left">Detail moyens de paiement</h2>
                </div>
                <?php

include '../modules/b_select_user.php';

?>

<?php

if (isset($_POST['selected_user'])) {



                $payments = $bdd->prepare('SELECT * FROM payment_methods WHERE payment_id = ?');
                $payments->execute(array($_POST['selected_user']));
                $count = $payments->rowCount();
                
                    if($count > 0){
                        echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>Clé</th>";
                                    echo "<th>Methode</th>";
                                    echo "<th>Numéro de série de l'outil financier</th>";
                                    echo "<th>Date de demande</th>";
                                    echo "<th>Statut</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = $payments->fetch()){
                                echo "<tr>";
                                    echo "<td>" . $row['payment_id'] . "</td>";
                                    echo "<td>" . $row['payment_method'] . "</td>";
                                    echo "<td>" . $row['payment_serial_number'] . "</td>";
                                    echo "<td>" . $row['payment_date_order'] . "</td>";
                                    echo "<td>" . $row['payment_status'] . "</td>";
                                    echo "<td>";
                                        echo "<div class='btn-group'>";
                                        $row_payment_id = $row['payment_id'];
                                        echo "<a href='../controllers/pdo_b_delete_acc.php?acc_id=".$row_payment_id."'><button type='button' class='btn btn-primary'>Supprimer </button></a></div>";
                                    echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";                            
                        echo "</table>";

                    } else{
                        echo "<p class='lead'><em>Vous n'avez aucune carte bleue ni chèque à valider </em></p>";
                    }

                // Close connection
                $payments->closeCursor();

                } else
                ?>
            </div>
        </div>        
    </div>
</div>

<?php include '../modules/end.php'; ?>  