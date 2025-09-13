<?php require '../includes/header.php'; ?>

<?php
if (isset($_GET['prop_id']) && isset($_GET['user_id'])) {
    $prop_id = $_GET['prop_id'];
    $user_id = $_GET['user_id'];

    $deleteFav = $pdo->prepare("DELETE FROM favs WHERE prop_id = :prop_id AND user_id = :user_id");
    $deleteFav->bindParam(':prop_id', $prop_id);
    $deleteFav->bindParam(':user_id', $user_id);
    $deleteFav->execute();

    header('location: ' . APPURL . '/property-details.php?id=' . $prop_id);
}
?>