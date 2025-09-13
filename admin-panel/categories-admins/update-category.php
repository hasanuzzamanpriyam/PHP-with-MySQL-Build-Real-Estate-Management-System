<?php include '../../config/config.php'; ?>
<?php include '../layouts/header.php'; ?>
<?php
if (!isset($_SESSION['adminname'])) {
  header('location:' . ADMINURL . '/admins/login-admins.php');
}

// get category by id
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $category = $pdo->prepare("SELECT * FROM categories WHERE id = :id");
  $category->execute(['id' => $id]);
  $category = $category->fetch(PDO::FETCH_OBJ);

  if (!$category) {
    // Optional: Redirect or show a 404 error if category not found
    header('location:' . ADMINURL . '/categories-admins/show-categories.php');
    exit;
  }
}

// update category
if (isset($_POST['submit'])) {
  if (!empty($_POST['name'])) {
    $name = $_POST['name'];
    $id = $_GET['id'];
    $updateCategory = $pdo->prepare("UPDATE categories SET name = :name WHERE id = :id");
    $updateCategory->execute(['name' => $name, 'id' => $id]);
    header('location:' . ADMINURL . '/categories-admins/show-categories.php');
    exit;
  }
}

?>

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-5 d-inline">Update Categories</h5>
        <form method="POST" action="update-category.php?id=<?php echo $category->id; ?>" enctype="multipart/form-data">
          <!-- Email input -->
          <div class="form-outline mb-4 mt-4">
            <input type="text" name="name" id="form2Example1" value="<?php echo $category->name; ?>" class="form-control" />

          </div>


          <!-- Submit button -->
          <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>


        </form>

      </div>
    </div>
  </div>
</div>
<?php include '../layouts/footer.php'; ?>