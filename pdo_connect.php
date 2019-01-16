<?php
// parameters = host; database name; login; password
try {
    $bdd = new pdo ('mysql:host=localhost;dbname=bankok','root','root');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

// catch the error if any
catch (Exception $e) {
    //end execution of page if error found
    die('Erreur : ' . $e->getMessage());
}

?>


