<?php

//trouver l'émetteur
$emetteur = $bdd->prepare("SELECT DISTINCT u.user_last_name, u.user_first_name, a.account_name 
FROM users u 
INNER JOIN accounts a ON a.account_user_id = u.user_id 
INNER JOIN operations o ON o.ope_acc_id_1 = a.account_id 
WHERE o.ope_id = ?");
$emetteur->execute(array($row['ope_id']));
$found_emet = $emetteur->fetch();

echo "<td>" . $found_emet['user_last_name'] . " " . $found_emet['user_first_name'] . " - " . $found_emet['account_name'] . "</td>";

// trouver le bénéficiaire
$benef = $bdd->prepare("SELECT DISTINCT u.user_last_name, u.user_first_name, a.account_name 
FROM users u 
INNER JOIN accounts a ON a.account_user_id = u.user_id 
INNER JOIN operations o ON o.ope_acc_id_2 = a.account_id 
WHERE o.ope_id = ?");
$benef->execute(array($row['ope_id']));
$found_benef = $benef->fetch();

echo "<td>" . $found_benef['user_last_name'] . " " . $found_benef['user_first_name'] . " - " . $found_benef['account_name'] . "</td>";

//trouver le montant de l'opération
$credit = $bdd->prepare("SELECT DISTINCT ope_acc_id_1 FROM operations o  INNER JOIN accounts a on a.account_id = o.ope_acc_id_1  WHERE a.account_id IN (SELECT a.account_id FROM accounts a WHERE a.account_id = ?) AND a.account_user_id = ?");
$credit->execute(array($row['ope_acc_id_1'], $_SESSION["user_id"]));

$found_credit = $credit->fetch();
$count_credit = $credit->rowCount();

if($count_credit > 0) {
    $amount_credit = -1 * $row['ope_amount'];
    echo "<td style='color:red'>" . $amount_credit . "</td>";
} else {
    echo "<td style='color:green'>" . $row['ope_amount'] . "</td>";
}
