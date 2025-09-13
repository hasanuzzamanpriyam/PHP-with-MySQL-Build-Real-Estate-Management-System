<?php require '../includes/header.php'; ?>

<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['prop_id']) AND isset($_SESSION['user_id'])) {
        $prop_id = $_POST['prop_id'];
        $user_id = $_SESSION['user_id'];

        $sql = "INSERT INTO favs (prop_id, user_id) VALUES (:prop_id, :user_id)";
        $statement = $pdo->prepare($sql);
        $statement->execute([':prop_id' => $prop_id, ':user_id' => $user_id]);

        header("Location: " . APPURL . "/property-details.php?id=" . $prop_id);
        exit;
    } else {
        header("Location: " . APPURL . "/auth/login.php");
        exit;
    }

}
?>