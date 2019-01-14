<?php

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