<?php


require_once "../controllers/pdo_connect.php";

$my_users = $bdd->prepare("SELECT * FROM users WHERE agency_id = ?");
$my_users->execute(array($_SESSION["agency_id"]));

echo "<form method='post' action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "'>";
echo "<select name='selected_user'>";


while ($row = $my_users->fetch()) {
echo "<option value='". $row['user_id'] . "'>" . $row['user_last_name'] . " - " . $row['user_first_name'] . "</option>";
}
echo "</select>
    <input type='submit'>
    </form>";

//$_POST ['selected_user'];
