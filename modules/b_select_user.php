<?php

session_start();
require_once "../controllers/pdo_connect.php";

echo "<select name='selected_user'>";

$my_users = $bdd->prepare("SELECT * FROM users WHERE agency_id = ?");
$my_users->execute(array($_SESSION["agency_id"]));

while ($row = $my_users->fetch()) {
echo "<option value='". $row['user_id'] . "'>" . $row['user_last_name'] . " - " . $row['user_first_name'] . "</option>";
}

echo "</select>";

//pour recup l'id de l'user sélectionner
// $_POST['selected_user'];