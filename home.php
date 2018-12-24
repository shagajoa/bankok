<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bankok</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light" >
        <a class="navbar-brand" href="../bankok/home.php">BankOK</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="../bankok/home.php"> <span class="sr-only">Accueil</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Menu</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="pages/comptes.php" >Comptes</a>
                            <a class="dropdown-item" href="pages/operations.php">Opérations</a>
                            <a class="dropdown-item" href="pages/beneficiaires.php">Bénéficiaires</a>
                            <a class="dropdown-item" href="pages/moyens.php">Moyens de paiement</a>
                            <a class="dropdown-item" href="pages/info_perso.php">Mes informations</a>
                        </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Déconnexion</a>
                </li>
            </ul>
        </div>
</nav>

<?php include 'modules/caroussel.php'; ?>

<?php include 'modules/end.php'; ?>