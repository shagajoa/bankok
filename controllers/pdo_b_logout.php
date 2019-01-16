<?php
session_start();
session_destroy();
header('Location: ../pages/b_login.php');
?>