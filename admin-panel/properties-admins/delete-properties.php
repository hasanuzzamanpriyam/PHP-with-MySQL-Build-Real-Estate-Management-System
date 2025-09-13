<?php include '../../config/config.php' ; ?>
<?php include '../layouts/header.php' ; ?>
 <?php
if (!isset($_SESSION['adminname'])) {
  header('location:'.ADMINURL.'/admins/login-admins.php');
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 1. Fetch and delete the main image file
    $image_select = $pdo->prepare("SELECT * FROM properties WHERE id = :id");
    $image_select->execute([':id' => $id]);
    $image = $image_select->fetch(PDO::FETCH_OBJ);

    if ($image && file_exists("../../images/" . $image->image)) {
        unlink("../../images/" . $image->image);
    }

    // 2. Fetch and delete related gallery images
    $related_images_select = $pdo->prepare("SELECT * FROM related_images WHERE props_id = :props_id");
    $related_images_select->execute([':props_id' => $id]);
    $related_images = $related_images_select->fetchAll(PDO::FETCH_OBJ);

    foreach ($related_images as $related_image) {
        if (file_exists("../../images/" . $related_image->image)) {
            unlink("../../images/" . $related_image->image);
        }
    }

    // 3. Delete records from related_images table
    $delete_related = $pdo->prepare("DELETE FROM related_images WHERE props_id = :props_id");
    $delete_related->execute([':props_id' => $id]);

    // 4. Delete the property from the properties table
    $delete_property = $pdo->prepare("DELETE FROM properties WHERE id = :id");
    $delete_property->execute([':id' => $id]);

    header('Location: show-properties.php');
    exit();
} else {
    header('Location: ' . ADMINURL . '/properties-admins/show-properties.php');
    exit();
}
?>