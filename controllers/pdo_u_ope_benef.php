<?php

$benef = $bdd->prepare("SELECT DISTINCT u.user_last_name, u.user_first_name, a.account_name 
FROM users u 
INNER JOIN accounts a ON a.account_user_id = u.user_id 
INNER JOIN operations o ON o.ope_acc_id_2 = a.account_id 
WHERE o.ope_id = ?");
$benef->execute(array($row['ope_id']));

$found_benef = $benef->fetch();

echo "<td>" . $found_benef['user_last_name'] . " " . $found_benef['user_first_name'] . " - " . $found_benef['account_name'] . "</td>";
