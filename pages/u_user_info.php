<?php

session_start();

if(isset($_SESSION["user_id"])) {

require_once '../controllers/pdo_u_user_info.php';
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
                                    <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold"><?php echo $_SESSION["user_last_name"]. " " . $_SESSION["user_first_name"]; ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Informations personnelles</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="adress-tab" data-toggle="tab" href="#adress" role="tab" aria-controls="adress" aria-selected="false">Adresse</a>
                                    </li>
                                </ul>
                                <div class="tab-content ml-1" id="myTabContent">
                                    <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
                                        

                                        <div class="row">
                                            <div class="col-sm-3 col-md-4 col-5">
                                                <label style="font-weight:bold;">Nom de famille</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?php echo $_SESSION["user_last_name"]; ?>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-4 col-5">
                                                <label style="font-weight:bold;">Prénom</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?php echo $_SESSION["user_first_name"]; ?>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-5 col-md-4 col-5">
                                                <label style="font-weight:bold;">Adresse email</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?php echo $_SESSION["user_email"]; ?>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-4 col-5">
                                                <label style="font-weight:bold;">Téléphone</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?php echo $_SESSION["user_phone"]; ?>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-4 col-5">
                                                <label style="font-weight:bold;">Date de naissance</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?php echo $_SESSION["user_date_of_birth"]; ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="adress" role="tabpanel" aria-labelledby="ConnectedServices-tab">
                                    <div class="row">
                                            <div class="col-sm-3 col-md-4 col-5">
                                                <label style="font-weight:bold;">Numéro de rue</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?php echo $add_number; ?>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-5 col-md-4 col-5">
                                                <label style="font-weight:bold;">Nom de rue</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?php echo $add_street; ?>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-4 col-5">
                                                <label style="font-weight:bold;">Code postal</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?php echo $add_postal_code; ?>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-4 col-5">
                                                <label style="font-weight:bold;">Ville</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?php echo $add_city; ?>
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
    </div>

<?php include '../modules/end.php';  
} else {
    header('location:../pages/u_login.php');
}