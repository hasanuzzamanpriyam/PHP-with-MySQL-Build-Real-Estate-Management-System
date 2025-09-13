<?php require '../includes/header.php'; ?>
<?php
if (isset($_POST['submit'])) {
    try {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $prop_id = $_POST['prop_id'];
        $user_id = $_SESSION['user_id'];
        $author = $_POST['admin_name'];

        $insert = $pdo->prepare("INSERT INTO requests (name, email, phone, prop_id, user_id, author) 
                                VALUES (:name, :email, :phone, :prop_id, :user_id, :author)");
        $insert->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':prop_id' => $prop_id,
            ':user_id' => $user_id,
            ':author' => $author
        ]);
        header('Location: ' . APPURL . '/property-details.php?id=' . $prop_id . '&success=true');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>