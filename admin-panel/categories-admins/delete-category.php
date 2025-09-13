<?php include '../../config/config.php' ; ?>
<?php include '../layouts/header.php' ; ?>
 <?php
if (!isset($_SESSION['adminname'])) {
    header('location:'.ADMINURL.'/admins/login-admins.php');
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $pdo->query("DELETE FROM categories WHERE id = $id");
    header('location:'.ADMINURL.'/categories-admins/show-categories.php');
}
?>