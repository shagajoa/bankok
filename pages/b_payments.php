<?php

session_start();
require_once "../controllers/pdo_connect.php";
include '../modules/head.php';
include '../modules/b_nav_bar.php';

if (isset($_SESSION["agency_id"])) {

?>

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h2 class="pull-left">Details des moyens de paiement</h2>
                </div>
                <?php include '../modules/b_cheq_card.php'; 

    if (isset($_POST['selected_user'])) {

        if($_POST['moyen'] == 'cheq') { ?>

            <div class="container" style="padding-button:50px;">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <div class="card-title mb-4">
                                    <div class="d-flex justify-content-start">
                                        <div class="userData ml-3">
                                            <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold">
                                            Les chéquiers</h2>
                                        </div>
                                    </div>
                                </div>
                        </div>

                <div class="panel-group" id="accordion" >

                    <?php 
                    $accounts = $bdd->prepare("SELECT * FROM accounts WHERE account_type = 'Courant' AND account_status = 'valide' AND account_user_id = ?");
                    $accounts->execute(array($_POST['selected_user']));
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
                                                echo "<td>";
                                                echo "<div class='btn-group'>";
                                                if ($row_c['cheq_status'] == 'valide') {
                                                    echo "<div class='btn-group'>";
                                                    $row_cheq_id = $row_c['cheq_id'];
                                                    echo "<a href='../controllers/pdo_b_delete_cheq.php?acc_id=".$row_cheq_id."'><button type='button' class='btn btn-primary'>Supprimer </button></a></div>";
                                                }
                                                else if ($row_c['cheq_status'] == 'pending') {
                                                    echo "<div class='btn-group'>";
                                                    $row_cheq_id = $row_c['cheq_id'];
                                                    echo "<a href='../controllers/pdo_b_validate_cheq.php?acc_id=".$row_cheq_id."'><button type='button' class='btn btn-primary'>Valider </button></a></div>";
                                                    echo "<a href='../controllers/pdo_b_reject_cheq.php?acc_id=".$row_cheq_id."'><button type='button' class='btn btn-primary'>Refuser </button></a></div>";
                                                    
                                                }
                                                else if ($row_c['cheq_status'] == 'rejected') {
                                                    echo "<p class='lead'><em>Cette demande de compte a été rejetée </em></p>";
                                                    
                                                }
                                                echo "</td>";

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
        </div>


<?php 

} elseif ($_POST['moyen'] == 'card') {
    ?>

<div class="container" style="padding-button:50px;">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="card-title mb-4">
                            <div class="d-flex justify-content-start">
                                <div class="userData ml-3">
                                    <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold">
                                    Les cartes de crédit
                                    </h2>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="panel-group" id="accordion" >

                    <?php 
                    $accounts = $bdd->prepare("SELECT * FROM accounts WHERE account_type = 'Courant' AND account_status = 'valide' AND account_user_id = ?");
                    $accounts->execute(array($_POST['selected_user']));
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
                                                echo "<div class='btn-group'>";
                                                if ($row_c['card_status'] == 'valide') {
                                                    echo "<div class='btn-group'>";
                                                    $row_card_id = $row_c['card_id'];
                                                    echo "<a href='../controllers/pdo_b_delete_card.php?acc_id=".$row_card_id."'><button type='button' class='btn btn-primary'>Supprimer </button></a></div>";
                                                }
                                                else if ($row_c['card_status'] == 'pending') {
                                                    echo "<div class='btn-group'>";
                                                    $row_card_id = $row_c['card_id'];
                                                    echo "<a href='../controllers/pdo_b_validate_card.php?acc_id=".$row_card_id."'><button type='button' class='btn btn-primary'>Valider </button></a></div>";
                                                    echo "<a href='../controllers/pdo_b_reject_card.php?acc_id=".$row_card_id."'><button type='button' class='btn btn-primary'>Refuser </button></a></div>";
                                                    
                                                }
                                                else if ($row_c['card_status'] == 'rejected') {
                                                    echo "<p class='lead'><em>Cette demande de compte a été rejetée </em></p>";
                                                    
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
</div>

<?php
}
include '../modules/end.php';
    }

} else {
    header('location:../pages/b_login.php');
}
