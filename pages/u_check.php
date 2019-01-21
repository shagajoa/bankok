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
                                    Les chéquiers de
                                    <?php echo $_SESSION["user_last_name"]. " " . $_SESSION["user_first_name"]; ?></h2>
                                </div>
                            </div>
                        </div>

                    <a href="#" class="btn btn-success">Nouveau chéquier</a>
                </div>


                <div class="panel-group" id="accordion" >

                    <?php 
                    $accounts = $bdd->prepare("SELECT * FROM accounts WHERE account_type = 'Courant' AND account_user_id = ?");
                    $accounts->execute(array($_SESSION["user_id"]));
                    $i = 1;

                    while($row_a = $accounts->fetch()) { ?>

                    <div class="card">
                        <div class="card-header">
                                <h5 class="mb-0">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i ?>">
                                    <?php echo $row_a["account_name"] . " - " . $row_a['account_rib']?>
                                    </a>
                                </h5>
                            </div>

                            <div id="collapse<?php echo $i ?>" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <table class='table table-bordered table-striped'>
                                        <?php 
                                        $cheq = $bdd->prepare("SELECT * FROM cheq WHERE cheq_account_id = ?");
                                        $cheq->execute(array($row_a["account_id"]));
                                        $count = $cheq->rowCount();
                
                                        if($count > 0){
                                            echo "<table class='table table-bordered table-striped'>";
                                                echo "<thead>";
                                                    echo "<tr>";
                                                        echo "<th>Numéro de série</th>";
                                                        echo "<th>Nombre de pages</th>";
                                                        echo "<th>Status</th>";
                                                    echo "</tr>";
                                                echo "</thead>";
                                                echo "<tbody>";

                                        while($row_c = $cheq->fetch()) {
                                            echo "<tr>";
                                                echo "<td>" . $row_c['cheq_serial'] . "</td>";
                                                echo "<td>" . $row_c['cheq_pages'] . "</td>";
                                                echo "<td>" . $row_c['cheq_status'] . "</td>";
                                            echo "</tr>";
                                        } ?>
                                        </table>
                                    <?php 
                                    } else {echo `<p class='lead'><em>Vous n'avez pas encore de chéquier, vous pouvez en commander un en cliquant sur "Nouveau chéquier" </em></p>`; } 
                                echo "</div>";  
                            echo "</div>"; 
                        $i++; } ?>
                </div>
            </div>
        </div>
    </div>

<?php include '../modules/end.php';

} else {
    header('location:../pages/u_login.php');
}  