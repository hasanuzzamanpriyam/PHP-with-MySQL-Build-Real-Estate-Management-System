<?php
require '../layouts/header.php';
session_destroy();
header("Location: " . ADMINURL . "/admins/login-admins.php");
exit();