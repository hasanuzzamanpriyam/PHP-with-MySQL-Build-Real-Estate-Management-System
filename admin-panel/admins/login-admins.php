<?php include '../../config/config.php'; ?>
<?php include '../layouts/header.php'; ?>

<?php
if (isset($_SESSION['adminname'])) {
  header("Location: " . ADMINURL . "");
}

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  if (!empty($email) && !empty($password)) {
    $loginQuery = $pdo->query("SELECT * FROM admins WHERE email = '$email'");
    $loginQuery->execute();

    $fetch = $loginQuery->fetch(PDO::FETCH_ASSOC);

    if ($loginQuery->rowCount() > 0) {
      // echo $loginQuery->rowCount();
      // echo "email is valid";

      if (password_verify($password, $fetch['mypassword'])) {
        $_SESSION['adminname'] = $fetch['admin_name'];
        $_SESSION['email'] = $fetch['email'];
        $_SESSION['admin_id'] = $fetch['id'];
        header("Location: " . ADMINURL . "");
      } else {
        echo "<script>alert('Invalid password.');</script>";
      }
    } else {
      echo "<script>alert('Invalid email.');</script>";
    }
  } else {
    echo '<script>alert("Please fill in all fields.");</script>';
  }
}
?>

<div class="container">
  <div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-center">Login</h5>
        <form method="POST" class="p-auto mt-5" action="login-admins.php">
          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />

          </div>


          <!-- Password input -->
          <div class="form-outline mb-4">
            <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />

          </div>



          <!-- Submit button -->
          <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>


        </form>

      </div>
    </div>
  </div>
</div>
</div>

<?php include '../layouts/footer.php'; ?>