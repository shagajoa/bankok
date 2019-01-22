<?php

require_once "../controllers/pdo_connect.php";

$my_users = $bdd->prepare("SELECT * FROM users WHERE agency_id = ?");
$my_users->execute(array($_SESSION["agency_id"])); ?>

<div class="form-group row">
    <div class="card-group">

    <form method='post' action=' <?php htmlspecialchars($_SERVER['PHP_SELF']) ?> '>
    <div class="card-body">
        <select name='selected_user'>
    <?php
        while ($row = $my_users->fetch()) {
        echo "<option value='". $row['user_id'] . "'>" . $row['user_last_name'] . " - " . $row['user_first_name'] . "</option>";
        } ?>

        </select>
    </div>

    <div class="card-body">
        <div class='form-group'>
          <div class='custom-control custom-radio'>
            <input type='radio' id='customRadio1' name='moyen' value ='cheq' class='custom-control-input' checked=''>
            <label class='custom-control-label' for='customRadio1'>Chéquier</label>
          </div>
          <div class='custom-control custom-radio'>
            <input type='radio' id='customRadio2' name='moyen' value ='card' class='custom-control-input'>
            <label class='custom-control-label' for='customRadio2'>Cartes de crédit</label>
          </div>
        </div>
    </div>

    <div class="card-body">
      <input type='submit'>
    </div>
    
</form>
</div>
</div>

<!-- 
$_POST['selected_user'];
$_POST['moyen']; 
-->
