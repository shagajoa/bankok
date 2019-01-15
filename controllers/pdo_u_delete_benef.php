<?php 
session_start();
require_once "../controllers/pdo_connect.php";

// récupéré l'id du compte à supprimer

$id = $_GET["benef_id"];

$delete_benef = $bdd->prepare("DELETE FROM beneficiaries WHERE benef_id = ?");
$delete_benef->execute(array($id));
echo '<script type="text/javascript">alert("Votre bénéficiaire a bien été supprimé.");window.history.go(-1);</script>';

