<?php
require_once 'auth.php';

unset($_SESSION['user']);
header('Location: login.php');
exit;
?>