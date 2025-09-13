<?php include 'layouts/header.php'; ?>
<?php include '../config/config.php'; ?>
<?php
if (!isset($_SESSION['adminname'])) {
  header("Location: " . ADMINURL . "/admins/login-admins.php");
}

$props = $pdo->query("SELECT COUNT(*) FROM properties");
$props->execute();

$cats = $pdo->query("SELECT COUNT(*) FROM categories");
$cats->execute();

$admins = $pdo->query("SELECT COUNT(*) FROM admins");
$admins->execute();

$propsCount = $props->fetch(PDO::FETCH_OBJ);
$catsCount = $cats->fetch(PDO::FETCH_OBJ);
$adminsCount = $admins->fetch(PDO::FETCH_OBJ);
?>

      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Properties</h5>
              <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
              <p class="card-text">number of properties: <?php echo $propsCount->{"COUNT(*)"} ?></p>

            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Categories</h5>
              <p class="card-text">number of categories: <?php echo $catsCount->{"COUNT(*)"} ?></p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Admins</h5>

              <p class="card-text">number of admins: <?php echo $adminsCount->{"COUNT(*)"} ?></p>

            </div>
          </div>
        </div>


<?php include('layouts/footer.php'); ?>