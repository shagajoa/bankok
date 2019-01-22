<?php

session_start();
require_once "../controllers/pdo_connect.php";
include '../modules/head.php';
include '../modules/b_nav_bar.php';

if (isset($_SESSION["agency_id"])) {

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
                                    <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold"><?php echo $_SESSION["agency_name"]; ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Informations</a>
                                    </li>
                                </ul>
                                <div class="tab-content ml-1" id="myTabContent">
                                    <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
                                        

                                        <div class="row">
                                            <div class="col-sm-3 col-md-4 col-5">
                                                <label style="font-weight:bold;">Numéro</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?php echo $_SESSION["add_number"]; ?>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-4 col-5">
                                                <label style="font-weight:bold;">Rue</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?php echo $_SESSION["add_street"]; ?>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-5 col-md-4 col-5">
                                                <label style="font-weight:bold;">Code postal</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?php echo $_SESSION["add_postal_code"]; ?>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-4 col-5">
                                                <label style="font-weight:bold;">Ville</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?php echo $_SESSION["add_city"]; ?>
                                            </div>
                                        </div>

                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>

<?php include '../modules/end.php';  
} else {
    header('location:../pages/b_login.php');
}