<?php include '../../config/config.php'; ?>
<?php include '../layouts/header.php'; ?>
<?php
if (!isset($_SESSION['adminname'])) {
  header('location:' . ADMINURL . '/admins/login-admins.php');
}

if (isset($_POST['submit'])) {
  if (!empty($_POST['name'])) {
    $name = $_POST['name'];
    $name = str_replace(' ', '-', trim($name));

    $insert = $pdo->prepare("INSERT INTO categories (name) VALUES (:name)");
    $insert->execute([
      'name' => $name
    ]);

    header('location:' . ADMINURL . '/categories-admins/show-categories.php');
  } else {
    echo "<script>alert('Please fill all the fields');</script>";
  }
}

$Categories = $pdo->query("SELECT * FROM categories");
$categoriesResult = $Categories->fetchAll(PDO::FETCH_OBJ);
?>

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-5 d-inline">Create Categories</h5>
        <form method="POST" action="create-category.php" enctype="multipart/form-data">
          <!-- Email input -->
          <div class="form-outline mb-4 mt-4">
            <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />

          </div>


          <!-- Submit button -->
          <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>


        </form>

      </div>
    </div>
  </div>
</div>
<?php include '../layouts/footer.php'; ?>