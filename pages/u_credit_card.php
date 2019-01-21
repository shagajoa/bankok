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
                                    Les cartes de 
                                    <?php echo $_SESSION["user_last_name"]. " " . $_SESSION["user_first_name"]; ?></h2>
                                </div>
                            </div>
                        </div>

                    <a href="#" class="btn btn-success">Nouvelle carte</a>
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
                                        $card = $bdd->prepare("SELECT * FROM ccard WHERE card_account_id = ?");
                                        $card->execute(array($row_a["account_id"]));
                                        $count = $card->rowCount();
                
                                        if($count > 0){
                                            echo "<table class='table table-bordered table-striped'>";
                                                echo "<thead>";
                                                    echo "<tr>";
                                                        echo "<th>Type</th>";
                                                        echo "<th>Numéro de carte</th>";
                                                        echo "<th>Status</th>";
                                                        echo "<th>Date d'expiration</th>";
                                                    echo "</tr>";
                                                echo "</thead>";
                                                echo "<tbody>";

                                        while($row_c = $card->fetch()) {
                                            echo "<tr>";
                                                echo "<td>" . $row_c['card_type'] . "</td>";
                                                echo "<td>" . $row_c['card_serial'] . "</td>";
                                                echo "<td>" . $row_c['card_status'] . "</td>";
                                                echo "<td>" . $row_c['card_exp_date'] . "</td>";
                                                echo "<td>";
                                                if ($row_c['card_status'] == 'valide') {
                                                    echo "<div class='btn-group'>";
                                                    $row_card_id = $row_c['card_id'];
                                                    echo "<a href='#?card_id=".$row_card_id."'><button type='button' class='btn btn-primary'> Faire opposition </button></a></div>";
                                                }
                                                echo "</td>";
                                            echo "</tr>";
                                        } ?>
                                        </table>
                                    <?php 
                                    } else {echo "<p class='lead'><em>Vous n'avez pas encore de compte bancaire. Veuillez en créer un. </em></p>"; } 
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