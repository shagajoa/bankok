<?php 
session_start();
require_once "../controllers/pdo_connect.php";

// récupéré l'id du compte à supprimer

$user_last_name = $_GET["last_name"];