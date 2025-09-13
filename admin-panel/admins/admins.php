<?php include '../../config/config.php'; ?>
<?php include('../layouts/header.php'); ?>


<?php
 // Check if admin is logged in
if (!isset($_SESSION['adminname'])) {
  header("Location: " . ADMINURL . "/admins/login-admins.php");
}


$admins = $pdo->query("SELECT * FROM admins");
$admins->execute();
$admins = $admins->fetchAll(PDO::FETCH_OBJ);
?>
          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Admins</h5>
             <a  href="<?php echo ADMINURL; ?>/admins/create-admins.php" class="btn btn-primary mb-4 text-center float-right">Create Admins</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">username</th>
                    <th scope="col">email</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($admins as $index => $admin): ?>
                    <tr>
                      <th scope="row"><?php echo $index + 1; ?></th>
                      <td><?php echo $admin->admin_name; ?></td>
                      <td><?php echo $admin->email; ?></td>
                    </tr>
                  <?php endforeach; ?>
                  </tr>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>



<?php include('../layouts/footer.php'); ?>