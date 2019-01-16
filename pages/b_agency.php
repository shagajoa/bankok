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
                    <h2 class="pull-left">Detail agence </h2>
                </div>
                <?php

include '../modules/b_select_user.php';

?>

<?php

                if (isset($_POST['selected_user'])) {

                    

                $agency = $bdd->prepare('SELECT * FROM agencies WHERE agency_id = ?');
                $agency->execute(array($_POST['selected_user']));
                $count = $agency->rowCount();
                
                    if($count > 0){
                        echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>Clé</th>";
                                    echo "<th>Nom</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = $agency->fetch()){
                                echo "<tr>";
                                    echo "<td>" . $row['agency_id'] . "</td>";
                                    echo "<td>" . $row['agency_name'] . "</td>";
                                    echo "<td>";
                                        echo "<div class='btn-group'>";
                                        $row_agency_id = $row['agency_id'];
                                        echo "<a href='../controllers/pdo_b_delete_acc.php?acc_id=".$row_agency_id."'><button type='button' class='btn btn-primary'>Supprimer </button></a></div>";
                                    echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";                            
                        echo "</table>";

                    } else{
                        echo "<p class='lead'><em>Vous n'avez pas d'agence</em></p>";
                    }

                // Close connection
                $agency->closeCursor();

                } else 
                ?>
            </div>
        </div>        
    </div>
</div>

<?php include '../modules/end.php'; ?>  